<?php
/*
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0
 */


/************************************************************************
 * Importer will auto load, there is no settings required to put in your
 * Reduxframework config file.
 *
 * BUT- If you want to put the demo importer in a different position on
 * the panel, use the below within your config for Redux.
 *************************************************************************/
// $this->sections[] = array(
//     'id' => 'wbc_importer_section',
//     'title'  => esc_html__( 'Demo Content', 'essence-core' ),
//     'desc'   => esc_html__( 'Description Goes Here', 'essence-core' ),
//     'icon'   => 'el-icon-website',
//     'fields' => array(
//                     array(
//                         'id'   => 'wbc_demo_importer',
//                         'type' => 'wbc_importer'
//                         )
//                 )
//     );

/************************************************************************
 * Example functions/filters
 *************************************************************************/

if ( !function_exists( 'essence_before_content_import' ) ) {
    function essence_before_content_import()
    {

        //Do something

    }
    //add_action( 'ts_before_content_import', 'essence_before_content_import' );
}


if ( !function_exists( 'wbc_after_content_import' ) ) {

    /**
     * Function/action ran after import of content.xml file
     *
     * @param (array) $demo_active_import       Example below
     *            [wbc-import-1] => Array
     *            (
     *            [directory] => current demo data folder name
     *            [content_file] => content.xml
     *            [image] => screen-image.png
     *            [theme_options] => theme-options.txt
     *            [widgets] => widgets.json
     *            [imported] => imported
     *            )
     * @param (string) $demo_data_directory_path path to current demo folder being imported.
     *
     */

    function wbc_after_content_import( $demo_active_import, $demo_data_directory_path )
    {
        //Do something

    }

    // Uncomment the below
    //add_action( 'wbc_importer_after_content_import', 'wbc_after_content_import', 10, 2 );
}

if ( !function_exists( 'wbc_filter_title' ) ) {

    /**
     * Filter for changing demo title in options panel so it's not folder name.
     *
     * @param  [string] $title name of demo data folder
     *
     * @return [string] return title for demo name.
     */

    function wbc_filter_title( $title )
    {
        return trim( ucwords( preg_replace( '/(_|-)+/', ' ', $title ) ) );
    }

    // Uncomment the below
    add_filter( 'wbc_importer_directory_title', 'wbc_filter_title', 10 );
}

if ( !function_exists( 'wbc_importer_description_text' ) ) {

    /**
     * Filter for changing importer description info in options panel
     * when not setting in Redux config file.
     *
     * @param  [string] $title description above demos
     *
     * @return [string] return.
     */

    function wbc_importer_description_text( $description )
    {

        $message = '<p>' . esc_html__( 'Works best to import on a new install of WordPress. Images are for demo purpose only.', 'essence-core' ) . '</p>';

        return $message;
    }

    // Uncomment the below
    add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}

if ( !function_exists( 'wbc_importer_label_text' ) ) {

    /**
     * Filter for changing importer label/tab for redux section in options panel
     * when not setting in Redux config file.
     *
     * @param  [string] $title label above demos
     *
     * @return [string] return no html
     */

    function wbc_importer_label_text( $label_text )
    {

        $label_text = __( 'Essence Importer', 'essence-core' );

        return $label_text;
    }

    // Uncomment the below
    add_filter( 'wbc_importer_label', 'wbc_importer_label_text', 10 );
}

if ( !function_exists( 'wbc_change_demo_directory_path' ) ) {

    /**
     * Change the path to the directory that contains demo data folders.
     *
     * @param  [string] $demo_directory_path
     *
     * @return [string]
     */

    function wbc_change_demo_directory_path( $demo_directory_path )
    {

        $demo_directory_path = ESSENCE_CORE_LIBS . 'demo-data/';

        return $demo_directory_path;

    }

    // Uncomment the below
    add_filter( 'wbc_importer_dir_path', 'wbc_change_demo_directory_path' );
}

if ( !function_exists( 'wbc_importer_before_widget' ) ) {

    /**
     * Function/action ran before widgets get imported
     *
     * @param (array) $demo_active_import       Example below
     *            [wbc-import-1] => Array
     *            (
     *            [directory] => current demo data folder name
     *            [content_file] => content.xml
     *            [image] => screen-image.png
     *            [theme_options] => theme-options.txt
     *            [widgets] => widgets.json
     *            [imported] => imported
     *            )
     * @param (string) $demo_data_directory_path path to current demo folder being imported.
     *
     * @return nothing
     */

    function wbc_importer_before_widget( $demo_active_import, $demo_data_directory_path )
    {

        //Do Something
        update_option( 'tdf_consumer_key', 'LPxUwy0VIHynyiybsyOhu04IL' );
        update_option( 'tdf_consumer_secret', '3CZsE7FdoG7WinQRoRzTfcIg8MbIYyVDEnzTZ69N9YpxDaGhEd' );
        update_option( 'tdf_access_token', '3070007774-YxYRsRZqXPbXVC5Zx1E6op8E4QHsdQz2nuwQp4l' );
        update_option( 'tdf_access_token_secret', 'V8kX8HpAQHoQaPNutwq6jDTq2GdvDgepqfTx55ezeRXWa' );
        update_option( 'tdf_cache_expire', '3600' );
        update_option( 'tdf_user_timeline', 'envato' );

    }

    // Uncomment the below
    add_action( 'wbc_importer_before_widget_import', 'wbc_importer_before_widget', 10, 2 );
}

