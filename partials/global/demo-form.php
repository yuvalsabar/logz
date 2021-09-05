<?php
$form_id = get_field( 'form_id' );

if ( $form_id ) : ?>

	<div class="popup-form popup-demo-form c-form" id="popup-demo-form">
		<h3 class="popup-demo-form__title">
			<?php the_field( 'demo_form_title' ); ?>
		</h3>

		<div class="popup-demo-form__form">
			<form id="mktoForm_<?php echo esc_attr( $form_id ); ?>"></form>
		</div>

		<footer class="popup-demo-form__footer">
			<?php the_field( 'demo_form_footer' ); ?>
		</footer>

		<div class="form-sent">
			<?php the_field( 'demo_form_success_message' ); ?>
		</div>
	</div>

	<?php
endif;
