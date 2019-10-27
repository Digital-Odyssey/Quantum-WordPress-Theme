<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that stray paragraph and line break tags aren't added.
function pm_ln_run_shortcode( $content ) {
	
    //global $shortcode_tags;
    // Backup current registered shortcodes and clear them all out
    //$orig_shortcode_tags = $shortcode_tags;
    //remove_all_shortcodes();
		
	//Completed
	add_shortcode("boxButton", "boxButton");//COMPLETE
	add_shortcode("statBox1", "statBox1");//COMPLETE
	add_shortcode("statBox2", "statBox2");//COMPLETE
	add_shortcode("workshopPost", "workshopPost");//COMPLETE
	add_shortcode("featureBox", "featureBox");//COMPLETE
	add_shortcode("ctaBox", "ctaBox");//COMPLETE 
	add_shortcode("ctaBox2", "ctaBox2");//COMPLETE
	
	add_shortcode("dataTableGroup", "dataTableGroup");//COMPLETE 26
	add_shortcode("dataTableItem", "dataTableItem");//COMPLETE
	
	add_shortcode("sliderCarousel", "sliderCarousel");//COMPLETE
	add_shortcode("sliderItem", "sliderItem");//COMPLETE
	
	add_shortcode("tabGroup", "tabGroup");//COMPLETE
	add_shortcode("tabItem", "tabItem");//COMPLETE
	
	add_shortcode("accordionGroup", "accordionGroup");//COMPLETE
	add_shortcode("accordionItem", "accordionItem");//COMPLETE
		
	add_shortcode("youtubeVideo", "youtubeVideo");//COMPLETE 
	add_shortcode("vimeoVideo", "vimeoVideo");//COMPLETE
	add_shortcode("html5Video", "html5Video");//COMPLETE
	add_shortcode("googleMap", "googleMap");//COMPLETE
	add_shortcode("divider", "divider");//COMPLETE
	add_shortcode("standardButton", "standardButton");//COMPLETE
	add_shortcode("progressBar", "progressBar");//COMPLETE
	add_shortcode("countdown", "countdown");//COMPLETE
	add_shortcode("milestone", "milestone");//COMPLETE
	add_shortcode("piechart", "piechart");//COMPLETE		
	add_shortcode("postItems", "postItems");//COMPLETE
	add_shortcode("staffProfile", "staffProfile");//COMPLETE
	add_shortcode("pricingTable", "pricingTable");//COMPLETE
	add_shortcode("newsletterSignup", "newsletterSignup");//COMPLETE
	add_shortcode("singlePost", "singlePost");//COMPLETE
	add_shortcode("panelsCarousel", "panelsCarousel");//COMPLETE
	add_shortcode("clientCarousel", "clientCarousel");//COMPLETE
	add_shortcode("testimonials", "testimonials");//COMPLETE
	add_shortcode("iconElement", "iconElement");//COMPLETE
	add_shortcode("contactForm", "contactForm");//COMPLETE
	add_shortcode("alert", "alert");//COMPLETE
	add_shortcode("quoteBox", "quoteBox"); //COMPLETE	

	
	//Bootstrap 3
	add_shortcode("bootstrapContainer", "bootstrapContainer");//COMPLETE
	add_shortcode("bootstrapRow", "bootstrapRow");//COMPLETE
	add_shortcode("bootstrapColumn", "bootstrapColumn");//COMPLETE
	add_shortcode("nestedRow", "nestedRow");//COMPLETE
	add_shortcode("nestedColumn", "nestedColumn");//COMPLETE
	
    // Do the shortcode (only the one above is registered)
    //$content = do_shortcode( $content );
    // Put the original shortcodes back
    //$shortcode_tags = $orig_shortcode_tags;
    return $content;
}
add_filter( 'the_content', 'pm_ln_run_shortcode', 7 );
add_filter( 'widget_text', 'pm_ln_run_shortcode', 7 );

//FEATURE BOX
function featureBox($atts, $content = null) {

	extract(shortcode_atts(array(
		"icon" => 'fa fa-thumbs-o-up',
		"icon_color" => '#ffffff',
		"title_color" => '#ffffff',
		"title" => 'Title goes here',
		"animation_delay" => ''
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="feature-box" '. ($animation_delay !== '' ? 'data-animated='.$animation_delay.'' : '') .'>';
		$html .= '<i class="'.$icon.'" style="color:'.$icon_color.';"></i>';
		$html .= '<div class="content">';
			$html .= '<h4 class="uppercase" style="color:'.$title_color.';">'.$title.'</h4>';
			$html .= $content;
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"post_order" => 'DESC'
		), 
	$atts));
	
	//Fetch data
	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		//'posts_per_page' => -1,
		'order' => (string) trim($post_order),
		'posts_per_page' => $num_of_posts,
		'ignore_sticky_posts' => 1
		//'tag' => get_query_var('tag')
	);

	$post_query = new WP_Query($arguments);

	pm_ln_set_query($post_query);

	$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');
	
	$html = '';
	
	//Display Items
	$html .= '<div class="row">';
		
		$html .= '<div'. ($num_of_posts > 3 ? ' id="pm-postItems-carousel"' : '') .'>';
		
			if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
					 
				if ( has_post_thumbnail()) {
				  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				}
				$pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
				
				$postExcerpt = get_the_excerpt();
				
				if($num_of_posts == "1"){
					$html .= '<div class="col-lg-12 pm-column-spacing">';
				} elseif($num_of_posts == "2") {
					$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">';
				} elseif($num_of_posts == "3") {
					$html .= '<div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">';
				} else {
					$html .= '<div class="pm-postItem-carousel-item">';	
				}
					$html .= '<div class="pm-presentation-post-container carousel">';
					  $html .= '<div class="pm-presentation-post-date carousel">';
						$html .= '<div class="pm-presentation-post-date-box carousel">';
							$html .= '<p class="pm-month">'. get_the_time( 'M' ) .'</p>';
							$html .= '<p class="pm-day">'. get_the_time( 'd' ) .'</p>';
						$html .= '</div>';
						
						if($displayCommentsCount === 'on') :
						
							$html .= '<div class="pm-presentation-post-comment-count carousel">';
								$html .= '<p>'. get_comments_number() .'</p>';
							$html .= '</div>';
						
						endif;
						
					  $html .= '</div>';
					  $html .= '<div class="pm-presentation-post-title carousel">';
						$html .= '<p>';
							$title = get_the_title(); 
							$html .= pm_ln_string_limit_words($title, 4); 
						$html .= '</p>';
					  $html .= '</div>';
					  $html .= '<div class="pm-presentation-post-excerpt carousel">';
						$html .= '<p>'. pm_ln_string_limit_words($postExcerpt, 5) .'...</p>';
					  $html .= '</div>';
					  $html .= '<div class="pm-presentation-post-hover-container carousel">';
						$html .= '<p class="pm-presentation-post-hover-excerpt carousel">'. pm_ln_string_limit_words($postExcerpt, 20) .' <a href="'. get_the_permalink() .'">[...]</a></p>';
						$html .= '<a href="'. get_the_permalink() .'">'. esc_attr__('Read More', 'quantumtheme') .' &raquo;</a>';
					  $html .= '</div>';
					  $html .= '<div class="pm-presentation-post-img carousel">';
						if($pm_featured_post_image_meta !== '') {
								$html .= '<img src="'. esc_html($pm_featured_post_image_meta) .'" alt="'. get_the_title() .'" class="lazyOwl" data-src="'. esc_html($pm_featured_post_image_meta) .'"> ';
						} else if(has_post_thumbnail()) {
								$html .= '<img src="'. esc_html($image_url[0]) .'" alt="'. get_the_title() .'" class="lazyOwl" data-src="'. esc_html($image_url[0]) .'"> ';
						} else {
								
						} 
						$html .= '</div>';
					  $html .= '</div>';
				  $html .= '</div>';
							
			endwhile; else:
				$html .= '<div class="col-lg-12 pm-column-spacing">';
				 $html .= '<p>'.esc_attr__('No posts were found.', 'quantumtheme').'</p>';
				$html .= '</div>';
			endif;
		
		$html .= '</div>';
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}

