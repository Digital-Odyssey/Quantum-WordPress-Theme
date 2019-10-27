<?php get_header(); ?>

<?php 

	 $pm_workshop_name_meta = get_post_meta(get_the_ID(),'pm_workshop_name_meta', true );
	 $pm_workshop_date_meta = get_post_meta(get_the_ID(),'pm_workshop_date_meta', true ); 
	 $month = date("M", strtotime($pm_workshop_date_meta));
	 $day = date("d", strtotime($pm_workshop_date_meta));
	 $year = date("Y", strtotime($pm_workshop_date_meta));
	 $pm_workshop_start_time_meta = get_post_meta(get_the_ID(),'pm_workshop_start_time_meta', true );
	 $pm_workshop_icon_meta = get_post_meta(get_the_ID(),'pm_workshop_icon_meta', true );
	              
?>

<div class="container pm-containerPadding60">
    <div class="row">
        
        <div class="col-lg-12">
            
            <div class="pm-single-workshop-post-left-column">
                <i class="<?php echo esc_attr($pm_workshop_icon_meta); ?>"></i>
             </div>
            
             <div class="pm-single-workshop-post-right-column">
                
                <p class="pm-single-workshop-title"><?php the_title(); ?></p>
                <p class="pm-single-workshop-date"><?php echo esc_attr($month); ?> <?php echo esc_attr($day); ?> <?php echo esc_attr($year); ?> &bull; <?php echo esc_attr($pm_workshop_start_time_meta); ?></p>
                
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