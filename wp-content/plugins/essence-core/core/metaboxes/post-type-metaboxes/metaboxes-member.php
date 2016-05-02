<?php
/**
 * This file using for add metaboxes to all posttypes
 **/

if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}


add_action( 'cmb2_init', 'west_core_register_metabox_member' );

function west_core_register_metabox_member()

{

    // Start with an underscore to hide fields from custom fields list

    $prefix = 'essence_';


    /**
     * ==========================================================/
     * PAGE
     * ==========================================================/
     **/

    $cmb_essence_metaboxes_member = new_cmb2_box(

        array(
            'title'        => __( 'Member Metas', 'essence-core' ),
            'id'           => 'essence_member_metas',
            'object_types' => array( 'member' ), // Post type
            // 'show_on_cb' => 'west_core_show_if_front_page', // function should return a bool value
            // 'context'    => 'normal',
            // 'priority'   => 'high',
            // 'shw_names' => true, // Show field names on the left
            // 'cmb_styles' => false, // false to disable the CMB stylesheet
            // 'closed'     => true, // true to keep the metabox closed by default
        )

    );

    $cmb_essence_metaboxes_member->add_field(
        array(
            'name'    => esc_html__( 'Member Position', 'essence-core' ),
            'desc'    => '',
            'default' => esc_html__( 'Senior Designer', 'essence-core' ),
            'id'      => $prefix . 'member_pos',
            'type'    => 'text',
        )
    );

    $cmb_essence_metaboxes_member->add_field(
        array(
            'name'             => esc_html__( 'Member Link', 'essence-core' ),
            'id'               => $prefix . 'member_link_type',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => 'permalink',
            'options'          => array(
                'permalink' => esc_html__( 'Use Permalink', 'essence-core' ),
                'custom'    => esc_html__( 'Custom Link', 'essence-core' ),
            ),
        )
    );

    $cmb_essence_metaboxes_member->add_field(
        array(
            'name'       => esc_html__( 'Member Custom Link', 'essence-core' ),
            'default'    => '',
            'id'         => $prefix . 'member_custom_link',
            'type'       => 'text_url',
            'desc'       => esc_html__( 'Custom link to member details page', 'essence-core' ),
            'attributes' => array(
                'class' => 'cmb2-text-url widefat',
            ),
        )
    );

    $member_socials_group = $cmb_essence_metaboxes_member->add_field(
        array(
            'name'       => esc_html__( 'Social Links', 'essence-core' ),
            'id'         => $prefix . 'member_socials_group',
            'type'       => 'group',
            'repeatable' => true, // use false if you want non-repeatable group
            'options'    => array(
                'group_title'   => __( 'Social Link {#}', 'essence-core' ), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __( 'Add Another Social Link', 'essence-core' ),
                'remove_button' => __( 'Remove', 'essence-core' ),
                'sortable'      => true, // beta
                // 'closed'     => true, // true to have the groups closed by default
            ),
        )
    );
    $cmb_essence_metaboxes_member->add_group_field(
        $member_socials_group,
        array(
            'name' => esc_html__( 'Icon Class', 'essence-core' ),
            'id'   => 'social_icon_class',
            'type' => 'text_small',
            'desc' => wp_kses( __( 'You can paste <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a> here. For example: <b>fa fa-facebook</b>', 'essence-core' ), array( 'a' => array( 'href' => array(), 'target' => array() ), 'b' => array() ) ),
        )
    );
    $cmb_essence_metaboxes_member->add_group_field(
        $member_socials_group,
        array(
            'name' => esc_html__( 'Link', 'essence-core' ),
            'id'   => 'social_link',
            'type' => 'text_url',
            'desc' => esc_html__( 'Social URL', 'essence-core' ),
            'attributes' => array(
                'class' => 'cmb2-text-url widefat',
            ),
        )
    );

}