<?php

/*
Plugin Name: Recent Posts Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your most recent posts
Version: 1.0
Author: Micro Themes
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_recent_posts_widget');

//register our widget
function pm_recent_posts_widget() {
	register_widget('pm_recentposts_widget');
}

//pm_recentposts_widget class
class pm_recentposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_recentposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_recentposts_widget',
			'description' => esc_attr__('Display recent posts with style.','quantumtheme')
		);
		
		parent::__construct('pm_recentposts_widget', esc_attr__('[Micro Themes] - Recent Posts','quantumtheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Recent Posts', 
			'fa_icon' => 'fa fa-pencil',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php esc_attr_e('Title:', 'quantumtheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>"><?php esc_attr_e('FontAwesome Icon:', 'quantumtheme') ?></label>
                <input id="<?php echo esc_attr($this->get_field_id( 'fa_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'fa_icon' )); ?>" value="<?php echo esc_attr($instance['fa_icon']); ?>"  class="widefat" />
            </p>
            <p><?php esc_attr_e('Number of Posts to display:', 'quantumtheme') ?> <input class="widefat" name="<?php echo esc_attr($this->get_field_name('numOfPosts')); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
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
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_attr__( 'Recent Posts', 'quantumtheme' ) : $instance['title'], $instance, $this->id_base );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? 'fa fa-pencil' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo $before_title . $fa_icon. $title . $after_title;
			
		}//end of if
		
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
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true );
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-recent-blog-posts">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
			
			$featuredPostImage = get_post_meta($recent["ID"], 'pm_featured_post_image_meta', true);
			$featuredPostThumb = wp_get_attachment_thumb_url( get_post_thumbnail_id( $recent["ID"] ) );
			$excerpt = $recent["post_excerpt"];
			$bgImage = $featuredPostImage != '' ? $featuredPostImage : htmlentities($featuredPostThumb);
			$title = $recent["post_title"];
			$excerpt = $recent["post_excerpt"];
			$date = $recent["post_date"];
			$month = date("M", strtotime($date));
			$day = date("d", strtotime($date));
			$year = date("Y", strtotime($date));
			$author = $recent["post_author"];
			$user_info = get_userdata($author);
			
			echo '<li>';
				if($featuredPostImage !== '') {
					echo '<div class="pm-recent-blog-post-thumb" style="background-image:url('.$featuredPostImage.');"></div>';
				} elseif($featuredPostThumb) {
					echo '<div class="pm-recent-blog-post-thumb" style="background-image:url('.$bgImage.');"></div>';
				} else {
					//no image to display
				}
				echo '<div class="pm-recent-blog-post-details">';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.pm_ln_string_limit_words($title,9) .'</a>';
					
					if($user_info){
						echo '<p class="pm-date-published">'.$month.' '.$day.' '.$year.' by '. $user_info->user_login .' </p>';
					} else {
						echo '<p class="pm-date-published">'.$month.' '.$day.' '.$year.' </p>';	
					}
					
					
				echo '</div>';
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>