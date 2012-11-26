<?php get_header(); ?>

	<div id="container">

    <div id="content">

    	<div class="list">

  			<?php 
  			global $wpdb,$wp_query;
  			if( is_category() ):
  				$catID = get_query_var('cat');
  				$post_count = (int) get_category($catID)->count;
  			elseif( is_tag() || is_archive() ):
  				$counter=0;
  				while( have_posts() ):
  					the_post();
  					$counter++;
  				endwhile;
  				$post_count = $counter;				
  			elseif( is_author() ):
  				$post_count = get_the_author_posts( $authorID );
  			elseif( is_search() ):
  			  $post_count = $wp_query->post_count;				
  			elseif(is_home() || is_front_page()):
  				$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type ='post'");
  				if (0 < $post_count)
  					$post_count = (int)$post_count; 

  			endif;
  
  			$page = get_query_var('paged');
  			$posts_per_page = get_option('posts_per_page');
  
  			if($page == 0):
  				$starting_post = 1;
  				$ending_post = (int)$posts_per_page;
  			else:
  				$starting_post = (int)(($page-1) * $posts_per_page);
  				$ending_post = (int)((($page-1) * $posts_per_page) + $posts_per_page);
  			endif;
  
  			if($ending_post > $post_count)
  				$ending_post = $post_count;
  
  			?>                   
  
        <h2><?php
        if( is_category() ):
        	echo single_cat_title() . " ";               
        elseif( is_tag() ):
        	echo single_tag_title() . " ";     
        elseif( is_search() ):
          echo sprintf( __("Search Results for: %s","evo"), get_search_query() );
       	endif;
        ?>
        <span class="pagination"><?php
        $pagination = __('Showing %1$s - %2$s of %3$s','evo');
  			printf($pagination, $starting_post, $ending_post, $post_count); ?></span></h2>

				<div class="items">

  				<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
  
          <?php get_template_part( 'content', get_post_format() ); ?>
  
          <?php endwhile; else: ?>
  
          <?php get_template_part( 'content', 'none' ); ?>
  
          <?php endif; ?>

     		</div>

        <div class="clear"></div>

        <?php evo_navigation_below(); ?>

      </div>

      <div class="list"></div>

    </div><!-- /#content -->

	</div><!-- /#container -->

  <?php get_sidebar() ?>

<?php get_footer() ?>