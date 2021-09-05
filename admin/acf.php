<?php
/**
 * Theme Options
 */
function ystheme_acf_init() {
	// Init options page
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => esc_html__( 'Theme Options', 'ystheme' ),
				'menu_title' => esc_html__( 'Theme Options', 'ystheme' ),
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);
	}

	// Init Google Maps
	acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'option' ) );
}
add_action( 'acf/init', 'ystheme_acf_init' );

/**
 * Add ACF Options to Admin Bar
 */
function ystheme_options_adminbar( $wp_admin_bar ) {
	if ( current_user_can( 'administrator' ) ) {
		$args = array(
			'id'    => 'theme_options',
			'title' => esc_html__( 'Theme Options', 'ystheme' ),
			'href'  => home_url() . '/wp-admin/admin.php?page=theme-general-settings',
		);
		$wp_admin_bar->add_node( $args );
	}
}
add_action( 'admin_bar_menu', 'ystheme_options_adminbar', 999 );

/**
 * ACF Local JSON - Save
 */
function ys_acf_json_save_point( $path ) {
	$path = THEME_URL . '/admin/acf-json';

	return $path;

}
add_filter( 'acf/settings/save_json', 'ys_acf_json_save_point' );

/**
 * ACF Local JSON - Load
 */
function ys_acf_json_load_point( $paths ) {
	unset( $paths[0] );

	$paths[] = THEME_URL . '/admin/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'ys_acf_json_load_point' );