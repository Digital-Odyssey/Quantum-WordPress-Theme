<?php /* Template Name: Forgot Password Template */ ?>
<?php get_header(); ?>

<?php 
	global $quantum_options;
	$forgotPasswordMessage = $quantum_options['forgot-password-message'];
	$registerMessage = $quantum_options['global-register-message'];
?>


<div class="container pm-containerPadding-top-60 pm-containerPadding-bottom-80">
    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-6 pm-column-spacing">
            <?php 
			
				$allowed_html = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
					'p' => array(),
					'span' => array(),
					'h6' => array(),
				);
				
				
				echo wp_kses($forgotPasswordMessage, $allowed_html); 
			
			?>
            
            <?php get_template_part('content', 'forgotpassword'); ?>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 pm-column-spacing">
            <?php 
				echo wp_kses($registerMessage, $allowed_html); 
			?>
        </div>
        
    </div>
</div>


<?php get_footer(); ?>