//WORKSHOP POST
function workshopPost( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"post_id" => '',
		"class" => 'wow fadeInUp'
		), 
	$atts));
	
	//Method to retrieve a single post
	$queried_post = get_post($post_id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	
	$pm_workshop_related_course_title_meta = get_post_meta($postID, 'pm_workshop_related_course_title_meta', true);
	$pm_workshop_short_description_meta = get_post_meta($postID, 'pm_workshop_short_description_meta', true);
	$pm_workshop_date_meta = get_post_meta($postID, 'pm_workshop_date_meta', true);
	$w_month = date("M", strtotime($pm_workshop_date_meta));
	$w_day = date("d", strtotime($pm_workshop_date_meta));
	$w_year = date("Y", strtotime($pm_workshop_date_meta));
	$pm_workshop_start_time_meta = get_post_meta($postID, 'pm_workshop_start_time_meta', true);
	$pm_workshop_icon_meta = get_post_meta($postID, 'pm_workshop_icon_meta', true);
	
	$html = '';
	
	$html .= '<div class="pm-workshop-post-container" style="margin:30px 0 0;">';
		$html .= '<div class="pm-workshop-post-title-container">';
			$html .= '<p class="pm-workshop-post-title">'.$pm_workshop_related_course_title_meta.'</p>';
			$html .= '<p class="pm-workshop-post-subtitle">'.$pm_workshop_short_description_meta.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-workshop-post-date-container">';
			$html .= '<div class="pm-workshop-post-icon">';
				$html .= '<i class="'.$pm_workshop_icon_meta.'"></i>';
			$html .= '</div>';
			$html .= '<p class="pm-title">'.$postTitle.'</p>';
			$html .= '<p class="pm-date">'.$w_month.' '.$w_day.' '.$w_year.' | '.$pm_workshop_start_time_meta.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-workshop-shortcode-link"><a href="'.get_permalink($postID).'" class="pm-workshop-post-button-container">View full details<i class="fa fa-angle-right"></i></a></div>';
	$html .= '</div>';
	
	return $html;
	
}

//STAFF PROFILE

function staffProfile( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"id" => '',
		"name_color" => '#2C5E83',
		"title_color" => '#4B4B4B',
		"text_color" => '#4b4b4b',
		"icon_color" => '#dad9d9',
		"target" => '_blank',
		"class" => 'wow fadeInUp',
		"animation_delay" => 2
		), 
	$atts));
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 30);
	$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
	
	$html = '';
	
	$html .= '<div class="pm-staff-profile-container '.$class.'" data-wow-delay="0.'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">';
		$html .= '<div class="pm-staff-profile-image-wrapper">';
			$html .= '<div class="pm-staff-profile-image">';
				$html .= '<img src="'.$pm_staff_image_meta.'" class="img-responsive" alt="profile">';
			$html .= '</div>';
			$html .= '<ul class="pm-staff-profile-icons">';
				if($pm_staff_twitter_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_twitter_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-twitter"></i></a></li>';
				}
				if($pm_staff_facebook_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_facebook_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-facebook"></i></a></li>';
				}
				if($pm_staff_gplus_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_gplus_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-google-plus"></i></a></li>';
				}
				if($pm_staff_linkedin_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_linkedin_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-linkedin"></i></a></li>';
				}				
			$html .= '</ul>';
		$html .= '</div>';
		$html .= '<div class="pm-staff-profile-details">';
			$html .= '<a href="'. get_post_permalink($postID) .'"><p class="pm-staff-profile-name" style="color:'.$name_color.';">'.$postTitle.'</p></a>';
			$html .= '<p class="pm-staff-profile-title" style="color:'.$title_color.';">'.$pm_staff_title_meta.'</p>';
			$html .= '<p class="pm-staff-profile-bio" style="color:'.$text_color.';">'.$shortExcerpt.' <a href="'. get_post_permalink($postID) .'">[...]</a></p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//NEWSLETTER SIGNUP
function newsletterSignup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"mailchimp_url" => '',
		"name_placeholder" => 'Your Name',
		"email_placeholder" => 'Email Address',
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-workshop-newsletter-form-container">';
		$html .= '<form action="'.htmlspecialchars($mailchimp_url).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  ';
			$html .= '<input name="MERGE1" type="text" id="MERGE1" placeholder="'.$name_placeholder.'">';
			$html .= '<input name="MERGE0" type="text" id="MERGE0" placeholder="'.$email_placeholder.'">';
			$html .= '<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="subscribe" class="pm-workshop-newsletter-submit-btn">';
		$html .= '</form>';
	 $html .= '</div>';
					 
	return $html;
	
}



