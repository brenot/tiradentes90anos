<?php
/**
 * Template part for displaying header layout.
 *
 * @package Essence
 */

$essence = essence_get_global_essence();

$header_settings = essence_get_header_setting();

$header_logo = array( 'url' => $header_settings[ 'opt_logo_url' ] );

if ( trim( $header_settings[ 'opt_menu' ] ) != '' ) {
    $menu_custom = get_term_by( 'slug', $header_settings[ 'opt_menu' ], 'nav_menu' );
    $menu_args = array(
        'menu_class'  => 'nav-menu',
        'menu_id'     => 'navbar',
        'menu'        => $menu_custom,
        //'theme_location' => 'primary',
        'walker'      => new ts_wp_bootstrap_navwalker(),
        'fallback_cb' => 'ts_wp_bootstrap_navwalker::fallback',
    );
}
else {
    $menu_args = array(
        'menu_class'     => 'nav-menu',
        'menu_id'        => 'navbar',
        'theme_location' => 'primary',
        'walker'         => new ts_wp_bootstrap_navwalker(),
        'fallback_cb'    => 'ts_wp_bootstrap_navwalker::fallback',
    );
}

$menu_color = trim( $header_settings[ 'opt_menu_color' ] ) != '' ? $header_settings[ 'opt_menu_color' ] : '';
$menu_hover_color = trim( $header_settings[ 'opt_menu_hover_color' ] ) != '' ? $header_settings[ 'opt_menu_hover_color' ] : '';
$menu_bg_color = trim( $header_settings[ 'opt_menu_bg_color' ] ) != '' ? $header_settings[ 'opt_menu_bg_color' ] : '';
$top_header_bg_color = trim( $header_settings[ 'opt_top_header_bg_color' ] ) != '' ? $header_settings[ 'opt_top_header_bg_color' ] : '';
$menu_sticky = isset( $essence[ 'opt_enable_menu_sticky' ] ) ? $essence[ 'opt_enable_menu_sticky' ] : '';
$class_menu = '';
if ( trim( $menu_sticky ) == '1' ) {
    $class_menu = 'essence_menu_sticky';
}


