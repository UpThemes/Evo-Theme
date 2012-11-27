<?php get_header(); ?>

  <div id="container" class="cf">

    <h1 class="tag-title"><?php _e("Tag Archive:","evo"); ?> <?php single_tag_title(); ?></h1>

    <div id="content">

			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', get_post_format() ); ?>

      <?php endwhile; else: ?>

      <?php get_template_part( 'content', 'none' ); ?>

      <?php endif; ?>

    </div><!-- /#content -->

    <?php evo_navigation_below(); ?>

	</div><!-- /#container -->

<?php get_footer() ?>