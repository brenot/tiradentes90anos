<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}


add_action( 'after_setup_theme', 'essence_core_init_vc_global', 1 );

function essence_core_init_vc_global()
{
    // Check if Visual Composer is installed
    if ( !defined( 'WPB_VC_VERSION' ) ) {
        return;
    }

    if ( version_compare( WPB_VC_VERSION, '4.2', '<' ) ) {

        add_action( 'init', 'essence_core_add_vc_global_params', 100 );

    }
    else {

        add_action( 'vc_after_mapping', 'essence_core_add_vc_global_params' );

    }
}

function essence_core_add_vc_global_params()
{

    // Check if Visual Composer is installed
    if ( !defined( 'WPB_VC_VERSION' ) ) {
        return;
    }

    // Visual composer support equal columns since v4.9, so we do not need add custom vc_row with VC version from 4.9 or newer
    if ( version_compare( WPB_VC_VERSION, '4.9', '<' ) ) {
        vc_set_shortcodes_templates_dir( ESSENCE_CORE_DIR_PATH . '/core/shortcodes/vc_templates/' );

//        global $vc_setting_row, $vc_setting_row_inner;
//        vc_add_params( 'vc_row', $vc_setting_row );
//        vc_add_params( 'vc_row_inner', $vc_setting_row_inner );
    }

//    vc_add_params( 'vc_icon', $vc_setting_icon_shortcode );
//    vc_add_params( 'vc_column', $vc_setting_col );
//    vc_add_params( 'vc_column_inner', $vc_setting_column_inner );


    vc_add_shortcode_param( 'essence_core_select_product_cat_field', 'essence_core_select_product_cat_field' );
    vc_add_shortcode_param( 'essence_core_select_cat_field', 'essence_core_select_cat_field' );
    vc_add_shortcode_param( 'essence_core_select_member_cat_field', 'essence_core_select_member_cat_field' );
    vc_add_shortcode_param( 'essence_core_datepicker', 'essence_core_datepicker' );

}