//CTA BOX 2
function ctaBox2( $atts, $content = null ){

	extract(shortcode_atts(array(
		"divider_color" => '#dbc164',
		"class" => 'wow fadeInUp'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-cta-container '.$class.'">';
		$html .= '<div class="pm-cta-divider" style="background-color:'.$divider_color.';"></div>';
		$html .= '<p class="pm-cta-text">'.$content.'</p>';
		$html .= '<div class="pm-cta-divider" style="background-color:'.$divider_color.';"></div>';
	$html .= '</div>';
	
	return $html;
	
}

//STAT BOX 1
function statBox1( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"stat_image" => '',
		"stat_percentage" => '85',
		"text_color" =>'#ffffff',
		"class" => 'wow fadeInUp',
		"animation_delay" => 2
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-statistic-box-container '.$class.'" data-wow-duration="1s" data-wow-offset="50" data-wow-delay="0.'.$animation_delay.'s">';
			if( $stat_percentage !== '' ){
				$html .= '<h3 style="color:'.$text_color.';">'.$stat_percentage.'</h3>';
			}
			$html .= $content;
			if( $stat_image !== '' ){
				$html .= '<img src="'.$stat_image.'" class="img-responsive" alt="stat_icon">';
			}
	$html .= '</div>';
	
	return $html;
	
}


//STAT BOX 2
function statBox2( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"bg_image" => '',
		"stat_number" => '10',
		"stat_title" => '10',
		"text_color" =>'#ffffff',
		"class" => 'wow fadeInUp',
		"animation_delay" => 2
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-statistic-box '.$class.'" data-wow-delay="0.'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">';
		$html .= '<div class="pm-statistic-box-triangle" style="background-image:url('.$bg_image.');">';
			$html .= '<p class="pm-statistic-text1">'.$stat_number.'</p>';
			$html .= '<p class="pm-statistic-text2">'.$stat_title.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-statistic-box-desc">';
			$html .= $content;
		$html .= '</div> ';                          
	$html .= '</div>';
	
	return $html;
	
}



//DATA TABLE GROUP
function dataTableGroup( $atts, $content = null ){
	
	$GLOBALS['pm_date_table_item_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['dataTableItems'] ) ){
	
		foreach( $GLOBALS['dataTableItems'] as $item ){
	
			$items[] = '<div class="row"><div class="col-lg-4 col-md-4 col-sm-12 pm-workshop-table-title"><p>'.$item['title'].'</p></div><div class="col-lg-8 col-md-8 col-sm-12 pm-workshop-table-content"><p>'.$item['content'].'</p></div></div>';
	
		}

		//returnwrapper plus dataTableItems
		$return = '<div class="pm-workshop-table">'.implode( "\n", $items ).'</div>';

	}

	return $return;

}

function dataTableItem( $atts, $content = null ){

	extract(shortcode_atts(array(

		'title' => 'Sample Title'

	), $atts));

	$x = $GLOBALS['pm_date_table_item_count'];

	$GLOBALS['dataTableItems'][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_date_table_item_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_date_table_item_count']++;

}

//PRICING TABLE
function pricingTable($atts, $content = null) {

	extract(shortcode_atts(array(
		"title" => 'Beginner',
		"icon" => 'typcn typcn-cog-outline',
		"price" => '$19.99',
		"subscript" => '/mo',
		"button_text" => 'Purchase',
		"button_link" => '#',
		"header_color" => '#2B5C84',
		"price_color" => '#DBC164',
		"class" => 'wow fadeInUp',
		"icon_color" => '#2B5D82'
		), 
	$atts));
	
	$html = '';
		
	$html .= '<div class="pm-pricing-table" class="'.$class.'">';
		$html .= '<h2 style="background-color:'.$header_color.';">'.$title.'</h2>';
		$html .= '<div class="pm-pricing-table-header">';
			if($icon !== ''){
				$html .= '<i class="'.$icon.'" style="color:'.$icon_color.' !important;"></i>';
			}
			$html .= '<h1 style="color:'.$price_color.';">'.$price.' '. ( $subscript !== '' ? '<sub>'.$subscript.'</sub>' : '' ) .'</h1>';
		$html .= '</div>';
		$html .= '<div class="pm-pricing-table-offer">';
		$html .= $content;
		$html .= '</div>';
		$html .= '<div class="pm-rounded-btn">';
			$html .= '<a href="'.$button_link.'">'.$button_text.'</a>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//QUOTE BOX
function quoteBox($atts, $content = null){
	
	extract(shortcode_atts(array(
		"author_name" => '',
		"author_title" => '',
		"avatar" => '',
		"text_color" => 'white',
		"name_color" => '#4D4D4D'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-container">';
		$html .= '<div class="pm-single-testimonial-box">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-single-testimonial-author-container">';
			if($avatar !== ''){
				$html .= '<div class="pm-single-testimonial-author-avatar">';
					$html .= '<img src="'.$avatar.'" alt="avatar">';
				$html .= '</div>';
			}			
			$html .= '<div class="pm-single-testimonial-author-info">';
				$html .= '<p class="name" style="color:'.$name_color.';">'.$author_name.'</p>';
				$html .= '<p class="title" style="color:'.$name_color.';">'.$author_title.'</p>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		
}

//PIE CHART
function piechart($atts, $content = null){
	
	extract(shortcode_atts(array(
			"bar_size" => 220,
			"line_width" => 7,
			"track_color" => "#dbdbdb",
			"bar_color" => "#2B5C84", 
			"percentage" => 75,
			"icon" => "typcn typcn-thumbs-up",
			"caption" => "Cost Reduction",
			"font_size" => 40,
			"display_percent" => 'true'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div data-barsize="'.$bar_size.'" data-linewidth="'.$line_width.'" data-trackcolor="'.$track_color.'" data-barcolor="'.$bar_color.'" data-percent="'.$percentage.'" class="pm-pie-chart">';
		$html .= '<div class="pm-pie-chart-percent" style="font-size:'.$font_size.'px;">';
			if( $display_percent === 'true' ){
				$html .= '<span></span>%';
			} else {
				$html .= '<span></span>';
			}
			
		$html .= '</div>';			
	$html .= '</div>';
	$html .= '<div class="pm-pie-chart-description">';
		$html .= '<i class="'.$icon.'"></i>';
		$html .= $caption;
	$html .= '</div>';
	
	return $html;
	
}

//MILESTONE
function milestone($atts, $content = null){
	
	extract(shortcode_atts(array(
			"speed" => "",
			"stop" => "",
			"caption" => "Quality Assurance",
			"icon" => "typcn typcn-chart-line",
			"font_size" => 60,
			"style" => 1,
			"display_percent" => 'true'	
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="milestone '. ( $style == 2 ? 'alt' : '' ) .'">';
		$html .= '<i class="'.$icon.'"></i>';
		$html .= '<div class="milestone-content" style="font-size:'.$font_size.'px;"> '; 
		      
			if( $display_percent === 'true' ){
				$html .= '<span data-speed="'.(int)$speed.'" data-stop="'.(int)$stop.'" class="milestone-value"></span>%';
			} else {
				$html .= '<span data-speed="'.(int)$speed.'" data-stop="'.(int)$stop.'" class="milestone-value"></span>';
			}
			
			
			$html .= '<div class="milestone-description">'.$caption.'</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//COUNTDOWN
function countdown($atts, $content = null){
	
	extract(shortcode_atts(array(
			"date" => '2014/08/25',	
			"id" => 1
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-countdown-container" id="pm-countdown-container-'.$id.'"></div><script type="text/javascript">(function($) { $(document).ready(function(e) { $("#pm-countdown-container-'.$id.'").countdown("'.$date.'", function(event) { $(this).html(event.strftime("%w weeks %d days %H:%M:%S")); }); }); })(jQuery);</script>';
	
	return $html;
	
}


//SLIDER CONTAINER
function customSlider($atts, $content = null){
	
	extract(shortcode_atts(array(
			"id" => ''
			), 
	$atts));
	
	return '<div class="pm-slider-container">'.$content.'</div>';
}

//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP"; 
         
    echo '<!-- Google Map -->
        <script type="text/javascript"> 
		
		(function($) {
			
			$(document).ready(function() {
				
			  function initializeGoogleMap() {
		 
				  var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				  var myOptions = {
					center: myLatlng, 
					zoom: '.$zoom.',
					mapTypeId: google.maps.MapTypeId.'.$mapType.'
				  };
				  var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
		 
				  var contentString = "'.$message.'";
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  /*map.addListener("click", function() {
					  google.maps.event.trigger(map, "resize");
					  map.setCenter(myOptions.center); 
				  });*/
				  
				  				 
			  }
			  initializeGoogleMap();
		 
			});
			
		})(jQuery);
		
        
        </script>';
     
	if($responsive == 1){
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" data-id="'.$id.'" data-latitude="'.$latitude.'" data-longitude="'.$longitude.'" data-mapType="'.$mapType.'" data-mapZoom="'.$zoom.'" data-message="'.$message.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
} 


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'success',
		"icon" => 'typcn typcn-tick',
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
	  if($close == 'true'){
		 $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	  }
	  $html .= '<i class="'.$icon.'"></i>';
	  $html .= $content;
	$html .= '</div>';
	
	return $html;

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "height" => '1',
		"bg_color" => 'orange',
		"margin" => 20
    ), $atts)); 
	
	return '<div class="pm-divider" style="height:'.$height.'px; background-color:'.$bg_color.'; margin:'.$margin.'px 0px;"></div>';

}


//STANDARD BUTTON
function standardButton($atts, $content = null) {  
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"target" => '_self',
		"icon" => '',
		"transparency" => 'on',
		"animated" => 'on',
		"class" => ''
    ), $atts));  
	
	$html = '';
	
	$html .= '<div class="pm-rounded-btn '. ( $transparency == 'on' ? 'transparent' : '' ) .' '. ( $animated == 'on' ? 'animated' : '' ) .' '.$class.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><a href="'.$link.'" target="'.$target.'">'.$content.' '. ( $icon !== '' ? '<i class="'.$icon.'"></i>' : '' ) .'</a></div>';
	
	return $html;
		 
}  

//BOX BTN
function boxButton($atts, $content = null) { 
 
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"icon" => 'typcn typcn-vendor-microsoft',
		"target" => '_self',
    ), $atts));  
	
	$html = '';
		
	$html .= '<div class="pm-icon-bundle" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
		$html .= ( $icon !== '' ? '<i class="'.$icon.'"></i>' : '' );
		$html .= '<div class="pm-icon-bundle-content">';
			$html .= '<p><a href="'.$link.'" target="'.$target.'">'.$content.' <i class="fa fa-angle-right"></i></a></p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		 
}  

//PROGRESS BAR
function progressBar($atts) { 

	extract(shortcode_atts(array(  
        "percentage" => '50',
		"text" => '',
		"id" => 1
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-progress-bar-description" id="pm-progress-bar-desc-'.$id.'">';
		$html .= $text;
		$html .= '<span>'.$percentage.'%</span>';
	$html .= '</div>';
	$html .= '<div class="pm-progress-bar">';
		$html .= '<span data-width="'.$percentage.'" class="pm-progress-bar-outer" id="pm-progress-bar-'.$id.'">';
			$html .= '<span class="pm-progress-bar-inner"></span>';
		$html .= '</span>';
	$html .= '</div>';
	
	return $html;

}



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'icon' => 'fa fa-link',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
    
    $html .= '<div class="pm_image_panel">';
        
		$html .= '<div class="pm-hover-item-image-panel">';
		
			$html .= '<div class="pm-hover-item-icon"><a class="'.$icon.'" href="'.$link.'"></a></div>';
		
			$html .= '<div class="pm-image-panel-hover"></div>';
		
			$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
			
		$html .= '</div>';   
    
    $html .= '</div>';
    
	return $html;
	
}



//SINGLE POST
function singlePost($atts) {
			
	extract( shortcode_atts( array(
		'id' => '',
		'class' => ''
	), $atts ) );
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	$postTitleFinal = pm_ln_string_limit_words($postTitle, 4);
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 5);
	$shortExcerpt2 = pm_ln_string_limit_words($postExcerpt, 15);
	$postContent = $queried_post->post_content;
	//$postImage = get_the_post_thumbnail($postID, 'thumbnail');
	$postImage = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full' );
	$pm_featured_post_image_meta = get_post_meta($postID, 'pm_featured_post_image_meta', true);
	$count = get_comments_number($postID);
	$postDate = $queried_post->post_date;
	$month = date("M", strtotime($postDate));
	$day = date("d", strtotime($postDate));
	//$commentsLink = get_comments_link($postID);
	//$postImage = get_post_meta($postID, 'featuredPostImage', true);
	
	$displayCommentsCount = get_theme_mod('displayCommentsCount', 'on');
	
	$html = '';
			
	  $html .= '<div class="pm-presentation-post-container">';
		  $html .= '<div class="pm-presentation-post-date">';
			$html .= '<div class="pm-presentation-post-date-box">';
				$html .= '<p class="pm-month">'.$month.'</p>';
				$html .= '<p class="pm-day">'.$day.'</p>';
			$html .= '</div>';
			if($displayCommentsCount === 'on') :
				$html .= '<div class="pm-presentation-post-comment-count shortcode"><p>'.$count.'</p></div>';
			endif;
		  $html .= '</div>';
		  $html .= '<div class="pm-presentation-post-title">';
			$html .= '<p>'.$postTitleFinal.'</p>';
		  $html .= '</div>';
		  $html .= '<div class="pm-presentation-post-excerpt">';
			$html .= '<p>'.$shortExcerpt.'</p>';
		  $html .= '</div>';
		  $html .= '<div class="pm-presentation-post-hover-container">';
			$html .= '<p class="pm-presentation-post-hover-excerpt">'.$shortExcerpt2.' <a href="'.$postLink.'">[...]</a></p>';
			$html .= '<a href="'.get_permalink($postID).'">'.esc_attr__('Read More', 'quantumtheme').' &raquo;</a>';
		  $html .= '</div>';
		  $html .= '<div class="pm-presentation-post-img">';
		  	if($pm_featured_post_image_meta !== ''){
				$html .= '<img src="'.$pm_featured_post_image_meta.'" alt="'.$postTitle.'">';
			} else if($postImage !== '') {
				$html .= '<img src="'.$postImage[0].'" alt="'.$postTitle.'">';	
			} else {
				//no image to display	
			}
		  $html .= '</div>';
	  $html .= '</div>';

	return $html;
	
}  


//CALL TO ACTION
function ctaBox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => '',
		"icon" => 'fa fa-exclamation',
		"icon_color" => '#DBC164',
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-quantum-alert-message">';
		$html .= '<i class="'.$icon.'" style="background-color:'.$icon_color.';"></i>';
		$html .= '<p class="pm-quantum-alert-title">'.$title.'</p>';
		$html .= '<p class="pm-quantum-alert-details">'.$content.'</p>';
	$html .= '</div>';
	
	return $html;
	
}

//ICON  
function iconElement($atts, $content = null) {
	extract(shortcode_atts(array(  
        "symbol" => 'typcn typcn-device-tablet',
		"color" => '#2B5C84',
		"size" => 4
    ), $atts));
	
    return '<div class="pm-icon-box"><span class="'.$symbol.' typcn-size'.$size.'" style="color:'.$color.';"></span></div>';  
	
}  

// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';  
}

//HTML5 VIDEO
function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
		'width' => '400',
		'height' => '400',
		"responsive" => 0,
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
	
}


//TABS
function tabGroup( $atts, $content ){
	
	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));
	
	$GLOBALS['pm_ln_tab_id'] = (int) $id;
	$GLOBALS['pm_ln_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] ) ){
	
		foreach( $GLOBALS['tabs'. $GLOBALS['pm_ln_tab_id']] as $tab ){
	
			$tabs[] = '<li><a data-toggle="tab" href="#'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';
		
			$panes[] = '<div class="tab-pane" id="'.$GLOBALS['pm_ln_tab_id'].''.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';
	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Tab %d'

	), $atts));

	$x = $GLOBALS['pm_ln_tab_count'];

	$GLOBALS['tabs' . $GLOBALS['pm_ln_tab_id']][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_ln_tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_ln_tab_count']++;

}

//ACCORDION
function accordionGroup($atts, $content = null) { 

	extract(shortcode_atts(array(
		'id' => '1'
	), $atts));

	$GLOBALS['pm_ln_accordion_id'] = (int) $id;
	$GLOBALS['pm_ln_accordion_count'] = 0;
	
	
    return '<div class="panel-group" id="accordion'.$GLOBALS['pm_ln_accordion_id'].'" role="tablist" aria-multiselectable="true">'.do_shortcode($content).'</div>';
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"icon" => 'fa fa-plus'
    ), $atts)); 
	
	$html = '';
	
	  $html .= '<div class="panel panel-default">';
		$html .= '<div class="panel-heading" role="tab" id="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
		  $html .= '<h4 class="panel-title"><i class="fa fa-plus"></i>';
			$html .= '<a data-toggle="collapse" data-parent="#accordion'.$GLOBALS['pm_ln_accordion_id'].'" href="#'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="pm-accordion-link" aria-expanded="true" aria-controls="collapse'.$GLOBALS['pm_ln_accordion_count'].'">';
			  $html .= ''.$title.'';
			$html .= '</a>';
		  $html .= '</h4>';
		$html .= '</div>';
		$html .= '<div id="'.$GLOBALS['pm_ln_accordion_id'].'collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$GLOBALS['pm_ln_accordion_count'].'">';
		  $html .= '<div class="panel-body">';
			$html .= ''.do_shortcode($content).'';
		  $html .= '</div>';
		$html .= '</div>';
	  $html .= '</div>';
	
	$GLOBALS['pm_ln_accordion_count']++;
	
    return $html;
	
} 

//FLEXSLIDER CAROUSEL
function sliderCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"animation" => 'slide',
    ), $atts)); 

	if(!isset($GLOBALS['pm_ln_flexslider_count'])){
		$GLOBALS['pm_ln_flexslider_count'] = 0;
	}
	
	$html = '';
	
	$html .= '<div class="flexslider pm-post-slider" id="pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'" style="width:100%;"><ul class="slides">'.do_shortcode($content).'</ul></div>';
	
	$html .= '<script>(function($) {$(document).ready(function(e) {$("#pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'").flexslider({animation:"'.$animation.'", controlNav: false, directionNav: true, animationLoop: true, slideshow: false, arrows: true, touch: false, prevText : "", nextText : "" }); }); })(jQuery); </script>';
	
	//increment for next possible carousel slider
	$GLOBALS['pm_ln_flexslider_count']++;
	
    return $html;
	
}  

