<?php
/**
 * Widget Name: Essence Core LatestPosts
 * Widget Description: Display the Form Login
 * Widget Text Domain: essence-core
 * 
 */
class EssenceCore_WidgetRecentPosts extends WP_Widget {
	 function __construct() {
		$widget_ops = array('classname' => '', 'description' => 'The recent posts with thumbnails' );				
        $control_ops = array( 'width' => 400, 'height' => 0); 
        parent::__construct( 
            'EssenceCore_Widget_Recent_Posts', 
            __('Essence Core - Recent Posts', 'essence-core'), 
            $widget_ops, $control_ops
        );
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$items = empty($instance['items']) ? '3' : apply_filters('widget_number', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = intval($items);
		}
		
		if($title != ''){
			echo $before_title.$title.$after_title;
		}
		

		echo '<ul class="recent_posts_list">';
    		
			$args = array( 
				'numberposts' => $items,
				'orderby' => 'ID',
    			'order' => 'DESC',
                'ignore_sticky_posts'   => 1
    		);
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $recent ) {
                $comment_count = (int)$recent['comment_count'];
                if ( $comment_count > 1) {
                    $str_comment_count = $comment_count . '&nbsp;' . __('Comments', 'essence-core');
                } elseif ($comment_count == 1) {
                    $str_comment_count = $comment_count . '&nbsp;' . __('Comment', 'essence-core');
                } else {
                    $str_comment_count = '0 &nbsp;' . __('Comment', 'essence-core');
                }
				echo '<li>';
					echo '<span class="post-img">';
						echo '<a href="'.get_permalink($recent["ID"]).'">';
						if (strlen(get_the_post_thumbnail( $recent["ID"], array('60','60') )) ) {
							echo get_the_post_thumbnail( $recent["ID"], array('60','60') );
						}else{
							echo '<img alt="Image" src="'.get_template_directory_uri().'/assets/images/defaults/ts_no_image-90x90.png" />';
						}						
						echo '</a>';
					echo '</span>';
					echo '<a  class="title-post" href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a><span class="number-comment">'.$str_comment_count.'</span>';
				echo '</li>';
			}
		
		echo '</ul>';
		
		echo $after_widget;
		wp_reset_postdata();		
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent Posts', 'items' => '3') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

    ?>
    	<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget title', 'essence-core'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
    	<p>
            <label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items (default 2)', 'essence-core'); ?>:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" />
        </p>
    <?php
	}
}

// End class ts_widget_lastest_news 
function EssenceCore_init_WidgetRecentPosts() {
    register_widget( 'EssenceCore_WidgetRecentPosts' );
}
add_action( 'widgets_init', 'EssenceCore_init_WidgetRecentPosts' );