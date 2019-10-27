<?php /* Template Name: Members Account Template */ ?>
<?php get_header(); ?>

<?php 

	//Are we logged in?
	if ( is_user_logged_in() ) { 
	
		//Member area parameters
		$alertStatus = get_option('pm_member_email_alerts');
		$alertEmail = get_option('pm_admin_email_address');
	
		$form_success = true;
		
		$my_info_success = false;
		
		//flag inappropriate fields
		$email_error = '';
		
		//user is logged in, retrive user info
		global $current_user;
		
		//capture changed information for email notification
		$info_array = array();
		$address_array = array();
		
		//wp_kses args
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array()
		);
		
		//echo 'Fax number = ' . $current_user->user_faxnumber;
		
		$current_user = wp_get_current_user();
		//$current_user->user_login //username
		//$current_user->user_email
		//$current_user->user_firstname
		//$current_user->user_lastname
		//$current_user->display_name
		//$current_user->ID 
		//$current_user->user_url
		//$current_user->user_pass
		//$current_user->user_identity
		
		//$current_user->user_prefix
		//$current_user->user_designation
		//$current_user->user_title
		//$current_user->user_organization
		//$current_user->user_workphone
		//$current_user->user_homephone
		//$current_user->user_faxnumber
		//$current_user->user_address
		//$current_user->user_city
		//$current_user->user_state
		//$current_user->user_zip
		//$current_user->user_country
		
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		$user_role = str_replace('_', ' ', $user_role);
		$user_role = strtoupper($user_role);
		
		//Retrieve Member account info from ota_membersinfo and store it in a session
		global $wpdb;
		
		$_SESSION['user_prefix'] = get_user_meta($current_user->ID, 'user_prefix', true);			
		$_SESSION['user_firstname'] = $current_user->user_firstname;
		$_SESSION['user_lastname'] = $current_user->user_lastname;
		$_SESSION['user_email'] = $current_user->user_email;
		$_SESSION['user_workphone'] = get_user_meta($current_user->ID, 'user_workphone', true);
		$_SESSION['user_homephone'] = get_user_meta($current_user->ID, 'user_homephone', true);
		
		$_SESSION['user_faxnumber'] = get_user_meta($current_user->ID, 'user_faxnumber', true);
		$_SESSION['user_url'] = $current_user->user_url;
		$_SESSION['user_organization'] = get_user_meta($current_user->ID, 'user_organization', true);
		$_SESSION['user_designation'] = get_user_meta($current_user->ID, 'user_designation', true);
		$_SESSION['user_title'] = get_user_meta($current_user->ID, 'user_title', true);
		$_SESSION['user_address'] = get_user_meta($current_user->ID, 'user_address', true);
		
		$_SESSION['user_city'] = get_user_meta($current_user->ID, 'user_city', true);
		$_SESSION['user_state'] = get_user_meta($current_user->ID, 'user_state', true);
		$_SESSION['user_zip'] = get_user_meta($current_user->ID, 'user_zip', true);
		$_SESSION['user_country'] = get_user_meta($current_user->ID, 'user_country', true);
			
		
		/* 
		
			WP validation methods 
			
			data type where input neccessary (string) or (int) or (absint)
			
			is_email( $email_address )
			sanitize_text_field( $str )
			esc_url( $url ) - use to sanitize $current_user->user_url
			esc_html($url) - escape any HTML characters (converts < > & " ') to character codes
			wp_kses($data) - strips evil scripts and untrusted HTML
			
				
		*/
				
		
	} else {
		
		//redirect page back to homepage
		wp_redirect( home_url() );
		exit;
		
	}

?>

<!-- MEMBERS NAVIGATION -->
<?php get_template_part('content', 'membersnav'); ?>
<!-- MEMBERS NAVIGATION end -->

<!-- BODY AREA -->
        
