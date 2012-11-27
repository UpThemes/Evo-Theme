	<div id="post-<?php the_ID() ?>" <?php post_class(); ?>>
	
    <?php if( !is_single() ): ?>
      <a href="<?php the_permalink(); ?>"><?php evo_post_thumbnail('grid'); ?></a>
      <div class="category"><?php the_category(' '); ?></div>
      <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
    <?php else: ?>
      <?php evo_post_thumbnail('full-width'); ?>
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
    <?php endif; ?>

    <?php if( !is_single() ): ?>

      <?php the_excerpt(); ?>

      <div class="post-meta">
        <div class="tags"><?php the_tags('<span class="tag">',' </span><span class="tag"> ','</span>'); ?></div>
      </div>

    <?php else: ?>

    	<div class="author"><?php echo __('Posted by','evo') . " " . get_avatar( get_the_author_meta('user_email'), 24 ); ?> <?php the_author_posts_link(); ?></div>
    	<div class="post-content"><?php the_content(); ?></div>

      <div class="post-meta">
        <div class="category"><?php _e("Posted in:","evo"); ?> <?php the_category(' '); ?></div>
        <div class="tags"><?php the_tags('<span class="tag">',' </span><span class="tag"> ','</span>'); ?></div>
      </div>

      <div id="discussion">
        <?php comments_template(); ?>
      </div>

    <?php endif; ?>

	</div>