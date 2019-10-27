<?php 

add_action('widgets_init','pulsar_memberarchive_widgets');

function pulsar_memberarchive_widgets() {
	register_widget('pulsar_memberarchive_widgets');
	
	}

class pulsar_memberarchive_widgets extends WP_Widget {
	function pulsar_memberarchive_widgets() {
			
		$widget_ops = array('classname' => 'pulsar-memberarchive','description' => esc_attr__('Members Archive Widget with FontAwesome icon support.', 'quantumtheme'));
		/* $control_ops = array( 'twitter name' => 'pulsar', 'count' => 3, 'avatar_size' => '32' ); */		
		parent::__construct('pulsar-memberarchive',esc_attr__('[Micro Themes] - Member Archive','quantumtheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		
		//check to make sure user is logged in
		if( is_user_logged_in() ){
			
			//verify user is not a basic member otherwise return to kill the widget
			global $current_user;
			$user_roles = $current_user->roles;
			$user_role = array_shift($user_roles);

		}
		
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Members Archive', 'quantumtheme' ) : $instance['title'], $instance, $this->id_base );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-folder-open' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $fa_icon . $title . $after_title;
?>
	
	<?php
			
		$archiveDates = get_terms( 'archive_assignment', array( 'hide_empty' => 0 ) );
		//print_r($archiveDates);
		
		if( is_user_logged_in() && $user_role == 'board_member' || $user_role == 'executive_member' || $user_role == 'administrator'  ) {
		
			echo '<div class="pm-dropdown pm-member-archive-menu">';
				echo '<div class="pm-dropmenu">';
					echo '<p class="pm-menu-title">'.esc_attr__('Select a year', 'quantumtheme').'</p>';
					echo '<i class="fa fa-angle-down"></i>';
				echo '</div>';
				echo '<div class="pm-dropmenu-active">';
					echo '<ul>';
					
						foreach($archiveDates as $date){
						 echo '<li><a href="'.get_permalink().'?date='.$date->name.'">'.$date->name.'</a></li>'; 
					   }
	
					echo '</ul>';
				echo '</div>';
			echo '</div>';
			
		} else {
			
			echo '<p>' . esc_attr__('You must be logged in or have the correct account type to view archive files.', 'quantumtheme'). '<p>';
				
		}
	
	?>
    
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );

		return $instance;
	}
	
	function form( $instance ) {
	
			/* Set up some default widget settings. */
			$defaults = array( 'title' => esc_attr__('Text','quantumtheme'), 
				'title' => 'Members Archive',
				'fa_icon' => 'fa-folder-open',
				);
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'quantumtheme') ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
			</p>
			
			<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>"><?php esc_attr_e('FontAwesome Icon:', 'quantumtheme') ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fa_icon' )); ?>" value="<?php echo esc_attr($instance['fa_icon']); ?>"  class="widefat" />
			</p>
			
			
	   <?php 
	}

} //end of class