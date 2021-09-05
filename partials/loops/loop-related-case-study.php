<div class="col-md-4">
	<a <?php post_class( 'case-study' ); ?> href="<?php the_permalink(); ?>">
		<div class="case-study__logo">
			<?php the_post_thumbnail(); ?>
		</div>
		<h3 class="case-study__title">
			<?php the_title(); ?>
		</h3>
		<div class="case-study__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<div class="case-study__link">
			<span class="case-study__read">
				<span class="case-study__read-text">
					<?php esc_html_e( 'Read', 'ystheme' ); ?>
				</span>
			</span>
		</div>
	</a>
</div>
