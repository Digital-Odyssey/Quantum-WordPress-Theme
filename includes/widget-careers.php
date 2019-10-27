<?php

/*

Plugin Name: Careers Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays career posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_careers_widget');

//register our widget
function pm_careers_widget() {
	register_widget('pm_careersposts_widget');
}

//pm_careersposts_widget class
class pm_careersposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_careersposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_careersposts_widget',
			'description' => esc_attr__('Display your career posts.','quantumtheme')
		);
		
		parent::__construct('pm_careersposts_widget', esc_attr__('[Micro Themes] - Careers','quantumtheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Careers', 
			'fa_icon' => 'fa fa-users',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr(esc_attr($title)); ?>" /></p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>"><?php esc_attr_e('FontAwesome Icon:', 'quantumtheme') ?></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fa_icon' )); ?>" value="<?php echo esc_attr($instance['fa_icon']); ?>"  class="widefat" />
            </p>
            <p><?php esc_attr_e('Number of Careers to display:', 'quantumtheme'); ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
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
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Careers', 'quantumtheme' ) : $instance['title'], $instance, $this->id_base );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-users' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
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
					'post_type' => 'post_careers',
					'post_status' => 'publish',
					'suppress_filters' => true );
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-career-opening-widget-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$pm_careers_position_meta = get_post_meta($recent["ID"], 'pm_careers_position_meta', true);
			$pm_careers_icon_meta = get_post_meta($recent["ID"], 'pm_careers_icon_meta', true);
			
			echo '<li class="pm-career-opening-widget-post">';
				echo '<i class="'.$pm_careers_icon_meta.'"></i>';
				echo '<div class="pm-career-opening-widget-post-info">';
					echo '<p>'.$pm_careers_position_meta.'</p>';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.esc_attr__('Read More', 'quantumtheme').' <i class="fa fa-angle-right"></i></a>';
				echo '</div>';
			echo '</li>';

			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
		

		
	}//end of widget function
	
}//end of class

?>