if ( !function_exists( 'essence_core_datepicker' ) ) {
    function essence_core_datepicker( $settings, $value )
    {
        return '<div class="ts-date-picker-wrap">'
        . '<input name="' . esc_attr( $settings[ 'param_name' ] ) . '" class="wpb_vc_param_value wpb-textinput ts-date-picker ' .
        esc_attr( $settings[ 'param_name' ] ) . ' ' .
        esc_attr( $settings[ 'type' ] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
        '</div><!-- /.ts-date-picker-wrap -->'; // This is html markup that will be outputted in content elements edit form
    }
}

if ( !function_exists( 'essence_core_custom_taxonomy_opt_walker' ) ) :
    /**
     *  Return terms array
     *
     * @since 1.0
     **/
    function essence_core_custom_taxonomy_opt_walker( &$terms_select_opts = array(), $taxonomy, $parent = 0, $lv = 0 )
    {

        $terms = get_terms( $taxonomy, array( 'parent' => $parent, 'hide_empty' => false ) );

        if ( $parent > 0 ):
            $lv++;
        endif;

        //If there are terms
        if ( count( $terms ) > 0 ):
            $prefix = '';
            if ( $lv > 0 ):
                for ( $i = 1; $i <= $lv; $i++ ):
                    $prefix .= '-- ';
                endfor;
            endif;

            //Cycle though the terms
            foreach ( $terms as $term ):
                $terms_select_opts[ $term->term_id ] = htmlentities2( $prefix . $term->name );

                //Function calls itself to display child elements, if any
                essence_core_custom_taxonomy_opt_walker( $terms_select_opts, $taxonomy, $term->term_id, $lv );
            endforeach;

        endif;

    }
endif; // Endif !function_exists( 'essence_core_custom_taxonomy_opt_walker' )


if ( !function_exists( 'essence_core_procats_slug_select' ) ) {

    /**
     *  Option values are slugs
     **/
    function essence_core_procats_slug_select( $selected_procat_slugs = array(), $settings = array() )
    {

        if ( !class_exists( 'WooCommerce' ) ):
            return false;
        endif;

        $term_args = array();
        $default_settings = array(
            'multiple'          => false,
            'id'                => '',
            'name'              => '',
            'class'             => '',
            'first_option'      => false,
            'first_select_val'  => '',
            'first_select_text' => __( ' --------------- ', 'essence-core' ),
        );

        $settings = wp_parse_args( $settings, $default_settings );

        $attrs = '';
        $attrs .= ( trim( $settings[ 'id' ] ) != '' ) ? 'id="' . esc_attr( $settings[ 'id' ] ) . '"' : '';
        $attrs .= ( trim( $settings[ 'name' ] ) != '' ) ? ' name="' . esc_attr( $settings[ 'name' ] ) . '"' : '';
        $attrs .= ( $settings[ 'multiple' ] === true ) ? ' multiple="true"' : '';

        essence_core_custom_taxonomy_opt_walker( $term_args, 'product_cat' );

        $html = '';
        if ( !empty( $term_args ) ):

            $html .= '<select ' . $attrs . ' class="noren-select ' . $settings[ 'class' ] . '">';

            if ( $settings[ 'first_option' ] ):
                $html .= '<option ' . selected( in_array( 0, $selected_procat_slugs ), true, false ) . ' value="' . esc_attr( $settings[ 'first_select_val' ] ) . '">' . sanitize_text_field( $settings[ 'first_select_text' ] ) . '</option>';
            endif;

            foreach ( $term_args as $term_id => $term_name ):

                $term = get_term( $term_id, 'product_cat' );
                if ( !is_wp_error( $term ) ) {
                    $html .= '<option ' . selected( in_array( $term->slug, $selected_procat_slugs ), true, false ) . ' value="' . esc_attr( $term->slug ) . '">' . sanitize_text_field( $term_name ) . '</option>';
                }

            endforeach;
            $html .= '</select>';

        endif;

        $html .= ob_get_clean();

        return $html;

    }
}; // Endif if ( !function_exists( 'essence_core_procats_select' ) )

if ( !function_exists( 'essence_core_custom_tax_slug_select' ) ):
    function essence_core_custom_tax_slug_select( $selected_tax_slugs = array(), $settings = array() )
    {

        $term_args = array();
        $default_settings = array(
            'tax'               => 'category',
            'multiple'          => false,
            'id'                => '',
            'name'              => '',
            'class'             => '',
            'first_option'      => false,
            'first_option_val'  => '',
            'first_option_text' => __( ' --------------- ', 'essence-core' ),
        );

        $settings = wp_parse_args( $settings, $default_settings );

        if ( !taxonomy_exists( $settings[ 'tax' ] ) ):

            return false;

        endif;

        $attrs = '';
        $attrs .= ( trim( $settings[ 'id' ] ) != '' ) ? 'id="' . esc_attr( $settings[ 'id' ] ) . '"' : '';
        $attrs .= ( trim( $settings[ 'name' ] ) != '' ) ? ' name="' . esc_attr( $settings[ 'name' ] ) . '"' : '';
        $attrs .= ( $settings[ 'multiple' ] === true ) ? ' multiple="true"' : '';

        essence_core_custom_taxonomy_opt_walker( $term_args, $settings[ 'tax' ] );

        $html = '';
        if ( !empty( $term_args ) ):

            $html .= '<select ' . $attrs . ' class="noren-select ' . esc_attr( $settings[ 'class' ] ) . '">';

            if ( $settings[ 'first_option' ] ):
                $html .= '<option ' . selected( in_array( 0, $selected_tax_slugs ), true, false ) . ' value="' . esc_attr( $settings[ 'first_option_val' ] ) . '">' . sanitize_text_field( $settings[ 'first_option_text' ] ) . '</option>';
            endif;

            foreach ( $term_args as $term_id => $term_name ):

                $term = get_term( $term_id, $settings[ 'tax' ] );
                if ( !is_wp_error( $term ) ) {
                    $html .= '<option ' . selected( in_array( $term->slug, $selected_tax_slugs ), true, false ) . ' value="' . esc_attr( $term->slug ) . '">' . $term_name . '</option>';
                }

            endforeach;
            $html .= '</select>';

        else:
            if ( $settings[ 'first_option' ] ) {
                $html .= '<select ' . $attrs . ' class="noren-select ' . esc_attr( $settings[ 'class' ] ) . '">';
                $html .= '<option ' . selected( in_array( 0, $selected_tax_slugs ), true, false ) . ' value="' . esc_attr( $settings[ 'first_option_val' ] ) . '">' . sanitize_text_field( $settings[ 'first_option_text' ] ) . '</option>';
                $html .= '</select>';
            }
        endif; // End if ( !empty( $term_args ) ):

        return $html;

    }
endif; // Endif if ( !function_exists( 'essence_core_custom_tax_slug_select' ) )

function essence_core_select_member_cat_field( $settings, $value )
{

    return '<div class="select_member_cat_block">'
    . essence_core_custom_tax_slug_select(
        array( $value ),
        array(
            'tax'               => 'member_cat',
            'class'             => 'wpb_vc_param_value',
            'name'              => $settings[ 'param_name' ],
            'first_option'      => true,
            'first_option_val'  => '',
            'first_option_text' => esc_html__( ' --- All Categories --- ', 'essence-core' ),
        )
    )
    . '</div>';
}

function essence_core_select_product_cat_field( $settings, $value )
{

    return '<div class="select_pro_cat_block">'
    . essence_core_procats_slug_select(
        array( $value ),
        array(
            'class'             => 'wpb_vc_param_value',
            'name'              => $settings[ 'param_name' ],
            'first_option'      => true,
            'first_select_val'  => '',
            'first_select_text' => __( ' --- All Categories --- ', 'essence-core' ),
        )
    )
    . '</div>';
}

function essence_core_select_cat_field( $settings, $value )
{

    return '<div class="select_post_cat_block">'
    . essence_core_custom_tax_slug_select(
        array( $value ),
        array(
            'tax'               => 'category',
            'class'             => 'wpb_vc_param_value',
            'name'              => $settings[ 'param_name' ],
            'first_option'      => true,
            'first_option_val'  => '',
            'first_option_text' => __( ' --- All Categories --- ', 'essence-core' ),
        )
    )
    . '</div>';
}


if ( !function_exists( 'essence_core_product_loop' ) ) {
    function essence_core_product_loop( $query_args, $atts, $loop_name, $extra_class = '' )
    {

        if ( !class_exists( 'WooCommerce' ) ):
            return false;
        endif;

        global $woocommerce_loop, $before_loop_extra_class;

        $before_loop_extra_class .= trim( ' ' . $extra_class );

        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );
        $columns = absint( $atts[ 'columns' ] );
        $woocommerce_loop[ 'columns' ] = $columns;

        ob_start();

        if ( $products->have_posts() ) : ?>

            <?php do_action( "woocommerce_shortcode_before_{$loop_name}_loop" ); ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action( "woocommerce_shortcode_after_{$loop_name}_loop" ); ?>

        <?php endif;

        woocommerce_reset_loop();
        wp_reset_postdata();

        return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
    }
}