function sliderItem($atts, $content = null) {

	extract(shortcode_atts(array(  
		"img" => '',
		"title" => ''
    ), $atts)); 
	
	$html = '<li><img src="' . $img . '" alt="' . $title . '" /></li>';
		
    return $html;
	
}  


//CLIENTS CAROUSEL
function clientCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_self',
    ), $atts)); 
	
	$html = '<ul class="pm-partners-carousel-posts" id="pm-partners-carousel-owl">';
	
	//Redux options
	global $quantum_options;
	
	if($quantum_options){
		
		$clients = $quantum_options['opt-client-slides'];
		
		if(count($clients) > 0){
			
			foreach($clients as $c) {
				
				$html .= '<li>';
					$html .= '<div class="pm-parnters-post-container">';
						if($c['url'] !== ''){
							$html .= '<div class="pm-parnters-post-url">';
								$html .= '<a href="http://'.$c['url'].'" target="'.$target.'">'.$c['url'].'</a>';
							$html .= '</div>';
						}						
						if($c['description'] !== ''){
							$html .= '<div class="pm-parnters-post-featured">'.$c['description'].'</div>';	
						}
						$html .= '<img src="'.$c['image'].'" class="img-responsive" alt="'.$c['title'].'">';
					$html .= '</div>';
				$html .= '</li>';
				
			}//end of foreach
			
		}//end of if
		
	}//end of if
			
	$html .= '</ul>';
	
    return $html;
	
}  