<div class="container pm-containerPadding60">
    <div class="row">
        
        <div class="col-lg-12 pm-column-spacing">
            
            <h5 class="pm-secondary"><?php esc_attr_e('My Account', 'quantumtheme') ?></h5>
            
            <p><i class="fa fa-pencil"></i> &nbsp; <?php esc_attr_e('This is your place to manage your information. You can change your password, and update your contact information.', 'quantumtheme') ?></p>
            
            <br />
            
            <p class="pm-account-section pm-secondary"><?php esc_attr_e('Account Details', 'quantumtheme') ?></p>
            <div class="pm-divider"></div>
            
            <p><span class="pm-secondary"><?php esc_attr_e('Member ID:', 'quantumtheme') ?></span> <?php echo $current_user->ID; ?> &nbsp; <span class="pm-secondary"><?php esc_attr_e('Member Username:', 'quantumtheme'); ?></span> <?php echo $current_user->user_login; ?> &nbsp; <span class="pm-secondary"><?php esc_attr_e('Member Type:', 'quantumtheme') ?></span> <?php echo $user_role; ?></p>
            
            <br />
            
            <p class="pm-account-section pm-secondary"><?php esc_attr_e('My Information', 'quantumtheme') ?></p>
            <div class="pm-divider"></div>
            
            
            <?php

				//My Information form validation
				if( isset($_POST['pm-my-info-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_account_form_nonce'] ) || !wp_verify_nonce( $_POST['pm_account_form_nonce'], basename( __FILE__ ) ) ) {
						return;
					}
					
					//capture POST fields first
					$p_user_prefix = $_POST['user_prefix'];
					$p_user_firstname = sanitize_text_field($_POST['user_firstname']);
					$p_user_lastname = sanitize_text_field($_POST['user_lastname']);
					$p_user_email = sanitize_text_field($_POST['user_email']);
					$p_user_workphone = sanitize_text_field($_POST['user_workphone']);
					$p_user_homephone = sanitize_text_field($_POST['user_homephone']);
					
					$p_user_faxnumber = sanitize_text_field($_POST['user_faxnumber']);
					$p_user_url = wp_kses($_POST['user_url'], $allowed_html);
					$p_user_organization = sanitize_text_field($_POST['user_organization']);
					$p_user_designation = sanitize_text_field($_POST['user_designation']);
					$p_user_title = sanitize_text_field($_POST['user_title']);
					$p_user_address = sanitize_text_field($_POST['user_address']);
					
					$p_user_city = sanitize_text_field($_POST['user_city']);
					$p_user_state = sanitize_text_field($_POST['user_state']);
					$p_user_zip = sanitize_text_field($_POST['user_zip']);
					$p_user_country = sanitize_text_field($_POST['user_country']);
					
					//Check and capture which fields have been changed for email notification
					if($p_user_prefix !== $_SESSION['user_prefix']){
						$info_array['Prefix'] = $p_user_prefix;
					}
					if($p_user_firstname !== $_SESSION['user_firstname']){
						$info_array['First Name'] = $p_user_firstname;
					}
					if($p_user_lastname !== $_SESSION['user_lastname']){
						$info_array['Last Name'] = $p_user_lastname;
					}
					if($p_user_email !== $_SESSION['user_email']){
						$info_array['Email'] = $p_user_email;
					}
					if($p_user_workphone !== $_SESSION['user_workphone']){
						$info_array['Work Phone'] = $p_user_workphone;
					}
					if($p_user_homephone !== $_SESSION['user_homephone']){
						$info_array['Home Phone'] = $p_user_homephone;
					}
					
					
					if($p_user_faxnumber !== $_SESSION['user_faxnumber']){
						$info_array['Fax Number'] = $p_user_faxnumber;
					}
					if($p_user_url !== $_SESSION['user_url']){
						$info_array['Website'] = $p_user_url;
					}
					if($p_user_organization !== $_SESSION['user_organization']){
						$info_array['Organization'] = $p_user_organization;
					}
					if($p_user_designation !== $_SESSION['user_designation']){
						$info_array['Designation'] = $p_user_designation;
					}
					if($p_user_title !== $_SESSION['user_title']){
						$info_array['Title'] = $p_user_title;
					}
					if($p_user_address !== $_SESSION['user_address']) {
						$info_array['Address'] = $p_user_address;
					}
					
					if($p_user_city !== $_SESSION['user_city']) {
						$info_array['City'] = $p_user_city;
					}
					if($p_user_state !== $_SESSION['user_state']) {
						$info_array['State/Pro'] = $p_user_state;
					}
					if($p_user_zip !== $_SESSION['user_zip']) {
						$info_array['Zip/Postal'] = $p_user_zip;
					}
					if($p_user_country !== $_SESSION['user_country']) {
						$info_array['Country'] = $p_user_country;
					}
								
					//Update session vars
					$_SESSION['user_prefix'] = $p_user_prefix;
					$_SESSION['user_firstname'] = $p_user_firstname;
					$_SESSION['user_lastname'] = $p_user_lastname;
					$_SESSION['user_email'] = $p_user_email;
					$_SESSION['user_workphone'] = $p_user_workphone;
					$_SESSION['user_homephone'] = $p_user_homephone;
					
					$_SESSION['user_faxnumber'] = $p_user_faxnumber;
					$_SESSION['user_url'] = $p_user_url;
					$_SESSION['user_organization'] = $p_user_organization;
					$_SESSION['user_designation'] = $p_user_designation;
					$_SESSION['user_title'] = $p_user_title;
					$_SESSION['user_address'] = $p_user_address;
					
					$_SESSION['user_city'] = $p_user_city;
					$_SESSION['user_state'] = $p_user_state;
					$_SESSION['user_zip'] = $p_user_zip;
					$_SESSION['user_country'] = $p_user_country;
					
					if( !is_email($_SESSION['user_email']) ) {
						$form_success = false;
						$email_error = '<p style="color:red; font-size:12px; text-align:center;">'.esc_attr__('*Invalid email address. Please provide a valid email address.','quantumtheme').'</p>';
					}
					
					if($form_success){
						
						$users_table_query = wp_update_user( array ( 
																	'ID' => $current_user->ID, 
																	'user_url' => $_SESSION['user_url'], 
																	'user_email' => $_SESSION['user_email'],
																	) 
																);
						if($users_table_query){
							$my_info_success = true;
						}
						
						$user_meta_first_name = update_user_meta( $current_user->ID, 'first_name', $_SESSION['user_firstname']);
						if($user_meta_first_name){
							$my_info_success = true;
						}
						
						$user_meta_last_name = update_user_meta( $current_user->ID, 'last_name', $_SESSION['user_lastname']);
						if($user_meta_last_name){
							$my_info_success = true;
						}
						
						//Sanitize vars for SQL injection
						$user_prefix = esc_sql($_SESSION['user_prefix']);
						$user_designation = esc_sql($_SESSION['user_designation']);
						$user_title = esc_sql($_SESSION['user_title']);
						$user_organization = esc_sql($_SESSION['user_organization']);
						$user_workphone = esc_sql($_SESSION['user_workphone']);
						$user_homephone = esc_sql($_SESSION['user_homephone']);
						$user_faxnumber = esc_sql($_SESSION['user_faxnumber']);
						
						$user_address = esc_sql($_SESSION['user_address']);
						$user_city = esc_sql($_SESSION['user_city']);
						$user_state = esc_sql($_SESSION['user_state']);
						$user_zip = esc_sql($_SESSION['user_zip']);
						$user_country = esc_sql($_SESSION['user_country']);
						
						update_user_meta($current_user->ID, 'user_prefix', $user_prefix);
						update_user_meta($current_user->ID, 'user_designation', $user_designation);
						update_user_meta($current_user->ID, 'user_title', $user_title);
						update_user_meta($current_user->ID, 'user_organization', $user_organization);
						update_user_meta($current_user->ID, 'user_workphone', $user_workphone);
						update_user_meta($current_user->ID, 'user_homephone', $user_homephone);
						update_user_meta($current_user->ID, 'user_faxnumber', $user_faxnumber);
						
						update_user_meta($current_user->ID, 'user_address', $user_address);
						update_user_meta($current_user->ID, 'user_city', $user_city);
						update_user_meta($current_user->ID, 'user_state', $user_state);
						update_user_meta($current_user->ID, 'user_zip', $user_zip);
						update_user_meta($current_user->ID, 'user_country', $user_country);
						
						
						if($my_info_success){
							echo '<p style="color:green; text-align:left;">'.esc_attr__('Your information has been saved.','quantumtheme').'</p>';	
							
							//Send email to OTA administrator
							if($alertStatus === 'on'){
								sendEmail("personal", $alertEmail, $info_array);
							}
							
																			
						}
						
					} else {
						
						echo $email_error;
							
					}
					
				}
		
		?>
            
            <form action="<?php echo get_permalink(); ?>" method="post" class="pm-members-account-info-form">
            
                <div class="row">
                                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <select name="user_prefix">
                              <option selected><?php esc_attr_e('Prefix', 'quantumtheme') ?></option>
                              <option value="mr" <?php selected( $_SESSION['user_prefix'], 'mr' ); ?>><?php esc_attr_e('Mr.','quantumtheme'); ?></option>
              				  <option value="ms" <?php selected( $_SESSION['user_prefix'], 'ms' ); ?>><?php esc_attr_e('Ms.','quantumtheme'); ?></option>
                            </select>
                            <input name="user_firstname" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('First name','quantumtheme'); ?>" value="<?php echo $_SESSION['user_firstname']; ?>">
                            <input name="user_lastname" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Last name','quantumtheme'); ?>" value="<?php echo $_SESSION['user_lastname']; ?>">
                            <input name="user_email" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Email','quantumtheme'); ?>" value="<?php echo $_SESSION['user_email']; ?>">
                            <input name="user_workphone" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Work Phone','quantumtheme'); ?>" value="<?php echo $_SESSION['user_workphone']; ?>">
                            <input name="user_homephone" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Home Phone','quantumtheme'); ?>" value="<?php echo $_SESSION['user_homephone']; ?>">
                                                       
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input name="user_faxnumber" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Fax Number','quantumtheme'); ?>" value="<?php echo $_SESSION['user_faxnumber']; ?>">
                            <input name="user_url" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Website','quantumtheme'); ?>" value="<?php echo $_SESSION['user_url']; ?>">
                            <input name="user_organization" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Organization','quantumtheme'); ?>" value="<?php echo $_SESSION['user_organization']; ?>">
                            <input name="user_designation" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Designation','quantumtheme'); ?>" value="<?php echo $_SESSION['user_designation']; ?>">
                            <input name="user_title" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Title','quantumtheme'); ?>" value="<?php echo $_SESSION['user_title']; ?>">
                            <input name="user_address" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Address','quantumtheme'); ?>" value="<?php echo $_SESSION['user_address']; ?>">
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input name="user_city" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('City','quantumtheme'); ?>" value="<?php echo $_SESSION['user_city']; ?>">
                            <input name="user_state" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('State/Province','quantumtheme'); ?>" value="<?php echo $_SESSION['user_state']; ?>">
                            <input name="user_zip" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Zip/Postal','quantumtheme'); ?>" value="<?php echo $_SESSION['user_zip']; ?>">
                            <input name="user_country" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Country','quantumtheme'); ?>" value="<?php echo $_SESSION['user_country']; ?>">
                        </div>
                                                                   
                </div><!-- /row -->
                
                <div class="row">
                    <div class="col-lg-12">
                         <input type="submit" class="pm-rounded-submit-btn" value="<?php esc_attr_e('Save Changes','quantumtheme'); ?>" />
                    </div>
                </div>
                
                <?php wp_nonce_field( basename( __FILE__ ), 'pm_account_form_nonce' ); ?>

				<input type="hidden" name="pm-my-info-submitted" />
            
            </form>
            
            
            
            
            <p class="pm-account-section pm-secondary" style="margin-top:20px;"><?php esc_attr_e('Reset / Change Password','quantumtheme'); ?></p>
            <div class="pm-divider"></div>
            
            <?php 

				if( isset($_POST['pm-password-submitted']) ){
					
					//verify nonce
					if ( !isset( $_POST['pm_account_form_nonce'] ) || !wp_verify_nonce( $_POST['pm_account_form_nonce'], basename( __FILE__ ) ) ) {
						return;
					}
					
					//Validate current password first
					$validate_password = wp_check_password( $_POST['pm_current_password'], $current_user->user_pass, $current_user->ID );
					
					if($validate_password){
						
						//Cross match new password
						$pass1 = $_POST['pm_new_password'];
						$pass2 = $_POST['pm_confirm_new_password'];
						
						if($pass1 === $pass2){
							
							//Save new password
							wp_set_password( $pass1, $current_user->ID );
							echo '<p style="color:green;">'.esc_attr__('Your Password has been updated.','quantumtheme').'</p>';
							
							//Send email to OTA administrator
							if($alertStatus === 'on'){
								sendEmail("password", $alertEmail);
							}
							
						} else {
							echo '<p style="color:red; text-align:left;">'.esc_attr__('Passwords do not match. Please try again.','quantumtheme').'</p>';	
						}
						
					} else {
						echo '<p style="color:red; text-align:left;">'.esc_attr__('Current password does not match.','quantumtheme').'</p>';	
					}
					
						
					//echo '<p style="color:red; font-size:12px;">Reset / Change Password submitted</p>';
					
				}
			
			?>
            
            <div class="row">
            
                <form action="<?php echo get_permalink(); ?>" method="post" class="pm-members-account-info-form">
                
                    <div class="col-lg-6">
                        
                        <input name="pm_current_password" class="pm-textfield" type="password" placeholder="<?php esc_attr_e('Current Password','quantumtheme'); ?>">
                        <input name="pm_new_password" class="pm-textfield" type="password" placeholder="<?php esc_attr_e('New Password','quantumtheme'); ?>">
                        <input name="pm_confirm_new_password" class="pm-textfield" type="password" placeholder="<?php esc_attr_e('Confirm Password','quantumtheme'); ?>">
                        <input type="submit" class="pm-rounded-submit-btn" value="<?php esc_attr_e('Update Password','quantumtheme'); ?>" />
                        
                   
                    </div>
                    
                    <?php wp_nonce_field( basename( __FILE__ ), 'pm_account_form_nonce' ); ?>

					<input type="hidden" name="pm-password-submitted" />
                                            
                </form>
                                
            </div><!-- /row -->
            
        </div><!-- /col -->
                        
    </div><!-- /row -->
