<?php
/*
* Plugin Name: Visual Composer - Sortable Grid & Taxonomy filter
* Plugin URI: http://infiwebs.com/plugins/sortable-post-grid
* Author: InfiWebs
* Author URI: http://infiwebs.com
* Version: 2.0.0
* Description: Standalone solution to display your posts in multiple grid layouts with sortable options with option to filter them with taxonomies registered for the corresponding post type being displayed.
* Text-domain: sortable
*/
if(!class_exists('VC_PostGrid'))
{
	class VC_PostGrid
	{
		function __construct()
		{
			add_action('admin_init',array($this,'init'));
			add_shortcode('sortable_post_grid',array($this,'postgrid_shortcode'));
			add_action('wp_enqueue_scripts',array($this,'front_enqueue_scripts'));
			add_action('admin_enqueue_scripts',array($this,'front_editor_scripts'));
			add_action( 'wp_ajax_spg_get_data', array($this,'spg_get_data'));
			add_action( 'wp_ajax_nopriv_spg_get_data', array($this,'spg_get_data'));
		}// end construct()
		// Handle request then generate response using WP_Ajax_Response
		function spg_get_data() {
			$post_id = $html = '';
			if(isset($_POST['post_id']))
				$post_id = $_POST['post_id'];
			$post = get_post($post_id);
			$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post_id, 'full'),'full' );
			$thumbnail = $featured_img[0];
			$author_id = $post->post_author;
			$author_link = get_author_posts_url($author_id);
			$author = get_the_author_meta( 'user_nicename' , $author_id );
			$post_meta = '<span class="author-meta">';
            $post_meta .= '<a href="'.$author_link.'">'.$author.'</a>'; 
			$post_meta .= get_the_date('F j, Y');
			$post_meta .= '</span>';
			$spg_class = 'vc_col-sm-12 vc_span12';
			if(trim($thumbnail)){
				$spg_class = 'vc_col-sm-7 vc_span7';
				$html .= '<div class="vc_col-sm-5 vc_span5 spg-featured-image"><img src="'.$thumbnail.'"/></div>';
			}
			$html .= '<div class="'.$spg_class.' spg-post-content">';
			//$html .= $post_meta;
			$html .= $post_meta.' &diams;<span class="spg-date-label">'.date('j M Y', strtotime($post->post_date)).'</span>';
			$html .= '<h3>'.$post->post_title.'</h3>';
			$html .= '<div class="post-content">'.do_shortcode($post->post_content).'</div>';
			$html .= '<div class="post-meta-data">'.spg_get_post_meta($post_id).'</div>';
			$html .= '</div>';
			
			echo $html;
						
			die();
		}
		function front_editor_scripts()
		{
			wp_enqueue_style('post-sortable-admin',plugins_url('css/admin.css',__FILE__));
			// enqueue scripts only on VC Inline Editor in backend
			if ( isset($_GET['vc_action']) ) {
				wp_enqueue_style('post-sortable',plugins_url('css/sortable.css',__FILE__));
				//wp_enqueue_script('jquery-cdn','http://code.jquery.com/jquery-1.10.2.min.js');
				wp_enqueue_script('post-sortable',plugins_url('js/sortable.js',__FILE__),false,'',true);
			}
		}//end front_enqueue_scripts()
		function front_enqueue_scripts()
		{
			global $post;
			if(!is_404() && !is_search()){
				$post_to_check = get_post($post->ID);
				// check the post content for the short code 
				echo '<script type="text/javascript">var spg_ajax = "'.admin_url('admin-ajax.php').'";</script>';
				if ( stripos($post_to_check->post_content, '[sortable_post_grid') !== false && stripos($post_to_check->post_content, 'grid_type="masonry"') !== false ) {
					wp_enqueue_style('post-transitions',plugins_url('css/transitions.css',__FILE__));
					wp_enqueue_style('post-sortable-masonry',plugins_url('css/sortable-normal.css',__FILE__));
					wp_enqueue_style('post-select2',plugins_url('css/select2.css',__FILE__));
					wp_enqueue_style('post-select2-bootstrap',plugins_url('css/select2-bootstrap.css',__FILE__));
					//wp_enqueue_script('jquery-cdn','http://code.jquery.com/jquery-1.10.2.min.js');
					wp_enqueue_script('post-select2',plugins_url('js/select2.min.js',__FILE__),false,'',true);
					wp_enqueue_script('post-sortable',plugins_url('js/sortable.js',__FILE__),false,'',true);
					wp_enqueue_script('post-tooltipsy',plugins_url('js/tooltip.js',__FILE__),false,'',true);
				} elseif ( stripos($post_to_check->post_content, '[sortable_post_grid') !== false ) {
					wp_enqueue_style('post-transitions',plugins_url('css/transitions.css',__FILE__));
					wp_enqueue_style('post-sortable-normal',plugins_url('css/sortable-normal.css',__FILE__));
					wp_enqueue_style('post-select2',plugins_url('css/select2.css',__FILE__));
					wp_enqueue_style('post-select2-bootstrap',plugins_url('css/select2-bootstrap.css',__FILE__));
					//wp_enqueue_script('jquery-cdn','http://code.jquery.com/jquery-1.10.2.min.js');
					wp_enqueue_script('post-select2',plugins_url('js/select2.min.js',__FILE__),false,'',true);
					wp_enqueue_script('post-sortable',plugins_url('js/sortable.js',__FILE__),false,'',true);
					wp_enqueue_script('post-tooltipsy',plugins_url('js/tooltip.js',__FILE__),false,'',true);
				}
			}
		}//end front_enqueue_scripts()
		function init()
		{
			if(function_exists('vc_map'))
			{
				$args = array(
				   'public'   => true,
				   '_builtin' => false,
				);
				$output = 'names'; // names or objects, note names is the default
				$operator = 'and'; // 'and' or 'or'
				$post_types = array("post","page");
				$post_types = array_merge($post_types, get_post_types( $args, $output, $operator ));
				$args = array(
					'type'                     => 'post',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'category',
					'pad_counts'               => false );
				$categories = get_categories( $args );
				$tax_args = array(
					'public'   		=> true,
					'_builtin' 		=> false,
					'hierarchical' 	=> true,
					'query_var'     => true,
				);
				$taxonomies = get_taxonomies($tax_args,'names'); 
				$cats = array();
				foreach($categories as $cat){
					$cats[$cat->name] = $cat->slug;
				}
				vc_map(
					array(
					   "name" => __("Sortable Post Grid"),
					   "base" => "sortable_post_grid",
					   "class" => "",
					   "icon" => "vc_sortable_post_grid",
					   "category" => __('InfiWebs','postgrid'),
					   "params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Grid Display Type","sortable"),
								"param_name" => "grid_type",
								"admin_label" => true,
								"value" => array(
										"Normal Grid" => "normal",
										"Masonry Grid" => "masonry"
									),
								"description" => __("Select the grid display type you want to use.","sortable"),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Display Posts From -","sortable"),
								"param_name" => "display_type",
								"admin_label" => true,
								"value" => array(
										"Category" => "cat",
										"Custom Post Type" => "cpt",
										"Custom Taxonomy" => "ctx"
									),
								"description" => __("Select from which base do you want to use to display posts.","sortable"),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Post Type to use","sortable"),
								"param_name" => "post_type",
								"admin_label" => true,
								"value" => $post_types,
								"description" => __("Posts from the selected post types will be displayed","sortable"),
								"dependency" => Array("element" => "display_type", "value" => array("cpt")),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Select Category -","sortable"),
								"param_name" => "post_cat",
								"admin_label" => true,
								"value" => $cats,
								"description" => __("Posts from the selected category will be displayed","sortable"),
								"dependency" => Array("element" => "display_type", "value" => array("cat")),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Custom Taxonomy to use","sortable"),
								"param_name" => "taxonomy",
								"admin_label" => true,
								"value" => $taxonomies,
								"description" => __("Select taxonomy and enter the term slug below to display posts from that taxonomy term","sortable"),
								"dependency" => Array("element" => "display_type", "value" => array("ctx")),
								"group" => "General",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Selected Taxonomy Term Slug","sortable"),
								"param_name" => "tax_term",
								"value" => "",
								"description" => __("Enter the slug from the selected taxonomy to display posts from.","sortable"),
								"dependency" => Array("element" => "display_type", "value" => array("ctx")),
								"group" => "General",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Taxonomies Sorting","sortable"),
								"param_name" => "enable_tax_sort",
								"value" => array("Enable sorting by taxonomies" => "enable"),
								"description" => __("Check if you want to enable the option to sort the posts by taxonomies registered for the above selected post type.","sortable"),
								"dependency" => Array("element" => "display_type", "value" => array("cpt")),
								"group" => "General",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Custom message for no results","sortable"),
								"param_name" => "custom_msg",
								"value" => "Sorry! No posts found for the applied filter",
								"description" => __("Enter the Custom message that will be displayed to the user when the applied search filter returns with no posts.","sortable"),
								"dependency" => Array("element" => "enable_tax_sort", "value" => array("enable")),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Select Taxonomy Sorting Type","sortable"),
								"param_name" => "tax_sort_type",
								"value" => array(
										"Dropdown Selection" => "dropdown",
										"Checkbox Selection" => "checkbox",
										"Radio Button Selection" => "radio-button",
									),
								"description" => __("Select the html input type you would like to use as a taxonomy sorting selector.","sortable"),
								"dependency" => Array("element" => "enable_tax_sort", "value" => array("enable")),
								"group" => "General",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Taxonomy Post Count","sortable"),
								"param_name" => "tax_count",
								"value" => array("Hide the post count from taxonomy labels." => "hide"),
								"description" => __("Check if you want to remove the no. of posts count from the taxonomy label in dropdown.","sortable"),
								"dependency" => Array("element" => "enable_tax_sort", "value" => array("enable")),
								"group" => "General",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Exclude taxonomy from filter","sortable"),
								"param_name" => "tax_exclude",
								"value" => '',
								"description" => __("Enter taxonomy slug separated by comma(,) to exclude from being displayed taxonomy filter. E.g tags.","sortable"),
								"dependency" => Array("element" => "enable_tax_sort", "value" => array("enable")),
								"group" => "General",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Number of Posts to display","sortable"),
								"param_name" => "post_count",
								"value" => "10",
								"description" => __("Enter the no. of posts you would like to display on a page. -1 will display all posts.","sortable"),
								"group" => "General",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Sort by options -", "sortable"),
								"param_name" => "sortby",
								"value" => array(
									"No Order<br>" => "none",
									"Sort by Post ID<br>" => "ID",
									"Sort by Title<br>" => "title",
									"Sort by Date<br>" => "date",
									"Sort by Random<br>" => "rand",
								),
								"description" => __("Check which sorting options would you like to display.", "sortable"),
								"group" => "General",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Default Sort by order -", "sortable"),
								"param_name" => "default_sort",
								"value" => array(
									"No Order" => "none",
									"Sort by Post ID" => "ID",
									"Sort by Title" => "title",
									"Sort by Date" => "date",
									"Sort by Random" => "rand",
								),
								"description" => __("Select the default sort order of posts on first load", "sortable"),
								"group" => "General",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Select Grid Layouts to display -", "sortable"),
								"param_name" => "display_grid",
								"value" => array(
									__("Grid View with Large Thumbnail","sortable")."<br>" => "grid-medium",
									__("Grid View with Medium Thumbnail","sortable")."<br>" => "grid-small",
									__("Grid View with Small Thumbnail","sortable")."<br>" => "grid-mini",
									__("List View with Large Thumbnail","sortable")."<br>" => "list-large",
									__("List View with Small Thumbnail","sortable")."<br>" => "list-small",
									//__("List View with Medium Thumbnail","sortable") => "list-medium",
								),
								"description" => __("Select the grid views you want to display on this page.", "sortable"),
								"group" => "Layout",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Default Grid Layout -", "sortable"),
								"param_name" => "default_grid",
								"value" => array(
									__("Grid View with Large Thumbnail","sortable") => "grid-medium",
									__("Grid View with Medium Thumbnail","sortable") => "grid-small",
									__("Grid View with Small Thumbnail","sortable") => "grid-mini",
									__("List View with Large Thumbnail","sortable") => "list-large",
									__("List View with Small Thumbnail","sortable") => "list-small",
									//__("List View with Medium Thumbnail","sortable") => "list-medium",
								),
								"description" => __("Select the grid view to be used on page load.", "sortable"),
								"group" => "Layout",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Select Grid Layouts display position -", "sortable"),
								"param_name" => "display_grid_pos",
								"value" => array(
									__("Display Grid Layouts at Left","sortable") => "grid-left",
									__("Display Grid Layouts at Right","sortable") => "grid-right",
								),
								"description" => __("Select the grid view to be used on page load.", "sortable"),
								"group" => "Layout",
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Default thumbnail Image","sortable"),
								"param_name" => "default_thumb",
								"value" => "",
								"description" => __("Image to use if the post has no featured image. If not provided, plugin's default image will be used.","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("Overlay Link Icon Image","sortable"),
								"param_name" => "overlay_img",
								"value" => "",
								"description" => __("Image for overlay background. Displayed when hover on image thumbnail.","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Overlay Background Color","sortable"),
								"param_name" => "overlay_color",
								"value" => "",
								"description" => __("Choose Color for overlay background. Displayed when hover on image thumbnail.","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Overlay Background Opacity","sortable"),
								"param_name" => "overlay_op",
								"value" => "",
								"description" => __("Background opacity for overlay background color ( Should be 0.1 to 1 ). Displayed when hover on image thumbnail.","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Post Title font size","sortable"),
								"param_name" => "font_size",
								"value" => "",
								"description" => __("Enter font size in px. e.g. - 28","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Post Title font color","sortable"),
								"param_name" => "font_color",
								"value" => "",
								"description" => __("Enter font color for post title.","sortable"),
								"group" => "Design",
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Grid Loading Animation", "sortable"),
								"param_name" => "animation",
								"value" => array(
									"No Animation" => "no-cssanimations",
									"Fade Effect" => "effect-1",
									"Move Up" => "effect-2",
									"Scale up" => "effect-3",
									"Fall Perspective" => "effect-4",
									"Fly" => "effect-5",
									"Flip" => "effect-6",
									"Helix" => "effect-7",
									"popUp" => "effect-8",
								),
								"description" => __("Select the animation effect to be used when the posts in the grid are loading on scroll", "sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Date option","sortable"),
								"param_name" => "hide_date",
								"value" => array("Hide date from display" => "hide"),
								"description" => __("Check if you want to hide the date display from grid.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Taxonomy Meta","sortable"),
								"param_name" => "tax_meta",
								"value" => array("Display Taxonomies in Post Meta (Grid) display." => "display"),
								"description" => __("Check if you want to display the taxonomy terms in grid","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Exclude taxonomy in post meta","sortable"),
								"param_name" => "tax_meta_exclude",
								"value" => '',
								"description" => __("Enter taxonomy slug separated by comma(,) to exclude from being displayed in post meta. E.g tags.","sortable"),
								"dependency" => Array("element" => "tax_meta", "value" => array("display")),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Hide taxonomy label","sortable"),
								"param_name" => "tax_label_meta",
								"value" => array("Hide taxonomy name from post meta" => "hide"),
								"description" => __("Check if you want to hide taxonomy label from post meta.","sortable"),
								"dependency" => Array("element" => "tax_meta", "value" => array("display")),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Excerpt in Grid View","sortable"),
								"param_name" => "excerpt_display",
								"value" => array("Display excerpt in Grid View" => "enable"),
								"description" => __("To make the grid view clean, we have set excerpt to not display. But, you can set it to display from here.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Image overlay","sortable"),
								"param_name" => "img_overlay_hide",
								"value" => array("Hide image overlay animation on hover" => "hide"),
								"description" => __("Check if you want to hide the image overlay background upon hover on image.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Post Quickview","sortable"),
								"param_name" => "post_quickview",
								"value" => array("Enable post quickview" => "enable"),
								"description" => __("Check if you want to enable the post overview / quickview.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Post Quickview Popup Title","sortable"),
								"param_name" => "post_quickview_title",
								"value" => "",
								"description" => __("Enter custom title to be displayed on post quickview.","sortable"),
								"dependency" => Array("element" => "post_quickview", "value" => array('enable')),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Ajaxify Content","sortable"),
								"param_name" => "load_with_ajax",
								"value" => array("Enable content loading with AJAX" => "hide"),
								"description" => __("Check if you want to enable content loading with ajax instead of refreshing the whole page. This setting will be applied to orderby, order and pagination.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Ascending / Descending Sort Option","sortable"),
								"param_name" => "disable_asc_sort",
								"value" => array("Disable Ascending / Descending Sort Option" => "hide"),
								"description" => __("Check if you want to disable the ascending and descending sort option.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("Tooltip","sortable"),
								"param_name" => "disable_tooltip",
								"value" => array("Disable tooltip on hover on grid layouts" => "hide"),
								"description" => __("Check if you want to disable the tooltip on hover on grid layouts options.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Excerpt length","sortable"),
								"param_name" => "length",
								"value" => "",
								"description" => __("Enter the custom excerpt lenght (no. of words to display)","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Display Custom Read More Text","sortable"),
								"param_name" => "display_read_more",
								"value" => '',
								"description" => __("Enter custom text for read more link. If no text is present, no read more link will be displayed.","sortable"),
								"group" => "Advanced",
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Extra Class","sortable"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("Enter the extra class name that would be applied to the parent div, and can be used for extra customizations.","sortable"),
								"group" => "General",
							),
						),
					)
				);
			}
		} // end postgrid_init()
		function postgrid_shortcode($atts)
		{
			global $post;
			
			ob_start();
			
			$grid_type = '';
			
			extract(shortcode_atts(array(
				'grid_type' => 'normal',
			),$atts));
			if($grid_type == "normal"){
				require_once('postgrid_normal.php');
				echo postgrid_normal($atts);
			} else if($grid_type == "masonry") {
				require_once('postgrid_masonry.php');
				
				wp_enqueue_script('spg-masonry',plugins_url('js/jquery.masonry.min.js',__FILE__),false,'',true);
				
				echo postgrid_masonry($atts);
			}
			
			$html = ob_get_clean();
			
			return $html;
			
			ob_clean();
		}//end postgrid_shortcode()
	}
	new VC_PostGrid;
	if(class_exists('WPBakeryShortCode')){
		class WPBakeryShortCode_sortable_post_grid extends WPBakeryShortCode {
		}
	}
	function convert_rgb($hex,$op) {
		if($op == "") $op = 1;
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgba = 'rgba('.$r.','.$g.','.$b.','.$op.');';
	   return $rgba; // returns an the color values with rgba
	}
}
function spg_get_post_meta($postid){
	$tax_list = $tax_meta_list = array();
	$post_type = get_post_type($postid);
	$tax_args = array(
		'public'   		=> true,
		'_builtin' 		=> false,
		'hierarchical' 	=> true,
		'query_var'     => true,
		'post_type' 	=> $post_type
	);
	$tax_names = get_object_taxonomies( $tax_args,'objects' );
	foreach($tax_names as $tax){
		$terms = get_terms($tax->name,array( 'hide_empty' => true,'pad_counts'    => true));
		foreach ( $terms as $term ) {
				 $args = array(
					'post_type' 	=> $post_type,
					'tax_query' => array(
						array(
							'taxonomy' => $tax->name,
							'field' => 'slug',
							'terms' => $term->slug
						)
					)
				);
			$postslist = get_posts( $args );
			if(!empty($postslist)):
				$tax_list[$tax->name] = $tax->label;
				$tax_meta_list[$tax->name] = $tax->label;
			endif;
		}
	}
	$tag_list = '';
	ob_start();
	if(!empty($tax_meta_list)){
		foreach($tax_meta_list as $name => $label){
			echo '<div class="spg-post-meta">';
			$tax_labels = '<span class="spg-post-meta-label">'.$label.':</span>';
			echo get_the_term_list( $postid, $name, $tax_labels.'<span class="spg-post-meta-tags">', ',', '</span>' );
			echo '</div>';
		}
	}
	return ob_get_clean();
}