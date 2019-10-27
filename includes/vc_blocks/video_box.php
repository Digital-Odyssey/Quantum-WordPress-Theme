<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_videobox extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_icon" => 'typcn typcn-video',
			"el_video_link" => '',
			"el_video_image" => '',
			"el_link" => 'on',
			"el_link_text" => 'View our gallery',
			"el_link_url" => ''
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			$img = wp_get_attachment_image_src($el_video_image, "large"); 
			$el_video_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-video-container" style="background-image:url(<?php echo esc_url($el_video_image); ?>);">
            <div class="pm-video-overlay">
                <a href="<?php echo esc_url($el_video_link); ?>" data-rel="prettyPhoto" class="pm-video-activator-btn <?php echo esc_attr($el_icon); ?> expand lightbox"></a>
            </div>
        </div>
        
        <?php if($el_link === 'on') : ?>
            <a class="pm-rounded-btn pm-center-align" href="<?php echo esc_url($el_link_url) ?>"><?php echo esc_attr($el_link_text); ?> <i class="fa fa-plus"></i></a>	
        <?php endif; ?>	
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_videobox",
    "name"      => __("Video Box", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "el_icon",
            "description" => __("Enter a FontAwesome 4 or Typicon icon value.", 'quantumtheme'),
			"value" => 'typcn typcn-video'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video URL", 'quantumtheme'),
            "param_name" => "el_video_link",
            "description" => __("Enter a URL path for your video. (Ex. https://www.youtube.com/watch?v=XFPLSUZBCB8)", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "attach_image",
            "heading" => __("Background Image", 'quantumtheme'),
            "param_name" => "el_video_image",
            "description" => __("Upload a background image for your video box.", 'quantumtheme')
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Activate Video Link?", 'quantumtheme'),
            "param_name" => "el_link",
            "description" => __("Choose whether to activate the video link.", 'quantumtheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off' ), //Add default value in $atts
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video Link Text", 'quantumtheme'),
            "param_name" => "el_link_text",
            "description" => __("Enter a custom message for your video link button - only applies if Video link is active.", 'quantumtheme'),
			"value" => 'View our gallery'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Video Link URL", 'quantumtheme'),
            "param_name" => "el_link_url",
            "description" => __("Enter a custom URL for your video link button - only applies if Video link is active.", 'quantumtheme'),
			"value" => ''
        ),
				


    )

));