<?php get_header(); ?>


<div class="container pm-containerPadding60">
    <div class="row">
        
        <div class="col-lg-12">
            
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
				<?php the_content(); ?>
                                   
            <?php endwhile; else: ?>
                <p><?php echo esc_attr_e('No content was found.', 'quantumtheme'); ?></p>
            <?php endif; ?>
            
        </div>
        
        
    </div>
</div>

<?php get_footer(); ?>