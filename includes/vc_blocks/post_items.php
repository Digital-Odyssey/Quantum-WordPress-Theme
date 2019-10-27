<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_post_items extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"num_of_posts" => '3',
			"post_order" => 'DESC',
			"display_comments_count" => 'yes'
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
		//Fetch data
		$arguments = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			//'posts_per_page' => -1,
			'order' => (string) trim($post_order),
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1
			//'tag' => get_query_var('tag')
		);
	
		$post_query = new WP_Query($arguments);
	

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="row">
		
            <div<?php echo ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : ''); ?>>
            
                <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>
                      
                    <?php    
						if ( has_post_thumbnail()) {
						  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						}
						$pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
						
						$postExcerpt = get_the_excerpt();
					?>
                    
                    <?php if($num_of_posts == "1"){ ?>
                        <div class="col-lg-12 pm-column-spacing">
                    <?php } elseif($num_of_posts == "2") { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">
                    <?php } elseif($num_of_posts == "3") { ?>
                        <div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">
                    <?php } else { ?>
                        <div class="pm-postItem-carousel-item">	
                    <?php } ?>
                        <div class="pm-presentation-post-container carousel">
                          <div class="pm-presentation-post-date carousel">
                            <div class="pm-presentation-post-date-box carousel">
                                <p class="pm-month"><?php echo get_the_time( 'M' ); ?></p>
                                <p class="pm-day"><?php echo get_the_time( 'd' ); ?></p>
                            </div>
                            
                            <?php if($display_comments_count === 'yes') : ?>
                            
                                <div class="pm-presentation-post-comment-count carousel">
                                    <p><?php echo get_comments_number(); ?></p>
                                </div>
                            
                            <?php endif; ?>
                            
                          </div>
                          <div class="pm-presentation-post-title carousel">
                            <p>
                                <?php $title = get_the_title(); ?>
                                <?php  echo pm_ln_string_limit_words($title, 4); ?> 
                            </p>
                          </div>
                          <div class="pm-presentation-post-excerpt carousel">
                            <p><?php echo pm_ln_string_limit_words($postExcerpt, 5); ?>...</p>
                          </div>
                          <div class="pm-presentation-post-hover-container carousel">
                            <p class="pm-presentation-post-hover-excerpt carousel"><?php echo pm_ln_string_limit_words($postExcerpt, 20); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
                            <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'quantumtheme'); ?> &raquo;</a>
                          </div>
                          <div class="pm-presentation-post-img carousel">
                            <?php if($pm_featured_post_image_meta !== '') { ?>
                                    <img src="<?php echo esc_url($pm_featured_post_image_meta); ?>" alt="<?php the_title(); ?>" class="lazyOwl" data-src="<?php echo esc_url($pm_featured_post_image_meta); ?>"> 
                            <?php } else if(has_post_thumbnail()) { ?>
                                    <img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title(); ?>" class="lazyOwl" data-src="<?php echo esc_url($image_url[0]); ?>"> 
                            <?php } else { ?>
                                    
                            <?php } ?>
                            </div>
                          </div>
                      </div>
                                
                <?php endwhile; else: ?>
                    <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_attr_e('No posts were found.', 'quantumtheme'); ?></p>
                    </div>
                <?php endif; ?>
            
            </div>
        </div>
        
        <!-- Element Code / END -->
        
        <?php wp_reset_postdata(); ?>

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_post_items",
    "name"      => __("News Posts", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(

		array(
            "type" => "dropdown",
            "heading" => __("Amount of News Posts to display:", 'quantumtheme'),
            "param_name" => "num_of_posts",
            "description" => __("Choose how many news posts you would like to display.", 'quantumtheme'),
			"value"      => array( '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10' ), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Post Order", 'quantumtheme'),
            "param_name" => "post_order",
            "description" => __("Set the order in which news posts will be displayed.", 'quantumtheme'),
			"value"      => array( 'DESC' => 'DESC', 'ASC' => 'ASC'), //Add default value in $atts
        ),
		
		array(
            "type" => "dropdown",
            "heading" => __("Display comments count?", 'quantumtheme'),
            "param_name" => "display_comments_count",
            //"description" => __("Set the order in which news posts will be displayed.", 'quantumtheme'),
			"value"      => array( 'yes' => 'yes', 'no' => 'no'), //Add default value in $atts
        ),

    )

));