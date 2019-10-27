<?php
/**
 * The default template for displaying executive committee files
 */
 
?>

<?php


	//Are we logged in?
	if ( is_user_logged_in() ) {
		
		$_SESSION['logged_out'] = 'false';
		
		//echo 'Session logged out status = ' . $_SESSION['logged_out'] ;
		
		global $wpdb;
		
		$current_user = wp_get_current_user();
		
		//print_r($user_info);
		
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);
		
		//echo '<p>Logged in</p>';
		
		//echo '<p>Username: ' . $current_user->user_login . "</p>";
	    //echo '<p>User email: ' . $current_user->user_email . "</p>";
	    //echo '<p>User first name: ' . $current_user->user_firstname . "</p>";
	    //echo '<p>User last name: ' . $current_user->user_lastname . "</p>";
	    //echo '<p>User display name: ' . $current_user->display_name . "</p>";
	    //echo '<p>User ID: ' . $current_user->ID . "</p>";
		//echo '<p>User Level: ' . $current_user->user_level . "</p>";
		//echo '<p>User Role: ' . $user_role . "</p>";
		//echo '<p>User Pass: ' . $current_user->user_pass . "</p>";
			
		//wp_hash_password( 'ota_member1' ) - Creates a hash of a plain text password
		
		$url_path = $_SERVER['REQUEST_URI'];
	 	$url_values = explode('/', $url_path);
		
		//check if we have a date in the URL
		$today = getdate();
		$current_date = $today['year'];
		
		if( isset($_GET['date']) ){
								
			//echo 'Archive date detected ';
			$current_date = (int) $_GET['date'];
			
			if($current_date === 0){
				$current_date = $today['year'];	
			} 
			
			//echo $current_date;
			
		}
		
		//RETRIEVE WORKSHOP FILES
		$arguments = array(
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'post_parent' => 0,
			'tax_query' => array(
				array('taxonomy' => 'file_assignment', 'field' => 'slug', 'terms' => array('workshop')),
				array('taxonomy' => 'archive_assignment', 'field' => 'slug', 'terms' => $current_date)
			),
		);
	
		$workshop_files = new WP_Query($arguments);
		$work_files = array();
				
		foreach ( $workshop_files->posts as $file) {
			//capture required data and store in an array which we will loop through in the next step
			$work_files[] = array($file->post_name, $file->guid); //post_name followed by post path
		}
		//print_r($work_files); exit;
		
		//Redux options
		global $quantum_options;
		$membersAreaSlug = get_option('pm_members_area_template_slug');
		$displayMemberFilesDates = get_option('pm_display_archive_date');
		
		echo '<p class="pm-account-section pm-secondary" style="font-size:22px !important;">'. ($membersAreaSlug !== '' ? ucwords(str_replace('-', ' ', esc_attr__($membersAreaSlug, 'quantumtheme'))) : esc_attr__('Member Files', 'quantumtheme')) .' '. ($displayMemberFilesDates === 'on' ? '('.$current_date.')' : '') .'</p>';
		
		if(count($work_files)){
						
			echo '<ul class="pm-workshop-files-ul">';
			foreach($work_files as $file){
								
				$postname = $file[0];
				$fileURL = $file[1];
				$filetype = substr($fileURL, strrpos( $fileURL, '.' )+1 );
				$file_explode = explode("_", $postname);
								
				//Capture and format filename
				$file_name = $file_explode[0];
				$fileNameFinal = createFileName($file_name);
				
				//Capture and format date
				$file_date = $file_explode[1];
				$fileDateFinal = createFileDate($file_date);
								
				echo '<li class="pm-workshop-file-row pm_tip_static_top" title="'.strtoupper($filetype).'">';
                    echo '<i class="fa fa-file-pdf-o pm-file-type"></i>';
                    echo '<div class="pm-member-workshop-file-box">';
                        echo '<p>'.$fileNameFinal.''. $fileDateFinal .'</p>';
                    echo '</div>';
                    echo '<a href="'.$file[1].'" class="fa fa-cloud-download pm-file-download" target="_blank"></a>';
                echo '</li>';
				
			}
			echo '</ul>';
		} else {
			echo '<p>'. esc_attr__('No files found.', 'quantumtheme') .'</p>';	
		}
		
				
	} else {
	
		//user not logged in, redirect page back to homepage
		wp_redirect( home_url() );
		exit;
		
	}
	
	function createFileName($name){
		//Capture and format filename
		$fileName = str_replace("-", " ", $name);
		$fileNameFinal = ucwords($fileName);
		
		return $fileNameFinal;
	}
	
	function createFileDate($dateString){
		if(!empty($dateString)){
			$fileDate = str_replace("-", "/", $dateString);
			$fileDateFinal = ' - ' . date("F jS, Y", strtotime($fileDate)); //month / day / year
			
			return $fileDateFinal;
		}
		
		
	}

?>