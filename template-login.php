<?php /* Template Name: Members Login Template */ ?>
<?php get_header(); ?>

<?php 
	global $quantum_options;
	$registerMessage = $quantum_options['global-register-message'];
?>


<div class="container pm-containerPadding60">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
                    
            <?php get_template_part('content', 'loginform'); ?>
        
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
                    
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
			
				echo wp_kses($registerMessage, $allowed_html); 
			
			?>
        
        </div>
    </div>
</div>


<?php get_footer(); ?>