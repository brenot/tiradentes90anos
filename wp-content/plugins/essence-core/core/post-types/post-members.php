<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/*
 * Register post type member
*/
function essence_members_post_type()
{
    $labels = array(
        'name'               => esc_html__( 'Members', 'post type general name', 'essence-core' ),
        'singular_name'      => esc_html__( 'Member', 'post type singular name', 'essence-core' ),
        'add_new'            => esc_html__( 'Add New', 'essence-core' ),
        'all_items'          => esc_html__( 'All Members', 'essence-core' ),
        'add_new_item'       => esc_html__( 'Add New Member', 'essence-core' ),
        'edit_item'          => esc_html__( 'Edit Member', 'essence-core' ),
        'new_item'           => esc_html__( 'New Member', 'essence-core' ),
        'view_item'          => esc_html__( 'View Member', 'essence-core' ),
        'search_items'       => esc_html__( 'Search Members', 'essence-core' ),
        'not_found'          => esc_html__( 'No Member Found', 'essence-core' ),
        'not_found_in_trash' => esc_html__( 'No Member Found in Trash', 'essence-core' ),
        'parent_item_colon'  => '',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'members', 'with_front' => true ),
        'query_var'         => true,
        'show_in_nav_menus' => false,
        'menu_icon'         => 'dashicons-groups',
        'supports'          => array( 'title', 'thumbnail', 'author', 'editor' ),
    );

    register_post_type( 'member', $args );

}

add_action( 'init', 'essence_members_post_type', 1 );
?>