?>
<?php if ( trim( $header_settings[ 'opt_header_type' ] ) == 'header-v1' ) : ?>

    <header id="site-head" class="site-header header-style-1 <?php echo esc_attr( $class_menu ); ?>">
        <div class="site-header-top">
            <div class="container">
                <div class="tr-header bg-color-changer" data-bg-color="<?php echo esc_attr( $top_header_bg_color ) ?>">
                    <div class="site-logo">
                        <?php if ( trim( $header_logo[ 'url' ] ) != '' ): ?>
                            <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img
                                        src="<?php echo esc_url( $header_logo[ 'url' ] ); ?>" alt="logo"/></a></div>
                        <?php endif; ?>
                    </div><!-- .site-logo -->

                    <a href="javascript:void(0)" class="search-togole"><i class="fa fa-search"></i></a>
                    <?php if ( class_exists( 'WooCommerce' ) ): ?>
                        <?php
                        global $woocommerce;
                        ?>
                        <div class="header-inner-right mini-shoping-cart-wraper">
                            <a title="View your shopping cart"
                               href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"
                               class="cart-contents button-togole togole-cart">
                                <span class="elegant-icon icon_cart"></span>
                                <span class="cart-number-items">
                                    <?php echo sprintf( __( '%d', 'themestudio' ), $woocommerce->cart->cart_contents_count ); ?>
                                </span>
                            </a>
                            <div class="dropdown-menu mini-shoping-cart widget shoping-cart-widget">
                                <div class="mini-shopping_cart_content widget_shopping_cart_content">
                                    <?php wc_get_template( 'cart/mini-cart.php' ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; // End if ( class_exists( 'WooCommerce' ) ) ?>
                    <div class="main-nav color-changer bg-color-changer"
                         data-color="<?php echo esc_attr( $menu_color ); ?>"
                         data-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                         data-hover-color="<?php echo esc_attr( $menu_hover_color ); ?>"
                         data-hover-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                         data-bg-color="<?php echo esc_attr( $menu_bg_color ) ?>" data-bgc-target="">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#site-navigation" aria-expanded="false"
                                aria-controls="site-navigation">
                                <span class="linea-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                        </button>
                        <nav id="site-navigation" class="collapse main-navigation">
                            <?php
                            // Primary navigation menu.
                            wp_nav_menu( $menu_args );
                            ?>
                        </nav><!-- .main-navigation -->
                    </div><!-- .main-nav -->
                </div>
            </div>
        </div>

        <?php get_template_part( 'template-parts/header-slider' ); ?>

    </header><!-- .site-header v1-->
<?php elseif ( trim( $header_settings[ 'opt_header_type' ] ) == 'header-v2' ) : ?>
    <header id="site-head"
            class="site-header header-style-2 header-full-height-box <?php echo esc_attr( $class_menu ); ?>">
        <div class="site-header-inner">
            <div class="tr-header bg-color-changer" data-bg-color="<?php echo esc_attr( $top_header_bg_color ) ?>">
                <div class="site-logo">
                    <?php if ( trim( $header_logo[ 'url' ] ) != '' ): ?>
                        <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img
                                    src="<?php echo esc_url( $header_logo[ 'url' ] ); ?>" alt="logo"/></a></div>
                    <?php endif; ?>
                </div><!-- .site-branding -->
            </div>
            <div class="essence-head-banner">

                <?php get_template_part( 'template-parts/header-slider' ); ?>

                <div class="main-nav color-changer bg-color-changer"
                     data-color="<?php echo esc_attr( $menu_color ); ?>"
                     data-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                     data-hover-color="<?php echo esc_attr( $menu_hover_color ); ?>"
                     data-hover-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                     data-bg-color="<?php echo esc_attr( $menu_bg_color ) ?>" data-bgc-target="">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#site-navigation" aria-expanded="true"
                            aria-controls="site-navigation">
                        <span class="text-only">Menu</span>
                            <span class="linea-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                    </button>
                    <nav id="site-navigation" class="collapse main-navigation">
                        <?php
                        // Primary navigation menu.
                        wp_nav_menu( $menu_args );
                        ?>
                    </nav><!-- .main-navigation -->
                </div><!-- .main-nav -->
            </div><!-- .essence-head-banner -->
        </div>
    </header><!-- .site-header v2-->
<?php else : ?>
    <header id="site-head" class="site-header header-style-3 <?php echo esc_attr( $class_menu ); ?>">
        <div class="site-header-top">
            <div class="tr-header bg-color-changer" data-bg-color="<?php echo esc_attr( $top_header_bg_color ) ?>">
                <div class="site-logo">
                    <?php if ( trim( $header_logo[ 'url' ] ) != '' ): ?>
                        <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img
                                    src="<?php echo esc_url( $header_logo[ 'url' ] ); ?>" alt="logo"/></a></div>
                    <?php endif; ?>
                </div><!-- .site-branding -->
                <div class="main-nav color-changer bg-color-changer"
                     data-color="<?php echo esc_attr( $menu_color ); ?>"
                     data-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                     data-hover-color="<?php echo esc_attr( $menu_hover_color ); ?>"
                     data-hover-c-target=".nav-menu > li > a, .nav-menu > li > .ts-has-children > i"
                     data-bg-color="<?php echo esc_attr( $menu_bg_color ) ?>" data-bgc-target="">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#site-navigation" aria-expanded="true"
                            aria-controls="site-navigation">
                            <span class="linea-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                    </button>
                    <nav id="site-navigation" class="collapse main-navigation">
                        <?php
                        // Primary navigation menu.
                        wp_nav_menu( $menu_args );
                        ?>
                    </nav><!-- .main-navigation -->
                </div><!-- .main-nav -->
            </div>
        </div>

        <?php get_template_part( 'template-parts/header-slider' ); ?>

    </header><!-- .site-header v3-->
<?php endif; ?>
<div class="search-box">
    <div class="overlay-box"></div>
    <div class="search-box-content">
        <div class="container">
            <div class="search-box-inner">
                <h3 class="text-uppercase"><?php echo esc_html__( 'Do you want to search?', 'essence' ); ?></h3>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>




