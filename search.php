<?php

global $up_options,$wpdb,$wp_query;

get_header();

?>

	<div id="container">
	
        <div id="content">
        
            <?php evo_navigation_above();?>
                        
            <?php evo_above_searchloop() ?>
                        
			<?php if( have_posts()): ?>

            	<div class="list">
	
	            	<?php query_posts($query_string . '&posts_per_page=-1'); ?>

                    <h2>
                    <?php
                    echo __("Search Results for",'evo') . " '" . $_REQUEST['s'] . "' ";
                    ?>
					</h2>
					
					<div class="items">
					
                      <?php
                      $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
                      while ( have_posts() ) :
                      
                      	the_post();
						$width = get_option('medium_size_w');
						
					  ?>
                                <div id="post-<?php the_ID() ?>" class="<?php evo_post_class(); ?>">
                                        
                                    <a href="<?php the_permalink(); ?>">
                                    <?php
                                                                        
                                    if ( has_post_thumbnail() )
                                        the_post_thumbnail('medium');
                                    else
                                    	echo "<img style='-ms-interpolation-mode: bicubic;' width='" . $width . "' height='" . $width . "' src='" . get_bloginfo('stylesheet_directory') . "/images/placeholder.png' alt='" . get_the_title() . "' />";
                                    ?>
                                    </a>
                                    
                                    <?php if($up_options->show_title == true): ?>
                                        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
                                    <?php endif; ?>
                                    <?php if($up_options->show_excerpt == true): ?>
                                    <?php the_excerpt() ?>
                                    <?php endif; ?>
                
                                </div><!-- .post -->
                    
                        <?php
                    
                        if ($count==$up_options->insert_position) {
                          get_sidebar('search-insert');
                        }
                        $count = $count + 1;
						
                      endwhile; ?>

              		</div>
                
                </div>
                
            <?php else: ?>
                
                	<h1><?php _e('No Results Found','evo'); ?></h1>
                	
                	<?php _e('Please try your search again.','evo'); ?>
                	
                	<?php echo get_search_form(); ?>
                
            <?php endif;?>
                
        	<div class="list"></div>
                
        	<?php evo_below_searchloop() ?>
            
        </div><!-- /#content -->

		<div class="clear"></div>
        
	</div><!-- /#container -->

<?php evo_sidebar() ?>

	<div class="clear"></div>

<?php get_footer() ?>