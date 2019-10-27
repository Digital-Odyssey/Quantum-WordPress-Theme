<?php

/* Add filters, actions, and theme-supported features after theme is loaded */
add_action( 'after_setup_theme', 'pm_ln_theme_setup' );

function pm_ln_theme_setup() {
		
	//Define content width
	if ( !isset( $content_width ) ) $content_width = 1170;
	
	/***** LOAD REDUX FRAMEWORK ******/	
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/ReduxFramework/quantum/quantum-config.php' ) ) {
		require_once( get_template_directory() . '/ReduxFramework/quantum/quantum-config.php' );
	}
	
		
	/***** REQUIRED INCLUDES ***************************************************************************************************/
	
	include_once(get_template_directory() . '/includes/cpt-staff.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-workshops.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-careers.php'); //Custom post type
	include_once(get_template_directory() . '/includes/cpt-gallery.php'); //Custom post type
	include_once(get_template_directory() . '/includes/shortcodes/shortcodes.php'); //Shortcodes
		
	//Widgets
	include_once(get_template_directory() . "/includes/widget-twitter.php"); //twitter
	include_once(get_template_directory() . "/includes/widget-facebook.php"); //facebook
	include_once(get_template_directory() . "/includes/widget-video.php"); //video
	include_once(get_template_directory() . "/includes/widget-flickr.php"); //flickr
	include_once(get_template_directory() . "/includes/widget-mailchimp.php"); //mailchimp
	include_once(get_template_directory() . "/includes/widget-quickcontact.php"); //quick contact form
	include_once(get_template_directory() . "/includes/widget-recentposts.php"); //recent posts
	include_once(get_template_directory() . "/includes/widget-careers.php"); //careers posts
	include_once(get_template_directory() . "/includes/widget-workshops.php"); //workshops posts
	include_once(get_template_directory() . "/includes/widget-membersarchive.php"); //members archive list
	include_once(get_template_directory() . "/includes/widget-memberfiles.php"); //member files
	
	//TGM plugin
	require_once(get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php");
	
	//Theme update notifications library
	require_once(get_template_directory() . "/includes/theme-update-checker.php");
	
	//Bootstrap 3 nav support
	include_once(get_template_directory() . '/includes/pm_ln_bootstrap_navwalker.php');
	
	//Customizer class
	include_once(get_template_directory() . "/includes/classes/PM_LN_Customizer.class.php");
	
	//Custom functions
	include_once(get_template_directory() . "/includes/wp-functions.php");
	
	//Theme metaboxes
	include_once(get_template_directory() . "/includes/theme-metaboxes.php");
	
	//Private Members Area
	include_once(get_template_directory() . "/includes/members/members.php");
	
	/***** CUSTOM VISUAL COMPOSER SHORTCODES ********************************************************************************/
	if ( pm_ln_is_plugin_active( 'visual-composer/js_composer.php' ) || pm_ln_is_plugin_active( 'js_composer/js_composer.php' ) ) {

		if(!class_exists('WPBakeryShortCode')) return;
	
		$de_block_dir = get_template_directory().'/includes/vc_blocks/';
		
		require_once( $de_block_dir . 'box_button.php' ); 
		require_once( $de_block_dir . 'stat_box.php' );
		require_once( $de_block_dir . 'stat_box2.php' );
		require_once( $de_block_dir . 'workshop_post.php' );
		require_once( $de_block_dir . 'feature_box.php' );
		require_once( $de_block_dir . 'cta_box.php' );
		require_once( $de_block_dir . 'cta_box2.php' ); 
		require_once( $de_block_dir . 'vimeo_video.php' );
		require_once( $de_block_dir . 'youtube_video.php' );
		require_once( $de_block_dir . 'html_video.php' );
		require_once( $de_block_dir . 'divider.php' );
		require_once( $de_block_dir . 'video_box.php' );
		require_once( $de_block_dir . 'newsletter_registration.php' );
		require_once( $de_block_dir . 'google_map.php' );
		require_once( $de_block_dir . 'post_items.php' );
		require_once( $de_block_dir . 'pricing_table.php' );
		require_once( $de_block_dir . 'panels_carousel.php' );
		require_once( $de_block_dir . 'client_carousel.php' );
		require_once( $de_block_dir . 'testimonials.php' );
		require_once( $de_block_dir . 'progress_bar.php' );
		require_once( $de_block_dir . 'icon_element.php' );
		require_once( $de_block_dir . 'standard_button.php' );
		require_once( $de_block_dir . 'countdown.php' );
		require_once( $de_block_dir . 'milestone.php' );
		require_once( $de_block_dir . 'piechart.php' );
		require_once( $de_block_dir . 'contact_form.php' );
		require_once( $de_block_dir . 'alert.php' );
		require_once( $de_block_dir . 'quote_box.php' );
		require_once( $de_block_dir . 'staff_profile.php' );
		
		//Nested elements go last
		require_once( $de_block_dir . 'accordion_group.php' );
		require_once( $de_block_dir . 'datatable_group.php' );
		require_once( $de_block_dir . 'tab_group.php' );
		require_once( $de_block_dir . 'slider_carousel.php' );				
	
	}
		
	/***** MENUS ***************************************************************************************************/
	
	register_nav_menu('main_menu', 'Main Menu');
	register_nav_menu('footer_menu', 'Footer Menu');
	
	/***** THEME SUPPORT ***************************************************************************************************/
	
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-header');
	add_theme_support('custom-background');	
	add_theme_support('title-tag');
		
	/***** CUSTOM FILTERS AND HOOKS ***************************************************************************************************/
	
	//Add your sidebars function to the 'widgets_init' action hook.
	add_action( 'widgets_init', 'pm_ln_register_custom_sidebars' );
	
	//Load front-end scripts
	add_action( 'wp_enqueue_scripts', 'pm_ln_scripts_styles' );
	
	//Load admin scripts
	add_action( 'admin_enqueue_scripts', 'pm_ln_load_admin_scripts' );
	
	//add_filter('excerpt_more', 'pm_ln_new_excerpt_more');
		
	//Add content and widget text shortcode support
	add_filter('the_content', 'do_shortcode');
	add_filter('widget_text', 'do_shortcode');
		
	//Retrieve only Posts from Search function
	add_filter('pre_get_posts','pm_ln_search_filter');
	
	//Show Post ID's
	add_filter('manage_posts_columns', 'pm_ln_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
	
	//Show Page ID's
	add_filter('manage_pages_columns', 'pm_ln_posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'pm_ln_posts_custom_id_columns', 5, 2);
			
	//Custom paginated posts
	add_filter('wp_link_pages_args','pm_ln_custom_nextpage_links');
	
	//Add HTML5 placeholders to comment forms
	//add_filter('comment_form_default_fields','pm_ln_comment_fields');
	//add_filter('comment_form_field_comment','pm_ln_comment_textarea_field');
	
	//Remove REL tag from posts (this will eliminate HTML5 validation error) 
	add_filter( 'wp_list_categories', 'pm_ln_remove_category_list_rel' );
	add_filter( 'the_category', 'pm_ln_remove_category_list_rel' );
	
	//Remove title attributes from WordPress navigation
	add_filter( 'wp_list_pages', 'pm_ln_remove_title_attributes' );
	
	//Ajax loader function
	add_action('wp_ajax_pm_ln_load_more', 'pm_ln_load_more');
	add_action('wp_ajax_nopriv_pm_ln_load_more', 'pm_ln_load_more');
	
	add_action('wp_ajax_pulsar_load_more_news_posts', 'pulsar_load_more_news_posts');
	add_action('wp_ajax_nopriv_pm_ln_load_more_news_posts', 'pm_ln_load_more_news_posts');
	
	//Ajax Contact form
	add_action('wp_ajax_send_contact_form', 'pm_ln_send_contact_form');
	add_action('wp_ajax_nopriv_send_contact_form', 'pm_ln_send_contact_form');
	
	//Ajax Quick Contact form
	add_action('wp_ajax_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
	add_action('wp_ajax_nopriv_send_quick_contact_form', 'pm_ln_send_quick_contact_form');
		
	
	//Media library category support
	//add_action( 'init' , 'pm_ln_add_categories_to_attachments' );
	add_action( 'init', 'pm_ln_add_file_assignment_taxonomy' );
	add_action( 'init', 'pm_ln_add_archive_assignment_taxonomy' );
	
	add_action('init', 'app_output_buffer');
	
	//Custom page title output
	add_filter( 'wp_title', 'pm_ln_custom_page_titles', 10, 2 );
	
	/**** THEME CUSTOMIZER - NEW in WP 3.4+ ****/
		
	//Output CSS to head section
	add_action ('wp_head', 'pm_ln_customizer_css', 130);
	add_action( 'customize_preview_init', 'pm_ln_customize_preview_js' );
	//add_action( 'customize_controls_enqueue_scripts', 'pm_ln_panels_js' );
	//add_action( 'wp_enqueue_scripts', 'pm_ln_customizer_styles_cache', 130 );
	//add_action( 'customize_save_after', 'pm_ln_reset_style_cache_on_customizer_save' );
	
	
	//Ajax Scripts
	add_action('wp_enqueue_scripts', 'pm_ln_register_user_scripts');
	
	//Ajax Registration
	add_action('wp_ajax_register_user', 'pm_ln_register_new_user');
	add_action('wp_ajax_nopriv_register_user', 'pm_ln_register_new_user');
	
	//Ajax Login
	add_action('wp_ajax_validate_quick_login', 'pm_ln_validate_quick_login');
	add_action('wp_ajax_nopriv_validate_quick_login', 'pm_ln_validate_quick_login');
	
	/**** WOOCOMMERCE ***/
	
	//Declare Woocommerce support
	add_theme_support('woocommerce');
	
	//Woocommerce gallery support for version 3.0
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove Woocommerce breadcrumbs
	add_action( 'init', 'pm_ln_remove_wc_breadcrumbs' );
	
	//Remove default Woocommerce wrapper
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	
	//Add wrapper to Woocommerce pages - applies to product-archive.php and single-product.php
	add_action('woocommerce_before_main_content', 'pm_ln_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'pm_ln_woo_wrapper_end', 10);
	
	//Display empty star rating
	add_filter('woocommerce_product_get_rating_html', 'pm_ln_woo_get_rating_html', 10, 2);
	
	
	//New woocommerce fields for courses
	//add_action( 'woocommerce_product_options_general_product_data', 'pm_ln_woo_add_custom_general_fields' );
	//add_action( 'woocommerce_process_product_meta', 'pm_ln_woo_add_custom_general_fields_save' );
	
	//Display number of items per page
	$get_products_per_page = get_theme_mod('products_per_page');
	$products_per_page = $get_products_per_page == '' ? 8 : $get_products_per_page;
		
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );	
	
	//Dashboard customization
	add_filter( 'admin_footer_text', 'pm_ln_remove_footer_admin' );//footer info
	add_action( 'login_enqueue_scripts', 'pm_ln_login_logo' );//login logo
	add_filter( 'login_headerurl', 'pm_ln_login_logo_url' );//login logo url
	add_filter( 'login_headertitle', 'pm_ln_login_logo_url_title' );//login logo title
	
	//TGM plugin activation
	add_action( 'tgmpa_register', 'pm_ln_register_required_plugins' );
	
	//Theme updates
	//add_action('init', 'pm_ln_check_for_theme_updates');
	
	//Custom settings page for purchase verification
	add_action( 'admin_menu', 'pm_ln_theme_settings_admin_menu' );
	
	//Create theme update options
	add_option('pm_ln_theme_marketplace','');
	add_option('pm_ln_micro_themes_user_email','');
	add_option('pm_ln_micro_themes_purchase_code_themeforest','');
	add_option('pm_ln_micro_themes_purchase_code_mojo','');
	add_option('pm_ln_micro_themes_purchased_product', 3);//Theme specific

				
}//end of after_theme_setup

add_action('after_setup_theme', 'pm_ln_localization_setup');


if( !function_exists('pm_ln_customize_preview_js') ) {
	
	function pm_ln_customize_preview_js() {
		wp_enqueue_script( 'procast-theme-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
	}
	
}

if( !function_exists('pm_ln_panels_js') ) {
	
	function pm_ln_panels_js() {
		wp_enqueue_script( 'procast-theme-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '1.0', true );
	}
	
}


if( !function_exists('pm_ln_register_required_plugins') ){

	function pm_ln_register_required_plugins() {
		
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Woocommerce', // The plugin name.
				'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/woocommerce.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
			array(
				'name'               => 'Customizer Export/Import', // The plugin name.
				'slug'               => 'customizer-export-import', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/customizer-export-import.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			
			array(
				'name'               => 'Quantum Members Area', // The plugin name.
				'slug'               => 'members-area', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/includes/lib/members-area.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
	
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'quantumtheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
	
			
		);
	
		tgmpa( $plugins, $config );
	}

}


function pm_ln_login_logo_url() {
	return esc_url( 'https://www.pulsarmedia.ca' );
}

function pm_ln_login_logo_url_title() {
	return esc_html__('Pulsar Media :: Interactive Design Studio', "quantumtheme");
}

function pm_ln_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/pulsar-media-login.png );
			padding-bottom: 0px;
			width:321px !important;
			background-size:100%;
		}
	</style>
<?php }

function pm_ln_remove_footer_admin () {
	echo '<span id="footer-thankyou">'. esc_html__('Developed by', "quantumtheme") .' <a href="http://www.pulsarmedia.ca/" target="_blank">'. esc_html__('Pulsar Media', "quantumtheme") .'</a> :: '. esc_html__('Interactive Design Studio', "quantumtheme") .' - '. esc_html__('Visit our', "quantumtheme") .' <a href="https://github.com/PulsarMedia" target="_blank">'. esc_html__('GitHub account', "quantumtheme") . '</a> ' . esc_html__('for more FREE WordPress themes and plugins', 'quantumtheme');
}

function pm_ln_remove_dashboard_widget () {
    remove_meta_box ( 'dashboard_quick_press', 'dashboard', 'side' );
	
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}

function pm_ln_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'pm_ln_dashboard_widget', // Widget slug.
		esc_html__('Micro Themes - Latest News', 'quantumtheme'), // Title.
		'pm_ln_dashboard_widget_function' // Display function.
	);
}

function pm_ln_dashboard_widget_function() {
	
	$news_file = wp_remote_get( 'https://www.microthemes.ca/files/theme-news/news.html' );
	
	if( is_array($news_file) ) {
						
	  $header = $news_file['headers']; // array of http header lines
	  $body = $news_file['body']; // use the content
	  
	  $args = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'p' => array(),
			'h2' => array(),
		);
	  
	  echo wp_kses($body, $args) ;
	  
	}
	
}


