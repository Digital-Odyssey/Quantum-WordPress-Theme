<?php

//Restrict site login to administrators only
function pm_restrict_admin() {
	
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
	if ( !current_user_can( 'manage_options' ) && !current_user_can('moderate_comments') && !current_user_can('edit_posts') && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
          wp_redirect( site_url() );
	}
	
	/*if ( is_admin() && ! current_user_can( 'administrator' ) &&	! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}*/
	
}

//Check for failed login attempt and redirect user back to members login page
function pm_login_failed( $user ) {
	
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
  	// check what page the login attempt is coming from
  	$referrer = $_SERVER['HTTP_REFERER'];

  	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed' )) {
			// Redirect to the login page and append a querystring of login failed
	    	wp_redirect( $referrer . '?login=failed');
	    } else {
	      	wp_redirect( $referrer );
	    }

	    exit;
	}
}

//Check for a blank login
function pm_blank_login( $user ){
	
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
  	// check what page the login attempt is coming from
	$referrer = '';
	
	if(isset($_SERVER['HTTP_REFERER'])) {
      $referrer = $_SERVER['HTTP_REFERER'];
    }
  	
  	$error = false;
  	
	if(isset($_POST['log'])){
		if($_POST['log'] == '' || $_POST['pwd'] == '') {
			$error = true;
		}
	}

  	// check that were not on the default login page
  	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $error ) {

  		// make sure we don't already have a failed login attempt
    	if ( !strstr($referrer, '?login=failed') ) {
    		// Redirect to the login page and append a querystring of login failed
        	wp_redirect( $referrer . '?login=failed' );
      	} else {
        	wp_redirect( $referrer );
      	}

    	exit;

  	}
}

//Start a session if required
function pm_session_manager() {
	
	if ( function_exists('session_status') ) { //PHP >= 5.4.0
		
		 if (session_status() == PHP_SESSION_NONE) {
			session_start();
		 }
		
	} else {
		
		if (!session_id()) { //PHP < 5.4.0
			session_start();
		}
		
	}
   
}

//Triggers for logouts
function pm_session_logout() {
	
	$_SESSION['logged_out'] = 'true';
	
	if(isset($_SESSION['ota_members_info'])){
		unset($_SESSION['ota_members_info']);	
	}
	
	if(isset($_SESSION['user_firstname'])){
		unset($_SESSION['user_firstname']);
	}
	if(isset($_SESSION['user_prefix'])){
		unset($_SESSION['user_prefix']);
	}
	if(isset($_SESSION['user_middlename'])){
		unset($_SESSION['user_middlename']);
	}
	if(isset($_SESSION['user_lastname'])){
		unset($_SESSION['user_lastname']);
	}
	if(isset($_SESSION['user_suffix'])){
		unset($_SESSION['user_suffix']);
	}
	if(isset($_SESSION['user_designation'])){
		unset($_SESSION['user_designation']);
	}
	if(isset($_SESSION['user_title'])){
		unset($_SESSION['user_title']);
	}
	if(isset($_SESSION['user_organization'])){
		unset($_SESSION['user_organization']);
	}
	if(isset($_SESSION['user_email'])){
		unset($_SESSION['user_email']);
	}
	if(isset($_SESSION['user_workphone'])){
		unset($_SESSION['user_workphone']);
	}
	if(isset($_SESSION['user_homephone'])){
		unset($_SESSION['user_homephone']);
	}
	if(isset($_SESSION['user_faxnumber'])){
		unset($_SESSION['user_faxnumber']);
	}
	if(isset($_SESSION['user_website'])){
		unset($_SESSION['user_website']);
	}
	
	if(isset($_SESSION['user_address'])){
		unset($_SESSION['user_address']);
	}
	if(isset($_SESSION['user_city'])){
		unset($_SESSION['user_city']);
	}
	if(isset($_SESSION['user_state'])){
		unset($_SESSION['user_state']);
	}
	if(isset($_SESSION['user_zip'])){
		unset($_SESSION['user_zip']);
	}
	if(isset($_SESSION['user_country'])){
		unset($_SESSION['user_country']);
	}
    
	//session_destroy();
}


function restrict_dashboard() {
	if ( current_user_can( 'manage_options' ) ) {
		show_admin_bar();
	}	
}


