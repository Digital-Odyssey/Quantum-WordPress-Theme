<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $category = get_the_category(); 
	 $count = get_comments_number();
	 
	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 $pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
	 
	 $displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');
	              
?>

<article>
    <div class="pm-blog-post-container">
        
        <?php if($pm_featured_post_image_meta !== '') { ?>
                <div class="pm-blog-post-img-container" style="background-image:url(<?php echo esc_html($pm_featured_post_image_meta); ?>);">
                
                	<div class="pm-blog-post-date">
                        <p class="pm-month"><?php the_time( 'M' ); ?></p>
                        <p class="pm-day"><?php the_time( 'd' ); ?></p>
                        
                        <?php if($displayCommentsCount === 'on') : ?>
                        
                        	<div class="pm-blog-post-comment-count">
                                <p><?php  echo get_comments_number(); ?></p>
                            </div>
                        
                        <?php endif; ?>
                                                
                    </div>
                    <div class="pm-blog-post-title">
                        <h2 class="pm-post-title"><?php the_title(); ?></h2>
                        <p class="pm-post-hover-excerpt"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'quantumtheme'); ?> &rarr;</a>
                    </div>
                    
                </div>
                
        <?php } else if(has_post_thumbnail()) { ?>
                <div class="pm-blog-post-img-container" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
                
                <div class="pm-blog-post-date">
                        <p class="pm-month"><?php the_time( 'M' ); ?></p>
                        <p class="pm-day"><?php the_time( 'd' ); ?></p>
                        
                        <div class="pm-blog-post-comment-count">
                            <p><?php  echo get_comments_number();  ?></p>
                        </div>
                        
                    </div>
                    <div class="pm-blog-post-title">
                        <h2 class="pm-post-title"><?php the_title(); ?></h2>
                        <p class="pm-post-hover-excerpt"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'quantumtheme'); ?> &rarr;</a>
                    </div>
                    
                </div>
                
        <?php } else { ?>
        		<!-- No featured image to display -->
        <?php }  ?>
                    
        <div class="pm-blog-post-details-container">
        
        	<?php if($pm_featured_post_image_meta == '' && !has_post_thumbnail()) { ?>
            		<p class="pm-blog-post-published pm-primary" style="font-size:24px;">
                    	<?php the_title(); ?>
                    </p>
            <?php } ?>
            
            <div class="pm-blog-post-divider"></div>
        
            <p class="pm-blog-post-published"><?php esc_attr_e('Posted by', 'quantumtheme'); ?> <?php the_author(); ?> on <?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?>, <?php the_time( 'Y' ); ?> <?php esc_attr_e('in', 'quantumtheme'); ?> <?php echo $category[0]->cat_name; ?> | <?php echo get_comments_number();  ?>
            
			<?php 
				if($count > 1 || $count == 0){
					esc_attr_e('comments', 'quantumtheme');	
				} else {
					esc_attr_e('comment', 'quantumtheme');	
				}
			 
			?>
            </p>
            
            <div class="pm-blog-post-divider"></div>
            
            <p><?php the_excerpt(); ?></p>
            
            <div class="pm-blog-post-divider"></div>
            
            <div class="pm-rounded-btn pm-blog-post-btn">
                <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'quantumtheme'); ?></a>
            </div>
        
        </div>
        
    </div>
</article>