if( !function_exists('pm_ln_check_for_theme_updates') ){
	
	function pm_ln_check_for_theme_updates() {
	
		$theme_update_checker = new ThemeUpdateChecker(
			'quantum-theme',
			'http://updates.microthemes.ca/theme-updates/quantum-theme-updater.php'
		);
		
		$theme_update_checker->checkForUpdates();
			
	}
	
}


if( !function_exists('pm_ln_theme_settings_admin_menu') ){	
	function pm_ln_theme_settings_admin_menu() {	
		add_options_page( esc_attr__('Theme Updates', 'quantumtheme'), esc_attr__('Theme Updates', 'quantumtheme'), 'manage_options', 'myplugin/myplugin-admin-page.php', 'pm_ln_theme_settings_admin_page', 'dashicons-tickets', 6 );
	}
}


if( !function_exists('pm_ln_theme_settings_admin_page') ){

	function pm_ln_theme_settings_admin_page(){		

		if(isset($_POST['pm_ln_verify_account_update'])){			
			update_option('pm_ln_theme_marketplace', sanitize_text_field($_POST['pm_ln_theme_marketplace']));
			update_option('pm_ln_micro_themes_user_email', sanitize_text_field($_POST['pm_ln_micro_themes_user_email']));
			update_option('pm_ln_micro_themes_purchase_code_themeforest', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_themeforest']));
			update_option('pm_ln_micro_themes_purchase_code_mojo', sanitize_text_field($_POST['pm_ln_micro_themes_purchase_code_mojo']));
			update_option('pm_ln_micro_themes_purchased_product', 3);//Corresponds to products array in verify account script
						
		}

		$pm_ln_micro_themes_user_email = get_option('pm_ln_micro_themes_user_email');
		$pm_ln_theme_marketplace = get_option('pm_ln_theme_marketplace');
		$pm_ln_micro_themes_purchase_code_themeforest = get_option('pm_ln_micro_themes_purchase_code_themeforest');	
		$pm_ln_micro_themes_purchase_code_mojo = get_option('pm_ln_micro_themes_purchase_code_mojo');	
		$pm_ln_micro_themes_purchased_product = get_option('pm_ln_micro_themes_purchased_product');
		
		//Validate account
		$queryArgs = array();
		$queryArgs['customer_email'] = $pm_ln_micro_themes_user_email;	
		$queryArgs['customer_marketplace'] = $pm_ln_theme_marketplace;
		$queryArgs['customer_themeforest_purchase_code'] = $pm_ln_micro_themes_purchase_code_themeforest;
		$queryArgs['customer_mojo_purchase_code'] = $pm_ln_micro_themes_purchase_code_mojo;
		$queryArgs['customer_product'] = $pm_ln_micro_themes_purchased_product;
		
		$account_valid = false;
		
		//args for wp_remote_get
		$options = array(
			'timeout' => 10, //seconds
		);
		
		$url = 'http://updates.microthemes.ca/theme-updates/verify-account.php'; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url); //rebuild url with arguments
		}
		
		//Send the request to Micro Themes
		$response = wp_remote_get($url, $options);
						
		if( is_array($response) ) {
			
		  $header = $response['headers']; // array of http header lines
		  $body = $response['body']; // use the content
		  		  
		  if( strstr($body, "success") ){
			  $account_valid = true;
		  }
		  
		}

		?>

		<div class="wrap">
        
        	<div class="wpmm-wrapper">
            
            	<div id="content" class="wrapper-cell">
            
					<?php if(isset($_POST['pm_ln_verify_account_update'])){?>
    
                        <div class="notice notice-success is-dismissible">
                            <p><?php esc_attr_e('Your settings were updated', 'quantumtheme'); ?></p>
                        </div>
                        
                    <?php } ?>	
        
                    <h2><?php esc_attr_e('Theme verification', 'quantumtheme'); ?></h2>
                    <p><?php esc_attr_e('Use the form below to verify your Micro Themes account - this will verify your account for automatic updates.', 'quantumtheme'); ?></p>            
        
                    <form method="post" action="">            
        
                        <p><label><?php esc_attr_e('Select your marketplace for purchase verification', 'quantumtheme'); ?>:</label></p>                
        
                        <select name="pm_ln_theme_marketplace" id="pm_ln_verify_marketplace_selection">
                            <option value="default" <?php if ( 'default' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>>-- <?php esc_attr_e('Choose Marketplace', 'quantumtheme'); ?> --</option>
                            <option value="microthemes" <?php if ( 'microthemes' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Micro Themes', 'quantumtheme'); ?></option>
                            <option value="themeforest" <?php if ( 'themeforest' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Themeforest', 'quantumtheme'); ?></option>
                            <option value="mojo" <?php if ( 'mojo' == $pm_ln_theme_marketplace ) echo 'selected="selected"'; ?>><?php esc_attr_e('Mojo Marketplace', 'quantumtheme'); ?></option>
                        </select>                
        
                        <div id="pm_ln_micro_themes_purchase_code_themeforest" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'themeforest' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Themeforest item purchase code', 'quantumtheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_themeforest" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_themeforest); ?>" maxlength="200" />
                        </div> 
                        
                        <div id="pm_ln_micro_themes_purchase_code_mojo" class="pm_ln_micro_themes_purchase_code <?php echo $pm_ln_theme_marketplace == 'mojo' ? 'active' : ''; ?>">
                            <p><label><?php esc_attr_e('Mojo item purchase code', 'quantumtheme'); ?>:</label></p>
                            <input class="pm-admin-theme-verify-text-field" type="text" name="pm_ln_micro_themes_purchase_code_mojo" value="<?php esc_attr_e($pm_ln_micro_themes_purchase_code_mojo); ?>" maxlength="200" />
                        </div>                
        
                        <p><label><?php esc_attr_e('Micro Themes account email address', 'quantumtheme'); ?>:</label></p>
                        <input class="pm-admin-theme-verify-text-field" type="text" value="<?php esc_attr_e($pm_ln_micro_themes_user_email); ?>" name="pm_ln_micro_themes_user_email" maxlength="200" />             
        
                        <input type="hidden" name="pm_ln_micro_themes_installed_theme" value="Medical-Link" />    
                        <p id="pm_ln_micro_themes_verfication_status"><?php esc_attr_e('Account status', 'quantumtheme'); ?>: <span><b><?php echo $account_valid == true ? esc_attr('Verified', 'quantumtheme') : esc_attr('Unverified', 'quantumtheme'); ?></b></span></p>
        
                        <br />                
        
                        <input name="pm_ln_verify_account_update" class="button button-primary button-large" value="<?php esc_attr_e('Verify Account', 'quantumtheme'); ?>" type="submit">            
        
                    </form>
                
                </div><!-- /.wrapper-cell -->
    
                <div id="sidebar" class="wrapper-cell">
                
                    <div class="sidebar_box themes_box">
                        <h3><?php esc_attr_e('More Themes by Micro Themes', 'quantumtheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=hope" target="_blank" title="Hope WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/hope.jpg" alt="Hope WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=quantum" target="_blank" title="Quantum WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/quantum.jpg" alt="Quantum WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=vienna" target="_blank" title="Vienna WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/vienna.jpg" alt="Vienna WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=medical-link" target="_blank" title="Medical-Link WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/medical-link.jpg" alt="Medical-Link WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=energy" target="_blank" title="Energy WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/energy.jpg" alt="Energy WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=luxor" target="_blank" title="Luxor WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/luxor.jpg" alt="Luxor WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=moxie" target="_blank" title="Moxie WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/moxie.jpg" alt="Moxie WordPress Themes"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=pro-cast" target="_blank" title="Pro-Cast WordPress Themes"><img src="http://microthemes.ca/images/theme-ads/pro-cast.jpg" alt="Pro-Cast WordPress Themes"></a>
                                </li>	
                                			
                            </ul>
                        </div>
                        
                        <h3><?php esc_attr_e('Plug-ins by Micro Themes', 'quantumtheme'); ?>:</h3>
                        <div class="inside">
                            <ul>
                            	<li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-stream" target="_blank" title="Easy Social Stream"><img src="http://microthemes.ca/images/theme-ads/easy-social-stream.jpg" alt="Easy Social Stream"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=easy-social-login" target="_blank" title="Easy Social Login"><img src="http://microthemes.ca/images/theme-ads/easy-social-login.jpg" alt="Easy Social Login"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-presentations" target="_blank" title="Premium Presentations"><img src="http://microthemes.ca/images/theme-ads/premium-presentations.jpg" alt="Premium Presentations"></a>
                                </li>
                                
                                <li>
                                	<a href="http://demos.microthemes.ca/?product=premium-paypal-manager" target="_blank" title="Premium Paypal Manager"><img src="http://microthemes.ca/images/theme-ads/premium-paypal-manager.jpg" alt="Premium Paypal Manager"></a>
                                </li>                                			
                            </ul>
                        </div>
                        
                    </div>
                
                </div><!-- /.wrapper-cell #sidebar -->
            
            </div><!-- /.wpmm-wrapper -->

		</div><!-- /.wrap -->

		<?php
	}
}


function pm_ln_custom_page_titles( $title, $sep ) {
	
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	} // end if
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} // end if
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) ) . " $sep $title";
	} // end if
	return $title;
}