if ( !function_exists( 'essence_core_no_image' ) ) {

    /**
     * No image generator
     *
     * @since 1.0
     *
     * @param $size : array, image size
     * @param $echo : bool, echo or return no image url
     **/
    function essence_core_no_image( $size = array( 'width' => 500, 'height' => 500 ), $echo = false, $transparent = false )
    {
        $plugin_dir = ESSENCE_CORE_DIR_PATH;  // Change me if you want into for theme.
        $plugin_uri = trailingslashit( plugins_url( 'essence-core' ) ); // You should change plugin-name. Change me if you want into for theme.

        $suffix = ( $transparent ) ? '_transparent' : '';

        if ( !is_array( $size ) || empty( $size ) ):
            $size = array( 'width' => 500, 'height' => 500 );
        endif;

        if ( !is_numeric( $size[ 'width' ] ) && $size[ 'width' ] == '' || $size[ 'width' ] == null ):
            $size[ 'width' ] = 'auto';
        endif;

        if ( !is_numeric( $size[ 'height' ] ) && $size[ 'height' ] == '' || $size[ 'height' ] == null ):
            $size[ 'height' ] = 'auto';
        endif;

        // base image must be exist
        $img_base_fullpath = $plugin_dir . 'assets/images/noimage/no_image' . $suffix . '.png';
        $no_image_src = $plugin_uri . 'assets/images/noimage/no_image' . $suffix . '.png';

        // Check no image exist or not
        if ( !file_exists( $plugin_dir . 'assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png' ) && is_writable( $plugin_dir . 'assets/images/noimage/no_image' ) ):

            $no_image = wp_get_image_editor( $img_base_fullpath );

            if ( !is_wp_error( $no_image ) ):
                $no_image->resize( $size[ 'width' ], $size[ 'height' ], true );
                $no_image_name = $no_image->generate_filename( $size[ 'width' ] . 'x' . $size[ 'height' ], $plugin_dir . '/assets/images/noimage/', null );
                $no_image->save( $no_image_name );

            endif;

        endif;

        // Check no image exist after resize
        $noimage_path_exist_after_resize = $plugin_dir . '/assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png';

        if ( file_exists( $noimage_path_exist_after_resize ) ):
            $no_image_src = $plugin_uri . '/assets/images/noimage/no_image' . $suffix . '-' . $size[ 'width' ] . 'x' . $size[ 'height' ] . '.png';
        endif;

        if ( $echo ):
            echo $no_image_src;
        else:
            return $no_image_src;
        endif;

    }
}

