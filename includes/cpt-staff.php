<?php
function cpt_staff(){
	
	$url_rewrite = 'staff-member';
	
	global $quantum_options;
	
	if( isset($quantum_options['opt-staff-post-type-slug']) && !empty($quantum_options['opt-staff-post-type-slug']) ) {
		$url_rewrite = $quantum_options['opt-staff-post-type-slug'];
	} 


	register_post_type('post_staff',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Staff', 'quantumtheme' ),
				'singular_name' => esc_attr__( 'Staff', 'quantumtheme' ),
				'add_new' => esc_attr__( 'Add New Staff profile', 'quantumtheme' ),
				'add_new_item' => esc_attr__( 'Add New Staff profile', 'quantumtheme' ),
				'edit' => esc_attr__( 'Edit', 'quantumtheme' ),
				'edit_item' => esc_attr__( 'Edit Staff profile', 'quantumtheme' ),
				'new_item' => esc_attr__( 'New Staff profile', 'quantumtheme' ),
				'view' => esc_attr__( 'View', 'quantumtheme' ),
				'view_item' => esc_attr__( 'View Staff profile', 'quantumtheme' ),
				'search_items' => esc_attr__( 'Search Staff profiles', 'quantumtheme' ),
				'not_found' => esc_attr__( 'No Staff profiles found', 'quantumtheme' ),
				'not_found_in_trash' => esc_attr__( 'No Staff profiles found in Trash', 'quantumtheme' ),
				'parent' => esc_attr__( 'Parent Staff', 'quantumtheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new staff profiles', 'quantumtheme' ),
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

function staff_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Staff Categories', 'quantumtheme' ),
		'singular_name' => esc_attr__( 'Staff Categories', 'quantumtheme' ),
		'search_items' =>  esc_attr__( 'Search Staff Categories', 'quantumtheme' ),
		'popular_items' => esc_attr__( 'Popular Staff Categories', 'quantumtheme' ),
		'all_items' => esc_attr__( 'All Staff Categories', 'quantumtheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Staff Category', 'quantumtheme' ),
		'update_item' => esc_attr__( 'Update Staff Category', 'quantumtheme' ),
		'add_new_item' => esc_attr__( 'Add Staff Category', 'quantumtheme' ),
		'new_item_name' => esc_attr__( 'New Staff Category Name', 'quantumtheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Staff Categories with commas', 'quantumtheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Staff Categories', 'quantumtheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Staff Categories', 'quantumtheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'staffcats', 'post_staff', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'staff-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_staff');
add_action('init', 'staff_categories');