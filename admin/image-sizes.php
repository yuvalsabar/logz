<?php
/**
 * Post Thumbnail Support
 */
function ystheme_theme_support() {
	// Add text domain
	load_theme_textdomain( 'ystheme', THEME_URL . '/languages' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes
	add_image_size( 'small', 200, 200, false );
}
add_action( 'after_setup_theme', 'ystheme_theme_support' );