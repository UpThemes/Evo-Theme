<?php get_header(); ?>

  <div id="container" class="cf">

    <div id="content">

      <div id="masonry">

  			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', get_post_format() ); ?>

        <?php endwhile; else: ?>

        <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

      </div><!-- /#masonry -->

    </div><!-- /#content -->

    <?php evo_navigation_below(); ?>

	</div><!-- /#container -->

<?php get_footer() ?>