	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php evo_post_thumbnail('full-width'); ?>
		<h1 class="entry-title"><?php the_title() ?></h1>

		<div class="post-meta before-content">
			<span class="author"><?php echo __('Posted by','evo') . " " . get_avatar( get_the_author_meta('user_email'), 24 ); ?> <?php the_author_posts_link(); ?></span> 
			<span class="category"><?php _e("in","evo"); ?> <?php the_category(', '); ?></span>
		</div>

		<div class="post-content"><?php the_content(); ?></div>

		<div class="post-meta after-content">
		  <div class="tags"><?php the_tags(__("Tags:","evo") . " ",', '); ?></div>
		</div>

		<div id="discussion">
		  <?php comments_template(); ?>
		</div>

	</div>