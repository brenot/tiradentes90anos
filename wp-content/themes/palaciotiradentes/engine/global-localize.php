<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !function_exists( 'essence_global_localize' ) ) {
    function essence_global_localize()
    {
        // Define Global localize variable
        global $essence_global_localize;

        // essence
        $essence_global_localize = array(
            'is_mobile'                 => 'false',
            'custom_style_via_ajax_url' => admin_url( 'admin-ajax.php' ) . '?action=essence_enqueue_style_via_ajax',  // This action locate in plugins/essence-core/core/ajax-css.php
            'html'                      => array(
                'countdown'            => '<div class="counter-item">
                                        <span class="number">%D</span>
                                        <span class="lbl">' . esc_html__( 'Days', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%H</span>
                                        <span class="lbl">' . esc_html__( 'Hours', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%M</span>
                                        <span class="lbl">' . esc_html__( 'Minutes', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%S</span>
                                        <span class="lbl">' . esc_html__( 'Seconds', 'essence' ) . '</span>
                                    </div>',
                'countdown_admin_menu' => '<div class="counter-item">
                                        <span class="number">%D</span>
                                        <span class="lbl">' . esc_html__( 'D', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%H</span>
                                        <span class="lbl">' . esc_html__( 'H', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%M</span>
                                        <span class="lbl">' . esc_html__( 'M', 'essence' ) . '</span>
                                    </div>
                                    <div class="counter-item">
                                        <span class="number">%S</span>
                                        <span class="lbl">' . esc_html__( 'S', 'essence' ) . '</span>
                                    </div>',
            ),
        );

    }

    add_action( 'init', 'essence_global_localize', 1 );
}

