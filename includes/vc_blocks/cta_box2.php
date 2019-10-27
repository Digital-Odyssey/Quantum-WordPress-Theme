<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_cta_box_secondary extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"divider_color" => '#dbc164',
			"class" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-cta-container <?php esc_attr_e($class); ?>">
            <div class="pm-cta-divider" style="background-color:<?php esc_attr_e($divider_color); ?>;"></div>
            <p class="pm-cta-text"><?php echo $content ?></p>
            <div class="pm-cta-divider" style="background-color:<?php  esc_attr_e($divider_color); ?>;"></div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_cta_box_secondary",
    "name"      => __("Call to Action - Secondary", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "colorpicker",
            "heading" => __("Divider Color", 'quantumtheme'),
            "param_name" => "divider_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#dbc164'
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Class", 'quantumtheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			//"value" => 'Purchase Now'
        ),	
		

    )

));