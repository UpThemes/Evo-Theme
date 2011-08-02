<?php

global $up_options;

get_header();

$authorID = $_REQUEST['author'];

?>

	<div id="container">
	
        <div id="content">
        
            <?php evo_navigation_above();?>
            
            <?php get_sidebar('index-top') ?>
            
            <?php evo_above_indexloop() ?>
            
            	<div class="list">

					<?php 
					global $wpdb,$wp_query;
					if(is_category()):
						$catID = get_query_var('cat');
						$post_count = (int) get_category($catID)->count;
					elseif(is_archive()):
						$post_count = get_the_author_posts( $authorID );				
					elseif(is_tag()):
						$counter=0;
						while( has_posts() ):
							$counter++;
						endwhile;
						$post_count = $counter;				
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
                    
                    
                    <h2>
                    <?php
                    if(is_author()):
                    	echo __('Posts by','evo') . " ";
						echo get_avatar( get_the_author_meta('user_email',$authorID), 24 ) . ' ';
						echo '<a href="' . get_the_author_meta('user_url',$authorID) . '">' . get_the_author_meta('nickname',$authorID) . '</a>';
                   	endif;
                    ?>
                    <span class="pagination">
                    <?php
                    $pagination = __('Showing %1$s - %2$s of %3$s','evo');
					printf($pagination, $starting_post, $ending_post, $post_count); ?>
					</span>
					</h2>
                    
					<div class="items">

					<?php
                                            
                      $count = 1; /* Count the number of posts so we can insert a widgetized area */ 
                      
                      while ( have_posts() ) : the_post() ?>
                    
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
                    
                        <?php comments_template();
                    
                        if ($count==$up_options->insert_position) {
                          get_sidebar('index-insert');
                        }
                        $count = $count + 1;
						
                      endwhile; ?>


              		</div>

	            	<?php evo_navigation_below(); ?>
                
                </div>
                
                <div class="list"></div>
                
            <?php evo_below_indexloop() ?>
            
            <?php get_sidebar('index-bottom') ?>        

        </div><!-- /#content -->

		<div class="clear"></div>
        
	</div><!-- /#container -->

<?php evo_sidebar() ?>

	<div class="clear"></div>

<?php get_footer() ?>