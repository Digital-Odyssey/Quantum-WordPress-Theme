<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_feature_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => '',
			"icon" => 'fa fa-thumbs-o-up',
			//"animation_delay" => '0.3',
			"icon_color" => '#2C5C82',
			"title_color" => '#2C5C82',		
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="feature-box">
            <i class="<?php esc_attr_e($icon); ?>" style="color:<?php esc_attr_e($icon_color); ?>;"></i>
            <div class="content">
                <h4 class="uppercase" style="color:<?php esc_attr_e($title_color); ?>;"><?php esc_attr_e($title); ?></h4>
                 <?php echo $content; ?>
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

    "base"      => "pm_ln_feature_box",
    "name"      => __("Feature Box", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Title", 'quantumtheme'),
            "param_name" => "title",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'quantumtheme'),
			"value" => ''
        ),
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'quantumtheme'),
			"value" => 'fa fa-thumbs-o-up'
        ),
		
		/*array(
            "type" => "textfield",
            "heading" => __("Animation Delay", 'quantumtheme'),
            "param_name" => "animation_delay",
            "description" => __("Accepts a positive integer value.", 'quantumtheme'),
			"value" => '0.3'
        ),*/
		
		array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", 'quantumtheme'),
            "param_name" => "icon_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'quantumtheme'),
			"value" => '#2C5C82'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Title Color", 'quantumtheme'),
            "param_name" => "title_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'quantumtheme'),
			"value" => '#2C5C82'
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
            //"description" => __("Enter a short description for your service.", 'quantumtheme')
        ),


    )

));