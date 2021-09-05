<?php
add_action( 'wp_enqueue_scripts', 'ystheme_scripts_and_styles' );
add_action( 'wp_enqueue_scripts', 'ystheme_localize_script' );
add_action( 'admin_enqueue_scripts', 'ystheme_localize_script' );

/**
 * Enqueue Assets - Front-End And Back-End
 */
function ystheme_enqueue_assets() {
	// Assets - CSS
	wp_enqueue_style( 'bootstrap-grid', THEME_URI . '/assets/css/bootstrap-grid.css', array(), THEME_VER );
	wp_enqueue_style( 'fancybox', THEME_URI . '/assets/css/jquery.fancybox.css', array(), THEME_VER );

	// Assets - JS
	wp_enqueue_script( 'fancybox', THEME_URI . '/assets/js/jquery.fancybox.js', array(), THEME_VER, true );
	wp_enqueue_script( 'marketo', '//app-lon04.marketo.com/js/forms2/js/forms2.min.js', array(), THEME_VER, true );
}
add_action( 'wp_enqueue_scripts', 'ystheme_enqueue_assets' );
add_action( 'admin_enqueue_scripts', 'ystheme_enqueue_assets', 100 );

/**
 * Front-End Enqueue
 */
function ystheme_scripts_and_styles() {
	wp_enqueue_style( 'global', THEME_URI . '/build/css/global.min.css', array( 'bootstrap-grid' ), THEME_VER );

	wp_enqueue_script( 'scripts', THEME_URI . '/build/js/scripts.js', array( 'jquery' ), THEME_VER, true );
}

/**
 * Localize Script
 */
function ystheme_localize_script() {
	$site_object = array(
		'ajaxurl'      => admin_url( 'admin-ajax.php' ),
		'homeurl'      => get_site_url(),
		'nonce'        => wp_create_nonce(),
		'demo_form_id' => get_field( 'form_id' ),
	);

	wp_localize_script( 'scripts', 'siteObject', $site_object );
	wp_localize_script( 'admin-js', 'siteObject', $site_object );
}
