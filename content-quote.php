	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
    <div class="post-meta">
      <div class="comments"><?php comments_number(); ?></div>
    </div>
	</div>