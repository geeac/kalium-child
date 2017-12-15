<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

// After theme setup hooks
function kalium_child_after_setup_theme() {
	// Load translations for child theme
	load_child_theme_textdomain( 'kalium-child', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'kalium_child_after_setup_theme' );

// This will enqueue style.css of child theme
function kalium_child_wp_enqueue_scripts() {
	wp_enqueue_style( 'kalium-child', get_stylesheet_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'kalium_child_wp_enqueue_scripts', 100 );

// Add 4:3 thumbnail image
add_image_size( 'thumb-medium', 400, 300, true );

function gc_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'gc_theme_archive_title' );

//Register Client and Service taxonomies for pages
function gc_register_taxonomies() {
	$taxonomies = array(
		array(
			'slug'         => 'client',
			'single_name'  => 'Client',
			'plural_name'  => 'Clients',
			'post_type'    => 'portfolio',
			//'rewrite'      => array( 'slug' => 'department' ),
		),
		array(
			'slug'         => 'service',
			'single_name'  => 'Service',
			'plural_name'  => 'Services',
			'post_type'    => 'portfolio',
		),
	);
	foreach( $taxonomies as $taxonomy ) {
		$labels = array(
			'name' => $taxonomy['plural_name'],
			'singular_name' => $taxonomy['single_name'],
			'search_items' =>  'Search ' . $taxonomy['plural_name'],
			'all_items' => 'All ' . $taxonomy['plural_name'],
			'parent_item' => 'Parent ' . $taxonomy['single_name'],
			'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
			'edit_item' => 'Edit ' . $taxonomy['single_name'],
			'update_item' => 'Update ' . $taxonomy['single_name'],
			'add_new_item' => 'Add New ' . $taxonomy['single_name'],
			'new_item_name' => 'New ' . $taxonomy['single_name'] . ' Name',
			'menu_name' => $taxonomy['plural_name']
		);
		
		$rewrite = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
	
		register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
			'hierarchical' => $hierarchical,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => $rewrite,
		));
	}
	
}
//add_action( 'init', 'gc_register_taxonomies' );