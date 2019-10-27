<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_icon_element extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"icon" => 'typcn typcn-device-tablet',
			"color" => '#2B5C84',
			"size" => 4
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-icon-box"><span class="<?php esc_attr_e($symbol); ?> typcn-size<?php esc_attr_e($size); ?>" style="color:<?php esc_attr_e($color); ?>;"></span></div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_icon_element",
    "name"      => __("Icon Element", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(

		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-twitter)", 'quantumtheme'),
			"value" => 'fa fa-twitter'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "color",
            //"description" => __("Accepts a FontAwesome 4 or Lineicons value.", 'quantumtheme'),
			"value" => '#2B5C84'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Size", 'quantumtheme'),
            "param_name" => "size",
            "description" => __("Set the size of the icon. This field accepts a positive integer value.", 'quantumtheme'),
			"value" => 4
        ),

    )

));