<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/*
 * Register post type testimonial
*/
function essence_testimonials_post_type()
{
    $labels = array(
        'name'               => __( 'Testimonials', 'post type general name', 'essence-core' ),
        'singular_name'      => __( 'Testimonial', 'post type singular name', 'essence-core' ),
        'add_new'            => __( 'Add New', 'essence-core' ),
        'all_items'          => __( 'All Testimonials', 'essence-core' ),
        'add_new_item'       => __( 'Add New Testimonial', 'essence-core' ),
        'edit_item'          => __( 'Edit Testimonial', 'essence-core' ),
        'new_item'           => __( 'New Testimonial', 'essence-core' ),
        'view_item'          => __( 'View Testimonial', 'essence-core' ),
        'search_items'       => __( 'Search Testimonials', 'essence-core' ),
        'not_found'          => __( 'No Testimonial Found', 'essence-core' ),
        'not_found_in_trash' => __( 'No Testimonial Found in Trash', 'essence-core' ),
        'parent_item_colon'  => '',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'testimonials', 'with_front' => true ),
        'query_var'         => true,
        'show_in_nav_menus' => false,
        'menu_icon'         => 'dashicons-format-quote',
        'supports'          => array( 'title', 'thumbnail', 'excerpt', 'editor', 'author', ),
    );

    register_post_type( 'testimonial', $args );

    //register_taxonomy(' testimonial_cat',
//            array( 'testimonial' ),
//            array(
//                'hierarchical' 		=> true,
//                'label' 			=> __( 'Testimonial Categories' ),
//                'show_admin_column'	=> true,
//                'singular_label' 	=> 'Testimonial Category',
//                'rewrite' 			=> true,
//                'query_var' 		=> true,
//            )
//        );
}

add_action( 'init', 'essence_testimonials_post_type', 1 );
?>