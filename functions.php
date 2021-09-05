<?php
/**
 * Theme functions and definitions.
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Defines
 */
define( 'THEME_URI', get_template_directory_uri() );    // <url>/wp-content/themes/starter
define( 'THEME_URL', get_template_directory() );        // /home/starter/public_html/wp-content/themes/starter
define( 'THEME_VER', wp_get_theme()->get( 'Version' ) );

/**
 * Includes
 */
get_template_part( 'classes/class', 'h' );                      // Helper class
get_template_part( 'admin/post-types' );                        // Post Types
get_template_part( 'admin/block-types' );                       // Block Types
get_template_part( 'admin/enqueue' );                           // Enqueue
get_template_part( 'admin/hooks' );                             // Hooks
get_template_part( 'admin/menus' );                             // Menus
get_template_part( 'admin/image-sizes' );                       // Image Sizes
get_template_part( 'admin/acf' );                               // ACF Related
get_template_part( 'classes/class', 'mobile-menu-walker' );     // Mobile Menu Walker
