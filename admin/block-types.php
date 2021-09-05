<?php
/**
 * Register blocks
 */
function ys_register_block( array $params ) {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$block_name = 'b-' . $params['name'];
	$block_path = '/partials/blocks/' . $block_name . '/' . $block_name;

	acf_register_block_type(
		array_merge(
			array(
				'render_template' => $block_path . '.php',
				'enqueue_style'   => THEME_URI . $block_path . '.css',
				'category'        => 'custom',
				'icon'            => 'star-filled',
				'keywords'        => array( $params['name'] ),
				'supports'        => array(
					'anchor'          => true,
					'customClassName' => true,
					'jsx'             => true,
				),
			),
			$params,
		)
	);
}

function ystheme_register_acf_block_types() {
	$blocks = array(
		array(
			'name'  => 'hero',
			'title' => esc_html__( 'Hero', 'ystheme' ),
		),
		array(
			'name'  => 'related-case-studies',
			'title' => esc_html__( 'Related Case Studies', 'ystheme' ),
		),
	);

	foreach ( $blocks as $block ) {
		ys_register_block( $block );
	}
}

/**
 * Check if function exists and hook into setup.
 */
if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'ystheme_register_acf_block_types' );
}

/**
 * Custom Blocks category
 */
function ystheme_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'custom',
				'title' => esc_html__( 'Custom Blocks', 'ystheme' ),
			),
		)
	);
}
add_filter( 'block_categories_all', 'ystheme_block_category', 10, 2 );
