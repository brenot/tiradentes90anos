<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */


if ( !class_exists( 'Essence_Redux_Framework_config' ) ) {


    class Essence_Redux_Framework_config

    {


        public $args = array();

        public $sections = array();

        public $theme;

        public $ReduxFramework;


        public function __construct()

        {


            if ( !class_exists( "ReduxFramework" ) ) {

                return;

            }


            $this->initSettings();

        }


        public function initSettings()

        {


            // Just for demo purposes. Not needed per say.

            $this->theme = wp_get_theme();


            // Set the default arguments

            $this->setArguments();


            // Set a few help tabs so you can see how it's done

            $this->setHelpTabs();


            // Create the sections and fields

            $this->setSections();


            if ( !isset( $this->args[ 'opt_name' ] ) ) { // No errors please

                return;

            }


            // If Redux is running as a plugin, this will remove the demo notice and links

            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );


            // Function to test the compiler hook and demo CSS output.

            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

            // Change the arguments after they've been declared, but before the panel is created

            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds

            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields

            add_filter( 'redux/options/' . $this->args[ 'opt_name' ] . '/sections', array( $this, 'dynamic_section' ) );


            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );

        }


        /**
         *
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field   set with compiler=>true is changed.
         * */

        function compiler_action( $options, $css )
        {


        }


        function ts_redux_update_options_user_can_register( $options, $css )
        {

            global $essence;

            $users_can_register = isset( $essence[ 'opt-users-can-register' ] ) ? $essence[ 'opt-users-can-register' ] : 0;

            update_option( 'users_can_register', $users_can_register );

        }


        /**
         *
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         *
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */

        function dynamic_section( $sections )
        {

            //$sections = array();

            $sections[] = array(

                'title' => esc_html__( 'Section via hook', 'essence' ),

                'desc' => wp_kses( __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'essence' ), array( 'p' => array( 'class' => array() ) ) ),

                'icon' => 'el-icon-paper-clip',

                // Leave this as a blank section, no options just some intro text set above.

                'fields' => array(),

            );


            return $sections;

        }


        /**
         *
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */

        function change_arguments( $args )
        {


            return $args;

        }


        /**
         *
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */

        function change_defaults( $defaults )
        {

            $defaults[ 'str_replace' ] = "Testing filter hook!";


            return $defaults;

        }


        // Remove the demo link and the notice of integrated demo from the redux-framework plugin

        function remove_demo()

        {


            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.

            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {

                remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );


                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.

                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );


            }

        }


        public function setSections()

        {


            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */

            // Background Patterns Reader

            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';

            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';

            $sample_patterns = array();


            if ( is_dir( $sample_patterns_path ) ) :


                if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :

                    $sample_patterns = array();


                    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {


                        if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {

                            $name = explode( ".", $sample_patterns_file );

                            $name = str_replace( '.' . end( $name ), '', $sample_patterns_file );

                            $sample_patterns[] = array( 'alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file );

                        }

                    }

                endif;

            endif;


            ob_start();


            $ct = wp_get_theme();

            $this->theme = $ct;

            $item_name = $this->theme->get( 'Name' );

            $tags = $this->theme->Tags;

            $screenshot = $this->theme->get_screenshot();

            $class = $screenshot ? 'has-screenshot' : '';


            $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'essence' ), $this->theme->display( 'Name' ) );

            ?>

            <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">

                <?php if ( $screenshot ) : ?>

                    <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>

                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"

                           title="<?php echo esc_attr( $customize_title ); ?>">

                            <img src="<?php echo esc_url( $screenshot ); ?>"

                                 alt="<?php esc_attr_e( 'Current theme preview', 'essence' ); ?>"/>

                        </a>

                    <?php endif; ?>

                    <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"

                         alt="<?php esc_attr_e( 'Current theme preview', 'essence' ); ?>"/>

                <?php endif; ?>


                <h4>

                    <?php echo sanitize_text_field( $this->theme->display( 'Name' ) ); ?>

                </h4>


                <div>

                    <ul class="theme-info">

                        <li><?php printf( __( 'By %s', 'essence' ), $this->theme->display( 'Author' ) ); ?></li>

                        <li><?php printf( __( 'Version %s', 'essence' ), $this->theme->display( 'Version' ) ); ?></li>

                        <li><?php echo '<strong>' . esc_html__( 'Tags', 'essence' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>

                    </ul>

                    <p class="theme-description"><?php echo esc_attr( $this->theme->display( 'Description' ) ); ?></p>

                    <?php

                    if ( $this->theme->parent() ) {

                        printf(

                            ' <p class="howto">' . wp_kses( __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'essence' ), array( 'a' => array( 'href' => array() ) ) ) . '</p>', esc_html__( 'http://codex.wordpress.org/Child_Themes', 'essence' ), $this->theme->parent()
                                                                                                                                                                                                                                                                                            ->display( 'Name' )

                        );

                    }

                    ?>


                </div>


            </div>


            <?php

            $item_info = ob_get_contents();


            ob_end_clean();


            $sampleHTML = '';


            /*--General Settings--*/

            $this->sections[] = array(

                'icon' => 'el-icon-cogs',

                'title' => esc_html__( 'General Settings', 'essence' ),

                'fields' => array(

                    array(

                        'id' => 'opt_general_introduction',

                        'type' => 'info',

                        'style' => 'success',

                        'title' => esc_html__( 'Welcome to ESSENCE Theme Option Panel', 'essence' ),

                        'icon' => 'el-icon-info-sign',

                        'desc' => esc_html__( 'From here you can config ESSENCE theme in the way you need.', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_general_logo',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Logo', 'essence' ),

                        'compiler' => 'true',

                        'desc' => esc_html__( 'Upload your logo image', 'essence' ),

                        'subtitle' => esc_html__( 'Upload your custom logo image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),

                    ),

                    array(

                        'id' => 'opt_general_favicon',

                        'type' => 'media',

                        'title' => esc_html__( 'Favicon', 'essence' ),

                        'desc' => esc_html__( 'Upload a 16px x 16px .png or .gif or .ico image that will be your favicon.', 'essence' ),

                        'subtitle' => esc_html__( 'Upload your custom favicon image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/favicon.ico' ),


                    ),

                    array(

                        'id' => 'opt_general_accent_color',

                        'type' => 'color_rgba',

                        'title' => esc_html__( 'Base color', 'essence' ),

                        'subtitle' => esc_html__( 'Base color for all pages on the frontend', 'essence' ),

                        'default' => array(

                            'color' => '#bda47d', // Contruction design

                            'alpha' => 1,

                        ),

                    ),

                    array(

                        'id' => 'opt_body_bg',

                        'type' => 'background',

                        'title' => esc_html__( 'Body Background', 'essence' ),

                        'subtitle' => esc_html__( 'Body background with image pattern, color, etc.', 'essence' ),

                        'transparent' => false,

                        'background-repeat' => false,

                        'background-attachment' => false,

                        'background-position' => false,

                        'background-clip' => false,

                        'background-origin' => false,

                        'background-size' => false,

                        'default' => array(

                            'background-color' => '#ffffff',

                        ),

                        'output' => array( 'body, body:before, body:after' ),

                    ),

                    array(

                        'id' => 'opt_enable_smooth_scroll',

                        'type' => 'switch',

                        'title' => esc_html__( 'Enable Smooth Scroll', 'essence' ),

                        'default' => '0',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_theme_load_font_awesome',

                        'type' => 'switch',

                        'title' => esc_html__( 'Theme load font Awesome', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                        'desc' => esc_html__( 'You can disable load font Awesome CSS from theme if Essence Core plugin is activated.', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_theme_load_font_linea',

                        'type' => 'switch',

                        'title' => esc_html__( 'Theme load font Linea', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                        'desc' => esc_html__( 'You can disable load font Linea CSS from theme if Essence Core plugin is activated.', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_theme_load_font_elegant',

                        'type' => 'switch',

                        'title' => esc_html__( 'Theme load font Elegant', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                        'desc' => esc_html__( 'You can disable load font Elegant CSS from theme if Essence Core plugin is activated.', 'essence' ),

                    ),


                    array(

                        'id' => 'opt_general_css_code',

                        'type' => 'ace_editor',

                        'title' => esc_html__( 'Custom CSS', 'essence' ),

                        'subtitle' => esc_html__( 'Paste your custom CSS code here.', 'essence' ),

                        'mode' => 'css',

                        'theme' => 'monokai',

                        'desc' => 'Custom css code.',

                        'default' => "",

                    ),

                    array(

                        'id' => 'opt_general_js_code',

                        'type' => 'ace_editor',

                        'title' => esc_html__( 'Custom JS ', 'essence' ),

                        'subtitle' => esc_html__( 'Paste your custom JS code here.', 'essence' ),

                        'mode' => 'javascript',

                        'theme' => 'chrome',

                        'desc' => 'Custom javascript code',

                    ),

                ),

            );


            /*--Typograply Options--*/

            $this->sections[] = array(

                'icon' => 'el-icon-font',

                'title' => esc_html__( 'Typography Options', 'essence' ),

                'fields' => array(

                    array(

                        'id' => 'opt_typography_body_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Body Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the body font properties.', 'essence' ),

                        'google' => true,

                        'output' => 'body',

                        'default' => array(),

                    ),

                    array(

                        'id' => 'opt_typography_menu_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Menu Item Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the menu font properties.', 'essence' ),

                        'output' => array( 'nav', '.nav-menu' ),

                        'google' => true,

                        'default' => array(),

                    ),


                    array(

                        'id' => 'opt_typography_h1_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 1(H1) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H1 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h1',

                    ),


                    array(

                        'id' => 'opt_typography_h2_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 2(H2) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H2 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h2',

                    ),


                    array(

                        'id' => 'opt_typography_h3_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 3(H3) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H3 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h3',

                    ),


                    array(

                        'id' => 'opt_typography_h4_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 4(H4) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H4 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h4',

                    ),


                    array(

                        'id' => 'opt_typography_h5_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 5(H5) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H5 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h5',

                    ),


                    array(

                        'id' => 'opt_typography_h6_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Heading 6(H6) Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify the H6 tag font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => 'h6',

                    ),


                    array(

                        'id' => 'opt_widget_title_font',

                        'type' => 'typography',

                        'title' => esc_html__( 'Widget Title Font Setting', 'essence' ),

                        'subtitle' => esc_html__( 'Specify widget title font properties.', 'essence' ),

                        'google' => true,

                        'default' => array(

                            'font-weight' => 500,

                        ),

                        'output' => array( '.widget-title' ),

                    ),

                ),

            );


            /*--Header setting--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Header Settings', 'essence' ),

                'desc' => esc_html__( 'Header Settings', 'essence' ),

                'icon' => 'el-icon-credit-card',

                'fields' => array(

                    array(

                        'id' => 'opt_enable_menu_sticky',

                        'type' => 'switch',

                        'title' => esc_html__( 'Enable Menu Sticky', 'essence' ),

                        'default' => '0',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_header_type',

                        'type' => 'select',

                        'multi' => false,

                        'title' => esc_html__( 'Header Type', 'essence' ),

                        'options' => array(

                            'header-v1' => esc_html__( 'Header V1', 'essence' ),

                            'header-v2' => esc_html__( 'Header V2', 'essence' ),

                            'header-v3' => esc_html__( 'Header V3', 'essence' ),

                        ),

                        'default' => 'header-v1',

                        'desc' => esc_html__( 'Default header layout type for all pages', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_header_slider',

                        'type' => 'select',

                        'multi' => false,

                        'title' => esc_html__( 'Header Slider', 'essence' ),

                        'options' => essence_rev_slide_options_for_redux(),

                        'default' => '',

                        'desc' => esc_html__( 'Default header slider for all pages', 'essence' ),

                        'placeholder' => esc_html__( 'Select a slider or leave me empty to use image option', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_header_img',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Header Image', 'essence' ),

                        'compiler' => 'true',

                        'subtitle' => esc_html__( 'Header image in case of no slider is chosen', 'essence' ),

                        'desc' => esc_html__( 'Upload header image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/banner_default.jpg' ),

                        'required' => array( 'opt_header_slider', '=', '' ),

                    ),

                    array(

                        'id' => 'opt_enable_header_scroll_down',

                        'type' => 'switch',

                        'title' => esc_html__( 'Enable Header Scroll Down', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Enable', 'essence' ),

                        'off' => esc_html__( 'Disable', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_header_scroll_down_style',

                        'type' => 'image_select',

                        'compiler' => true,

                        'title' => esc_html__( 'Scroll Down Style', 'essence' ),

                        'subtitle' => esc_html__( 'Select header scroll down style.', 'essence' ),

                        'options' => array(

                            'style1' => array( 'alt' => 'Header Scroll Down Style 1', 'img' => plugins_url( '/essence-core' ) . '/assets/images/scroll_down_1.png' ),

                            'style2' => array( 'alt' => 'Header Scroll Down Style 2', 'img' => plugins_url( '/essence-core' ) . '/assets/images/scroll_down_2.png' ),

                            'style3' => array( 'alt' => 'Header Scroll Down Style 3', 'img' => plugins_url( '/essence-core' ) . '/assets/images/scroll_down_3.png' ),

                            'custom' => array( 'alt' => 'Header Custom Scroll Down', 'img' => plugins_url( '/essence-core' ) . '/assets/images/scroll_down_custom.png' ),

                        ),

                        'default' => 'style1',

                        'required' => array( 'opt_enable_header_scroll_down', '=', '1' ),

                    ),

                    array(

                        'id' => 'opt_header_scroll_down_custom',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Custom Scroll Down', 'essence' ),

                        'compiler' => 'true',

                        'subtitle' => esc_html__( 'Header custom scroll down', 'essence' ),

                        'desc' => esc_html__( 'Upload custom scroll down image', 'essence' ),

                        'required' => array( 'opt_header_scroll_down_style', '=', 'custom' ),

                    ),

                ),

            );


            /*--Footer setting--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Footer Settings', 'essence' ),

                'desc' => esc_html__( 'Footer Settings', 'essence' ),

                'icon' => 'el-icon-credit-card',

                'fields' => array(

                    array(

                        'id' => 'opt_footer_layout',

                        'type' => 'image_select',

                        'compiler' => true,

                        'title' => esc_html__( 'Footer Layout', 'essence' ),

                        'subtitle' => esc_html__( 'Select footer layout style.', 'essence' ),

                        'options' => array(

                            'style-1' => array( 'alt' => 'Footer Dark', 'img' => plugins_url( '/essence-core' ) . '/assets/images/footers-preview/footer_style_1.jpg' ),

                            'style-2' => array( 'alt' => 'Footer Light', 'img' => plugins_url( '/essence-core' ) . '/assets/images/footers-preview/footer_style_2.jpg' ),

                            'style-3' => array( 'alt' => 'Footer Simple', 'img' => plugins_url( '/essence-core' ) . '/assets/images/footers-preview/footer_style_3.jpg' ),

                            'style-4' => array( 'alt' => 'Footer Dark 2', 'img' => plugins_url( '/essence-core' ) . '/assets/images/footers-preview/footer_style_4.jpg' ),

                        ),

                        'default' => 'style-1',

                    ),

                    array(

                        'id' => 'opt_footer_dark_logo',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Footer Logo', 'essence' ),

                        'compiler' => 'true',

                        'desc' => esc_html__( 'Dark footer logo', 'essence' ),

                        'subtitle' => esc_html__( 'Upload dark footer logo image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/footer_dark_logo.png' ),

                        'required' => array( 'opt_footer_layout', '=', 'style-1' ),

                    ),

                    array(

                        'id' => 'opt_footer_light_logo',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Footer Logo', 'essence' ),

                        'compiler' => 'true',

                        'desc' => esc_html__( 'Light footer logo', 'essence' ),

                        'subtitle' => esc_html__( 'Upload light footer logo image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/footer_light_logo.png' ),

                        'required' => array( 'opt_footer_layout', '=', 'style-2' ),

                    ),

                    array(

                        'id' => 'opt_footer_copyright_text',

                        'type' => 'editor',

                        'title' => esc_html__( 'Footer copyright Text', 'essence' ),

                        'subtitle' => esc_html__( 'Copyright text', 'essence' ),

                        'default' => wp_kses( __( '&copy; Essence 2016. A project design by <a href="#">WhiteStag</a>', 'essence' ), array( 'a' => array( 'href' => array() ) ) ),

                    ),

                    array(

                        'id' => 'opt_show_footer_social_links',

                        'type' => 'switch',

                        'title' => esc_html__( 'Show social links', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                    ),


                ),

            );


            /*--Blog--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Blog Settings', 'essence' ),

                'desc' => esc_html__( 'Blog Settings', 'essence' ),

                'icon' => 'el-icon-th-list',

                'fields' => array(

                    array(

                        'id' => 'opt_blog_sidebar_pos',

                        'type' => 'image_select',

                        'compiler' => true,

                        'title' => esc_html__( 'Sidebar position', 'essence' ),

                        'subtitle' => esc_html__( 'Select sidebar position.', 'essence' ),

                        'desc' => esc_html__( 'Select sidebar on left or right', 'essence' ),

                        'options' => array(

                            'left' => array( 'alt' => 'Left Sidebar', 'img' => get_template_directory_uri() . '/assets/images/2cl.png' ),

                            'right' => array( 'alt' => 'Right Sidebar', 'img' => get_template_directory_uri() . '/assets/images/2cr.png' ),

                            'fullwidth' => array( 'alt' => 'Full Width', 'img' => get_template_directory_uri() . '/assets/images/1column.png' ),

                        ),

                        'default' => 'right',

                    ),

                    array(

                        'id' => 'opt_blog_layout_style',

                        'type' => 'select',

                        'multi' => false,

                        'title' => esc_html__( 'Blog layout style', 'essence' ),

                        'options' => array(

                            'default' => esc_html__( 'Default', 'essence' ),

                            'standard' => esc_html__( 'List', 'essence' ),

                            'grid' => esc_html__( 'Grid', 'essence' ),

                        ),

                        'default' => 'default',

                    ),

                    array( // Don't remove me

                           'id' => 'opt_blog_masonry_loadmore_number',

                           'type' => 'text',

                           'title' => esc_html__( 'Number of posts per load', 'essence' ),

                           'desc' => esc_html__( 'Number of posts will load when click on load more button', 'essence' ),

                           'default' => 6,

                           'validate' => 'numeric',

                           'required' => array( 'opt_blog_layout_style', '=', 'masonry' ),

                    ),

                    array( // Don't remove me

                           'id' => 'opt_blog_masonry_loadmore_text',

                           'type' => 'text',

                           'title' => esc_html__( 'Load more text', 'essence' ),

                           'desc' => esc_html__( 'Load more button text', 'essence' ),

                           'default' => esc_html__( 'Load more', 'essence' ),

                           'validate' => 'no_html',

                           'required' => array( 'opt_blog_layout_style', '=', 'masonry' ),

                    ),

                    array( // Don't remove me

                           'id' => 'opt_blog_masonry_nomore_text',

                           'type' => 'text',

                           'title' => esc_html__( 'No more post text', 'essence' ),

                           'desc' => esc_html__( 'Text show when no more post to load', 'essence' ),

                           'default' => esc_html__( 'No more post', 'essence' ),

                           'validate' => 'no_html',

                           'required' => array( 'opt_blog_layout_style', '=', 'masonry' ),

                    ),

                    array(

                        'id' => 'opt_blog_continue_reading',

                        'type' => 'text',

                        'title' => esc_html__( 'Continue reading', 'essence' ),

                        'subtitle' => esc_html__( 'Continue reading text', 'essence' ),

                        'default' => esc_html__( 'Read more', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_blog_loop_content_type',

                        'type' => 'switch',

                        'title' => esc_html__( 'Bog loop content', 'essence' ),

                        'subtitle' => esc_html__( 'Show the blog content or the excerpt on loop', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'The content', 'essence' ),

                        'off' => esc_html__( 'The excerpt', 'essence' ),

                        'required' => array( 'opt_blog_layout_style', '=', array( 'default' ) ),

                        'desc' => esc_html__( 'This option only work with default blog layout style', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_excerpt_max_char_length',

                        'type' => 'text',

                        'title' => esc_html__( 'The excerpt max chars length', 'essence' ),

                        'default' => 300,

                        'validate' => 'numeric',

                        'required' => array( 'opt_blog_loop_content_type', '!=', '1' ),

                        'desc' => esc_html__( 'The excerpt max chars length for default blog layout style', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_excerpt_max_char_length_standard', // For blog standard style

                        'type' => 'text',

                        'title' => esc_html__( 'The excerpt max chars length for standard', 'essence' ),

                        'default' => 300,

                        'validate' => 'numeric',

                        'required' => array( 'opt_blog_layout_style', '=', 'standard' ),

                        'desc' => esc_html__( 'The excerpt max chars length for standard blog layout style', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_blog_standard_show_place_hold_img', // For blog standard in excerpt mode only

                        'type' => 'switch',

                        'title' => esc_html__( 'Show placehold image', 'essence' ),

                        'desc' => esc_html__( 'Show placehold image if blog post standard has no feature image', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                        'required' => array(

                            array( 'opt_blog_layout_style', '=', 'standard' ),

                        ),

                    ),

                    array(

                        'id' => 'opt_blog_grid_show_place_hold_img', // For blog grid only

                        'type' => 'switch',

                        'title' => esc_html__( 'Show placehold image', 'essence' ),

                        'desc' => esc_html__( 'Show placehold image if blog post grid has no feature image', 'essence' ),

                        'default' => '0',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                        'required' => array(

                            array( 'opt_blog_layout_style', '=', 'grid' ),

                        ),

                    ),

                    array(

                        'id' => 'opt_blog_masonry_show_place_hold_img', // For blog masonry only

                        'type' => 'switch',

                        'title' => esc_html__( 'Show placehold image', 'essence' ),

                        'desc' => esc_html__( 'Show placehold image if blog post masonry has no feature image', 'essence' ),

                        'default' => '0',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                        'required' => array(

                            array( 'opt_blog_layout_style', '=', 'masonry' ),

                        ),

                    ),

                    array(

                        'id' => 'opt_blog_show_readmore',

                        'type' => 'switch',

                        'title' => esc_html__( 'Show read more', 'essence' ),

                        'desc' => esc_html__( 'Show read more button on blog archive', 'essence' ),

                        'default' => '0',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                        'required' => array( 'opt_blog_loop_content_type', '!=', 1 ),

                    ),

                    array(

                        'id' => 'opt_blog_metas',

                        'type' => 'select',

                        'multi' => true,

                        'title' => esc_html__( 'Blog metas', 'essence' ),

                        'options' => array(

                            'author' => esc_html__( 'Author', 'essence' ),

                            'date' => esc_html__( 'Date time', 'essence' ),

                            'category' => esc_html__( 'Category', 'essence' ),

                            'comment' => esc_html__( 'Comment', 'essence' ),

                            'tags' => esc_html__( 'Tags', 'essence' ),

                        ),

                        'sortable' => true,

                        'default' => array( 'author', 'date', 'category', 'comment', 'tags' ),

                    ),

                    array(

                        'id' => 'opt_single_post_header_title_section',

                        'type' => 'switch',

                        'title' => esc_html__( 'Header title section on single post', 'essence' ),

                        'default' => '1',

                        'on' => esc_html__( 'Show', 'essence' ),

                        'off' => esc_html__( 'Don\'t show', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_single_post_title_type',

                        'type' => 'select',

                        'multi' => false,

                        'title' => esc_html__( 'Single post title type', 'essence' ),

                        'options' => array(

                            'single' => esc_html__( 'Use single title', 'essence' ),

                            'blog' => esc_html__( 'Use blog title', 'essence' ),

                        ),

                        'default' => 'single',

                        'required' => array( 'opt_single_post_header_title_section', '=', '1' ),

                    ),

                    array(

                        'id' => 'opt_blog_single_post_bio',

                        'type' => 'switch',

                        'title' => esc_html__( 'Enable bio author in single post', 'essence' ),

                        'subtitle' => esc_html__( 'Enable bio author on/off', 'essence' ),

                        'default' => '1',

                        'on' => 'Enabled',

                        'off' => 'Disabled',

                    ),

                    array(

                        'id' => 'opt_enable_single_post_sharing',

                        'type' => 'switch',

                        'title' => esc_html__( 'Enable single post share links', 'essence' ),

                        'default' => '1',

                        'on' => 'Enabled',

                        'off' => 'Disabled',

                    ),

                    array(

                        'id' => 'opt_single_share_socials',

                        'type' => 'select',

                        'multi' => true,

                        'title' => esc_html__( 'Choose socials to share single post', 'essence' ),

                        'options' => array(

                            'facebook' => 'Facebook',

                            'gplus' => 'Google Plus',

                            'twitter' => 'Twitter',

                            'pinterest' => 'Pinterest',

                            'linkedin' => 'Linkedin',

                        ),

                        'sortable' => true,

                        'default' => array( 'facebook', 'gplus', 'twitter', 'pinterest', 'linkedin' ),

                        'required' => array( 'opt_enable_share_post', '=', '1' ),

                    ),

                ),

            );


            /*--Search Settings--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Search Settings', 'essence' ),

                'desc' => esc_html__( 'Search Settings', 'essence' ),

                'icon' => 'el-icon-search',

                'fields' => array(

                    array(

                        'id' => 'opt_display_search_result_for',

                        'type' => 'select',

                        'compiler' => true,

                        'title' => esc_html__( 'Display search result for', 'essence' ),

                        'multi' => true,

                        'data' => 'post_types',

                        'default' => array( 'post' ),

                    ),

                    array(

                        'id' => 'opt_dont_show_excerpt_on',

                        'type' => 'select',

                        'compiler' => true,

                        'title' => esc_html__( 'Don\'t show excerpt on', 'essence' ),

                        'desc' => esc_html__( 'Select post types you don\'t want to show the excerpt on search results page', 'essence' ),

                        'multi' => true,

                        'data' => 'post_types',

                        'default' => 'page',

                    ),

                    array(

                        'id' => 'opt_search_placeholder',

                        'type' => 'text',

                        'title' => esc_html__( 'Search place holder', 'essence' ),

                        'default' => esc_html__( 'Type & hit enter...', 'essence' ),

                        'validate' => 'no_html',

                    ),

                ),

            );


            /**
             * Check if WooCommerce is active
             **/

            if ( class_exists( 'WooCommerce' ) ) {


                /*-- Woocommerce Setting--*/

                $this->sections[] = array(

                    'title' => esc_html__( 'WooCommerce', 'essence' ),

                    'desc' => esc_html__( 'WooCommerce Settings', 'essence' ),

                    'icon' => 'el-icon-shopping-cart',

                    'fields' => array(

                        array(

                            'id' => 'woo_shop_sidebar_pos',

                            'type' => 'image_select',

                            'compiler' => true,

                            'title' => esc_html__( 'Woocommerce sidebar position', 'essence' ),

                            'subtitle' => esc_html__( 'Select Woocommerce sidebar position.', 'essence' ),

                            'desc' => esc_html__( 'Select sidebar on left or right', 'essence' ),

                            'options' => array(

                                'left' => array( 'alt' => '1 Column Left', 'img' => get_template_directory_uri() . '/assets/images/2cl.png' ),

                                'right' => array( 'alt' => '2 Column Right', 'img' => get_template_directory_uri() . '/assets/images/2cr.png' ),

                                'fullwidth' => array( 'alt' => 'Full Width', 'img' => get_template_directory_uri() . '/assets/images/1column.png' ),

                            ),

                            'default' => 'left',

                        ),

                        array(

                            'id' => 'opt_single_product_sidebar',

                            'type' => 'switch',

                            'title' => esc_html__( 'Single product sidebar', 'essence' ),

                            'default' => '1',

                            'on' => esc_html__( 'Enable', 'essence' ),

                            'off' => esc_html__( 'Disabled', 'essence' ),

                            'desc' => wp_kses( __( 'If <strong>Enable</strong>, sidebar shop will display on single product', 'essence' ), array( 'strong' => array(), 'b' => array(), 'a' => array( 'href' ) ) ),

                        ),

                        array(

                            'id' => 'woo_products_per_row',

                            'type' => 'image_select',

                            'compiler' => true,

                            'title' => esc_html__( 'Woocommerce products layout', 'essence' ),

                            'subtitle' => esc_html__( 'Set number column in products archive page.', 'essence' ),

                            'options' => array(

                                '3' => array( 'alt' => '3 Column ', 'img' => get_template_directory_uri() . '/assets/images/3columns.png' ),

                                '4' => array( 'alt' => '4 Column ', 'img' => get_template_directory_uri() . '/assets/images/4columns.png' ),

                            ),

                            'default' => '3',

                        ),

                        array(

                            'id' => 'opt_enable_share_product',

                            'type' => 'switch',

                            'title' => esc_html__( 'Enable single product share links', 'essence' ),

                            'default' => '1',

                            'on' => esc_html__( 'Enable', 'essence' ),

                            'off' => esc_html__( 'Disabled', 'essence' ),

                        ),

                        array(

                            'id' => 'opt_single_product_socials_share',

                            'type' => 'select',

                            'multi' => true,

                            'title' => esc_html__( 'Share product on', 'essence' ),

                            'subtitle' => esc_html__( 'Display sharing buttons on the single product pages', 'essence' ),

                            'options' => array(

                                'facebook' => 'Facebook',

                                'gplus' => 'Google Plus',

                                'twitter' => 'Twitter',

                                'pinterest' => 'Pinterest',

                                'linkedin' => 'Linkedin',

                            ),

                            'default' => array( 'facebook', 'gplus', 'twitter', 'pinterest', 'linkedin' ),

                            'required' => array( 'opt_enable_share_product', '=', '1' ),

                        ),

                    ),

                );

            }


            /*-- Contact Setting--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Newsletter Settings', 'essence' ),

                'desc' => esc_html__( 'Newsletter infomation settings', 'essence' ),

                'icon' => 'el-icon-envelope',

                'fields' => array(

                    array(

                        'id' => 'opt_mailchimp_api_key',

                        'type' => 'text',

                        'title' => esc_html__( 'Mailchimp API Key', 'essence' ),

                        'default' => '',

                        'desc' => sprintf( wp_kses( __( '<a href="%s" target="__blank">Click here to get your Mailchimp API key</a>', 'essence' ), array( 'a' => array( 'href' => array() ) ) ), 'https://admin.mailchimp.com/account/api' ),

                    ),

                    array(

                        'id' => 'opt_mailchimp_list_id',

                        'type' => 'text',

                        'title' => esc_html__( 'Mailchimp List ID', 'essence' ),

                        'default' => '',

                        'desc' => sprintf( wp_kses( __( '<a href="%s" target="__blank">How to find Mailchimp list ID</a>', 'essence' ), array( 'a' => array( 'href' => array() ) ) ), 'http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id' ),

                    ),

                    array(

                        'id' => 'opt_subscribe_form_title',

                        'type' => 'text',

                        'title' => esc_html__( 'Subscribe Form Title', 'essence' ),

                        'default' => esc_html__( 'Subscribe our newsletter', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_subscribe_form_input_placeholder',

                        'type' => 'text',

                        'title' => esc_html__( 'Email Input Placeholder', 'essence' ),

                        'default' => esc_html__( 'Your email address...', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_subscribe_form_submit_text',

                        'type' => 'text',

                        'title' => esc_html__( 'Submit Text', 'essence' ),

                        'default' => esc_html__( 'Submit', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_subscribe_success_message',

                        'type' => 'text',

                        'title' => esc_html__( 'Success Message', 'essence' ),

                        'default' => esc_html__( 'Your email added...', 'essence' ),

                    ),

                ),

            );


            /*--Social Settings--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Social Settings', 'essence' ),

                'icon' => 'el-icon-credit-card',

                'fields' => array(

                    array(

                        'id' => 'opt_twitter_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Twitter', 'essence' ),

                        'default' => 'https://twitter.com',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_fb_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Facebook', 'essence' ),

                        'default' => 'https://facebook.com',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_google_plus_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Google Plus', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_dribbble_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Dribbble', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_behance_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Behance', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_tumblr_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Tumblr', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_instagram_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Instagram', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_pinterest_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Pinterest', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_youtube_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Youtube', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_vimeo_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Vimeo', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_linkedin_link',

                        'type' => 'text',

                        'title' => esc_html__( 'Linkedin', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                    array(

                        'id' => 'opt_rss_link',

                        'type' => 'text',

                        'title' => esc_html__( 'RSS', 'essence' ),

                        'default' => '',

                        'validate' => 'url',

                    ),

                ),

            );


            /*-- Coming Soon Setting--*/

            $this->sections[] = array(

                'title' => esc_html__( 'Coming Soon Settings', 'essence' ),

                'icon' => 'el-icon-time',

                'fields' => array(

                    array(

                        'id' => 'opt_enable_coming_soon_mode',

                        'type' => 'switch',

                        'title' => esc_html__( 'Coming soon mode', 'essence' ),

                        'subtitle' => esc_html__( 'Turn coming soon mode on/off', 'essence' ),

                        'desc' => esc_html__( 'If turn on, every one need login to view site', 'essence' ),

                        'default' => 0,

                        'on' => esc_html__( 'On', 'essence' ),

                        'off' => esc_html__( 'Off', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_coming_soon_site_title',

                        'type' => 'text',

                        'title' => esc_html__( 'Coming Soon Site Title', 'essence' ),

                        'default' => esc_html__( 'We are coming soon', 'essence' ),

                        'validate' => 'no_html',

                    ),

                    array(

                        'id' => 'opt_coming_soon_img',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( 'Coming Soon Image', 'essence' ),

                        'compiler' => 'true',

                        'desc' => esc_html__( 'Upload image for coming soon page', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),

                        'required' => array( 'opt_enable_coming_soon_mode', '=', 1 ),

                    ),

                    array(

                        'id' => 'opt_coming_soon_text',

                        'type' => 'editor',

                        'title' => esc_html__( 'Coming soon text', 'essence' ),

                        'default' => wp_kses( __( 'Our site is currently undergoing scheduled maintenance<br>For any assistance in the meantime, drop us a line <a href="mailto:help@essencestore.com">help@essencestore.com</a>', 'essence' ), array( 'br' => array(), 'a' => array( 'href' => array() ), 'b' ) ),

                        'required' => array( 'opt_enable_coming_soon_mode', '=', 1 ),

                    ),

                    array(

                        'id' => 'opt_coming_soon_date',

                        'type' => 'date',

                        'title' => esc_html__( 'Coming soon date', 'essence' ),

                        'required' => array( 'opt_enable_coming_soon_mode', '=', 1 ),

                    ),

                    array(

                        'id' => 'opt_enable_coming_soon_newsletter',

                        'type' => 'switch',

                        'title' => esc_html__( 'Coming soon news letter', 'essence' ),

                        'desc' => esc_html__( 'If turn on, news latter form will show on coming soon page', 'essence' ),

                        'default' => 1,

                        'on' => esc_html__( 'On', 'essence' ),

                        'off' => esc_html__( 'Off', 'essence' ),

                        'required' => array( 'opt_enable_coming_soon_mode', '=', 1 ),

                    ),

                    array(

                        'id' => 'opt_disable_coming_soon_when_date_small',

                        'type' => 'switch',

                        'title' => esc_html__( 'Coming soon when count down date expired', 'essence' ),

                        'default' => 1,

                        'on' => esc_html__( 'Disable coming soon', 'essence' ),

                        'off' => esc_html__( 'Don\'t disable coming soon', 'essence' ),

                        'required' => array( 'opt_enable_coming_soon_mode', '=', 1 ),

                    ),

                ),

            );


            /*-- 404 Setting--*/

            $this->sections[] = array(

                'title' => esc_html__( '404 Settings', 'essence' ),

                'desc' => esc_html__( 'Setting for 404 error page', 'essence' ),

                'icon' => 'el-icon-bell',

                'fields' => array(

                    array(

                        'id' => 'opt_404_header_title',

                        'type' => 'text',

                        'title' => esc_html__( '404 header title', 'essence' ),

                        'default' => esc_html__( 'Oops, page not found !', 'essence' ),

                    ),

                    array(

                        'id' => 'opt_404_img',

                        'type' => 'media',

                        'url' => true,

                        'title' => esc_html__( '404 Image', 'essence' ),

                        'compiler' => 'true',

                        'desc' => esc_html__( 'Upload 404 image', 'essence' ),

                        'default' => array( 'url' => get_template_directory_uri() . '/assets/images/page404.png' ),

                    ),

                    array(

                        'id' => 'opt_404_text',

                        'type' => 'text',

                        'title' => esc_html__( 'Text', 'essence' ),

                        'default' => esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'essence' ),

                    ),

                ),

            );


        }


        public function setHelpTabs()

        {


            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.

            $this->args[ 'help_tabs' ][] = array(

                'id' => 'redux-opts-1',

                'title' => esc_html__( 'Theme Information 1', 'essence' ),

                'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'essence' ), array( 'p' ) ),

            );


            $this->args[ 'help_tabs' ][] = array(

                'id' => 'redux-opts-2',

                'title' => esc_html__( 'Theme Information 2', 'essence' ),

                'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'essence' ), array( 'p' ) ),

            );


            // Set the help sidebar

            $this->args[ 'help_sidebar' ] = wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'essence' ), array( 'p' ) );

        }


        /**
         *
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */

        public function setArguments()

        {


            $theme = wp_get_theme(); // For use with some settings. Not necessary.


            $this->args = array(

                // TYPICAL -> Change these values as you need/desire

                'opt_name' => 'essence', // This is where your data is stored in the database and also becomes your global variable name.

                'display_name' => '<span class="ts-theme-name">' . sanitize_text_field( $theme->get( 'Name' ) ) . '</span>', // Name that appears at the top of your panel

                'display_version' => $theme->get( 'Version' ), // Version that appears at the top of your panel

                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)

                'allow_sub_menu' => false, // Show the sections below the admin menu item or not

                'menu_title' => esc_html__( 'ESSENCE', 'essence' ),

                'page_title' => esc_html__( 'ESSENCE', 'essence' ),

                // You will need to generate a Google API key to use this feature.

                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth

                'google_api_key' => 'AIzaSyBnxzHttO52IQDpDkbZNbT48HL3o8YNb-k', // Must be defined to add google fonts to the typography module

                //'async_typography'    => true, // Use a asynchronous font on the front end or font string

                //'admin_bar'           => false, // Show the panel pages on the admin bar

                'global_variable' => 'essence', // Set a different name for your global variable other than the opt_name

                'dev_mode' => false, // Show the time the page took to load, etc

                'customizer' => true, // Enable basic customizer support

                // OPTIONAL -> Give you extra features

                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.

                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters

                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.

                'menu_icon' => '', // Specify a custom URL to an icon

                'last_tab' => '', // Force your panel to always open to a specific tab (by id)

                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title

                'page_slug' => 'essence_options', // Page slug used to denote the panel

                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not

                'default_show' => false, // If true, shows the default value next to each field that is not the default value.

                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *

                // CAREFUL -> These options are for advanced use only

                'transient_time' => 60 * MINUTE_IN_SECONDS,

                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output

                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.

                'footer_credit' => esc_html__( 'Theme Studio WordPress Team', 'essence' ), // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.

                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

                'show_import_export' => true, // REMOVE

                'system_info' => false, // REMOVE

                'help_tabs' => array(),

                'help_sidebar' => '', // esc_html__( '', $this->args['domain'] );

                'hints' => array(

                    'icon' => 'icon-question-sign',

                    'icon_position' => 'right',

                    'icon_color' => 'lightgray',

                    'icon_size' => 'normal',


                    'tip_style' => array(

                        'color' => 'light',

                        'shadow' => true,

                        'rounded' => false,

                        'style' => '',

                    ),

                    'tip_position' => array(

                        'my' => 'top left',

                        'at' => 'bottom right',

                    ),

                    'tip_effect' => array(

                        'show' => array(

                            'effect' => 'slide',

                            'duration' => '500',

                            'event' => 'mouseover',

                        ),

                        'hide' => array(

                            'effect' => 'slide',

                            'duration' => '500',

                            'event' => 'click mouseleave',

                        ),

                    ),

                ),

            );


            $this->args[ 'share_icons' ][] = array(

                'url' => 'https://www.facebook.com/thuydungcafe',

                'title' => 'Like us on Facebook',

                'icon' => 'el-icon-facebook',

            );

            $this->args[ 'share_icons' ][] = array(

                'url' => 'http://twitter.com/',

                'title' => 'Follow us on Twitter',

                'icon' => 'el-icon-twitter',

            );


            // Panel Intro text -> before the form

            if ( !isset( $this->args[ 'global_variable' ] ) || $this->args[ 'global_variable' ] !== false ) {

                if ( !empty( $this->args[ 'global_variable' ] ) ) {

                    $v = $this->args[ 'global_variable' ];

                }

                else {

                    $v = str_replace( "-", "_", $this->args[ 'opt_name' ] );

                }


            }

            else {


            }


        }


    }


    new Essence_Redux_Framework_config();

}


/**
 *
 * Custom function for the callback referenced above
 */

if ( !function_exists( 'redux_my_custom_field' ) ):


    function redux_my_custom_field( $field, $value )
    {

        print_r( $field );

        print_r( $value );

    }


endif;


/**
 *
 * Custom function for the callback validation referenced above
 * */

if ( !function_exists( 'redux_validate_callback_function' ) ):


    function redux_validate_callback_function( $field, $value, $existing_value )
    {

        $error = false;

        $value = 'just testing';


        $return[ 'value' ] = $value;

        if ( $error == true ) {

            $return[ 'error' ] = $field;

        }


        return $return;

    }


endif;