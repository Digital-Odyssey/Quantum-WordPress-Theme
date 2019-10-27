<?php

/*

Plugin Name: Workshops Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays workshop posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_workshops_widget');

//register our widget
function pm_workshops_widget() {
	register_widget('pm_workshopposts_widget');
}

//pm_workshopposts_widget class
class pm_workshopposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_workshopposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_workshopposts_widget',
			'description' => esc_attr__('Display your workshop posts.','quantumtheme')
		);
		
		parent::__construct('pm_workshopposts_widget', esc_attr__('[Micro Themes] - Workshops','quantumtheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Workshops', 
			'fa_icon' => 'fa fa-gears',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>"><?php esc_attr_e('FontAwesome Icon:', 'quantumtheme') ?></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fa_icon' )); ?>" value="<?php echo esc_attr($instance['fa_icon']); ?>"  class="widefat" />
            </p>
            <p><?php esc_attr_e('Number of Workshops to display:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
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
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Workshops', 'quantumtheme' ) : $instance['title'], $instance, $this->id_base );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-gears' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if ( $title )
			echo $before_title . $fa_icon. $title . $after_title;
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post_workshops',
					'post_status' => 'publish',
					'suppress_filters' => true );
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-workshop-widget-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$pm_workshop_name_meta = get_post_meta($recent["ID"], 'pm_workshop_name_meta', true);
			$pm_workshop_date_meta = get_post_meta($recent["ID"], 'pm_workshop_date_meta', true);
			$month = date("M", strtotime($pm_workshop_date_meta));
			$day = date("d", strtotime($pm_workshop_date_meta));
			$year = date("Y", strtotime($pm_workshop_date_meta));
			$pm_workshop_start_time_meta = get_post_meta($recent["ID"], 'pm_workshop_start_time_meta', true);
			$pm_workshop_icon_meta = get_post_meta($recent["ID"], 'pm_workshop_icon_meta', true);
			
			echo '<li class="pm-workshop-widget-post">';
				echo '<i class="'.esc_attr($pm_workshop_icon_meta).'"></i>';
				echo '<div class="pm-workshop-widget-post-info">';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.pm_ln_string_limit_words($pm_workshop_name_meta, 3).'...</a>';
					echo '<p>'.$month.' '.$day.' '.$year.' | '.$pm_workshop_start_time_meta.'</p>';
				echo '</div>';
			echo '</li>';
			
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
		

		
	}//end of widget function
	
}//end of class

?>