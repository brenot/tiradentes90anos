<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Widget Name: Essence Latest Tweets
 * Widget Description: Display Lastest Tweets
 * Widget Function Name: _lastest_tweets
 * Widget Text Domain: essence-core
 *
 */

class EssenceCore_WidgetLatestTweets extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname'     =>  '',
            'description'   =>  __('Display Lastest Tweets', 'essence-core')
        );

        $control_ops = array( 'width' => 400, 'height' => 0);
        parent::__construct(
            'EssenceCore_WidgetLatestTweets',
            __('Essence Latest Tweets', 'essence-core'),
            $widget_ops, $control_ops
        );

    }


    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );

        $tweets_html = '';

        if ( function_exists( 'getTweets' ) ) {
            $tweets = getTweets( false, 3 );

            if ( is_array( $tweets ) ) {

                $tweets_li_html = '';
                foreach ( $tweets as $tweet ):

                    if ( $tweet['text'] ) {
                        $tweets_li_html .= '<li>';

                        $created_time = '';
                        if ( isset( $tweet['created_at'] ) ) {
                            $created_time = human_time_diff( strtotime($tweet['created_at']), current_time('timestamp') );
                        }
                        $tweets_li_html .= $tweet['text'];
                        $tweets_li_html .= '<span class="twitter-time">' . sprintf( __( '%s ago', 'essence-core' ), $created_time ) . '</span>';
                        $tweets_li_html .= '</li>';

                    }

                endforeach;

                $tweets_html .= '<ul class="twitter-list essence-owl-carousel owl-carousel" data-number="1" data-navcontrol="false" data-dots="yes">';
                $tweets_html .= $tweets_li_html;
                $tweets_html .= '</ul><!-- /.twitter-list -->';
                $tweets_html .= '<a href="http://www.twitter.com/' . get_option( 'tdf_user_timeline' ) . '" target="_blank">'. esc_html__('VIEW ALL TWEETS','') .'<span class="arrow_right"></span></a> ';

            }

        }

        // before and after widget arguments are defined by themes 
        echo $args['before_widget'];
        ?>

        <h5><?php echo $title; ?></h5>
        <?php echo $tweets_html; ?>

        <?php
        echo $args['after_widget'];
    }



    public function form( $instance ) {
        if ( isset( $instance['title'] )) {
            $title = $instance['title'];
        }
        else {
            $title = __('Latest Tweets', 'essence-core');
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'essence-core' ); ?>: </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"  />
        </p>
        <?php
    }



    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

} // End class ts_widget_lastest_news 

function EssenceCore_init_WidgetLatestTweets() {
    register_widget( 'EssenceCore_WidgetLatestTweets' );
}
add_action( 'widgets_init', 'EssenceCore_init_WidgetLatestTweets' );