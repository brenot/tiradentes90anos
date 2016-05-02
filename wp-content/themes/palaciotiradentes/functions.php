<?php
/**
 * Essence functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Essence
 */


function essence_init()
{
    define( 'ESSENCE_THEME_VERSION', '1.0.0' );
}

if ( !isset( $content_width ) ) {
    $content_width = 900;
}

add_action( 'init', 'essence_init' );

/**
 * Load global localize
 */
require get_template_directory() . '/engine/global-localize.php';

if ( !function_exists( 'essence_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function essence_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Essence, use a find and replace
         * to change 'essence' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'essence', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary'     => esc_html__( 'Primary Menu', 'essence' ),
                'footer_menu' => esc_html__( 'Footer Menu', 'essence' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5', array(
                       'search-form',
                       'comment-form',
                       'comment-list',
                       'gallery',
                       'caption',
                   )
        );

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support(
            'post-formats', array(
                              'aside',
                              'image',
                              'audio',
                              'video',
                              'gallery',
                              'quote',
                              'link',
                          )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background', apply_filters(
                                   'essence_custom_background_args', array(
                                                                       'default-color' => 'ffffff',
                                                                       'default-image' => '',
                                                                   )
                               )
        );

        // Screen reader text
        add_theme_support( 'screen-reader-text' );

        // Declare WooCommerce support
        add_theme_support( 'woocommerce' );

    }
