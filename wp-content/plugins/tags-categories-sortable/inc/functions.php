<?php


function get_sortable_cats_loop($sortby,$post_type,$per_page,$paged,$rand,$sort_social_media,$custom){
	global $wpdb;
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
	$the_query = new WP_Query( $args ); 
	$htmlArr = array();
	$total  = $the_query->found_posts;
	 if ( $the_query->have_posts() ){
	$i=0; $irev = $total;
	//$links = array('http://ikea.com','http://cc.com','http://time.mk');
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
	//foreach($links as $link){
		
		$link = get_the_permalink();
	   	$sortable_translate = get_option('sortable_translate');
		$sortable_translate_arr = explode('|',$sortable_translate);		
		$exerpt = get_the_excerpt().' <a class="more-link" href="'. get_permalink($post->ID) . '">'.$sortable_translate_arr[13].'</a>';
		if($custom==true){
			$customHTML = '';
		}
		$total = 0;
		if($sortby=='social_status' || $sortby=='social_facebook' || $sortby=='social_twitter' ||
		$sortby=='social_pinterest' || $sortby=='social_linkedin' || $sortby=='social_stumbleupon' || $sortby=='social_google_plus'){
			
			$sortable_cache_time = get_option( 'sortable_cache_time' );
			$sortable_cache =get_option( 'sortable_cache' ) * 60;
			$time=  time();
			$sortable_cache_social = get_post_meta( get_the_ID(),'sortable_cache_social',true );
			$time20Min = $sortable_cache_time+$sortable_cache;
	

			if(!$sortable_cache_social){
				$fb = 0;
				$tw = 0;
				$pin = 0;
				$lin = 0;
				$st = 0;
				$gp = 0;	
				$sortable_cache_social = $fb.'|'.$tw.'|'.$pin.'|'.$lin.'|'.$st.'|'.$gp;	
				//add_post_meta(get_the_ID(),  'sortable_cache_social', $sortable_cache_social );
						

			} else {
				$sortable_cache_social_arr = explode('|',$sortable_cache_social);
				$fb = $sortable_cache_social_arr[0]; $tw= $sortable_cache_social_arr[1]; $pin = $sortable_cache_social_arr[2];
				$lin = $sortable_cache_social_arr[3]; $st= $sortable_cache_social_arr[4]; $gp = $sortable_cache_social_arr[5];
			}
			if(preg_match('/facebook/i',$sort_social_media))$total = $total+$fb;
			if(preg_match('/twitter/i',$sort_social_media))$total = $total+$tw;
			if(preg_match('/pinterest/i',$sort_social_media))$total = $total+$pin;
			if(preg_match('/linkedin/i',$sort_social_media))$total = $total+$lin;
			if(preg_match('/stumbleupon/i',$sort_social_media))$total = $total+$st;
			if(preg_match('/google/i',$sort_social_media))$total = $total+$gp;
			
		}
		$thumbnail =wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbnail' );
		$thumbMedium = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'medium' );
		$thumbLarge = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'large' );
		if($sortby=='social_status') $sortbyid = $total.'.'.$irev;
		if($sortby=='social_facebook') $sortbyid = $fb.'.'.$irev;
		if($sortby=='social_twitter') $sortbyid = $tw.'.'.$irev;
		if($sortby=='social_pinterest') $sortbyid = $pin.'.'.$irev;
		if($sortby=='social_linkedin') $sortbyid = $lin.'.'.$irev;
		if($sortby=='social_stumbleupon') $sortbyid = $st.'.'.$irev;
		if($sortby=='social_google_plus') $sortbyid = $gp.'.'.$irev;
		if($sortby=='a-z') $sortbyid = $i;
		if($sortby=='z-a') $sortbyid = $i;
		if($sortby=='newest' || $sortby=='oldest') $sortbyid = $i;
		if($sortby=='comments') $sortbyid = $i;
		$customMeta = get_post_meta(get_the_ID(),get_option('sortable_custom_meta'),true);
		if(!$customMeta || $customMeta=='' || $customMeta=='undefined') $customMeta =0;
		if($sortby=='custom') $sortbyid = $customMeta.'.'.$i;
		$customHTML ='';
		if($custom) $customHTML = '<p class="sortable-custom-text">'.get_option('sortable_custom_text').': '.get_option('sortable_premetatext').'<span>'.$customMeta.'</span></p>';
		
		/* $taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
		$taxonomy_objects = array_filter($taxonomy_objects);
		foreach($taxonomy_objects as $taxObject){
			$postTax =$taxObject->rewrite;
			$terms = wp_get_post_terms( get_the_ID(), $postTax['slug'] );

			$termsHTML .= '';

			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term );
				if ( is_wp_error( $term_link ) ) {
					continue;
				}
				$termsHTML .= ' <a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
			}
			$termsHTML .= ' ';
		}
		*/
		
		$htmlArr[$sortbyid] = '
				<div class="sortable-row" paged="'.$paged.'" perpage="'.$per_page.'">
				<div class="sortable-col-4 sort-image-wrap" onclick="location.assign(\''.get_the_permalink().'\');"
				style="background:url('.$thumbLarge[0].') no-repeat center center #999;"
				thumbnail="'.$thumbnail[0].'"
				 medium="'.$thumbMedium[0].'"
				  large="'.$thumbLarge[0].'"
				   url="'.wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ).'">
				   <div style="display:none"><a href="'.get_the_permalink().'">'.get_the_post_thumbnail( get_the_ID(), 'medium' ).'</a></div>
				 </div>
				<div class="sortable-col-8">'.$customHTML.'
				<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
				<p class="sortable-post-meta"><span class="sortable-postedby">Posted by</span> '.  get_the_author_meta( 'nickname').' <span class="sortable-on">on</span> '.get_the_date('M d, Y').'</p>
				<div class="sortable-description">'.$exerpt.'</div>
				
				<div class="social-share-stats"><h4>Social Share Stats</h4><strong>'.$fb.' <i class="fa fa-facebook"></i></strong>  <strong>'.$tw.' <i class="fa fa-twitter"></i></strong>
				 <strong>'.$gp.' <i class="fa fa-google-plus"></i></strong> <strong>'.$st.' <i class="fa fa-stumbleupon"></i></strong>  
				  <strong>'.$pin.' <i class="fa fa-pinterest"></i></strong>  <strong>'.$lin.' <i class="fa fa-linkedin"></i></strong> 
				</div>
				</div>
				</div>';
		
		$i++; $irev = $irev-1;
	//} 	
	endwhile;



	if($sortby=='social_status' || $sortby=='social_facebook' || $sortby=='social_twitter' || $sortby=='social_pinterest'
	 || $sortby=='social_linkedin' || $sortby=='social_stumbleupon' || $sortby=='social_google_plus' || $sortby=='custom'){ 
		$countTotal = count($htmlArr)/$per_page;
	
		$countTotalArr = explode('.',$countTotal); $countTotalNew = $countTotalArr[0];
	   $total = number_format($countTotalNew,0);
	   if(isset($countTotalArr[0])){
			if($countTotalArr[0]>0) $total = $total+1;
	   }
	 } else {
	  $total = $the_query->max_num_pages;
	 }

	
	if($sortby=='social_status' || $sortby=='social_facebook' || $sortby=='social_twitter' || $sortby=='social_pinterest'
	 || $sortby=='social_linkedin' || $sortby=='social_stumbleupon' || $sortby=='social_google_plus'){
		krsort($htmlArr); $p = 1; $pi =1; $htmlArrNew =array();
		foreach($htmlArr as $htmlArrItem){
			if($p==$paged){
				$htmlArrNew[] = $htmlArrItem;
			}
			if($pi==$per_page){ 
				$pi=0; $p++;
			}
			$pi++;
		}
		$htmlArr = $htmlArrNew; 
	}
	 if($sortby=='custom'){
	 if(get_option('sortable_custom_order')=='ASC' || get_option('sortable_custom_order')==''){ ksort($htmlArr);} else { krsort($htmlArr); }
		
		$p = 1; $pi =1; $htmlArrNew =array();
		foreach($htmlArr as $htmlArrItem){
			if($p==$paged){
				$htmlArrNew[] = $htmlArrItem;
			}
			if($pi==$per_page){ 
				$pi=0; $p++;
			}
			$pi++;
		}
		$htmlArr = $htmlArrNew; 
	 }
	//pagination 

	 $pagedPrev = $paged-1;
	 $pagedNext = $paged+1;
	 $pagination = '';
		$i=1;
		if($total>0){
		$pagination .= '<div style="clear:both"></div>
		  <ul id="sortable-pagination-'.$rand.'" class="sortable-pagination" rand="'.$rand.'">';
		if($pagedPrev>0) $pagination .=	'<li>
			  <a href="#" aria-label="Previous" sort-by="'.$sortby.'" post-type="'.$post_type.'" per-page="'.$per_page.'" paged="'.$pagedPrev.'" >
				<span aria-hidden="true">&laquo;</span>
			  </a>
			</li>';
		do{
		if($i==$paged) $pagination .= '<li class="active">'.$i.' <span class="sr-only">(current)</span></li>';
		else $pagination .= '<li><a href="#"  sort-by="'.$sortby.'" post-type="'.$post_type.'" per-page="'.$per_page.'" paged="'.$i.'" >'.$i.'</a></li>';
		$i++;
		}while ($i<=$total);
			
		if($pagedNext<=$total) $pagination .= 	'<li>
			  <a href="#" aria-label="Next" sort-by="'.$sortby.'" post-type="'.$post_type.'" per-page="'.$per_page.'" paged="'.$pagedNext.'" >
				<span aria-hidden="true">&raquo;</span>
			  </a>
			</li>';
		$pagination .=	  '</ul>';
		}
	 } else{
		$htmlArr = '-';
	 } 
		return array($htmlArr,$pagination);
}

