<?php
/**
 * The default template for displaying staff posts on the staff template.
 */
?>

<?php 
            
	$pm_staff_image_meta = get_post_meta(get_the_ID(), 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta(get_the_ID(), 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta(get_the_ID(), 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta(get_the_ID(), 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta(get_the_ID(), 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta(get_the_ID(), 'pm_staff_linkedin_meta', true);

	
?>

<?php 
$terms = get_the_terms($post->ID, 'staffcats' );
$terms_slug_str = '';
if ($terms && ! is_wp_error($terms)) :
	$term_slugs_arr = array();
	foreach ($terms as $term) {
	    $term_slugs_arr[] = $term->slug;
	}
	$terms_slug_str = join( " ", $term_slugs_arr);
endif;
?>

<!-- gallery item -->
<div class="pm-isotope-item col-lg-4 col-md-4 col-sm-4 col-xs-12 pm-column-spacing <?php echo $terms_slug_str != '' ? $terms_slug_str : ''; ?> all">

    <div class="pm-staff-profile-container">
		<div class="pm-staff-profile-image-wrapper">
			<div class="pm-staff-profile-image">
				<img src="<?php echo esc_html($pm_staff_image_meta); ?>" class="img-responsive" alt="<?php the_title(); ?>">
			</div>
			<ul class="pm-staff-profile-icons">
				<?php if($pm_staff_twitter_meta !== ''){ ?>
					<li><a href="<?php echo $pm_staff_twitter_meta; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if($pm_staff_facebook_meta !== ''){ ?>
					<li><a href="<?php echo $pm_staff_facebook_meta; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if($pm_staff_gplus_meta !== ''){ ?>
					<li><a href="<?php echo $pm_staff_gplus_meta; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if($pm_staff_linkedin_meta !== ''){ ?>
					<li><a href="<?php echo $pm_staff_linkedin_meta; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php }	?>		
			</ul>
		</div>
		<div class="pm-staff-profile-details">
			<a href="<?php the_permalink(); ?>"><p class="pm-staff-profile-name"><?php the_title(); ?></p></a>
			<p class="pm-staff-profile-title"><?php echo $pm_staff_title_meta; ?></p>
            
            <?php  
			
				$excerpt = get_the_excerpt(); 
			
			?>
            
			<p class="pm-staff-profile-bio"><?php echo pm_ln_string_limit_words($excerpt, 30); ?> <a href="<?php the_permalink(); ?>">[...]</a></p>
		</div>
	</div>
    
</div><!-- /.col-lg-4 -->
<!-- /gallery item -->