<div class="col-lg-3 col-md-4">
	<div <?php post_class(); ?> id="post-<?php echo $post->ID; ?>">
		<?php H::render_edit_post(); ?>

		<a href="<?php the_permalink(); ?>">
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</div>

			<footer class="entry-footer" data-mh="entry-footer">
				<h4 class="entry-title">
					<?php the_title(); ?>
				</h4>
				<p class="entry-excerpt">
					<?php H::the_excerpt( 13 ); ?>
				</p>
			</footer>
		</a>
	</div>
</div>

