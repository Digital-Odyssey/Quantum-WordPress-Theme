<?php

function cpt_gallery(){
	
	$url_rewrite = 'gallery';
	
	global $quantum_options;
	
	if( isset($quantum_options['opt-gallery-post-type-slug']) && !empty($quantum_options['opt-gallery-post-type-slug']) ) {
		$url_rewrite = $quantum_options['opt-gallery-post-type-slug'];
	} 


	register_post_type('post_galleries',
		array(
			'labels' => array(
				'name' => esc_attr__( 'Gallery', 'quantumtheme' ),
				'singular_name' => esc_attr__( 'Gallery', 'quantumtheme' ),
				'add_new' => esc_attr__( 'Add New Gallery item', 'quantumtheme' ),
				'add_new_item' => esc_attr__( 'Add New Gallery item', 'quantumtheme' ),
				'edit' => esc_attr__( 'Edit', 'quantumtheme' ),
				'edit_item' => esc_attr__( 'Edit Gallery item', 'quantumtheme' ),
				'new_item' => esc_attr__( 'New Gallery item', 'quantumtheme' ),
				'view' => esc_attr__( 'View', 'quantumtheme' ),
				'view_item' => esc_attr__( 'View Gallery item', 'quantumtheme' ),
				'search_items' => esc_attr__( 'Search Gallery items', 'quantumtheme' ),
				'not_found' => esc_attr__( 'No Gallery items found', 'quantumtheme' ),
				'not_found_in_trash' => esc_attr__( 'No Gallery items found in Trash', 'quantumtheme' ),
				'parent' => esc_attr__( 'Parent Staff', 'quantumtheme' )
			),
			'description' => esc_attr__( 'Easily lets you add new gallery items', 'quantumtheme' ),
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'map_meta_cap' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'pages' => true,
			//'has_archive' => true, //SAVES IN AN ARCHIVE?
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'author', 'excerpt'),
			//'taxonomies' => array('category', 'post_tag')
		)
	); 
	flush_rewrite_rules();
}

function gallery_categories() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Categories', 'quantumtheme' ),
		'singular_name' => esc_attr__( 'Gallery Categories', 'quantumtheme' ),
		'search_items' =>  esc_attr__( 'Search Gallery Categories', 'quantumtheme' ),
		'popular_items' => esc_attr__( 'Popular Gallery Categories', 'quantumtheme' ),
		'all_items' => esc_attr__( 'All Gallery Categories', 'quantumtheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'quantumtheme' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'quantumtheme' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'quantumtheme' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'quantumtheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Categories with commas', 'quantumtheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Categories', 'quantumtheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Categories', 'quantumtheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerycats', 'post_galleries', array(
		'hierarchical' => true, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-category' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

function gallery_tags() {
	
	// create the array for 'labels'
    $labels = array(
		'name' => esc_attr__( 'Gallery Tags', 'quantumtheme' ),
		'singular_name' => esc_attr__( 'Gallery Tags', 'quantumtheme' ),
		'search_items' =>  esc_attr__( 'Search Gallery Tags', 'quantumtheme' ),
		'popular_items' => esc_attr__( 'Popular Gallery Tags', 'quantumtheme' ),
		'all_items' => esc_attr__( 'All Gallery Tags', 'quantumtheme' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Gallery Category', 'quantumtheme' ),
		'update_item' => esc_attr__( 'Update Gallery Category', 'quantumtheme' ),
		'add_new_item' => esc_attr__( 'Add Gallery Category', 'quantumtheme' ),
		'new_item_name' => esc_attr__( 'New Gallery Category Name', 'quantumtheme' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Gallery Tags with commas', 'quantumtheme' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Gallery Tags', 'quantumtheme' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Gallery Tags', 'quantumtheme' )
    );
	
    // register your Flags taxonomy
    register_taxonomy( 'gallerytags', 'post_galleries', array(
		'hierarchical' => false, //Set to true for categories or false for tags
		'labels' => $labels, // adds the above $labels array
		'show_ui' => true,
		'query_var' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => 'gallery-tag' ), // changes name in permalink structure
    ));
	
	flush_rewrite_rules();	
}

add_action('init', 'cpt_gallery');
add_action('init', 'gallery_categories');
add_action('init', 'gallery_tags');