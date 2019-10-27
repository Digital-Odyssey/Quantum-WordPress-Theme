<?php get_header(); ?>

<?php 

	 $pm_careers_position_meta = get_post_meta(get_the_ID(),'pm_careers_position_meta', true );
	 $pm_careers_department_meta = get_post_meta(get_the_ID(),'pm_careers_department_meta', true );
	 $pm_careers_opening_type_meta = get_post_meta(get_the_ID(),'pm_careers_opening_type_meta', true );
	 $pm_careers_location_meta = get_post_meta(get_the_ID(),'pm_careers_location_meta', true ); 
	 $pm_careers_icon_meta = get_post_meta(get_the_ID(),'pm_careers_icon_meta', true );
	              
?>

<div class="container pm-containerPadding60">
    <div class="row">
        
        <div class="col-lg-12">
            
            <div class="pm-single-career-post-date-posted-box">
                    
                <div class="pm-single-career-post-icon">
                    <i class="<?php echo esc_attr($pm_careers_icon_meta); ?>"></i>
                </div>
                
                <p class="posted"><?php esc_attr_e('Posted', 'quantumtheme') ?></p>
                <p class="date"><?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?></p>
                <p class="year"><?php the_time( 'Y' ); ?></p>
                
            </div>
            
            <div class="pm-single-career-post-details-box">
            
            	<p class="pm-career-post-title pm-secondary"><?php the_title(); ?></p>
                    
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                    <?php the_content(); ?>
                                       
                <?php endwhile; else: ?>
                    <p><?php echo esc_attr_e('No content was found.', 'quantumtheme'); ?></p>
                <?php endif; ?>
                                        
            </div>
            
        </div>
        
        
    </div>
</div>

<?php get_footer(); ?>