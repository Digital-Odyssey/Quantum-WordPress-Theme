<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_contact_form extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"title" => 'Contact Form',
			"title_size" => 28,
			"recipient_email" => 'info@microthemes.ca',
			"alert_message" => 'Your email address will be held strictly confidential. Required fields are marked *',
			"button_text" => 'Submit Inquiry',
			"text_color" => '#ff0000',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <p class="pm-contact-form-title pm-secondary" style="font-size:<?php esc_attr_e($title_size); ?>px;"><?php esc_attr_e($title); ?></p>
		<div class="pm-contact-form-container">
			<p class="pm-required" style="color:<?php esc_attr_e($text_color); ?>;"><?php esc_attr_e($alert_message); ?></p>
			<form action="#" method="post" id="pm-contact-form">
				<input name="pm_s_full_name" id="pm_s_full_name" type="text" placeholder="<?php esc_attr_e('Name *', 'quantumtheme'); ?>" class="pm-form-textfield">
				<input name="pm_s_email_address" id="pm_s_email_address" type="text" placeholder="<?php esc_attr_e('Email *', 'quantumtheme'); ?>" class="pm-form-textfield">
				<input name="pm_s_subject" id="pm_s_subject" type="text" placeholder="<?php esc_attr_e('Subject *', 'quantumtheme'); ?>" class="pm-form-textfield">
				<textarea name="pm_s_message" id="pm_s_message" cols="20" rows="6" placeholder="<?php esc_attr_e('Inquiry *', 'quantumtheme'); ?>" class="pm-form-textarea"></textarea>
				
				<div id="pm-contact-form-response"></div>	
				<input name="pm-form-submit-btn" class="pm-rounded-submit-btn" type="button" value="<?php esc_attr_e($button_text); ?>" id="pm-contact-form-btn">
				<input type="hidden" value="pm-contact-form-submitted" />
				<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="<?php esc_attr_e($recipient_email); ?>" />
				
				<?php wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); ?>
				
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

    "base"      => "pm_ln_contact_form",
    "name"      => __("Contact Form", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(

		array(
            "type" => "textfield",
            "heading" => __("Form Title", 'quantumtheme'),
            "param_name" => "title",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => 'Contact Form'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Title Size", 'quantumtheme'),
            "param_name" => "title_size",
            "description" => __("Set the size of the form title. This accepts a positive integer value.", 'quantumtheme'),
			"value" => 28
        ),
		

		array(
            "type" => "textfield",
            "heading" => __("Recipient email address", 'quantumtheme'),
            "param_name" => "recipient_email",
            "description" => __("Enter the email address where the message will be sent to.", 'quantumtheme'),
			"value" => 'info@microthemes.ca'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Form Message", 'quantumtheme'),
            "param_name" => "alert_message",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => 'Your email address will be held strictly confidential. Required fields are marked *'
        ),
		
		array(
            "type" => "textfield",
            "heading" => __("Button Text", 'quantumtheme'),
            "param_name" => "button_text",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => 'Submit Inquiry'
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => __("Text Color", 'quantumtheme'),
            "param_name" => "text_color",
            //"description" => __("Enter a CSS class if required.", 'quantumtheme'),
			"value" => '#ff0000'
        ),
		



    )

));