if ( !function_exists( 'essence_core_resize_image' ) ) {
    /**
     * @param int    $attach_id
     * @param string $img_url
     * @param int    $width
     * @param int    $height
     * @param bool   $crop
     * @param bool   $place_hold        Using place hold image if the image does not exist
     * @param bool   $use_real_img_hold Using real image for holder if the image does not exist
     * @param string $solid_img_color   Solid placehold image color (not text color). Random color if null
     *
     * @since 1.0
     * @return array
     */
    function essence_core_resize_image( $attach_id = null, $img_url = null, $width, $height, $crop = false, $place_hold = true, $use_real_img_hold = true, $solid_img_color = null )
    {

        // If is singular and has post thumbnail and $attach_id is null, so we get post thumbnail id automatic
        if ( is_singular() && !$attach_id && !$img_url ) {
            if ( has_post_thumbnail() && !post_password_required() ) {
                $attach_id = get_post_thumbnail_id();
            }
        }

        // this is an attachment, so we have the ID
        $image_src = array();
        if ( $attach_id ) {
            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $actual_file_path = get_attached_file( $attach_id );
            // this is not an attachment, let's use the image url
        }
        else {
            if ( $img_url ) {
                $file_path = str_replace( get_site_url(), ABSPATH, $img_url );
                $actual_file_path = rtrim( $file_path, '/' );
                if ( !file_exists( $actual_file_path ) ) {
                    $file_path = parse_url( $img_url );
                    $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path[ 'path' ];
                }
                if ( file_exists( $actual_file_path ) ) {
                    $orig_size = getimagesize( $actual_file_path );
                    $image_src[ 0 ] = $img_url;
                    $image_src[ 1 ] = $orig_size[ 0 ];
                    $image_src[ 2 ] = $orig_size[ 1 ];
                }
                else {
                    $image_src[ 0 ] = '';
                    $image_src[ 1 ] = 0;
                    $image_src[ 2 ] = 0;
                }
            }
        }
        if ( !empty( $actual_file_path ) && file_exists( $actual_file_path ) ) {
            $file_info = pathinfo( $actual_file_path );
            $extension = '.' . $file_info[ 'extension' ];

            // the image path without the extension
            $no_ext_path = $file_info[ 'dirname' ] . '/' . $file_info[ 'filename' ];

            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

            // checking if the file size is larger than the target size
            // if it is smaller or the same size, stop right here and return
            if ( $image_src[ 1 ] > $width || $image_src[ 2 ] > $height ) {

                // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
                if ( file_exists( $cropped_img_path ) ) {
                    $cropped_img_url = str_replace( basename( $image_src[ 0 ] ), basename( $cropped_img_path ), $image_src[ 0 ] );
                    $vt_image = array(
                        'url'    => $cropped_img_url,
                        'width'  => $width,
                        'height' => $height,
                    );

                    return $vt_image;
                }

                // $crop = false
                if ( $crop == false ) {
                    // calculate the size proportionaly
                    $proportional_size = wp_constrain_dimensions( $image_src[ 1 ], $image_src[ 2 ], $width, $height );
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[ 0 ] . 'x' . $proportional_size[ 1 ] . $extension;

                    // checking if the file already exists
                    if ( file_exists( $resized_img_path ) ) {
                        $resized_img_url = str_replace( basename( $image_src[ 0 ] ), basename( $resized_img_path ), $image_src[ 0 ] );

                        $vt_image = array(
                            'url'    => $resized_img_url,
                            'width'  => $proportional_size[ 0 ],
                            'height' => $proportional_size[ 1 ],
                        );

                        return $vt_image;
                    }
                }

                // no cache files - let's finally resize it
                $img_editor = wp_get_image_editor( $actual_file_path );

                if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                    );
                }

                $new_img_path = $img_editor->generate_filename();

                if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                    );
                }
                if ( !is_string( $new_img_path ) ) {
                    return array(
                        'url'    => '',
                        'width'  => '',
                        'height' => '',
                    );
                }

                $new_img_size = getimagesize( $new_img_path );
                $new_img = str_replace( basename( $image_src[ 0 ] ), basename( $new_img_path ), $image_src[ 0 ] );

                // resized output
                $vt_image = array(
                    'url'    => $new_img,
                    'width'  => $new_img_size[ 0 ],
                    'height' => $new_img_size[ 1 ],
                );

                return $vt_image;
            }

            // default output - without resizing
            $vt_image = array(
                'url'    => $image_src[ 0 ],
                'width'  => $image_src[ 1 ],
                'height' => $image_src[ 2 ],
            );

            return $vt_image;
        }
        else {
            if ( $place_hold ) {
                $width = intval( $width );
                $height = intval( $height );

                // Real image place hold (https://unsplash.it/)
                if ( $use_real_img_hold ) {
                    $random_time = time() + rand( 1, 100000 );
                    $vt_image = array(
                        'url'    => 'https://unsplash.it/' . $width . '/' . $height . '?random&time=' . $random_time,
                        'width'  => $width,
                        'height' => $height,
                    );
                }
                else {
                    $color = $solid_img_color;
                    if ( is_null( $color ) || trim( $color ) == '' ) {
                        // Random color
                        // $color = str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT ) . str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT ) . str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT );

                        // Show no image (gray)
                        $vt_image = array(
                            'url'    => essence_core_no_image( array( 'width' => $width, 'height' => $height ) ),
                            'width'  => $width,
                            'height' => $height,
                        );
                    }
                    else {
                        if ( $color == 'transparent' ) { // Show no image transparent
                            $vt_image = array(
                                'url'    => essence_core_no_image( array( 'width' => $width, 'height' => $height ), false, true ),
                                'width'  => $width,
                                'height' => $height,
                            );
                        }
                        else { // No image with color from placehold.it
                            $vt_image = array(
                                'url'    => 'http://placehold.it/' . $width . 'x' . $height . '/' . $color . '/ffffff/',
                                'width'  => $width,
                                'height' => $height,
                            );
                        }
                    }
                }

                return $vt_image;
            }
        }

        return false;
    }
}

