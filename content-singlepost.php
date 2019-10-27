<?php
/**
 * The default template for displaying a single post.
 */
?>

<?php 

	 $enableTooltip = get_theme_mod('enableTooltip', 'on');

	 if ( has_post_thumbnail()) {
	   $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
	 }
	 
	 $pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
	 
	 $postStatus = get_post_meta(get_the_ID(), 'pm_post_visibility', true);
	 
	 global $quantum_options;
	 $registerMessage = $quantum_options['global-register-message'];
	 $privatePostMessage = $quantum_options['private-post-message'];
	 
	 $allowed_html = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'p' => array(),
		'span' => array(),
		'h6' => array(),
		'class' => array(),
	);
	
	$displayAuthorInfo = get_theme_mod('displayAuthorInfo', 'on');
	$displayShareOptions = get_theme_mod('displayShareOptions', 'on');
	$displayRelatedPosts = get_theme_mod('displayRelatedPosts', 'on');
		              
?>

<?php if($postStatus === 'public' || $postStatus == '' || is_user_logged_in()) { ?>
	
	<?php if($pm_featured_post_image_meta !== '') { ?>
    		<div class="pm-single-blog-post-img-container" style="background-image:url(<?php echo esc_html($pm_featured_post_image_meta); ?>);">
                 <div class="pm-single-blog-post-date">
                    <p class="pm-month"><?php the_time( 'M' ); ?></p>
                    <p class="pm-day"><?php the_time( 'd' ); ?></p>
                 </div>
                 <div class="pm-single-blog-post-title">
                    <p class="pm-post-title"><?php the_title(); ?></p>
                 </div>
            </div>
    <?php } else if(has_post_thumbnail()) { ?>
            <div class="pm-single-blog-post-img-container" style="background-image:url(<?php echo esc_html($image_url[0]); ?>);">
            	  <div class="pm-single-blog-post-date">
                    <p class="pm-month"><?php the_time( 'M' ); ?></p>
                    <p class="pm-day"><?php the_time( 'd' ); ?></p>
                 </div>
                 <div class="pm-single-blog-post-title">
                    <p class="pm-post-title"><?php the_title(); ?></p>
                 </div>
            </div>
    <?php } else { ?>
    		<!-- No featured image to display -->
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
    
        <?php if(has_category()) { ?>
                <ul class="pm-single-blog-post-categories">
                    <li class="icon"><i class="fa fa-folder-open"></i><?php //esc_attr_e('Posted in:','quantumtheme'); ?></li>
                    <li><?php the_category(',</li><li>'); ?></li>
                </ul>
            <?php } ?>
        
            <?php if(has_tag()) { ?>
                <ul class="pm-single-blog-post-tags">
                    <li class="icon"><i class="fa fa-tags"></i><?php //esc_attr_e('Tagged in:','quantumtheme'); ?></li>
                    <li><?php the_tags('', ',</li><li>', ''); ?></li>
                </ul>
        <?php } ?>
    
    </div>
    <!-- Cats and Tags end -->
    
    <?php 
    
        //author info
		$display_name = get_the_author_meta('display_name');
        $first_name = get_the_author_meta('first_name');
        $last_name = get_the_author_meta('last_name');
        $description = get_the_author_meta('description');
        
    ?> 
    
    <?php if($displayAuthorInfo === 'on') : ?>
    
    	<!-- Author profile -->      
        <div class="pm-single-blog-post-author-box">
        
            <div class="pm-single-blog-post-author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 62 ); ?>
            </div>
            
            <div class="pm-single-blog-post-author-details">
            
                <?php if($first_name !== '') { ?>
                    <p class="author-name"><span><?php esc_attr_e('Author:', 'quantumtheme'); ?></span> <?php echo esc_attr($first_name); ?>  <?php echo esc_attr($last_name); ?></p>
                <?php } else { ?>
                    <p class="author-name"><span><?php esc_attr_e('Author:', 'quantumtheme'); ?></span> <?php echo esc_attr($display_name); ?> </p>
                <?php } ?>
                            
                <?php if($description == '') { ?>
                    <p><?php esc_attr_e('Biography not available.', 'quantumtheme'); ?></p>
                <?php } else { ?>
                    <p><?php echo esc_attr($description); ?></p>
                <?php } ?>
                
            </div>
                    
        </div>
        <!-- Author profile end -->
    
    <?php endif; ?>
    
    
    <?php if($displayShareOptions === 'on') : ?>
    
    	<!-- Share options -->
        <div class="pm-single-blog-post-author-box-share">
          <p><?php esc_attr_e('Share this post on', 'quantumtheme'); ?></p>
          <ul class="pm-single-blog-post-author-box-share-icons">
              <li title="<?php esc_attr_e('Twitter', 'quantumtheme'); ?>" <?php echo $enableTooltip == 'on' ? 'class="pm_tip_static_top"' : '' ?>><a href="http://twitter.com/home?status=<?php urlencode(the_title()); ?>" target="_blank" class="fa fa-twitter tw"></a></li>
              <li title="<?php esc_attr_e('Facebook', 'quantumtheme'); ?>" <?php echo $enableTooltip == 'on' ? 'class="pm_tip_static_top"' : '' ?>><a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" target="_blank" class="fa fa-facebook fb"></a></li>
              <li title="<?php esc_attr_e('Google Plus', 'quantumtheme'); ?>" <?php echo $enableTooltip == 'on' ? 'class="pm_tip_static_top"' : '' ?>><a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" target="_blank" class="fa fa-google-plus gp"></a></li>
              <?php $postExcerpt = get_the_excerpt(); ?>
              <li title="<?php esc_attr_e('Linkedin', 'quantumtheme'); ?>" <?php echo $enableTooltip == 'on' ? 'class="pm_tip_static_top"' : '' ?>><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(site_url()); ?>&title=<?php urlencode(the_title()); ?>&summary=<?php echo urlencode(pm_ln_string_limit_words($postExcerpt, 30)); ?>&source=<?php echo urlencode(site_url()); ?>" target="_blank" class="fa fa-linkedin lin"></a></li>
          </ul>
        </div>
        <!-- Share options end -->
    
    <?php endif; ?>
    
    <?php if($displayRelatedPosts === 'on') : ?>
    
    	<!-- Related posts -->
		<?php get_template_part('content', 'relatedposts'); ?>
        <!-- Related posts end -->
    
    <?php endif; ?>
    
    

<?php } else if($postStatus === 'members' && !is_user_logged_in() ) { ?>

	<div class="row">
    
    	<div class="col-lg-6 col-md-6 col-sm-6">
        		
			<?php echo  wp_kses($privatePostMessage, $allowed_html); ?>
                        
            <?php
					
				if(isset($_GET['login']) && $_GET['login'] == 'failed'){
					?>
                    	<div role="alert" class="alert alert-notice alert-dismissible">
                          <i class="typcn typcn-pin"></i>
                          <strong><?php esc_attr_e('Login failed:','quantumtheme'); ?></strong> <?php esc_attr_e('You have entered an incorrect Username or Password, please try again.','quantumtheme'); ?> 
                        </div>
					<?php
				}
			
			?>
			
			<?php 
			
				$args = array(
				'echo' => true,
				'redirect' => get_permalink(), 
				'form_id' => 'pm-ota-loginform',
				'label_username' => esc_attr__( 'Username', 'quantumtheme' ),
				'label_password' => esc_attr__( 'Password', 'quantumtheme' ),
				'label_remember' => esc_attr__( 'Remember Me', 'quantumtheme' ),
				'label_log_in' => esc_attr__( 'Log In', 'quantumtheme' ),
				'id_username' => 'user_login',
				'id_password' => 'user_pass',
				'id_remember' => 'rememberme',
				'id_submit' => 'wp-submit',
				'remember' => true,
				'value_username' => NULL,
				'value_remember' => false );
		
				wp_login_form( $args );
				
				echo '<p><a href="'.site_url('forgot-password').'">'.esc_attr__('Lost your Password?', 'quantumtheme').'</a></p> ';
			
			?>
        
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6">
        
        	<?php 
											
				echo  wp_kses($registerMessage, $allowed_html);
			
			?>
            
        </div>
    
    </div>

	

<?php } ?>

