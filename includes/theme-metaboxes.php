<?php

//News posts meta options
add_action( 'add_meta_boxes', 'add_post_metaoptions' );

//Page meta options
add_action( 'add_meta_boxes', 'add_page_metaoptions' );

//Staff meta options
add_action( 'add_meta_boxes', 'add_staff_metaoptions' );

//Workshops meta options
add_action( 'add_meta_boxes', 'add_workshops_metaoptions' );

//Careers meta options
add_action( 'add_meta_boxes', 'add_careers_metaoptions' );

//Woocommerce meta options
add_action( 'add_meta_boxes', 'add_woocommerce_metaoptions' );

//Gallery meta options
add_action( 'add_meta_boxes', 'add_gallery_metaoptions' );

//Save custom post/page data
add_action( 'save_post', 'save_postdata' );

/*** GALLERY META OPTIONS & FUNCTIONS *****/
function add_gallery_metaoptions() {
	
	//Post layout
	add_meta_box( 
		'pm_post_layout_meta', //ID
		 esc_attr__( 'Post Layout', 'quantumtheme' ),  //label
		'pm_post_layout_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'quantumtheme' ),  //label
		'pm_header_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Gallery image
	add_meta_box( 
		'pm_gallery_image_meta', //ID
		 esc_attr__( 'Gallery Image', 'quantumtheme' ),  //label
		'pm_gallery_image_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Video
	add_meta_box( 
		'pm_gallery_video_meta', //ID
		 esc_attr__( 'Youtube Video', 'quantumtheme' ),  //label
		'pm_gallery_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
	//Display Video in carousel
	add_meta_box( 
		'pm_gallery_display_video_meta', //ID
		 esc_attr__( 'Display Youtube Video?', 'quantumtheme' ),  //label
		'pm_gallery_display_video_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);

	
	//Message
	add_meta_box( 
		'pm_gallery_item_caption_meta', //ID
		 esc_attr__( 'Caption', 'quantumtheme' ),  //label
		'pm_gallery_item_caption_meta_function' , //function
		'post_galleries', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_gallery_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_header_image_meta = get_post_meta( $post->ID, 'pm_gallery_header_image_meta', true );
	//echo $post->ID . $pm_gallery_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px or 1920x800px for parallax mode','quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_header_image_meta); ?>" name="pm_gallery_header_image_meta" id="img-uploader-field" class="pm-admin-staff-header-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-secondary" />
        <div class="pm-staff-header-image-preview"></div>
    
    <?php
	
}

function pm_gallery_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_image_meta = get_post_meta( $post->ID, 'pm_gallery_image_meta', true );
	//echo $pm_gallery_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 900x400px','quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_image_meta); ?>" name="pm_gallery_image_meta" id="featured-img-uploader-field" class="pm-admin-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-primary" />
        <div class="pm-admin-gallery-image-preview"></div>
    
    	<?php if($pm_gallery_image_meta) : ?>
        	<input id="remove_gallery_image_button" type="button" value="<?php esc_html_e('Remove Image', 'quantumtheme'); ?>" class="button-primary" />
        <?php endif; ?>
    
    <?php
	
}

function pm_gallery_item_caption_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_item_caption_meta = get_post_meta( $post->ID, 'pm_gallery_item_caption_meta', true );
	//echo $pm_gallery_item_caption_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a caption for your gallery item (this will also display in the PrettyPhoto carousel unless disabled under Customize Quantum -> PrettyPhoto options).','quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_gallery_item_caption_meta); ?>" name="pm_gallery_item_caption_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_gallery_video_meta = get_post_meta( $post->ID, 'pm_gallery_video_meta', true );
	//echo $pm_gallery_video_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a Youtube video URL (ex. http://www.youtube.com/watch?v=ai9qbTKxwkc)','quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_gallery_video_meta); ?>" name="pm_gallery_video_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_gallery_display_video_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_gallery_display_video_meta = get_post_meta( $post->ID, 'pm_gallery_display_video_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Setting this to <strong>YES</strong> will override the gallery image in the PrettyPhoto carousel.', 'quantumtheme'); ?></p>
        <select id="pm_gallery_display_video_meta" name="pm_gallery_display_video_meta" class="pm-admin-select-list">  
        	<option value="no" <?php selected( $pm_gallery_display_video_meta, 'no' ); ?>><?php esc_attr_e('NO', 'quantumtheme') ?></option>
            <option value="yes" <?php selected( $pm_gallery_display_video_meta, 'yes' ); ?>><?php esc_attr_e('YES', 'quantumtheme') ?></option>
        </select>
    
    <?php
	
}

/*** WOOCOMMERCE META OPTIONS & FUNCTIONS *****/
function add_woocommerce_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_woocom_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'quantumtheme' ),  //label
		'pm_woocom_header_image_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);

	//Sidebar layout
	/*add_meta_box( 
		'pm_woocom_post_layout_meta', //ID
		 esc_attr__( 'Sidebar Layout', 'quantumtheme' ),  //label
		'pm_woocom_post_layout_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);*/
	
	//Header Message
	add_meta_box( 
		'pm_woocom_header_message_meta', //ID
		 esc_attr__( 'Page Header Message', 'quantumtheme' ),  //label
		'pm_woocom_header_message_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);
	
	//Header Message
	/*add_meta_box( 
		'pm_woocom_course_icon_meta', //ID
		 esc_attr__( 'Course Icon', 'quantumtheme' ),  //label
		'pm_woocom_course_icon_meta_function' , //function
		'product', //Post type
		'normal', 
		'high' 
	);*/
		
}

function pm_woocom_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_image_meta = get_post_meta( $post->ID, 'pm_woocom_header_image_meta', true );
	//echo $post->ID . $pm_woocom_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1920x500px','quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_woocom_header_image_meta); ?>" name="pm_woocom_header_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-field-preview"></div>
    
    <?php
	
}

function pm_woocom_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_woocom_post_layout_meta = get_post_meta( $post->ID, 'pm_woocom_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Select your desired layout for this post.','quantumtheme'); ?></p>
        <select id="pm_woocom_post_layout_meta" name="pm_woocom_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'quantumtheme'); ?></option>
            <option value="left-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'quantumtheme'); ?></option>
            <option value="right-sidebar" <?php selected( $pm_woocom_post_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'quantumtheme'); ?></option>
        </select>
            
    <?php
	
}