//PANELS CAROUSEL
function panelsCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"target" => '_self',
    ), $atts)); 
	
	$html = '<ul class="pm-interactive-panels-carousel" id="pm-interactive-panels-owl">';
	
	//Redux options
	global $quantum_options;
	
	if($quantum_options){
		
		$panels = $quantum_options['opt-panel-slides'];
		
		if(count($panels) > 0){
			
			foreach($panels as $p) {
				
				$pieces = explode(" - ", $p['url']);
				
				$icon = $pieces[0];
				$url = $pieces[1];
				
				$html .= '<li>';
					$html .= '<div class="pm-icon-bundle">';
						$html .= '<i class="'.$icon.'"></i>';
						$html .= '<div class="pm-icon-bundle-content">';
							$html .= '<p><a href="'.$url.'" target="'.$target.'">'.$p['title'].' <i class="fa fa-angle-right"></i></a></p>';
						$html .= '</div>';
						$html .= '<div class="pm-icon-bundle-info">';
							$html .= '<p>'.$p['description'].'</p>';
						$html .= '</div>';
					 $html .= '</div>';
				$html .= '</li>';
				
			}//end of foreach
			
		}//end of if
		
	}//end of if
			
	$html .= '</ul>';
	
    return $html;
	
}  


//PANEL HEADER
function panelHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"panel_style" => 1,
		"link" => '',
		"target" => '_self',
		"color" => '#00BC9D',
		"show_button" => 'true',
		"button_text" => '',
		"margin_bottom" => 10,
		"icon" => 'fa-link',
		"tip" => '',
		"bg_color" => '#F3F3F3',
    ), $atts));
		
	if($panel_style == 1){
		
		//panel header style 1
		if($show_button == 'true'){
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4><div class="pm_span_header_btn"><a class="pm-custom-button pm-btn-animated pm-btn-small pm-post-btn p_header" href="'.$link.'" target="'.$target.'"><span>'.$button_text.' <i class="fa '.$icon.'"></i></span></a></div></div>';
		} else {
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4></div>';
		}
		
	} elseif($panel_style == 2){
		
		//panel header style2
		if($show_button == 'true'){
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} elseif($panel_style == 3){
		
		//panel header style3
		if($show_button == 'true'){
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} else {
		return "";	
	}
	
     
}

//COLUMN HEADER
function columnHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"color" => 'grey',
		"margin_bottom" => 0
    ), $atts));
	
	return '<div class="pm-column-header" style="margin-bottom:'.$margin_bottom.'px;"><h2 style="border-bottom:1px solid '.$color.';">'.$content.'</h2><div class="pm-column-header-block" style="background-color:'.$color.';"></div></div>';
     
}

