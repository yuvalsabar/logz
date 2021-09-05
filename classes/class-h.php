<?php
/**
 * Helpers for this theme
 */

class H {
		/**
	 * Render text field
	 *
	 * @param string $text
	 * @param string $wrapper_start
	 * @param string $wrapper_end
	 * @return void
	 */
	public static function render_text( $text, $wrapper_start, $wrapper_end ) {
		if ( $text ) {
			echo wp_kses_post( $wrapper_start . $text . $wrapper_end );
		}
	}

	/**
	 * Print ACF Link
	 *
	 * @param array  $field
	 * @param string $button_class
	 * @param string $icon_class
	 * @param boolean $icon_before_text
	 * @return HTML of button
	 */
	public static function render_link( $link, $class = 'c-link' ) {
		if ( ! empty( $link ) ) {
			self::render_link_start( $link, $class );
			echo '<span class="btn__text">' . esc_html( $link['title'] ) . '</span>';
			self::render_link_end( $link );
		}
	}

	/**
	 * Render link start
	 *
	 * @param array  $link field
	 * @param string $class
	 */
	public static function render_link_start( $link, $class = 'c-link' ) {
		if ( ! empty( $link ) ) {
			$target = $link['target'] ? ' target="_blank"' : '';
			$rel    = $link['target'] ? ' rel="noopener"' : '';

			$explode = explode( ':', $link['url'] );
			$action  = str_replace( '//', '', $explode[0] );

			if ( isset( $explode[1] ) ) {
				$data = $explode[1];

			}

			switch ( $action ) {
				case 'js':
					// Usage: //js:myFunction(event)
					echo '<a href="#" rel="nofollow" class="' . esc_attr( $class ) . '" onclick="' . wp_kses_post( $data ) . '">';
					break;

				case 'fancybox':
						// Usage: //fancybox:<url>
						echo '<a href="' . esc_url( $data ) . '" class="' . esc_attr( $class ) . '" rel="nofollow" data-fancybox>';
					break;

				default:
					echo '<a href="' . esc_url( $link['url'] ) . '" class="' . esc_attr( $class ) . '"' . wp_kses_post( $target ) . wp_kses_post( $rel ) . '>';
					break;
			}
		}
	}

	/**
	 * Render link end
	 */
	public static function render_link_end( $link ) {
		if ( ! empty( $link ) ) {
			echo '</a>';
		}
	}

	/**
	 * ACF Image
	 *
	 * @param int $image_id
	 * @param string $class Container class
	 * @param string $size Image size
	 */
	public static function render_image( $image_id, $size = 'full', $class = '' ) {
		if ( $image_id ) {
			if ( ! $class ) {
				$class = 'c-image';
			} else {
				$class = 'c-image ' . $class;
			}
			?>

			<figure class="<?php echo esc_attr( $class ); ?>">
				<?php echo wp_get_attachment_image( $image_id, $size ); ?>
			</figure>

			<?php
		}
	}

	/**
	 * Expanded get_field function
	 *
	 * @param string $field_id ACF field id.
	 * @return ACF field
	 */
	public static function get_field( $field_id ) {
		$object = get_queried_object();

		if ( get_field( $field_id ) ) {
			$field = get_field( $field_id );
		} elseif ( get_field( $field_id, get_the_ID() ) ) {
			$field = get_field( $field_id, get_the_ID() );
		} elseif ( get_sub_field( $field_id ) ) {
			$field = get_sub_field( $field_id );
		} elseif ( ( is_tax() || is_category() ) && get_field( $field_id, $object ) ) {
			$field = get_field( $field_id, $object );
		} else {
			$field = get_field( $field_id, 'option' );
		}

		return $field;
	}

	/**
	 * Recursive walk through array
	 *
	 * @param array $array
	 * @param $callback
	 * @return void
	 */
	public static function array_walk_recursive( $array, $callback ) {
		if ( ! is_array( $array ) ) {
			return;
		}

		foreach ( $array as $key => $value ) {
			$callback( $value, $key );
			self::array_walk_recursive( $value, $callback );
		}
	}

	/**
	 * Get attributes
	 * @param  array $styles key\value array of styles
	 * @return string of html attribute
	 */
	public static function get_attributes( $atts ) {
		$attributes = '';

		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$attributes .= ' ' . $attr . '="' . $value . '"';
			} elseif ( is_array( $value ) ) {
				$attributes .= ' ' . $attr . '="' . join( ' ', $value ) . '"';
			}
		}

		return $attributes;
	}

	public static function get_related_case_studies() {
		$current_post   = get_queried_object();
		$ids            = get_field( 'case_studies' ) ? get_field( 'case_studies' ) : array();
		$posts_per_page = 3;
		$posts__not_in  = array( $current_post->ID );

		if ( 1 === count( $ids ) ) {
			$posts_per_page = 2;
			$posts__not_in  = array( $current_post->ID, $ids[0] );
		} elseif ( 2 === count( $ids ) ) {
			$posts_per_page = 1;
			$posts__not_in  = array( $current_post->ID, $ids[0], $ids[1] );
		}

		$add_ids = get_posts(
			array(
				'post_type'      => 'case_study',
				'orderby'        => 'rand',
				'posts_per_page' => $posts_per_page,
				'post__not_in'   => $posts__not_in,
				'fields'         => 'ids',
			)
		);

		$ids = array_merge( $ids, $add_ids );

		return $ids;
	}
}
