	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"><?php evo_post_thumbnail('grid'); ?></a>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php the_content(); ?>
    <div class="post-meta">
      <div class="category"><?php the_category(', '); ?></div>
      <div class="comments"><?php comments_number(); ?></div>
    </div>
	</div>