<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_workshop_post extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"post_id" => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		//Method to retrieve a single post
		$queried_post = get_post($post_id);
		$postID = $queried_post->ID;
		$postLink = $queried_post->guid;
		$postTitle = $queried_post->post_title;
		
		$pm_workshop_related_course_title_meta = get_post_meta($postID, 'pm_workshop_related_course_title_meta', true);
		$pm_workshop_short_description_meta = get_post_meta($postID, 'pm_workshop_short_description_meta', true);
		$pm_workshop_date_meta = get_post_meta($postID, 'pm_workshop_date_meta', true);
		$w_month = date("M", strtotime($pm_workshop_date_meta));
		$w_day = date("d", strtotime($pm_workshop_date_meta));
		$w_year = date("Y", strtotime($pm_workshop_date_meta));
		$pm_workshop_start_time_meta = get_post_meta($postID, 'pm_workshop_start_time_meta', true);
		$pm_workshop_icon_meta = get_post_meta($postID, 'pm_workshop_icon_meta', true);

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-workshop-post-container" style="margin:30px 0 0;">
        
            <div class="pm-workshop-post-title-container">
                <p class="pm-workshop-post-title"><?php esc_attr_e($pm_workshop_related_course_title_meta); ?></p>
                <p class="pm-workshop-post-subtitle"><?php esc_attr_e($pm_workshop_short_description_meta); ?></p>
            </div>
            <div class="pm-workshop-post-date-container">
                <div class="pm-workshop-post-icon">
                    <i class="<?php esc_attr_e($pm_workshop_icon_meta); ?>"></i>
                </div>
                <p class="pm-title"><?php esc_attr_e($postTitle); ?></p>
                <p class="pm-date"><?php esc_attr_e($w_month); ?> <?php esc_attr_e($w_day); ?> <?php esc_attr_e($w_year); ?> | <?php esc_attr_e($pm_workshop_start_time_meta); ?></p>
            </div>
            <div class="pm-workshop-shortcode-link"><a href="<?php echo get_permalink($postID) ?>" class="pm-workshop-post-button-container"><?php esc_attr_e('View full details', 'quantumtheme'); ?><i class="fa fa-angle-right"></i></a></div>
        </div>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_workshop_post",
    "name"      => __("Workshop Post", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Post ID", 'quantumtheme'),
            "param_name" => "post_id",
            "description" => __("Enter the post ID number of the workshop post you wish to display.", 'quantumtheme'),
			"value" => ''
        ),		

    )

));