function pm_ln_register_user_scripts() {
	
	if(pm_ln_has_shortcode('contactForm') || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
		//Contact Form
		wp_enqueue_script( 'pulsar-contactform', get_template_directory_uri() . '/js/ajax-contact/ajax-email.min.js', array('jquery'), '1.0', true );
	}
	
	if(is_active_widget( '', '', 'pm_ln_quickcontact_widget')) {
		//Quick contact widget
		wp_enqueue_script( 'pulsar-ajaxemail', get_template_directory_uri() . '/js/ajax-quick-contact/ajax-quick-email.min.js', array('jquery'), '1.0', true );
	}
	
  // Enqueue script
  wp_enqueue_script( 'pm-ln-register-script', get_template_directory_uri() . '/js/ajax-registration/ajax-registration.min.js', array('jquery'), '1.0', true );
  
  wp_enqueue_script( 'pm-ln-quick-login-script', get_template_directory_uri() . '/js/ajax-login/ajax-login.min.js', array('jquery'), '1.0', true );

}


/******* Remove title atts from WordPress nav *****/
function pm_ln_remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}

/******* Media library category support *******/
function pm_ln_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}

function pm_ln_add_file_assignment_taxonomy() {
    $labels = array(
        'name'              => 'File Assignment',
        'singular_name'     => 'File Assignment',
        'search_items'      => 'Search Assignment types',
        'all_items'         => 'All Assignment types',
        'parent_item'       => 'Parent Assignment type',
        'parent_item_colon' => 'Parent Assignment type:',
        'edit_item'         => 'Edit Assignment type',
        'update_item'       => 'Update Assignment type',
        'add_new_item'      => 'Add Assignment type',
        'new_item_name'     => 'New Assignment type',
        'menu_name'         => 'File Assignment',
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var' => 'true',
        'rewrite' => 'true',
        'show_admin_column' => 'true',
    );
 
    register_taxonomy( 'file_assignment', 'attachment', $args );
}

function pm_ln_add_archive_assignment_taxonomy() {
    $labels = array(
        'name'              => 'Archive Assignment',
        'singular_name'     => 'Archive Assignment',
        'search_items'      => 'Search Archive dates',
        'all_items'         => 'All Archive dates',
        'parent_item'       => 'Parent Archive date',
        'parent_item_colon' => 'Parent Archive date:',
        'edit_item'         => 'Edit Archive date',
        'update_item'       => 'Update Archive date',
        'add_new_item'      => 'Add Archive date',
        'new_item_name'     => 'New Archive date',
        'menu_name'         => 'Archive Assignment',
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var' => 'true',
        'rewrite' => 'true',
        'show_admin_column' => 'true',
    );
 
    register_taxonomy( 'archive_assignment', 'attachment', $args );
}

/*** WOOCOMMERCE FUNCTIONS *****/
function pm_ln_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


if ( ! function_exists( 'pm_ln_woo_wrapper_start' ) ) {
	
	function pm_ln_woo_wrapper_start() {
		
		  $woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
		  echo '<div class="container pm-containerPadding-top-80 pm-containerPadding-bottom-80">';
			 echo '<div class="row">';
			 
				if( $woocommShopLayout === 'left-sidebar' ) {
					get_sidebar('woocommerce');
				}
			 
				echo '<div class="col-lg-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-md-'. ( $woocommShopLayout === 'no-sidebar' ? '12' : '8' ) .' col-sm-12">';	  
		  
		  echo ''; 
	  
	}
	
}

if ( ! function_exists( 'pm_ln_woo_wrapper_end' ) ) {
	
	function pm_ln_woo_wrapper_end() {
		
		$woocommShopLayout = get_theme_mod('woocommShopLayout', 'no-sidebar');
		
	  		echo '</div>';
			
			if( $woocommShopLayout === 'right-sidebar' ) {
				get_sidebar('woocommerce');
			}
			
	  	 echo '</div>';
	  echo '</div>';
	  echo ''; 
	  
	}
	
}
function pm_ln_woocommerce_product_excerpt()  { 
	$content_length = 20;
	global $post;
	$content = $post->post_excerpt;
	$wordarray = explode(' ', $content, $content_length + 1);
	if(count($wordarray) > $content_length) :
	array_pop($wordarray);
	array_push($wordarray, '...');
	$content = implode(' ', $wordarray);
	$content = force_balance_tags($content);
	endif;
	echo "<span class='excerpt'><p>$content</p></span>";
} 
 
if( !function_exists('pm_ln_woo_get_rating_html') ){
	
	function pm_ln_woo_get_rating_html($rating_html, $rating) {
	
		if ( $rating > 0 ) {
			$title = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		} else {
			$title = 'Not yet rated';
			$rating = 0;
		}
	
		$rating_html  = '<div class="star-rating" title="' . $title . '">';
		$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'woocommerce' ) . '</span>';
		$rating_html .= '</div>';
		
		return $rating_html;
		
	}
	
}

function pm_ln_woo_add_custom_general_fields() {
 
	global $woocommerce, $post;
	echo '<div class="options_group">';
		
		//Course date
		woocommerce_wp_text_input(
			array(
				'id' => 'course_date',
				'label' => esc_attr__( 'Course Date', 'woocommerce' ),
				'placeholder' => 'Ex. July 07 2014',
				'desc_tip' => 'true',
				'description' => esc_attr__( 'Enter the course date here.', 'woocommerce' )
			)
		);
		
		//Course time
		woocommerce_wp_text_input(
			array(
				'id' => 'course_time',
				'label' => esc_attr__( 'Course Time', 'woocommerce' ),
				'placeholder' => 'Ex. 9:00am to 4:30pm EST',
				'desc_tip' => 'true',
				'description' => esc_attr__( 'Enter the course start and end time here.', 'woocommerce' )
			)
		);
		
		// Checkbox
		woocommerce_wp_checkbox(
			array(
				'id' => 'show_sharing_options',
				'wrapper_class' => 'show_if_simple',
				'label' => esc_attr__('Display Sharing icons?', 'woocommerce' ),
				'description' => esc_attr__( 'Check this on to display sharing icons.', 'woocommerce' )
			)
		);
		
		// Checkbox
		woocommerce_wp_checkbox(
			array(
				'id' => 'show_alert',
				'wrapper_class' => 'show_if_simple',
				'label' => esc_attr__('Show Alert message?', 'woocommerce' ),
				'description' => esc_attr__( 'Check this on to display an alert message.', 'woocommerce' )
			)
		);
		
		
		//Alert Title
		woocommerce_wp_text_input(
			array(
				'id' => 'alert_title',
				'label' => esc_attr__( 'Alert Title', 'woocommerce' ),
				'placeholder' => 'Ex. Did you know!',
				'desc_tip' => 'true',
				'description' => esc_attr__( 'Enter a title for your alert message', 'woocommerce' )
			)
		);
		
		//Alert Message
		woocommerce_wp_textarea_input(
		array(
				'id' => 'alert_message',
				'label' => esc_attr__( 'Alert Message', 'woocommerce' ),
				'placeholder' => '',
				'description' => esc_attr__( 'Enter a description for your alert.', 'woocommerce' )
			)
		);
		
		//Alert Icon
		woocommerce_wp_text_input(
			array(
				'id' => 'alert_icon',
				'label' => esc_attr__( 'Alert Icon', 'woocommerce' ),
				'placeholder' => 'Ex. fa fa-exclamation',
				'desc_tip' => 'true',
				'description' => esc_attr__( 'Enter an icon for your alert message. Use a FontAwesome 4 or Typicon value.', 'woocommerce' )
			)
		);
		
	echo '</div>';
	
}

