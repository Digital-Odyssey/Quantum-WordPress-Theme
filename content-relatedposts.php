<?php
	//The default template for retrieving related blog post(s)
?>
<div class="pm-single-blog-post-related-posts">

	
        <?php  
            $tags = wp_get_post_tags(get_the_ID());  
			
			//print_r($tags);
              
            if ($tags) {  
			            
                $tag_ids = array();  
            
                foreach($tags as $individual_tag) {
                    $tag_ids[] = $individual_tag->term_id; 
                }
             
                $args = array(  
                    'tag__in' => $tag_ids,  
                    'post__not_in' => array(get_the_ID()),  
                    'posts_per_page' => 4, // Number of related posts to display.  
                    'ignore_sticky_posts' => 1  
                );  
              
                $my_query = new wp_query( $args );  
				
				if($my_query->have_posts()){
					echo '<h3>'.esc_attr__('Related Posts', 'quantumtheme').'</h3>';	
				}
				
				echo '<ul class="pm-related-blog-posts">';
          
					while( $my_query->have_posts() ) {  
						$my_query->the_post();  
						
						if ( has_post_thumbnail() ) {
						   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'small');
						}
						$pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
						
					?>  
                         <li>
                         	<?php if($pm_featured_post_image_meta !== '') { ?>
                                    <div class="pm-recent-blog-post-thumb" style="background-image:url(<?php echo esc_html($pm_featured_post_image_meta); ?>);"></div>
                            <?php } else if(has_post_thumbnail()) { ?>
                                    <div class="pm-recent-blog-post-thumb" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);"></div>
                            <?php } else { ?>
                           			<!-- no thumb to display -->
                            <?php } ?>
                            
                            <div class="pm-recent-blog-post-details">
                                <a href="<?php the_permalink()?>"><?php the_title(); ?></a>
                                <p class="pm-date-published"><?php the_time( 'M' ); ?> <?php the_time( 'd' ); ?> <?php the_time( 'Y' ); ?> <?php esc_attr_e('by', 'quantumtheme'); ?> <?php the_author(); ?></p>
                            </div>
                        </li>
				  
					<?php } 
				
				echo '</ul>'; 
            }  
            wp_reset_query();  
        ?>

</div>