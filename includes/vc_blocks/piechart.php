<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_piechart extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"bar_size" => 220,
			"line_width" => 12,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			//"text_color" => "#ffffff",
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40,
			"display_percent" => 'on'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div data-barsize="<?php esc_attr_e($bar_size); ?>" data-linewidth="<?php esc_attr_e($line_width); ?>" data-trackcolor="<?php esc_attr_e($track_color); ?>" data-barcolor="<?php esc_attr_e($bar_color); ?>" data-percent="<?php esc_attr_e($percentage); ?>" class="pm-pie-chart">
            <div class="pm-pie-chart-percent" style="font-size:<?php esc_attr_e($font_size); ?>px;">
                <?php if( $display_percent === 'on' ){ ?>
                    <span></span>%
                <?php } else { ?>
                    <span></span>
                <?php } ?>
                
            </div>			
        </div>
        <div class="pm-pie-chart-description">
            <i class="<?php esc_attr_e($icon); ?>"></i>
            <?php esc_attr_e($caption); ?>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_piechart",
    "name"      => __("Pie Chart", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Bar Size", 'quantumtheme'),
            "param_name" => "bar_size",
            "description" => __("Enter a positive numeric value to set the size of the track bar.", 'quantumtheme'),
			"value" => 220
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Line Width", 'quantumtheme'),
            "param_name" => "line_width",
            "description" => __("Enter a positive numeric value to set the size of the line bar.", 'quantumtheme'),
			"value" => 12
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Track Color", 'quantumtheme'),
            "param_name" => "track_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'quantumtheme'),
			"value" => "#dbdbdb"
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Bar Color", 'quantumtheme'),
            "param_name" => "bar_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'quantumtheme'),
			"value" => "#2B5C84"
        ),
		
		/*array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a positive numeric value to set the size of the line bar.", 'quantumtheme'),
			"value" => "#ffffff"
        ),*/
		
		array(
            "type" => "textfield",
            "heading" => __("Percentage", 'quantumtheme'),
            "param_name" => "percentage",
            "description" => __("Enter a positive numeric value.", 'quantumtheme'),
			"value" => 75
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Accepts a Typicon value. (Ex. typcn typcn-thumbs-up)", 'quantumtheme'),
			"value" => 'typcn typcn-thumbs-up'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'quantumtheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'quantumtheme'),
			"value" => "Cost Reduction"
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Percentage symbol?", 'quantumtheme'),
            "param_name" => "display_percent",
            "description" => __("Choose the divider style you desire.", 'quantumtheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'quantumtheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive numeric value.", 'quantumtheme'),
			"value" => 40
        ),

    )

));