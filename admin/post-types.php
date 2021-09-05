<?php
/**
 * Register post types:
 * case_study
 */
function register_post_types() {

	// Case Study post type
	register_post_type(
		'case_study',
		$args = array(
			'label'               => esc_html__( 'Case Study', 'ystheme' ),
			'description'         => esc_html__( 'Case Study', 'ystheme' ),
			'labels'              => array(
				'name'           => esc_html__( 'Case Studies', 'ystheme' ),
				'singular_name'  => esc_html__( 'Case Study', 'ystheme' ),
				'menu_name'      => esc_html__( 'Case Studies', 'ystheme' ),
				'name_admin_bar' => esc_html__( 'Case Study', 'ystheme' ),
			),
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'        => true,
			'capability_type'     => 'page',
			'menu_icon'           => 'dashicons-welcome-learn-more',
		)
	);
}
add_action( 'init', 'register_post_types', 0 );

