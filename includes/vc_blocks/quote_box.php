<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_quote_box extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"author_name" => '',
			"author_title" => '',
			"avatar" => '',
			"text_color" => 'white',
			"name_color" => '#4D4D4D'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($avatar, "large"); 
			$avatar = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-single-testimonial-container">
            <div class="pm-single-testimonial-box">
                <p style="color:<?php esc_attr_e($text_color); ?>;"><?php echo $content ?></p>
            </div>
            <div class="pm-single-testimonial-author-container">
                <?php if($avatar !== ''){ ?>
                    <div class="pm-single-testimonial-author-avatar">
                        <img src="<?php echo esc_url($avatar); ?>" alt="avatar">
                    </div>
                <?php }	?>		
                <div class="pm-single-testimonial-author-info">
                    <p class="name" style="color:<?php esc_attr_e($name_color); ?>;"><?php esc_attr_e($author_name); ?></p>
                    <p class="title" style="color:<?php esc_attr_e($name_color); ?>;"><?php esc_attr_e($author_title); ?></p>
                </div>
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

    "base"      => "pm_ln_quote_box",
    "name"      => __("Quote Box", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Author Name", 'quantumtheme'),
            "param_name" => "author_name",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Author Title", 'quantumtheme'),
            "param_name" => "author_title",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'quantumtheme'),
            "param_name" => "avatar",
            //"description" => __("Enter an image path for the image you would like to represent your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
			"value" => '#ffffff'
            //"description" => __("Enter a short description for your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Name Color", 'quantumtheme'),
            "param_name" => "name_color",
			"value" => '#4D4D4D'
            //"description" => __("Enter a short description for your service.", 'quantumtheme')
        ),
		
		array(
            "type" => "textarea_html",
            "heading" => __("Content", 'quantumtheme'),
            "param_name" => "content",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
        ),

    )

));