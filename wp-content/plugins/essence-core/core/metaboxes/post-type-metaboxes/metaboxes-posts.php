<?php

/**
 * @author    MrTieuTien
 * @copyright 2015
 */
?>
<?php
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

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

if ( file_exists( ESSENCE_CORE_LIBS . 'admin/cmb2/init.php' ) ) {
    require_once ESSENCE_CORE_LIBS . 'admin/cmb2/init.php';
}
elseif ( file_exists( ESSENCE_CORE_LIBS . 'admin/CMB2/init.php' ) ) {
    require_once ESSENCE_CORE_LIBS . 'admin/CMB2/init.php';
}


add_action( 'cmb2_init', 'essence_core_core_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function essence_core_core_register_metabox()
{

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'ts-';

    $cmb_themeblank_core_post_metaboxes = new_cmb2_box(
        array(
            'id'           => $prefix . 'post_metabox',
            'title'        => __( 'Post format Setting', 'cmb2' ),
            'object_types' => array( 'post', ), // Post type
            // 'show_on_cb' => 'themeblank_core_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'show_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )
    );
    $field_args = array(
        array(
            'name'         => 'Image gallery',
            'desc'         => '',
            'id'           => $prefix . 'image_gallery',
            'type'         => 'file_list',
            'preview_size' => array( 100, 100 )
            // Default: array( 50, 50 )
        ),

        array(
            'name'  => 'Post image',
            'desc'  => 'Upload an image or enter an URL.',
            'id'    => $prefix . 'post_image',
            'type'  => 'file',
            'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
        ),

        array(
            'name' => __( 'Video Embed', 'lenafashion' ),
            'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'lenafashion' ),
            'id'   => $prefix . 'post_video_embed',
            'type' => 'oembed',
        ),

        array(
            'name' => __( 'Audio Embed', 'lenafashion' ),
            'desc' => __( 'Enter a soundcloud URL.', 'lenafashion' ),
            'id'   => $prefix . 'post_audio_embed',
            'type' => 'oembed',
        ),

        array(
            'name' => __( 'Quote author', 'lenafashion' ),
            'desc' => __( '(Please insert max 140 character.)', 'lenafashion' ),
            'id'   => $prefix . 'quote_author',
            'type' => 'text',
        ),
    );
    foreach ( $field_args as $field ):

        $cmb_themeblank_core_post_metaboxes->add_field( $field );

    endforeach;
}