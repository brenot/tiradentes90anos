<?php
/*
Plugin Name: Essence Core
Plugin URI: http://themestudio.net/
Description: I am default plugin description. You should edit me...
Version: 1.1
Author: Le Manh Linh
Author URI: http://themestudio.net/
License: GPLv2 or later
Text Domain: essence-core
*/
?>
<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}


define( 'ESSENCE_CORE_VERSION', '1.1' );
define( 'ESSENCE_CORE_BASE_URL', trailingslashit( plugins_url( 'essence-core' ) ) );
define( 'ESSENCE_CORE_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ESSENCE_CORE_LIBS', ESSENCE_CORE_DIR_PATH . '/libs/' );
define( 'ESSENCE_CORE_LIBS_URL', ESSENCE_CORE_BASE_URL . '/libs/' );
define( 'ESSENCE_CORE_CORE', ESSENCE_CORE_DIR_PATH . '/core/' );
define( 'ESSENCE_CORE_CSS_URL', ESSENCE_CORE_BASE_URL . 'assets/css/' );
define( 'ESSENCE_CORE_JS', ESSENCE_CORE_BASE_URL . 'assets/js/' );
define( 'ESSENCE_CORE_VENDORS', ESSENCE_CORE_DIR_PATH . '/assets/vendors/' );
define( 'ESSENCE_CORE_VENDORS_URL', ESSENCE_CORE_BASE_URL . 'assets/vendors/' );
define( 'ESSENCE_CORE_IMG_URL', ESSENCE_CORE_BASE_URL . 'assets/images/' );


/**
 * Require file
 **/
function essence_core_require_once( $file_path )
{

    if ( file_exists( $file_path ) ) {
        require_once $file_path;
    }
}


/**
 * Load plugin textdomain
 */
if ( !function_exists( 'essence_core_load_textdomain' ) ) {
    function essence_core_load_textdomain()
    {
        load_plugin_textdomain( 'essence-core', false, ESSENCE_CORE_DIR_PATH . 'languages' );
    }

    add_action( 'plugins_loaded', 'essence_core_load_textdomain', 11 );
}

/**
 * Initialize the metabox class.
 */
essence_core_require_once( ESSENCE_CORE_LIBS . '/admin/metaboxes/init.php' );
/**
 * Load Redux Framework
 */
essence_core_require_once( ESSENCE_CORE_LIBS . 'admin/reduxframework/ReduxCore/framework.php' );

/**
 * Load plugin functions
 */
essence_core_require_once( ESSENCE_CORE_CORE . 'function-importer.php' );

/**
 * Load plugin functions
 */
essence_core_require_once( ESSENCE_CORE_CORE . 'functions.php' );

function essence_core_load()
{

}

add_action( 'init', 'essence_core_load', 11 );


essence_core_register_post_types();
essence_core_register_custom_taxonomies();
essence_core_post_type_metaboxes();


/**
 * Register post types
 **/
function essence_core_register_post_types()
{

    $postTypeArgs = array( 'members', 'testimonials', 'portfolio' );
    if ( is_array( $postTypeArgs ) && !empty( $postTypeArgs ) ):
        foreach ( $postTypeArgs as $postType ):
            $filePath = ESSENCE_CORE_CORE . 'post-types/post-' . $postType . '.php';
            essence_core_require_once( $filePath );
        endforeach;
    endif;

}

/**
 * Register custom taxonomies
 **/
function essence_core_register_custom_taxonomies()
{

    $taxonomiesArgs = array( 'members', 'testimonials', 'portfolio' );
    if ( is_array( $taxonomiesArgs ) && !empty( $taxonomiesArgs ) ):
        foreach ( $taxonomiesArgs as $taxonomy ):
            $taxonomy = sanitize_key( $taxonomy );
            $filePath = ESSENCE_CORE_CORE . 'taxonomies/taxonomy-' . $taxonomy . '.php';
            essence_core_require_once( $filePath );
        endforeach;
    endif;

}

/**
 * Load Post type metaboxes
 */
function essence_core_post_type_metaboxes()
{

    $postTypeMetaboxesArgs = array( 'portfolio', 'global', 'member','testimonial','posts','product' );
    if ( is_array( $postTypeMetaboxesArgs ) && !empty( $postTypeMetaboxesArgs ) ):
        foreach ( $postTypeMetaboxesArgs as $post_type ):
            $post_type = sanitize_key( $post_type );
            $filePath = ESSENCE_CORE_CORE . 'metaboxes/post-type-metaboxes/metaboxes-' . $post_type . '.php';
            essence_core_require_once( $filePath );
        endforeach;
    endif;
}


