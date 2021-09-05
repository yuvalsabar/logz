<?php
add_action( 'wp_head', 'ystheme_wp_head_css' );
add_action( 'wp_head', 'ystheme_wp_head_scripts' );
add_action( 'wp_head', 'ystheme_add_preload_fonts' );
add_action( 'wp_body_open', 'ystheme_wp_body_open_scripts' );
add_action( 'admin_menu', 'ystheme_remove_menus' );
add_action( 'wp_before_admin_bar_render', 'ys_remove_comments_admin_bar' );
add_action( 'wp_footer', 'ystheme_wp_footer_scripts', 20 );

add_filter( 'render_block', 'ystheme_block_wrapper', 10, 2 );
add_filter( 'render_block', 'ystheme_render_block_by_device', 10, 2 );
add_filter( 'body_class', 'ystheme_body_class' );
add_filter( 'mce_buttons_2', 'ystheme_mce_buttons' );
add_filter( 'tiny_mce_before_init', 'ystheme_mce_text_sizes' );
add_filter( 'upload_mimes', 'ystheme_cc_mime_types' );
add_filter( 'nav_menu_css_class', 'ystheme_add_current_class_to_archive_nav_item', 10, 2 );


/**
 * Head CSS
 */
function ystheme_wp_head_css() {
	?>

	<style type="text/css">
		<?php

		if ( is_singular() ) {
			$parse_blocks = parse_blocks( get_the_content() );

			H::array_walk_recursive(
				$parse_blocks,
				function ( $value, $key ) use ( &$blocks ) {
					if ( isset( $value['id'] ) ) {
						$blocks[] = $value;
					}
				}
			);

			$resolutions = array(
				'styling',
				'styling_mobile',
			);

			foreach ( $resolutions as $resolution ) {
				if ( 'styling_mobile' === $resolution ) {
					echo "\n";
					echo "@media only screen and (max-width:992px) { \n";
				}

				if ( is_array( $blocks ) ) {
					foreach ( $blocks as $block ) {
						if ( isset( $block['id'] ) ) {
							$css = '';
							$el  = '.b-' . str_replace( 'acf/', '', $block['name'] ) . '[data-id="' . $block['id'] . '"]';

							$properties = array(
								'margin',
								'padding',
								'background-color',
								'background-image',
							);

							foreach ( $properties as $property ) {
								if ( isset( $block['data'][ $resolution . '_' . $property ] ) && ( $block['data'][ $resolution . '_' . $property ] || '0' === $block['data'][ $resolution . '_' . $property ] ) ) {
									if ( 'background-image' !== $property ) {
										$css .= $property . ':' . $block['data'][ $resolution . '_' . $property ] . ';';
									} else {
										$image_url = wp_get_attachment_url( $block['data'][ $resolution . '_' . $property ] );

										$css .= $property . ': url(' . $image_url . ');';
									}
								}
							}

							if ( $css ) {
								// phpcs:ignore
								echo $el . ' { ' . $css . ' }';
								echo "\n";
							}
						}
					}
				}

				if ( 'styling_mobile' === $resolution ) {
					echo ' }';
				}
			}
		}

		?>
	</style>

	<?php
}

/**
 * Open head scripts
 */
function ystheme_wp_head_scripts() {
	the_field( 'scripts_head', 'option' );
}

/**
 * Open body scripts
 */
function ystheme_wp_body_open_scripts() {
	the_field( 'scripts_open_body', 'option' );
}

/**
 * Remove Comments From Admin Screen
 */
function ystheme_remove_menus() {
	remove_menu_page( 'edit-comments.php' );
}

/**
 * Remove Emoji
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Remove comments from admin bar
 */
function ys_remove_comments_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}

/**
 * Footer scripts
 */
function ystheme_wp_footer_scripts() {
	the_field( 'scripts_footer', 'option' );
}

/**
 * Body Class
 */
function ystheme_body_class( $classes ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $is_edge;

	if ( is_tax() ) {
		$object = get_queried_object();

		if ( $object->parent ) {
			$classes[] = 'has_parent';
		} else {
			$classes[] = 'no_parent';
		}
	}
	if ( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif ( $is_gecko ) {
		$classes[] = 'firefox';
	} elseif ( $is_opera ) {
		$classes[] = 'opera';
	} elseif ( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif ( $is_safari ) {
		$classes[] = 'safari';
	} elseif ( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif ( $is_edge ) {
		$classes[] = 'edge';
	} elseif ( $is_IE ) {
		$classes[] = 'ie';
	} else {
		$classes[] = 'unknown';
	}

	if ( $is_iphone ) {
		$classes[] = 'iphone';
	}

	return $classes;
}

/**
 * Enable font size in the editor
 */
function ystheme_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'fontsizeselect' );
	return $buttons;
}

/**
 * Customize font sizes in the editor
 */
function ystheme_mce_text_sizes( $init_array ) {
	$init_array['fontsize_formats'] = '1rem 1.2rem 1.3rem 1.4rem 1.6rem 1.8rem 2.0rem 2.2rem 2.4rem 2.6rem 2.8rem 3.0rem 3.2rem 3.4rem 3.6rem';
	return $init_array;
}

/**
 * Allow SVG Upload
 */
function ystheme_cc_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';

	return $mimes;
}

/**
 * Add CSS class "current-menu-item" to archive nav item when on custom post type single page
 */
function ystheme_add_current_class_to_archive_nav_item( $classes = array(), $menu_item = false ) {
	if ( is_singular() ) {
		global $post;
		if ( $menu_item->url ) {
			$classes[] = ( get_post_type_archive_link( $post->post_type ) === $menu_item->url ) ? 'current-menu-item' : '';
		}
	}

	return $classes;
}

/**
 * Render block by device
 *
 * @param string $block_content The block content about to be appended.
 * @param array $block The full block, including name and attributes.
 * @return void
 */
function ystheme_render_block_by_device( $block_content, $block ) {
	$visibility = isset( $block['attrs']['data']['visibility'] ) ? $block['attrs']['data']['visibility'] : '';

	if ( ! $visibility ) {
		return $block_content;
	}

	if ( ( wp_is_mobile() && 'desktop' === $visibility ) || ! wp_is_mobile() && 'mobile' === $visibility ) {
		$block_content = '';
	}

	return $block_content;
}

/**
 * Preload fonts
 */
function ystheme_add_preload_fonts() {
	?>

	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-300.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-regular.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-600.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-700.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-800.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/montserrat/montserrat-v18-latin-900.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/mulish/mulish-v5-latin-300italic.woff" as="font" crossorigin="anonymous">
	<link rel="preload" href="<?php echo esc_attr( THEME_URI ); ?>/assets/fonts/icomoon/icomoon.ttf" as="font" crossorigin="anonymous">

	<?php
}

function ystheme_block_wrapper( $block_content, $block ) {
	if ( ! is_admin() && isset( $block['blockName'] ) && isset( $block['attrs']['id'] ) ) {
		$block_name = str_replace( 'acf/', '', $block['blockName'] );

		$atts['class'] = array(
			'block',
			'b-' . $block_name,
		);

		if ( isset( $block['className'] ) ) {
			$atts['class'][] = $block['className'];
		}

		$atts['class'] = apply_filters( 'block_class', $atts['class'], $block_name );

		$atts['id'] = isset( $block['anchor'] ) ? $block['anchor'] : null;
		$attributes = H::get_attributes( $atts );

		$content  = '<div' . $attributes . ' data-id="' . $block['attrs']['id'] . '">';
		$content .= $block_content;
		$content .= '</div>';

		return $content;
	}
}
