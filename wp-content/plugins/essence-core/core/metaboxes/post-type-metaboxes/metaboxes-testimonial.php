<?php
/**
 * This file using for add metaboxes to all posttypes
 **/

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}


add_action( 'cmb2_init', 'essence_core_register_metabox_testimonial' );

function essence_core_register_metabox_testimonial()

{

    // Start with an underscore to hide fields from custom fields list

    $prefix = 'essence_';


    /**
     * ==========================================================/
     * PAGE
     * ==========================================================/
     **/

    $cmb_essence_metaboxes_testimonial = new_cmb2_box(

        array(
            'title'        => __( 'Testimonial Metas', 'essence-core' ),
            'id'           => 'essence_testimonial_metas',
            'object_types' => array( 'testimonial' ), // Post type
            // 'show_on_cb' => 'west_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'shw_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )

    );

    $cmb_essence_metaboxes_testimonial->add_field(
        array(
            'name'    => esc_html__( 'Testimonial Position', 'essence-core' ),
            'desc'    => '',
            'default' => esc_html__( 'Senior Designer', 'essence-core' ),
            'id'      => $prefix . 'testimonial_pos',
            'type'    => 'text',
        )
    );

   

}