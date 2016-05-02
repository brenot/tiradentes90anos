<?php
/**
 * This file using for add metaboxes to all posttypes
 **/

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'themeblank_core_core_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}
if ( file_exists( ESSENCE_CORE_LIBS . 'admin/metaboxes/init.php' ) ) {
    require_once ESSENCE_CORE_LIBS . 'admin/metaboxes/init.php';
}
function essence_core_show_if_front_page( $cmb )
{
    // Don't show this metabox if it's not the front page template
    if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
        return false;
    }

    return true;
}

/**
 * Function Revolution
 **/
add_action( 'cmb2_init', 'essence_core_register_metabox' );
function essence_core_register_metabox()
{
    // Hero Section Slides - Revolution Slider //
    $essence_herosection_revolutions = array( '' => esc_html__( ' -- No Revolution Slider -- ', 'essence-core' ) );
    if ( class_exists( 'RevSlider' ) ) {
        global $wpdb;
        if ( shortcode_exists( 'rev_slider' ) ) {
            $essence_herosection_revolutions = array( '' => esc_html__( ' -- I don\'t want to use a slider -- ', 'essence-core' ) );
            $rev_sql = "SELECT * " .
                "FROM " . $wpdb->prefix . "revslider_sliders " .
                " ";
            $rev_rows = $wpdb->get_results( $rev_sql );
            if ( count( $rev_rows ) > 0 ) {
                foreach ( $rev_rows as $rev_row ):
                    $essence_herosection_revolutions[ $rev_row->alias ] = $rev_row->title;
                endforeach;
            }
        }
    }
    // Hero Section Slides - Revolution Slider //
    $essence_select_menu = array( '' => esc_html__( 'Default', 'essence-core' ) );

    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && !empty( $menus ) ) {
        foreach ( $menus as $single_menu ) {
            if ( is_object( $single_menu ) && isset( $single_menu->slug, $single_menu->name ) ) {
                $essence_select_menu[ $single_menu->slug ] = $single_menu->name;
            }
        }
    }
    // Start with an underscore to hide fields from custom fields list
    $prefix = 'essence_';

    // Options for title and breadcrumb
    $title_breadcrumb_metaboxes = new_cmb2_box(
        array(
            'title'        => esc_html__( 'Title And Breadcrumb', 'essence-core' ),
            'id'           => 'essence_title_breadcrumb_metas',
            'object_types' => array( 'page', 'post', 'portfolio' ), // Post type
            // 'show_on_cb' => 'west_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'show_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Show Title', 'essence-core' ),
            'desc'    => '',
            'id'      => $prefix . 'show_title',
            'type'    => 'select',
            'options' => array(
                'default' => esc_html__( 'Show default title', 'essence-core' ),
                'custom'  => esc_html__( 'Show custom title', 'essence-core' ),
                'disable' => esc_html__( 'Don\'t show title', 'essence-core' ),
            ),
            'default' => 'default',
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name' => esc_html__( 'Custom Title', 'essence-core' ),
            'id'   => $prefix . 'custom_title',
            'type' => 'text',
            'desc' => esc_html__( 'Use custom title instead of default title. Note: Title will be not shown if header is a slider', 'essence-core' ),
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Title Color', 'essence-core' ),
            'id'      => $prefix . 'title_color',
            'type'    => 'colorpicker',
            'default' => '#ffffff',
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Show Breadcrumb', 'essence-core' ),
            'id'      => $prefix . 'show_breadcrumb',
            'type'    => 'select',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'essence-core' ),
                'no'  => esc_html__( 'No', 'essence-core' ),
            ),
            'default' => 'yes',
            'desc'    => esc_html__( 'Note: Breadcrumb will be not shown if header is a slider', 'essence-core' ),
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Breadcrumb Color', 'essence-core' ),
            'id'      => $prefix . 'breadcrumb_color',
            'type'    => 'colorpicker',
            'default' => '#999999',
            'desc'    => esc_html__( 'Default: #999999', 'essence-core' ),
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Breadcrumb Hover Color', 'essence-core' ),
            'id'      => $prefix . 'breadcrumb_hover_color',
            'type'    => 'colorpicker',
            'default' => '#ffffff',
            'desc'    => esc_html__( 'Default: #ffffff', 'essence-core' ),
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Breadcrumb Current Page Color', 'essence-core' ),
            'id'      => $prefix . 'breadcrumb_cur_page_color',
            'type'    => 'colorpicker',
            'default' => '#999999',
            'desc'    => esc_html__( 'Default: #999999', 'essence-core' ),
        )
    );

    $title_breadcrumb_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Breadcrumb Separator Color', 'essence-core' ),
            'id'      => $prefix . 'breadcrumb_sep_color',
            'type'    => 'colorpicker',
            'default' => '#333333',
            'desc'    => esc_html__( 'Default: #333333', 'essence-core' ),
        )
    );

    /**
     * ==========================================================/
     * Custom Header
     * ==========================================================/
     **/
    $cmb_essence_metaboxes = new_cmb2_box(
        array(
            'title'        => esc_html__( 'Extra Options', 'essence-core' ),
            'id'           => 'essence_global_metas',
            'object_types' => array( 'page', 'post', 'portfolio' ), // Post type
            // 'show_on_cb' => 'west_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'show_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Use Custom Logo', 'essence-core' ),
            'desc'    => '',
            'id'      => $prefix . 'use_custom_logo',
            'type'    => 'select',
            'options' => array(
                'no'  => esc_html__( 'No, use global logo setting', 'essence-core' ),
                'yes' => esc_html__( 'Yes, use custom logo', 'essence-core' ),
            ),
            'default' => 'no',
        )
    );
    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Custom Logo', 'essence-core' ),
            'id'      => $prefix . 'custom_logo',
            'type'    => 'file',
            // Optional:
            'options' => array(
                'url'                  => false, // Hide the text input for the url
                'add_upload_file_text' => esc_html__( 'Choose your custom logo', 'essence-core' ) // Change upload button text. Default: "Add or Upload File"
            ),
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Custom Menu', 'essence-core' ),
            'desc'    => esc_html__( 'Select menu type for page.', 'essence-core' ),
            'id'      => $prefix . 'custom_menu',
            'type'    => 'select',
            'options' => $essence_select_menu,
            'default' => '-1',
        )
    );
    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Menu Color', 'essence-core' ),
            'id'      => $prefix . 'menu_color',
            'type'    => 'colorpicker',
            'default' => '',
            'desc' => esc_html__( 'Only for top level of primary menu', 'essence-core' ),
        )
    );
    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Menu Hover/Active Color', 'essence-core' ),
            'id'      => $prefix . 'menu_hover_color',
            'type'    => 'colorpicker',
            'default' => '',
            'desc' => esc_html__( 'Only for top level of primary menu', 'essence-core' ),
        )
    );
    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Menu Background Color', 'essence-core' ),
            'id'      => $prefix . 'menu_bg_color',
            'type'    => 'colorpicker',
            'default' => '',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Top Header Background Color', 'essence-core' ),
            'id'      => $prefix . 'top_header_bg_color',
            'type'    => 'colorpicker',
            'default' => '',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Custom Header Slider/Banner', 'essence-core' ),
            'desc'    => '',
            'id'      => $prefix . 'use_custom_header',
            'type'    => 'select',
            'options' => array(
                'no'  => esc_html__( 'No, use global header setting', 'essence-core' ),
                'yes' => esc_html__( 'Yes, use custom header', 'essence-core' ),
            ),
            'default' => 'no',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Header Type', 'essence-core' ),
            'desc'    => esc_html__( 'Select header type for site.', 'essence-core' ),
            'id'      => $prefix . 'header_type',
            'type'    => 'select',
            'options' => array(
                'header-v1' => esc_html__( 'Header V1', 'essence-core' ),
                'header-v2' => esc_html__( 'Header V2', 'essence-core' ),
                'header-v3' => esc_html__( 'Header V3', 'essence-core' ),
            ),
            'default' => 'header-v3',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Choose Revolution Slider', 'essence-core' ),
            'desc'    => esc_html__( 'If no slider is chosen, you can use a custom image instead', 'essence-core' ),
            'id'      => 'essence_section_revolution',
            'type'    => 'select',
            'options' => $essence_herosection_revolutions,
            'default' => '-1',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Custom Header Image', 'essence-core' ),
            'desc'    => '',
            'id'      => $prefix . 'custom_header_img',
            'type'    => 'file',
            // Optional:
            'options' => array(
                'url'                  => false, // Hide the text input for the url
                'add_upload_file_text' => esc_html__( 'Choose Header Image', 'essence-core' ) // Change upload button text. Default: "Add or Upload File"
            ),
        )
    );

    // Scroll Type
    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Scroll Style', 'essence-core' ),
            'desc'    => esc_html__( 'Select scroll style.', 'essence-core' ),
            'id'      => $prefix . 'scroll_down_style',
            'type'    => 'select',
            'options' => array(
                'global'  => esc_html__( 'Use theme options global setting', 'essence-core' ),
                'custom'  => esc_html__( 'Custom', 'essence-core' ),
                'disable' => esc_html__( 'Disable', 'essence-core' ),
            ),
            'default' => 'global',
        )
    );

    $cmb_essence_metaboxes->add_field(
        array(
            'name'    => esc_html__( 'Custom Scroll Down Image', 'essence-core' ),
            'desc'    => esc_html__( 'Upload custom scroll down image.', 'essence-core' ),
            'id'      => $prefix . 'custom_scroll_down_img',
            'type'    => 'file',
            // Optional:
            'options' => array(
                'url'                  => false, // Hide the text input for the url
                'add_upload_file_text' => esc_html__( 'Choose Image', 'essence-core' ) // Change upload button text. Default: "Add or Upload File"
            ),
        )
    );

}