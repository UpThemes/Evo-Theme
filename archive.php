<?php get_header(); ?>

  <div id="container" class="cf">

    <div id="content">

      <header class="archive-header">
        <h1 class="archive-title"><?php
          if ( is_day() ) :
            printf( __( 'Daily Archives: %s', 'evo' ), '<span>' . get_the_date() . '</span>' );
          elseif ( is_month() ) :
            printf( __( 'Monthly Archives: %s', 'evo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'evo' ) ) . '</span>' );
          elseif ( is_year() ) :
            printf( __( 'Yearly Archives: %s', 'evo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'evo' ) ) . '</span>' );
          else :
            _e( 'Archives', 'evo' );
          endif;
        ?></h1>
      </header><!-- .archive-header -->

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