function pm_ln_woo_add_custom_general_fields_save( $post_id ){
	
	// Course date field
	$course_date = $_POST['course_date'];
	if( !empty( $course_date ) )
	update_post_meta( $post_id, 'course_date', esc_attr( $course_date ) );
	
	// Course time field
	$course_time = $_POST['course_time'];
	if( !empty( $course_date ) )
	update_post_meta( $post_id, 'course_time', esc_attr( $course_time ) );
	
	// Alert Checkbox
	$show_alert = isset( $_POST['show_alert'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'show_alert', $show_alert );
	
	// Display sharing Checkbox
	$show_alert = isset( $_POST['show_sharing_options'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, 'show_sharing_options', $show_alert );
	
	// Alert title
	$alert_title = $_POST['alert_title'];
	if( !empty( $alert_title ) )
	update_post_meta( $post_id, 'alert_title', esc_attr( $alert_title ) );
	
	// Course time field
	$alert_message = $_POST['alert_message'];
	if( !empty( $alert_message ) )
	update_post_meta( $post_id, 'alert_message', esc_html( $alert_message ) );
	
	// Alert icon
	$alert_icon = $_POST['alert_icon'];
	if( !empty( $alert_icon ) )
	update_post_meta( $post_id, 'alert_icon', esc_attr( $alert_icon ) );

	
}

function pm_ln_comment_fields($fields) {
	
	$commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
 
    $fields['author'] =
        '<p class="comment-form-author">
            <input required minlength="3" class="pm-textfield" maxlength="30" placeholder="Name *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['email'] =
        '<p class="comment-form-email">
            <input required placeholder="Email *" class="pm-textfield" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['url'] =
        '<p class="comment-form-url">
            <input placeholder="Website" class="pm-textfield" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';
 
    return $fields;	
}

function pm_ln_comment_textarea_field($comment_field) {
	$comment_field =
	'<p class="comment-form-comment">
		<textarea required placeholder="Comment…" class="pm-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	</p>';
 
    return $comment_field;
}


function app_output_buffer() {
  ob_start();
}


//Remove REL tag from posts (this will eliminate HTML5 validation error)
function pm_ln_remove_category_list_rel( $output ) {
	// Remove rel attribute from the category list
	return str_replace( ' rel="category tag"', '', $output );
}


//Retrieve only Posts from Search function 
function pm_ln_search_filter($query) {
	
	if( isset($_GET['post_type']) ){
		
		if($_GET['post_type'] == 'product'){
			
			if ($query->is_search) {
				$query->set('post_type',array('product'));
			}
			
		}
		
	} else {
		
		if ($query->is_search) {
			//$query->set('post_type', array('post', 'page'));
			$query->set('post_type', array('post'));
		}
		
	}
		
	return $query;
}

//Show Post ID's
function pm_ln_posts_columns_id($defaults){
	$defaults['wps_post_id'] = esc_attr__('ID', 'quantumtheme');
	return $defaults;
}
function pm_ln_posts_custom_id_columns($column_name, $id){
		if($column_name === 'wps_post_id'){
				echo $id;
	}
}

//Excerpt filters
/*function pm_ln_new_excerpt_more($more) {
	global $post;
	return '... <a href="'. get_permalink($post->ID) . '" class="readmore">'.esc_attr__('Read More', 'quantumtheme').' &raquo</a>';
}*/

//Custom paginated posts
function pm_ln_custom_nextpage_links($defaults) {
	$args = array(
		'before' => '<div class="pm_paginated-posts"><p>'. esc_attr__('Continue Reading: ', 'quantumtheme') .'</p><ul class="pagination_multi clearfix">',
		'after' => '</ul></div>',
		'link_before'      => '<li>',
		'link_after'       => '</li>',
	);
	$r = wp_parse_args($args, $defaults);
	return $r;
}

//Enqueue scripts and styles for admin area
function pm_ln_load_admin_scripts() {
	
	//Load Media uploader script for custom meta options
	wp_enqueue_script( 'pulsar-mediauploader', get_template_directory_uri() . '/js/media-uploader/pm-image-uploader.js', array(), '1.0', true );
	
	//Custom CSS for meta boxes
	wp_enqueue_style( 'pulsar-wpadmin', get_template_directory_uri() . '/js/wp-admin/wp-admin.css' );
	
	//JS for admin
	wp_enqueue_script( 'pulsar-wpadminjs', get_template_directory_uri() . '/js/wp-admin/wp-admin.js', array(), '1.0', true );
	
	//Date picker for Workshops post type
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'pulsar-datepicker', get_template_directory_uri() . '/css/datepicker/jquery-ui.min.css' );
	
	$admin_js = get_template_directory_uri() . '/js/wp-admin/wp-admin.js'; 
	
	//Pass admin path to JS
	wp_register_script( 'adminRoot', $admin_js  );
	wp_enqueue_script( 'adminRoot' );
	$array = array( 
		'adminRoot' => home_url(),
	);
	wp_localize_script( 'adminRoot', 'adminRootObject', $array ); 
	
}

//Enqueue scripts and styles
function pm_ln_scripts_styles() {
		
	global $wp_styles;
	global $post;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	
		wp_enqueue_script( 'comment-reply' );

		//Adds JavaScript for handling the navigation menu hide-and-show behavior.
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap3/js/bootstrap.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '1.0', false );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.min.js', array('jquery'), '1.0', true ); //Minimized
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish/superfish.min.js', array('jquery'), '1.0', true ); //Minimized
		wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/superfish/hoverIntent.min.js', array('jquery'), '1.0', true ); //Minimized
		wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array('jquery'), '1.0', true ); //Minimized
		wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.min.js', array('jquery'), '1.0', true ); //Minimized
		
		//Conditional scripts
		$retinaSupport = get_theme_mod('retinaSupport', 'off');
		if( $retinaSupport === 'on' ){
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), '1.0', true ); //Minimized
		}

		
		if( is_single() || is_page() || is_archive() || is_author() || is_category() || is_home() || is_search() ){			
			wp_enqueue_script( 'pulsar-hoverPanel', get_template_directory_uri() . '/js/jquery.hoverPanel.min.js', array('jquery'), '1.0', true );
		}
		
		
		if(pm_ln_has_shortcode('sliderCarousel') || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
			//Flexslider
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array('jquery'), '1.0', true ); //Minimized
			wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/js/flexslider/flexslider-post.css', array( 'pulsar-style' ), '20121010' );
		}
		
		if(pm_ln_has_shortcode('panelsCarousel') || pm_ln_has_shortcode('clientCarousel') || is_home() || is_front_page() || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
			//load owl carousel
			wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0', true ); //Minimized
			//Use for clients carousel
			wp_enqueue_style( 'pulsar-carousel', get_template_directory_uri() . '/css/pulse-carousel.css', array( 'pulsar-style' ), '20121010' );
		}
		
		if(pm_ln_has_shortcode('piechart') || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
			//Load Easypiechart
			wp_enqueue_script( 'pulsar-easypiechart', get_template_directory_uri() . '/js/easypiechart/jquery.easypiechart.min.js', array('jquery'), '1.0', true ); //Minimized
		}
		
		if(pm_ln_has_shortcode('countdown') || pm_ln_is_plugin_active('js_composer/js_composer.php')) {	
			//Load Countdown
			wp_enqueue_script( 'pulsar-countdown', get_template_directory_uri() . '/js/countdown/countdown.js', array('jquery'), '1.0', true );
		}
		
		if( pm_ln_has_shortcode('googleMap') || pm_ln_is_plugin_active('js_composer/js_composer.php') )  {	
			
			$googleAPIKey = get_theme_mod('googleAPIKey');
			
			//Google maps shortcode support
			wp_register_script('googlemaps', ('//maps.google.com/maps/api/js?key='.$googleAPIKey.'&libraries=places'), false, null, true);
			wp_enqueue_script('googlemaps');
		}
				
		
		if( is_single() || is_page() || is_home() ){
			
			//Load WOW
			wp_enqueue_style( 'wow-css', get_template_directory_uri() . '/js/wow/css/libs/animate.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow/wow.min.js', array('jquery'), '1.0', true ); //Minimized
						
			//Load Viewport Selectors for jQuery
			wp_enqueue_script( 'pulsar-viewmini', get_template_directory_uri() . '/js/jquery.viewport.mini.js', array('jquery'), '1.0', true ); //Minimized		
			
		}
		
		if( is_page_template('template-gallery.php') || is_page_template('template-staff.php')){
			
			//load isotope
			wp_enqueue_style( 'pulsar-isotope-css', get_template_directory_uri() . '/js/isotope/isotope.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'pulsar-isotope', get_template_directory_uri() . '/js/isotope/jquery.isotope.min.js', array('jquery'), '1.0', true ); //Minimized
			
			//Load Ajax loader - Still need to create this
			$js_file = get_template_directory_uri() . '/js/wordpress.js'; 
			
			wp_enqueue_script( 'jcustom', $js_file );
			$array = array( 
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('pulsar_ajax'),
				'loading' => esc_attr__('Loading...', 'quantumtheme')
			);
			wp_localize_script( 'jcustom', 'pulsarajax', $array );
			
		}
		
		if(is_page_template('template-gallery.php') || get_post_type() == 'post_galleries'){
			//PrettyPhoto
			wp_enqueue_style( 'prettyPhoto-css', get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css', array( 'pulsar-style' ), '20121010' );
			wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/js/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true );
			wp_enqueue_script( 'prettyphoto', get_template_directory_uri() . '/js/jquery-migrate-1.1.1.js', array('jquery'), '1.0', true );
		}

		
		//Micro Themes plug-ins
		$enableTooltip = get_theme_mod('enableTooltip', 'on');
		if($enableTooltip === 'on'){
			wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/js/jquery.tooltip.min.js', array('jquery'), '1.0', true ); //Minimized
		}
						
		//Load Stellar Parallax
		wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/stellar/jquery.stellar.min.js', array('jquery'), '1.0', true ); //Minimized
		
		//Load main script
		wp_enqueue_script( 'pulsar-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true ); //Minimized
		
		
		//Load theme color selector (for sampling purposes)
		$colorSampler = get_theme_mod('colorSampler', 'on');
		if( $colorSampler == 'on' ){
			wp_enqueue_script( 'pulsar-theme-color-selector', get_template_directory_uri() . '/js/theme-color-selector.min.js', array('jquery'), '1.0', true ); //Minimized
			wp_enqueue_style( 'pulsar-theme-color-selector-css', get_template_directory_uri() . '/js/theme-color-selector/theme-color-selector.css', array( 'pulsar-style' ), '20121010' );
		}
				
		//Load twitter feed
		wp_enqueue_script( 'twitterFetcher', get_template_directory_uri() . '/js/twitter-post-fetcher/twitterFetcher_min.js', array('jquery'), '1.0', true ); //Minimized
		
				
		//Loads our main stylesheet.
		wp_enqueue_style( 'pulsar-style', get_stylesheet_uri() );
		
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap3/css/bootstrap.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'master-css', get_template_directory_uri() . '/css/master.css', array( 'pulsar-style' ), '20121010' );
	
		//Loads other stylesheets.
		wp_enqueue_style( 'superfish-css', get_template_directory_uri() . '/css/superfish/superfish.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'pulsar-style' ), '20121010' );
		wp_enqueue_style( 'typicons-css', get_template_directory_uri() . '/css/typicons/typicons.min.css', array( 'pulsar-style' ), '20121010' );

		
		//Responsive css - load this second last
		wp_enqueue_style( 'pulsar-responsive', get_template_directory_uri() . '/css/responsive.css', array( 'pulsar-style' ), '20121010' );
								
		//Load ie9 specific css - use this to fix ie 9 issues
		/*wp_enqueue_style( 'ie-nine-css', get_stylesheet_directory_uri() . '/css/ie9.css', array( 'pulsar-style' ), '20121010' );
		$wp_styles->add_data( 'ie-nine-css', 'conditional', 'IE 9' );*/
		
		//JS LOCALIZATION
		global $quantum_options;
		
		$enableStickyNav = get_theme_mod('enableStickyNav', 'on');
		$dropMenuIndicator = get_theme_mod('dropMenuIndicator', 'fa-angle-down');
		
		//Post slider settings
		$autoPlaySpeed = get_theme_mod('autoPlaySpeed', 8000);
		$slideSpeed = get_theme_mod('slideSpeed', 500);
		$rewindSpeed = get_theme_mod('rewindSpeed', 1000);
		
		
		//PrettyPhoto settings
		$ppAnimationSpeed = get_theme_mod('ppAnimationSpeed');
		$ppAutoPlay = get_theme_mod('ppAutoPlay');
		$ppShowTitle = get_theme_mod('ppShowTitle');
		$ppColorTheme = get_theme_mod('ppColorTheme');
		$ppSlideShowSpeed = get_theme_mod('ppSlideShowSpeed');
		
		//Form translations
		
		/** Global messages **/
		$securityError = esc_attr__('Security answer invalid. Please answer the security question correctly.', 'quantumtheme');
		$successMessage = esc_attr__('Your inquiry has been received, thank you.', 'quantumtheme');
		$failedMessage = esc_attr__('A system error occurred. Please try again later.', 'quantumtheme');
		$ajaxSearchResult = esc_attr__('No results', 'quantumtheme');
		$fieldValidation = esc_attr__('Validating Fields...', 'quantumtheme');
		$loginMessage = esc_attr__('Validating credentials, please wait...', 'quantumtheme');
		$loginMessageSuccess = esc_attr__('Login successful, refreshing page...', 'quantumtheme');
		$loginMessageInvalid = esc_attr__('Invalid credentials, try again.', 'quantumtheme');
		
		/** Contact form **/
		$contactForm1 = esc_attr__('Please fill in your name.', 'quantumtheme');
		$contactForm2 = esc_attr__('Please provide a valid email address.', 'quantumtheme');
		$contactForm3 = esc_attr__('Please provide a subject line.', 'quantumtheme');
		$contactForm4 = esc_attr__('Please provide a message for your inquiry.', 'quantumtheme');
		
		/** Quick contact **/
		$quickContact1 = esc_attr__('Please provide your full name.', 'quantumtheme');
		$quickContact2 = esc_attr__('Please provide a valid email address.', 'quantumtheme');
		$quickContact3 = esc_attr__('Please provide a message for your inquiry.', 'quantumtheme');
		
		/** Registration form **/
		$reg1 = esc_attr__('Please provide your name.', 'quantumtheme');
		$reg2 = esc_attr__('Please provide a valid email address.', 'quantumtheme');
		$reg3 = esc_attr__('Please enter a username.', 'quantumtheme');
		$reg4 = esc_attr__('Please enter a password for your account.', 'quantumtheme');
		$reg5 = esc_attr__('Security answer invalid. Please answer the security question correctly.', 'quantumtheme');
		$reg6 = esc_attr__('Your registration is complete! You can now proceed to login.', 'quantumtheme');
		$reg7 = esc_attr__('A system error has occurred, please try again.', 'quantumtheme');
		
		//Javascript Object	
		$wordpressOptionsArray = array( 
			'urlRoot' => home_url(),
			'templateDir' => get_template_directory_uri(),
			'stickyNav' => $enableStickyNav,
			'autoPlaySpeed' => $autoPlaySpeed,
			'slideSpeed' => $slideSpeed,
			'rewindSpeed' => $rewindSpeed,
			'ppAnimationSpeed' => $ppAnimationSpeed,
			'ppAutoPlay' => $ppAutoPlay,
			'ppShowTitle' => $ppShowTitle,
			'ppColorTheme' => $ppColorTheme,
			'ppSlideShowSpeed' => $ppSlideShowSpeed,
			'dropMenuIndicator' => $dropMenuIndicator,
			'securityError' => $securityError,
			'successMessage' => $successMessage,
			'failedMessage' => $failedMessage,
			'ajaxSearchResult' => $ajaxSearchResult,
			'fieldValidation' => $fieldValidation,
			'loginMessage' => $loginMessage,
			'loginMessageSuccess' => $loginMessageSuccess,
			'loginMessageInvalid' => $loginMessageInvalid,
			'contactForm1' => $contactForm1,
			'contactForm2' => $contactForm2,
			'contactForm3' => $contactForm3,
			'contactForm4' => $contactForm4,
			'quickContact1' => $quickContact1,
			'quickContact2' => $quickContact2,
			'quickContact3' => $quickContact3,
			'reg1' => $reg1,
			'reg2' => $reg2,
			'reg3' => $reg3,
			'reg4' => $reg4,
			'reg5' => $reg5,
			'reg6' => $reg6,
			'reg7' => $reg7,
			'pm_ln_ajax_url' => admin_url('admin-ajax.php'),
		);
		
		wp_enqueue_script('wordpressOptions', get_template_directory_uri() . '/js/wordpress.js');
		wp_localize_script( 'wordpressOptions', 'wordpressOptionsObject', $wordpressOptionsArray );

		
}

function pm_ln_register_custom_sidebars() {
		
	if (function_exists('register_sidebar')) {
		
		//DEFAULT TEMPLATE
		register_sidebar(array(
								
								'name' => esc_attr__('Default Template','quantumtheme'),
								'id' => 'default_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//HOMEPAGE
		register_sidebar(array(								
								
								'name' => esc_attr__('Home Page','quantumtheme'),
								'id' => 'homepage_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));

		//NEWS POSTS PAGE
		register_sidebar(array(
								'name' => esc_attr__('Blog Page','quantumtheme'),
								'id' => 'blogpage_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));


		//NEWS SINGLE POST PAGE
		register_sidebar(array(
								
								'name' => esc_attr__('Single Blog Post','quantumtheme'),
								'id' => 'singleblogpost_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//Woocommerce
		register_sidebar(array(
								'name' => esc_attr__('Woocommerce','quantumtheme'),
								'id' => 'woocomm_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		//Members Area
		register_sidebar(array(
								'name' => esc_attr__('Members','quantumtheme'),
								'id' => 'members_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="pm-widget-spacer">',
								'after_widget' => '</div></div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
				
		//FOOTER
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 1','quantumtheme'),
								'id' => 'footer_column1_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								
								'name' => esc_attr__('Footer Column 2','quantumtheme'),
								'id' => 'footer_column2_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 3','quantumtheme'),
								'id' => 'footer_column3_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		register_sidebar(array(
								'name' => esc_attr__('Footer Column 4','quantumtheme'),
								'id' => 'footer_column4_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		/*register_sidebar(array(
								'name' => esc_attr__('Login Template','quantumtheme'),
								'id' => 'login_page_widget',
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));*/
		
		register_sidebar(array(
								
								'name' => esc_attr__('Registration Template','quantumtheme'),
								'id' => 'registration_page_widget',
								'description'   => '',
								'class'         => '',
								'before_widget' => '<div id="%1$s" class="widget %2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));
		
		/*register_sidebar(array(
								'name' => esc_attr__('Forgot Password Template','quantumtheme'),
								'id' => 'forgot_password_widget',
								'before_widget' => '<div id="%1$s" class="%2$s">',
								'after_widget' => '</div>',
								'before_title' => '<h6>',
								'after_title' => '</h6>',
		));*/
		
	}//end of if function_exists
	
}//end of pm_ln_register_custom_sidebars

//localization support
function pm_ln_localization_setup() {
	// Retrieve the directory for the localization files
	$lang_dir = get_template_directory() . '/languages';
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('quantumtheme', $lang_dir);
} // end custom_theme_setup


//Custom Pagination - http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
function pm_ln_kriesi_pagination($pages = '', $range = 2){
	
	 $showitems = ($range * 2)+1;

	 global $paged;
	 if(empty($paged)) $paged = 1;

	 if($pages == '')
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
			 $pages = 1;
		 }
	 }

	 if(1 != $pages){
		 
		 echo '<div class="pm-pagination-page-counter"><p>Page '. $paged .' of '. $pages .'</p></div>';
		 
		 echo "<ul class='pm-pagination clearfix reset-pulse-sizing'>";
		 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='button-small grey' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
		 if($paged > 1 && $showitems < $pages) echo "<li><a class='button-small-theme' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
				 echo ($paged == $i)? "<li class='current'><span class='current'>".$i."</span></li>":"<li class='inactive'><a class='inactive' href='".get_pagenum_link($i)."' >".$i."</a></li>";
			 }
		 }

		 if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
		 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
		 
	 }
	 
	 $args = array(
		'before'           => '<li>' . esc_attr__('Pages:', 'quantumtheme'),
		'after'            => '</li>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => esc_attr__('Next page', 'quantumtheme'),
		'previouspagelink' => esc_attr__('Previous page', 'quantumtheme'),
		'pagelink'         => '%',
		'echo'             => 1
	);
	
	echo "</ul>\n";
}


/*** Theme Customizer CSS ****/
function pm_ln_customizer_css(){ 
?>
        <style type="text/css">
		<?php
					
			//Header Options & Colors
			$mainNavColor = get_option('mainNavColor',  '#FFFFFF');
			$mainNavColors = pm_ln_hex2rgb($mainNavColor); //Array of colors R,G,B
			
			$mainMenuBGOpacity = get_theme_mod('mainMenuBGOpacity', 100);
			$finalMainMenuBGOpacity = $mainMenuBGOpacity / 100;
			
			$mainNavBorderColor = get_option('mainNavBorderColor', '#e0e0e0');
			$mainMenuHoverColor = get_option('mainMenuHoverColor', '#DBC164');
			$subMenuBackgroundColor = get_option('subMenuBackgroundColor', '#295d84');
			$subMenuBackgroundColors = pm_ln_hex2rgb($subMenuBackgroundColor); //Array of colors R,G,B
			$subMenuOpacity = get_theme_mod('subMenuOpacity', 0);
			$finalSubMenuOpacity = $subMenuOpacity / 100;
			
			$subpageHeaderBackgroundColor = get_option('subpageHeaderBackgroundColor', '#666666');
			$pageTitleBackgroundColor = get_option('pageTitleBackgroundColor', '#000000');
			$pageTitleBackgroundColors = pm_ln_hex2rgb($pageTitleBackgroundColor); //Array of colors R,G,B
			$navButtonColor = get_option('navButtonColor', '#f6f6f6');
			$navBorderColor = get_option('navBorderColor', '#e0e0e0');
			$registerButtonColor = get_option('registerButtonColor', '#dbc164');
			$registerBorderColor = get_option('registerBorderColor', '#987e23');
			$loginButtonColor = get_option('loginButtonColor', '#6cb9f3');
			$loginButtonBorderColor = get_option('loginButtonBorderColor', '#0a8bec');
			$dropMenuIcon = get_theme_mod('dropMenuIcon', 'f0da');
			
			//Footer Options & Colors
			$socialIconColor = get_option('socialIconColor', '#467192');
			$newsletterFieldColor = get_option('newsletterFieldColor', '#467192');
			$footerWidgetTitleColor = get_option('footerWidgetTitleColor', '#467192');
			$footerWidgetTitleIconColor = get_option('footerWidgetTitleIconColor', '#DBC164');
			$fatFooterBackgroundColor = get_option('fatFooterBackgroundColor', '#273D4C');
			$fatFooterBackgroundImage = get_theme_mod('fatFooterBackgroundImage');
			$footerBackgroundColor = get_option('footerBackgroundColor', '#FFFFFF');
			$footerNavBackgroundColor = get_option('footerNavBackgroundColor', '#273D4C');
			$returnToTopIcon = get_theme_mod('returnToTopIcon', 'f077');
			$fatFooterPadding = get_theme_mod('fatFooterPadding', 60);
			
			//Global Options & Colors
			$pageBackgroundImage = get_theme_mod('pageBackgroundImage');
			$repeatBackground = get_theme_mod('repeatBackground', 'repeat');
			$pageBackgroundColor = get_option('pageBackgroundColor', '#FFFFFF');
			$primaryColor = get_option('primaryColor', '#DBC164');
			$secondaryColor = get_option('secondaryColor', '#2B5C84');
			$secondaryColors = pm_ln_hex2rgb($secondaryColor); //Array of colors R,G,B
			$dividerColor = get_option('dividerColor', '#e3e3e3');
			$tooltipColor = get_option('tooltipColor', '#333333');
			$sidebarBorderImage = get_theme_mod('sidebarBorderImage');
			$blockQuoteColor = get_option('blockQuoteColor', '#dbc164');
			$commentBoxColor = get_option('commentBoxColor', '#f6f6f6');
			$commentShareBoxColor = get_option('commentShareBoxColor', '#adadad');
			$globalButtonBorderColor = get_option('globalButtonBorderColor', '#d9d9d9');
			$globalButtonBackgroundColor = get_option('globalButtonBackgroundColor', '#FFFFFF');
			
			//Post Options & Colors
			$postTitleBGColor = get_option('postTitleBGColor', '#000000');
			$postTitleBGColors = pm_ln_hex2rgb($postTitleBGColor); //Array of colors R,G,B
			$postDateBGColor = get_option('postDateBGColor', '#dbc164');
			$postExcerptDividerColor = get_option('postExcerptDividerColor', '#e9e9e9');	
			$postNavigationButtonColor = get_option('postNavigationButtonColor', '#000000');	
			$postNavigationButtonColors = pm_ln_hex2rgb($postNavigationButtonColor); //Array of colors R,G,B
			$postNavigationBorderColor = get_option('postNavigationBorderColor', '#ededed');	
			$postImageBorderColor = get_option('postImageBorderColor', '#ededed');
			
			//Presentation Options & Colors
			$presentationImage = get_theme_mod('presentationImage');
			$textBackgroundColor = get_option('textBackgroundColor', '#000000');
			$textBackgroundColors = pm_ln_hex2rgb($textBackgroundColor); //Array of colors R,G,B
			$buttonColor = get_option('buttonColor', '#000000');
			$buttonColors = pm_ln_hex2rgb($buttonColor); //Array of colors R,G,B
			$buttonBorderColor = get_option('buttonBorderColor', '#cccccc');
			$titleBackgroundColor = get_option('titleBackgroundColor', '#2b5d83');
			$excerptBackgroundColor = get_option('excerptBackgroundColor', '#000000');
			$excerptBackgroundColors = pm_ln_hex2rgb($excerptBackgroundColor); //Array of colors R,G,B
			$dateBackgroundColor = get_option('dateBackgroundColor', '#DBC164');
			
			//Shortcode options
			$testimonials_quote_color = get_option('testimonials_quote_color', '#273D4C');
			$quote_box_color = get_option('quote_box_color', '#E8F1F9');
			$data_table_title_color = get_option('data_table_title_color', '#DBC164');
			$data_table_info_color = get_option('data_table_info_color', '#E8E8E8');
			$statBox1_bg_color = get_option('statBox1_bg_color', '#283E4E');
			$staff_profile_bg_color = get_option('staff_profile_bg_color', '#F5F5F5');
			$progress_bar_color = get_option('progress_bar_color', '#DBC164');
			
			//Shortcode options
			$course_excerpt_bg_color = get_option('course_excerpt_bg_color', '#F8F8F8');
			$course_details_btn_color = get_option('course_details_btn_color', '#bbbbbb');
			
			//Workshop options
			$title_bg_color = get_option('title_bg_color', '#F8F8F8');
			$view_details_btn_color = get_option('view_details_btn_color', '#bbbbbb');
			
			//Career options
			$date_posted_bg_color = get_option('date_posted_bg_color', '#F6F6F6');
			
			//Quick Login options
			$quickLoginBackgroundColor = get_option('quickLoginBackgroundColor', '#2a3a47');
			$submitButtonColor = get_option('submitButtonColor', '#DBC164');
			$submitButtonBorderColor = get_option('submitButtonBorderColor', '#987e23');
			$activatorButtonColor = get_option('activatorButtonColor', '#6cb9f3');
			$activatorBorderColor = get_option('activatorBorderColor', '#0a8bec');
			$notificationBackgroundColor = get_option('notificationBackgroundColor', '#333333');
			$notificationBorderColor = get_option('notificationBorderColor', '#e5e5e5');
			$quickLoginBackgroundImage = get_theme_mod('quickLoginBackgroundImage');
			$notificationPosition = get_theme_mod('notificationPosition', 35);
			
			//Micro slider options
			$textAreaHeight = get_theme_mod('textAreaHeight', 335); 
			$textAreaPosition = get_theme_mod('textAreaPosition', 25);
			
			
			//***** Apply styles here *****//
						
			echo '
			
				.pm-presentation-text-container {
					height: '. $textAreaHeight .';
					top:'. $textAreaPosition .'%;	
				}
			
				.pm-header-info {	
					background-color:rgba('.$subMenuBackgroundColors[0].','.$subMenuBackgroundColors[1].','.$subMenuBackgroundColors[2].','.$finalSubMenuOpacity.');	
				}
			
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
					background-color:'. $secondaryColor .';	
				}
				
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
					background-color:'. $primaryColor .';		
				}
				
				.comment-body {
					border-bottom: 1px solid '.$dividerColor.';
				}

				.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th {
					border-top: 1px solid '.$dividerColor.';	
				}
			
				.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
					border-top: 1px solid '.$dividerColor.';
				}
				
				.woocommerce .woocommerce-ordering select {
					border: 1px solid '.$dividerColor.';
				}
				
				.woocommerce #reviews #comment {
					border:1px solid '.$dividerColor.';
				}
				
				.input-text.qty.text {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce #reviews #comments ol.commentlist li .comment-text {
					border: 1px solid '.$dividerColor.';	
				}
				
				.woocommerce div.product form.cart .variations select {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce table.shop_table td {
					border-top:1px solid '.$dividerColor.';	
				}
				
				.woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
					border:1px solid '.$dividerColor.';	
				}
				
				.woocommerce form .form-row select {
					border:1px solid '.$dividerColor.';
				}	
				
				.woocommerce span.onsale {
					background-color:'. $secondaryColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $secondaryColor .';
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a {
					background-color: '. $secondaryColor .' !important;	
				}
				
				.woocommerce .star-rating span {
					color:'. $secondaryColor .';	
				}
				
				.woocommerce p.stars a {
					color:'. $secondaryColor .';	
				}
				
				.woocommerce-review-link {
					color:'. $secondaryColor .';	
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
					background-color:'. $secondaryColor .';
					color:white;	
				}
				
				.woocommerce-info::before {
					color: '. $secondaryColor .';
				}
				
				.woocommerce-error::before {
					color: '. $secondaryColor .';
				}

				.woocommerce form .form-row.woocommerce-invalid .select2-container, .woocommerce form .form-row.woocommerce-invalid input.input-text, .woocommerce form .form-row.woocommerce-invalid select {
					border-color: '. $secondaryColor .';
				}
				
				.woocommerce form .form-row.woocommerce-invalid label {
					color: '. $secondaryColor .';	
				}
				
				.woocommerce form .form-row .required {
					color:'. $secondaryColor .';
				}
				
				.woocommerce a.remove {
					background-color: '. $secondaryColor .';
					color: white !important;
				}
				
				.woocommerce-error, .woocommerce-info, .woocommerce-message {
					border-top:3px solid '. $secondaryColor .';
				}
				
				.woocommerce-message::before {
					color:'. $secondaryColor .';
				}
				
				.woocommerce ul.products li.product .price {
					color:'. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
					background-color: '. $secondaryColor .';
					color: #fff;
				}
				
				.product_meta > span > a:hover {
					color: '. $secondaryColor .';
				}
				
				.woocommerce div.product form.cart .reset_variations:hover {
					background-color: '. $secondaryColor .';
				}
				
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background-color: '. $secondaryColor .' !important;	
					color:white !important;
				}
				
				.woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select {
					border-color:'. $secondaryColor .';
				}				
				
				.page-numbers.current {
					background-color: '.$primaryColor.';
					color:white !important;	
				}
				
				a.page-numbers:hover {
					background-color: '.$primaryColor.' !important;
					color:white !important;		
				}
				
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					background-color: '.$primaryColor.';	
				}
				
				.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
					background-color: '.$primaryColor.';
				}
				
				.product_meta > span > a {
					color: '.$primaryColor.';
				}
				
				.woocommerce div.product .woocommerce-tabs ul.tabs li {
					background-color: '.$primaryColor.';
					
				}
				
				.woocommerce #reviews #comment:focus {
					background-color:'.$primaryColor.';
				}
				
				.woocommerce div.product form.cart .reset_variations {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt[disabled]:disabled, .woocommerce #respond input#submit.alt[disabled]:disabled:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt[disabled]:disabled, .woocommerce a.button.alt[disabled]:disabled:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt[disabled]:disabled, .woocommerce button.button.alt[disabled]:disabled:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt[disabled]:disabled, .woocommerce input.button.alt[disabled]:disabled:hover {
					background-color:'.$primaryColor.';
				}
				
				.woocommerce a.remove:hover {
					background-color: '.$primaryColor.';
				}
				
				.woocommerce form .form-row input.input-text:focus, .woocommerce form .form-row textarea:focus {
					border:1px solid '.$primaryColor.';	
					background-color:'.$primaryColor.';
				}
				
				.woocommerce div.product p.price, .woocommerce div.product span.price {
					color:'. $primaryColor .';	
				}	
			
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
					background-color:'. $primaryColor .' !important;	
				}
				
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
					background-color:'. $secondaryColor .';	
				}
			
				.woocommerce .woocommerce-breadcrumb a:hover, .breadcrumbs li a:hover {
					color: '. $secondaryColor .';
					text-decoration:none !important;
				}
			
				
				.comment-reply-link:hover {
					border:3px solid '.$secondaryColor.';
					background-color:'.$secondaryColor.';
				}
				
				.pm-column-border {
					border-top:5px solid '.$primaryColor.';	
				}
				
				header {
					background-color:rgba('.$mainNavColors[0].','.$mainNavColors[1].','.$mainNavColors[2].','.$finalMainMenuBGOpacity.');	
					border-bottom: 1px solid '. $mainNavBorderColor .';	
    				border-top: 1px solid '. $mainNavBorderColor .';	
				}
				.sf-menu a:hover {
					color:'.$mainMenuHoverColor.';	
				}
				
				.sf-menu ul li a:before {
					color:'.$primaryColor.'!important;	
					content:"\\'.$dropMenuIcon.'";
				}
				
				.pm-dropdown.pm-language-selector-menu .pm-dropmenu i {
					color:'.$primaryColor.' !important;	
				}
				
				.pm-textfield:focus, .pm-textarea:focus, input[id="author"]:focus, input[id="email"]:focus, input[id="url"]:focus, input[id="username"]:focus, input[id="billing_email"]:focus, input[id="billing_phone"]:focus, input[id="password"]:focus, input[id="account_password"], .woocommerce-billing-fields input[type="text"]:focus, .pm-form-textfield:focus, .pm-form-textarea:focus,  #user_login:focus, #user_pass:focus, .registration-form input[type="text"]:focus, .registration-form input[type="password"]:focus, .registration-form input[type="email"]:focus {
					background-color:'.$secondaryColor.' !important;		
					background-image:none !important;
					color:white !important;
				}
				.pm-members-nav-container {
					border: 1px solid '. $mainNavBorderColor .';
				}
				.pm-members-navigation li {
					border-left: 1px solid '. $navBorderColor .';
					background-color: '.$navButtonColor.';
				}
				.pm-sub-header-container {
					background-color:'. $subpageHeaderBackgroundColor .';	
				}
				.pm-sub-header-title-container {
					background-color:rgba('. $pageTitleBackgroundColors[0] .', '. $pageTitleBackgroundColors[1] .', '. $pageTitleBackgroundColors[2] .', 0.4);	
				}
				.sf-menu li, .sf-menu ul li, .pm-language-selector-menu .pm-dropmenu-active ul li {
					background-color: '.$navButtonColor.';	
				}
				
				.sf-menu li:hover {
					background-color:'.$navButtonColor.' !important;	
				}
				
				.pm-language-selector-menu .pm-dropmenu-active ul li a:hover {
					color:'.$primaryColor.';
				}		
				
				.pm-register-btn {
					background-color: '.$registerButtonColor.';
   					border: 1px solid '.$registerBorderColor.';	
				}
				.pm-login-btn {
					background-color: '.$loginButtonColor.';
					border: 1px solid '.$loginButtonBorderColor.';
				}
				#pm-search-btn {
					background-color: '.$loginButtonColor.';
					border: 1px solid '.$loginButtonBorderColor.';	
				}
								
				
			';
			
			//Quick login options colors					
			echo '
				#btn-quick-login {
					background-color: '.$submitButtonColor.';
    				border: 1px solid '.$submitButtonBorderColor.';	
				}
				#pm-quick-login-btn {
					background-color: '.$activatorButtonColor.';
					border: 1px solid '.$activatorBorderColor.';
				}
				.pm-quick-login-message {
					background-color: '.$notificationBackgroundColor.';
					border: 1px solid '.$notificationBorderColor.';
					top:'.$notificationPosition.'px;	
				}
			';
			
			if(!empty($quickLoginBackgroundImage)){
				echo '
					.pm-quick-login-container {
						background-image:url('.$quickLoginBackgroundImage.');
						background-color: '.$quickLoginBackgroundColor.';	
					}
				';
			} else {
				echo '
					.pm-quick-login-container {
						background-color: '.$quickLoginBackgroundColor.';	
					}
				';
			}
			
			
			//Footer Options Colors
			if( !empty($fatFooterBackgroundImage) ){
				echo '
					.pm-fat-footer {
						background-color: '.$fatFooterBackgroundColor.';	
						background-image:url("'.$fatFooterBackgroundImage.'");	
						padding:'.$fatFooterPadding.'px 0;
					}	
				';
			} else {
				echo '
					.pm-fat-footer {
						background-color: '.$fatFooterBackgroundColor.';	
						padding:'.$fatFooterPadding.'px 0;
					}	
				';
			}
			
			echo '
				.pm-footer-social-icons li a i {
					background-color: '.$socialIconColor.';	
				}
				.pm-footer-social-icons li a:hover i {
					background-color: '.$primaryColor.';	
				}
				.pm-footer-subscribe-field {
					background-color: '.$newsletterFieldColor.';	
				}
				.pm-fat-footer h6 {
					background-color: '.$footerWidgetTitleColor.';		
				}
				.pm-fat-footer h6 i {
					background-color: '.$footerWidgetTitleIconColor.';			
				}
				
				footer {
					background-color: '.$footerBackgroundColor.';	
				}
				.pm-footer-copyright {
					background-color: '.$footerNavBackgroundColor .';	
				}
								
				
			';
			
			echo "
				#back-top:before {
					content:'\\$returnToTopIcon' !important;
				}
			";
			
			//Global Options Colors
			
			if($pageBackgroundImage !== ''){
				
				echo '
					body {
						background-color: '.$pageBackgroundColor.';	
						background-repeat: '.$repeatBackground.';
						background-image:url("'.$pageBackgroundImage.'");
					}
				';
					
			} else {
				
				echo '
					body {
						background-color: '.$pageBackgroundColor.';		
						background-repeat: '.$repeatBackground.';
					}
				';
					
			}
			
			echo '
				.pm-sidebar .tagcloud a, .pm-rounded-btn a {
					background-color: '.$globalButtonBackgroundColor.';
    				border: 3px solid '.$globalButtonBorderColor.';	
				}
				.pm-rounded-submit-btn, #submit, #wp-submit  {
					background-color: '.$globalButtonBackgroundColor.';
    				border: 3px solid '.$globalButtonBorderColor.';		
				}
				
				.comment-reply-link {
					background-color: '.$globalButtonBackgroundColor.';
    				border: 3px solid '.$globalButtonBorderColor.';			
				}
				
				.remove:hover {
					background-color: '.$secondaryColor.';
					color:white !important;
				}
				
				.quantity .qty {
					border:1px solid '.$dividerColor.';
					color:grey !important;
				}
				
				.pm-pagination li {
					border: 1px solid '.$dividerColor.';	
				}
				.related.products {
					border-top: 1px solid '.$dividerColor.';
				}
				.pm-returning-customer {
					border: 1px solid '.$dividerColor.';
				}
				.pm_paginated-posts, .pm-single-blog-post-categories-container {
					border-top: 3px solid '.$dividerColor.';
				}
				.pm-textfield, input[id="author"], input[id="email"], input[id="url"], input[id="username"], input[id="password"], input[id="account_password"], .woocommerce-billing-fields input[type="text"] {
					border: 1px solid '.$dividerColor.';	
				}
				.widget_recent_entries .pm-widget-spacer ul li {
					border-bottom: 1px solid '.$dividerColor.';
				}
				
				.pm-comment-form-textfield, .pm-comment-form-textarea, .pm-comment-html-tags, .pm-comment-box-container, .pm-single-blog-post-author-box,.pm-textfield, .pm-form-textfield-with-icon, .pm-dropmenu, .pm-blog-post-container  {
					border:1px solid '.$dividerColor.';
				}
				.pm-dropmenu-active ul {
					border-bottom: 1px solid '.$dividerColor.';
					border-left: 1px solid '.$dividerColor.';
					border-right: 1px solid '.$dividerColor.';	
				}
				.pm-revised-schedules-ul li, .pm-sidebar-popular-posts li {
					border-bottom: 1px solid '.$dividerColor.';	
				}
				.pm-comment-box-avatar-container {
					border-bottom: 1px solid '.$dividerColor.';	
					background-color: '.$commentBoxColor.';	
				}
				.comment-author.vcard {
					border-bottom: 1px solid '.$dividerColor.';	
					background-color: '.$commentBoxColor.';	
				}
				#pm_marker_tooltip {
					background-color:'.$tooltipColor.';	
				}
				#pm_marker_tooltip.pm_tip_arrow_top:after {
					border-top: 6px solid '.$tooltipColor.';
				}
				#pm_marker_tooltip.pm_tip_arrow_bottom:after {
					border-bottom: 8px solid '.$tooltipColor.';	
				}
				.pm-sidebar .pm-widget h6, .pm-sidebar .woocommerce h6, .pm-sidebar .pm_widget h6  {
					background-image:url('.$sidebarBorderImage.');
					background-position: left bottom;
    				background-repeat: no-repeat;
				}
				blockquote {
					border-color: '.$dividerColor.' '.$dividerColor.' '.$dividerColor.' '.$blockQuoteColor.';
				}
				.pm-sidebar-search-container {
					border:1px solid '.$dividerColor.';
				}
				.widget_shopping_cart_content .total, .product_list_widget li {
					border-bottom: 1px solid '.$dividerColor.';
				}
				.pm-single-blog-post-author-box {
					background-color: '.$commentBoxColor.';	
				}
				.pm-single-blog-post-author-box-share {
					background-color: '.$commentShareBoxColor.';		
				}
				#back-top {
					border-color: transparent '.$primaryColor.' '.$primaryColor.' transparent;
    				border-right: 35px solid '.$primaryColor.';
				}
				#pm-quick-message-close {
					background-color:'.$primaryColor.' !important;			
				}
				.pm-main-menu-btn i {
					color:'.$primaryColor.';		
				}
				.pm-sub-header-breadcrumbs-ul p {
					color:'.$primaryColor.';	
				}
				.woocommerce-breadcrumb li a:hover {
					color:'.$primaryColor.' !important;		
				}
				.pm-footer-subscribe-submit-btn {
					background-color:'.$primaryColor.';		
				}
				.pm-quantum-alert-title {
					color:'.$secondaryColor.';	
				}
				.pm-gallery-item-title {
					background-color:'.$secondaryColor.';	
				}
				.pm-gallery-item-hover-btn {					
					border-right:35px solid '.$primaryColor.';
					border-top:35px solid transparent;
					border-left:35px solid transparent;
					border-bottom:35px solid '.$primaryColor.';
				}
				.pm-gallery-item-btns li a { 
					background-color:'.$primaryColor.';	
				}
				.pm-widget-footer .tagcloud a:hover {
					background-color:'.$secondaryColor.' !important;
					border:3px solid '.$secondaryColor.';
				}
				#tab-description ul li:before, ul li:before {
					color:'.$secondaryColor.';
				}
				.pm-workshop-newsletter-form-container input[type="text"] {
					color:'.$secondaryColor.';
				}
				.panel-default > .panel-heading {
					background-color: '.$secondaryColor.';
				}
				.panel-title i {
					background-color: '.$primaryColor.';
				}
				.pm-workshop-newsletter-submit-btn {
					background-color:'.$primaryColor.';		
				}
				.pm-course-post-title-box {
					background-color:'.$secondaryColor.';		
				}
				.pm-comment-form-textfield:focus, .pm-comment-form-textarea:focus, #comment:focus {
					background-color:'.$secondaryColor.';
					color:white !important;
				}
				#comment, .form-allowed-tags {
					border: 1px solid '.$dividerColor.';
				}
				select {
					border: 1px solid '.$dividerColor.';
				}
				.pm-divider {
					background-color: '.$dividerColor.';
				}
				.pm-sidebar .widget_meta ul li, .pm-sidebar .widget_categories ul li, .pm-sidebar .widget_archive ul li, .pm-sidebar #recentcomments li {
					border-bottom: 1px solid '.$dividerColor.';
				}
				.pm-sidebar .tagcloud a:hover {
					border:3px solid '.$secondaryColor.';
					background-color:'.$secondaryColor.';
				}
				.pm-course-post-title-box i {
					background-color:'.$primaryColor.';		
				}
				.pm-testimonial-container:before {
					border-right:10px solid '.$primaryColor.';	
				}
				.pm-testimonial-container {
					background-color:'.$primaryColor.';	
				}
				.pm-parnters-post-featured {
					background-color:'.$primaryColor.';	
				}
				.pm-workshop-widget-post i, .pm-career-opening-widget-post i {
					background-color:'.$primaryColor.';			
				}
				.pm-testimonial-name {
					color:'.$primaryColor.';	
				}
				
				.pm_quick_contact_submit {
					background-color:'.$primaryColor.';		
				}
				.pm-career-post-icon {
					background-color:'.$primaryColor.';		
				}				
				.pm-primary {
					color:'.$primaryColor.';			
				}
				.pm-secondary {
					color:'.$secondaryColor.';		
				}
				.pm-parnters-post-url a:hover {
					background-color: '.$secondaryColor.' !important;
				}
				.pm-staff-profile-icons li a:hover {
					background-color: '.$secondaryColor.' !important;
				}
				.pm-workshop-post-icon {
					background-color:'.$primaryColor.';		
				}
				.pm-workshop-post-title-container {
					background-color:'.$secondaryColor.';			
				}
				.flex-direction-nav a {
					background-color:'.$primaryColor.';	
				}
				.pm-sub-header-breadcrumbs-ul li:last-child {
					color:'.$primaryColor.';
				}
				.pm-icon-bundle i {
					color:'.$secondaryColor.';
				}
				.pm-icon-bundle:hover {
					background-color:'.$primaryColor.';
    				border-color: '.$primaryColor.' !important;	
				}
				.pm-rounded-btn.transparent a:hover {
					color: '.$secondaryColor.' !important;
					background-color:transparent !important;	
   					border: 3px solid transparent !important;	
				}
				.pm-icon-bundle-content p a {
					color:'.$secondaryColor.';
				}
				.pm-pricing-table-header i {
					color:'.$secondaryColor.';
				}
				.pm-single-workshop-post-left-column i {
					background-color:'.$primaryColor.';		
				}
				.pm-single-blog-post-author-details .author-name span {
					color:'.$secondaryColor.';
				}
				.pm-workshop-post-button-container:hover {
					background-color:'.$secondaryColor.' !important;	
				}
				.recentcomments {
					color:'.$secondaryColor.';	
				}
				#wp-calendar tbody td:hover {
					background-color:'.$primaryColor.' !important;
				}
				
				.pm-sidebar-search-icon-btn {
					color:'.$secondaryColor.';	
				}
				.pm-fat-footer .pm-workshop-widget-post a:hover {
					color:'.$primaryColor.' !important;
				}
				.pm-workshop-widget-post p {
					color:'.$primaryColor.';		
				}
				.quantity .minus, .quantity .plus {
					background-color:'.$primaryColor.';	
				}
				
				.quantity .minus:hover, .quantity .plus:hover {
					background-color:'.$secondaryColor.' !important;
					color:white !important;
				}
				
				.posted_in i, .tagged_as i {
					color:'.$primaryColor.';		
				}
				
				.widget_recent_entries .pm-widget-spacer ul li a:before {
					color:'.$secondaryColor.' !important;			
				}
				.pm-staff-profile-name {
					color:'.$secondaryColor.';	
				}
				.pm-rounded-btn a:hover {
					border:3px solid '.$secondaryColor.';
					background-color:'.$secondaryColor.';
				}
				.pm-rounded-btn a.current {
					border:3px solid '.$secondaryColor.';
					background-color:'.$secondaryColor.';	
					color:white;
				}
				.pm-isotope-filter-system-expand {
					background-color: '.$primaryColor.';	
					color:white;
				}
				.pm-rounded-submit-btn:hover, #submit:hover, input[type=submit]:hover, #wp-submit:hover, #btn-register-user:hover {
					border:3px solid '.$secondaryColor.';
					background-color:'.$secondaryColor.';
				}
				.pm-product-social-icons li a, .pm-page-social-icons li a {
					background-color:'.$primaryColor.';	
				}
				.pm-product-social-icons li a:hover, .pm-page-social-icons li a:hover {
					background-color:'.$secondaryColor.' !important;	
				}
				.pm-page-share-options {
					border-top: 1px solid '.$dividerColor.';	
				}
				.pm-single-workshop-title {
					color:'.$secondaryColor.';
				}
				.pm-single-course-title {
					color:'.$secondaryColor.';
				}
				.pm-single-course-price, .price {
					color:'.$secondaryColor.';	
				}
				.pm-career-post-details-box .title {
					color:'.$secondaryColor.';		
				}
				.pm-career-post-date-posted-box .date, .pm-career-post-date-posted-box .year {
					color:'.$secondaryColor.';	
				}
				.pm-search-container {
					background-color:rgba('.$secondaryColors[0].', '.$secondaryColors[1].', '.$secondaryColors[2].', 0.95);	
				}
				.pm-search-submit {
					color:'.$primaryColor.';
				}
				.pm_quick_contact_field.Dark:focus, .pm_quick_contact_textarea.Dark:focus, .pm_quick_contact_field.Light:focus, .pm_quick_contact_textarea.Light:focus {
					background-color:'.$secondaryColor.' !important;	
					color:white !important;
				}
				.pm_quick_contact_field.Light, .pm_quick_contact_textarea.Light {
					border:1px solid '.$dividerColor.';
				}
				.pm-primary-bg {
					background-color:'.$primaryColor.';	
				}
				.pm-secondary-bg {
					background-color:'.$secondaryColor.' !important;	
				}
				
			';
			
			//Post Options Colors
			echo '
				.pm-single-blog-post-title, .pm-blog-post-title {
					background-color:rgba('. $postTitleBGColors[0] .', '. $postTitleBGColors[1] .', '. $postTitleBGColors[2] .', 0.7);	
				}
				.pm-blog-post-date, .pm-single-blog-post-date {
					background-color:'.$postDateBGColor.';	
				}
				.pm-blog-post-divider {
					background-color:'.$postExcerptDividerColor.';		
				}
				.pm-sub-header-post-pagination-ul .prev a, .pm-sub-header-post-pagination-ul .next a {
					background-color: rgba('.$postNavigationButtonColors[0].', '.$postNavigationButtonColors[1].', '.$postNavigationButtonColors[2].', 0.7);
					border: 1px solid '.$postNavigationBorderColor.';
					color: '.$postNavigationBorderColor.';	
				}
				.pm-single-blog-post-img-container {
					border:10px solid '.$postImageBorderColor.';
				}
				
			';
			
			//Presentation Options Colors
			if($presentationImage !== ''){
				echo '
					.pm-presentation-container {
						background-image:url("'.$presentationImage.'");	
					}
				';
			} else {
				echo '
				.pm-presentation-container {
						background-image:url("'.get_template_directory_uri().'/img/home/presentation_background.jpg");	
				}
				';	
			}
			
			echo '
				
				.pm-presentation-text-container {
					background-color:rgba('. $textBackgroundColors[0] .', '. $textBackgroundColors[1] .', '. $textBackgroundColors[2] .', 0.4);
				}
				.pm-presentation-posts .owl-controls .owl-buttons div {
					background-color:rgba('. $buttonColors[0] .', '. $buttonColors[1] .', '. $buttonColors[2] .', 0.7);	
					border: 1px solid '.$buttonBorderColor.';
				}
				.pm-presentation-post-title {
					background-color:'.$titleBackgroundColor.';	
				}
				.pm-presentation-post-excerpt {
					background-color:rgba('. $excerptBackgroundColors[0] .', '. $excerptBackgroundColors[1] .', '. $excerptBackgroundColors[2] .', 0.7);		
				}
				.pm-presentation-post-date {
					background-color:'.$dateBackgroundColor.';		
				}
				.pm-presentation-post-hover-container a {
					color:'.$dateBackgroundColor.';		
				}
			';
			
			//Shortcode options
			echo '
				.pm-single-testimonial-box {
					background-color:'.$quote_box_color.';	
				}
				.pm-single-testimonial-box:before {
					border-top: 8px solid '.$quote_box_color.';	
				}
				.pm-progress-bar .pm-progress-bar-outer {
					background-color:'.$progress_bar_color.';		
				}
				.pm-testimonial-text-box {
					background-color:'.$testimonials_quote_color.';
				}
				.pm-workshop-table-title {
					background-color:'.$data_table_title_color.';
				}
				.pm-workshop-table-content {
					background-color:'.$data_table_info_color.';	
				}
				.pm-statistic-box-container {
					background-color:'.$statBox1_bg_color.';	
				}
				.pm-staff-profile-container {
					background-color:'.$staff_profile_bg_color.';	
				}
			';
			
			//Woocommerce options
			echo '
				.pm-product-meta-info-container {
					background-color:'.$course_excerpt_bg_color.';	
				}
				.pm-course-post-button {
					background-color:'.$course_details_btn_color.';
				}
				.pm-course-post-button:hover {
					background-color:'.$secondaryColor.' !important;	
				}
			';
			
			//Workshop options
			echo '
				.pm-workshop-post-date-container {
					background-color:'.$title_bg_color.';	
				}
				.pm-workshop-post-button-container {
					background-color:'.$view_details_btn_color.';
				}
			';
			
			//Career options
			echo '
				.pm-career-post-date-posted-box, .pm-single-career-post-date-posted-box {
					background-color:'.$date_posted_bg_color.';	
				}
			';
			
			$displayNavBorders = get_theme_mod('displayNavBorders','on');
			
			if($displayNavBorders === 'off') :
			
				echo '
					.sf-menu li:first-child a {
						border:none !important;
					}
					.sf-menu a {
						border:none !important;
					}
					.sf-menu ul li a {
						border:none !important;
					}
					.sf-menu ul li:first-child a {
						border:none !important;
					}
					.sf-menu ul li:last-child a {
						border:none !important;
					}
					
				';
			
			endif;
			
			if($displayNavBorders === 'on') :
			
				echo '
					.sf-menu li:first-child a {
						border-left: 1px solid '.$navBorderColor.';
					}
					.sf-menu a {
						border-right: 1px solid '.$navBorderColor.';	
					}
					.sf-menu ul li a {
						border-bottom: 1px solid '.$navBorderColor.';
						border-left: 1px solid '.$navBorderColor.';
					}
					.sf-menu ul li:first-child a {
						border-top: 1px solid '.$navBorderColor.';
					}
					.sf-menu ul li:last-child a {
						border-bottom: 1px solid '.$navBorderColor.';
					}
				';
			
			endif;
			
			
			$displaySubHeader = get_theme_mod('displaySubHeader','on');
			
			if($displaySubHeader === 'off') :
			
				echo '
					header {
						position: relative;	
					}
				';
			
			endif;
			
			if(is_page()) {
				$get_pm_display_header_meta = get_post_meta(get_the_ID(), 'pm_display_header_meta', true); 
				$pm_display_header_meta = $get_pm_display_header_meta !== '' ? $get_pm_display_header_meta : 'on';//set a default value if none exists
			}
			
			if($pm_display_header_meta === 'off') :
			
				echo '
					header {
						position: relative;	
					}
				';
			
			endif;
			
			if( is_home() || is_front_page() ) :
			
				$enablePostSlider = get_theme_mod('enablePostSlider', 'yes');
				
				if( $enablePostSlider !== 'yes' ) :
				
					echo '
						header {
							position: relative;	
						}
					';
				
				endif;
			
			endif;
			
						
		 ?>
	</style>
    
    <?php
}


/* Cache customizer */
function pm_ln_customizer_styles_cache() {
	
	global $wp_customize;

	// Check we're not on the Customizer.
	// If we're on the customizer then DO NOT cache the results.
	if ( ! isset( $wp_customize ) ) {

		// Get the theme_mod from the database
		$data = get_theme_mod( 'my_customizer_styles', false );

		// If the theme_mod does not exist, then create it.
		if ( $data == false ) {
			// We'll be adding our actual CSS using a filter
			$data = apply_filters( 'my_styles_filter', null );
			// Set the theme_mod.
			set_theme_mod( 'my_customizer_styles', $data );
		}

	// If we're not on the customizer, get all the styles using our filter
	} else {

		$data = apply_filters( 'my_styles_filter', null );

	}

	// Add the CSS inline.
	// Please note that you must first enqueue the actual 'my-styles' stylesheet.
	// See http://codex.wordpress.org/Function_Reference/wp_add_inline_style#Examples
	wp_add_inline_style( 'pm-ln-customizer-css', $data );

}


/* Reset the cache when saving the customizer */
function pm_ln_reset_style_cache_on_customizer_save() {
	remove_theme_mod( 'my_customizer_styles' );
}