</div><!-- /col -->

<!-- BODY AREA end -->

<?php 

function sendEmail($infoType, $email_address, $data = ''){
	
	$subject = esc_attr__('Member account change: ', 'quantumtheme') .' '. ucfirst($infoType) .' '. esc_attr__('information updated', 'quantumtheme');
	$sender = 'Member administration';
	$email = 'donotreply@memberadministration.com';
	//$cc = 'leo@pulsarmedia.ca';
	//$to = 'leo@pulsarmedia.ca';
	
	$message = '';
	
	$message .= esc_attr__('The following member,', 'quantumtheme') .' '. $_SESSION['user_firstname'] .' '. $_SESSION['user_lastname'] .', '.esc_attr__('has updated there', 'quantumtheme') .' '. $infoType .' '. esc_attr__('information.', 'quantumtheme').' <br /><br />';
		
	
	if($infoType === "personal"){		
		
		if( $data !== '' ){
			
			$message .= esc_attr__('The following information was changed:', 'quantumtheme') . '<br /><br />';
			
			//Append changed data to email message
			while (list($key, $value) = each($data)) {
				$message .= "$key: $value <br />";
			}
			
		}
		
	}
	
	$headers[] = 'MIME-Version: 1.0' . "\r\n";
	$headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers[] = "X-Mailer: PHP \r\n";
	$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
	//$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n" . 'CC: '.$cc.'';
	
	$mail = wp_mail( $email_address, $subject, $message, $headers );
	
	
}

?>

<?php get_footer(); ?>