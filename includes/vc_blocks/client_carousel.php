<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_pm_ln_client_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

        extract(shortcode_atts(array(
			"el_target" => '_self',
        ), $atts));


        /* ================  Render Shortcodes ================ */

        ob_start();

		//Redux options
		global $quantum_options;

        ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <ul class="pm-partners-carousel-posts" id="pm-partners-carousel-owl">
        
        	<?php 
			
				if($quantum_options){
		
					$clients = $quantum_options['opt-client-slides'];
					
					if(count($clients) > 0){
						
						foreach($clients as $c) {
							
							echo '<li>';
								echo '<div class="pm-parnters-post-container">';
									if($c['url'] !== '') {
										echo '<div class="pm-parnters-post-url">';
											echo '<a href="http://'.$c['url'].'" target="'.$el_target.'">'.$c['url'].'</a>';
										echo '</div>';
									}						
									if($c['description'] !== '') {
										echo '<div class="pm-parnters-post-featured">'.$c['description'].'</div>';	
									}
									echo '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
								echo '</div>';
							echo '</li>';
							
						}//end of foreach
						
					}//end of if
					
				}//end of if
			
			?>
        
        </ul>
        
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "pm_ln_client_carousel",
    "name"      => __("Client Carousel", 'quantumtheme'),
    "class"     => "",
    "icon"      => "icon-wpb-de_service",
    "category"  => __("Quantum Shortcodes", 'quantumtheme'),
    "params"    => array(
	
		array(
            "type" => "dropdown",
            "heading" => __("Target Window", 'quantumtheme'),
            "param_name" => "el_target",
            "description" => __("Set the target window for the client link.", 'quantumtheme'),
			"value"      => array( '_self' => '_self', '_blank' => '_blank' ), //Add default value in $atts
        ),

    )

));