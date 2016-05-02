<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/*
 * Register post type portfolio
*/
function essence_portfolios_post_type()
{
    $labels = array(
        'name'               => __( 'Portfolios', 'post type general name', 'essence-core' ),
        'singular_name'      => __( 'Portfolio', 'post type singular name', 'essence-core' ),
        'add_new'            => __( 'Add New', 'essence-core' ),
        'all_items'          => __( 'All Portfolios', 'essence-core' ),
        'add_new_item'       => __( 'Add New Portfolio', 'essence-core' ),
        'edit_item'          => __( 'Edit Portfolio', 'essence-core' ),
        'new_item'           => __( 'New Portfolio', 'essence-core' ),
        'view_item'          => __( 'View Portfolio', 'essence-core' ),
        'search_items'       => __( 'Search Portfolios', 'essence-core' ),
        'not_found'          => __( 'No Portfolio Found', 'essence-core' ),
        'not_found_in_trash' => __( 'No Portfolio Found in Trash', 'essence-core' ),
        'parent_item_colon'  => '',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'capability_type'   => 'post',
//        'capabilities' => array(
//            'edit_post'          => 'edit_post',
//            'read_post'          => 'read_post',
//            'delete_post'        => 'delete_post',
//            'edit_posts'         => 'edit_posts',
//            'edit_others_posts'  => 'edit_others_posts',
//            'publish_posts'      => 'publish_posts',
//            'read_private_posts' => 'read_private_posts',
//            'create_posts'       => 'create_posts',
//        ),
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'portfolios', 'with_front' => true ),
        'query_var'         => true,
        'show_in_nav_menus' => false,
        'menu_icon'         => 'dashicons-schedule',
        'supports'          => array( 'title', 'thumbnail', 'excerpt', 'editor', 'author', ),
    );

    register_post_type( 'portfolio', $args );

}

add_action( 'init', 'essence_portfolios_post_type', 1 );
?>