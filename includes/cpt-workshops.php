<?php
function cpt_workshops(){
	
	$url_rewrite = 'workshop';
	
	global $quantum_options;
	
	if( isset($quantum_options['opt-workshops-post-type-slug']) && !empty($quantum_options['opt-workshops-post-type-slug']) ) {
		$url_rewrite = $quantum_options['opt-workshops-post-type-slug'];
	} 


	register_post_type('post_workshops',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Workshops', 'quantumtheme' ),
				'singular_name' => esc_attr__( 'Workshops', 'quantumtheme' ),
				'add_new' => esc_attr__( 'Add New Workshop', 'quantumtheme' ),
				'add_new_item' => esc_attr__( 'Add New Workshop', 'quantumtheme' ),
				'edit' => esc_attr__( 'Edit', 'quantumtheme' ),
				'edit_item' => esc_attr__( 'Edit Workshop', 'quantumtheme' ),
				'new_item' => esc_attr__( 'New Workshop', 'quantumtheme' ),
				'view' => esc_attr__( 'View', 'quantumtheme' ),
				'view_item' => esc_attr__( 'View Workshop', 'quantumtheme' ),
				'search_items' => esc_attr__( 'Search Workshops', 'quantumtheme' ),
				'not_found' => esc_attr__( 'No Workshops found', 'quantumtheme' ),
				'not_found_in_trash' => esc_attr__( 'No Workshops found in Trash', 'quantumtheme' ),
				'parent' => esc_attr__( 'Parent Workshop', 'quantumtheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new workshops', 'quantumtheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

/*function tax_workshops() {
	
	if(function_exists('ot_get_option')){
		$url_rewrite = ot_get_option('staff_post_type_url');
		if( $url_rewrite == '' ) { 
			$url_rewrite = 'staff-members'; 
		} 
	} else {
		$url_rewrite = 'staff-members';
	}

	
	//Add category support
	register_taxonomy('staff_item_types', 'post_staff', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true, //Set to true for categories or false for tags
		'show_admin_column' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => esc_attr__('Staff Categories', 'quantumtheme'),
			'singular_name' => esc_attr__('Staff Categories', 'quantumtheme'),
			'search_items' =>  esc_attr__('Search Staff Categories', 'quantumtheme'),
			'all_items' => esc_attr__('Popular Staff Categories', 'quantumtheme'),
			'parent_item' => esc_attr__('Parent Staff Categories', 'quantumtheme'),
			'parent_item_colon' => esc_attr__('Parent Staff Category:', 'quantumtheme'),
			'edit_item' => esc_attr__('Edit Staff Category', 'quantumtheme'),
			'update_item' => esc_attr__('Update Staff Category', 'quantumtheme'),
			'add_new_item' => esc_attr__('Add New Staff Category', 'quantumtheme'),
			'new_item_name' => esc_attr__('New Staff Category Name', 'quantumtheme'),
			'menu_name' => esc_attr__('Staff Categories', 'quantumtheme'),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => $url_rewrite, // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
	
	flush_rewrite_rules();	
}*/

add_action('init', 'cpt_workshops');
//add_action('init', 'tax_staff');