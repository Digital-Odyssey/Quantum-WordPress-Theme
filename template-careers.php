<?php /* Template Name: Careers Template */ ?>
<?php get_header(); ?>

<?php
	//global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$arguments = array(
		'post_type' => 'post_careers',
		'post_status' => 'publish',
		'paged' => $paged,
		'posts_per_page' => 6,
		'order' => 'ASC'
		//'tag' => get_query_var('tag')
	);

	$query = new WP_Query($arguments);

	pm_ln_set_query($query);
?>

<div class="container pm-containerPadding60" role="pm-careers-container">
    <div class="row">

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        		
			<?php get_template_part( 'content', 'careerpost' ); ?>
        
        <?php endwhile; else: ?>
             <p><?php esc_attr_e('No posts were found.', 'quantumtheme'); ?></p>
        <?php endif; ?> 
        
        <?php get_template_part( 'content', 'pagination' ); ?>
        
        <?php pm_ln_restore_query(); ?> 
    
	</div> <!-- /row -->
    
</div> <!-- /container -->



<?php get_footer(); ?>