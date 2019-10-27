<?php get_header(); ?>

<div class="container pm-containerPadding80">
    <div class="row">
		
        <div class="col-lg-12"> 
        
        	<p class="pm-404-error pm-secondary"><?php esc_attr_e("The page you we're looking could not be found.", 'quantumtheme'); ?></p>
            <p><?php esc_attr_e("Check the URL entered and ensure it is correct.", 'quantumtheme'); ?></p>
            
            <div class="pm-rounded-btn">
                <a href="<?php echo site_url(); ?>"><?php esc_attr_e("Return home", 'quantumtheme'); ?></a>
            </div>
            
		</div>
        
	</div>
</div>

<?php get_footer(); ?>