/**
 * Load VC Global Custom
 */
essence_core_require_once( ESSENCE_CORE_CORE . 'shortcodes/ts_vc_global.php' );

/**
 * Enqueue Admin CSS
 */
if ( !function_exists( 'essence_core_admin_enqueue_css' ) ) {

    function essence_core_admin_enqueue_css()
    {

        // Elegant Font Icons ---------------
        wp_enqueue_style( 'vc_elegant', ESSENCE_CORE_VENDORS_URL . 'elegant-icons/css/elegant-font-style.css', false, ESSENCE_CORE_VERSION, 'all' );
        // End Elegant Font Icons -----------

        // Bootstrap ---------------
        //wp_enqueue_style( 'essencecore-bootstrap', ESSENCE_CORE_VENDORS_URL . 'bootstrap/css/bootstrap.min.css', false, ESSENCE_CORE_VERSION, 'all' );
        // End Bootstrap -----------

        wp_enqueue_style( 'essence_core-datetimepicker.min.css', ESSENCE_CORE_VENDORS_URL . 'datetimepicker/css/bootstrap-datetimepicker.min.css', false, ESSENCE_CORE_VERSION, 'all' );

        // Redux Styling
        wp_enqueue_style( 'essence_core-admin-redux', ESSENCE_CORE_CSS_URL . 'admin-redux.css', false, ESSENCE_CORE_VERSION, 'all' );

        // Admin CSS
        wp_enqueue_style( 'essence_core-admin', ESSENCE_CORE_CSS_URL . 'admin.css', false, ESSENCE_CORE_VERSION, 'all' );

    }

    add_action( 'admin_enqueue_scripts', 'essence_core_admin_enqueue_css' );
}

/**
 * Enqueue Admin js
 */
if ( !function_exists( 'essence_core_admin_enqueue_js' ) ) {

    function essence_core_admin_enqueue_js()
    {

        wp_enqueue_script( 'jquery-ui-tabs' );

        wp_register_script( 'essence_core-moment', ESSENCE_CORE_VENDORS_URL . 'moment/moment.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );
        wp_enqueue_script( 'essence_core-moment' );

        wp_register_script( 'essence_core-bootstrap-datetimepicker.min', ESSENCE_CORE_VENDORS_URL . 'datetimepicker/js/bootstrap-datetimepicker.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );
        wp_enqueue_script( 'essence_core-bootstrap-datetimepicker.min' );

        // Countdown ---------------
        wp_enqueue_script( 'essencecore-jquery.countdown.min', ESSENCE_CORE_VENDORS_URL . 'countdown/jquery.countdown.min.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );
        // End Countdown-----------

        wp_register_script( 'essence_core-admin-scripts', ESSENCE_CORE_JS . 'admin-scripts.js', array( 'jquery' ), ESSENCE_CORE_VERSION, true );
        wp_enqueue_script( 'essence_core-admin-scripts' );

        $essence_core_nonce = wp_create_nonce( 'essence_core_nonce' );
        wp_localize_script( 'essence_core-admin-scripts', 'essence_core_nonce', $essence_core_nonce );

    }

    add_action( 'admin_enqueue_scripts', 'essence_core_admin_enqueue_js' );
}

/**
 * Require functions
 */
essence_core_require_once( ESSENCE_CORE_CORE . 'functions.php' );

/**
 * Require ajax css
 */
essence_core_require_once( ESSENCE_CORE_CORE . 'ajax-css.php' );


/**
 * Load all widgets
 **/
require_once ESSENCE_CORE_DIR_PATH . '/core/widgets/recent-post.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/widgets/latest-posts.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/widgets/instagram.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/widgets/latest-tweets.php';

/**
 * Load all shortcodes for VC
 **/
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/separator.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/icon-box.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/fun-fact.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/fun-fact-2.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/custom-menu.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/banner.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/banner-slide.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/google-map.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/pie-chart.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/news-letter.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/gallery.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/members.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/accordion.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/accordion-2.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/products-grid.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/products-slide.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/posts-slide.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/latest-posts.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/address.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/title.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/blockquote.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/dropcap-text.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/skill-bars.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/bullets-list.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/message-box.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/pricing-table.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/countdown.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/title-Wbackground.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/img-introduce.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/button.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/client-works.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/contact-info.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/services.php';
require_once ESSENCE_CORE_DIR_PATH . '/core/shortcodes/tr-testimonial.php';


/**
 * Enqueue scripts for this plugin. I am automatically required by Template Generator, if I am duplicated requirement,
 * please remove me.
 */
require_once ESSENCE_CORE_DIR_PATH . '/core/plugin-enqueue-scripts.php';