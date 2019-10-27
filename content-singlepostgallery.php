<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 
	 $pm_gallery_image_meta = get_post_meta(get_the_ID(), 'pm_gallery_image_meta', true);

		              
?>

	
<?php if($pm_gallery_image_meta !== '') { ?>
		<div class="pm-single-blog-post-img-container" style="background-image:url(<?php echo esc_html($pm_gallery_image_meta); ?>); height:400px;">
			 <div class="pm-single-blog-post-date">
				<p class="pm-month"><?php the_time( 'M' ); ?></p>
				<p class="pm-day"><?php the_time( 'd' ); ?></p>
			 </div>
			 <div class="pm-single-blog-post-title">
				<p class="pm-post-title"><?php the_title(); ?></p>
			 </div>
		</div>
<?php } ?>
					
	

<?php the_content(); ?>

<?php 

$pag_defaults = array(
		'before'           => '<p>' . esc_attr__( 'READ MORE:', 'quantumtheme' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => '',
		'previouspagelink' => '',
		'pagelink'         => '%',
		'echo'             => 1
	);

wp_link_pages($pag_defaults); 

?>

<!-- Cats and Tags -->
<div class="pm-single-blog-post-categories-container">

	<?php 
	
		$cats = wp_get_post_terms($post->ID,'gallerycats'); 
		$tags = wp_get_post_terms($post->ID,'gallerytags'); 
	
	?>

	<?php $catsLen = count($cats); ?>
    
    <?php if($catsLen > 0) { ?>
    
    	<ul class="pm-single-blog-post-categories">
        
            <li class="icon"><i class="fa fa-folder-open"></i><?php //esc_attr_e('Posted in:','quantumtheme'); ?></li>
            
            <?php 
        
                $catCounter = 0;
        
                foreach($cats as $cat){ 
                
                    $catCounter++;
                
                    $term_link = get_term_link( $cat );
                    
                    if($catsLen > 1){
                        
                        if($catCounter >= $catsLen){
                            echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>'; 
                        } else {
                            echo '<li><a href="' . $term_link . '">' . $cat->name . '</a>,</li>'; 
                        }
                        
                    } else {
                        echo '<li><a href="' . $term_link . '">' . $cat->name . '</a></li>';	
                    }
                    
                    
                }
            
            ?>
            
        </ul>
    
    <?php } ?>
	
			
		
	<?php $tagsLen = count($tags); ?>
    
    <?php if($tagsLen > 0) { ?>
    
    	<ul class="pm-single-blog-post-tags">
            <li class="icon"><i class="fa fa-tags"></i><?php //esc_attr_e('Tagged in:','quantumtheme'); ?></li>
            
            <?php 
			
				$tagCounter = 0;
		
				foreach($tags as $tag){ 
				
					$tagCounter++;
				
					$term_link = get_term_link( $tag );
					if($tagsLen > 1){
						
						if($tagCounter >= $tagsLen){
							echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>'; 
						} else {
							echo '<li><a href="' . $term_link . '">' . $tag->name . '</a>,</li>'; 
						}
						
					} else {
						echo '<li><a href="' . $term_link . '">' . $tag->name . '</a></li>';	
					}
					
				}
			
			?>
            
        </ul>
    
    <?php } ?>

</div>
<!-- Cats and Tags end -->