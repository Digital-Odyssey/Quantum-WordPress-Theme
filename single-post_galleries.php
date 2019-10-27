<?php get_header(); ?>
<?php 
	$getPostLayout = get_post_meta(get_the_ID(), 'pm_post_layout_meta', true);
	$postLayout = $getPostLayout !== '' ? $getPostLayout : 'no-sidebar';
	 $postStatus = get_post_meta(get_the_ID(), 'pm_post_visibility', true);
?>

<div class="container pm-containerPadding60 pm-single-post-container" style="padding-bottom:90px;">
      <div class="row">
      
      	 <?php if($postLayout === 'no-sidebar') { //Render col-lg-12 ?>
         	<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', 'singlepostgallery' ); ?>
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No post was found.', 'quantumtheme'); ?></p>
                <?php endif; ?> 
                <?php if($postStatus === 'public') { ?>
                	<?php comments_template( '', true ); ?>
                <?php } ?>
            </div>
            
         <?php } elseif($postLayout === 'left-sidebar') { //Render col-lg-12 ?>
         	<?php get_sidebar(); ?>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', 'singlepostgallery' ); ?>
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No post was found.', 'quantumtheme'); ?></p>
                <?php endif; ?> 
                <?php if($postStatus === 'public') { ?>
                	<?php comments_template( '', true ); ?>
                <?php } ?>
                
            </div>
         
         <?php } elseif($postLayout === 'right-sidebar') { //Render col-lg-12 ?>
         	<div class="col-lg-8 col-md-8 col-sm-8">
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', 'singlepostgallery' ); ?>
                <?php endwhile; else: ?>
                     <p><?php esc_attr_e('No post was found.', 'quantumtheme'); ?></p>
                <?php endif; ?> 
                <?php if($postStatus === 'public') { ?>
                	<?php comments_template( '', true ); ?>
                <?php } ?>
            </div>
            <?php get_sidebar(); ?>
         <?php } else { ?>
      			<div class="col-lg-12 col-md-12 col-sm-12 pm-main-posts">
					<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <?php get_template_part( 'content', 'singlepostgallery' ); ?>
                    <?php endwhile; else: ?>
                         <p><?php esc_attr_e('No post was found.', 'quantumtheme'); ?></p>
                    <?php endif; ?> 
                    <?php if($postStatus === 'public') { ?>
						<?php comments_template( '', true ); ?>
                    <?php } ?>
                </div>
      	 <?php } ?>
      
      </div>
</div>


<?php get_footer(); ?>