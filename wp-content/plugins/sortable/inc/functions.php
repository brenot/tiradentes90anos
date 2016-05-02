<?php
add_filter( 'page_template', 'sortable_page_template' );
function sortable_page_template( $page_template )
{
    $pages = get_pages('meta_key=sortable'); 
		  foreach ( $pages as $page ) {
			if(is_page($page->ID)){
			$page_template = dirname( __FILE__ ) . '/page-template.php';
			}
		
		  }
     /*if(get_option( 'page_for_posts' )!='0'){   
		if(is_page(get_option( 'page_for_posts' ))){
		$page_template = dirname( __FILE__ ) . '/page-template.php';
		}
		}
		*/
    return $page_template;
}

function sortable_init_object(){
	$sortable = new sortable();
	if (class_exists('sortable_extend_1')) {
		$sortable = new sortable_extend_1();
	} 
	if (class_exists('sortable_extend_2')) {
		$sortable = new sortable_extend_2();
	}
	if (class_exists('sortable_extend_3')) {
		$sortable = new sortable_extend_3();
	}
	if (class_exists('sortable_extend_4')) {
		$sortable = new sortable_extend_4();
	}
	if (class_exists('sortable_extend_5')) {
		$sortable = new sortable_extend_5();
	}
	if (class_exists('sortable_extend_6')) {
		$sortable = new sortable_extend_6();
	}
	if (class_exists('sortable_extend_7')) {
		$sortable = new sortable_extend_7();
	}
	if (class_exists('sortable_extend_8')) {
		$sortable = new sortable_extend_8();
	}
	if (class_exists('sortable_extend_9')) {
		$sortable = new sortable_extend_9();
	}
	return $sortable;
}

// Same handler function...
add_action( 'wp_ajax_sortable', 'sortable_callback' );
add_action( 'wp_ajax_nopriv_sortable', 'sortable_callback' );
function sortable_callback() {
	global $wpdb;
	$sortby = $_POST['sortby'];
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
	}else { $html = '<p>Sorry, no posts matched your criteria.</p>';}
	echo '<div class="sortable-loading">
		<span>
			<img src="'.plugins_url().'/sortable/img/loading.gif" />
		</span>
	</div>'.
	$html.$pagination;
	wp_die();
}


add_action( 'wp_ajax_sortable_count', 'sortable_count_callback' );
add_action( 'wp_ajax_nopriv_sortable_count', 'sortable_count_callback' );
function sortable_count_callback() {
	global $wpdb;
	
	$post_type = $_REQUEST['post_type'];
	
		$args = array(
			'post_type' => $post_type, 
			'posts_per_page' => -1,
			'ignore_sticky_posts'=>true
				);
		 
$the_query = new WP_Query( $args ); 			
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
	
	$sortable_cache_time = get_option( 'sortable_cache_time' );
			$sortable_cache =get_option( 'sortable_cache' ) * 60;
			$time=  time();
			$sortable_cache_social = get_post_meta( get_the_ID(),'sortable_cache_social',true );
			$time20Min = $sortable_cache_time+$sortable_cache;
			$cache=false;
			if ( get_option( 'sortable_cache' ) !== false && get_option( 'sortable_cache' )!='0') {
				if($time20Min>=$time){
				$cache = true;
				} else {
				update_option( 'sortable_cache_time', $time );
				$cache = false;
				}
				
			} else {
			add_option('sortable_cache_time', $time );
			$cache = false;
			}	


		$link = get_the_permalink();	
				

			if(!$cache){
				global 	$sortableNetworks;
				global $sortableNetworksPostId;
				$sortableNetworksPostId=get_the_ID();
				$sortableNetworkCountAll = '';
				$sortableNewtworksHMTL = '';
				if(!empty($sortableNetworks)){
					foreach($sortableNetworks as $sortableNetwork){
							$sortableNetworkCount  = call_user_func($sortableNetwork, $post_id);
							$sortableNetworkCountAll .= '|'.$sortableNetworkCount;
							$nameArr = explode('_',$sortableNetwork);
							$sortableNewtworksHMTL .= '<span>'.$sortableNetworkCount.' '.$nameArr[1].' shares</span>';
					}	
				}
				$fb = sort_facebook_counter($link,false);
				$tw = sort_twitter_counter($link,false);
				$pin = sort_pinterest_counter($link,false);
				$lin = sort_linkedin_counter($link,false);
				$st = sort_stumbleupon_counter($link,false);
				$gp = sort_google_plus_counter($link,false);	
				$sortable_cache_social = $fb.'|'.$tw.'|'.$pin.'|'.$lin.'|'.$st.'|'.$gp;	
					if (get_post_meta( get_the_ID(),'sortable_cache_social',true ) !== false ) {
					update_post_meta(get_the_ID(), 'sortable_cache_social', $sortable_cache_social );
					} else {
					 add_post_meta(get_the_ID(),  'sortable_cache_social', $sortable_cache_social );
					}	
			}
			$sortable_cache_social_total .=	$link.'*'.$sortable_cache_social.'***';
	endwhile;
		if(!$cache) echo 'Cache: false'; else echo 'Cache: true';
	wp_die();
}