if ( !function_exists( 'essence_core_product_sharers' ) ) {
    function essence_core_product_sharers()
    {
        global $essence;
        $enable_share_post = isset( $essence[ 'opt_enable_share_product' ] ) ? $essence[ 'opt_enable_share_product' ] == 1 : false;
        $socials_shared = isset( $essence[ 'opt_single_product_socials_share' ] ) ? $essence[ 'opt_single_product_socials_share' ] : array();

        ?>

        <?php if ( $enable_share_post && !empty( $socials_shared ) ): ?>

        <div class="product-share">
            <span class="share-product-title"><?php esc_html_e( 'Share this product', 'essence-core' ); ?></span>
            <ul class="product-socials-share-wrap">
                <li>
                    <?php if ( in_array( 'facebook', $socials_shared ) ): ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>"
                           target="_blank"><i class="fa fa-facebook"></i><span
                                class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Facebook', 'essence-core' ), get_the_title() ); ?></span></a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ( in_array( 'gplus', $socials_shared ) ): ?>
                        <a href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>"
                           target="_blank"><i class="fa fa-google-plus"></i><span
                                class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Google Plus', 'essence-core' ), get_the_title() ); ?></span></a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ( in_array( 'twitter', $socials_shared ) ): ?>
                        <a href="https://twitter.com/home?status=<?php echo esc_url( get_permalink() ); ?>"
                           target="_blank"><i class="fa fa-twitter"></i><span
                                class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Twitter', 'essence-core' ), get_the_title() ); ?></span></a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ( in_array( 'pinterest', $socials_shared ) ): ?>
                        <a href="https://pinterest.com/pin/create/button/?url=&media=&description=<?php echo esc_url( get_permalink() ); ?>"
                           target="_blank"><i class="fa fa-pinterest"></i><span
                                class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on Pinterest', 'essence-core' ), get_the_title() ); ?></span></a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ( in_array( 'linkedin', $socials_shared ) ): ?>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo esc_url( get_permalink() ); ?>"
                           target="_blank"><i class="fa fa-linkedin"></i><span
                                class="screen-reader-text"><?php echo sprintf( esc_html__( 'Share "%s" on LinkedIn', 'essence-core' ), get_the_title() ); ?></span></a>
                    <?php endif; ?>
                </li>
            </ul><!-- /.product-socials-share-wrap -->
        </div><!-- /.product-share -->

    <?php endif; ?>

        <?php
    }
}

