<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'quantumtheme'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'quantumtheme'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'quantumtheme'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'quantumtheme'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'quantumtheme'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'quantumtheme') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'quantumtheme'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /***** ACTUAL DECLARATION OF SECTIONS ******/
			   
			//BUSINESS INFO SECTION
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Business Info Fonts', 'quantumtheme'),
			  'heading'   => __('Manage fonts for the business info area.', 'quantumtheme'),
			  'desc'      => __('<p class="description">Under this section you can manage font styles for the business information located in the header and footer area.</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-business-info-font',
					'type'          => 'typography',
					'title'         => __('Business Information Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					'text-transform' => true,
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-header-support-text', '.pm-header-login-text','.pm-footer-copyright p', '.pm-dropdown.pm-language-selector-menu .pm-dropmenu .pm-menu-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-header-support-text', '.pm-header-login-text','.pm-footer-copyright p', '.pm-dropdown.pm-language-selector-menu .pm-dropmenu .pm-menu-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the business info in the header and footer area. ', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '500',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '24px'
					),
				),
				
				array(
					'id'            => 'opt-business-info-links',
					'type'          => 'typography',
					'title'         => __('Business Info Links', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-header-support-text span', '.pm-footer-copyright a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-header-support-text span', '.pm-footer-copyright a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the business info links in the header and footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#dbc164',
						'font-weight'    => '500',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '24px'
					),
				),
							
			  )//end of fields array
			
			);//end of section
			    

            // HEADER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Header Options', 'quantumtheme'),
			  'heading'   => __('Manage options for the header area.', 'quantumtheme'),
			  'desc'      => __('<p class="description">Edit fonts for the header area and activate or deactivate the google map for the contact page template.</p>', 'quantumtheme'),
			
			  'fields'    => array(
			  
			    //Fields go here
				array(
					'id'            => 'opt-nav-font',
					'type'          => 'typography',
					'title'         => __('Navigation Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.sf-menu a', '.pm-language-selector-menu .pm-dropmenu-active ul li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.sf-menu a', '.pm-language-selector-menu .pm-dropmenu-active ul li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for navigation style 1.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',
						'line-height'   => '50px'),
				),
				  
				array(
					'id'            => 'opt-page-title-font',
					'type'          => 'typography',
					'title'         => __('Page Title', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sub-header-title-container h5', '.pm-single-blog-post-header-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sub-header-title-container h5', '.pm-single-blog-post-header-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Page Title.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#fffff',
						'font-weight'    => '100',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '60px',
						'line-height'   => '60px'
					),
				),
				
				
				array(
					'id'            => 'opt-message-font',
					'type'          => 'typography',
					'title'         => __('Page Message', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sub-header-message p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sub-header-message p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the header page message.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
						'line-height'   => '24px'
					),
				),
				
				array(
					'id'            => 'opt-breadcrumb-font',
					'type'          => 'typography',
					'title'         => __('Breadcrumb Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sub-header-breadcrumbs-ul p a', '.pm-sub-header-breadcrumbs-ul p.current', '.pm-sub-header-breadcrumbs-ul p', '.pm-sub-header-breadcrumbs-ul p i', '.woocommerce-breadcrumb', '.woocommerce-breadcrumb li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sub-header-breadcrumbs-ul p a', '.pm-sub-header-breadcrumbs-ul p.current', '.pm-sub-header-breadcrumbs-ul p', '.pm-sub-header-breadcrumbs-ul p i', '.woocommerce-breadcrumb', '.woocommerce-breadcrumb li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the breadcrumb trail font.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '24px'),
				),
				
				array(
					'id'            => 'opt-header-buttons-font',
					'type'          => 'typography',
					'title'         => __('Header Buttons Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-register-btn a', '.pm-login-btn a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-register-btn a', '.pm-login-btn a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styles for the micro navigation buttons.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),
				
				array(
					'id'            => 'opt-quick-login-font',
					'type'          => 'typography',
					'title'         => __('Quick Login Panel Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-quick-login-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-quick-login-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font style for the quick login panel.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),
				
				array(
					'id'            => 'opt-quick-login-links-font',
					'type'          => 'typography',
					'title'         => __('Quick Login Panel Links Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-quick-login-container a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-quick-login-container a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font style for links in the quick login panel.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#DBC164',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),

			
			  )//end of fields
			
			);//end of section
			
			// FOOTER OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Footer Options', 'quantumtheme'),
			  'heading'   => __('Manage options for the footer area.', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-footer-copyright',
					'type'      => 'text',
					'title'     => __('Copyright Notice', 'quantumtheme'),
					'subtitle'  => __('This field supports HTML tags.', 'quantumtheme'),
					//'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'quantumtheme'),
					//'validate'  => 'html',
					//'default' => ''
				),
				
				
				array(
					'id'            => 'opt-footer-widget-title',
					'type'          => 'typography',
					'title'         => __('Footer Widget Title', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-fat-footer h6', '.pm-fat-footer h6 p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-fat-footer h6', '.pm-fat-footer h6 p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Footer Widget Title.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-style'    => 'bold',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '30px'),
				),//end of field
				
				array(
					'id'            => 'opt-footer-font',
					'type'          => 'typography',
					'title'         => __('Footer Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-footer-social-info-container p', '.pm-footer-subscribe-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-footer-social-info-container p', '.pm-footer-subscribe-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling in the social media footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '24px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-footer-title-font',
					'type'          => 'typography',
					'title'         => __('Footer Title Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-footer-social-info-container h6', '.pm-footer-subscribe-container h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-footer-social-info-container h6', '.pm-footer-subscribe-container h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for titles in the social media footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#dbc164',
						'font-weight'    => '700',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
						'line-height'   => '24px',
						'text-transform' => 'uppercase'
					),
				),//end of field
				
				array(
					'id'            => 'opt-footer-info-font',
					'type'          => 'typography',
					'title'         => __('Fat Footer Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-career-opening-widget-post p', '.pm-workshop-widget-post p', '.pm-widget-footer .pm-recent-blog-post-details .pm-date-published'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-widget-footer p', '.pm-widget-footer .textwidget', '.tweet_list li', '.pm-career-opening-widget-post p', '.pm-workshop-widget-post p', '.pm-widget-footer .pm-recent-blog-post-details .pm-date-published'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling in the fat footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'   => '24px'),
				),//end of field
				
				array(
					'id'            => 'opt-footer-link-font',
					'type'          => 'typography',
					'title'         => __('Fat Footer Link Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.tweet_list li a', '.pm-career-opening-widget-post a', '.pm-workshop-widget-post a', '.pm-widget-footer ul li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.tweet_list li a', '.pm-career-opening-widget-post a', '.pm-workshop-widget-post a', '.pm-widget-footer ul li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the link tag in the fat footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#dbc164',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',
						'line-height'   => '24px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-footer-nav-links',
					'type'          => 'typography',
					'title'         => __('Footer Navigation Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
					//'subsets'       => false, // Only appears if google is true and subsets not set to false
					//'font-size'     => false,
					//'line-height'   => false,
					//'word-spacing'  => true,  // Defaults to false
					//'letter-spacing'=> true,  // Defaults to false
					//'color'         => false,
					//'preview'       => false, // Disable the previewer
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-footer-navigation li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-footer-navigation li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the navigation in the footer area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '11px',
					),
				),//end of field
			
			  )//end of fields
			
			);//end of section
				
			
			//SHORTCODE OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Shortcode Options', 'quantumtheme'),
			  'heading'   => __('Manages options and font styles for particular shortcodes.', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-client-carousel-link',
					'type'          => 'typography',
					'title'         => __('Client Carousel URL font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-parnters-post-url a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-parnters-post-url a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the client carousel URL link.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#888888',
						'font-weight'    => '600',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-client-carousel-featured',
					'type'          => 'typography',
					'title'         => __('Client Carousel Featured font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-parnters-post-featured'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-parnters-post-featured'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the client carousel featured text.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-testimonials-quote-font',
					'type'          => 'typography',
					'title'         => __('Testimonial Carousel quote font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-testimonial-text-box p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-testimonial-text-box p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the testimonial carousel quote text.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-style'	=> 'italic',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '18px',
						'line-height'	=> '28px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-testimonials-name-title-font',
					'type'          => 'typography',
					'title'         => __('Testimonial Carousel name and title font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-testimonial-name', '.pm-testimonial-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-testimonial-name', '.pm-testimonial-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the testimonial carousel name and title text.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
						'line-height'	=> '0',
						'text-transform' => 'uppercase'
					),
				),//end of field
				
				array(
					'id'            => 'opt-countdown-font',
					'type'          => 'typography',
					'title'         => __('Countdown font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-countdown-container'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-countdown-container'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the countdown shortcode.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '42px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-cta2-font',
					'type'          => 'typography',
					'title'         => __('Call to action version 2 text', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-cta-text'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-cta-text'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Call to Action version 2 shortcode.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '30px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-alerts-font',
					'type'          => 'typography',
					'title'         => __('Alerts', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.alert'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for Alert shortcode.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-statbox1-font',
					'type'          => 'typography',
					'title'         => __('Stat Box 1', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-statistic-box-container h3', '.pm-statistic-box-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-statistic-box-container h3', '.pm-statistic-box-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Stat Box 1 shortcode.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'	=> 'normal',
						'font-family'   => 'Roboto',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-pie-chart-font',
					'type'          => 'typography',
					'title'         => __('Pie Chart', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-pie-chart .pm-pie-chart-percent', '.pm-pie-chart-description', '.milestone .milestone-description', '.milestone.alt .milestone-description'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Pie Chart shortcode.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5e5e5e',
						'font-style'	=> 'normal',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
			
			  )//end of fields
			
			);//end of section
			
			
			//POST OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Post Options', 'quantumtheme'),
			  'heading'   => __('Manage options and font styles for News Posts.', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-post-title-font',
					'type'          => 'typography',
					'title'         => __('Post Title', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-title'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-title'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post title.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '600',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '18px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-post-month-day-font',
					'type'          => 'typography',
					'title'         => __('Post Month and Day', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-date.pm-month', '.pm-single-blog-post-date.pm-day'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-date.pm-month', '.pm-single-blog-post-date.pm-day'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post month and day font.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#000000',
						'font-family'   => 'Open sans',
						'google'        => true,
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-post-pagination-font',
					'type'          => 'typography',
					'title'         => __('Post Pagination', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-post-pagination li a', '.pm-post-pagination li span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-post-pagination li a', '.pm-post-pagination li span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post pagination font.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#959595',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
						'line-height'   => '36px'
					),
				),//end of field
				
							
				
				array(
					'id'            => 'opt-post-tag-font',
					'type'          => 'typography',
					'title'         => __('Category and Tag Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-categories li a', '.pm-single-blog-post-tags li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-categories li a', '.pm-single-blog-post-tags li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post category and tag links.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#969696',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
				
				array(
					'id'            => 'opt-post-author-font',
					'type'          => 'typography',
					'title'         => __('Author Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-author-details.author-name', '.pm-single-blog-post-author-details .author-name span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-author-details.author-name', '.pm-single-blog-post-author-details .author-name span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post author name.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#323232',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '18px',),
				),//end of field
				
				array(
					'id'            => 'opt-post-author-bio-font',
					'type'          => 'typography',
					'title'         => __('Author Bio Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-author-details p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-author-details p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post author bio.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#323232',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
				array(
					'id'            => 'opt-post-share-font',
					'type'          => 'typography',
					'title'         => __('Share Post Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-author-box-share p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-author-box-share p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the post share font.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '24px',),
				),//end of field
				
				array(
					'id'            => 'opt-post-sections-font',
					'type'          => 'typography',
					'title'         => __('Post Sections Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-single-blog-post-related-posts h3', '.pm-single-blog-post-comments h3', '.pm-submit-comment-form-container h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-single-blog-post-related-posts h3', '.pm-single-blog-post-comments h3', '.pm-submit-comment-form-container h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for each section on a single post page.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '30px',),
				),//end of field
									
			
			  )//end of fields
			
			);//end of section
			
			
			//GLOBAL FONTS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Global Fonts', 'quantumtheme'),
			  'heading'   => __('Manage Global Font Styles.', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'            => 'opt-body-font',
					'type'          => 'typography',
					'title'         => __('Body Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('p', '#pm-contact-form-response', '.pm-pricing-table-offer ul li', '.pm-progress-bar-description', '.pm-progress-bar-description span', 'cite', '.pm-workshop-newsletter-form-container input[type="text"]', '.pm-workshop-newsletter-submit-btn', '.pm-search-box input', '.pm-statistic-box-desc'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('p', '#pm-contact-form-response', '.pm-pricing-table-offer ul li', '.pm-progress-bar-description', '.pm-progress-bar-description span', 'cite', '.pm-workshop-newsletter-form-container input[type="text"]', '.pm-workshop-newsletter-submit-btn', '.pm-search-box input', '.pm-statistic-box-desc'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the main body font throughout the site.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-global-link-font',
					'type'          => 'typography',
					'title'         => __('Global Link', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the global A tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2B5C84',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header1',
					'type'          => 'typography',
					'title'         => __('H1', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 1 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2A5C81',
						'font-weight'    => '300',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '48px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header2',
					'type'          => 'typography',
					'title'         => __('H2', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 2 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#595959',
						'font-weight'    => '300',
						'font-family'   => 'Lato',
						'google'        => true,
						'font-size'     => '30px',),
				),//end of field
				
				array(
					'id'            => 'opt-header3',
					'type'          => 'typography',
					'title'         => __('H3', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h3'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 3 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '30px',),
				),//end of field
				
				array(
					'id'            => 'opt-header4',
					'type'          => 'typography',
					'title'         => __('H4', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h4'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 4 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5d83',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'text-transform' => 'uppercase',
						'font-size'     => '48px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-header5',
					'type'          => 'typography',
					'title'         => __('H5', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h5'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 5 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '200',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
						'line-height'   => '32px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-header6',
					'type'          => 'typography',
					'title'         => __('H6', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Update the font styling for the Header 6 tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'line-height'   => '28px'
					),
				),//end of field
				
				array(
					'id'            => 'opt-button-font',
					'type'          => 'typography',
					'title'         => __('Button Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-rounded-btn a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-rounded-btn a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for buttons.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#9e9e9e',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-widget-header',
					'type'          => 'typography',
					'title'         => __('Sidebar Widget Title', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .pm-widget h6', '.pm-sidebar .pm-widget h6 p', '.pm-sidebar .woocommerce h6'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .pm-widget h6', '.pm-sidebar .pm-widget h6 p', '.pm-sidebar .woocommerce h6'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the widget title in the sidebar area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#414141',
						'font-weight'    => '500',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '18px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-tag-button',
					'type'          => 'typography',
					'title'         => __('Sidebar Tag Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar .tagcloud a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the button font styling for the tags widget.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#9e9e9e',
						'font-style'    => 'bold',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
						'text-transform' => 'uppercase',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar p', '.textwidget', '#wp-calendar caption', '#wp-calendar thead th', '.recentcomments'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar p', '.textwidget', '#wp-calendar caption', '#wp-calendar thead th', '.recentcomments'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the sidebar area.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#8e8e8e',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '13px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-sidebar-link-font',
					'type'          => 'typography',
					'title'         => __('Sidebar Link Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-sidebar a', '.pm-sidebar-popular-posts li a', '.pm-recent-blog-post-details a', '.pm-sidebar .widget_categories ul a', '.widget_recent_entries .pm-widget-spacer ul li a', '.pm-sidebar #recentcomments a', '.pm-sidebar .widget_pages ul li a', '.pm-sidebar .widget_meta ul li a', '.pm-recent-blog-post-details .pm-date-published'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-sidebar a', '.pm-sidebar-popular-posts li a', '.pm-recent-blog-post-details a', '.pm-sidebar .widget_categories ul a', '.widget_recent_entries .pm-widget-spacer ul li a', '.pm-sidebar #recentcomments a', '.pm-sidebar .widget_pages ul li a', '.pm-sidebar .widget_meta ul li a', '.pm-recent-blog-post-details .pm-date-published'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for all links in the sidebar.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#8e8e8e',
						'font-weight'    => '300',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-widget-category',
					'type'          => 'typography',
					'title'         => __('Category Widget', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array(''), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array(''), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the category widget.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#595959',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '12px',),
				),//end of field
				
				array(
					'id'            => 'opt-tooltip-font',
					'type'          => 'typography',
					'title'         => __('Tooltip Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#pm_marker_tooltip'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the tooltip.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-weight'    => '100',
						'font-family'   => 'Open sans',
						'google'        => true,
						'font-size'     => '12px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-undordered-list-font',
					'type'          => 'typography',
					'title'         => __('Unordered List Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('ul', 'ol'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('ul', 'ol'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the undordered and orderded lists.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'   => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-block-quote-font',
					'type'          => 'typography',
					'title'         => __('Block Quote Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('blockquote'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('blockquote'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the blockquote tag.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
								
				array(
					'id'            => 'opt-comment-author-font',
					'type'          => 'typography',
					'title'         => __('Comments Author Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-comment-box-avatar-container p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-comment-box-avatar-container p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the comment author name.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#414141',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '18px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-comment-notification-font',
					'type'          => 'typography',
					'title'         => __('Comments Notification Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-comment-required'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-comment-required'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for comment notifications.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FF0000',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-comment-html-tags-font',
					'type'          => 'typography',
					'title'         => __('Comments HTML Tags Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-comment-html-tags span', '.pm-comment-html-tags p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-comment-html-tags span', '.pm-comment-html-tags p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the comment HTML tags.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#777777',
						'font-weight'    => '100',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-quick-login-notification-font',
					'type'          => 'typography',
					'title'         => __('Quick Login Notification Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-quick-login-message span'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-quick-login-message span'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the comment HTML tags.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',
					),
				),//end of field
				
				
				array(
					'id'            => 'opt-post-slider-title-font',
					'type'          => 'typography',
					'title'         => __('Post Slider Title Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-presentation-text h1'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-presentation-text h1'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Post Slider title.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '52px',
					),
				),//end of field
				
				array(
					'id'            => 'opt-post-slider-message-font',
					'type'          => 'typography',
					'title'         => __('Post Slider Message Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'line-height'   => true,
					'word-spacing'  => true,  // Defaults to false
					'letter-spacing' => true,  // Defaults to false
					'text-transform' => true,  // Defaults to false
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.pm-presentation-text p'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.pm-presentation-text p'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the font styling for the Post Slider message.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#ffffff',
						'font-weight'    => '400',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',
					),
				),//end of field
			
			  )//end of fields
			
			);//end of section
            
			//WOOCOMMERCE OPTIONS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Woocommerce Options', 'quantumtheme'),
			  'heading'   => __('Manage options and font styles for the Woocommerce Shopping Cart.', 'quantumtheme'),
			  'desc'      => __('<p class="description">This section only applies if the Woocommerce plug-in is installed and activated.</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				
				
				array(
					'id'            => 'opt-woo-tab-font',
					'type'          => 'typography',
					'title'         => __('Tab Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-tabs .tabs li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the tab font for Woocommerce tab system.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5c84',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
				array(
					'id'            => 'opt-woo-tab-title-font',
					'type'          => 'typography',
					'title'         => __('Tab Title Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('#tab-description h2', '.woocommerce-Reviews h2', '.related.products > h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('#tab-description h2', '.woocommerce-Reviews h2', '.related.products > h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the tab title font for Woocommerce tab system.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2B5C84',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '30px',),
				),//end of field
				
				
				array(
					'id'            => 'opt-woo-form-title-font',
					'type'          => 'typography',
					'title'         => __('Form Title Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-billing-fields > h3', '.woocommerce-additional-fields > h3', '#order_review_heading', '.cart_totals > h2'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-billing-fields > h3', '.woocommerce-additional-fields > h3', '#order_review_heading', '.cart_totals > h2'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the title font for Woocommerce forms.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2b5c84',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '24px',),
				),//end of field
				
				array(
					'id'            => 'opt-woo-form-font',
					'type'          => 'typography',
					'title'         => __('Form Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce address', '.row.cart_item', '.cart_totals table', '.woocommerce-billing-fields label', '.shop_table', '.customer_details'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce address', '.row.cart_item', '.cart_totals table', '.woocommerce-billing-fields label', '.shop_table', '.customer_details'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the body font for Woocommerce forms.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#5f5f5f',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field
				
				array(
					'id'            => 'opt-woo-form-links-font',
					'type'          => 'typography',
					'title'         => __('Form Links Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.row.cart_item a', '.woocommerce-message a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.row.cart_item a', '.woocommerce-message a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the links font for Woocommerce forms.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#2C5E83',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '14px',),
				),//end of field

				
				array(
					'id'            => 'opt-woo-message-font',
					'type'          => 'typography',
					'title'         => __('Message Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-message', '.woocommerce-info'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-message', '.woocommerce-info'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the pop-up message font throughout Woocommerce sections. (ex. when adding an item to the cart)', 'quantumtheme'),
					'default'       => array(
						'color'         => '#666666',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '13px',),
				),//end of field
				
				array(
					'id'            => 'opt-woo-product-archive-title-font',
					'type'          => 'typography',
					'title'         => __('Product Archive Title Font', 'quantumtheme'),
					//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
					'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
					'font-backup'   => true,    // Select a backup non-google font in addition to a google font
					'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
					'output'        => array('.woocommerce-loop-product__title', '.woocommerce ul.cart_list li a', '.woocommerce ul.product_list_widget li a'), // An array of CSS selectors to apply this font style to dynamically
					'compiler'      => array('.woocommerce-loop-product__title', '.woocommerce ul.cart_list li a', '.woocommerce ul.product_list_widget li a'), // An array of CSS selectors to apply this font style to dynamically
					'units'         => 'px', // Defaults to px
					'subtitle'      => __('Updates the product title font on the Woocommerce shop.', 'quantumtheme'),
					'default'       => array(
						'color'         => '#FFFFFF',
						'font-style'    => 'Normal',
						'font-family'   => 'Open Sans',
						'google'        => true,
						'font-size'     => '18px',),
				),//end of field
				
				
				
			
			  )//end of fields
			
			);//end of section
			
			
			
			//GLOBAL MESSAGES
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Global Messages', 'quantumtheme'),
			  'heading'   => __('Global Messages', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'global-login-message',
                        'type'      => 'textarea',
                        'title'     => __('Global Login Message', 'quantumtheme'),
                        'subtitle'  => __('This message will appear on the login page and any other pages where a login form appears such as private posts.', 'quantumtheme'),
                        //'desc'      => __('This field is even HTML validated!', 'quantumtheme'),
                        'validate'  => 'html',
						'default'   => ''
                 ),
				array(
                        'id'        => 'global-register-message',
                        'type'      => 'textarea',
                        'title'     => __('Global Registration Message', 'quantumtheme'),
                        'subtitle'  => __('This message will appear on the login page and any other pages where a login form appears such as private posts.', 'quantumtheme'),
                        //'desc'      => __('This field is even HTML validated!', 'quantumtheme'),
                        'validate'  => 'html',
						'default'   => ''
                 ),
				 array(
                        'id'        => 'forgot-password-message',
                        'type'      => 'textarea',
                        'title'     => __('Forgot Password Message', 'quantumtheme'),
                        'subtitle'  => __('This message will appear on the password reset page.', 'quantumtheme'),
                        //'desc'      => __('This field is even HTML validated!', 'quantumtheme'),
                        'validate'  => 'html',
						'default'   => ''
                 ),
				 array(
                        'id'        => 'private-post-message',
                        'type'      => 'textarea',
                        'title'     => __('Private Post Message', 'quantumtheme'),
                        'subtitle'  => __('This message will appear on a private post.', 'quantumtheme'),
                        //'desc'      => __('This field is even HTML validated!', 'quantumtheme'),
                        'validate'  => 'html',
						'default'   => ''
                 ),
				 
				 array(
                        'id'        => 'header-panel-text',
                        'type'      => 'textarea',
                        'title'     => __('Quick Login Panel Text', 'quantumtheme'),
                        'subtitle'  => __('This message will appear in the header login area.', 'quantumtheme'),
                        //'desc'      => __('This field is even HTML validated!', 'quantumtheme'),
                        'validate'  => 'html',
						'default'   => '<p>Not Registered? <a href="#">Click here</a> to sign up</p>'
                 ),
				 											
			  )//end of fields
			  			
			);//end of section
			
			
			
			
			
			//CUSTOM SLIDER
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Slider', 'quantumtheme'),
			  'heading'   => __('Custom Slider', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
                        'id'        => 'opt-custom-slider',
                        'type'      => 'text',
                        'title'     => __('Custom Slider', 'quantumtheme'),
                        'subtitle'  => __('You can display a custom slider on the default index page by providing a slider shortcode here. <strong>NOTE:</strong> Be sure to disable the Post Slider under Appearance -> Customize Quantum -> Post Slider Options', 'quantumtheme'),
                        //'desc'      => __('NOTE: if you would like your slider to sit underneath the navigation bar than wrap your shortcode within the "sliderContainer" shortcode.', 'quantumtheme'),
                        //'validate'  => 'html',
						'default' => ''
                    ),
				
											
			  )//end of fields
			
			);//end of section
			
			
			//TESTIMONIALS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Testimonials Carousel', 'quantumtheme'),
			  'heading'   => __('Testimonials Carousel', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-testimonials-slides',
					'type'      => 'slides',
					'title'     => __('Testimonial Slides', 'quantumtheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'quantumtheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'quantumtheme'),
					'placeholder'   => array(
						'title'         => __('Authors name', 'quantumtheme'),
						'description'   => __('Quote', 'quantumtheme'),
						'url'           => __('Authors title', 'quantumtheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			//CLIENTS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Clients Carousel', 'quantumtheme'),
			  'heading'   => __('Clients Carousel', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-client-slides',
					'type'      => 'slides',
					'title'     => __('Client Slides', 'quantumtheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'quantumtheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'quantumtheme'),
					'placeholder'   => array(
						'title'         => __('Client name', 'quantumtheme'),
						'description'   => __('Featured Text', 'quantumtheme'),
						'url'           => __('Client URL', 'quantumtheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
			//PANELS CAROUSEL
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Panels Carousel', 'quantumtheme'),
			  'heading'   => __('Panels Carousel', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here
				array(
					'id'        => 'opt-panel-slides',
					'type'      => 'slides',
					'title'     => __('Panel Slides', 'quantumtheme'),
					'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'quantumtheme'),
					'desc'      => __('This field will store all slides values into a multidimensional array to use into a foreach loop.', 'quantumtheme'),
					'placeholder'   => array(
						'title'         => __('Title', 'quantumtheme'),
						'description'   => __('Description', 'quantumtheme'),
						'url'           => __('Icon - URL', 'quantumtheme'),
					),
				),
											
			  )//end of fields
			
			);//end of section
			
						
			
			//CUSTOM POST TYPE SLUGS
			$this->sections[] = array(

			  'icon'      => 'el-icon-cogs',
			  'title'     => __('Custom Post Type Slugs', 'quantumtheme'),
			  'heading'   => __('Custom Post Type Slugs', 'quantumtheme'),
			  //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed2</p>', 'quantumtheme'),
			
			  'fields'    => array(
				  
				//Fields go here				
				array(
					'id'        => 'opt-careers-post-type-slug',
					'type'      => 'text',
					'title'     => __('Careers Post Type Slug', 'redux-framework-demo'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
					'desc'      => __('Set a custom slug name for the Careers post type (ex. employment, job-post, etc).', 'redux-framework-demo'),
					'validate'  => 'no_html',
					'default'   => 'career'
				),
				
				array(
					'id'        => 'opt-gallery-post-type-slug',
					'type'      => 'text',
					'title'     => __('Gallery Post Type Slug', 'redux-framework-demo'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
					'desc'      => __('Set a custom slug name for the Gallery post type (ex. gallery, gallery-post, gallery-item, etc).', 'redux-framework-demo'),
					'validate'  => 'no_html',
					'default'   => 'gallery'
				),
				
				array(
					'id'        => 'opt-staff-post-type-slug',
					'type'      => 'text',
					'title'     => __('Staff Post Type Slug', 'redux-framework-demo'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
					'desc'      => __('Set a custom slug name for the Staff post type (ex. staff-member, member-profile etc).', 'redux-framework-demo'),
					'validate'  => 'no_html',
					'default'   => 'staff-member'
				),
				
				array(
					'id'        => 'opt-workshops-post-type-slug',
					'type'      => 'text',
					'title'     => __('Workshops Post Type Slug', 'redux-framework-demo'),
					//'subtitle'  => __('Quickly add some CSS to your theme by adding it to this block.', 'redux-framework-demo'),
					'desc'      => __('Set a custom slug name for the Workshops post type (ex. workshop, workshop-post, class, etc).', 'redux-framework-demo'),
					'validate'  => 'no_html',
					'default'   => 'workshop'
				),
				
				
											
			  )//end of fields
			
			);//end of section
					    

			// IMPORT / EXPORT SETTINGS
            $this->sections[] = array(
                'title'     => __('Import / Export', 'quantumtheme'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'quantumtheme'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
            
			// TAB DIVIDER
            $this->sections[] = array(
                'type' => 'divide',
            );

			// THEME INFORMATION
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'quantumtheme'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'quantumtheme'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
			
        }

        /*public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'quantumtheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'quantumtheme')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'quantumtheme'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'quantumtheme')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'quantumtheme');
        }*/

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'quantum_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Quantum Options', 'quantumtheme'),
                'page_title'        => __('Quantum Options', 'quantumtheme'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDBQJU8Cqmk_fxV1jvZeOdA3IpFL0Sq0js', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => false,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.


                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'quantumtheme'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'quantumtheme');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'quantumtheme');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
