<?php

/*
Plugin Name: Members Area Plug-in
Plugin URI: http://www.pulsarmedia.ca
Description: Members Area Plug-in for Quantum WordPress Theme - developed by Micro Themes
Version: 1.3
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: 
*/

$pm_members_area_version = '1.3';

if ( !class_exists( 'PMMembersArea' ) ) {
	
	class PMMembersArea {
		
		//constructor
		public function __construct() {
			
			//Register plugin activation hook
			register_activation_hook(__FILE__, array(&$this, 'activation'));
			
			//Register plugin deactivation hook
			register_deactivation_hook( __FILE__, array( &$this, 'deactivation' ) );
			
			//add settings page
			add_action('admin_menu', array( &$this, 'pm_members_area_settings' ) );
			
			//set default role for new registrations
			add_filter('pre_option_default_role', array( &$this, 'pm_set_default_role_type' ) );
				
		}
		
		//set default role for new reistrations
		public function pm_set_default_role_type($default_role) {
			
			$pm_default_registration_role = get_option('pm_default_registration_role');
			
			return $pm_default_registration_role;
			//return $default_role;
				
		}
		
		//activate the plugin
		public function activation() {
			
			//create and save default registration role in WP database
			update_option('pm_default_registration_role', 'standard_member');
			
			//Get the default administrator role
			$role =& get_role( 'administrator' );
			
			//Add forum capabilities to the administrator role
			if ( !empty( $role ) ) {
				
				$role->add_cap( 'publish_forum_topics' );
				$role->add_cap( 'edit_others_forum_topics' );
				$role->add_cap( 'delete_forum_topics' );
				$role->add_cap( 'read_forum_topics' );
				
			}//end of if
			
			//Create the Standard Member role
			add_role(
				'standard_member',
				'Standard Member',
				array(
					'read' => true,
					'read_private_posts' => true,
				)
			);
			
			//Create the Board member role
			add_role(
				'board_member',
				'Board Member',
				array(
					'read' => true,
					'read_private_posts' => true,
				)
			);
			
			//Create the Executive Member role
			add_role(
				'executive_member',
				'Executive Member',
				array(
					'read' => true,
					'read_private_posts' => true,
				)
			);
						
		}
		
		//deactivate the plugin
		public function deactivation() {
			
			//delete default registration role in WP database
			delete_option('pm_default_registration_role');
			
			//Get the default administrator role
			$role =& get_role( 'administrator' );
			
			//Remove forum capabilities to the administrator role
			if ( !empty( $role ) ) {
				$role->remove_cap( 'publish_forum_topics' );
				$role->remove_cap( 'edit_others_forum_topics' );
				$role->remove_cap( 'delete_forum_topics' );
				$role->remove_cap( 'read_forum_topics' );
			}
		
			//Set up an array of roles to delete
			$roles_to_delete = array(
				'standard_member',
				'executive_member',
				'board_member'
			);
			
			//Loop through each role, deleting the role if necessary
			foreach( $roles_to_delete as $role ) {
			
				//Get the users of the role
				$users = get_users( array( 'role' => $role ) );
				
				//Check if there are no users for the role
				if ( count( $users ) <= 0 ) {
					/* Remove the role from the site. */
					remove_role( $role );
				}
			
			}//end of foreach
						
		}//end of function
		
		//Add sub menus
		public function pm_members_area_settings() {
	
			//create custom top-level menu
			add_menu_page( 'Members Area', 'Members Area', 'manage_options', __FILE__, array( &$this, 'pm_members_area_settings_page' ),	plugins_url( 'img/users.png', __FILE__ ) );
			
			//create sub-menu items
			//add_submenu_page( 'edit.php?post_type=premiumpaypalmanager', esc_attr__('Paypal Settings'),  esc_attr__('Paypal Settings'), 'manage_options', 'paypal_settings',  array( __CLASS__, 'pm_paypal_settings_page' ) );
			
			//create an options page under Settings tab
			//add_options_page('My API Plugin', 'My API Plugin', 'manage_options', 'pm_myplugin', 'pm_myplugin_option_page');	
		}
		
		public function pm_members_area_settings_page(){
			
			global $pm_members_area_version;
			
			//Save data first
			if (isset($_POST['pm_members_area_settings_update'])) {
				
				update_option('pm_default_registration_role', (string)$_POST["pm_default_registration_role"]);
				
				update_option('pm_member_email_alerts', (string)$_POST["pm_member_email_alerts"]);
				
				update_option('pm_display_archive_date', (string)$_POST["pm_display_archive_date"]);
				
				update_option('pm_admin_email_address', (string)$_POST["pm_admin_email_address"]);
				
				update_option('pm_custom_logout_url', (string)$_POST["pm_custom_logout_url"]);
				
				update_option('pm_members_area_template_slug', (string)$_POST["pm_members_area_template_slug"]);
				
				update_option('pm_members_account_template_slug', (string)$_POST["pm_members_account_template_slug"]);
				
				update_option('pm_members_view_orders_slug', (string)$_POST["pm_members_view_orders_slug"]);
				
				
				echo '<div id="message" class="updated fade"><h4>'.esc_attr__('Members Area settings been saved.', 'members-area-plugin').'</h4></div>';
				
			}//end of save data
			
			//Retrieve data
			$pm_default_registration_role = get_option('pm_default_registration_role');
			
			$pm_member_email_alerts = get_option('pm_member_email_alerts');
			
			$pm_display_archive_date = get_option('pm_display_archive_date');
			
			$pm_admin_email_address = get_option('pm_admin_email_address');
			
			$pm_custom_logout_url = get_option('pm_custom_logout_url');
			
			$pm_members_area_template_slug = get_option('pm_members_area_template_slug');
			
			$pm_members_account_template_slug = get_option('pm_members_account_template_slug');
			
			$pm_members_view_orders_slug = get_option('pm_members_view_orders_slug');
			
			
			?>
			
			<div class="wrap">
            
				<?php screen_icon(); ?>
                
				<h2><?php esc_attr_e('Members Area plug-in', 'members-area-plugin') ?> v<?php echo $pm_members_area_version; ?> <?php esc_attr_e('Settings', 'members-area-plugin') ?></h2>
                
                <h4><?php esc_attr_e('Configure the settings for the Members Area below:', 'members-area-plugin') ?></h4>
                
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                
                	<input type="hidden" name="pm_members_area_settings_update" id="pm_members_area_settings_update" value="true" />
                    
                    <div style="margin:20px 0;">
                        <label for="pm_default_registration_role"><strong><?php esc_attr_e('Select default registration role:', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <select id="pm_default_registration_role" name="pm_default_registration_role">
                          <option value="standard_member" <?php selected( $pm_default_registration_role, 'standard_member' ); ?>><?php esc_attr_e('Standard Member', 'members-area-plugin') ?></option>
                          <option value="board_member" <?php selected( $pm_default_registration_role, 'board_member' ); ?>><?php esc_attr_e('Board Member', 'members-area-plugin') ?></option>
                          <option value="executive_member" <?php selected( $pm_default_registration_role, 'executive_member' ); ?>><?php esc_attr_e('Executive Member', 'members-area-plugin') ?></option>
                        </select>
                        <p><em><?php esc_attr_e('Set the default registration role for new registrations.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_member_email_alerts"><strong><?php esc_attr_e('Toggle email alerts for member account changes?', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <select id="pm_member_email_alerts" name="pm_member_email_alerts">
                          <option value="on" <?php selected( $pm_member_email_alerts, 'on' ); ?>><?php esc_attr_e('ON', 'members-area-plugin') ?></option>
                          <option value="off" <?php selected( $pm_member_email_alerts, 'off' ); ?>><?php esc_attr_e('OFF', 'members-area-plugin') ?></option>
                        </select>
                        <p><em><?php esc_attr_e('Toggle email alerts for member account changes.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_display_archive_date"><strong><?php esc_attr_e('Display File Archive Date?', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <select id="pm_display_archive_date" name="pm_display_archive_date">
                          <option value="on" <?php selected( $pm_display_archive_date, 'on' ); ?>><?php esc_attr_e('ON', 'members-area-plugin') ?></option>
                          <option value="off" <?php selected( $pm_display_archive_date, 'off' ); ?>><?php esc_attr_e('OFF', 'members-area-plugin') ?></option>
                        </select>
                        <p><em><?php esc_attr_e('Toggle the file archive date that appears on the Members Area Template page.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_admin_email_address"><strong><?php esc_attr_e('Administrator Email Address', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <input type="text" name="pm_admin_email_address" value="<?php echo $pm_admin_email_address; ?>" style="width:500px;">
                        <p><em><?php esc_attr_e('Alerts will be sent to the email address provided here.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_custom_logout_url"><strong><?php esc_attr_e('Custom Logout URL', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <input type="text" name="pm_custom_logout_url" value="<?php echo $pm_custom_logout_url; ?>" style="width:500px;">
                        <p><em><?php esc_attr_e('Provide a custom local URL for logout redirection.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_members_area_template_slug"><strong><?php esc_attr_e('Members Area Template Slug', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <input type="text" name="pm_members_area_template_slug" value="<?php echo $pm_members_area_template_slug; ?>" style="width:500px;">
                        <p><em><?php esc_attr_e('This value needs to match the slug name of the page that has the <strong>Members Area Template assigned</strong> to it. This value will also be assigned to the members navigation system.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_members_account_template_slug"><strong><?php esc_attr_e('Members Account Template Slug', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <input type="text" name="pm_members_account_template_slug" value="<?php echo $pm_members_account_template_slug; ?>" style="width:500px;">
                        <p><em><?php esc_attr_e('This value needs to match the slug name of the page that has the <strong>Members Account Template</strong> assigned to it. This value will also be assigned to the members navigation system.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div style="margin:20px 0;">
                        <label for="pm_members_view_orders_slug"><strong><?php esc_attr_e('Members View Orders Slug', 'members-area-plugin') ?></strong></label>
                        <br /><br />
                        <input type="text" name="pm_members_view_orders_slug" value="<?php echo $pm_members_view_orders_slug; ?>" style="width:500px;">
                        <p><em><?php esc_attr_e('This value needs to match the slug name of the page that has the <strong>woocommerce_my_account shortcode</strong> applied to it in the visual editor. This value will also be assigned to the members navigation system.', 'members-area-plugin') ?></em></p>
                    </div>
                    
                    <div class="pm-payel-submit" style="margin:20px 0;">
                        <input type="submit" name="pm_settings_update" class="button button-primary" value="<?php esc_attr_e('Update Settings', 'members-area-plugin'); ?> &raquo;" />
                    </div>
                
                </form>
				
			</div>
			
			<?php
			
		}
		
	}//end of class
	
}//end of class collision check


$pmMembersArea = new PMMembersArea;

?>