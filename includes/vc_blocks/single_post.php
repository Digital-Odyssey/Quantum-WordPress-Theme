<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_single_post extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'id' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Method to retrieve a single post
		$queried_post = get_post($id);
		$postID = $queried_post->ID;
		$postLink = $queried_post->guid;
		$postTitle = $queried_post->post_title;
		$postTitleFinal = pm_ln_string_limit_words($postTitle, 4);
		//$postTags = get_the_tags($postID);
		$postExcerpt = $queried_post->post_excerpt;
		$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 5);
		$shortExcerpt2 = pm_ln_string_limit_words($postExcerpt, 15);
		$postContent = $queried_post->post_content;
		//$postImage = get_the_post_thumbnail($postID, 'thumbnail');
		$postImage = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full' );
		$pm_featured_post_image_meta = get_post_meta($postID, 'pm_featured_post_image_meta', true);
		$count = get_comments_number($postID);
		$postDate = $queried_post->post_date;
		$month = date("M", strtotime($postDate));
		$day = date("d", strtotime($postDate));
		//$commentsLink = get_comments_link($postID);
		//$postImage = get_post_meta($postID, 'featuredPostImage', true);
		
		$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="pm-presentation-post-container">
              <div class="pm-presentation-post-date">
                <div class="pm-presentation-post-date-box">
                    <p class="pm-month"><?php esc_attr_e($month); ?></p>
                    <p class="pm-day"><?php esc_attr_e($day); ?></p>
                </div>
                <?php if($displayCommentsCount === 'on') : ?>
                    <div class="pm-presentation-post-comment-count shortcode"><p><?php esc_attr_e($count); ?></p></div>
                <?php endif; ?>
              </div>
              <div class="pm-presentation-post-title">
                <p><?php esc_attr_e($postTitleFinal); ?></p>
              </div>
              <div class="pm-presentation-post-excerpt">
                <p><?php esc_attr_e($shortExcerpt); ?></p>
              </div>
              <div class="pm-presentation-post-hover-container">
                <p class="pm-presentation-post-hover-excerpt"><?php esc_attr_e($shortExcerpt2) ?> <a href="<?php echo esc_url($postLink); ?>">[...]</a></p>
                <a href="<?php echo get_permalink($postID); ?>"><?php esc_attr_e('Read More', 'quantumtheme'); ?> &raquo;</a>
              </div>
              <div class="pm-presentation-post-img">
                <?php if($pm_featured_post_image_meta !== ''){ ?>
                    <img src="<?php echo esc_url($pm_featured_post_image_meta); ?>" alt="<?php esc_attr_e($postTitle); ?>">
                <?php } else if($postImage !== '') { ?>
                    <img src="<?php echo esc_url($postImage[0]); ?>" alt="<?php esc_attr_e($postTitle); ?>">	
                <?php } else { ?>
                    <!-- no image to display -->	
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

    "base"      => "pm_ln_single_post",
    "name"      => __("News Post", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "textfield",
            "heading" => __("Post ID", 'quantumtheme'),
            "param_name" => "id",
            "description" => __("Enter the ID number of the news post you wish to display.", 'quantumtheme'),
			"value" => ''
        ),		

    )

));