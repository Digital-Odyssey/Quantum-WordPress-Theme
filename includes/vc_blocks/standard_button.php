<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_standard_button extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(	
			"btn_text" => '',					
			"link" => '#',
			"margin_top" => 0,
			"margin_bottom" => 0,
			"target" => '_self',
			"icon" => 'fa fa-angle-right',
			"transparency" => 'off',
			"animated" => 'off',
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
        
        <div class="pm-rounded-btn <?php echo ( $transparency == 'on' ? 'transparent' : '' ) .' '. ( $animated == 'on' ? 'animated' : '' ) .' '. esc_attr_e($class) ?>" style="margin-top:<?php esc_attr_e($margin_top) ?>px; margin-bottom:<?php esc_attr_e($margin_bottom) ?>px;"><a href="<?php echo esc_url($link); ?>" target="<?php esc_attr_e($target); ?>"><?php esc_attr_e($btn_text); ?> <? echo ( $icon !== '' ? '<i class="'.$icon.'"></i>' : '' ); ?></a></div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_standard_button",
    "name"      => __("Button", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'quantumtheme'),
            "param_name" => "btn_text",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Link", 'quantumtheme'),
            "param_name" => "link",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#'
        ),
				
		array(
            "type" => "textfield",
            "heading" => __("Margin Top", 'quantumtheme'),
            "param_name" => "margin_top",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => 0
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", 'quantumtheme'),
            "param_name" => "margin_bottom",
            "description" => __("Enter a positive integer value.", 'quantumtheme'),
			"value" => 0
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'quantumtheme'),
            "param_name" => "target",
            "description" => __("Set the target window for the button.", 'quantumtheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome 4 icon value. (Ex. fa fa-angle-right)", 'quantumtheme'),
			"value" => 'fa fa-angle-right'
        ),
		
		/*array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
            //"description" => __("Enter an icon value.", 'quantumtheme'),
			"value" => '#ffffff'
        ),*/
		
		array(
            "type" => "dropdown",
            "heading" => __("Enable Transparency?", 'quantumtheme'),
            "param_name" => "transparency",
            "description" => __("Removes the background color making the button transparent.", 'quantumtheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Button Animation?", 'quantumtheme'),
            "param_name" => "animated",
            "description" => __("Adds a rollover animation effect to the icon.", 'quantumtheme'),
			"value"      => array( 'off' => 'off', 'on' => 'on' ), //Add default value in $atts
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'quantumtheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),


    )

));