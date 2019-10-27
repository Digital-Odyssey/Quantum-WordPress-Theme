<?php 

if ( has_post_thumbnail() ) {
   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
}

$pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);

$postExcerpt = get_the_excerpt();

$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');

?>

<li>
  <div class="pm-presentation-post-container">
      
      <div class="pm-presentation-post-date">
      
        <div class="pm-presentation-post-date-box">
            <p class="pm-month"><?php the_time( 'M' ); ?> </p>
            <p class="pm-day"><?php the_time( 'd' ); ?></p>
        </div>
        
        <?php if($displayCommentsCount === 'on') : ?>
        
        	<div class="pm-presentation-post-comment-count">
                <p><?php echo get_comments_number(); ?></p>
            </div>
        
        <?php endif; ?> 
        
      </div><!-- /pm-presentation-post-date -->
      
      <div class="pm-presentation-post-title">
        <p>
			<?php 
                $title = get_the_title(); 
                echo pm_ln_string_limit_words($title, 4) 
            ?>...
        </p>
      </div>
      
      <div class="pm-presentation-post-excerpt">
        <p><?php echo pm_ln_string_limit_words($postExcerpt, 5) ?>...</p>
      </div>
      
      <div class="pm-presentation-post-hover-container">
        <!--<p class="pm-presentation-post-hover-title">protected posts</p>-->
        <p class="pm-presentation-post-hover-excerpt"><?php echo pm_ln_string_limit_words($postExcerpt, 20) ?> <a href="<?php the_permalink(); ?>">[...]</a>
</p>
        <a href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More', 'quantumtheme') ?> &raquo;</a>
      </div>
      
      <div class="pm-presentation-post-img">
      	<?php if($pm_featured_post_image_meta !== '') { ?>
        		<img src="<?php echo esc_html($pm_featured_post_image_meta); ?>" alt="<?php the_title(); ?>" class="lazyOwl" data-src="<?php echo esc_html($pm_featured_post_image_meta); ?>"> 
        <?php } else if(has_post_thumbnail()) { ?>
        		<img src="<?php echo esc_html($image_url[0]); ?>" alt="<?php the_title(); ?>" class="lazyOwl" data-src="<?php echo esc_html($image_url[0]); ?>"> 
        <?php } else { ?>
        		<!-- No image to display -->
        <?php } ?>
        
      </div>
  </div><!-- /pm-presentation-post-container -->
</li>