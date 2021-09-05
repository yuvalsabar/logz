<?php $logo_id = get_field( 'logo', 'option' ); ?>

<div class="site-logo">
	<a href="<?php echo esc_attr( home_url() ); ?>" aria-label="<?php esc_html_e( 'Logo', 'ystheme' ); ?>">
		<?php the_field( 'logo', 'option' ); ?>
	</a>
</div>
