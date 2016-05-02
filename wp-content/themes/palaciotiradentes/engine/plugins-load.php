<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see        http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/engine/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'essence_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function essence_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'Essence Core', // The plugin name.
            'slug'               => 'essence-core', // The plugin slug (typically the folder name).
            'source'             => 'http://resources.themestudio.net/essence/essence-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        // This is an example of how to include a plugin from an arbitrary external source in your theme.
        array(
            'name'         => 'WPBakery Visual Composer', // The plugin name.
            'slug'         => 'js_composer', // The plugin slug (typically the folder name).
            'source'       => 'http://resources.themestudio.net/plugins/js_composer/js_composer.zip', // The plugin source.
            'required'     => true, // If false, the plugin is only 'recommended' instead of required.
            'version'      => '4.9.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from an arbitrary external source in your theme.
        array(
            'name'         => 'Essential Grid', // The plugin name.
            'slug'         => 'essential-grid', // The plugin slug (typically the folder name).
            'source'       => 'http://resources.themestudio.net/plugins/essential-grid.zip', // The plugin source.
            'required'     => true, // If false, the plugin is only 'recommended' instead of required.
            'version'      => '2.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from an arbitrary external source in your theme.
        array(
            'name'         => 'Revolution Slider', // The plugin name.
            'slug'         => 'revslider', // The plugin slug (typically the folder name).
            'source'       => 'http://resources.themestudio.net/plugins/revslider.zip', // The plugin source.
            'required'     => false, // If false, the plugin is only 'recommended' instead of required.
            'version'      => '5.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => true,
            'version'   => '2.4.7'
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'YITH WooCommerce Wishlist',
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => false,
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce Products Filter',
            'slug'      => 'woocommerce-products-filter',
            'required'  => true,
            'is_callable' => array( 'WOOF', 'init' )
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                    // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}
