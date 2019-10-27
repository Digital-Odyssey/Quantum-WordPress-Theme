<?php

if(!class_exists('WPBakeryShortCode')) return;

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_pm_ln_accordion_group extends WPBakeryShortCodesContainer {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				'el_id' => '',
				//'expand_options' => 'off',
				//'link_color' => '#ffffff'
			), $atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
			
			$GLOBALS['pm_ln_accordion_id'] = (int) $el_id;
			$GLOBALS['pm_ln_accordion_count'] = 0;
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <div class="panel-group" id="accordion<?php echo $GLOBALS['pm_ln_accordion_id']; ?>" role="tablist" aria-multiselectable="true"><?php echo do_shortcode($content); ?></div>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_pm_ln_accordion_group_item extends WPBakeryShortCode {
		
		protected function content($atts, $content = null) {

			//$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
	
			extract(shortcode_atts(array(
				"el_title" => '',
				"el_button_color" => '#2b5c84',
				"el_icon_color" => '#DBC164',
				"el_button_text_color" => '#ffffff',
				"el_content_bg_color" => '#ffffff',
				), 
			$atts));
	
	
			/* ================  Render Shortcodes ================ */
	
			ob_start();
	
			?>
			
			<?php 
				//$img = wp_get_attachment_image_src($el_image, "large"); 
				//$imgSrc = $img[0];
			?>
	
			<!-- Element Code start -->
			
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $GLOBALS['pm_ln_accordion_count']; ?>">
                
                    <h4 class="panel-title"><i class="fa fa-plus" style="background-color:<?php esc_attr_e($el_icon_color); ?>;"></i><a class="pm-accordion-link" href="#<?php echo $GLOBALS['pm_ln_accordion_id']; ?>collapse<?php echo $GLOBALS['pm_ln_accordion_count']; ?>" data-parent="#accordion<?php echo $GLOBALS['pm_ln_accordion_id']; ?>" data-toggle="collapse" data-toggleById="collapse<?php echo $GLOBALS['pm_ln_accordion_id']; ?>" style="background-color:<?php esc_attr_e($el_button_color); ?>; color:<?php esc_attr_e($el_button_text_color); ?>;" aria-expanded="true"><?php esc_attr_e($el_title); ?></a></h4>
                    
                </div>
                <div id="<?php echo $GLOBALS['pm_ln_accordion_id']; ?>collapse<?php echo $GLOBALS['pm_ln_accordion_count']; ?>" style="background-color:<?php esc_attr_e($el_content_bg_color); ?>;" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $GLOBALS['pm_ln_accordion_count']; ?>">
                    <div class="panel-body">
                        <?php echo do_shortcode($content); ?>
                    </div>
                </div>
             </div>
            
            <?php $GLOBALS['pm_ln_accordion_count']++; ?>
            
			<!-- Element Code / END -->
	
			<?php
	
			$output = ob_get_clean();
	
			/* ================  Render Shortcodes ================ */
	
			return $output;
	
		}
		
    }
}


vc_map( array(
    "name" => __("Accordion Menu", 'quantumtheme'),
    "base" => "pm_ln_accordion_group",
	"category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "as_parent" => array('only' => 'pm_ln_accordion_group_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    "params" => array(
	
        // add params same as with any other content element	
		array(
            "type" => "dropdown",
            "heading" => __("Element ID", 'quantumtheme'),
            "param_name" => "el_id",
            "description" => __("Assign a unique number value for this Accordion Menu. If you are creating multiple Accordion Menus on a single page please make sure each accordion menu has a unique number assigned to it in order to avoid conflicts between menus.", 'quantumtheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		/*array(
            "type" => "dropdown",
            "heading" => __("Display Expand/Collapse links?", 'quantumtheme'),
            "param_name" => "expand_options",
            //"description" => __("Choose the divider style you desire.", 'quantumtheme'),
			"value"      => array( 'no' => 'no', 'yes' => 'yes' ), //Add default value in $atts
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Link Color", 'quantumtheme'),
            "param_name" => "link_color",
			"value" => '#ffffff'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),*/
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => __("Accordion Item", 'quantumtheme'),
    "base" => "pm_ln_accordion_group_item",
	"category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "content_element" => true,
    "as_child" => array('only' => 'pm_ln_accordion_group'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
	
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Title", 'quantumtheme'),
            "param_name" => "el_title",
            //"description" => __("Enter a title", 'quantumtheme'),
			"value" => ''
        ),

		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Color", 'quantumtheme'),
            "param_name" => "el_button_color",
			"value" => '#2b5c84'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "el_icon_color",
			"value" => '#DBC164'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Button Text Color", 'quantumtheme'),
            "param_name" => "el_button_text_color",
			"value" => '#ffffff'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Content Background Color", 'quantumtheme'),
            "param_name" => "el_content_bg_color",
			"value" => '#ffffff'
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
				
		
    )
) );