//TESTIMONIAL CAROUSEL
function testimonials($atts) {
	
	extract(shortcode_atts(array(  
        "icon" => '',
    ), $atts));
	
	$html = '';
	
	//Redux options
	global $quantum_options;
	
	if($quantum_options){
		
		$testimonials = $quantum_options['opt-testimonials-slides'];
		
		if(is_array($testimonials)){
			
			$counter = 0;
			
			$html .= '<ul class="pm-testimonials-carousel" id="pm-testimonials-carousel-owl">';
			
				foreach($testimonials as $t) {
					
					$html .= '<li>';
						$html .= '<div class="col-lg-5 col-md-5 col-sm-5 pm-center">';
							$html .= '<img src="'.$t['image'].'" class="img-responsive" alt="'.$t['title'].'"> ';
						$html .= '</div>';
						$html .= '<div class="col-lg-7 col-md-7 col-sm-7">';
							$html .= '<div class="pm-testimonial-container">';
								$html .= '<div class="pm-testimonial-quote-box">';
									$html .= '<i class="fa fa-quote-left"></i>';
								$html .= '</div>';
								$html .= '<div class="pm-testimonial-text-box">';
									$html .= '<p>'.$t['description'].'</p>';
									$html .= '<p class="pm-testimonial-name">'.$t['title'].'</p>';
									$html .= '<p class="pm-testimonial-title">'.$t['url'].'</p>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</li>';
					
				}//end of foreach
											
			$html .= '</ul>';
			
		}
		
	}
	
	return $html;
	
}

