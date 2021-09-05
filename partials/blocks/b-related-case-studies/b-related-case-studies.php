<?php
$related = H::get_related_case_studies();

$args = array(
	'post_type'      => 'case_study',
	'posts_per_page' => 20,
	'post__in'       => $related,
	'orderby'        => 'post__in',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
	?>

	<div class="container">
		<div class="row row-title">
			<div class="col-12">
				<?php H::render_text( get_field( 'title' ), '<h2 class="b-related-case-studies__title">', '</h2>' ); ?>
			</div>
		</div>
	</div>

	<div class="case-studies__wrap">
		<div class="container">
			<div class="row row-case-studies">
				<?php
				while ( $query->have_posts() ) {
					$query->the_post();

					get_template_part( 'partials/loops/loop', 'related-case-study' );
				}

				wp_reset_postdata();
				?>
			</div>

			<div class="row row-back">
				<div class="col-12">
					<a class="back__link" href="<?php echo esc_attr( get_post_type_archive_link( 'case_study' ) ); ?>">
						<span class="back__link-text">
							<?php esc_html_e( 'Back to Case Studies', 'ystheme' ); ?>
						</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php
endif;
