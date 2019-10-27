<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_stat_box_secondary extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"bg_image" => '',
			"stat_number" => '10',
			"stat_title" => '10',
			"text_color" =>'#ffffff',
			"class" => 'wow fadeInUp',
			"animation_delay" => '0.3'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($bg_image, "large"); 
			$bg_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-statistic-box <?php esc_attr_e($class); ?>" data-wow-delay="<?php esc_attr_e($animation_delay); ?>s" data-wow-offset="50" data-wow-duration="1s">
            <div class="pm-statistic-box-triangle" style="background-image:url(<?php echo esc_url($bg_image); ?>);">
                <p class="pm-statistic-text1"><?php esc_attr_e($stat_number); ?></p>
                <p class="pm-statistic-text2"><?php esc_attr_e($stat_title); ?></p>
            </div>
            <div class="pm-statistic-box-desc">
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

    "base"      => "pm_ln_stat_box_secondary",
    "name"      => __("Stat Box - Secondary", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'quantumtheme'),
            "param_name" => "bg_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stat Number", 'quantumtheme'),
            "param_name" => "stat_number",
            "description" => __("Accepts a positive integer value.", 'quantumtheme'),
			"value" => '10'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stat Title", 'quantumtheme'),
            "param_name" => "stat_title",
            //"description" => __("Accepts a positive integer value.", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#ffffff'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Class", 'quantumtheme'),
            "param_name" => "class",
            "description" => __("Apply a custom CSS class if required", 'quantumtheme'),
			"value" => 'wow fadeInUp'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Animation Delay", 'quantumtheme'),
            "param_name" => "animation_delay",
            "description" => __("Accepts a positive integer value.", 'quantumtheme'),
			"value" => '0.3'
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
            "description" => __("Enter a short description for your service.", 'quantumtheme')
        ),

    )

));