if ( !function_exists( 'essence_core_get_font_container_style' ) ) {

    /**
     * @param string|array $font_container
     *
     * @return string Style of font container
     *
     */
    function essence_core_get_font_container_style( $font_container = '' )
    {
        if ( !class_exists( 'Vc_Manager' ) ) {
            return false;
        }
        if ( !is_array( $font_container ) ) {
            $font_container = vc_parse_multi_attribute( $font_container );
        }
        $styles = array();
        if ( !empty( $font_container ) ) {
            foreach ( $font_container as $key => $value ) {
                if ( 'tag' !== $key && strlen( $value ) ) {
                    if ( preg_match( '/description/', $key ) ) {
                        continue;
                    }
                    if ( 'font_size' === $key || 'line_height' === $key ) {
                        $value = preg_replace( '/\s+/', '', $value );
                    }
                    if ( 'font_size' === $key ) {
                        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                        // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                        $regexr = preg_match( $pattern, $value, $matches );
                        $value = isset( $matches[ 1 ] ) ? (float) $matches[ 1 ] : (float) $value;
                        $unit = isset( $matches[ 2 ] ) ? $matches[ 2 ] : 'px';
                        $value = $value . $unit;
                    }
                    if ( strlen( $value ) > 0 ) {
                        $styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                    }
                }
            }
        }

        return implode( '; ', $styles );
    }
}

if ( !function_exists( 'essence_core_get_current_post_id' ) ) {
    function essence_core_get_current_post_id()
    {
        $post_id = 0; // Post, page or post type... id

        if ( is_front_page() && is_home() ) {
            // Default homepage
        }
        elseif ( is_front_page() ) {
            // static homepage
            $post_id = get_option( 'page_on_front' );
        }
        elseif ( is_home() ) {
            // blog page
            $post_id = get_option( 'page_for_posts' );
        }
        else {
            // Everything else

            // Is a singular
            if ( is_singular() ) {
                $post_id = get_the_ID();
            }
            else {
                // Is archive or taxonomy
                if ( is_archive() ) {
                    // Current version of theme does not support custom header for archive, global setting will be used

                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // Products archive, products category, products search page...
                        if ( is_shop() ) {
                            $post_id = get_option( 'woocommerce_shop_page_id' );
                        }
                        if ( is_product_category() ) {

                        }
                    }
                }
                else {
                    if ( is_404() ) {
                        // Current version of theme does not support custom header for 404 page, global setting will be used
                    }
                    else {
                        if ( is_search() ) {
                            // Current version of theme does not support custom header for search results page, global setting will be used
                        }
                        else {
                            // Is category, is tag, is tax
                            // Current version of theme does not support custom header for search results category, tag, tax.., global setting will be used
                        }
                    }
                }

            }
        }

        return $post_id;
    }
}

if ( !function_exists( 'essence_core_color_hex2rgba' ) ) {
    function essence_core_color_hex2rgba( $hex, $alpha = 1 )
    {
        $hex = str_replace( "#", "", $hex );

        if ( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        }
        else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }
        $rgb = array( $r, $g, $b );

        return 'rgba( ' . implode( ', ', $rgb ) . ', ' . $alpha . ' )'; // returns the rgb values separated by commas
    }
}

if ( !function_exists( 'essence_core_color_rgb2hex' ) ) {
    function essence_core_color_rgb2hex( $rgb )
    {
        $hex = '#';
        $hex .= str_pad( dechex( $rgb[ 0 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 1 ] ), 2, '0', STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 2 ] ), 2, '0', STR_PAD_LEFT );

        return $hex; // returns the hex value including the number sign (#)
    }
}