<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_newsletter_registration extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"mailchimp_url" => '',
			"name_placeholder" => 'Your Name',
			"email_placeholder" => 'Email Address',
			"display_name" => 'on'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_video_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-workshop-newsletter-form-container">
            <form action="<?php echo htmlspecialchars($mailchimp_url); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  
            	<?php if($display_name === 'on') : ?>
                	<input name="MERGE1" type="text" id="MERGE1" placeholder="<?php esc_attr_e($name_placeholder); ?>">
                <?php endif; ?>                
                <input name="MERGE0" type="text" id="MERGE0" placeholder="<?php esc_attr_e($email_placeholder); ?>">
                <input name="subscribe" id="mc-embedded-subscribe" type="submit" value="subscribe" class="pm-workshop-newsletter-submit-btn">
            </form>
         </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_newsletter_registration",
    "name"      => __("Newsletter Registration", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Mailchimp URL", 'quantumtheme'),
            "param_name" => "mailchimp_url",
            "description" => __("Enter your MailChimp Subscribe URL (ex. http://pulsarmedia.us4.list-manage.com/subscribe/post?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d).", 'quantumtheme'),
			"value" => ''
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Name field placeholder", 'quantumtheme'),
            "param_name" => "name_placeholder",
            "description" => __("Enter a placeholder value for the name field.", 'quantumtheme'),
			"value" => 'Your Name'
        ),
		
		
		array(
            "type" => "textfield",
            "heading" => __("Email field placeholder", 'quantumtheme'),
            "param_name" => "email_placeholder",
            "description" => __("Enter a placeholder value for the email field.", 'quantumtheme'),
			"value" => 'Email Address'
        ),	
		
		array(
            "type" => "dropdown",
            "heading" => __("Display Name Field?", 'quantumtheme'),
            "param_name" => "display_name",
            "description" => __("Choose whether or not to display the name field.", 'quantumtheme'),
			"value"      => array( 'on' => 'on', 'off' => 'off'), //Add default value in $atts
        ),


    )

));