//CONTACT FORM
function contactForm($atts) {

	extract(shortcode_atts(array(  
		"title" => 'Contact Form',
		"title_size" => 28,
		"email_address" => '',
		"alert_message" => 'Your email address will be held strictly confidential. Required fields are marked *',
		"button_text" => 'Submit',
		"text_color" => 'red',
    ), $atts)); 

	
	$html = '';
	
		$html .= '<p class="pm-contact-form-title pm-secondary" style="font-size:'.$title_size.'px;">'.$title.'</p>';
		$html .= '<div class="pm-contact-form-container">';
			$html .= '<p class="pm-required" style="color:'.$text_color.';">'.$alert_message.'</p>';
			$html .= '<form action="#" method="post" id="pm-contact-form">';
				$html .= '<input name="pm_s_full_name" id="pm_s_full_name" type="text" placeholder="'.esc_attr__('Name *', 'quantumtheme').'" class="pm-form-textfield">';
				$html .= '<input name="pm_s_email_address" id="pm_s_email_address" type="text" placeholder="'.esc_attr__('Email *', 'quantumtheme').'" class="pm-form-textfield">';
				$html .= '<input name="pm_s_subject" id="pm_s_subject" type="text" placeholder="'.esc_attr__('Subject *', 'quantumtheme').'" class="pm-form-textfield">';
				$html .= '<textarea name="pm_s_message" id="pm_s_message" cols="20" rows="6" placeholder="'.esc_attr__('Inquiry *', 'quantumtheme').'" class="pm-form-textarea"></textarea>';
				
				$html .= '<div id="pm-contact-form-response"></div>';	
				$html .= '<input name="pm-form-submit-btn" class="pm-rounded-submit-btn" type="button" value="'.$button_text.'" id="pm-contact-form-btn">';
				$html .= '<input type="hidden" value="pm-contact-form-submitted" />';
				$html .= '<input type="hidden" name="pm_s_email_address_contact" id="pm_s_email_address_contact" value="'.$email_address.'" />';
				
				wp_nonce_field('pm_ln_nonce_action','pm_ln_send_contact_nonce'); 
				
			$html .= '</form>';
		$html .= '</div>';
		
	return $html;
	
}


/******** BOOTSTRAP 3 COLUMNS ***********/

//COLUMN CONTAINER
function bootstrapContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
        "fullscreen" => 'off',
		"fullscreen_container" => 'on',
		"bgcolor" => 'transparent',
		"bgimage" => '',
		"bgposition" => 'static',
		"bgrepeat" => 'repeat-x',
		"border" => 'no',
		"alignment" => 'left',
		"paddingtop" => 20,
		"paddingbottom" => 20,
		"border_color" => 'transparent',
		"border_height" => 5,
		"parallax" => 'on',
		"icon" => '',
		"class" => '',
		"id" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		//wrap a cta_container
		if($bgimage != ''){
			
			if($icon !== ''){
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container pm-parallax-panel '.$class.'" style="background-image:url('.$bgimage.'); background-repeat:'.$bgrepeat.'; background-attachment:'.$bgposition.' !important; background-color:'.$bgcolor.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div>'. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .''.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';
				
			} else {
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container pm-parallax-panel '.$class.'" style="background-image:url('.$bgimage.'); background-repeat:'.$bgrepeat.'; background-attachment:'.$bgposition.' !important; background-color:'.$bgcolor.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'>'. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .''.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';
				
			}
			
			
		} else {
			
			if($icon !== ''){
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container'.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';"><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div>'. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .''.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';  	
				
			} else {
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';">'. ($fullscreen_container !== 'off' ? '<div class="container">' : '') .''.do_shortcode($content).''. ($fullscreen_container !== 'off' ? '</div>' : '') .'</div>';  	
				
			}
			
			
		}
		
	} else {
		
		if($icon !== ''){
			
			return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px;"><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div><div class="container">'.do_shortcode($content).'</div></div>'; 
			
		} else {
			
			return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px;"><div class="container">'.do_shortcode($content).'</div></div>'; 
				
		}
		  	
	}
    
}  

//COLUMN CONTAINER
function bootstrapRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//NESTED ROW
function nestedRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//COLUMN
function bootstrapColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

//NESTED COLUMN
function nestedColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

/******** BOOTSTRAP 3 COLUMNS END ***********/

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/
add_action('init', 'pm_ln_add_tiny_shortcodes');  
function pm_ln_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		 
		 //Bootstrap 3
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapContainer');  
     	 add_filter('mce_buttons_3', 'register_bootstrapContainer'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapRow');  
     	 add_filter('mce_buttons_3', 'register_bootstrapRow'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapColumn');  
     	 add_filter('mce_buttons_3', 'register_bootstrapColumn'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "standardButton" button
		 add_filter('mce_external_plugins', 'add_plugin_standardButton');  
		 add_filter('mce_buttons_3', 'register_standardButton');  
		 
		 //Add "boxButton" button
		 add_filter('mce_external_plugins', 'add_plugin_boxButton');  
		 add_filter('mce_buttons_3', 'register_boxButton');  
		 		 
		 //Add "Progress bar"
		 add_filter('mce_external_plugins', 'add_plugin_progressBar');  
		 add_filter('mce_buttons_3', 'register_progressBar');
		 
		 //Add "Single Post" button
		 add_filter('mce_external_plugins', 'add_plugin_singlepost');  
		 add_filter('mce_buttons_3', 'register_singlepost');
		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); 
		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');
		 
		 //Panel Header
		 /*add_filter('mce_external_plugins', 'add_plugin_panelHeader');  
     	 add_filter('mce_buttons_3', 'register_panelHeader');*/
		 
		 //Column Header
		 /*add_filter('mce_external_plugins', 'add_plugin_columnHeader');  
     	 add_filter('mce_buttons_3', 'register_columnHeader');*/
		 
		 //Testimonials
		 add_filter('mce_external_plugins', 'add_plugin_testimonials');  
     	 add_filter('mce_buttons_3', 'register_testimonials');	
		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	
		 
		 //Image panel
		 /*add_filter('mce_external_plugins', 'add_plugin_imagePanel');  
     	 add_filter('mce_buttons_3', 'register_imagePanel');*/
		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //CTA Box
		 add_filter('mce_external_plugins', 'add_plugin_ctaBox');  
     	 add_filter('mce_buttons_3', 'register_ctaBox');
		 
		  //Icon Element
		 add_filter('mce_external_plugins', 'add_plugin_iconElement');  
     	 add_filter('mce_buttons_3', 'register_iconElement');	
		 
		 //Flexslider Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sliderCarousel');  
     	 add_filter('mce_buttons_3', 'register_sliderCarousel');
		 
		 //Client Carousel
		 add_filter('mce_external_plugins', 'add_plugin_clientCarousel');  
     	 add_filter('mce_buttons_3', 'register_clientCarousel');
		 
		 //Panels Carousel
		 add_filter('mce_external_plugins', 'add_plugin_panelsCarousel');  
     	 add_filter('mce_buttons_3', 'register_panelsCarousel');
		 
		 //Pie Chart
		 add_filter('mce_external_plugins', 'add_plugin_piechart');  
     	 add_filter('mce_buttons_3', 'register_piechart');
		 
		 //Milestone
		 add_filter('mce_external_plugins', 'add_plugin_milestone');  
     	 add_filter('mce_buttons_3', 'register_milestone');
		 
		 //Countdown
		 add_filter('mce_external_plugins', 'add_plugin_countdown');  
     	 add_filter('mce_buttons_3', 'register_countdown');
		 
		 //Quote Box
		 add_filter('mce_external_plugins', 'add_plugin_quoteBox');  
     	 add_filter('mce_buttons_3', 'register_quoteBox');	
		 
		 //Pricing Table
		 add_filter('mce_external_plugins', 'add_plugin_pricingTable');  
     	 add_filter('mce_buttons_3', 'register_pricingTable');	 
		 
		 //Newsletter signup
		 add_filter('mce_external_plugins', 'add_plugin_newsletterSignup');  
     	 add_filter('mce_buttons_3', 'register_newsletterSignup');
		 
		 //CTA Box 2
		 add_filter('mce_external_plugins', 'add_plugin_ctaBox2');  
     	 add_filter('mce_buttons_3', 'register_ctaBox2');		
		 
		 //Stat Box 1
		 add_filter('mce_external_plugins', 'add_plugin_statBox1');  
     	 add_filter('mce_buttons_3', 'register_statBox1');
		 
		 //Stat Box 2
		 add_filter('mce_external_plugins', 'add_plugin_statBox2');  
     	 add_filter('mce_buttons_3', 'register_statBox2');
		 
		 
		 //Data Table
		 add_filter('mce_external_plugins', 'add_plugin_dataTableGroup');  
     	 add_filter('mce_buttons_3', 'register_dataTableGroup');
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffProfile');  
     	 add_filter('mce_buttons_3', 'register_staffProfile');
		 
		 //Workshop post
		 add_filter('mce_external_plugins', 'add_plugin_workshopPost');  
     	 add_filter('mce_buttons_3', 'register_workshopPost');
		 
		 //Post items
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems');
		 
		 //featureBox
		 add_filter('mce_external_plugins', 'add_plugin_featureBox');  
     	 add_filter('mce_buttons_3', 'register_featureBox');
		 		
	}

}