function pm_show_extra_profile_fields( $user ) { ?>

	<?php 
	
	$user_prefix = get_user_meta($user->ID, 'user_prefix', true); 
	$user_workphone = get_user_meta($user->ID, 'user_workphone', true); 
	$user_homephone = get_user_meta($user->ID, 'user_homephone', true); 
	$user_faxnumber = get_user_meta($user->ID, 'user_faxnumber', true); 
	$user_organization = get_user_meta($user->ID, 'user_organization', true); 
	$user_designation = get_user_meta($user->ID, 'user_designation', true); 
	$user_title = get_user_meta($user->ID, 'user_title', true); 
	$user_address = get_user_meta($user->ID, 'user_address', true); 
	$user_city = get_user_meta($user->ID, 'user_city', true); 
	$user_state = get_user_meta($user->ID, 'user_state', true); 
	$user_zip = get_user_meta($user->ID, 'user_zip', true); 
	$user_country = get_user_meta($user->ID, 'user_country', true); 
	
	?>

    <h3><?php esc_attr_e('Member profile information', 'quantumtheme'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="user_prefix"><?php esc_attr_e('Prefix','quantumtheme'); ?></label></th>

			<td>
				<select name="user_prefix">
                  <option selected><?php esc_attr_e('Prefix', 'quantumtheme') ?></option>
                  <option value="mr" <?php selected( $user_prefix, 'mr' ); ?>><?php esc_attr_e('Mr.','quantumtheme'); ?></option>
                  <option value="ms" <?php selected( $user_prefix, 'ms' ); ?>><?php esc_attr_e('Ms.','quantumtheme'); ?></option>
                </select>
			</td>
		</tr>
        
        <tr>
			<th><label for="user_workphone"><?php esc_attr_e('Work Phone','quantumtheme'); ?></label></th>
			<td>
                <input name="user_workphone" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Work Phone','quantumtheme'); ?>" value="<?php echo $user_workphone; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_homephone"><?php esc_attr_e('Home Phone','quantumtheme'); ?></label></th>
			<td>
                <input name="user_homephone" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Home Phone','quantumtheme'); ?>" value="<?php echo $user_homephone; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_faxnumber"><?php esc_attr_e('Fax Number','quantumtheme'); ?></label></th>
			<td>
                <input name="user_faxnumber" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Fax Number','quantumtheme'); ?>" value="<?php echo $user_faxnumber; ?>">
			</td>
		</tr>        
        
        <tr>
			<th><label for="user_organization"><?php esc_attr_e('Organization','quantumtheme'); ?></label></th>
			<td>
                <input name="user_organization" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Organization','quantumtheme'); ?>" value="<?php echo $user_organization; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_designation"><?php esc_attr_e('Designation','quantumtheme'); ?></label></th>
			<td>
                <input name="user_designation" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Designation','quantumtheme'); ?>" value="<?php echo $user_designation; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_title"><?php esc_attr_e('Title','quantumtheme'); ?></label></th>
			<td>
                <input name="user_title" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Title','quantumtheme'); ?>" value="<?php echo $user_title; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_address"><?php esc_attr_e('Address','quantumtheme'); ?></label></th>
			<td>
                <input name="user_address" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Address','quantumtheme'); ?>" value="<?php echo $user_address; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_city"><?php esc_attr_e('City','quantumtheme'); ?></label></th>
			<td>
                <input name="user_city" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('City','quantumtheme'); ?>" value="<?php echo $user_city; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_state"><?php esc_attr_e('State/Province','quantumtheme'); ?></label></th>
			<td>
                <input name="user_state" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('State/Province','quantumtheme'); ?>" value="<?php echo $user_state; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_zip"><?php esc_attr_e('Zip/Postal','quantumtheme'); ?></label></th>
			<td>
                <input name="user_zip" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Zip/Postal','quantumtheme'); ?>" value="<?php echo $user_zip; ?>">
			</td>
		</tr>
        
        <tr>
			<th><label for="user_country"><?php esc_attr_e('Country','quantumtheme'); ?></label></th>
			<td>
                <input name="user_country" class="pm-textfield" type="text" placeholder="<?php esc_attr_e('Country','quantumtheme'); ?>" value="<?php echo $user_country; ?>">
			</td>
		</tr>        

	</table>
	
<?php }

function pm_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'manage_options' )  )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'user_prefix', $_POST['user_prefix'] );
	update_usermeta( $user_id, 'user_workphone', $_POST['user_workphone'] );
	update_usermeta( $user_id, 'user_homephone', $_POST['user_homephone'] );
	update_usermeta( $user_id, 'user_faxnumber', $_POST['user_faxnumber'] );
	update_usermeta( $user_id, 'user_organization', $_POST['user_organization'] );
	update_usermeta( $user_id, 'user_designation', $_POST['user_designation'] );
	update_usermeta( $user_id, 'user_title', $_POST['user_title'] );
	update_usermeta( $user_id, 'user_address', $_POST['user_address'] );
	update_usermeta( $user_id, 'user_city', $_POST['user_city'] );
	update_usermeta( $user_id, 'user_state', $_POST['user_state'] );
	update_usermeta( $user_id, 'user_zip', $_POST['user_zip'] );
	update_usermeta( $user_id, 'user_country', $_POST['user_country'] );
	
}


//Restrict dashboard bar to administrators only
add_action('wp_login', 'restrict_dashboard', 1);

//Session management
add_action('init', 'pm_session_manager');
add_action('wp_logout', 'pm_session_logout');

//restrict admin to administrators only
add_action( 'admin_init', 'pm_restrict_admin', 1 );

//failed login check
add_action( 'wp_login_failed', 'pm_login_failed' ); 

//Empty username or password check
add_action( 'authenticate', 'pm_blank_login'); 

//Disable WP admin bar
//add_filter('show_admin_bar', '__return_false');

//Add new user profile fields
add_action( 'show_user_profile', 'pm_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'pm_show_extra_profile_fields' );

add_action( 'personal_options_update', 'pm_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'pm_save_extra_profile_fields' );

?>