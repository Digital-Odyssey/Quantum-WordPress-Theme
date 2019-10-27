<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_cta_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => '',
			"icon" => 'fa fa-exclamation',
			"icon_color" => '#DBC164',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-quantum-alert-message">
            <i class="<?php esc_attr_e($icon); ?>" style="background-color:<?php esc_attr_e($icon_color); ?>;"></i>
            <p class="pm-quantum-alert-title"><?php esc_attr_e($title); ?></p>
            <p class="pm-quantum-alert-details"><?php echo $content ?></p>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_cta_box",
    "name"      => __("Call to Action", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", 'quantumtheme'),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 value. (Ex. fa fa-exclamation)", 'quantumtheme'),
			"value" => 'fa fa-exclamation'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "icon_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#DBC164'
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