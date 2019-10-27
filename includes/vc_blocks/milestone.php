<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_milestone extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(			
			"speed" => "3000",
			"stop" => "100",
			"caption" => "Quality Assurance",
			"icon" => "typcn typcn-chart-line",
			"icon_color" => "#295D84",
			"icon_size" => 50,
			"font_size" => 60,
			"style" => 1,
			"display_percent" => 'yes'	
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="milestone <?php echo ( $style == 'Style 2' ? 'alt' : '' ); ?>">
            <i class="<?php esc_attr_e($icon); ?>" style="color:<?php echo esc_attr_e($icon_color); ?>; font-size:<?php echo esc_attr_e($icon_size); ?>px;"></i>
            <div class="milestone-content" style="font-size:<?php esc_attr_e($font_size); ?>px;">  
                  
                <?php if( $display_percent === 'yes' ){ ?>
                    <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value"></span>%
                <?php } else { ?>
                    <span data-speed="<?php esc_attr_e($speed); ?>" data-stop="<?php esc_attr_e($stop); ?>" class="milestone-value"></span>
                <?php } ?>
                
                
                <div class="milestone-description"><?php esc_attr_e($caption); ?></div>
            </div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_milestone",
    "name"      => __("Milestone", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	

		array(
            "type" => "textfield",
            "heading" => __("Speed", 'quantumtheme'),
            "param_name" => "speed",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => '3000'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stop value", 'quantumtheme'),
            "param_name" => "stop",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => '100'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Caption", 'quantumtheme'),
            "param_name" => "caption",
            "description" => __("Enter a short caption.", 'quantumtheme'),
			"value" => 'Quality Assurance'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Enter a Typicon icon or FontAwesome 4 icon value. (Ex. typcn typcn-cog / fa fa-ambulance)", 'quantumtheme'),
			"value" => 'typcn typcn-chart-line'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter a Typicon icon or FontAwesome 4 icon value. (Ex. typcn typcn-cog / fa fa-ambulance)", 'quantumtheme'),
			"value" => '#295D84'
        ),
			
		
		array(
            "type" => "textfield",
            "heading" => __("Icon Size", 'quantumtheme'),
            "param_name" => "icon_size",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => 50
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Font Size", 'quantumtheme'),
            "param_name" => "font_size",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => 60
        ),

		
		array(
            "type" => "dropdown",
            "heading" => __("Milestone Style", 'quantumtheme'),
            "param_name" => "style",
            "description" => __("Choose between two different milestone layouts.", 'quantumtheme'),
			"value"      => array( 'Style 1' => 'Style 1', 'Style 2' => 'Style 2' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display percentage symbol?", 'quantumtheme'),
            "param_name" => "display_percent",
            //"description" => __("Removes the background color making the button transparent.", 'quantumtheme'),
			"value"      => array( 'yes' => 'yes', 'no' => 'no' ), //Add default value in $atts
        ),
						

    )

));