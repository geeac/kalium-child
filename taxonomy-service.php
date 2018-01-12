<?php
/**
 *	Kalium WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

get_header();

get_template_part( 'tpls/portfolio-listing' );

wp_nav_menu( array( 'menu' => 'Services Menu', 'container_class' => 'container widget fl-widget' ) );

get_footer();