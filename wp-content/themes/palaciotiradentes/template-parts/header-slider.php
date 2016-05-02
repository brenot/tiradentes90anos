<?php
/**
 * Template part for displaying header slider or header image.
 *
 * @package Essence
 */


$header_settings = essence_get_header_setting();
$title_style = trim( $header_settings[ 'opt_title_color' ] ) != '' ? 'color: ' . esc_attr( $header_settings[ 'opt_title_color' ] ) : '';
$breadcrumb_color = trim( $header_settings[ 'opt_breadcrumb_color' ] ) != '' ? $header_settings[ 'opt_breadcrumb_color' ] : '';

?>

<?php if ( trim( $header_settings[ 'opt_header_slider' ] ) != '' || trim( $header_settings[ 'opt_header_img_url' ] ) != '' ) { ?>

    <div class="header-banner-wrap">
        <?php if ( ( trim( $header_settings[ 'opt_header_slider' ] ) != '' && trim( $header_settings[ 'opt_header_slider' ] ) != '-1' ) && class_exists( 'RevSliderOutput' ) ) { ?>
            <div class="essence-banner-revolution">
                <?php RevSliderOutput::putSlider( $header_settings[ 'opt_header_slider' ] ); ?>
            </div>
        <?php }
        else { ?>
            <?php if ( trim( $header_settings[ 'opt_header_img_url' ] ) != '' ) { ?>
                <div class="essence-banner-image"
                     style='background-image: url("<?php echo esc_url( $header_settings[ 'opt_header_img_url' ] ); ?>")'>

                </div>
            <?php } ?>
            <?php if ( trim( $header_settings[ 'opt_title' ] ) != '' || trim( $header_settings[ 'opt_show_breadcrumb' ] ) != '' ) { ?>
                <?php if ( trim( $header_settings[ 'opt_header_img_url' ] ) != '' || trim( $header_settings[ 'opt_header_slider' ] ) != '' ) { ?>
                    <div class="tr-content-title-banner">
                        <?php if ( trim( $header_settings[ 'opt_title' ] ) != '' ) { ?>
                            <div class="header-title-wrap">
                                <h2 class="header-title"
                                    style="<?php echo esc_attr( $title_style ); ?>"><?php echo sanitize_text_field( $header_settings[ 'opt_title' ] ); ?></h2>
                            </div>
                        <?php } ?>

                        <?php if ( trim( $header_settings[ 'opt_show_breadcrumb' ] ) ) { ?>
                            <div class="header-breadcrumb-wrap color-changer1"
                                 data-color="<?php echo esc_attr( $breadcrumb_color ); ?>" data-c-target="span, li">
                                <?php essence_breadcrumb(); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php }; ?>

        <?php if ( $header_settings[ 'opt_enable_header_scroll_down' ] == 1 ) { ?>
            <?php if ( trim( $header_settings[ 'opt_header_scroll_down_img_url' ] ) != '' ) { ?>
                <div class="header-scrolldown-wrap">
                    <a href="#" class="header-scrolldown">
                        <img src="<?php echo esc_url( $header_settings[ 'opt_header_scroll_down_img_url' ] ) ?>"
                             alt="<?php echo esc_html__( 'Header Scroll Down', 'essence' ) ?>">
                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

<?php }; ?>
