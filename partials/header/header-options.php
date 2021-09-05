<?php
$get_started_link  = get_field( 'get_started_link', 'option' );
$request_demo_link = get_field( 'request_demo_link', 'option' );
$login_link        = get_field( 'login_link', 'option' );
?>

<div class="header-options">
	<?php H::render_link( $get_started_link, 'btn btn--white btn--get-started' ); ?>

	<?php if ( ! empty( $request_demo_link ) ) : ?>
		<a href="#" class="btn btn--white btn--request-demo" data-fancybox data-src="<?php echo esc_attr( $request_demo_link['url'] ); ?>">
			<span class="btn__text">
				<?php echo esc_html( $request_demo_link['title'] ); ?>
			</span>
		</a>
	<?php endif; ?>

	<?php H::render_link( $login_link, 'login-link' ); ?>
</div>
