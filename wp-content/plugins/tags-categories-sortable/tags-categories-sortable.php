<?php
/*
    Plugin Name: Tags & Categories Sortable Addon
    Plugin URI: http://wpicode.com/sortable-categories
    Description: Filter for categories, tags and any other custom taxonomy
    Version: 1.0
    Author: Wpicode
    Author URI: http://wpicode.com


*/

include_once('inc/functions.php');

if (!class_exists('sortable_extend_1')) {

	class sortable_extend_1 extends sortable{
		
		public function get_filters($post_type){
			$categoriesList ='';
			$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
			foreach ( $taxonomy_objects as $taxonomy_object ) {
				$taxinomies =$taxonomy_object->name;
				
				$categoriesList .= '<div class="sortable-dropdown sortable-drop-'.$taxinomies.'">
					<div class="sortable-dropdown-toggle">'.$taxonomy_object->labels->name.'</div>
					<ul class="sortable-dropdown-ul sortable-taxonomy-ul" tax="'.$taxinomies.'">
					<li id="'.$taxinomies.'*all" catid="all" class="sortable-tax-all sortable-selected" >All '.$taxonomy_object->labels->name.'</li>';
				$args = array( 'hide_empty' => 0 );
				$terms = get_terms($taxinomies, $args);
				foreach ( $terms as $term ) {
				   $categoriesList .= '<li id="'.$taxinomies.'*'.$term->term_id.'" catid="'.$term->term_id.'" >' .$term->name . '</li>';
				 }
				$categoriesList .= '</ul></div> '; 
			}
			return $categoriesList;
		}
		public function colorStyleMobile($rand,$color){
			return '.sortable-top { min-height:260px; }';
		}
		public function htmlStyle($rand,$color){
			return '
			.sortable-description .more-link:nth-child(2){display:none; }
			#sortableTop'.$rand.' .sortable-dropdown-toggle { min-width:210px !important; }
			#sortableTop'.$rand.' ul.sortable-dropdown-ul { margin-bottom: 10px; min-height: 39px;  border: 1px solid #ddd;  }
			#sortableTop'.$rand.' ul.sortable-taxonomy-ul li{ cursor:pointer;  border: 1px solid #ddd;  color: #333;  cursor: pointer display: block;  float: left;  font-size: 14px;  margin: 5px !important; padding: 5px; }
			#sortableTop'.$rand.' ul.sortable-taxonomy-ul li:hover { background-color:#ddd;  color:#000; }
			#sortableTop'.$rand.' ul.sortable-taxonomy-ul li ul{ list-style:none; margin:0px !important; padding:0px !important;}
			#sortableTop'.$rand.' ul.sortable-taxonomy-ul li ul li{ margin:0px !important; padding:5px 5px 5px 15px; border-top:none; font-size:13px; }
			#sortableTop'.$rand.' ul.sortable-taxonomy-ul li.sortable-selected { background-color:'.$color.'; color:#fff; }
			';
		}
		public function get_query($sortby,$post_type,$per_page,$paged,$rand,$sort_social_media,$custom,$args){
				global $wpdb; global 	$sortableNetworks;
				$orderby = 'date'; $order= 'DESC';
				if($sortby == 'a-z'){ $orderby='title'; $order ='ASC'; } 
				if($sortby == 'z-a'){ $orderby='title'; $order ='DESC'; } 
				if($sortby == 'oldest'){ $orderby='date'; $order ='ASC'; } 
				if($sortby == 'comments'){ $orderby = 'comment_count'; $order = 'DESC';}
				$terms = $_REQUEST['terms'];
				$tax_query_array= '';
					if($terms!=''){
					$termsArr = explode('|',$terms);
					$tax_query_array = array('relation' => 'AND');
					foreach($termsArr as $t){
						//$html .=$t.'<br>';
						if($t!=''){
						$tArr = explode('*',$t);
							if($tArr[1]!='all,'){
							$t1Arr = explode(",",$tArr[1]);
							$t1Arr = array_filter($t1Arr);
							$tax_query_array[] = array(
								'taxonomy' => $tArr[0],
								'field'    => 'term_id',
								'terms'    => $t1Arr
							);
							}
						}	
					}
					}
				$args = array(
						'post_type' => $post_type, 
						'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order'   => $order,
						'ignore_sticky_posts'=>true,
						'paged' =>$paged,
						'tax_query' => $tax_query_array
							);
				if($sortby=='social_status' || $sortby=='social_facebook' || $sortby=='social_twitter' || $sortby=='social_pinterest'
				 || $sortby=='social_linkedin' || $sortby=='social_stumbleupon' || $sortby=='social_google_plus' || $sortby=='custom'){
				$args = array(
						'post_type' => $post_type, 
						'posts_per_page' => -1,
						'orderby' => $orderby,
						'order'   => $order,
						'ignore_sticky_posts'=>true,
						'paged' =>$paged,
						'tax_query' => $tax_query_array
							);
				}	 
			
			return new WP_Query( $args ); 
		}		
		
	}
function sortcat_scripts_method(){
	   wp_register_script( 'sortcats', plugins_url('js/sortcats.js', __FILE__));
        wp_enqueue_script( 'sortcats' );	
			wp_localize_script( 'sortcats', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
}
add_action('wp_enqueue_scripts', 'sortcat_scripts_method');
} else {

}

?>