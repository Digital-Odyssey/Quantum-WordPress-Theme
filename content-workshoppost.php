<?php
/**
 * The default template for displaying a single workshop post.
 */
?>

<?php 

	 $pm_workshop_related_course_title_meta = get_post_meta(get_the_ID(),'pm_workshop_related_course_title_meta', true );
	 $pm_workshop_short_description_meta = get_post_meta(get_the_ID(),'pm_workshop_short_description_meta', true );
	 $pm_workshop_name_meta = get_post_meta(get_the_ID(),'pm_workshop_name_meta', true );
	 $pm_workshop_date_meta = get_post_meta(get_the_ID(),'pm_workshop_date_meta', true ); 
	 $month = date("M", strtotime($pm_workshop_date_meta));
	 $day = date("d", strtotime($pm_workshop_date_meta));
	 $year = date("Y", strtotime($pm_workshop_date_meta));
	 $pm_workshop_start_time_meta = get_post_meta(get_the_ID(),'pm_workshop_start_time_meta', true );
	 $pm_workshop_icon_meta = get_post_meta(get_the_ID(),'pm_workshop_icon_meta', true );
	              
?>

<!-- Workshop post -->
<div class="col-lg-6 col-md-6 col-sm-6 pm-containerPadding30">
    <div class="pm-workshop-post-container">
        
        <div class="pm-workshop-post-title-container">
            <p class="pm-workshop-post-title"><?php echo esc_attr($pm_workshop_related_course_title_meta); ?></p>
            <p class="pm-workshop-post-subtitle"><?php echo esc_attr($pm_workshop_short_description_meta); ?></p>
        </div>
        
        <div class="pm-workshop-post-date-container">
            <div class="pm-workshop-post-icon">
                <i class="<?php echo $pm_workshop_icon_meta; ?>"></i>
            </div>
            <p class="pm-title"><?php echo esc_attr($pm_workshop_name_meta); ?></p>
            <p class="pm-date"><?php echo esc_attr($month); ?> <?php echo esc_attr($day); ?> <?php echo esc_attr($year); ?> | <?php echo esc_attr($pm_workshop_start_time_meta); ?></p>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="pm-workshop-post-button-container">
            <p><?php esc_attr_e('View full details', 'quantumtheme'); ?></p>
            <i class="fa fa-angle-right"></i>
        </a>
        
    </div>
</div>
<!-- /Workshop post -->