//ACTIVE
function register_workshopPost($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "workshopPost");  
   return $buttons;  
} 
function add_plugin_workshopPost($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['workshopPost'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_staffProfile($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffProfile");  
   return $buttons;  
} 
function add_plugin_staffProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_dataTableGroup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "dataTableGroup");  
   return $buttons;  
} 
function add_plugin_dataTableGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['dataTableGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_statBox2($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "statBox2");  
   return $buttons;  
} 
function add_plugin_statBox2($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['statBox2'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_statBox1($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "statBox1");  
   return $buttons;  
} 
function add_plugin_statBox1($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['statBox1'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_ctaBox2($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "ctaBox2");  
   return $buttons;  
} 
function add_plugin_ctaBox2($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['ctaBox2'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_newsletterSignup($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "newsletterSignup");  
   return $buttons;  
} 
function add_plugin_newsletterSignup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['newsletterSignup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_standardButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "standardButton");  
   return $buttons;  
} 
function add_plugin_standardButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['standardButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_boxButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "boxButton");  
   return $buttons;  
} 
function add_plugin_boxButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['boxButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}  

function register_singlepost($buttons) { //Registers the TinyMCE button
   array_push($buttons, "singlepost");  
   return $buttons;  
}
function add_plugin_singlepost($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['singlepost'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_progressBar($buttons) { //Registers the TinyMCE button
   array_push($buttons, "progressBar");  
   return $buttons;  
}
function add_plugin_progressBar($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['progressBar'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapContainer");  
   return $buttons;  
}
function add_plugin_bootstrapContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapContainer'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapRow($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapRow");  
   return $buttons;  
}
function add_plugin_bootstrapRow($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapRow'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapColumn($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapColumn");  
   return $buttons;  
}
function add_plugin_bootstrapColumn($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapColumn'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_html5Video($buttons) { //Registers the TinyMCE button
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['html5Video'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_testimonials($buttons) { //Registers the TinyMCE button
   array_push($buttons, "testimonials");  
   return $buttons;  
}
function add_plugin_testimonials($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['testimonials'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_ctaBox($buttons) {  
   array_push($buttons, "ctaBox");  
   return $buttons;  
}
function add_plugin_ctaBox($plugin_array) {  
   $plugin_array['ctaBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_iconElement($buttons) {  
   array_push($buttons, "iconElement");  
   return $buttons;  
}
function add_plugin_iconElement($plugin_array) {  
   $plugin_array['iconElement'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_sliderCarousel($buttons) {  
   array_push($buttons, "sliderCarousel");  
   return $buttons;  
}
function add_plugin_sliderCarousel($plugin_array) {  
   $plugin_array['sliderCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_clientCarousel($buttons) {  
   array_push($buttons, "clientCarousel");  
   return $buttons;  
}
function add_plugin_clientCarousel($plugin_array) {  
   $plugin_array['clientCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_panelsCarousel($buttons) {  
   array_push($buttons, "panelsCarousel");  
   return $buttons;  
}

function add_plugin_panelsCarousel($plugin_array) {  
   $plugin_array['panelsCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_piechart($buttons) {  
   array_push($buttons, "piechart");  
   return $buttons;  
}
function add_plugin_piechart($plugin_array) {  
   $plugin_array['piechart'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_milestone($buttons) {  
   array_push($buttons, "milestone");  
   return $buttons;  
}
function add_plugin_milestone($plugin_array) {  
   $plugin_array['milestone'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_countdown($buttons) {  
   array_push($buttons, "countdown");  
   return $buttons;  
}
function add_plugin_countdown($plugin_array) {  
   $plugin_array['countdown'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}

function register_quoteBox($buttons) {  
   array_push($buttons, "quoteBox");  
   return $buttons;  
}
function add_plugin_quoteBox($plugin_array) {  
   $plugin_array['quoteBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_pricingTable($buttons) {  
   array_push($buttons, "pricingTable");  
   return $buttons;  
}
function add_plugin_pricingTable($plugin_array) {  
   $plugin_array['pricingTable'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_postItems($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "postItems");  
   return $buttons;  
} 
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_featureBox($buttons) { //Registers the TinyMCE button
   array_push($buttons, "featureBox");  
   return $buttons;  
}
function add_plugin_featureBox($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['featureBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}


function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim(  do_shortcode( $content ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

?>