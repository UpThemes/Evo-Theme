<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.0
 */

get_header(); ?>

	<div id="container" class="cf">

    <div id="content">

			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'single' ); ?>

      <?php endwhile; else: ?>

      <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

    </div><!-- /#content -->

    <?php get_sidebar(); ?>

	</div><!-- /#container -->

<?php get_footer() ?>