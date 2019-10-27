<?php

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class PM_LN_Customizer {
	
	public static function register ( $wp_customize ) {
		
		/*** Remove default wordpress sections ***/
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('header_image');
				
		/**** Google Options ****/
		$wp_customize->add_section( 'google_options' , array(
			'title'    => esc_html__( 'Google Options', 'quantumtheme' ),
			'priority' => 1,
		));
		
		$wp_customize->add_setting(
			'googleAPIKey', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr'
			)
		);

		$wp_customize->add_control(
			'googleAPIKey',
			 array(
				'label' => esc_html__( 'API KEY', 'quantumtheme' ),
			 	'section' => 'google_options',
				'description' => __('Insert your Google API key (browser key) to activate Google services such as Google Maps and Google Places.', 'quantumtheme'),
				'priority' => 1,
			 )
		);
		
		/**** Header Options ****/
		$wp_customize->add_section( 'header_options' , array(
			'title'    => esc_attr__( 'Header Options', 'quantumtheme' ),
			'priority' => 20,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'companyLogo', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'companyLogo', 
			array(
				'label'    => esc_attr__( 'Company Logo', 'quantumtheme' ),
				'section'  => 'header_options',
				'settings' => 'companyLogo',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage', 
			array(
				'label'    => esc_attr__( 'Global Header Image (Archive, Tag etc...)', 'quantumtheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage',
				'priority' => 2,
				) 
			) 
		);
		
		$wp_customize->add_setting( 'globalHeaderImage2', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'globalHeaderImage2', 
			array(
				'label'    => esc_attr__( 'Global Header Image (Pages and Posts)', 'quantumtheme' ),
				'section'  => 'header_options',
				'settings' => 'globalHeaderImage2',
				'priority' => 3,
				) 
			) 
		);
		
		$wp_customize->add_setting(
			'dropMenuIndicator', array(
				'default' => "fa-angle-down",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'dropMenuIndicator',
			 array(
				'label' => esc_attr__( 'Drop Menu Indicator', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 4,
			 )
		);
		
		$wp_customize->add_setting(
			'dropMenuIcon', array(
				'default' => "f0da",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'dropMenuIcon',
			 array(
				'label' => esc_attr__( 'Drop Menu Icon', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 5,
			 )
		);
		
		//Radio Options
		$wp_customize->add_setting('enableParallax', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableParallax', array(
			'label'      => esc_attr__('Enable sub-header parallax?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableParallax',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		
		$wp_customize->add_setting('enableStickyNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableStickyNav', array(
			'label'      => esc_attr__('Sticky Navigation', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableStickyNav',
			'priority' => 8,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
					
		$wp_customize->add_setting('enableBreadCrumbs', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableBreadCrumbs', array(
			'label'      => esc_attr__('Display Breadcrumbs?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableBreadCrumbs',
			'priority' => 9,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableRegistration', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableRegistration', array(
			'label'      => esc_attr__('Display Registration?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableRegistration',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableLogin', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableLogin', array(
			'label'      => esc_attr__('Display Login?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLogin',
			'priority' => 11,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSearch', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSearch', array(
			'label'      => esc_attr__('Display Search?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSearch',
			'priority' => 12,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableCTA', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableCTA', array(
			'label'      => esc_attr__('Display Call to action?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableCTA',
			'priority' => 13,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableSubMenu', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSubMenu', array(
			'label'      => esc_attr__('Display Sub Menu?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableSubMenu',
			'priority' => 14,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('enableLanguageSelector', array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableLanguageSelector', array(
			'label'      => esc_attr__('Display WPML Language selector?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'enableLanguageSelector',
			'priority' => 15,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displaySubHeader', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displaySubHeader', array(
			'label'      => esc_attr__('Display Sub-Header?', 'quantumtheme'),
			'section'    => 'header_options',
			'settings'   => 'displaySubHeader',
			'priority' => 16,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayNavBorders', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayNavBorders', array(
			'label'      => esc_attr__('Display Navigation borders?', 'quantumtheme'),
			'section'    => 'header_options',
			'priority' => 17,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		//Textfields
		$wp_customize->add_setting(
			'searchText', array(
				'default' => esc_attr__( 'Search News Posts', 'quantumtheme' ),
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'searchText',
			 array(
				'label' => esc_attr__( 'Search text', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 18,
			 )
		);
		
		$wp_customize->add_setting(
			'searchFieldText', array(
				'default' => esc_attr__( 'Type Keywords...', 'quantumtheme' ),
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'searchFieldText',
			 array(
				'label' => esc_attr__( 'Search field text', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 19,
			 )
		);
		
		$wp_customize->add_setting(
			'ctaText', array(
				'default' => esc_attr__( 'Get Started Today', 'quantumtheme' ),
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'ctaText',
			 array(
				'label' => esc_attr__( 'Call to Action text', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 20,
			 )
		);
		
		
		
		$wp_customize->add_setting(
			'registerButtonText', array(
				'default' => "Register",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'registerButtonText',
			 array(
				'label' => esc_attr__( 'Register Button Text', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 21,
			 )
		);
		
		
		
		$wp_customize->add_setting(
			'registerLink', array(
				'default' => "#",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'registerLink',
			 array(
				'label' => esc_attr__( 'Register Button Link', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 22,
			 )
		);
		
		
		$wp_customize->add_setting(
			'loginButtonText', array(
				'default' => "Login",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'loginButtonText',
			 array(
				'label' => esc_attr__( 'Login Button Text', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 23,
			 )
		);
		
		
		$wp_customize->add_setting(
			'loginLink', array(
				'default' => "#",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'loginLink',
			 array(
				'label' => esc_attr__( 'Login Button Link', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 24,
			 )
		);	
		
		$wp_customize->add_setting(
			'companyLogoURL', array(
				'default' => "",
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'companyLogoURL',
			 array(
				'label' => esc_attr__( 'Company Logo URL', 'quantumtheme' ),
			 	'section' => 'header_options',
				'priority' => 25,
			 )
		);	
		
		
		$wp_customize->add_setting( 'subMenuOpacity', array(
			'default' => 0,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'subMenuOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_attr__( 'Sub Menu Opacity', 'quantumtheme' ),
			'description' => esc_html__('Adjust the background opacity of the sub menu area. (Requires window refresh)', 'quantumtheme'),
			'priority' => 26,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'mainMenuBGOpacity', array(
			'default' => 100,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'mainMenuBGOpacity', array(
			'type' => 'range',
			'section' => 'header_options',
			'label'   => esc_attr__( 'Main Menu Opacity', 'quantumtheme' ),
			'description' => esc_html__('Adjust the background opacity of the main menu. (Requires window refresh)', 'quantumtheme'),
			'priority' => 27,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
				
		//Header Option Colors
		$headerOptionColors = array();
		
		$headerOptionColors[] = array(
			'slug'=>'mainNavColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Main Menu Background Color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the main navigation container.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mainNavBorderColor', 
			'default' => '#e0e0e0',
			'label' => esc_attr__('Main Menu Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the main navigation container.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'mainMenuHoverColor', 
			'default' => '#DBC164',
			'label' => esc_attr__('Main Menu hover Color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the hover color of the main navigation. (Requires window refresh)', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'subMenuBackgroundColor', 
			'default' => '#295d84',
			'label' => esc_attr__('Sub Menu Background Color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the sub-menu area. (Requires window refresh)', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'subpageHeaderBackgroundColor', 
			'default' => '#666666',
			'label' => esc_attr__('Subpage Header Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the sub-page header container.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'pageTitleBackgroundColor', 
			'default' => '#000000',
			'label' => esc_attr__('Page Title Background Color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the page title. (Requires window refresh)', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navButtonColor', 
			'default' => '#f6f6f6',
			'label' => esc_attr__('Navigation button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the button color of the main navigation.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'navBorderColor', 
			'default' => '#e0e0e0',
			'label' => esc_attr__('Navigation Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the main navigation. Only applies if the navigation borders are enabled.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'registerButtonColor', 
			'default' => '#dbc164',
			'label' => esc_attr__('Register / Sign out Button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the register and sign out buttons.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'registerBorderColor', 
			'default' => '#987e23',
			'label' => esc_attr__('Register / Sign out Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the register and sign out buttons.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'loginButtonColor', 
			'default' => '#6cb9f3',
			'label' => esc_attr__('Login / Search / Account Button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the login button.', 'quantumtheme'),
		);
		$headerOptionColors[] = array(
			'slug'=>'loginButtonBorderColor', 
			'default' => '#0a8bec',
			'label' => esc_attr__('Login / Search / Account Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the login button.', 'quantumtheme'),
		);
		
		$priorityHeaderColors = 50;
		
		foreach( $headerOptionColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options'
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
						'label' => $color['label'], 
						'section' => 'header_options',
						'transport' => $color['transport'],
						'description' => $color['description'],
						'priority' => $priorityHeaderColors,
						'settings' => $color['slug']
					)
				)
			);
			
			$priorityHeaderColors += 10;
			
		}//end of foreach
		
		
			
		/**** Layout Options ****/
		$wp_customize->add_section( 'layout_options' , array(
			'title'    => esc_attr__( 'Layout Options', 'quantumtheme' ),
			'priority' => 60,
		));
		
		//Radio Options
		$wp_customize->add_setting('enableBoxMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableBoxMode', array(
			'label'      => esc_attr__('1170 Boxed Mode', 'quantumtheme'),
			'section'    => 'layout_options',
			'settings'   => 'enableBoxMode',
			'priority' => 10,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting(
			'homepageLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'homepageLayout', 
				array(
					'label'   => esc_attr__( 'Homepage Layout', 'quantumtheme' ),
					'section' => 'layout_options',
					'settings'   => 'homepageLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		
		$wp_customize->add_setting(
			'universalLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'universalLayout', 
				array(
					'label'   => esc_attr__( 'Universal Layout (Tag - Archive - Category)', 'quantumtheme' ),
					'section' => 'layout_options',
					'settings'   => 'universalLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		
		$wp_customize->add_setting(
			'footerLayout', array(
				'default' => 'footer-four-columns',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'footerLayout', 
				array(
					'label'   => esc_attr__( 'Footer Layout', 'quantumtheme' ),
					'section' => 'layout_options',
					'settings'   => 'footerLayout',
					'type'     => 'radio',
					'mode'     => 'image',
					'choices'  => array(
						'footer-one-column' => get_template_directory_uri() . '/css/img/layouts/footer-one-column.png',
						'footer-two-columns' => get_template_directory_uri() . '/css/img/layouts/footer-two-columns.png',
						'footer-three-columns' => get_template_directory_uri() . '/css/img/layouts/footer-three-columns.png',
						'footer-four-columns' => get_template_directory_uri() . '/css/img/layouts/footer-four-columns.png',
						'footer-three-wide-left' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-left.png',
						'footer-three-wide-right' => get_template_directory_uri() . '/css/img/layouts/footer-three-wide-right.png',
					),
				) 
			) 
		);
		
		
		/**** Footer Options ****/
		
		$wp_customize->add_section( 'footer_options' , array(
			'title'    => esc_attr__( 'Footer Options', 'quantumtheme' ),
			'priority' => 70,
		));
			
		//Images	
		$wp_customize->add_setting( 'fatFooterBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'fatFooterBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Fat Footer Background Image', 'quantumtheme' ),
				'section'  => 'footer_options',
				'settings' => 'fatFooterBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
			
		//Radio Options
		$wp_customize->add_setting('toggle_fatfooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_fatfooter', array(
			'label'      => esc_attr__('Fat Footer', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_fatfooter',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('toggle_defaultSocialcta', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_defaultSocialcta', array(
			'label'      => esc_attr__('Toggle default CTA for social icons?', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_defaultSocialcta',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('toggle_defaultNewslettercta', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_defaultNewslettercta', array(
			'label'      => esc_attr__('Toggle default newsletter CTA?', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_defaultNewslettercta',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('toggle_socialFooter', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_socialFooter', array(
			'label'      => esc_attr__('Social Footer', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_socialFooter',
			'type'       => 'radio',
			'priority' => 5,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_footerNav', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_footerNav', array(
			'label'      => esc_attr__('Footer Info and Navigation', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_footerNav',
			'type'       => 'radio',
			'priority' => 6,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_socialColumn', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_socialColumn', array(
			'label'      => esc_attr__('Toggle Social Column?', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_socialColumn',
			'type'       => 'radio',
			'priority' => 7,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('toggle_newsletterColumn', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('toggle_newsletterColumn', array(
			'label'      => esc_attr__('Toggle Newsletter Column?', 'quantumtheme'),
			'section'    => 'footer_options',
			'settings'   => 'toggle_newsletterColumn',
			'type'       => 'radio',
			'priority' => 8,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
				
		
		//Textfields
		$wp_customize->add_setting(
			'socialMediaCTA', array(
				'default' => 'Join the conversation',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'socialMediaCTA', array(
			'label'   => esc_attr__('Social Media Call To Action', 'quantumtheme'),
			'section' => 'footer_options',
			'settings' => 'socialMediaCTA',
			'priority' => 9,
			'type'    => 'text',
		) );




		$wp_customize->add_setting(
			'newsletterCTA', array(
				'default' => 'Subscribe to our newsletter',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'newsletterCTA', array(
			'label'   => esc_attr__('Newsletter Call To Action', 'quantumtheme'),
			'section' => 'footer_options',
			'settings' => 'newsletterCTA',
			'priority' => 10,
			'type'    => 'text',
		) );
		
		
		$wp_customize->add_setting(
			'mailchimpAddress', array(
				'default' => 'http://pulsarmedia.us4.list-manage2.com/subscribe?u=2aa9334fc1bc18c8d05500b41&id=dbcb577c4d',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( $wp_customize, 'mailchimpAddress', array(
			'label'   => esc_attr__( 'Mailchimp Subscribe URL', 'quantumtheme' ),
			'section' => 'footer_options',
			'settings'   => 'mailchimpAddress',
			'priority' => 12,
		) ) );
		
		
		$wp_customize->add_setting(
			'returnToTopIcon', array(
				'default' => 'f077',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'returnToTopIcon', array(
			'label'   => esc_attr__('Return To Top Icon', 'quantumtheme'),
			'section' => 'footer_options',
			'settings' => 'returnToTopIcon',
			'priority' => 13,
			'type'    => 'text',
		) );
		
		//Slider elements
		$wp_customize->add_setting( 'fatFooterPadding', array(
			'default' => 60,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'fatFooterPadding', array(
			'type' => 'range',
			'section' => 'footer_options',
			'label'   => esc_attr__( 'Fat Footer Padding', 'quantumtheme' ),
			'description' => esc_html__('Adjust the vertical padding of the fat footer.', 'quantumtheme'),
			'priority' => 14,
			'input_attrs' => array(
				'min' => 20,
				'max' => 200,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
				
		
		$FooterColors = array();
		
		$FooterColors[] = array(
			'slug'=>'socialIconColor', 
			'default' => '#467192',
			'label' => esc_attr__('Social Icon Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the social buttons.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'newsletterFieldColor', 
			'default' => '#467192',
			'label' => esc_attr__('Newsletter Field Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the social buttons.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerWidgetTitleColor', 
			'default' => '#467192',
			'label' => esc_attr__('Footer Widget Title Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the footer widget title.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerWidgetTitleIconColor', 
			'default' => '#DBC164',
			'label' => esc_attr__('Footer Widget Title Icon Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the footer widget title icon.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'fatFooterBackgroundColor', 
			'default' => '#273D4C',
			'label' => esc_attr__('Fat Footer Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the fat footer.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Footer Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the fat footer.', 'quantumtheme'),
		);
		$FooterColors[] = array(
			'slug'=>'footerNavBackgroundColor', 
			'default' => '#273D4C',
			'label' => esc_attr__('Footer Navigation Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the footer navigation area.', 'quantumtheme'),
		);
		
		$priorityFooterColors = 50;
		
		foreach( $FooterColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'footer_options',
					'priority' => $priorityFooterColors,
					'settings' => $color['slug'])
				)
			);
			
			$priorityFooterColors += 10;
			
		}//end of foreach
		
		/**** Global Options ****/
		
		$wp_customize->add_section( 'global_options' , array(
			'title'    => esc_attr__( 'Global Options', 'quantumtheme' ),
			'priority' => 80,
		));
		
		$wp_customize->add_setting( 'pageBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'pageBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Background image', 'quantumtheme' ),
				'section'  => 'global_options',
				'settings' => 'pageBackgroundImage',
				'priority' => 1,
				) 
			) 
		);
		
		$wp_customize->add_setting('repeatBackground',  array(
			'default' => 'repeat',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('repeatBackground', array(
			'label'      => esc_attr__('Background Repeat', 'quantumtheme'),
			'section'    => 'global_options',
			'settings'   => 'repeatBackground',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'repeat'  => 'Repeat',
				'repeat-x'  => 'Repeat X',
				'repeat-y'  => 'Repeat Y',
				'no-repeat'   => 'No Repeat',
			),
		));
		
		
		$wp_customize->add_setting( 'sidebarBorderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'sidebarBorderImage', 
			array(
				'label'    => esc_attr__( 'Sidebar Title Border', 'quantumtheme' ),
				'section'  => 'global_options',
				'settings' => 'sidebarBorderImage',
				'priority' => 3,
				) 
			) 
		);
		
		$wp_customize->add_setting('enableTooltip', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableTooltip', array(
			'label'      => esc_attr__('ToolTip', 'quantumtheme'),
			'section'    => 'global_options',
			'settings'   => 'enableTooltip',
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('colorSampler',  array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('colorSampler', array(
			'label'      => esc_attr__('Theme Sampler', 'quantumtheme'),
			'section'    => 'global_options',
			'settings'   => 'colorSampler',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('ieCompatibilityMode',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('ieCompatibilityMode', array(
			'label'      => esc_attr__('IE 9 Compatibility Mode?', 'quantumtheme'),
			'section'    => 'global_options',
			'settings'   => 'ieCompatibilityMode',
			'priority' => 6,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('retinaSupport',  array(
			'default' => 'off',
			'sanitize_callback' => 'esc_attr'
		));
		
		$wp_customize->add_control('retinaSupport', array(
			'label'      => esc_html__('Retina Support', 'quantumtheme'),
			'section'    => 'global_options',
			'settings'   => 'retinaSupport',
			'priority' => 7,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
				
		
		$wp_customize->add_setting(
			'ulListIcon', array(
				'default' => 'f005',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( 'ulListIcon', array(
			'label'   => esc_attr__('UL List Icon', 'quantumtheme'),
			'section' => 'global_options',
			'settings' => 'ulListIcon',
			'priority' => 9,
			'type'    => 'text',
		) );
		
		$GlobalColors = array();
		
		$GlobalColors[] = array(
			'slug'=>'pageBackgroundColor', 
			'default' => '#FFFFFF',
			'label' => esc_attr__('Background Color', 'quantumtheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the page background color.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'primaryColor', 
			'default' => '#DBC164',
			'label' => esc_attr__('Primary Color', 'quantumtheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the primary color of the Quantum theme. This color applies to mulitple elements for a consistent design. Please note that not all elements update in real-time - save your changes and review your final changes on the front-end.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'secondaryColor', 
			'default' => '#2B5C84',
			'label' => esc_attr__('Secondary Color', 'quantumtheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the secondary color of the Quantum theme. This color applies to mulitple elements for a consistent design. Please note that not all elements update in real-time - save your changes and review your final changes on the front-end.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'dividerColor', 
			'default' => '#e3e3e3',
			'label' => esc_attr__('Divider/Border Color', 'quantumtheme'),
			'transport' => 'postMessage',
			'description' => esc_html__('Adjust the divider/border color of the Quantum theme. This color applies to mulitple elements for a consistent design.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'tooltipColor', 
			'default' => '#333333',
			'label' => esc_attr__('ToolTip Color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the background color of the tooltip popup. (Requires window refresh)', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'blockQuoteColor', 
			'default' => '#dbc164',
			'label' => esc_attr__('Blockquote Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the blockquote element.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'commentBoxColor',  //.pm-single-blog-post-author-box
			'default' => '#f6f6f6',
			'label' => esc_attr__('Author and Comment Box Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the author and comments container found on the single news post template.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'commentShareBoxColor',  //.pm-single-blog-post-author-box-share
			'default' => '#adadad',
			'label' => esc_attr__('Post Share Box Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post share box container found on the single news post template.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'globalButtonBorderColor', 
			'default' => '#d9d9d9',
			'label' => esc_attr__('Global Button Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of global buttons throughout the theme.', 'quantumtheme'),
		);
		$GlobalColors[] = array(
			'slug'=>'globalButtonBackgroundColor',  
			'default' => '#FFFFFF',
			'label' => esc_attr__('Global Button Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of global buttons throughout the theme.', 'quantumtheme'),
		);
		
		$globalColorsCounter = 50;
		
		foreach( $GlobalColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'global_options',
					'settings' => $color['slug'],
					'priority' => $globalColorsCounter,
					)
				)
			);
			
			$globalColorsCounter += 10;
			
		}//end of foreach
					
				
		/**** Business Info ****/
		
		$wp_customize->add_section( 'business_info' , array(
			'title'    => esc_attr__( 'Business Info', 'quantumtheme' ),
			'priority' => 100,
		));
		
		//Textfields
		$wp_customize->add_setting(
			'businessPhone', array(
				'default' => 'General Inquiries <span>1-888-555-5555</span>',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'businessPhone', array(
				'label'   => esc_attr__( 'Business Number', 'quantumtheme' ),
				'section' => 'business_info',
				'settings'   => 'businessPhone',
			) ) 
		);
		
		$wp_customize->add_setting(
			'supportPhone', array(
				'default' => 'Support <span>1-888-555-5555</span>',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'supportPhone', array(
				'label'   => esc_attr__( 'Support Number', 'quantumtheme' ),
				'section' => 'business_info',
				'settings'   => 'supportPhone',
			) ) 
		);
		
		$wp_customize->add_setting(
			'businessEmail', array(
				'default' => 'info@quantum.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'businessEmail', array(
			'label'   => esc_attr__( 'Email Address', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'businessEmail',
			'type'    => 'text',
		) );
		
		//Facebook Icon
		$wp_customize->add_setting(
			'facebooklink', array(
				'default' => 'http://www.facebook.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'facebooklink', array(
			'label'   => esc_attr__( 'Facebook URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'facebooklink',
			'type'    => 'text',
		) );
		
		//Twitter Icon
		$wp_customize->add_setting(
			'twitterlink', array(
				'default' => 'http://www.twitter.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'twitterlink', array(
			'label'   => esc_attr__( 'Twitter URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'twitterlink',
			'type'    => 'text',
		) );
		
		//G Plus Icon
		$wp_customize->add_setting(
			'googlelink', array(
				'default' => 'http://www.googleplus.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'googlelink', array(
			'label'   => esc_attr__( 'Google Plus URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'googlelink',
			'type'    => 'text',
		) );
		
		//Linkedin Icon
		$wp_customize->add_setting(
			'linkedinLink', array(
				'default' => 'http://www.linkedin.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'linkedinLink', array(
			'label'   => esc_attr__( 'Linkedin URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'linkedinLink',
			'type'    => 'text',
		) );
		
		//Vimeo Icon
		$wp_customize->add_setting(
			'vimeolink', array(
				'default' => 'http://www.vimeo.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'vimeolink', array(
			'label'   => esc_attr__( 'Vimeo URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'vimeolink',
			'type'    => 'text',
		) );
		
		//Youtube Icon
		$wp_customize->add_setting(
			'youtubelink', array(
				'default' => 'http://www.youtube.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'youtubelink', array(
			'label'   => esc_attr__( 'YouTube URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'youtubelink',
			'type'    => 'text',
		) );
		
		//Dribbble Icon
		$wp_customize->add_setting(
			'dribbblelink', array(
				'default' => 'http://www.dribbble.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'dribbblelink', array(
			'label'   => esc_attr__( 'Dribbble URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'dribbblelink',
			'type'    => 'text',
		) );
		
		//Pinterest Icon
		$wp_customize->add_setting(
			'pinterestlink', array(
				'default' => 'http://www.pinterest.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'pinterestlink', array(
			'label'   => esc_attr__( 'Pinterest URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'pinterestlink',
			'type'    => 'text',
		) );
		
		//Instagram Icon
		$wp_customize->add_setting(
			'instagramlink', array(
				'default' => 'http://www.instagram.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'instagramlink', array(
			'label'   => esc_attr__( 'Instagram URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'instagramlink',
			'type'    => 'text',
		) );
		
		//Behance Icon
		$wp_customize->add_setting(
			'behancelink', array(
				'default' => 'http://www.behance.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'behancelink', array(
			'label'   => esc_attr__( 'Behance URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'behancelink',
			'type'    => 'text',
		) );
		
		//Skype Icon
		$wp_customize->add_setting(
			'skypelink', array(
				'default' => 'http://www.skype.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'skypelink', array(
			'label'   => esc_attr__( 'Skype Name', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'skypelink',
			'type'    => 'text',
		) );
		
		//Flickr Icon
		$wp_customize->add_setting(
			'flickrlink', array(
				'default' => 'http://www.flickr.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'flickrlink', array(
			'label'   => esc_attr__( 'Flickr URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'flickrlink',
			'type'    => 'text',
		) );
		
		//Github Icon
		$wp_customize->add_setting(
			'githublink', array(
				'default' => 'http://www.github.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'githublink', array(
			'label'   => esc_attr__( 'Github URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'githublink',
			'type'    => 'text',
		) );
		
		//Tumblr Icon
		$wp_customize->add_setting(
			'tumblrlink', array(
				'default' => 'http://www.tumblr.com',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'tumblrlink', array(
			'label'   => esc_attr__( 'Tumblr URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'tumblrlink',
			'type'    => 'text',
		) );
		
		//RSS Icon
		$wp_customize->add_setting(
			'rssLink', array(
				'default' => '/rss',
				'sanitize_callback' => 'esc_attr',
			)
		);
				
		$wp_customize->add_control( 'rssLink', array(
			'label'   => esc_attr__( 'RSS URL', 'quantumtheme' ),
			'section' => 'business_info',
			'settings' => 'rssLink',
			'type'    => 'text',
		) );
		
		/**** Woocommerce Options ****/
		 
		$wp_customize->add_section( 'woo_options' , array(
			'title'    => esc_attr__( 'Woocommerce Options', 'quantumtheme' ),
			'priority' => 110,
		));
		
		//Upload Options
		$wp_customize->add_setting( 'wooCategoryHeaderImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'wooCategoryHeaderImage', 
			array(
				'label'    => esc_attr__( 'Category/Tag Page Header Image', 'quantumtheme' ),
				'section'  => 'woo_options',
				'priority' => 1,
				'settings' => 'wooCategoryHeaderImage',
				) 
			) 
		);
		
		$wp_customize->add_setting('products_per_page',
			array(
				'default' => '8',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control('products_per_page',
			array(
				'type' => 'select',
				'label' => esc_attr__( 'Products Per Page', 'quantumtheme' ),
				'section' => 'woo_options',
				'choices' => array(
					'4' => '4',
					'8' => '8',
					'12' => '12',
					'16' => '16',
					'20' => '20',
					'24' => '24',
					'28' => '28',
					'32' => '32',
				),
			)
		);
		
		
		$wp_customize->add_setting(
			'woocommShopLayout', array(
				'default' => 'no-sidebar',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Radio_Control( 
			$wp_customize, 'woocommShopLayout', 
				array(
					'label'   => esc_attr__('Woocommerce layout', 'quantumtheme' ),
					'section' => 'woo_options',
					'type'     => 'radio',
					'mode'     => 'image',
					'description' => esc_attr__('Applies to all Woocommerce templates.', 'quantumtheme' ),
					'choices'  => array(
						'no-sidebar' => get_template_directory_uri() . '/css/img/layouts/no-sidebar.png',
						'left-sidebar' => get_template_directory_uri() . '/css/img/layouts/left-sidebar.png',
						'right-sidebar' => get_template_directory_uri() . '/css/img/layouts/right-sidebar.png',
					),
				) 
			) 
		);
		
		
		
		
		/**** Custom Post Type Options ****/
		$wp_customize->add_section( 'custom_post_type_options' , array(
			'title'    => esc_attr__( 'Custom Post Type Options', 'quantumtheme' ),
			'priority' => 120,
		));
		
		//Radio options
		$wp_customize->add_setting('staffPostsOrder', array(
			'default' => 'ASC',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('staffPostsOrder', array(
			'label'      => esc_attr__('Staff Posts Order', 'quantumtheme'),
			'section'    => 'custom_post_type_options',
			'settings'   => 'staffPostsOrder',
			'type'       => 'radio',
			'priority' => 1,
			'choices'    => array(
				'ASC'   => 'Ascending',
				'DESC'  => 'Descending',
			),
		));
		
		
		/**** Post Options ****/
		$wp_customize->add_section( 'post_options' , array(
			'title'    => esc_attr__( 'Post Options', 'quantumtheme' ),
			'priority' => 120,
		));
		
		//Radio options
		$wp_customize->add_setting('displayAuthorInfo', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayAuthorInfo', array(
			'label'      => esc_attr__('Display Author info?', 'quantumtheme'),
			'section'    => 'post_options',
			'settings'   => 'displayAuthorInfo',
			'type'       => 'radio',
			'priority' => 1,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayShareOptions', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayShareOptions', array(
			'label'      => esc_attr__('Display Share Options?', 'quantumtheme'),
			'section'    => 'post_options',
			'settings'   => 'displayShareOptions',
			'type'       => 'radio',
			'priority' => 2,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayRelatedPosts', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displayRelatedPosts', array(
			'label'      => esc_attr__('Display Related Posts?', 'quantumtheme'),
			'section'    => 'post_options',
			'settings'   => 'displayRelatedPosts',
			'type'       => 'radio',
			'priority' => 3,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('displayCommentsCount', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
			
		));
		
		$wp_customize->add_control('displayCommentsCount', array(
			'label'      => esc_attr__('Display Comments Count?', 'quantumtheme'),
			'section'    => 'post_options',
			'settings'   => 'displayCommentsCount',
			'description' => __('Applies to news posts and post slider posts', 'quantumtheme'),
			'type'       => 'radio',
			'priority' => 4,
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		
		$PostColors = array();
		
		$PostColors[] = array(
			'slug'=>'postTitleBGColor', 
			'default' => '#000000',
			'label' => esc_attr__('Post Title Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post title.', 'quantumtheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postDateBGColor', 
			'default' => '#dbc164',
			'label' => esc_attr__('Post Date Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post date.', 'quantumtheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postExcerptDividerColor', 
			'default' => '#e9e9e9',
			'label' => esc_attr__('Post Excerpt Divider Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the divider color of the post excerpt.', 'quantumtheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postNavigationButtonColor', 
			'default' => '#000000',
			'label' => esc_attr__('Post Navigation Button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the post navigation buttons.', 'quantumtheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postNavigationBorderColor', 
			'default' => '#ededed',
			'label' => esc_attr__('Post Navigation Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the post navigation buttons.', 'quantumtheme'),
		);
		
		$PostColors[] = array(
			'slug'=>'postImageBorderColor', 
			'default' => '#ededed',
			'label' => esc_attr__('Post Image Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the post image.', 'quantumtheme'),
		);
		
		$postColorsCounter = 50;
		
		foreach( $PostColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'],
					'transport' => $color['transport'],
					'description' => $color['description'], 
					'section' => 'post_options',
					'priority' => $postColorsCounter,
					'settings' => $color['slug'],
					)
				)
			);
			
			$postColorsCounter += 10;
			
		}//end of foreach
		
		/**** Workshop Options ****/
		 
		$wp_customize->add_section( 'workshop_options' , array(
			'title'    => esc_attr__( 'Workshop Options', 'quantumtheme' ),
			'priority' => 130,
		));

		
		$workshopColors = array();
		
		$workshopColors[] = array(
			'slug'=>'title_bg_color', 
			'default' => '#F8F8F8',
			'label' => esc_attr__('Title background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the workshop post title.', 'quantumtheme'),
		);
		
		$workshopColors[] = array(
			'slug'=>'view_details_btn_color', 
			'default' => '#bbbbbb',
			'label' => esc_attr__('View details background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the workshop view details button.', 'quantumtheme'),
		);
		
		
		foreach( $workshopColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'workshop_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach
		
		
		/**** Career Options ****/
		$wp_customize->add_section( 'career_options' , array(
			'title'    => esc_attr__( 'Career Options', 'quantumtheme' ),
			'priority' => 140,
		));

		
		$careerColors = array();
		
		$careerColors[] = array(
			'slug'=>'date_posted_bg_color', 
			'default' => '#F6F6F6',
			'label' => esc_attr__('Date posted background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the workshop view details button.', 'quantumtheme'),
		);
		
		foreach( $careerColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'career_options',
					'settings' => $color['slug'],
					)
				)
			);
			
		}//end of foreach		
		
		/**** Post Slider Options ****/
		$wp_customize->add_section( 'presentation_options' , array(
			'title'    => esc_attr__( 'Post Slider Options', 'quantumtheme' ),
		));
		
		$wp_customize->add_setting( 'presentationImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'presentationImage', 
			array(
				'label'    => esc_attr__( 'Presentation Image', 'quantumtheme' ),
				'section'  => 'presentation_options',
				'settings' => 'presentationImage',
				'priority' => 1,
				) 
			) 
		);
		
		
		$wp_customize->add_setting('enablePostSlider', array(
			'default' => 'yes',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enablePostSlider', array(
			'label'      => esc_attr__('Display Post Slider?', 'quantumtheme'),
			'section'    => 'presentation_options',
			'settings'   => 'enablePostSlider',
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'yes'   => 'ON',
				'no'  => 'OFF',
			),
		));
		
		
		$wp_customize->add_setting('enableSliderParallax', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableSliderParallax', array(
			'label'      => esc_attr__('Enable Parallax?', 'quantumtheme'),
			'section'    => 'presentation_options',
			'settings'   => 'enableSliderParallax',
			'priority' => 3,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
					
		$wp_customize->add_setting('displaySliderPosts', array(
			'default' => 'on',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('displaySliderPosts', array(
			'label'      => esc_attr__('Display Posts?', 'quantumtheme'),
			'section'    => 'presentation_options',
			'settings'   => 'displaySliderPosts',
			'priority' => 4,
			'type'       => 'radio',
			'choices'    => array(
				'on'   => 'ON',
				'off'  => 'OFF',
			),
		));
		
		$wp_customize->add_setting('sliderPostsOrder', array(
			'default' => 'DESC',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('sliderPostsOrder', array(
			'label'      => esc_attr__('Sort Posts by:', 'quantumtheme'),
			'section'    => 'presentation_options',
			'settings'   => 'sliderPostsOrder',
			'priority' => 5,
			'type'       => 'radio',
			'choices'    => array(
				'ASC'   => 'Ascending order',
				'DESC'  => 'Descending order',
			),
		));	
			
		
		
		$wp_customize->add_setting( 'textAreaHeight', array(
			'default' => 335,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'textAreaHeight', array(
			'type' => 'range',
			'section' => 'presentation_options',
			'label'   => esc_attr__( 'Text Area Height', 'quantumtheme' ),
			'description' => esc_html__('Adjust the height of the text area.', 'quantumtheme'),
			'priority' => 6,
			'input_attrs' => array(
				'min' => 100,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'textAreaPosition', array(
			'default' => 25,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'textAreaPosition', array(
			'type' => 'range',
			'section' => 'presentation_options',
			'label'   => esc_attr__( 'Text Area Position', 'quantumtheme' ),
			'description' => esc_html__('Adjust the positioning of the text area.', 'quantumtheme'),
			'priority' => 7,
			'input_attrs' => array(
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'autoPlaySpeed', array(
			'default' => 8000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'autoPlaySpeed', array(
			'type' => 'range',
			'section' => 'presentation_options',
			'label'   => esc_attr__( 'Slideshow Speed', 'quantumtheme' ),
			'description' => esc_html__('Adjust the slideshow speed of the news posts. (Requires window refresh)', 'quantumtheme'),
			'priority' => 8,
			'input_attrs' => array(
				'min' => 2000,
				'max' => 8000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		
		$wp_customize->add_setting( 'slideSpeed', array(
			'default' => 500,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'slideSpeed', array(
			'type' => 'range',
			'section' => 'presentation_options',
			'label'   => esc_attr__( 'Slide Speed', 'quantumtheme' ),
			'description' => esc_html__('Adjust the slide speed of the news posts. (Requires window refresh)', 'quantumtheme'),
			'priority' => 9,
			'input_attrs' => array(
				'min' => 100,
				'max' => 1000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );
		
		$wp_customize->add_setting( 'rewindSpeed', array(
			'default' => 1000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'rewindSpeed', array(
			'type' => 'range',
			'section' => 'presentation_options',
			'label'   => esc_attr__( 'Rewind Speed', 'quantumtheme' ),
			'description' => esc_html__('Adjust the rewind speed of the news posts. (Requires window refresh)', 'quantumtheme'),
			'priority' => 10,
			'input_attrs' => array(
				'min' => 500,
				'max' => 5000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

				
		
		$wp_customize->add_setting(
			'presentationText', array(
				'default' => 'This is quantum',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'presentationText', array(
				'label'   => esc_attr__( 'Presentation Title', 'quantumtheme' ),
				'section' => 'presentation_options',
				'settings'   => 'presentationText',
				'priority' => 11,
			) ) 
		);
		
		$wp_customize->add_setting(
			'presentationText2', array(
				'default' => 'A premium quality theme for businesses and corporations',
				'sanitize_callback' => 'esc_attr',
			)
		);
		
		$wp_customize->add_control( new pm_ln_Customize_Textarea_Control( 
			$wp_customize, 'presentationText2', array(
				'label'   => esc_attr__( 'Presentation Sub-Title', 'quantumtheme' ),
				'section' => 'presentation_options',
				'settings'   => 'presentationText2',
				'priority' => 11,
			) ) 
		);
		
		$PresentationColors = array();
		
		$PresentationColors[] = array(
			'slug'=>'textBackgroundColor', 
			'default' => '#000000',
			'label' => esc_attr__('Text background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the text area.', 'quantumtheme'),
		);
		
		$PresentationColors[] = array(
			'slug'=>'buttonColor', 
			'default' => '#000000',
			'label' => esc_attr__('Button color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post navigation buttons.', 'quantumtheme'),
		);
		
		$PresentationColors[] = array(
			'slug'=>'buttonBorderColor', 
			'default' => '#cccccc',
			'label' => esc_attr__('Button Border color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the post navigation buttons.', 'quantumtheme'),
		);
		
		$PresentationColors[] = array(
			'slug'=>'titleBackgroundColor', 
			'default' => '#2b5d83',
			'label' => esc_attr__('Title Background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post title.', 'quantumtheme'),
		);
		
		$PresentationColors[] = array(
			'slug'=>'excerptBackgroundColor', 
			'default' => '#000000',
			'label' => esc_attr__('Excerpt Background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post excerpt.', 'quantumtheme'),
		);
		
		$PresentationColors[] = array(
			'slug'=>'dateBackgroundColor', 
			'default' => '#DBC164',
			'label' => esc_attr__('Date Background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the post date.', 'quantumtheme'),
		);
		
		$presentationColorsCounter = 50;
		
		foreach( $PresentationColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'presentation_options',
					'priority' => $presentationColorsCounter,
					'settings' => $color['slug'])
				)
			);
			
			$presentationColorsCounter += 10;
			
		}//end of foreach
		
		
		/**** PrettyPhoto Options ****/
		$wp_customize->add_section( 'prettyPhoto_options' , array(
			'title'    => esc_attr__( 'PrettyPhoto Options', 'quantumtheme' ),
		));

		//Select lists
		$wp_customize->add_setting('ppAutoPlay', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('ppAutoPlay', array(
			'label'      => esc_attr__('Enable Slideshow?', 'quantumtheme'),
			'section'    => 'prettyPhoto_options',
			'settings'   => 'ppAutoPlay',
			'description' => esc_attr__('Allow the carousel to cycle through each slide automatically.', 'quantumtheme'), //Descriptive tooltip
			'priority' => 1,
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));	
		
		$wp_customize->add_setting('ppShowTitle', array(
			'default' => 'true',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('ppShowTitle', array(
			'label'      => esc_attr__('Display Caption?', 'quantumtheme'),
			'section'    => 'prettyPhoto_options',
			'settings'   => 'ppShowTitle',
			'description' => esc_attr__('Display the caption of each slide in the PrettyPhoto carousel.', 'quantumtheme'), //Descriptive tooltip
			'priority' => 2,
			'type'       => 'radio',
			'choices'    => array(
				'true'   => 'ON',
				'false'  => 'OFF',
			),
		));			
		
		
		$wp_customize->add_setting('ppAnimationSpeed', array(
			'default' => 'normal',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('ppAnimationSpeed', array(
			'label'      => esc_attr__('Animation Speed', 'quantumtheme'),
			'section'    => 'prettyPhoto_options',
			'settings'   => 'ppAnimationSpeed',
			'priority' => 3,
			'description' => esc_attr__('Select your desired speed of the slide animation.', 'quantumtheme'), //Descriptive tooltip
			'type'       => 'radio',
			'choices'    => array(
				'fast'   => 'Fast',
				'slow'  => 'Slow',
				'normal'  => 'Normal',
			),
		));	
		
		$wp_customize->add_setting('ppColorTheme', array(
			'default' => 'light_rounded',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('ppColorTheme', array(
			'label'      => esc_attr__('Color Theme', 'quantumtheme'),
			'section'    => 'prettyPhoto_options',
			'settings'   => 'ppColorTheme',
			'priority' => 4,
			'description' => esc_attr__('Set the color theme for the PrettyPhoto carousel.', 'quantumtheme'), //Descriptive tooltip
			'type'       => 'radio',
			'choices'    => array(
				'light_rounded' => 'Light Rounded', 
				'dark_rounded' => 'Dark Rounded',
				'light_square' => 'Light Square',
				'dark_square' => 'Dark Square',
			),
		));
		
		
		//slider element
		$wp_customize->add_setting( 'ppSlideShowSpeed', array(
			'default' => 5000,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'ppSlideShowSpeed', array(
			'type' => 'range',
			'section' => 'prettyPhoto_options',
			'label'   => esc_attr__( 'Slideshow Speed', 'quantumtheme' ),
			'description' => esc_html__('Adjust the slideshow speed of the PrettyPhoto carousel. Only applies if the Slideshow feature is enabled. (Requires window refresh)', 'quantumtheme'),
			'priority' => 5,
			'input_attrs' => array(
				'min' => 2000,
				'max' => 10000,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );

				

		/**** Shortcode Options ****/
		$wp_customize->add_section( 'shortcode_options' , array(
			'title'    => esc_attr__( 'Shortcode Options', 'quantumtheme' ),
		));
				
		//Shortcode Option Colors
		$shortcodeOptionColors = array();
		
		$shortcodeOptionColors[] = array(
			'slug'=>'testimonials_quote_color', 
			'default' => '#273D4C',
			'label' => esc_attr__('Testimonials Carousel quote color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the testimonials carousel quote box.', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'quote_box_color', 
			'default' => '#E8F1F9',
			'label' => esc_attr__('Quote box color', 'quantumtheme'),
			'transport' => 'refresh', //postMessage
			'description' => esc_html__('Adjust the color of the quote box. (Requires window refresh)', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_title_color', 
			'default' => '#DBC164',
			'label' => esc_attr__('Data Table title color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the data table title column.', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'data_table_info_color', 
			'default' => '#E8E8E8',
			'label' => esc_attr__('Data Table info color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the data table info column.', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'statBox1_bg_color', 
			'default' => '#283E4E',
			'label' => esc_attr__('Stat Box 1 background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the stat box style 1.', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'staff_profile_bg_color', 
			'default' => '#F5F5F5',
			'label' => esc_attr__('Staff Profile background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the staff profile.', 'quantumtheme'),
		);
		
		$shortcodeOptionColors[] = array(
			'slug'=>'progress_bar_color', 
			'default' => '#DBC164',
			'label' => esc_attr__('Progress bar color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the bar color of the progress bar.', 'quantumtheme'),
		);
				
		foreach( $shortcodeOptionColors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'shortcode_options',
					'settings' => $color['slug'])
				)
			);
		}//end of foreach
		
		
		
		
		/**** Quick Login Options ****/
		$wp_customize->add_section( 'quicklogin_options' , array(
			'title'    => esc_attr__( 'Quick Login Options', 'quantumtheme' ),
		));
		
		$wp_customize->add_setting('enableQuickLogin', array(
			'default' => 'yes',
			'sanitize_callback' => 'esc_attr',
		));
		
		$wp_customize->add_control('enableQuickLogin', array(
			'label'      => esc_attr__('Enable Quick Login Panel?', 'quantumtheme'),
			'section'    => 'quicklogin_options',
			'settings'   => 'enableQuickLogin',
			'type'       => 'radio',
			'choices'    => array(
				'yes'   => 'ON',
				'no'  => 'OFF',
			),
		));

						

		$wp_customize->add_setting( 'quickLoginBackgroundImage', array(
			'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'quickLoginBackgroundImage', 
			array(
				'label'    => esc_attr__( 'Background Image', 'quantumtheme' ),
				'section'  => 'quicklogin_options',
				'settings' => 'quickLoginBackgroundImage',
				) 
			) 
		);
				
		$wp_customize->add_setting(
			'activatorIcon', array(
				'default' => 'typcn typcn-th-large-outline',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'activatorIcon',
			 array(
				'label' => esc_attr__( 'Activator Icon', 'quantumtheme' ),
			 	'section' => 'quicklogin_options',
			 )
		);
		
		
		$wp_customize->add_setting( 'notificationPosition', array(
			'default' => 35,
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh', //postMessage
			'sanitize_callback' => 'absint'
		) );
		
		$wp_customize->add_control( 'notificationPosition', array(
			'type' => 'range',
			'section' => 'quicklogin_options',
			'label'   => esc_attr__( 'Notification Position', 'quantumtheme' ),
			'description' => esc_html__('Adjust the vertical positioning of the alert notification. (Requires window refresh)', 'quantumtheme'),
			'priority' => 10,
			'input_attrs' => array(
				'min' => 1,
				'max' => 150,
				'step' => 1,
				'class' => 'example-class',
				'style' => 'color: #0a0',
			),
		) );


		
		$QuickLoginColors = array();
		
		$QuickLoginColors[] = array(
			'slug'=>'quickLoginBackgroundColor', 
			'default' => '#2a3a47',
			'label' => esc_attr__('Background color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the quick login area.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'submitButtonColor', 
			'default' => '#DBC164',
			'label' => esc_attr__('Submit Button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the quick login submit button.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'submitButtonBorderColor', 
			'default' => '#987e23',
			'label' => esc_attr__('Submit Button Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the quick login submit button.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'activatorButtonColor', 
			'default' => '#6cb9f3',
			'label' => esc_attr__('Activator Button Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the color of the quick login activator button.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'activatorBorderColor', 
			'default' => '#0a8bec',
			'label' => esc_attr__('Activator Button Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the quick login activator button.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'notificationBackgroundColor', 
			'default' => '#333333',
			'label' => esc_attr__('Notification Background Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the background color of the notification slide out window.', 'quantumtheme'),
		);
		
		$QuickLoginColors[] = array(
			'slug'=>'notificationBorderColor', 
			'default' => '#e5e5e5',
			'label' => esc_attr__('Notification Border Color', 'quantumtheme'),
			'transport' => 'postMessage', //postMessage
			'description' => esc_html__('Adjust the border color of the notification slide out window.', 'quantumtheme'),
		);
		
		foreach( $QuickLoginColors as $color ) {
			
			// SETTINGS
			$wp_customize->add_setting(
				$color['slug'], array(
					'default' => $color['default'],
					'transport' => $color['transport'],
					'description' => $color['description'],
					'type' => 'option', 
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'esc_attr',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$color['slug'], 
					array(
					'label' => $color['label'], 
					'transport' => $color['transport'],
					'description' => $color['description'],
					'section' => 'quicklogin_options',
					'settings' => $color['slug'])
				)
			);
			
		}//end of foreach
		
   }//end of function
   
}//end of class


if (class_exists('WP_Customize_Control')) {
	
	//Custom radio with image support
	class pm_ln_Customize_Radio_Control extends WP_Customize_Control {

		public $type = 'radio';
		public $description = '';
		public $mode = 'radio';
		public $subtitle = '';
	
		public function enqueue() {
	
			if ( 'buttonset' == $this->mode || 'image' == $this->mode ) {
				wp_enqueue_script( 'jquery-ui-button' );
				wp_register_style('customizer-styles', get_template_directory_uri() . '/css/customizer/pulsar-customizer.css');  
				wp_enqueue_style('customizer-styles');
			}
	
		}
	
		public function render_content() {
	
			if ( empty( $this->choices ) ) {
				return;
			}
	
			$name = '_customize-radio-' . $this->id;
	
			?>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
            
            <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                <p><?php echo strip_tags( esc_html( $this->description ) ); ?></p>
            <?php } ?>
	
			<div id="input_<?php echo $this->id; ?>" class="<?php echo $this->mode; ?>">
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
	
				// JqueryUI Button Sets
				if ( 'buttonset' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</input>
						<?php
					endforeach;
	
				// Image radios.
				} elseif ( 'image' == $this->mode ) {
	
					foreach ( $this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
							<label for="<?php echo $this->id . $value; ?>">
								<img src="<?php echo esc_html( $label ); ?>">
							</label>
						</input>
						<?php
					endforeach;
	
				// Normal radios
				} else {
	
					foreach ( $this->choices as $value => $label ) :
						?>
						<label class="customizer-radio">
							<input class="kirki-radio" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<?php echo esc_html( $label ); ?><br/>
						</label>
						<?php
					endforeach;
	
				}
				?>
			</div>
			<?php if ( 'buttonset' == $this->mode || 'image' == $this->mode ) { ?>
				<script>
				jQuery(document).ready(function($) {
					$( '[id="input_<?php echo $this->id; ?>"]' ).buttonset();
				});
				</script>
			<?php }
	
		}
	}
	
	//jQuery UI Slider class
	class pm_ln_Customize_Sliderui_Control extends WP_Customize_Control {

		public $type = 'slider';
		public $description = '';
		public $subtitle = '';
	
		public function enqueue() {
	
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
	
		}
	
		public function render_content() { ?>
			<label>
	
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
                
                <?php if ( isset( $this->description ) && '' != $this->description ) { ?>
                    
                    <span class="description customize-control-description" style="margin-bottom:15px;"><?php echo strip_tags( esc_html( $this->description ) ); ?></span>
                    
                <?php } ?>
	
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
	
				<input type="text" class="kirki-slider" id="input_<?php echo $this->id; ?>" disabled value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
	
			</label>
	
			<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
			<script>
			jQuery(document).ready(function($) {
				$( '[id="slider_<?php echo $this->id; ?>"]' ).slider({
						value : <?php echo $this->value(); ?>,
						min   : <?php echo $this->choices['min']; ?>,
						max   : <?php echo $this->choices['max']; ?>,
						step  : <?php echo $this->choices['step']; ?>,
						slide : function( event, ui ) { $( '[id="input_<?php echo $this->id; ?>"]' ).val(ui.value).keyup(); }
				});
				$( '[id="input_<?php echo $this->id; ?>"]' ).val( $( '[id="slider_<?php echo $this->id; ?>"]' ).slider( "value" ) );
			});
			</script>
			<?php
	
		}
	}
	
	//Custom classes for extending the theme customizer
	class pm_ln_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	 
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
		}
	}

}


add_action( 'customize_register' , array( 'PM_LN_Customizer' , 'register' ) );

?>