endif; // essence_setup
add_action( 'after_setup_theme', 'essence_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function essence_content_width()
{
    $GLOBALS[ 'content_width' ] = apply_filters( 'essence_content_width', 640 );
}

add_action( 'after_setup_theme', 'essence_content_width', 0 );

if ( !function_exists( 'essence_widgets_init' ) ) {
    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    function essence_widgets_init()
    {
        global $essence;

        // Sidebar 1 (default sidebar)
        register_sidebar(
            array(
                'name'          => esc_html__( 'Primary Sidebar', 'essence' ),
                'id'            => 'sidebar-1',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h5 class="widget-title">',
                'after_title'   => '</h5>',
            )
        );

        $total_footer_sidebars = isset( $essence[ 'opt_footer_sidebar_layout' ] ) ? min( 4, max( 0, intval( $essence[ 'opt_footer_sidebar_layout' ] ) ) ) : 4;
        $enable_footer_sidebars = isset( $essence[ 'opt_enable_footer_sidebars' ] ) ? intval( $essence[ 'opt_enable_footer_sidebars' ] ) == 1 && $total_footer_sidebars > 0 : false;

        /*
         * Register sidebar footer top widgets
        */
        if ( $enable_footer_sidebars ):

            for ( $i = 1; $i <= $total_footer_sidebars; $i++ ):
                register_sidebar(
                    array(
                        'name'          => sprintf( esc_html__( 'Footer Sidebar %d', 'essence' ), $i ),
                        'id'            => 'footer-sidebar-' . intval( $i ),
                        'description'   => esc_html__( 'This is a footer sidebar', 'essence' ),
                        'before_title'  => '<h5 class="widget-title">',
                        'after_title'   => '</h5>',
                        'before_widget' => '<div class="%1$s widget %2$s">',
                        'after_widget'  => '</div>',
                    )
                );
            endfor;

        endif;

        // Sidebar shop for WooCommerce
        if ( class_exists( 'WooCommerce' ) ):

            register_sidebar(
                array(
                    'name'          => esc_html__( 'Sidebar Shop', 'essence' ),
                    'id'            => 'sidebar-shop',
                    'description'   => '',
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h5 class="widget-title">',
                    'after_title'   => '</h5>',
                )
            );

        endif;

    }

    add_action( 'widgets_init', 'essence_widgets_init' );
}

if ( !function_exists( 'essence_enqueue_font_icons' ) ) {
    function essence_enqueue_font_icons()
    {
        global $essence;

        $load_linea_font_icons = isset( $essence[ 'opt_theme_load_font_linea' ] ) ? $essence[ 'opt_theme_load_font_linea' ] == 1 : true;
        if ( $load_linea_font_icons ) {
            // Linea font icons
            wp_register_style( 'linea-arrows', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-arrows.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-arrows' );
            wp_register_style( 'linea-basic', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-basic.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-basic' );
            wp_register_style( 'linea-basic-elaboration', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-basic-elaboration.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-basic-elaboration' );
            wp_register_style( 'linea-ecommerce', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-ecommerce.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-ecommerce' );
            wp_register_style( 'linea-music', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-music.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-music' );
            wp_register_style( 'linea-software', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-software.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-software' );
            wp_register_style( 'linea-weather', get_template_directory_uri() . '/assets/vendors/linea-font-icons/css/linea-weather.css', array(), ESSENCE_THEME_VERSION, 'all' );
            wp_enqueue_style( 'linea-weather' );
        }

        $load_awesome_font_icons = isset( $essence[ 'opt_theme_load_font_awesome' ] ) ? $essence[ 'opt_theme_load_font_awesome' ] == 1 : true;
        if ( $load_awesome_font_icons ) {
            // Awesome font icons
            wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/assets/vendors/font-awesome/css/font-awesome.min.css', false, ESSENCE_THEME_VERSION, 'all' );
        }

        $load_elegant_font_icons = isset( $essence[ 'opt_theme_load_font_elegant' ] ) ? $essence[ 'opt_theme_load_font_elegant' ] == 1 : true;
        if ( $load_elegant_font_icons ) {
            // Awesome font icons
            wp_enqueue_style( 'elegant-font-style', get_template_directory_uri() . '/assets/vendors/elegant-icons/css/elegant-font-style.css', false, ESSENCE_THEME_VERSION, 'all' );
        }
    }
}


if ( !function_exists( 'essence_scripts' ) ) {
    /**
     * Enqueue scripts and styles.
     */
    function essence_scripts()
    {
        global $essence, $essence_global_localize;

        // Essence css

        // Fonts
        essence_enqueue_font_icons();

        wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/assets/vendors/bootstrap/css/bootstrap.min.css', false, ESSENCE_THEME_VERSION, 'all' );

        // Essence development stylesheet, will be combined with main stylesheet after project is done
        wp_enqueue_style( 'essence-assets-style', get_template_directory_uri() . '/assets/css/style.css', false, ESSENCE_THEME_VERSION, 'all' );
        wp_enqueue_style( 'essence-style', get_stylesheet_uri(), false, ESSENCE_THEME_VERSION, 'all' );

        // Essence js
        wp_enqueue_script( 'jquery-ui-accordion' );

        if ( wp_is_mobile() ) {
            $essence_global_localize[ 'is_mobile' ] = 'true';
        }

        // Nice Scroll ---------------
        wp_enqueue_script( 'jquery.nicescroll.min', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array( 'jquery' ), ESSENCE_THEME_VERSION, true );
        // End Nice Scroll -----------
        // Chosen ---------------
        wp_enqueue_style( 'chosen.min.css', get_template_directory_uri() . '/assets/vendors/chosen/chosen.min.css', false, ESSENCE_THEME_VERSION, true );
        wp_enqueue_script( 'chosen.jquery.min.js', get_template_directory_uri() . '/assets/vendors/chosen/chosen.jquery.min.js', array( 'jquery' ), ESSENCE_THEME_VERSION, true );
        // End Chosen -----------

        $enable_smooth_scroll = isset( $essence[ 'opt_enable_smooth_scroll' ] ) ? $essence[ 'opt_enable_smooth_scroll' ] == 1 : false;
        if ( $enable_smooth_scroll ) {
            wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/assets/vendors/smooth-scroll/SmoothScroll.js', array( 'jquery' ), ESSENCE_THEME_VERSION, true );
        }

        wp_enqueue_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
        wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );
        wp_enqueue_script( 'imagesloaded.pkgd.min', get_template_directory_uri() . '/assets/vendors/images-loaded/imagesloaded.pkgd.min.js', array(), ESSENCE_THEME_VERSION, true );
        wp_enqueue_script( 'masonry.pkgd.min', get_template_directory_uri() . '/assets/vendors/masonry/masonry.pkgd.min.js', array(), ESSENCE_THEME_VERSION, true );
        wp_enqueue_script( 'essence-frontend', get_template_directory_uri() . '/assets/js/frontend.js', array(), ESSENCE_THEME_VERSION, true );
        wp_enqueue_style( 'essence-woocommerce-css', get_template_directory_uri() . '/woocommerce/woocommerce.css', array(), ESSENCE_THEME_VERSION, true );

        wp_enqueue_script( 'essence-woocommerce', get_template_directory_uri() . '/assets/js/woocommerce.js', array(), ESSENCE_THEME_VERSION, true );

        wp_localize_script( 'essence-frontend', 'ajaxurl', get_admin_url() . '/admin-ajax.php' );
        wp_localize_script( 'essence-frontend', 'essence', $essence_global_localize );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    add_action( 'wp_enqueue_scripts', 'essence_scripts', 10 );
}

if ( !function_exists( 'essence_admin_enqueue_js' ) ) {

    /**
     * Enqueue Admin js
     */
    function essence_admin_enqueue_js()
    {
        global $essence_global_localize;

        if ( wp_is_mobile() ) {
            $essence_global_localize[ 'is_mobile' ] = 'true';
        }

        wp_add_inline_style( 'wp-admin', '#setting-error-tgmpa { display: block; }' );

        essence_enqueue_font_icons();
        add_editor_style( get_stylesheet_uri() );

        wp_enqueue_script( 'essence-admin-scripts', get_template_directory_uri() . '/assets/js/admin-scripts.js', array(), ESSENCE_THEME_VERSION, true );

        wp_localize_script( 'essence-admin-scripts', 'essence', $essence_global_localize );

    }

    add_action( 'admin_enqueue_scripts', 'essence_admin_enqueue_js' );
}


if ( !function_exists( 'essence_meta_tags' ) ) {

    /**
     * Meta tags
     **/
    function essence_meta_tags()
    {
        global $essence;

        echo '<meta name="robots" content="NOODP">';

        if ( is_front_page() && is_home() ) {
            // Default homepage
            echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
        }
        elseif ( is_front_page() ) {
            // static homepage
            echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
        }
        elseif ( is_home() ) {
            // blog page
            echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
        }
        else {
            //everything else

            // Is a singular
            if ( is_singular() ) {
                echo '<meta name="description" content="' . single_post_title( '', false ) . '" />';
            }
            else {
                // Is archive or taxonomy
                if ( is_archive() ) {
                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // Products archive, products category, products search page...
                        if ( is_shop() ) {
                            $post_id = get_option( 'woocommerce_shop_page_id' );
                            $use_custom_title = get_post_meta( $post_id, '_essence_use_custom_title', true ) == 'yes';

                            if ( $use_custom_title ) {
                                echo '<meta name="description" content="' . essence_single_title( $post_id ) . '" />';
                            }
                            else {
                                echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';
                            }
                        }
                    }
                    else {
                        echo '<meta name="description" content="' . get_the_archive_description() . '" />';
                    }
                }
                else {
                    if ( is_404() ) {
                        $not_found_text = isset( $essence[ 'opt_404_header_title' ] ) ? $essence[ 'opt_404_header_title' ] : esc_html__( 'Oops, page not found !', 'essence' );
                        echo '<meta name="description" content="' . sanitize_text_field( $not_found_text ) . '" />';
                    }
                    else {
                        if ( is_search() ) {
                            echo '<meta name="description" content="' . sprintf( esc_html__( 'Search results for: %s', 'essence' ), get_search_query() ) . '" />';
                        }
                        else {
                            // is category, is tag, is tax
                            echo '<meta name="description" content="' . single_cat_title( '', false ) . '" />';
                        }
                    }
                }

                // Is WooCommerce page
                if ( function_exists( 'is_woocommerce' ) ) {
                    if ( is_woocommerce() && !is_shop() ) {
                        if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
                            echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';
                        }
                    }
                }

            }
        }

    }

    add_action( 'wp_head', 'essence_meta_tags' );
}


function essence_is_blog()
{
    if ( is_front_page() && is_home() ) {
        return false;
    }
    elseif ( is_front_page() ) {
        return false;
    }
    elseif ( is_home() ) {
        return get_option( 'page_for_posts' ); // Returns blog page ID
    }
    else {
        return false;
    }
}


/**
 *  Load required plugins
 */
require_once get_template_directory() . "/engine/plugins-load.php";

/**
 *  Load Bootstrap Menu Walker
 */
require_once get_template_directory() . "/engine/classes/ts_bootstrap_navwalker.php";

/**
 * Breadcrumbs Trail
 *
 * @since Essence 1.0.
 */
require_once get_template_directory() . '/engine/classes/breadcrumbs.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/engine/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/engine/advance-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/engine/customizer.php'; // And theme options

/**
 * Load Theme Coming Soon Template
 */
require_once get_template_directory() . "/engine/coming-soon-template.php";


// Sharing single product
add_action( 'essence_single_product_sharing', 'essence_single_product_sharing_func', 50 );
if ( !function_exists( 'essence_single_product_sharing_func' ) ) {
    function essence_single_product_sharing_func()
    {
        global $essence;
        $enable_share_post = isset( $essence[ 'opt_enable_share_product' ] ) ? $essence[ 'opt_enable_share_product' ] == 1 : false;
        $socials_shared = isset( $essence[ 'opt_single_product_socials_share' ] ) ? $essence[ 'opt_single_product_socials_share' ] : array();
        ?>

        <?php if ( $enable_share_post ): ?>

        <div class="share-product share-post">
            <h5 class="share-product-title pull-left"><?php _e( 'SHARE :', 'unoe' ); ?></h5>
            <div class="product-socials-share-wrap">
                <div class="icons">
                    <?php if ( in_array( 'twitter', $socials_shared ) ): ?>
                        <a class="style3" href="https://twitter.com/home?status=<?php the_permalink(); ?>"
                           target="_blank"><i class="fa fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if ( in_array( 'pinterest', $socials_shared ) ): ?>
                        <a class="style4"
                           href="https://pinterest.com/pin/create/button/?url=&media=&description=<?php the_permalink(); ?>"
                           target="_blank"><i class="fa fa-pinterest"></i></a>
                    <?php endif; ?>
                    <?php if ( in_array( 'facebook', $socials_shared ) ): ?>
                        <a class="style1" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                           target="_blank"><i class="fa fa-facebook"></i></a>
                    <?php endif; ?>
                    <?php if ( in_array( 'gplus', $socials_shared ) ): ?>
                        <a class="style2" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                           target="_blank"><i class="fa fa-google-plus"></i></a>
                    <?php endif; ?>
                    <?php if ( in_array( 'linkedin', $socials_shared ) ): ?>
                        <a class="style5"
                           href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php the_permalink(); ?>"
                           target="_blank"><i class="fa fa-linkedin"></i></a>
                    <?php endif; ?>
                </div>
            </div><!-- /.product-socials-share-wrap -->
        </div>

    <?php endif; ?>

        <?php

    }
}