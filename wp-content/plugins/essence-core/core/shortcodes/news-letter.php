<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_NewsLetter' );
function essence_core_VC_MAP_NewsLetter() {
    global $ts_vc_anim_effects_in;
    vc_map( array( 'name' => __( 'Essence Core Newsletter', 'essence-core' ), 'base' => 'essence_core_news_letter', // shortcode
                'class' => '', 'category' => __( 'Essence', 'essence-core' ), 'params' => array( array( 'type' => 'textarea', 'holder' => 'div', 'class' => '', 'heading' => __( 'Short Description', 'essence-core' ), 'param_name' => 'short_desc', 'std' => __( 'by subscribing to our newsletter', 'essence-core' ), ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Submit Text', 'essence-core' ), 'param_name' => 'submit_text', 'std' => __( 'Subscribe', 'essence-core' ), ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Placeholder Text', 'essence-core' ), 'param_name' => 'placeholder', 'std' => __( 'Your email address...', 'essence-core' ), ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Success Message', 'essence-core' ), 'param_name' => 'success_message', 'std' => __( 'Your email added...', 'essence-core' ), ), array( 'type' => 'dropdown', 'holder' => 'div', 'class' => '', 'heading' => __( 'Using Theme Options', 'essence-core' ), 'param_name' => 'using_theme_options_api_settings', 'value' => array( __( 'Yes', 'essence-core' ) => 'yes', __( 'No', 'essence-core' ) => 'no' ), 'std' => 'yes', 'group' => __( 'Mailchimp Settings', 'essence-core' ), ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Mailchimp API Key', 'essence-core' ), 'param_name' => 'api_key', 'description' => sprintf( __( '<a href="%s" target="__blank">Click here to get your Mailchimp API key</a>', 'essence-core' ), 'https://admin.mailchimp.com/account/api' ), 'dependency' => array( 'element' => 'using_theme_options_api_settings', 'value' => array( 'no' ) ), 'group' => __( 'Mailchimp Settings', 'essence-core' ), ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Mailchimp List ID', 'essence-core' ), 'param_name' => 'list_id', 'description' => sprintf( __( '<a href="%s" target="__blank">How to find Mailchimp list ID</a>', 'essence-core' ), 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' ), 'dependency' => array( 'element' => 'using_theme_options_api_settings', 'value' => array( 'no' ) ), 'group' => __( 'Mailchimp Settings', 'essence-core' ), ), array( 'type' => 'dropdown', 'holder' => 'div', 'class' => '', 'heading' => __( 'CSS Animation', 'essence-core' ), 'param_name' => 'css_animation', 'value' => $ts_vc_anim_effects_in, 'std' => 'fadeInUp', ), array( 'type' => 'textfield', 'holder' => 'div', 'class' => '', 'heading' => __( 'Animation Delay', 'essence-core' ), 'param_name' => 'animation_delay', 'std' => '0.4', 'description' => __( 'Delay unit is second.', 'essence-core' ), 'dependency' => array( 'element' => 'css_animation', 'not_empty' => true, ), ), array( 'type' => 'css_editor', 'heading' => __( 'Css', 'essence-core' ), 'param_name' => 'css', 'group' => __( 'Design options', 'essence-core' ), ) ) )
    );
}

function essence_core_news_letter( $atts ) {

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_news_letter', $atts ) : $atts;

    extract( shortcode_atts( array( 'title' => '', 'short_desc' => '', 'submit_text' => '', 'placeholder' => '', 'success_message' => '', 'using_theme_options_api_settings' => 'yes', 'api_key' => '', 'list_id' => '', 'css_animation' => '', 'animation_delay' => '0.4',   //In second
                                 'css' => '', ), $atts
             )
    );

    $css_class = 'wow '.$css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' '.apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay.'s';

    $action_url = ESSENCE_CORE_BASE_URL.'core/shortcodes/news_letter.php';

    if ( trim( $using_theme_options_api_settings ) == 'yes' ) {
        $essence = essence_get_global_essence();
        $api_key = isset( $essence['opt_mailchimp_api_key'] ) ? $essence['opt_mailchimp_api_key'] : '';
        $list_id = isset( $essence['opt_mailchimp_list_id'] ) ? $essence['opt_mailchimp_list_id'] : '';
    }

    $html = '';
    $before_form_html = '<div class="tr-short-desc"> '.apply_filters( 'the_content', $short_desc ).'</div>';
    $css_class .= ' ts-newsletter-shortcode ';


    $html .= '<div class="'.esc_attr( $css_class ).'" data-wow-delay="'.esc_attr( $animation_delay ).'">
					<div class="info-feature newsletter-form-wrap">
                        '.$before_form_html.'
						<form action="'.esc_url( $action_url ).'" name="news_letter" class="form-newsletter">
                            <input type="hidden" name="api_key" value="'.esc_html( $api_key ).'" />
                            <input type="hidden" name="list_id" value="'.esc_html( $list_id ).'" />
                            <input type="hidden" name="success_message" value="'.sanitize_text_field( $success_message ).'" />
							<input type="text" name="email" placeholder="'.sanitize_text_field( $placeholder ).'">
							<span><button type="submit" name="submit_button" class="button_newletter">'.sanitize_text_field( $submit_text ).'</button></span>
						</form>
					</div><!-- /.newsletter-form-wrap -->
				</div><!-- /.'.esc_attr( $css_class ).' -->';

    return $html;

}

add_shortcode( 'essence_core_news_letter', 'essence_core_news_letter' );

function essence_core_submit_mailchimp_via_ajax() {

    if ( !class_exists( 'MCAPI' ) ) {
        essence_core_require_once( ESSENCE_CORE_LIBS.'classes/MailChimp.php' );
    }

    $response = array( 'html' => '', 'message' => '', 'success' => 'no' );

    $api_key = isset( $_POST['api_key'] ) ? $_POST['api_key'] : '';
    $list_id = isset( $_POST['list_id'] ) ? $_POST['list_id'] : '';
    $success_message = isset( $_POST['success_message'] ) ? $_POST['success_message'] : '';
    $email = isset( $_POST['email'] ) ? $_POST['email'] : '';

    $response['message'] = __( 'Failed', 'essence-core' );

    $merge_vars = array();

    if ( class_exists( 'MCAPI' ) ) {
        $api = new MCAPI( $api_key );

        if ( $api->listSubscribe( $list_id, $email, $merge_vars ) === true ) {
            $response['message'] = sanitize_text_field( $success_message );
            $response['success'] = 'yes';
        }
        else {
            // Sending failed
            $response['message'] = $api->errorMessage;
        }
    }

    wp_send_json( $response );
    die();
}

add_action( 'wp_ajax_essence_core_submit_mailchimp_via_ajax', 'essence_core_submit_mailchimp_via_ajax' );
add_action( 'wp_ajax_nopriv_essence_core_submit_mailchimp_via_ajax', 'essence_core_submit_mailchimp_via_ajax' );
