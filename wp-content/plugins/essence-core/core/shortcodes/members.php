<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
add_action( 'vc_before_init', 'essence_core_VC_MAP_Members' );


function essence_core_VC_MAP_Members()
{

    global $elegant_icons, $ts_vc_anim_effects_in, $ts_border_styles;

    vc_map(
        array(
            'name'     => esc_html__( 'Essence Core Members', 'essence-core' ),
            'base'     => 'essence_core_members',
            'class'    => '',
            'category' => esc_html__( 'Essence', 'essence-core' ),
            'params'   => array(
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Style', 'essence-core' ),
                    'param_name' => 'style',
                    'value'      => array(
                        esc_html__( 'Style 1', 'essence-core' )                     => 'style1',
                        esc_html__( 'Style 2 - Carousel', 'essence-core' )          => 'style2',
                        esc_html__( 'Style 3 - Carousel 1 member', 'essence-core' ) => 'style3',
                        esc_html__( 'Style 4 - Carousel', 'essence-core' )          => 'style4',
                    ),
                    'std'        => 'style1',
                ),
                array(
                    'type'       => 'essence_core_select_member_cat_field',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Member Category', 'essence-core' ),
                    'param_name' => 'member_cat_slug',
                    'std'        => '',
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => __( 'Member Image Size', 'essence-core' ),
                    'param_name'  => 'img_size',
                    'std'         => '360x430',
                    'description' => sprintf( __( 'Format %s. Example: 360x430, 370x480...', 'essence-core' ), '{width}x{height}' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Margin Between Items', 'essence-core' ),
                    'param_name'  => 'margin',
                    'std'         => '30',
                    'description' => esc_html__( 'Margin unit is pixel. Default: 30', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style2', 'style3', 'style4' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'Excerpt Max Chars Length', 'essence-core' ),
                    'param_name' => 'excerpt_max_chars',
                    'std'        => 250,
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style2', 'style3', 'style4' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Members To Load', 'essence-core' ),
                    'param_name'  => 'limit',
                    'std'         => 3,
                    'description' => esc_html__( 'Maximum members will be loaded', 'essence-core' ),
                    //                    'dependency'  => array(
                    //                        'element' => 'style',
                    //                        'value'   => array( 'style1', 'style2' ),
                    //                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Members Per Row', 'essence-core' ),
                    'param_name'  => 'members_per_row',
                    'value'       => array(
                        esc_html__( '1 member', 'essence-core' )  => '1',
                        esc_html__( '2 members', 'essence-core' ) => '2',
                        esc_html__( '3 members', 'essence-core' ) => '3',
                        esc_html__( '4 members', 'essence-core' ) => '4',
                    ),
                    'std'         => '3',
                    'description' => esc_html__( 'Members per row on large screen.', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Members Per Slide', 'essence-core' ),
                    'param_name'  => 'members_per_slide',
                    'value'       => array(
                        esc_html__( '1 member', 'essence-core' )  => '1',
                        esc_html__( '2 members', 'essence-core' ) => '2',
                        esc_html__( '3 members', 'essence-core' ) => '3',
                        esc_html__( '4 members', 'essence-core' ) => '4',
                    ),
                    'std'         => '2',
                    'description' => esc_html__( 'Members per slide on large screen.', 'essence-core' ),
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style2', 'style4' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'holder'     => 'div',
                    'class'      => '',
                    'heading'    => esc_html__( 'CSS Animation', 'essence-core' ),
                    'param_name' => 'css_animation',
                    'value'      => $ts_vc_anim_effects_in,
                    'std'        => 'fadeInUp',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__( 'Animation Delay', 'essence-core' ),
                    'param_name'  => 'animation_delay',
                    'std'         => '0.4',
                    'description' => esc_html__( 'Delay unit is second.', 'essence-core' ),
                    'dependency'  => array(
                        'element'   => 'css_animation',
                        'not_empty' => true,
                    ),
                    'group'       => esc_html__( 'Design options', 'essence-core' ),
                ),
                array(
                    'type'       => 'css_editor',
                    'heading'    => esc_html__( 'Css', 'essence-core' ),
                    'param_name' => 'css',
                    'group'      => esc_html__( 'Design options', 'essence-core' ),
                ),
            ),
        )
    );
}

function essence_core_members( $atts )
{

    if ( !class_exists( 'Vc_Manager' ) ) {
        return '';
    }

    $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'essence_core_members', $atts ) : $atts;

    extract(
        shortcode_atts(
            array(
                'style'             => '',
                'member_cat_slug'   => '',
                'img_size'          => '360x430',
                'margin'            => 30,
                'excerpt_max_chars' => 250,
                'limit'             => 3,
                'members_per_row'   => 3,
                'members_per_slide' => 2,
                'css_animation'     => '',
                'animation_delay'   => '0.4',   //In second
                'css'               => '',
            ), $atts
        )
    );

    $css_class = 'ts-members-wrap wow ' . $css_animation;
    if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
        $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
    endif;

    if ( !is_numeric( $animation_delay ) ) {
        $animation_delay = 0;
    }
    $animation_delay = $animation_delay . 's';

    $img_size_x = 360;
    $img_size_y = 430;
    if ( trim( $img_size ) != '' ) {
        $img_size = explode( 'x', $img_size );
    }
    $img_size_x = isset( $img_size[ 0 ] ) ? max( 1, intval( $img_size[ 0 ] ) ) : $img_size_x;
    $img_size_y = isset( $img_size[ 1 ] ) ? max( 1, intval( $img_size[ 1 ] ) ) : $img_size_y;

    $margin = intval( $margin );
    $excerpt_max_chars = max( 5, intval( $excerpt_max_chars ) );
    $members_per_row = min( 4, max( 1, intval( $members_per_row ) ) );
    $members_per_slide = min( 4, max( 1, intval( $members_per_slide ) ) );

    $html = '';

    $args = array(
        'post_type'           => 'member',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'showposts'           => intval( $limit ),
    );

    if ( trim( $member_cat_slug ) != '' ):

        $args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'member_cat',
                'field'    => 'slug',
                'terms'    => $member_cat_slug,
            ),
        );

    endif;

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        $i = 0;
        $member_class = 'ts-team';
        $css_class .= ' members-wrap-' . $style;
        if ( in_array( $style, array( 'style1' ) ) ) {
            switch ( $members_per_row ) {
                case 1:
                    $member_class .= ' col-xs-12 col-sm-12';
                    break;
                case 2:
                    $member_class .= ' col-xs-6';
                    break;
                case 3:
                    $member_class .= ' col-xs-12 col-sm-4';
                    break;
                case 4:
                    $member_class .= ' col-xs-6 col-sm-3';
                    break;
            }
        }
        if ( in_array( $style, array( 'style3' ) ) ) { // Carousel 1 member
            $css_class .= ' essence-owl-carousel owl-carousel';
            $members_per_slide = 1;
        }
        if ( in_array( $style, array( 'style2', 'style4' ) ) ) { // Carousel
            $css_class .= ' essence-owl-carousel owl-carousel';
        }

        while ( $query->have_posts() ) {
            $query->the_post();
            $i++;
            $html .= '<div class="' . esc_attr( $member_class ) . ' nth-' . $i . '">
                            ' . essence_core_member_shortcode_loop( $style, $img_size_x, $img_size_y, $excerpt_max_chars ) . '
                        </div><!-- /.ts-team -->';

        }
    }

    wp_reset_postdata();

    if ( $html != '' ) {
        $html = '<div class="' . esc_attr( $css_class ) . '" data-wow-delay="' . esc_attr( $animation_delay ) . '" data-margin="' . esc_attr( $margin ) . '" data-number="' . esc_attr( $members_per_slide ) . '" data-navcontrol="yes">
                    ' . $html . '
                </div>';
    }

    return $html;
}

