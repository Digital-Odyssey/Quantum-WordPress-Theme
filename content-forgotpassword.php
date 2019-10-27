<?php
/**
 * The default template for displaying the reset password page for members
 */
?>

<?php 

	//Redux options
	global $quantum_options;
	
	$membersAccountSlug = get_option('pm_members_account_template_slug');

	if(is_user_logged_in()) {
		
		if($membersAccountSlug !== ''){
			wp_redirect( site_url($membersAccountSlug) );
		} else {
			wp_redirect( site_url('members-account') );	
		}
		
		
		exit;
	}

?>

    
<?php
	global $wpdb;

	$error = '';
	$success = '';
	
	// check if we're in reset form
	if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
	{
		$email = $wpdb->escape(trim($_POST['user_email_address']));
		
		if( empty( $email ) ) {
			$error = esc_attr__('Enter your e-mail address.', 'quantumtheme');
		} else if( ! is_email( $email )) {
			$error =  esc_attr__('Invalid e-mail address.', 'quantumtheme');
		} else if( ! email_exists( $email ) ) {
			$error = esc_attr__('There is no user registered with that email address.', 'quantumtheme');
		} else {
		
			$random_password = wp_generate_password( 12, false );
			$user = get_user_by( 'email', $email );
			
			$update_user = wp_update_user( array (
					'ID' => $user->ID,
					'user_pass' => $random_password
				)
			);
			
			// if update user return true then lets send user an email containing the new password
			if( $update_user ) {
								
				$to = $email;
				$subject = esc_attr__('Member Password Reset', 'quantumtheme');
				$sender = get_option('name');
				
				$message = esc_attr__('You have requested to have your password reset. Your new membership password is:', 'quantumtheme') .' '. $random_password;
				
				$headers[] = 'MIME-Version: 1.0' . "\r\n";
				$headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers[] = "X-Mailer: PHP \r\n";
				$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
				
				$mail = wp_mail( $to, $subject, $message, $headers );
				if( $mail ) {
					$success = esc_attr__('Check your email address for your new password.', 'quantumtheme');
				} else {
					$error = esc_attr__('Oops something went wrong updating your account. Please try again.', 'quantumtheme');
				}
					
			} else {
				$error = esc_attr__('Oops something went wrong updating your account. Please try again.', 'quantumtheme');
			}

		}
		
		if( ! empty( $error ) ) {
			echo '<div class="alert alert-warning" style="margin-bottom:20px;"><i class="typcn typcn-warning"></i> <strong>ERROR:</strong> '. $error .'</div>';
		}
		
		if( ! empty( $success ) ) {
			echo '<div class="alert alert-success" style="margin-bottom:20px;"><i class="typcn typcn-tick"></i> '. $success .'</div>';
		}
	}
?>

<!--html code-->
<form method="post">
	<fieldset>
		<p>
			<input type="text" class="pm-textfield" name="user_email_address" placeholder="<?php esc_attr_e('Email Address', 'quantumtheme'); ?>"  value="" /></p>
		<p>
			<input type="hidden" name="action" value="reset" />
			<input type="submit" value="Get New Password" class="button" id="submit" />
		</p>
	</fieldset>
</form>
