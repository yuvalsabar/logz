<?php
/**
 * Register Menus
 */
function ystheme_register_menus() {
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Main Menu', 'ystheme' ),
		)
	);
}
add_action( 'init', 'ystheme_register_menus' );
