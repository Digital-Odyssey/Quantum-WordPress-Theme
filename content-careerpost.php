<?php
/**
 * The default template for displaying a single workshop post.
 */
?>

<?php 

	 $pm_careers_position_meta = get_post_meta(get_the_ID(),'pm_careers_position_meta', true );
	 $pm_careers_department_meta = get_post_meta(get_the_ID(),'pm_careers_department_meta', true );
	 $pm_careers_opening_type_meta = get_post_meta(get_the_ID(),'pm_careers_opening_type_meta', true );
	 $pm_careers_location_meta = get_post_meta(get_the_ID(),'pm_careers_location_meta', true ); 
	 $pm_careers_icon_meta = get_post_meta(get_the_ID(),'pm_careers_icon_meta', true );
	 
	 
	 //$month = date("M", strtotime($pm_workshop_date_meta));
	 //$day = date("d", strtotime($pm_workshop_date_meta));
	 //$year = date("Y", strtotime($pm_workshop_date_meta));
	 
	              
?>

<div class="col-lg-4 col-md-6 col-sm-6">
                	
    <!-- Career post -->
    <div class="pm-career-post-container">
        
        <div class="pm-career-post-date-posted-box">
            
            <div class="pm-career-post-icon">
                <i class="<?php echo esc_attr($pm_careers_icon_meta); ?>"></i>
            </div>
            
            <p class="posted"><?php esc_attr_e('Posted','quantumtheme'); ?></p>
            <p class="date"><?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?></p>
            <p class="year"><?php the_time( 'Y' ); ?></p>
            
        </div>
        
        <div class="pm-career-post-details-box">
            
            <p class="title"><?php esc_attr_e('Position','quantumtheme'); ?></p>
            <p><?php echo esc_attr($pm_careers_position_meta); ?></p>
            
            <p class="title"><?php esc_attr_e('Department','quantumtheme'); ?></p>
            <p><?php echo esc_attr($pm_careers_department_meta); ?></p>
            
            <p class="title"><?php esc_attr_e('Opening Type','quantumtheme'); ?></p>
            <p><?php echo esc_attr($pm_careers_opening_type_meta); ?></p>
            
            <p class="title"><?php esc_attr_e('Location','quantumtheme'); ?></p>
            <p><?php echo esc_attr($pm_careers_location_meta); ?></p>
            
            <div class="pm-rounded-btn">
                <a href="<?php the_permalink(); ?>"><?php esc_attr_e('View full details','quantumtheme'); ?></a>
            </div>
            
        </div>
        
    </div>
    <!-- Career post end -->
    
</div>