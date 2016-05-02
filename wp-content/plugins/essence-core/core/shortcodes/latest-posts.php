<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'vc_before_init', 'essence_core_VC_MAP_LatestPosts' );
function essence_core_VC_MAP_LatestPosts()
{
    global $ts_vc_anim_effects_in;
    vc_map(
        array(
            'name'     => __( 'Essence Core Latest Posts', 'essence-core' ),
            'base'     => 'essence_core_latest_posts', // shortcode
            'class'    => '',
            'category' => __( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Latest Posts type', 'essence-core' ),
                    'param_name'  => 'latestpost_type',
                    'std'         => 2,
                    'value'       => array(
                        __( 'Type 1', 'essence-core' ) => 'type1',
                        __( 'Type 2', 'essence-core' ) => 'type2',
                    ),
                    'description' => __( 'Select Latest Post Type', 'essence-core' ),
                ),
                array(
                    'type'       => 'essence_core_select_cat_field',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Select Category', 'essence-core' ),
                    'param_name' => 'essence_cat_slug',
                    'std'        => '',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Images Size', 'essence-core' ),
                    'param_name'  => 'img_size',
                    'std'         => '569x340',
                    'description' => sprintf( __( 'Format %s. Default <strong>569x340</strong>.', 'essence-core' ), '{width}x{height}' ),
                    'dependency'  => array(
                        'element' => 'latestpost_type',
                        'value'   => 'type1',
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Number Of Items', 'essence-core' ),
                    'param_name'  => 'number_of_items',
                    'std'         => 2,
                    'description' => __( 'Maximum number of posts will load', 'essence-core' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Items Per row', 'essence-core' ),
                    'param_name'  => 'items_per_row',
                    'std'         => 2,
                    'value'       => array(
                        __( '1 column', 'essence-core' ) => '1',
                        __( '2 column', 'essence-core' ) => '2',
                        __( '3 column', 'essence-core' ) => '3',
                        __( '4 column', 'essence-core' ) => '4',
                    ),
                    'description' => __( 'Post per row on large screen', 'essence-core' ),
                ),
                array(
                    'type'       => 'vc_link',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'Link', 'essence-core' ),
                    'param_name' => 'link',
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => __( 'CSS Animation', 'essence-core' ),
                    'param_name' => 'css_animation',
                    'value'      => $ts_vc_anim_effects_in,
                    'std'        => 'fadeInUp',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Animation Delay', 'essence-core' ),
                    'param_name'  => 'animation_delay',
                    'std'         => '0.4',
                    'description' => __( 'Delay unit is second.', 'essence-core' ),
                    'dependency'  => array(
                        'element'   => 'css_animation',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => __( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => __( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}


function essence_core_latest_posts( $atts )
{

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_latest_posts', $atts ) : $atts;
    $html = $link_html = '';
    extract(
        shortcode_atts(
            array(
                'latestpost_type'  => '',
                'essence_cat_slug' => '',
                'img_size'         => '569x340',
                'link'             => '',
                'number_of_items'  => 9,
                'items_per_row'    => 2,
                'css_animation'    => '',
                'animation_delay'  => '0.4',  // In second
                'css'              => '',
            ), $atts
        )
    );

    $css_class = 'ts-our-blog ' . $latestpost_type . ' wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = '0';
    }
    $animation_delay = $animation_delay . 's';

    $args = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'showposts'           => intval( $number_of_items ),
    );


    if ( trim( $essence_cat_slug ) != '' ):

        $args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $essence_cat_slug,
            ),
        );

    endif;

    $link_default = array(
        'url'    => '',
        'title'  => '',
        'target' => '',
    );

    if ( function_exists( 'vc_build_link' ) ):
        $link = vc_build_link( $link );
    else:
        $link = $link_default;
    endif;

    ob_start();

    $posts = new WP_Query( $args );


    $img_size_x = 569;
    $img_size_y = 340;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[ 0 ] ) ? max( 1, intval( $img_size[ 0 ] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[ 1 ] ) ? max( 1, intval( $img_size[ 1 ] ) ) : $img_size_y;
    ?>

    <?php if ( $posts->have_posts() ): ?>
    <div class="<?php echo esc_attr( $css_class ); ?>" data-wow-delay="<?php echo esc_attr( $animation_delay ); ?>">
    <div class="row">
    <?php while ( $posts->have_posts() ) :
        $posts->the_post(); ?>
        <?php
        $items_per_row = intval( $items_per_row );
        if ( $items_per_row == 1 ) :
            $img = essence_core_resize_image( null, null, 1707, 1020, true, true, false );
            ?>
            <div class=" col-sm-12">
            <?php
        elseif ( $items_per_row == 2 ) :
            $img = essence_core_resize_image( null, null, $img_size_x, $img_size_y, true, true, false ); ?>
            <div class=" col-sm-6">
            <?php
        elseif ( $items_per_row == 3 ) :
            $img = essence_core_resize_image( null, null, $img_size_x, $img_size_y, true, true, false ); ?>
            <div class=" col-sm-4">
            <?php
        elseif ( $items_per_row == 4 ) :
            $img = essence_core_resize_image( null, null, $img_size_x, $img_size_y, true, true, false ); ?>
            <div class=" col-sm-3">
        <?php endif; ?>
        <?php if ( trim( $latestpost_type ) == 'type1' ) : ?>
        <div class="ts-our-blog-item">
            <a class="img-post" href="<?php the_permalink(); ?>">
                <figure><img src="<?php echo esc_url( $img[ 'url' ] ); ?>"
                             alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>"/>
                </figure>
                <span class="icon-hover"></span>
            </a>
            <div class="ts-our-blog-item-info">
                <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php if ( function_exists( 'essence_posted_on_latestposts' ) ) { ?>
                    <?php essence_posted_on_latestposts(); ?>
                <?php } ?>
            </div>
        </div> <!--End .ts-our-blog-item-->
    <?php else : ?>
        <div class="ts-our-blog-item ">
            <span class="tr-our-date"><?php echo get_the_date(); ?></span>
            <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <a class="tr-readmore"
               href="<?php the_permalink(); ?>"><?php echo esc_html( 'Read More', 'essence-core' ); ?></a>
        </div>
    <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div> <!--End .row-->
    <?php
    if ( trim( $link[ 'url' ] ) != '' ) { ?>
        <div class="our-more">
            <a href="<?php echo esc_attr( $link[ 'url' ] ) ?>" class="ts-our-more"
               target="<?php echo esc_attr( $link[ 'target' ] ) ?>"
               title="<?php echo sanitize_text_field( $link[ 'title' ] ) ?>"><?php echo sanitize_text_field( $link[ 'title' ] ) ?></a>
        </div>
    <?php } ?>
    </div><!-- /.<?php echo esc_attr( $css_class ); ?> -->
<?php endif; // End if ( $posts->have_posts() )
    ?>

    <?php

    wp_reset_postdata();

    $html .= ob_get_clean();

    return $html;

}

add_shortcode( 'essence_core_latest_posts', 'essence_core_latest_posts' );