function pm_woocom_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_header_message_meta = get_post_meta( $post->ID, 'pm_woocom_header_message_meta', true );
	//echo $pm_woocom_header_message_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo esc_attr($pm_woocom_header_message_meta); ?>" name="pm_woocom_header_message_meta" class="pm-admin-text-field" />
    <?php
	
}

function pm_woocom_course_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_woocom_course_icon_meta = get_post_meta( $post->ID, 'pm_woocom_course_icon_meta', true );
	//echo $pm_woocom_header_message_meta;
		

	//HTML code
	?>
		<input type="text" value="<?php echo esc_attr($pm_woocom_course_icon_meta); ?>" name="pm_woocom_course_icon_meta" class="pm-admin-text-field" />
    <?php
	
}



/*** CAREERS META OPTIONS & FUNCTIONS *****/
function add_careers_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'quantumtheme' ),  //label
		'pm_header_image_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Position
	add_meta_box( 
		'pm_careers_position_meta', //ID
		 esc_attr__( 'Position', 'quantumtheme' ),  //label
		'pm_careers_position_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Department
	add_meta_box( 
		'pm_careers_department_meta', //ID
		 esc_attr__( 'Department', 'quantumtheme' ),  //label
		'pm_careers_department_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Opening Type
	add_meta_box( 
		'pm_careers_opening_type_meta', //ID
		 esc_attr__( 'Opening Type', 'quantumtheme' ),  //label
		'pm_careers_opening_type_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Location
	add_meta_box( 
		'pm_careers_location_meta', //ID
		 esc_attr__( 'Location', 'quantumtheme' ),  //label
		'pm_careers_location_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
	//Icon
	add_meta_box( 
		'pm_careers_icon_meta', //ID
		 esc_attr__( 'Icon', 'quantumtheme' ),  //label
		'pm_careers_icon_meta_function' , //function
		'post_careers', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_careers_position_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_position_meta = get_post_meta( $post->ID, 'pm_careers_position_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the position for this career post.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_position_meta); ?>" name="pm_careers_position_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_department_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_department_meta = get_post_meta( $post->ID, 'pm_careers_department_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the department for this career post.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_department_meta); ?>" name="pm_careers_department_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_opening_type_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_opening_type_meta = get_post_meta( $post->ID, 'pm_careers_opening_type_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the opening type of this career post (ex. Full-time, Part-time, Contract etc.)', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_opening_type_meta); ?>" name="pm_careers_opening_type_meta" class="pm-admin-text-field" />
    
    <?php
	
}


function pm_careers_location_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_location_meta = get_post_meta( $post->ID, 'pm_careers_location_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('State the location of this career post.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_location_meta); ?>" name="pm_careers_location_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_careers_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_careers_icon_meta = get_post_meta( $post->ID, 'pm_careers_icon_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Provide an icon the best relates to this career post.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Careers posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_careers_icon_meta); ?>" name="pm_careers_icon_meta" class="pm-admin-text-field" />
    
    <?php
	
}

/*** WORKSHOPS META OPTIONS & FUNCTIONS *****/
function add_workshops_metaoptions() {

	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'quantumtheme' ),  //label
		'pm_header_image_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Workshop Related Course Title
	add_meta_box( 
		'pm_workshop_related_course_title_meta', //ID
		 esc_attr__( 'Related Course Title', 'quantumtheme' ),  //label
		'pm_workshop_related_course_title_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Short Description
	add_meta_box( 
		'pm_workshop_short_description_meta', //ID
		 esc_attr__( 'Short Description', 'quantumtheme' ),  //label
		'pm_workshop_short_description_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Workshop Name
	add_meta_box( 
		'pm_workshop_name_meta', //ID
		 esc_attr__( 'Workshop Name', 'quantumtheme' ),  //label
		'pm_workshop_name_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Workshop Date
	add_meta_box( 
		'pm_workshop_date_meta', //ID
		 esc_attr__( 'Workshop Date', 'quantumtheme' ),  //label
		'pm_workshop_date_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Workshop Start Time
	add_meta_box( 
		'pm_workshop_start_time_meta', //ID
		 esc_attr__( 'Workshop Start Time', 'quantumtheme' ),  //label
		'pm_workshop_start_time_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
	
	//Workshop Icon
	add_meta_box( 
		'pm_workshop_icon_meta', //ID
		 esc_attr__( 'Workshop Icon', 'quantumtheme' ),  //label
		'pm_workshop_icon_meta_function' , //function
		'post_workshops', //Post type
		'normal', 
		'high' 
	);
}

function pm_workshop_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_header_image_meta = get_post_meta( $post->ID, 'pm_workshop_header_image_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_workshop_header_image_meta); ?>" name="pm_workshop_header_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-secondary" />
        <div class="pm-admin-upload-staff-preview"></div>
    
    <?php
	
}

function pm_workshop_related_course_title_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_related_course_title_meta = get_post_meta( $post->ID, 'pm_workshop_related_course_title_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the title of a course that may be related to this workshop.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Workshops posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_workshop_related_course_title_meta); ?>" name="pm_workshop_related_course_title_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_workshop_short_description_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_short_description_meta = get_post_meta( $post->ID, 'pm_workshop_short_description_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a short description for this workshop.', 'quantumtheme'); ?> <strong><?php esc_attr_e('NOTE:', 'quantumtheme'); ?></strong> <?php esc_attr_e('This will appear on the Workshops posts page.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_workshop_short_description_meta); ?>" name="pm_workshop_short_description_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_workshop_name_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_name_meta = get_post_meta( $post->ID, 'pm_workshop_name_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a name for this workshop.', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_attr($pm_workshop_name_meta); ?>" name="pm_workshop_name_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_workshop_date_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_date_meta = get_post_meta( $post->ID, 'pm_workshop_date_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the date of this workshop.', 'quantumtheme'); ?></p>	
		<input type="date" id="datepicker" name="pm_workshop_date_meta" value="<?php echo esc_attr($pm_workshop_date_meta); ?>" class="pm-admin-date-field" />
    
    <?php
	
}

function pm_workshop_start_time_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_start_time_meta = get_post_meta( $post->ID, 'pm_workshop_start_time_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter the start time of this workshop.', 'quantumtheme'); ?></p>	
		<input type="text" value="<?php echo esc_attr($pm_workshop_start_time_meta); ?>" name="pm_workshop_start_time_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_workshop_icon_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_workshop_icon_meta = get_post_meta( $post->ID, 'pm_workshop_icon_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Enter a FontAwesome or Typicon value that best represents this workshop.', 'quantumtheme'); ?></p>	
		<input type="text" value="<?php echo esc_attr($pm_workshop_icon_meta); ?>" name="pm_workshop_icon_meta" class="pm-admin-text-field" />
    
    <?php
	
}


/*** STAFF META OPTIONS & FUNCTIONS *****/
function add_staff_metaoptions() {

	//Header Image
	add_meta_box( 
		'pm_staff_image_meta', //ID
		 esc_attr__( 'Staff Profile Image', 'quantumtheme' ),  //label
		'pm_staff_image_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Staff Title
	add_meta_box( 
		'pm_staff_title_meta', //ID
		 esc_attr__( 'Staff Title', 'quantumtheme' ),  //label
		'pm_staff_title_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Twitter Address
	add_meta_box( 
		'pm_staff_twitter_meta', //ID
		 esc_attr__( 'Twitter Address', 'quantumtheme' ),  //label
		'pm_staff_twitter_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Facebook Address
	add_meta_box( 
		'pm_staff_facebook_meta', //ID
		 esc_attr__( 'Facebook Address', 'quantumtheme' ),  //label
		'pm_staff_facebook_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Google Plus Address
	add_meta_box( 
		'pm_staff_gplus_meta', //ID
		 esc_attr__( 'Google Plus Address', 'quantumtheme' ),  //label
		'pm_staff_gplus_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
	//Linkedin Address
	add_meta_box( 
		'pm_staff_linkedin_meta', //ID
		 esc_attr__( 'Linkedin Address', 'quantumtheme' ),  //label
		'pm_staff_linkedin_meta_function' , //function
		'post_staff', //Post type
		'normal', 
		'high' 
	);
	
}

function pm_staff_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_image_meta = get_post_meta( $post->ID, 'pm_staff_image_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_image_meta); ?>" name="pm_staff_image_meta" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-primary" />
        <div class="pm-admin-upload-staff-preview"></div>
        
        <?php if($pm_staff_image_meta) : ?>
        	<input id="remove_staff_profile_image_button" type="button" value="<?php esc_html_e('Remove Image', 'quantumtheme'); ?>" class="button-primary" />
        <?php endif; ?>  
    
    <?php
	
}

function pm_staff_title_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_title_meta = get_post_meta( $post->ID, 'pm_staff_title_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_staff_title_meta); ?>" name="pm_staff_title_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_twitter_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_twitter_meta = get_post_meta( $post->ID, 'pm_staff_twitter_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_twitter_meta); ?>" name="pm_staff_twitter_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_facebook_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_facebook_meta = get_post_meta( $post->ID, 'pm_staff_facebook_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_facebook_meta); ?>" name="pm_staff_facebook_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_gplus_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_gplus_meta = get_post_meta( $post->ID, 'pm_staff_gplus_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_gplus_meta); ?>" name="pm_staff_gplus_meta" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_staff_linkedin_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_staff_linkedin_meta = get_post_meta( $post->ID, 'pm_staff_linkedin_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_html($pm_staff_linkedin_meta); ?>" name="pm_staff_linkedin_meta" class="pm-admin-text-field" />
    
    <?php
	
}

/*** POST META OPTIONS & FUNCTIONS *****/
function add_post_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		esc_attr__( 'Post Header Image', 'quantumtheme' ),  //label
		'pm_header_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Featured Post Image
	add_meta_box( 
		'pm_featured_post_image_meta', //ID
		esc_attr__( 'Featured Post Image', 'quantumtheme' ),  //label
		'pm_featured_post_image_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Post layout
	add_meta_box( 
		'pm_post_layout_meta', //ID
		esc_attr__( 'Post Layout', 'quantumtheme' ),  //label
		'pm_post_layout_meta_function' , //function
		'post', //Post type
		'side'
	);
	
	//Post sidebar
	add_meta_box(
        'custom_sidebar',
        esc_attr__( 'Custom Sidebar', 'quantumtheme' ),
        'pm_ln_custom_sidebar_callback',
        'post',
        'side'
    );
	
	//Featured Post
	add_meta_box( 
		'pm_post_featured_meta', //ID
		esc_attr__( 'Feature in Presentation carousel?', 'quantumtheme' ),  //label
		'pm_post_featured_meta_function' , //function
		'post', //Post type
		'normal', 
		'high' 
	);
	
	//Post Visibility
	add_meta_box(
		'pm_post_visibility', // Unique ID
		esc_attr__( 'Post Type Visibility', 'quantumtheme' ), // Title
		'pm_post_visibility_function', // Callback function
		'post', // Admin page (or post type)
		'side', // Context
		'default' // Priority
	);
	
	
}

function pm_header_image_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_image_meta = get_post_meta( $post->ID, 'pm_header_image_meta', true );
	//echo $post->ID . $pm_header_image_meta;
		

	//HTML code
	?>
    	<p>Recommended size: 1920x500px</p>
		<input type="text" value="<?php echo esc_html($pm_header_image_meta); ?>" name="post-header-image" id="img-uploader-field" class="pm-admin-upload-field" />
		<input id="upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-primary" />
        <div class="pm-admin-upload-field-preview"></div>
    	
        <?php if($pm_header_image_meta) : ?>
        	<input id="remove_page_header_button" type="button" value="<?php esc_html_e('Remove Image', 'quantumtheme'); ?>" class="button-primary" />
        <?php endif; ?>  
    
    <?php
	
}

function pm_featured_post_image_meta_function ($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_featured_post_image_meta = get_post_meta( $post->ID, 'pm_featured_post_image_meta', true );
	//echo $post->ID . $pm_header_image_meta;
		

	//HTML code
	?>
    	<p><?php esc_attr_e('Recommended size: 1170x400px', 'quantumtheme'); ?></p>
		<input type="text" value="<?php echo esc_html($pm_featured_post_image_meta); ?>" name="pm_featured_post_image_meta" id="featured-img-uploader-field" class="pm-featured-image-upload-field" />
		<input id="featured_upload_image_button" type="button" value="<?php esc_attr_e('Media Library Image', 'quantumtheme'); ?>" class="button-primary" />
        <div class="pm-featured-image-preview"></div>
        
        <?php if($pm_featured_post_image_meta) : ?>
        	<input id="remove_featured_post_image_button" type="button" value="<?php esc_html_e('Remove Image', 'quantumtheme'); ?>" class="button-primary" />
        <?php endif; ?>  
    
    <?php
	
}

function pm_header_message_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );

	//Retrieve the meta value if it exists
	$pm_header_message_meta = get_post_meta( $post->ID, 'pm_header_message_meta', true );
	//echo $pm_header_image_meta;
		

	//HTML code
	?>
    
		<input type="text" value="<?php echo esc_attr($pm_header_message_meta); ?>" name="post-header-message" class="pm-admin-text-field" />
    
    <?php
	
}

function pm_post_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_layout_meta = get_post_meta( $post->ID, 'pm_post_layout_meta', true );
	//echo $pm_post_layout_meta;
	
	?>
        <p><?php esc_attr_e('Select your desired layout for this post.', 'quantumtheme'); ?></p>
        <select id="pm_post_layout_meta" name="pm_post_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_post_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'quantumtheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_post_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'quantumtheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_post_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'quantumtheme') ?></option>
        </select>
        
        
    
    <?php
	
}

function pm_post_featured_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_post_featured_meta = get_post_meta( $post->ID, 'pm_post_featured_meta', true );
	//echo $pm_post_featured_meta;
	
	?>
    	<p><?php esc_attr_e('Setting this to "YES" will display this post on the homepage post slider carousel.', 'quantumtheme'); ?></p>
        <select id="pm_post_featured_meta" name="pm_post_featured_meta" class="pm-admin-select-list">  
            <option value="off" <?php selected( $pm_post_featured_meta, 'off' ); ?>><?php esc_attr_e('No', 'quantumtheme') ?></option>
            <option value="on" <?php selected( $pm_post_featured_meta, 'on' ); ?>><?php esc_attr_e('Yes', 'quantumtheme') ?></option>
        </select>
    
    <?php
		
}

/* Display the post meta box. */
function pm_post_visibility_function($post) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'post_meta_nonce' ); ?>
    
    <?php 
	
	//Retrieve the meta value if it exists
	$pm_post_visibility = get_post_meta( $post->ID, 'pm_post_visibility', true ); 
	//echo $pm_post_visibility;
	
	?>

	<p>
    
    	<input name="pm_post_visibility" type="radio" value="public" <?php checked( $pm_post_visibility, 'public' ); ?> />
		<label for="pm-ln-post-type"><?php esc_attr_e( "Public", 'quantumtheme' ); ?></label>
        
		<br />
        <input name="pm_post_visibility" type="radio" value="members" <?php checked( $pm_post_visibility, 'members' ); ?> />
        <label for="pm-ln-post-type"><?php esc_attr_e( "Members Only", 'quantumtheme' ); ?></label>
        
        <br />
        		
	</p>
    
<?php }

/*** PAGE META OPTIONS & FUNCTIONS *****/
function add_page_metaoptions() {
	
	//Header Image
	add_meta_box( 
		'pm_header_image_meta', //ID
		 esc_attr__( 'Page Header Image', 'quantumtheme' ),  //label
		'pm_header_image_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	//Page layout
	add_meta_box( 
		'pm_page_layout_meta', //ID
		 esc_attr__( 'Page Layout', 'quantumtheme' ),  //label
		'pm_page_layout_meta_function' , //function
		'page', //Post type
		'side'
	);
	
	//Page sidebar
	add_meta_box(
        'custom_sidebar',
        esc_attr__( 'Custom Sidebar', 'quantumtheme' ),
        'pm_ln_custom_sidebar_callback',
        'page',
        'side'
    );
		
	//Disable Container
	add_meta_box( 
		'pm_page_disable_container_meta', //ID
		 esc_attr__( 'Disable Bootstrap container for full width content?', 'quantumtheme' ),  //label
		'pm_page_disable_container_meta_function' , //function
		'page', //Post type
		'side' 
	);
	
	//Container Padding
	add_meta_box( 
		'pm_bootstrap_container_padding', //ID
		 esc_attr__( 'Bootstrap Container Padding Amount', 'quantumtheme' ),  //label
		'pm_bootstrap_container_padding_function' , //function
		'page', //Post type
		'side'
	);
	
	//Print and Share
	add_meta_box( 
		'pm_page_print_share_meta', //ID
		 esc_attr__( 'Enable Print and Share options?', 'quantumtheme' ),  //label
		'pm_page_print_share_meta_function' , //function
		'page', //Post type
		'side' 
	);
	
	//Disable Header?
	add_meta_box( 
		'pm_display_header_meta', //ID
		 esc_attr__( 'Display Header?', 'quantumtheme' ),  //label
		'pm_display_header_meta_function' , //function
		'page', //Post type
		'side' 
	);
	
	
	//Header Message
	add_meta_box( 
		'pm_header_message_meta', //ID
		esc_attr__('Page Header Message', 'quantumtheme' ),  //label
		'pm_header_message_meta_function' , //function
		'page', //Post type
		'normal', 
		'high' 
	);
	
	
}

function pm_page_layout_meta_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_layout_meta = get_post_meta( $post->ID, 'pm_page_layout_meta', true );
	//echo $pm_page_layout_meta;
	
	?>
            
        <select id="pm_page_layout_meta" name="pm_page_layout_meta" class="pm-admin-select-list">  
            <option value="no-sidebar" <?php selected( $pm_page_layout_meta, 'no-sidebar' ); ?>><?php esc_attr_e('No Sidebar', 'quantumtheme') ?></option>
            <option value="left-sidebar" <?php selected( $pm_page_layout_meta, 'left-sidebar' ); ?>><?php esc_attr_e('Left Sidebar', 'quantumtheme') ?></option>
            <option value="right-sidebar" <?php selected( $pm_page_layout_meta, 'right-sidebar' ); ?>><?php esc_attr_e('Right Sidebar', 'quantumtheme') ?></option>
        </select>
    
    <?php
	
}

function pm_page_disable_container_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_disable_container_meta = get_post_meta( $post->ID, 'pm_page_disable_container_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_page_disable_container_meta" class="pm-admin-select-list"> 
        	<option value="no" <?php selected( $pm_page_disable_container_meta, 'no' ); ?>><?php esc_attr_e('No', 'quantumtheme') ?></option> 
            <option value="yes" <?php selected( $pm_page_disable_container_meta, 'yes' ); ?>><?php esc_attr_e('Yes', 'quantumtheme') ?></option>
        </select>
    
    <?php
	
}

function pm_bootstrap_container_padding_function($post) {
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_bootstrap_container_padding_meta = get_post_meta( $post->ID, 'pm_bootstrap_container_padding_meta', true );
	
	?>
            
        <select id="pm_page_disable_container_meta" name="pm_bootstrap_container_padding_meta" class="pm-admin-select-list"> 
        	<option value="120" <?php selected( $pm_bootstrap_container_padding_meta, '120' ); ?>>120</option>
            <option value="110" <?php selected( $pm_bootstrap_container_padding_meta, '110' ); ?>>110</option>
            <option value="100" <?php selected( $pm_bootstrap_container_padding_meta, '100' ); ?>>100</option>
            <option value="90" <?php selected( $pm_bootstrap_container_padding_meta, '90' ); ?>>90</option>
            <option value="80" <?php selected( $pm_bootstrap_container_padding_meta, '80' ); ?>>80</option>
            <option value="70" <?php selected( $pm_bootstrap_container_padding_meta, '70' ); ?>>70</option>
            <option value="60" <?php selected( $pm_bootstrap_container_padding_meta, '60' ); ?>>60</option>
            <option value="50" <?php selected( $pm_bootstrap_container_padding_meta, '50' ); ?>>50</option>
            <option value="40" <?php selected( $pm_bootstrap_container_padding_meta, '40' ); ?>>40</option>
            <option value="30" <?php selected( $pm_bootstrap_container_padding_meta, '30' ); ?>>30</option>
            <option value="20" <?php selected( $pm_bootstrap_container_padding_meta, '20' ); ?>>20</option>
        	<option value="10" <?php selected( $pm_bootstrap_container_padding_meta, '10' ); ?>>10</option> 
        	<option value="0" <?php selected( $pm_bootstrap_container_padding_meta, '0' ); ?>>0</option> 
        	           
        </select>
    
    <?php
	
}

function pm_page_print_share_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_page_print_share_meta = get_post_meta( $post->ID, 'pm_page_print_share_meta', true );
	//echo $pm_post_disable_container_meta;
	
	?>
            
        <select id="pm_page_print_share_meta" name="pm_page_print_share_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_page_print_share_meta, 'on' ); ?>><?php esc_attr_e('ON', 'quantumtheme') ?></option> 
            <option value="off" <?php selected( $pm_page_print_share_meta, 'off' ); ?>><?php esc_attr_e('OFF', 'quantumtheme') ?></option>
        </select>
    
    <?php
	
}

function pm_display_header_meta_function($post) {

	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
	//Retrieve the meta value if it exists
	$pm_display_header_meta = get_post_meta( $post->ID, 'pm_display_header_meta', true );
	//echo $pm_display_header_meta;
	
	?>
            
        <select id="pm_display_header_meta" name="pm_display_header_meta" class="pm-admin-select-list"> 
        	<option value="on" <?php selected( $pm_display_header_meta, 'on' ); ?>><?php esc_attr_e('ON', 'quantumtheme') ?></option> 
            <option value="off" <?php selected( $pm_display_header_meta, 'off' ); ?>><?php esc_attr_e('OFF', 'quantumtheme') ?></option>
        </select>
    
    <?php
	
}


function pm_ln_custom_sidebar_callback( $post ){
	
	// Use nonce for verification
    wp_nonce_field( 'theme_metabox', 'post_meta_nonce' );
	
    global $wp_registered_sidebars;
     
    $custom = get_post_custom($post->ID);
     
    if(isset($custom['custom_sidebar']))
        $val = $custom['custom_sidebar'][0];
    else
        $val = "default";
 
    // The actual fields for data entry
    $output = '<p><label for="myplugin_new_field">'.esc_attr__("Choose a sidebar to display", 'twentyeleven' ).'</label></p>';
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".esc_attr__('No Sidebar', 'quantumtheme')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar['name'] == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar['name']."'>".$sidebar['name']."</option>";
    }
   
    $output .= "</select>";
     
    echo $output;
}

/* When the post is saved, saves our custom data */
function save_postdata( $post_id ) {
	
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
 	
	if(isset($_POST['post_meta_nonce'])){
		
		if ( !wp_verify_nonce( $_POST['post_meta_nonce'], 'theme_metabox' ) )
		    return;
	 
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
			
		//Check for post values
		if(isset($_POST['post-header-image'])){
			$postHeaderImage = $_POST['post-header-image'];
			update_post_meta($post_id, "pm_header_image_meta", $postHeaderImage);
		}
		if(isset($_POST['pm_featured_post_image_meta'])){
			$pmFeaturedPostImageMeta = $_POST['pm_featured_post_image_meta'];
			update_post_meta($post_id, "pm_featured_post_image_meta", $pmFeaturedPostImageMeta);
		}		
		if(isset($_POST['post-header-message'])){
			$postHeaderImage = $_POST['post-header-message'];
			update_post_meta($post_id, "pm_header_message_meta", $postHeaderImage);
		}
	 
	 	if(isset($_POST['pm_post_layout_meta'])){
			$pmPostLayoutMeta = $_POST['pm_post_layout_meta'];
			update_post_meta($post_id, "pm_post_layout_meta", $pmPostLayoutMeta);
		}
		
		if(isset($_POST['pm_post_featured_meta'])){
			$pmPostFeaturedMeta = $_POST['pm_post_featured_meta'];
			update_post_meta($post_id, "pm_post_featured_meta", $pmPostFeaturedMeta);
		}
		
		if(isset($_POST['pm_post_visibility'])){
			$pmPostVisibility = $_POST['pm_post_visibility'];
			update_post_meta($post_id, "pm_post_visibility", $pmPostVisibility);
		}
		
		
		//Check for page values
		if(isset($_POST['pm_header_image_meta'])){
			$pmPageHeaderImageMeta = $_POST['pm_header_image_meta'];
			update_post_meta($post_id, "pm_header_image_meta", $pmPageHeaderImageMeta);
		}
		
		if(isset($_POST['pm_page_layout_meta'])){
			$pmPageLayoutMeta = $_POST['pm_page_layout_meta'];
			update_post_meta($post_id, "pm_page_layout_meta", $pmPageLayoutMeta);
		}
		
		if(isset($_POST['pm_page_disable_container_meta'])){
			$pmPageDisableContainerMeta = $_POST['pm_page_disable_container_meta'];
			update_post_meta($post_id, "pm_page_disable_container_meta", $pmPageDisableContainerMeta);
		}
		
		if(isset($_POST['pm_bootstrap_container_padding_meta'])){
			update_post_meta($post_id, "pm_bootstrap_container_padding_meta", $_POST['pm_bootstrap_container_padding_meta']);
		}
		
		if(isset($_POST['pm_page_print_share_meta'])){
			$pmPagePrintShareMeta = $_POST['pm_page_print_share_meta'];
			update_post_meta($post_id, "pm_page_print_share_meta", $pmPagePrintShareMeta);
		}
		
		if(isset($_POST['pm_display_header_meta'])){
			$pmDisplayHeaderMeta = $_POST['pm_display_header_meta'];
			update_post_meta($post_id, "pm_display_header_meta", $pmDisplayHeaderMeta);
		}
		
		
		
		//Check for staff values
		if(isset($_POST['pm_staff_image_meta'])){
			$pmStaffImageMeta = $_POST['pm_staff_image_meta'];
			update_post_meta($post_id, "pm_staff_image_meta", $pmStaffImageMeta);
		}
		
		if(isset($_POST['pm_staff_title_meta'])){
			$pmStaffTitleMeta = $_POST['pm_staff_title_meta'];
			update_post_meta($post_id, "pm_staff_title_meta", $pmStaffTitleMeta);
		}
		
		if(isset($_POST['pm_staff_twitter_meta'])){
			$pmStaffTwitterMeta = $_POST['pm_staff_twitter_meta'];
			update_post_meta($post_id, "pm_staff_twitter_meta", $pmStaffTwitterMeta);
		}
		
		if(isset($_POST['pm_staff_facebook_meta'])){
			$pmStaffFacebookMeta = $_POST['pm_staff_facebook_meta'];
			update_post_meta($post_id, "pm_staff_facebook_meta", $pmStaffFacebookMeta);
		}
		
		if(isset($_POST['pm_staff_gplus_meta'])){
			$pmStaffGoogleMeta = $_POST['pm_staff_gplus_meta'];
			update_post_meta($post_id, "pm_staff_gplus_meta", $pmStaffGoogleMeta);
		}
		
		if(isset($_POST['pm_staff_linkedin_meta'])){
			$pmStaffLinkedinMeta = $_POST['pm_staff_linkedin_meta'];
			update_post_meta($post_id, "pm_staff_linkedin_meta", $pmStaffLinkedinMeta);
		}
		
		//Check for Workshop values
		if(isset($_POST['pm_workshop_header_image_meta'])){
			$pmWorkshopHeaderImageMeta = $_POST['pm_workshop_header_image_meta'];
			update_post_meta($post_id, "pm_workshop_header_image_meta", $pmWorkshopHeaderImageMeta);
		}
		if(isset($_POST['pm_workshop_related_course_title_meta'])){
			$pmWorkshopRelatedCourseTitleMeta = $_POST['pm_workshop_related_course_title_meta'];
			update_post_meta($post_id, "pm_workshop_related_course_title_meta", $pmWorkshopRelatedCourseTitleMeta);
		}
		if(isset($_POST['pm_workshop_short_description_meta'])){
			$pmWorkshopShortDescriptionMeta = $_POST['pm_workshop_short_description_meta'];
			update_post_meta($post_id, "pm_workshop_short_description_meta", $pmWorkshopShortDescriptionMeta);
		}
		if(isset($_POST['pm_workshop_name_meta'])){
			$pmWorkshopNameMeta = $_POST['pm_workshop_name_meta'];
			update_post_meta($post_id, "pm_workshop_name_meta", $pmWorkshopNameMeta);
		}
		if(isset($_POST['pm_workshop_date_meta'])){
			$pmWorkshopDateMeta = $_POST['pm_workshop_date_meta'];
			update_post_meta($post_id, "pm_workshop_date_meta", $pmWorkshopDateMeta);
		}
		if(isset($_POST['pm_workshop_start_time_meta'])){
			$pmWorkshopStartTimeMeta = $_POST['pm_workshop_start_time_meta'];
			update_post_meta($post_id, "pm_workshop_start_time_meta", $pmWorkshopStartTimeMeta);
		}
		if(isset($_POST['pm_workshop_icon_meta'])){
			$pmWorkshopIconMeta = $_POST['pm_workshop_icon_meta'];
			update_post_meta($post_id, "pm_workshop_icon_meta", $pmWorkshopIconMeta);
		}
		
		//Check for Careers values
		if(isset($_POST['pm_careers_position_meta'])){
			$pmCareersPositionMeta = $_POST['pm_careers_position_meta'];
			update_post_meta($post_id, "pm_careers_position_meta", $pmCareersPositionMeta);
		}
		if(isset($_POST['pm_careers_department_meta'])){
			$pmCareersDepartmentMeta = $_POST['pm_careers_department_meta'];
			update_post_meta($post_id, "pm_careers_department_meta", $pmCareersDepartmentMeta);
		}
		if(isset($_POST['pm_careers_opening_type_meta'])){
			$pmCareersOpeningTypeMeta = $_POST['pm_careers_opening_type_meta'];
			update_post_meta($post_id, "pm_careers_opening_type_meta", $pmCareersOpeningTypeMeta);
		}
		if(isset($_POST['pm_careers_location_meta'])){
			$pmCareersLocationMeta = $_POST['pm_careers_location_meta'];
			update_post_meta($post_id, "pm_careers_location_meta", $pmCareersLocationMeta);
		}
		if(isset($_POST['pm_careers_icon_meta'])){
			$pmCareersIconMeta = $_POST['pm_careers_icon_meta'];
			update_post_meta($post_id, "pm_careers_icon_meta", $pmCareersIconMeta);
		}
		
		//Check for Woocommerce values
		if(isset($_POST['pm_woocom_header_image_meta'])){
			$pmWoocomHeaderImageMeta = $_POST['pm_woocom_header_image_meta'];
			update_post_meta($post_id, "pm_woocom_header_image_meta", $pmWoocomHeaderImageMeta);
		}
		if(isset($_POST['pm_woocom_post_layout_meta'])){
			$pmWoocomPostLayoutMeta = $_POST['pm_woocom_post_layout_meta'];
			update_post_meta($post_id, "pm_woocom_post_layout_meta", $pmWoocomPostLayoutMeta);
		}
		if(isset($_POST['pm_woocom_header_message_meta'])){
			$pmWoocomHeaderMessageMeta = $_POST['pm_woocom_header_message_meta'];
			update_post_meta($post_id, "pm_woocom_header_message_meta", $pmWoocomHeaderMessageMeta);
		}
		if(isset($_POST['pm_woocom_course_icon_meta'])){
			$pmWoocomCourseIconMeta = $_POST['pm_woocom_course_icon_meta'];
			update_post_meta($post_id, "pm_woocom_course_icon_meta", $pmWoocomCourseIconMeta);
		}
		
		//Gallery values
		if(isset($_POST['pm_gallery_header_image_meta'])){
			$pmGalleryHeaderImageMeta = $_POST['pm_gallery_header_image_meta'];
			update_post_meta($post_id, "pm_gallery_header_image_meta", $pmGalleryHeaderImageMeta);
		}
		
		if(isset($_POST['pm_gallery_image_meta'])){
			$pmGalleryImageMeta = $_POST['pm_gallery_image_meta'];
			update_post_meta($post_id, "pm_gallery_image_meta", $pmGalleryImageMeta);
		}
		
		if(isset($_POST['pm_gallery_item_caption_meta'])){
			$pmGalleryItemCaptionMeta = $_POST['pm_gallery_item_caption_meta'];
			update_post_meta($post_id, "pm_gallery_item_caption_meta", $pmGalleryItemCaptionMeta);
		}
		
		if(isset($_POST['pm_gallery_video_meta'])){
			$pmGalleryVideoMeta = $_POST['pm_gallery_video_meta'];
			update_post_meta($post_id, "pm_gallery_video_meta", $pmGalleryVideoMeta);
		}
		
		if(isset($_POST['pm_gallery_display_video_meta'])){
			$pmGalleryDisplayVideoMeta = $_POST['pm_gallery_display_video_meta'];
			update_post_meta($post_id, "pm_gallery_display_video_meta", $pmGalleryDisplayVideoMeta);
		}
		
		if(isset($_POST['custom_sidebar'])){
			update_post_meta($post_id, "custom_sidebar", $_POST['custom_sidebar']);
		}
				
			
	} else {
		return;
	}	
    
}

?>