<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_stat_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"stat_image" => '',
			"stat_percentage" => '85',
			"text_color" =>'#ffffff',
			"bg_color" =>'#283E4E',
			"class" => 'wow fadeInUp',
			"animation_delay" => '0.3'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($stat_image, "large"); 
			$stat_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-statistic-box-wrapper <?php esc_attr_e($class); ?>" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="<?php esc_attr_e($animation_delay); ?>s">
        
        	<div class="pm-statistic-box-container" style="background-color:<?php esc_attr_e($bg_color); ?>;">
				<?php if( $stat_percentage !== '' ){ ?>
                    <h3 style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e($stat_percentage); ?></h3>
                <?php } ?>
                <?php echo $content; ?>
                <?php if( $stat_image !== '' ){ ?>
                    <img src="<?php echo esc_url($stat_image); ?>" class="img-responsive" alt="stat_icon">
                <?php } ?>
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

    "base"      => "pm_ln_stat_box",
    "name"      => __("Stat Box", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "attach_image",
            "heading" => __("Stat Image", 'quantumtheme'),
            "param_name" => "stat_image",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Stat Percentage", 'quantumtheme'),
            "param_name" => "stat_percentage",
            "description" => __("Accepts a positive integer value.", 'quantumtheme'),
			"value" => '85'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#ffffff'
        ),
		
		
		array(
            "type" => "colorpicker",
            "heading" => __("Background Color", 'quantumtheme'),
            "param_name" => "bg_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#283E4E'
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