add_action( 'wp_ajax_sortable_count_all', 'sortable_count_all_callback' );
add_action( 'wp_ajax_nopriv_sortable_count_all', 'sortable_count_all_callback' );
function sortable_count_all_callback() {
	global $wpdb;
	
	$post_type = $_REQUEST['post_type'];
	$paged = $_REQUEST['paged'];

		$args = array(
			'post_type' => $post_type, 
			'paged' => $paged,
			'posts_per_page' => 10,
			'ignore_sticky_posts'=>true
				);
	$the_query = new WP_Query( $args ); 			
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
		$sortable_cache_time = get_option( 'sortable_cache_time' );
			$sortable_cache =get_option( 'sortable_cache' ) * 60;
			$time=  time();
			$sortable_cache_social = get_post_meta( get_the_ID(),'sortable_cache_social',true );
			$time20Min = $sortable_cache_time+$sortable_cache;
			$cache=false;
			if ( get_option( 'sortable_cache' ) !== false && get_option( 'sortable_cache' )!='0') {
				if($time20Min>=$time){
				$cache = true;
				} else {
				update_option( 'sortable_cache_time', $time );
				$cache = false;
				}
				
			} else {
			add_option('sortable_cache_time', $time );
			$cache = false;
			}	
			$link = get_the_permalink();	
				
			
				global 	$sortableNetworks;
				global $sortableNetworksPostId;
				$sortableNetworksPostId=get_the_ID();
				$sortableNetworkCountAll = '';
				$sortableNewtworksHMTL = '';
				if(!empty($sortableNetworks)){
					foreach($sortableNetworks as $sortableNetwork){
							$sortableNetworkCount  = call_user_func($sortableNetwork, $post_id);
							$sortableNetworkCountAll .= '|'.$sortableNetworkCount;
							$nameArr = explode('_',$sortableNetwork);
							$sortableNewtworksHMTL .= '<span>'.$sortableNetworkCount.' '.$nameArr[1].' shares</span>';
					}	
				}
				$fb = sort_facebook_counter($link,false);
				$tw ='';
				//$tw = sortable_twitter_network($post_id,false);
				$pin = sort_pinterest_counter($link,false);
				$lin = sort_linkedin_counter($link,false);
				$st = sort_stumbleupon_counter($link,false);
				$gp = sort_google_plus_counter($link,false);	
				$sortable_cache_social = ''.$fb.'|'.$tw.'|'.$pin.'|'.$lin.'|'.$st.'|'.$gp.$sortableNetworkCountAll;	
					if (get_post_meta( get_the_ID(),'sortable_cache_social',true ) !== false ) {
					update_post_meta(get_the_ID(), 'sortable_cache_social', $sortable_cache_social );
					} else {
					 add_post_meta(get_the_ID(),  'sortable_cache_social', $sortable_cache_social );
					}	
			
			
			echo '<div class="slink">'.$link.'</br>';
			//if(!$cache) echo '111'; else echo '222';
			echo '<span>'.$fb.' Facebook shares</span><span>'.$pin.' Pinterest shares</span><span>'.$lin.' LinkedIn shares</span><span>'.$st.' StumbleUpon shares</span><span>'.$gp.' Google Plus shares</span>';		
			echo $sortableNewtworksHMTL.'</div>';
		
	endwhile;
		
	wp_die();
}


?>