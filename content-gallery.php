<?php
/**
 * The template for displaying gallery content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"><?php evo_post_thumbnail('grid'); ?></a>

    <?php the_content(); ?>

    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <div class="post-meta">
      <div class="category"><?php the_category(', '); ?></div>
      <div class="comments"><a href="<?php the_permalink(); ?>#comments"><?php comments_number(); ?></a></div>
    </div><!--/.post-meta-->
	</article><!--/.post-->