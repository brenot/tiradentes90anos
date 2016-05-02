<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Essence
 */

$essence = essence_get_global_essence();

$footer_layout = isset( $essence['opt_footer_layout'] ) ? $essence['opt_footer_layout'] : 'style-1'; // style-1 = dark, style-2 = light, style-3 = footer simple, style-4 = dark 2
$footer_class = 'site-footer footer-'.esc_attr( $footer_layout );
$footer_part_1_class = 'footer-part-1 col-xs-12';
$footer_part_2_class = 'footer-part-2 col-xs-12';
switch ( $footer_layout ) {
    case 'style-1':
        $footer_class .= ' footer-style-dark';
        $footer_part_1_class .= ' footer-top';
        $footer_part_2_class .= ' footer-bottom';
        break;
    case 'style-2':
        $footer_class .= ' footer-style-light';
        $footer_part_1_class .= ' footer-top';
        $footer_part_2_class .= ' footer-bottom';
        break;
    case 'style-3':
        $footer_class .= ' footer-style-simple';
        $footer_part_1_class .= ' footer-left col-sm-6';
        $footer_part_2_class .= ' footer-right col-sm-6';
        break;
    case 'style-4':
        $footer_class .= ' footer-style-dark-2';
        $footer_part_1_class .= ' footer-bottom';
        $footer_part_2_class .= ' footer-top';
        break;
}

$footer_dark_logo = isset( $essence['opt_footer_dark_logo'] ) ? $essence['opt_footer_dark_logo'] : array( 'url' => get_template_directory_uri().'/assets/images/footer_dark_logo.png' );
$footer_light_logo = isset( $essence['opt_footer_light_logo'] ) ? $essence['opt_footer_light_logo'] : array( 'url' => get_template_directory_uri().'/assets/images/footer_light_logo.png' );
$footer_logo = $footer_layout == 'style-1' ? $footer_dark_logo : $footer_light_logo;

$footer_copyright_text = isset( $essence['opt_footer_copyright_text'] ) ? $essence['opt_footer_copyright_text'] : sprintf( esc_html__( 'Proudly powered by %s', 'essence' ), 'WordPress' );

$allow_tags = array( 'a' => array( 'href' => array(), 'target' => array(), 'title' => array(), ), 'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(), 'p' => array(), 'strong' => array(), 'b' => array(), 'i' => array(), 'em' => array(), 'span' => array(), );

?>
</div><!-- /.row -->
</div><!-- /.site-content-inner -->
</div><!-- /.main-body-->
</div><!-- #main-wraper -->

<footer id="colophon" class="<?php echo esc_attr( $footer_class ); ?>" role="contentinfo">

    <div class="container footer-container">
        <div class="row">
            <div class="<?php echo esc_attr( $footer_part_1_class ); ?>">
                <?php if ( trim( $footer_logo['url'] ) != '' && in_array( $footer_layout, array( 'style-1', 'style-2' ) ) ): ?>
                    <div class="logo-footer"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img
                                src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="footer_logo"/></a></div>
                <?php endif; // End if ( trim( $footer_logo['url'] ) != '' && in_array( $footer_layout, array( 'style-1', 'style-2' ) ) ) ?>

                <?php if ( in_array( $footer_layout, array( 'style-1', 'style-2', 'style-4' ) ) && has_nav_menu( 'footer_menu' ) ): ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'container' => false, 'menu_id' => 'footer-menu', 'menu_class' => 'menu-footer', )
                    ); ?>
                <?php endif; // End if ( in_array( $footer_layout, array( 'style-1', 'style-2' ) ) && has_nav_menu( 'footer_menu' ) ) ?>

                <?php if ( in_array( $footer_layout, array( 'style-3' ) ) ) { ?>
                    <div
                        class="copyright"><?php echo wp_kses( wpautop( $footer_copyright_text ), $allow_tags ); ?></div>
                <?php } ?>

            </div><!-- /.footer-part-1 -->

            <?php if ( in_array( $footer_layout, array( 'style-1', 'style-2' ) ) ) { ?>

        </div>
    </div><!-- /.footer-container -->
    <div class="footer-separator"></div>
    <div class="container footer-container">
        <div class="row">

            <?php } ?>

            <div class="<?php echo esc_attr( $footer_part_2_class ); ?>">
                <?php if ( in_array( $footer_layout, array( 'style-1', 'style-2' ) ) ) { ?>
                    <div
                        class="copyright"><?php echo wp_kses( wpautop( $footer_copyright_text ), $allow_tags ); ?></div>
                <?php } ?>
                <?php if ( in_array( $footer_layout, array( 'style-3' ) ) && has_nav_menu( 'footer_menu' ) ): ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'container' => false, 'menu_id' => 'footer-menu', 'menu_class' => 'menu-footer', )
                    ); ?>
                <?php endif; // End if ( in_array( $footer_layout, array( 'style-3' ) ) && has_nav_menu( 'footer_menu' ) ) ?>
                <?php if ( in_array( $footer_layout, array( 'style-4' ) ) ) { ?>
                    <div
                        class="copyright"><?php echo wp_kses( wpautop( $footer_copyright_text ), $allow_tags ); ?></div>
                <?php } ?>
            </div><!-- /.footer-part-2 -->
        </div>
    </div><!-- /.footer-container -->

    <a class="backtotop" href="#">
        <span class="fa fa-angle-up"></span>
    </a>

</footer><!-- #colophon -->
</div><!-- #main-wraper -->

<?php wp_footer(); ?>

</body>
</html>