// Same handler function...
add_action( 'wp_ajax_sortable2', 'sortable2_callback' );
add_action( 'wp_ajax_nopriv_sortable2', 'sortable2_callback' );
function sortable2_callback() {
	global $wpdb;
	$sortby = $_POST['sortby'];
	$terms = $_POST['terms'];
	$post_type = $_POST['post_type'];
	$per_page = $_POST['per_page'];
	$html =''; // echo $sortby.'|'.$post_type.'|'.$per_page;
	$rand = $_POST['rand'];
	$paged = $_POST['paged'];
	$sort_social_media = $_POST['sort_social_media'];
	$custom =false;
	if($sortby=='custom')$custom=true;
	$sortable = sortable_init_object();
	$sortable->init();
	list ($htmlArr,$pagination) = $sortable->get_sortable_loop($sortby,$post_type,$per_page,$paged,$rand,$sort_social_media,$custom);
	if($htmlArr!='-'){
		foreach($htmlArr as $total=>$item){
			$html.= $item;
		}
	}else { 
	//	$terms = 'portfolio_category*3,|portfolio_skills*all,|portfolio_tags*all,|';

	$html .= print_r($tax_query_array,true).'<p>Sorry, no posts matched your criteria.</p>';}
	echo '<div class="sortable-loading">
		<span>
			<img src="'.plugins_url().'/sortable/img/loading.gif" />
		</span>
	</div>'.
	$html.$pagination;
	wp_die();
}


?>