add_shortcode( 'essence_core_members', 'essence_core_members' );

function essence_core_member_shortcode_loop( $style = 'style1', $img_size_x = 360, $img_size_y = 430, $excerpt_max_chars = 250 )
{

    $html = '';
    $title_html = '';
    $img_html = '';
    $position_html = '';
    $desc_html = '';
    $socials_html = '';
    $member_link_html = '';

    $member_link_type = get_post_meta( get_the_ID(), 'essence_member_link_type', true );
    if ( $member_link_type == 'permalink' ) {
        $member_link_html .= get_permalink();
    }
    if ( $member_link_type == 'custom' ) {
        $member_link_html .= get_post_meta( get_the_ID(), 'essence_member_custom_link', true );
    }

    if ( trim( get_the_title() ) != '' ) {
        if ( trim( $member_link_html ) != '' ) {
            $title_html .= '<h5 class="ts-team-name"><a href="' . esc_url( $member_link_html ) . '">' . sanitize_text_field( get_the_title() ) . '</a></h5>';
        }
        else {
            $title_html .= '<h5 class="ts-team-name">' . sanitize_text_field( get_the_title() ) . '</h5>';
        }
    }

    $img = essence_core_resize_image( null, null, $img_size_x, $img_size_y, true, true, false );
    $img_html .= '<figure><img width="' . esc_attr( $img[ 'width' ] ) . '" height="' . esc_attr( $img[ 'height' ] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) . '" title="' . get_the_title() . '" /></figure>';

    $position = get_post_meta( get_the_ID(), 'essence_member_pos', true );
    $position_html .= trim( $position ) != '' ? '<span class="ts-team-position">' . sanitize_text_field( $position ) . '</span>' : '';

    $desc_html .= '<div class="team-desc"><p>' . wp_trim_words( strip_tags( strip_shortcodes( get_the_content() ) ), $excerpt_max_chars, '...' ) . '</p></div>';

    $socicals = get_post_meta( get_the_ID(), 'essence_member_socials_group', true );

    if ( !empty( $socicals ) ) {
        foreach ( $socicals as $socical ) {
            $icon_class = isset( $socical[ 'social_icon_class' ] ) ? esc_attr( $socical[ 'social_icon_class' ] ) : '';
            $link = isset( $socical[ 'social_link' ] ) ? esc_url( $socical[ 'social_link' ] ) : '';
            if ( trim( $icon_class ) != '' && trim( $link ) != '' ) {
                $socials_html .= '<a href="' . $link . '"><span class="screen-reader-text">' . esc_html__( 'Social link', 'essence-core' ) . '</span><i class="' . $icon_class . '"></i></a>';
            }
        }
        if ( trim( $socials_html ) != '' ) {
            $socials_html = '<div class="social-links">' . $socials_html . '</div>';
        }
    }

    switch ( $style ) {
        case 'style1':
            $html .= '<div class="member member-' . esc_attr( $style ) . '">
                            ' . $img_html . '
                            <div class="ts-team-content">
                            ' . $title_html . '
                            ' . $position_html . '
                            ' . $socials_html . '
                            </div><!-- /.ts-team-content -->
                        </div>';
            break;
        case 'style2':
        case 'style4': // Carousel
            $html .= '<div class="member member-' . esc_attr( $style ) . '">
                            ' . $img_html . '
                            <div class="ts-team-content">
                            ' . $title_html . '
                            ' . $position_html . '
                            ' . $desc_html . '
                            ' . $socials_html . '
                            </div><!-- /.ts-team-content -->
                        </div>';
            break;
        case 'style3': // Carousel 1 member
            $member_no_img_src = essence_core_no_image( array( 'width' => $img_size_x, 'height' => $img_size_y ), false, true );
            $img_html = '<div class="member-img-wrap equal-elem" style="background: url(\'' . esc_url( $img[ 'url' ] ) . '\') center center transparent no-repeat; background-size: cover;">
                            <figure><img width="' . esc_attr( $img_size_y ) . '" height="' . esc_attr( $img_size_x ) . '" src="' . esc_url( $member_no_img_src ) . '" alt="' . esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) . '" title="' . get_the_title() . '" /></figure>
                        </div>';
            //$img_html .= '<figure><img width="' . esc_attr( $img[ 'width' ] ) . '" height="' . esc_attr( $img[ 'height' ] ) . '" src="' . esc_url( $img[ 'url' ] ) . '" alt="' . esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ) . '" title="' . get_the_title() . '" /></figure>';
            $html .= '<div class="member ts-team-content-wrap equal-container member-' . esc_attr( $style ) . '">
                            ' . $img_html . '
                            <div class="ts-team-content equal-elem">
                            ' . $title_html . '
                            ' . $position_html . '
                            ' . $desc_html . '
                            ' . $socials_html . '
                            </div><!-- /.ts-team-content -->
                        </div>';
            break;
    }

    return $html;

}