if ( !function_exists( 'essence_after_theme_options' ) ) {

    /**
     * Function/action ran after theme options set
     *
     * @param (array) $demo_active_import       Example below
     *            [wbc-import-1] => Array
     *            (
     *            [directory] => current demo data folder name
     *            [content_file] => content.xml
     *            [image] => screen-image.png
     *            [theme_options] => theme-options.txt
     *            [widgets] => widgets.json
     *            [imported] => imported
     *            )
     * @param (string) $demo_data_directory_path path to current demo folder being imported.
     *
     * @return nothing
     */

    function essence_after_theme_options( $demo_active_import, $demo_data_directory_path )
    {

        // Update Visual Composer roles
        essence_add_cap( 'administrator', 'vc_access_rules_post_types/page' );
        essence_add_cap( 'administrator', 'vc_access_rules_post_types/portfolio' );
        essence_add_cap( 'administrator', 'vc_access_rules_post_types', 'custom' );
        essence_add_cap( 'administrator', 'vc_access_rules_backend_editor' );
        essence_add_cap( 'administrator', 'vc_access_rules_frontend_editor' );
        essence_add_cap( 'administrator', 'vc_access_rules_post_settings' );
        essence_add_cap( 'administrator', 'vc_access_rules_settings' );
        essence_add_cap( 'administrator', 'vc_access_rules_templates' );
        essence_add_cap( 'administrator', 'vc_access_rules_shortcodes' );
        essence_add_cap( 'administrator', 'vc_access_rules_grid_builder' );
        essence_add_cap( 'administrator', 'vc_access_rules_presets' );

    }

    // Uncomment the below
    add_action( 'wbc_importer_after_theme_options_import', 'essence_after_theme_options', 10, 2 );
}

if ( !function_exists( 'essence_add_cap' ) ) {
    function essence_add_cap( $role_name = 'administrator', $cap = '', $grant = true )
    {

        if ( trim( $cap ) == '' ) {
            return;
        }

        $role = get_role( $role_name );
        $role->add_cap( $cap, $grant );

    }
}


/************************************************************************
 * Extended Example:
 * Way to set menu, import revolution slider, and set home page.
 *************************************************************************/

if ( !function_exists( 'ts_extended_import' ) ) {
    function ts_extended_import( $demo_active_import, $demo_directory_path )
    {

        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        /************************************************************************
         * Setting Menus
         *************************************************************************/

        $wbc_menu_array = array(
            'essence',
        );

        if ( isset( $demo_active_import[ $current_key ][ 'directory' ] ) && !empty( $demo_active_import[ $current_key ][ 'directory' ] ) && in_array( $demo_active_import[ $current_key ][ 'directory' ], $wbc_menu_array ) ) {
            $main_menu = get_term_by( 'name', 'Menu Main', 'nav_menu' );

            if ( isset( $main_menu->term_id ) ) {
                set_theme_mod(
                    'nav_menu_locations', array(
                                            'primary' => $main_menu->term_id,
                                        )
                );
            }

        }


        /************************************************************************
         * Import slider(s) for the current demo being imported
         *************************************************************************/
        if ( class_exists( 'RevSlider' ) ) {

            $wbc_sliders_array = array(
                'essence' => array(
                    'home-3.zip',
                    'home-default.zip',
                    'Slide-banner.zip',
                    'slide-home4.zip',
                    'Slide.zip',
                ), //Set slider zip name
            );

            if ( isset( $demo_active_import[ $current_key ][ 'directory' ] ) && !empty( $demo_active_import[ $current_key ][ 'directory' ] ) && array_key_exists( $demo_active_import[ $current_key ][ 'directory' ], $wbc_sliders_array ) ) {
                //$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
                $wbc_slider_import = $wbc_sliders_array[ $demo_active_import[ $current_key ][ 'directory' ] ];
                if ( is_array( $wbc_slider_import ) ) {
                    if ( !empty( $wbc_slider_import ) ) {
                        foreach ( $wbc_slider_import as $wbc_slider_import_name ) {
                            if ( file_exists( $demo_directory_path . $wbc_slider_import_name ) ) {
                                $slider = new RevSlider();
                                $slider->importSliderFromPost( true, true, $demo_directory_path . $wbc_slider_import_name );
                            }
                        }
                    }
                }
                else {
                    if ( file_exists( $demo_directory_path . $wbc_slider_import ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $demo_directory_path . $wbc_slider_import );
                    }
                }

            }
        }


        /************************************************************************
         * Set HomePage
         *************************************************************************/

        // array of demos/homepages to check/select from
        $wbc_home_pages = array(
            'essence' => 'Home v1',
        );

        if ( isset( $demo_active_import[ $current_key ][ 'directory' ] ) && !empty( $demo_active_import[ $current_key ][ 'directory' ] ) && array_key_exists( $demo_active_import[ $current_key ][ 'directory' ], $wbc_home_pages ) ) {
            $home_page = get_page_by_title( $wbc_home_pages[ $demo_active_import[ $current_key ][ 'directory' ] ] );
            if ( isset( $home_page->ID ) ) {
                update_option( 'page_on_front', $home_page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }

        // Set blog page
        $blog_page = get_page_by_title( 'Blog' );
        if ( isset( $home_page->ID ) ) {
            update_option( 'page_for_posts', $blog_page->ID );
        }

    }

    add_action( 'wbc_importer_after_content_import', 'ts_extended_import', 10, 2 );
}

?>