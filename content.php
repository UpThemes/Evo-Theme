	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"><?php evo_post_thumbnail('grid'); ?></a>
    <div class="category"><?php the_category(', '); ?></div>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php the_excerpt(); ?>
    <div class="post-meta">
      <div class="tags"><?php the_tags('<span class="tag">',' </span><span class="tag"> ','</span>'); ?></div>
    </div>
	</div>