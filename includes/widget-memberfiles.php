<?php

/*

Plugin Name: Member Files Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays PDF files in the Members Area sidebar
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_member_files_widget');

//register our widget
function pm_member_files_widget() {
	register_widget('pm_memberfiles_widget');
}

//pm_memberfiles_widget class
class pm_memberfiles_widget extends WP_Widget {
	
	//process the new widget
	function pm_memberfiles_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_memberfiles_widget',
			'description' => esc_attr__('Display PDF files in the Members area.','quantumtheme')
		);
		
		parent::__construct('pm_memberfiles_widget', esc_attr__('[Micro Themes] - Member Files','quantumtheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Member Files', 
			'fa_icon' => 'fa-file',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$fa_icon = $instance['fa_icon'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p><?php esc_attr_e('FontAwesome Icon:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('fa_icon')); ?>" type="text" value="<?php echo esc_attr($fa_icon); ?>" /></p>
            <p><?php esc_attr_e('Number of files to display:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		//check to make sure user is logged in
		if( is_user_logged_in() ){
			
			//verify user is not a basic member otherwise return to kill the widget
			global $current_user;
			$user_roles = $current_user->roles;
			$user_role = array_shift($user_roles);
		}
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Member Files', 'quantumtheme' ) : $instance['title'], $instance, $this->id_base );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-file' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			echo $before_title . $fa_icon . $title . $after_title;
		}//end of if
		
		if( is_user_logged_in() && $user_role == 'board_member' || $user_role == 'executive_member' || $user_role == 'administrator'  ) {
			
			//RETRIEVE SIDEBAR FILES
			$arguments = array(
				'post_type' => 'attachment',
				'post_status' => 'inherit',
				'post_parent' => 0,
				'posts_per_page' => $numOfPosts,
				'tax_query' => array(
					array('taxonomy' => 'file_assignment', 'field' => 'slug', 'terms' => array('sidebar')),
					//array('taxonomy' => 'archive_assignment', 'field' => 'slug', 'terms' => $current_date)
				),
			);
		
			$sidebar_files = new WP_Query($arguments);
			$side_files = array();
			
			foreach ( $sidebar_files->posts as $file) {
				//capture required data and store in an array which we will loop through in the next step
				$side_files[] = array($file->post_name, $file->guid); //post_name followed by post path
			}
			//print_r($br_files); exit;
			
			echo '<ul class="pm-revised-schedules-ul">';
			
				//front-end widget code here
				foreach( $side_files as $file ){
								
					$postname = $file[0];
					$file_explode = explode("_", $postname);
									
					//Capture and format filename
					$file_name = $file_explode[0];
					$fileNameFinal = $this->createFileName($file_name);
					
					//Capture and format date
					$file_date = $file_explode[1];
					$fileDateFinal = $this->createFileDate($file_date);
					
					//echo $board_file->id;
					
					echo '<li>';
					
						echo '<a href="'.$file[1].'" target="_blank">'.$fileNameFinal.'</a>';
					
					echo '</li>';
					
				}//end of foreach
			
			echo '</ul>';
			
		} else {
			
			echo '<p>' . esc_attr__('You must be logged in or have the correct account type to view administration files.', 'quantumtheme'). '<p>';
			
		}
		
		
						
		echo $after_widget;
				
	}//end of widget function
	
	//File name formatting functions
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
	
}//end of class

?>