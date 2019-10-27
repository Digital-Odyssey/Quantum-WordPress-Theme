<?php
/**
 * The default template for displaying the login form for OTA members
 */
?>

<?php 

	global $quantum_options;
	
	$loginMessage = $quantum_options['global-login-message'];
	
	$membersAccountSlug = get_option('pm_members_account_template_slug');
	$membersAreaSlug = get_option('pm_members_area_template_slug');
	
?>


<?php 

	//Are we logged in?
	if ( is_user_logged_in() ) { 
		
		$current_user = wp_get_current_user();
		
		//redirect user to default page - board or executive based on member role
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		
		//do redirect
		if( $user_role == 'standard_member' ){
			
			//direct to account page
			if($membersAccountSlug !== ''){
				wp_redirect( site_url($membersAccountSlug) );
			} else {
				wp_redirect( site_url('members-account') );	
			}
			
			
		} elseif($user_role == 'board_member' || $user_role == 'executive_member' || $user_role == 'administrator') {
			
			//direct to board of directors page			
			if($membersAreaSlug !== ''){
				wp_redirect( site_url($membersAreaSlug) );
			} else {
				wp_redirect( site_url('members-area') );	
			}
						
		} else {
			
			//direct all other roles types to account page
			if($membersAccountSlug !== ''){
				wp_redirect( site_url($membersAccountSlug) );
			} else {
				wp_redirect( site_url('members-account') );	
			}
			
				
		}
		
		exit;
		
	} else {
				
		if(isset($_SESSION['logged_out'])){
									
			if( $_SESSION['logged_out'] == 'true' ){
				
				$_SESSION['logged_out'] = 'false';
				unset($_SESSION['logged_out']);

				echo '<div role="alert" class="alert alert-success alert-dismissible">';
					echo '<button data-dismiss="alert" class="close" type="button">';
						echo '<span aria-hidden="true">×</span>';
						echo '<span class="sr-only">Close</span>';
					echo '</button><i class="typcn typcn-tick"></i>';
					echo '<strong>Success!</strong> '.esc_attr__('You have successfully signed out of your account', 'quantumtheme').'';
				echo '</div>';
				
			}
			
		} else {
			
			
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
			
			
			echo '<p>' . wp_kses($loginMessage, $allowed_html) . '</p>'; 
			
				
		}
		
		if(isset($_GET['login']) && $_GET['login'] == 'failed'){
			?>
            	<div role="alert" class="alert alert-notice alert-dismissible">
                  <i class="typcn typcn-pin"></i>
                  <?php esc_attr_e('Invalid credentials, please try again.', 'quantumtheme'); ?>
                </div>
			<?php
		}
		
		
		$args = array(
					'echo' => true,
					'redirect' => get_permalink(), 
					'form_id' => 'pm-members-loginform',
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
		
		echo '<p><a href="'.site_url('forgot-password').'">'.esc_attr__("Lost your Password?", 'quantumtheme').'</a></p> ';
		
	}

?>