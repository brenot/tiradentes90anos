<?php
function postgrid_normal($atts)
{
    global $post;
    $permalink = get_permalink($post->ID);
    $post_type = $post_count = $sortby = $default_sort = $post_type = $taxonomy = $tax_term = $display_grid = $default_grid = $default_thumb = '';
	$length = $sort_bg = $sort_text = $overlay_img = $overlay_color = $overlay_op = $display_grid_pos = $font_size = $font_color = '';
	$excerpt_display = $display_type = $post_cat = $img_overlay_hide = $load_with_ajax = $display_read_more = $disable_asc_sort = '';
	$disable_tooltip = $enable_tax_sort = $el_class = $custom_msg = $tax_count = $animation = $hide_date = $tax_sort_type = '';
	$tax_exclude = $tax_meta = $tax_meta_exclude = $tax_label_meta = $post_quickview = $post_quickview_title = '';
    extract(shortcode_atts(array(
        'display_type' => '',
        'post_type' => '',
        'post_cat' => '',
        'post_count' => '',
        'sortby' => '',
        'default_sort' => '',
        'post_type' => '',
		'taxonomy' => '',
		'tax_term' => '',
        'display_grid' => '',
        'default_grid' => '',
        'default_thumb' => '',
        'display_grid_pos' => '',
        'length' => 25,
        'overlay_img' => '',
        'overlay_color' => '',
        'overlay_op' => '',
        'font_size' => '',
        'font_color' => '',
        'excerpt_display' => '',
        'img_overlay_hide' => '',
        'load_with_ajax' => '',
        'display_read_more' => '',
        'disable_asc_sort' => '',
        'disable_tooltip' => '',
		'enable_tax_sort' => '',
		'custom_msg' => '',
		'tax_count' => '',
		'animation' => 'no-cssanimations',
		'hide_date' => '',
		'tax_exclude' => '',
		'tax_meta' => '',
		'tax_meta_exclude' => '',
		'tax_label_meta' => '',
		'post_quickview' => '',
		'post_quickview_title' => '',
		'tax_sort_type' => 'dropdown',
        'el_class' => '',
    ),$atts));
    $overlay = $selected = $current = $order_url = $orderby_url = $active = $url = $opacity = $style = $orderby= $display = $posts_from = $load_ajax = $tooltip = $taxonomies = $html = $overlay_link_img = '';
    if($disable_tooltip !== "hide"){
        $tooltip = 'hastooltip';
        wp_enqueue_script('post-tooltipsy',plugins_url('js/tooltip.js',__FILE__),false,'',true);
    } else {
        wp_dequeue_script('post-tooltipsy');
    }
    if($display_type == "cpt"){
        $display = 'post_type';
        $posts_from = $post_type;
	} elseif($display_type == "ctx"){
		$display = 'tax_query';
		$posts_from = array(
						array(
							'taxonomy' => $taxonomy,
							'field' => 'slug',
							'terms' => $tax_term
						)
					);
    } else {
        $display = 'category_name';
        $posts_from = $post_cat;
    }
	
	$tax_args = array(
		'public'   		=> true,
		'_builtin' 		=> false,
		'hierarchical' 	=> true,
		'query_var'     => true,
		'post_type' 	=> $post_type
	);
	$_GET = array_filter($_GET);
	$remove_filter = '';
	$tax_names = get_object_taxonomies( $tax_args,'objects' );
	$posts_from_filter = array();
	foreach($_GET as $get){
		foreach($tax_names as $tax){
			if(isset($_GET['spg_'.$tax->name])){	
				$remove_filter = '&nbsp;&nbsp;<input type="button" onclick="window.location=\''.get_the_permalink().'\';" class="button button-submit" value="'.__("Remove Filter","infiwebs").'"/>';
				$display = 'tax_query';
				$posts_from_filter[] = array(
							'taxonomy' => $tax->name,
							'field' => 'slug',
							'terms' => $_GET['spg_'.$tax->name]
						);
			}
		}
	}
	
    if($font_color !== ''){
        $style .= 'color:'.$font_color.';';
    }
    if($font_size !== ''){
        $style .= 'font-size:'.$font_size.'px;';
    }
    $default_img = plugins_url('img/default-no-image.png',__FILE__);
    if($default_thumb == ''){
        $default_img = plugins_url('img/default-no-image.png',__FILE__);
    } else {
        $default_img = wp_get_attachment_image_src($default_thumb,'full');
        $default_img = $default_img[0];
    }
    if($overlay_img !== ''){
        $temp_img = wp_get_attachment_image_src($overlay_img,'full');
        $overlay_link_img .= 'background-image:url('.$temp_img[0].');';
		$overlay_link_img .= 'background-size: 32px;';
    }
    if($overlay_color !== ''){
		if(strlen($overlay_color) <= 7)
        	$overlay .= 'background-color:'.convert_rgb($overlay_color,$overlay_op);
		else
			$overlay .= 'background-color:'.$overlay_color.';';
    }
    if($load_with_ajax){
        $load_ajax = 1;
    } else {
        $load_ajax = 0;
    }
//			if($overlay_op !== ''){
//				$opacity .= 'data-opacity="'.$overlay_op.'"';
//			}
    $sorts = explode(",", $sortby);
	$paged = isset($_GET['spg-page'] ) ? $_GET['spg-page'] : 1;
    $order = isset( $_GET['set_order'] ) ? $_GET['set_order'] : 'asc';
	$order = strtolower($order);
    if($order == 'asc'){
        $new_order = 'desc';
        $order_desc = __('Sort Descending','sortable');
    } else {
        $new_order = 'asc';
        $order_desc = __('Sort Ascending','sortable');
    }
    $orderby = isset( $_GET['set_orderby'] ) ? $_GET['set_orderby'] : $default_sort;
	if(!empty($posts_from_filter)){
		$posts_from = $posts_from_filter;
	}
    $args = array(
        'posts_per_page'   => $post_count,
        'orderby'          => $orderby,
        'order'            => $new_order,
        $display        	=> $posts_from,
        'post_status'      => 'publish',
        'suppress_filters' => true,
        'paged' 			=> $paged,
		'post_type' 	=> $post_type
    );
    if(isset($_GET['page_id']))
    {
        $page = $_GET['page_id'];
        $order_url = $orderby_url .= '?page_id='.$page.'&';
        $url .= $order_url;
    } else {
        $order_url = $orderby_url = $url = '?';
    }
    if(isset($_GET['set_order'])){
        $order_url .= '';
        $orderby_url .= 'set_order='.$_GET['set_order'].'&';
        $url .= 'set_order='.$_GET['set_order'].'&';
    }
    if(isset($_GET['set_orderby'])){
        $order_url .= 'set_orderby='.$_GET['set_orderby'].'&';
        $orderby_url .= '';
        $url .= 'set_orderby='.$_GET['set_orderby'].'&';
    }
    if($url == '') $url = '?';
    $display_grid = explode(",",$display_grid);
    $grid_views = array();
    if(in_array("grid-medium",$display_grid)){
        $grid_views[__("Grid View with Medium Thumbnail","sortable")] = "grid-medium";
    }
    if(in_array("grid-small",$display_grid)){
        $grid_views[__("Grid View with Small Thumbnail","sortable")] = "grid-small";
    }
    if(in_array("grid-mini",$display_grid)){
        $grid_views[__("Grid View with Mini Thumbnail","sortable")] = "grid-mini";
    }
    if(in_array("list-small",$display_grid)){
        $grid_views[__("List View with Small Thumbnail","sortable")] = "list-small";
    }
    if(in_array("list-large",$display_grid)){
        $grid_views[__("List View with Large Thumbnail","sortable")] = "list-large";
    }
    
    //$query_posts_new = get_posts( $args );
    $query_posts_new = new WP_Query( $args );
    $pages = $query_posts_new->max_num_pages;
	$tax_args = array(
		'public'   		=> true,
		'_builtin' 		=> false,
		'hierarchical' 	=> true,
		'query_var'     => true,
		'post_type' 	=> $post_type
	);
	$tax_names = get_object_taxonomies( $tax_args,'objects' );
	$uid = uniqid();
	$tax_list = $tax_meta_list = array();
	$exclude_tax = explode(",",$tax_exclude);
	$exclude_tax_meta = explode(",",$tax_meta_exclude);
	foreach($exclude_tax as $tax_remove){
		$remove_tax = trim($tax_remove);
		unset($tax_names[$remove_tax]);
	}
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
				/*
				// check and create list of taxonomies for filter
				if(!empty($exclude_tax)){
					foreach($exclude_tax as $key):
					echo "Key = ".$key."<br>";
					echo "Tax slug = ".$tax->name."<br>";
						if(trim($key) !== $tax->name){
							$tax_list[$tax->name] = $tax->label;
						}
					endforeach;
				} else {
					$tax_list[$tax->name] = $tax->label;
				}
				
				// check and create list of taxonomies for post meta
				if(!empty($exclude_tax_meta)){
					foreach($exclude_tax_meta as $key):
						if($key !== $tax->name){
							$tax_meta_list[$tax->name] = $tax->label;
						}
					endforeach;
				}
				*/
			endif;
		}
	}
	//$tax_list = array_values(array_unique($tax_list));
	//print_r($tax_list);
	if(empty($tax_list))
		$enable_tax_sort = "disable";
		
	if($enable_tax_sort == "enable" && $tax_sort_type == "dropdown"){
		$html .= '<div class="spg-custom-sort">';
		$html .= '<form method="get" id="form_'.$uid.'">';
		$cols = count($tax_list);
		foreach($tax_list as $tax_name => $tax_label){
			$posts_count = '';
			$terms = get_terms($tax_name,array( 'hide_empty' => true,'pad_counts'    => true ));
			 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
					
				 $html .= '<span class="vc_span3 vc_col-md-3 wpb_column column_container spg-custom-tax"><label for="'.$tax_name.'">'.$tax_label.':</label><br>';
				 $selected_term = isset($_GET['spg_'.$tax_name])? $_GET['spg_'.$tax_name] : '';
				 $html .= '<select class="spg-custom-sort-opt form_'.$uid.'" data-placeholder="&nbsp;&nbsp;'.$tax_label.'&nbsp;&nbsp;" id="'.$tax_name.'" name="spg_'.$tax_name.'">';
				 $html .= '<option></option>';
				 foreach ( $terms as $term ) {
					 $get_term = str_replace( "spg_", "", $selected_term);
					 $selected_attr = ( $get_term == $term->slug ) ? 'selected="selected"' : '';
					if($tax_count == "hide")
						$posts_count = '';
					else
						$posts_count = '('.$term->count.')';
				  	$html .= '<option value="'.$term->slug.'" '.$selected_attr.'>' . $term->name . ' '.$posts_count.'</option>';
				 }
				 $html .= '</select></span>';
			 }
		}
		$html .= '<div class="vc_span3 vc_col-md-3 wpb_column column_container spg-custom-tax spg-filter-btn"> <input type="submit" class="button button-submit" value="'.__("Filter","infiwebs").'"/> '.$remove_filter.' </div>';
		$html .= '</form>';
		$html .= '</div><!-- end .spg-custom-sort -->';
	} elseif($enable_tax_sort == "enable" && $tax_sort_type == "checkbox") {
		$html .= '<div class="spg-custom-sort">';
		$html .= '<form method="get" id="form_'.$uid.'">';
		$cols = count($tax_list);
		foreach($tax_list as $tax_name => $tax_label){
			$terms = get_terms($tax_name,array( 'hide_empty' => true,'pad_counts'    => true ));
			 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
				 $selected_term = isset($_GET['spg_'.$tax_name])? $_GET['spg_'.$tax_name] : '';
				 $html .= '<span class="vc_span4 vc_col-md-4 wpb_column column_container spg-custom-tax"><label for="'.$tax_name.'">'.$tax_label.':</label><br>';
				 foreach ( $terms as $term ) {
					$posts_count = '';
					$get_term = str_replace( "spg_", "", $selected_term);
					 $checked_attr = ( $get_term == $term->slug ) ? 'checked="checked"' : '';
					if($tax_count == "hide")
						$posts_count = '';
					else
						$posts_count = '('.$term->count.')';
					
					$html .= '<div class="filter-input">';
				   $html .= '<input type="checkbox" '.$checked_attr.' class="spg-custom-sort-chk form_'.$uid.'" data-placeholder="&nbsp;&nbsp;'.$tax_label.'&nbsp;&nbsp;" id="'.$term->slug.'" name="spg_'.$tax_name.'[]" value="'.$term->slug.'">';
				   $html .= '<label for="'.$term->slug.'">' . $term->name . ' '.$posts_count.'</label>';
				   $html .= '</div>';
				 }
				 $html .= '</span>';
			 }
		}
		$html .= '<div class="vc_span4 vc_col-md-4 wpb_column column_container spg-custom-tax spg-filter-btn"> <input type="submit" class="button button-submit" value="'.__("Filter","infiwebs").'"/> '.$remove_filter.' </div>';
		$html .= '</form>';
		$html .= '</div><!-- end .spg-custom-sort -->';
	} elseif($enable_tax_sort == "enable" && $tax_sort_type == "radio-button") {
		$html .= '<div class="spg-custom-sort">';
		$html .= '<form method="get" id="form_'.$uid.'">';
		$cols = count($tax_list);
		foreach($tax_list as $tax_name => $tax_label){
			 $selected_term = isset($_GET['spg_'.$tax_name])? $_GET['spg_'.$tax_name] : '';
			$terms = get_terms($tax_name,array( 'hide_empty' => true,'pad_counts'    => true ));
			 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
				
				  $get_term = str_replace( "spg_", "", $selected_term);
				
				 $html .= '<span class="vc_span4 vc_col-md-4 wpb_column column_container spg-custom-tax"><label for="'.$tax_name.'">'.$tax_label.':</label><br>';
				 foreach ( $terms as $term ) {
					if($tax_count == "hide")
						$posts_count = '';
					else
						$posts_count = '('.$term->count.')';
					 $checked_attr = ( $get_term == $term->slug ) ? 'checked="checked"' : '';
					$html .= '<div class="filter-input">';
				   $html .= '<input type="radio" '.$checked_attr.' class="spg-custom-sort-chk form_'.$uid.'" data-placeholder="&nbsp;&nbsp;'.$tax_label.'&nbsp;&nbsp;" id="'.$term->slug.'" name="spg_'.$tax_name.'" value="'.$term->slug.'">';
				   $html .= '<label for="'.$term->slug.'">' . $term->name . ' '.$posts_count.'</label>';
				   $html .= '</div>';
				 }
				 $html .= '</span>';
			 }
		}
		$html .= '<div class="vc_span4 vc_col-md-4 wpb_column column_container spg-custom-tax spg-filter-btn"> <input type="submit" class="button button-submit" value="'.__("Filter","infiwebs").'"/> '.$remove_filter.' </div>';
		$html .= '</form>';
		$html .= '</div><!-- end .spg-custom-sort -->';
	}
    $html .= '<div class="vc_span12 vc_col-md-12 wpb_column column_container spg-loop-actions '.$el_class.'">
            <div class="spg-sort">';
            $sort_options = array();
            if($sortby !== ''):
                $html .= '<span class="spg-prefix">'.__('Sorting:','sortable').'</span>';
                $html .= '<select class="spg-orderby-select">';
                    foreach($sorts as $sort)
                    {
                        if(isset($_GET['set_orderby']) && ($sort == $_GET['set_orderby'])){
                                $selected = 'selected="selected"';
                        }elseif($orderby == $sort){
                            $selected = 'selected="selected"';
                        } else {
                            $selected = '';
                        }
                        if($sort == "ID")
                            $html .= '<option value="'.get_permalink().$orderby_url.'set_orderby=ID" '.$selected.'>'.__('Post ID','sortable').'</option>';
                        elseif($sort == "title")
                            $html .= '<option value="'.get_permalink().$orderby_url.'set_orderby=title" '.$selected.'>'.__('Title','sortable').'</option>';
                        elseif($sort == "date")
                            $html .= '<option value="'.get_permalink().$orderby_url.'set_orderby=date" '.$selected.'>'.__('Date','sortable').'</option>';
                        elseif($sort == "rand")
                            $html .= '<option value="'.get_permalink().$orderby_url.'set_orderby=rand" '.$selected.'>'.__('Random','sortable').'</option>';
                        elseif($sort == "none")
                            $html .= '<option value="'.get_permalink().$orderby_url.'set_orderby=none" '.$selected.'>'.__('None','sortable').'</option>';
                    }
                $html .='</select>';
            endif;
            $html .= '</div><!-- end .sort -->';
			if($disable_asc_sort !== "hide"){
                if(isset($_GET['set_orderby']))
                    $order_url = '?set_orderby='.$_GET['set_orderby'].'&';
                $html .='<span class="spg-order">
                        <a class="'.$new_order.'" data-order="'.$new_order.'" href="'.get_permalink().$order_url.'set_order='.$new_order.'" title="'.$order_desc.'">'.$order_desc.'</a>
                    </span><!-- end .order -->';
            }
            $html .= '<div class="spg-view spg-'.$display_grid_pos.'">';
            foreach($grid_views as $view => $value){
                if($value == $default_grid)
                    $active = 'current';
                else
                    $active = '';
                $html .='<a href="#" title="'.$view.'" data-type="spg-'.$value.'" class="spg-view-link spg-'.$value.'-link '.$tooltip.' '.$active.'"><i></i></a>';
            }
            $html.= '</div><!-- end .view --></div>';
    $html .= '<div id="loop-content" class="spg-loop-content switchable-view spg-'.$default_grid.' '.$el_class.'" data-view="spg-'.$default_grid.'" data-ajaxload="'.$load_ajax.'">';
        $html .= '<ul class="spg-grids spg-clear '.$animation.'">';
		$output = $thumbnail = $read_more = '';
        if($query_posts_new->have_posts()):
            while($query_posts_new -> have_posts()) : $query_posts_new -> the_post();
                $id = get_the_ID();
				$tag_list = '';
                $excerpt = get_the_excerpt();
                if($display_read_more !== ''){
                    $read_more = ' &nbsp;<a href="'.get_permalink($id).'">'.$display_read_more.'</a>';
                } else {
                    $read_more = '...';
                }
                if($length !== ''){
                    $content = strip_shortcodes(get_the_content());
                    $content = strip_tags($content);
                    $words = explode(" ",$content);
                    $excerpt = implode(" ",array_splice($words,0,$length)).$read_more;
                }
                if(has_post_thumbnail( $id )){
                    $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($id, 'full'),'full' );
                    $thumbnail = $featured_img[0];
                } else {
                    $thumbnail = $default_img;
                }
                if($excerpt_display == "enable"){
                    $excerpt_style = 'display:block;';
                } else {
                    $excerpt_style = '';
                }
                if($thumbnail == '')
                    $thumbnail = $default_img;
				if(!empty($tax_meta_list)){
					foreach($tax_meta_list as $name => $label){
						if($tax_label_meta !== "hide")
							$tax_labels = '<span class="spg-meta-label">'.$label.':</span>';
						else
							$tax_labels = '';
						$tag_list .= get_the_term_list( $id, $name, $tax_labels.'<span class="spg-meta-tags">', ',', '</span>' );
					}
				}
                $output .= '<li class="spg-item spg-item-img" data-animate="animate">';
				//$output .= $post->ID;
                $output .= '<div class="spg-thumb">';
                
                if(!$img_overlay_hide){
					$output .= '<span class="spg-clip"><img src="'.$thumbnail.'"/>';
                    $output .= '<span class="spg-overlay" style="'.$overlay.'">';
					if($post_quickview !== ''){
						$n = $post_count--;
						/*
						$adjacent_post_next = get_adjacent_post(false,'',true);
						$adjacent_post_prev = get_adjacent_post(false,'',false);
						if($n !== 1){
							$next_post_id = $adjacent_post_next->ID;
						} else {
							$next_post_id = '';
						}
						if($n == 10){
							$prev_post_id = '';
						} else {
							$prev_post_id = $adjacent_post_prev->ID;
						}
						*/
						$output .= '<a href="#" class="spg-clip-overview post-id-'.$post->ID.'" data-post-id="'.$id.'" data-title="'.$post_quickview_title.'">
									<span class="spg-overlay-quick-view"></span></a>';
					} else {
						$overlay_link_img .= ' left:0;';
					}
					$output .= '<a href="'.get_permalink($id).'" class="spg-clip-link">
								<span class="spg-overlay-link" style="'.$overlay_link_img.'"></span></a>';
					$output .= '</span>';
					$output .= '</span>';
                } else {
					$output .= '<a href="'.get_permalink($id).'" class="spg-clip-link"><span class="spg-clip"><img src="'.$thumbnail.'"/></span></a>';
				}
				
                $output .= '</div>';
                $output .= '<div class="spg-data"><span class="spg-entry-title"><a style="'.$style.'" href="'.get_permalink($id).'"><h3>'.get_the_title($id).'</h3></a></span>';
				if($hide_date !== "hide"){
                	$output .= '<span class="spg-post-date">'.get_the_date() .'</span>';
				}
				if($tax_meta == "display"){
					$output .= '<span class="spg-post-meta">'.$tag_list.'</span>';
				}
                $output .= '<p class="spg-entry-summary" style="'.$excerpt_style.'">'.$excerpt.'</p></div>';
                $output .= '</li>';
            endwhile;
		else:
			$output .= '<h3 style="padding-top:30px; text-align: center;">'.$custom_msg.'</h3>';
        endif;
        $html .= $output.'</ul>';
    $html .= '</div>';
    // pagination
    ob_start();
    
    require_once('pagination.php');
    
    spg_pagination($pages,3);
    
    wp_reset_postdata();
    
    $html .= ob_get_clean();
    
    return $html;
    
    ob_clean();
}//end postgrid_normal()
