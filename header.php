<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <h1 style="color:grey;">UNSUPPORTED BROWSER. PLEASE UPGRADE YOUR BROWSER TO <a href="http://windows.microsoft.com/en-CA/internet-explorer/downloads/ie-9/worldwide-languages">IE 9 OR HIGHER</a></h1> <![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php $ieCompatibilityMode = get_theme_mod('ieCompatibilityMode', 'off'); ?>
    <?php if($ieCompatibilityMode === 'on') { ?>
    	<meta http-equiv="X-UA-Compatible" content="IE=9" />
    <?php } ?>
    <meta name="format-detection" content="telephone=no">
    
	<!-- Atoms & Pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
                        
    <?php wp_head(); ?>
</head>

<?php 

	//Redux options
	global $quantum_options;

	//Color sampler
	$colorSampler = get_theme_mod('colorSampler', 'on');
	
	//Layout Options
	$enableBoxMode = get_theme_mod('enableBoxMode', 'off');
	$enablePostSlider = get_theme_mod('enablePostSlider', 'yes');
	$customSlider = $quantum_options['opt-custom-slider'];
	
	//Header options
	$enableLanguageSelector = get_theme_mod('enableLanguageSelector', 'off');
	
	$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
	$woocommLayout = 'woocomm-' . $woocommShopLayout;

?>
<body <?php body_class($woocommLayout); ?>>

<?php if($colorSampler === 'on') { ?>

	<?php get_template_part('content', 'themesampler'); ?>

<?php } ?>

<!-- Search form overlay -->
<?php get_template_part('content', 'searchform'); ?>
<!-- Search form overlay end -->

<?php 
	$businessPhone = get_theme_mod('businessPhone', 'General Inquiries <span>1-888-555-5555</span>');
	$supportPhone = get_theme_mod('supportPhone', 'Support <span>1-888-555-5555</span>');
	$enableRegistration = get_theme_mod('enableRegistration', 'on');
	$enableLogin = get_theme_mod('enableLogin', 'on');
	$enableSearch = get_theme_mod('enableSearch', 'on');
	$enableCTA = get_theme_mod('enableCTA', 'on');
	$ctaText = get_theme_mod('ctaText', 'Get Started Today');
	
	$registerButtonText = get_theme_mod('registerButtonText', esc_attr__('Register', 'quantumtheme'));
	$registerLink = get_theme_mod('registerLink', '#');
	$loginButtonText = get_theme_mod('loginButtonText', esc_attr__('Login', 'quantumtheme'));
	$loginLink = get_theme_mod('loginLink', '#');
?>

<?php if($enableBoxMode === 'on') { ?>
     <div class="pm-boxed-mode" id="pm_layout_wrapper">
<?php } else { ?>
     <div class="pm-full-mode" id="pm_layout_wrapper">
<?php }?>

	<?php 
		$enableQuickLogin = get_theme_mod('enableQuickLogin', 'yes'); 		
		$quickLoginText = $quantum_options['header-panel-text'];
		$activatorIcon = get_theme_mod('activatorIcon', 'typcn typcn-th-large-outline'); 
	?>
    
    <?php if($enableQuickLogin === 'yes') : ?>
    
    	<div class="pm-quick-login-container">
            <div class="container">
                <div class="row">
                
                    <div class="pm-quick-login-container-spacing">
                    
                        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        
                        	<?php 
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
							);
							
							
							echo wp_kses($quickLoginText, $allowed_html);
							?>
                        
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                            <?php pm_ln_quick_login_form(); ?>
                        </div>
                    
                    </div>            
                    
                </div>
            </div>
        </div>
    
        <div id="pm-quick-message" class="pm-quick-login-message">
            <span><i id="pm-quick-message-close" class="typcn typcn-times"></i> <?php esc_attr_e('Validating credentials, please wait...', 'quantumtheme'); ?></span>
        </div>
    
    <?php endif; ?>
    
    <?php $enableSubMenu = get_theme_mod('enableSubMenu', 'on'); ?>
    
    <?php if($enableSubMenu === 'on') : ?>
    
    	<div class="pm-header-info">
        
            <div class="container pm-header-info-container">
                
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                        <ul class="pm-header-support-ul">
                            <?php if($businessPhone !== '') { ?>
                                <li>
                                    <p class="pm-header-support-text"><?php echo wp_kses($businessPhone, $allowed_html); ?></p>
                                </li>
                            <?php } ?>
                            
                            <?php if($businessPhone !== '' && $supportPhone !== '') { ?>
                                <li class="pm-header-support-text-bullet"><p class="pm-header-support-text">&bull;</p></li>
                            <?php } ?>
                            
                            <?php if($supportPhone !== '') { ?>
                                <li>
                                    <p class="pm-header-support-text"><?php echo wp_kses($supportPhone, $allowed_html); ?></p>
                                </li>
                            <?php } ?>
                        </ul>
                        
                        <?php if($enableLanguageSelector === 'on') : ?>
                                
							<?php pm_ln_icl_post_languages('desktop'); ?> 
                            
                        <?php endif; ?> 
                        
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
                        <div class="pm-header-buttons-spacer">
                        
                            <?php if(is_user_logged_in()) { ?>
                            
                                    <?php 
                                        $current_user = wp_get_current_user();
                                    ?>
                            
                                    <ul class="pm-header-buttons-ul">
    
                                        <li>
                                            <p class="pm-header-login-text"><?php esc_attr_e('Welcome back,', 'quantumtheme'); ?> <?php echo $current_user->user_firstname; ?></p>
                                        </li>
                                        
                                        <li>
                                            <div class="pm-base-btn pm-header-btn user pm-login-btn">
                                            
                                            	<?php 
												
													//Redux options													
													$membersAccountSlug = get_option('pm_members_account_template_slug');
												
												?>
                                            
                                                <a href="<?php echo $membersAccountSlug !== '' ? site_url($membersAccountSlug) : site_url('members-account');  ?>"><i class="fa fa-user"></i></a>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="pm-base-btn pm-header-btn pm-register-btn">
                                            
                                                <?php 
                                                    $logoutURL = get_option('pm_custom_logout_url');
                                                ?>
                                            
                                                <?php if($logoutURL !== '') { ?>
                                                    <a href="<?php echo wp_logout_url( esc_attr($logoutURL) ); ?>"><?php esc_attr_e('Sign Out', 'quantumtheme'); ?></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php esc_attr_e('Sign Out', 'quantumtheme'); ?></a>
                                                <?php } ?>
                                                
                                            </div>
                                        </li>
                                        
                                        <?php if($enableSearch == 'on') { ?>
                                            <li>
                                                <div class="pm-base-btn pm-header-btn search" id="pm-search-btn">
                                                    <a class="fa fa-search"></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>
                            
                            <?php } else { ?>
                            
                                    <ul class="pm-header-buttons-ul">
                            
                                        <?php if($enableCTA == 'on') { ?>
                                            <li>
                                                <p class="pm-header-login-text"><?php echo esc_attr($ctaText); ?></p>
                                            </li>
                                        <?php } ?>
                                        
                                        <?php if($enableRegistration == 'on') { ?>
                                            <li>
                                                <div class="pm-base-btn pm-header-btn pm-register-btn">
                                                    <a href="<?php echo esc_html($registerLink); ?>"><?php echo esc_attr($registerButtonText); ?></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        
                                        <?php if($enableLogin == 'on') { ?>
                                            <li>
                                                <div class="pm-base-btn pm-header-btn pm-login-btn">
                                                    <a href="<?php echo esc_html($loginLink); ?>"><?php echo esc_attr($loginButtonText); ?></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                                                            
                                        <?php if($enableSearch == 'on') { ?>
                                            <li>
                                                <div class="pm-base-btn pm-header-btn search" id="pm-search-btn">
                                                    <a class="fa fa-search"></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        
                                        <?php if($enableQuickLogin === 'yes') { ?>
                                            <li>
                                                <div class="pm-base-btn pm-header-btn search expand" id="pm-quick-login-btn">
                                                    <a class="<?php echo esc_attr($activatorIcon); ?>"></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>
                            
                            <?php } ?>
                            
                            <?php if($enableLanguageSelector === 'on') : ?>
                                
								<?php pm_ln_icl_post_languages('mobile'); ?> 
                                
                            <?php endif; ?>
                                                
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </div><!-- /pm-header-info -->
    
    <?php endif; ?>

	
    
    <header>
                
        <div class="container pm-header-container">
            <div class="row">
            
            	<?php 
					$companyLogo = get_theme_mod('companyLogo', '');
					$companyLogoURL = get_theme_mod('companyLogoURL', '');
				?>
            
                <div class="col-lg-4 col-md-3 col-sm-12 pm-header-logo-div">
                    <div class="pm-header-logo-container">
                    	<?php if($companyLogo !== '') { ?>
                        	<a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url(); ?>"><img src="<?php echo esc_html($companyLogo); ?>" class="img-responsive" alt="<?php bloginfo('description'); ?>"></a>
                        <?php } else { ?>
                        	<a href="<?php echo $companyLogoURL !== '' ? $companyLogoURL : site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/quantum-wordpress-theme.jpg" class="img-responsive" alt="<?php bloginfo('description'); ?>"></a>
                        <?php } ?>
                        
                    </div>
                    
                    <div class="pm-header-mobile-btn-container">
                        <button type="button" class="navbar-toggle pm-main-menu-btn" id="pm-main-menu-btn" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                    </div>
                    
                </div>
                                                        
                <div class="col-lg-8 col-md-9 col-sm-12 pm-main-menu">
                                        
                    <nav class="navbar-collapse collapse">
                    
                    	<?php
							wp_nav_menu(array(
								'container' => '',
								'container_class' => '',
								'menu_class' => 'sf-menu',
								'menu_id' => 'pm-nav',
								'theme_location' => 'main_menu',
								'fallback_cb' => 'pm_ln_main_menu',
								//link_before'     => '<span>',
								//'link_after'      => '</span>',
								'walker' => new pm_ln_bootstrap_navwalker
							   )
							);
						?>
                        
                    </nav> 
                    
                </div>
                                    
            </div>       
            
        </div>
                
    </header><!-- /header -->
    
    <?php if(is_home() || is_front_page()) {//Display presentation area ?>
    
    	<?php if($enablePostSlider === 'yes') { ?>
        
        	<?php $enableSliderParallax = get_theme_mod('enableSliderParallax', 'on'); ?>
        
        		<!-- PRESENTATION AREA -->
                <div class="pm-presentation-container <?php echo $enableSliderParallax === 'on' ? 'pm-parallax-panel' : ''; ?>" <?php echo $enableSliderParallax === 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="97"' : ''; ?>>
                                        
                    <div class="pm-presentation-text-container">
                        <div class="pm-presentation-text">
                            <?php 
								$presentationText = get_theme_mod('presentationText', 'This is quantum'); 
								$presentationText2 = get_theme_mod('presentationText2', 'A premium quality theme for businesses and corporations'); 
							?>
                            <h1><?php echo esc_attr($presentationText); ?></h1>
                            <p><?php echo esc_attr($presentationText2); ?></p>
                        </div>
                        
                        <?php 
						
							$displaySliderPosts = get_theme_mod('displaySliderPosts', 'on'); 
							$sliderPostsOrder = get_theme_mod('sliderPostsOrder', 'DESC'); 
						
						?>
                        
                        <?php if($displaySliderPosts === 'on') { ?>
						
							<?php
                        
                                $arguments = array(
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'meta_key' => 'pm_post_featured_meta',
                                    'meta_value' => 'on',
                                    'order' => (string) $sliderPostsOrder,
                                    'posts_per_page' => -1,
                                );
                            
                                $posts_query = new WP_Query($arguments);
                            
                                
                            ?>
                            
                             <ul class="pm-presentation-posts" id="pm-presentation-owl">
                             
                                <?php if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                            
                                    <?php get_template_part( 'content', 'presentationpost' ); ?>
                                
                                <?php endwhile; else: ?>
                                     <p><?php esc_attr_e('No posts were found.', 'quantumtheme'); ?></p>
                                <?php endif; ?> 
                                                 
                            </ul>
                            
                            <?php 
                                /* Restore original Post Data */
                                wp_reset_postdata();
                            ?>
                        
                        <?php } ?>
                        
                    </div>
                                
                </div>
                <!-- PRESENTATION AREA end -->
        
        <?php } ?>
        
        <?php 
		
			if($customSlider !== '' && $enablePostSlider === 'no') { 
        	   echo do_shortcode($customSlider);
        	} 
			
		?>
            
    <?php } else {//display sub-header ?>
    
    	<?php //exit; ?>
    
    	<?php 
		
			//global sub-header
			$displaySubHeader = get_theme_mod('displaySubHeader','on');
		
			//Check for sub-header option on pages			
			if(is_page()) {
				$get_pm_display_header_meta = get_post_meta(get_the_ID(), 'pm_display_header_meta', true); 
				$pm_display_header_meta = $get_pm_display_header_meta !== '' ? $get_pm_display_header_meta : 'on';//set a default value if none exists
			}
			
		
		?>
	
    	<?php if($displaySubHeader === 'on') : ?>
        
        	<?php if(is_page()) { ?>
				<?php if($pm_display_header_meta == 'on') { ?>
                    <?php get_template_part('content', 'subheader'); ?>
                <?php } ?>
            <?php } else { ?>
                <?php get_template_part('content', 'subheader'); ?>
            <?php } ?>
        
        <?php endif; ?>    	
    
<?php } ?>