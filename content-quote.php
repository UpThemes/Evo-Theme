<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-content">
    	<?php the_content(); ?>
    </div><!--/.post-content-->

    <div class="post-meta">
      <div class="comments">
      	<?php comments_number(); ?>
      </div><!--/.comments-->
    </div><!--/.post-meta-->
	</article><!--/.post-->