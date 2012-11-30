	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php evo_post_thumbnail('full-width'); ?>
		<h1 class="page-title"><?php the_title() ?>/h1>

		<div class="post-content"><?php the_content(); ?></div>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>

		<div id="discussion">
		  <?php comments_template(); ?>
		</div>

	</div>