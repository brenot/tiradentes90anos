<?php 
/**
 * Widget Name: Essence Core LatestPosts
 * Widget Description: Display the Form Login
 * Widget Text Domain: essence-core
 * 
 */

class EssenceCore_WidgetLatestPosts extends WP_Widget { 

    function __construct() {
        $widget_ops = array( 
            'classname'     =>  '', 
            'description'   =>  __( 'Display the lastest posts of selected category', 'essence-core' ),
        );

        $control_ops = array( 'width' => 400, 'height' => 0); 
        parent::__construct( 
            'EssenceCore_Widget_Latest_Posts', 
            __('Essence Core - Latest Posts', 'essence-core'), 
            $widget_ops, $control_ops
        );

    }

    public function widget( $args, $instance ) {
        global $post; 

        $title = apply_filters( 'widget_title', $instance['title'] ); 
        $cat_id = isset( $instance['cat_id'] ) ? intval( $instance['cat_id'] ) : 0;
        $limit = isset( $instance['limit'] ) ? intval( $instance['limit'] ) : 2;

        // before and after widget arguments are defined by themes 
        echo  $args['before_widget'];   
        extract( $args );

        $query_args = array(
            'showposts'     =>  $limit,
            'post_status'   =>  array( 'publish' ),
        );

        if ( $cat_id > 0 ) {
            $query_args['cat'] = $cat_id;
        }

        $query_posts = new WP_Query( $query_args );
        ?>

        <?php if ( trim( $title ) != '' ): ?>
            <div class="ts-sidebar-widget">
                <?php echo  $before_title . $title . $after_title ; ?>
            </div>    
        <?php endif; ?>

        <?php if ( $query_posts->have_posts() ): ?>
            <div class="sidebar-latest-posts clearfix">
            <?php while ( $query_posts->have_posts() ): $query_posts->the_post(); ?>
                <?php $thumb = essence_core_resize_image(get_post_thumbnail_id(),null,80,60,true,false,false); ?>
                <div class="sidebar-latest-post-item">
                    <?php if ( $thumb['url'] != '' ): ?>
                        <a href="<?php the_permalink(); ?>"><img width="<?php echo esc_attr( $thumb['width'] ); ?>" height="<?php echo esc_attr( $thumb['height'] ); ?>" src="<?php echo esc_url( $thumb['url'] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
                    <?php endif; ?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </div>

            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php    

        wp_reset_postdata();

        echo  $args['after_widget']; 
    }



    public function form( $instance ) {
        if ( isset( $instance['title'] )) { 
            $title = $instance['title'];  
        }
        else { 
            $title = __('Latest Posts', 'essence-core'); 
        }

        $cat_id = isset( $instance['cat_id'] ) ? intval( $instance['cat_id'] ) : 0;
        $limit = isset( $instance['limit'] ) ? intval( $instance['limit'] ) : 2;

        // Widget admin form
        ?> 
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'essence-core' ); ?>: </label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"  />
        </p>

        <?php if ( function_exists( 'stay_humble_custom_tax_select' ) ): ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php _e( 'Select category', 'essence-core' ); ?></label>
                <?php 
                    echo stay_humble_custom_tax_select( 
                        array( $cat_id ), 
                        array( 
                            'tax'   => 'category',
                            'class' => 'ts-cat-select widefat', 
                            'id'    => $this->get_field_id( 'cat_id' ),
                            'name'  => $this->get_field_name( 'cat_id' ),
                            'first_option' => true,
                            'first_option_val'  =>  '0',
                            'first_option_text' =>  __( ' --- All Categories --- ', 'essence-core' ),
                        ) 
                    );
                ?>
            </p>
        <?php else: ?>
            <?php _e( 'Please install and active plugin Stay Humble Core', 'essence-core' ); ?>
        <?php endif; ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit', 'essence-core' ); ?>: </label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>"  />
        </p>

        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array(); 
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['cat_id'] = ( ! empty( $new_instance['cat_id'] ) ) ? intval( $new_instance['cat_id'] ) : 0;
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? intval( $new_instance['limit'] ) : 2;
        return $instance;
    }

} // End class ts_widget_lastest_news 
function EssenceCore_init_WidgetLatestPosts() {
    register_widget( 'EssenceCore_WidgetLatestPosts' );
}
add_action( 'widgets_init', 'EssenceCore_init_WidgetLatestPosts' );