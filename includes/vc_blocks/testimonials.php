<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_testimonials extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			'default' => '',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		global $quantum_options;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_icon_image, "large"); 
			//$el_icon_image = $img[0];
		?>

        <!-- Element Code start -->
        
        <?php 
		
			if($quantum_options){
		
				$testimonials = $quantum_options['opt-testimonials-slides'];
				
				if(is_array($testimonials)){
					
					$counter = 0;
					
					echo '<ul class="pm-testimonials-carousel" id="pm-testimonials-carousel-owl">';
					
						foreach($testimonials as $t) {
							
							echo '<li>';
								echo '<div class="col-lg-5 col-md-5 col-sm-5 pm-center">';
									echo '<img src="'.$t['image'] .'" class="img-responsive" alt="'.$t['title'] .'"> ';
								echo '</div>';
								echo '<div class="col-lg-7 col-md-7 col-sm-7">';
									echo '<div class="pm-testimonial-container">';
										echo '<div class="pm-testimonial-quote-box">';
											echo '<i class="fa fa-quote-left"></i>';
										echo '</div>';
										echo '<div class="pm-testimonial-text-box">';
											echo '<p>'.$t['description'].'</p>';
											echo '<p class="pm-testimonial-name">'.$t['title'].'</p>';
											echo '<p class="pm-testimonial-title">'.$t['url'].'</p>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</li>';
							
						}//end of foreach
													
					echo '</ul>';
					
				}
				
			}
		
		?>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_testimonials",
    "name"      => __("Testimonials", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		/*array(
            "type" => "textfield",
            "heading" => __("Icon", 'quantumtheme'),
            "param_name" => "icon",
            "description" => __("Upload a custom icon image.", 'quantumtheme')
        ),*/

    )

));