<?php 
add_action( 'vc_before_init', 'essence_core_VC_MAP_Accordion' );
function essence_core_VC_MAP_Accordion() {
    global $ts_vc_anim_effects_in;
    vc_map( 
        array(
            'name'        => __( 'Essence Core Accordion', 'essence-core' ),
            'base'        => 'vc_tta_accordion', // shortcode
            'class'       => '',
            'category'    => __( 'Essence', 'essence-core' ),
            'icon' => 'icon-wpb-ui-accordion',
        	'is_container' => true,
        	'show_settings_on_create' => false,
        	'as_parent' => array(
        		'only' => 'vc_tta_section'
        	),
        	'description' => __( 'Collapsible content panels', 'essence-core' ),
            'params'      => array(
                array(
        			'type' => 'textfield',
        			'param_name' => 'title',
        			'heading' => __( 'Widget title', 'essence-core' ),
        			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'essence-core' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'spacing',
        			'value' => array(
        				__( 'None', 'essence-core' ) => '',
        				'1px' => '1',
        				'2px' => '2',
        				'3px' => '3',
        				'4px' => '4',
        				'5px' => '5',
        				'10px' => '10',
        				'15px' => '15',
        				'20px' => '20',
        				'25px' => '25',
        				'30px' => '30',
        				'35px' => '35',
        			),
        			'heading' => __( 'Spacing', 'essence-core' ),
        			'description' => __( 'Select accordion spacing.', 'essence-core' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'c_align',
        			'value' => array(
        				__( 'Left', 'essence-core' ) => 'left',
        				__( 'Right', 'essence-core' ) => 'right',
        				__( 'Center', 'essence-core' ) => 'center',
        			),
        			'heading' => __( 'Alignment', 'essence-core' ),
        			'description' => __( 'Select accordion section title alignment.', 'essence-core' ),
        		),
        		array(
        			'type' => 'checkbox',
        			'param_name' => 'collapsible_all',
        			'heading' => __( 'Allow collapse all?', 'essence-core' ),
        			'description' => __( 'Allow collapse all accordion sections.', 'essence-core' ),
        		),
        		// Control Icons
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'c_icon',
        			'value' => array(
        				__( 'None', 'essence-core' ) => '',
        				__( 'Chevron', 'essence-core' ) => 'chevron',
        				__( 'Plus', 'essence-core' ) => 'plus',
        			),
        			'std' => 'plus',
        			'heading' => __( 'Icon', 'essence-core' ),
        			'description' => __( 'Select accordion navigation icon.', 'essence-core' ),
        		),
        		array(
        			'type' => 'dropdown',
        			'param_name' => 'c_position',
        			'value' => array(
        				__( 'Left', 'essence-core' ) => 'left',
        				__( 'Right', 'essence-core' ) => 'right',
        			),
        			'dependency' => array(
        				'element' => 'c_icon',
        				'not_empty' => true,
        			),
        			'heading' => __( 'Position', 'essence-core' ),
        			'description' => __( 'Select accordion navigation icon position.', 'essence-core' ),
        		),
        		// Control Icons END
        		array(
        			'type' => 'textfield',
        			'param_name' => 'active_section',
        			'heading' => __( 'Active section', 'essence-core' ),
        			'value' => 1,
        			'description' => __( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'essence-core' ),
        		),
        		array(
        			'type' => 'textfield',
        			'heading' => __( 'Extra class name', 'essence-core' ),
        			'param_name' => 'el_class',
        			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'essence-core' ),
        		),
        		array(
        			'type' => 'css_editor',
        			'heading' => __( 'CSS box', 'essence-core' ),
        			'param_name' => 'css',
        			'group' => __( 'Design Options', 'essence-core' )
        		),
            ),
            'js_view' => 'VcBackendTtaAccordionView',
            	'custom_markup' => '
            <div class="vc_tta-container" data-vc-action="collapseAll">
            	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
            	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
            	      {{ content }}
            	      <div class="vc_tta-panel vc_tta-section-append">
            	         <div class="vc_tta-panel-heading">
            	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
            	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
            	                   <span class="vc_tta-title-text">' . __( 'Add Section', 'essence-core' ) . '</span>
            	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
            					</a>
            	            </h4>
            	         </div>
            	      </div>
            	   </div>
            	</div>
            </div>',
            	'default_content' => '
            [vc_tta_section title="' . sprintf( "%s %d", __( 'Section', 'essence-core' ), 1 ) . '"][/vc_tta_section]
            [vc_tta_section title="' . sprintf( "%s %d", __( 'Section', 'essence-core' ), 2 ) . '"][/vc_tta_section]
            	'
        )
    );
}
