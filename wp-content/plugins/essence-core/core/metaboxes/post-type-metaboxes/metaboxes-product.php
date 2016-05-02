<?php
/**
 * This file using for add metaboxes to all posttypes
 **/

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}


add_action( 'cmb2_init', 'essence_core_register_metabox_product' );

function essence_core_register_metabox_product()

{

    // Start with an underscore to hide fields from custom fields list

    $prefix = 'essence_';


    /**
     * ==========================================================/
     * PAGE
     * ==========================================================/
     **/

    $cmb_essence_metaboxes_product = new_cmb2_box(

        array(
            'title'        => __( 'Product Metas', 'essence-core' ),
            'id'           => 'essence_product_metas',
            'object_types' => array( 'product' ), // Post type
            // 'show_on_cb' => 'essence_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'shw_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )

    );
    // Page Layout Type settings
    $cmb_essence_metaboxes_product->add_field(
        array(
            'name'    => __( 'Show/hide custom tab', 'essence-core' ),
            'desc'    => __( 'Choose show or hide custom tab in single product .', 'essence-core' ),
            'id'      => $prefix . 'product-enable',
            'type'    => 'select',
            'options' => array(
                'show' => __( 'Show', 'essence-core' ),
                'hide' => __( 'Hide', 'essence-core' ),
            ),
            'default' => 'show',
        )
    );
    $field_args = array(
        //tab 1
        array(
            'name' => esc_html__( 'Title tab 1', 'essence' ),
            'id'   => $prefix . 'add-title-tab-1',
            'type' => 'text',
            'desc' => esc_html__( 'This Tab will hide if this field empty.', 'essence' ),
        ),
        array(
            'id'   => $prefix . 'add-desc-tab-1',
            'type' => 'textarea',
            'name' => esc_html__( 'Description tab 1', 'essence' ),
            'desc' => esc_html__( 'Add Description tab 1 .', 'essence' ),
        ),
        // tab 2
        array(
            'name' => esc_html__( 'Title tab 2', 'essence' ),
            'id'   => $prefix . 'add-title-tab-2',
            'type' => 'text',
            'desc' => esc_html__( 'This Tab will hide if this field empty.', 'essence' ),
        ),
        array(
            'id'   => $prefix . 'add-desc-tab-2',
            'type' => 'textarea',
            'name' => esc_html__( 'Description tab 2', 'essence' ),
            'desc' => esc_html__( 'Add Description tab 2 .', 'essence' ),
        ),
        // tab 3
        array(
            'name' => esc_html__( 'Title tab 3', 'essence' ),
            'id'   => $prefix . 'add-title-tab-3',
            'type' => 'text',
            'desc' => esc_html__( 'This Tab will hide if this field empty.', 'essence' ),
        ),
        array(
            'id'   => $prefix . 'add-desc-tab-3',
            'type' => 'textarea',
            'name' => esc_html__( 'Description tab 3', 'essence' ),
            'desc' => esc_html__( 'Add Description tab 3 .', 'essence' ),
        ),
        // tab 4
        array(
            'name' => esc_html__( 'Title tab 4', 'essence' ),
            'id'   => $prefix . 'add-title-tab-4',
            'type' => 'text',
            'desc' => esc_html__( 'This Tab will hide if this field empty.', 'essence' ),
        ),
        array(
            'id'   => $prefix . 'add-desc-tab-4',
            'type' => 'textarea',
            'name' => esc_html__( 'Description tab 4', 'essence' ),
            'desc' => esc_html__( 'Add Description tab 4 .', 'essence' ),
        ),
    );
    foreach ( $field_args as $field ):

        $cmb_essence_metaboxes_product->add_field( $field );

    endforeach;

}