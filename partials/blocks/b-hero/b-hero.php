<?php
$video_link = get_field( 'btn_watch_video' );
$demo_link  = get_field( 'btn_request_demo' );
?>

<div class="container">
	<div class="b-hero__in">
		<div class="b-hero__content">
			<?php H::render_text( get_field( 'title' ), '<h1 class="b-hero__title">', '</h1>' ); ?>

			<div class="testimonial">
				<?php H::render_text( get_field( 'testimonial_text' ), '<blockquote class="testimonial__text">', '</blockquote>' ); ?>

				<div class="testimonial__author">
					<div class="testimonial__company">
						<?php H::render_image( get_field( 'testimonial_logo' ), 'testmonial__company-logo' ); ?>
					</div>

					<div class="testimonial__meta">
						<?php
						H::render_text( get_field( 'testimonial_name' ), '<span class="testimonial__name">', '</span>' );
						H::render_text( get_field( 'testimonial_position' ), '<span class="testimonial__position">', '</span>' );
						?>
					</div>
				</div>
			</div>

			<div class="b-hero__buttons">
				<?php if ( ! empty( $video_link ) ) : ?>
					<a href="<?php echo esc_attr( $video_link['url'] ); ?>" class="btn btn--white btn--video" data-fancybox>
						<span class="btn__text">
							<?php echo esc_html( $video_link['title'] ); ?>
						</span>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $demo_link ) ) : ?>
					<a href="#" class="btn btn--white-border btn--demo" data-fancybox data-src="<?php echo esc_attr( $demo_link['url'] ); ?>">
						<span class="btn__text">
							<?php echo esc_html( $demo_link['title'] ); ?>
						</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
