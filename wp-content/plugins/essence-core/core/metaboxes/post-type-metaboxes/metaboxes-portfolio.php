<?php
/**
 * This file using for add metaboxes to all posttypes
 **/

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}


add_action( 'cmb2_init', 'essence_core_register_metabox_postfolio' );

function essence_core_register_metabox_postfolio()

{

    // Start with an underscore to hide fields from custom fields list

    $prefix = 'essence_';


    /**
     * ==========================================================/
     * PAGE
     * ==========================================================/
     **/

    $cmb_essence_metaboxes_portfolio = new_cmb2_box(

        array(
            'title'        => __( 'Portfolio Metas', 'essence-core' ),
            'id'           => 'essence_portfolio_metas',
            'object_types' => array( 'portfolio' ), // Post type
            // 'show_on_cb' => 'essence_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'shw_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )

    );
    // Page Layout Type settings
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name'    => __( 'Portfolio Type', 'essence-core' ),
            'desc'    => __( 'Select portfolio type ether .', 'essence-core' ),
            'id'      => $prefix.'portfolio-type',
            'type'    => 'select',
            'options' => array(
                'standard'   => __( 'Standard', 'essence-core' ),
                'slider'     => __( 'Slider', 'essence-core' ),
                'video'      => __( 'Video', 'essence-core' ),
                'soundcloud' => __( 'SoundCloud', 'essence-core' ),
            ),
            'default' => 'porfolio-standard',
        )
    );
    //  Portfolio Slider
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name'         => __( 'Portfolio Slider', 'essence-core' ),
            'desc'         => __( 'Upload or add multiple images/attachments.', 'essence-core' ),
            'id'           => $prefix . 'portfolio_slider',
            'type'         => 'file_list',
            'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            // Optional, override default text strings
            'options'      => array(
                'add_upload_files_text' => 'Add or Upload Files', // default: "Add or Upload Files"
                'remove_image_text'     => 'Remove Image', // default: "Remove Image"
                'file_text'             => 'File', // default: "File:"
                'file_download_text'    => 'Download', // default: "Download"
                'remove_text'           => 'Remove', // default: "Remove"
            ),
        )
    );

    //  Portfolio Video
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name' => __( 'Portfolio Video', 'themestudio' ),
            'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'themestudio' ),
            'id'   => $prefix . 'portfolio_video',
            'type' => 'oembed',
        )
    );

    //  Portfolio Soundcloud
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name' => __( 'Portfolio Soundcloud', 'themestudio' ),
            'desc' => __( 'Enter a soundcloud URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'themestudio' ),
            'id'   => $prefix . 'portfolio_soundcloud',
            'type' => 'oembed',
        )
    );
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name' => 'Url Website',
            'id'   => $prefix.'visited-url',
            'type' => 'text_url',
            'desc' => __( 'If this field empty . button will hidden', 'essence-core' ),
            // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
        )
    );
    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name' => 'Text button',
            'id'   => $prefix.'visited-text',
            'type' => 'text',
            'desc' => __( 'If url website field empty . button will hidden', 'essence-core' ),
        )
    );

    $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name'    => 'Social Share',
            'desc'    => 'Multi check socials sharing for portfolio single.',
            'id'      => $prefix.'social-sharing',
            'type'    => 'multicheck',
            'options' => array(
                'facebook'    => __( 'Facebook', 'essence-core' ),
                'twitter'     => __( 'Twitter', 'essence-core' ),
                'google-plus' => __( 'Google Plus', 'essence-core' ),
                'printerest'  => __( 'Pinterest', 'essence-core' ),
                'linkedin'    => __( 'Linkedin', 'essence-core' ),
            ),
            'default' => array( 'facebook', 'twitter', 'printerest', 'linkedin', 'google-plus' ),
        )
    );

    $text_field_id = $cmb_essence_metaboxes_portfolio->add_field(
        array(
            'name'       => 'Porfolio Info',
            'id'         => $prefix.'portfolio-info',
            'type'       => 'group',
            'repeatable' => true, // use false if you want non-repeatable group
            'options'    => array(
                'group_title'   => __( 'Field Portfolio {#}', 'essence-core' ), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __( 'Add Another Field', 'essence-core' ),
                'remove_button' => __( 'Remove Field', 'essence-core' ),
                'sortable'      => true, // beta
                // 'closed'     => true, // true to have the groups closed by default
            ),
        )
    );
    $cmb_essence_metaboxes_portfolio->add_group_field(
        $text_field_id, array(
                          'name' => 'Title',
                          'id'   => $prefix.'title',
                          'type' => 'text',
                      )
    );
    $cmb_essence_metaboxes_portfolio->add_group_field(
        $text_field_id, array(
                          'name' => 'Value',
                          'id'   => $prefix.'value',
                          'type' => 'text',
                      )
    );

}