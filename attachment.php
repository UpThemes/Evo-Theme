<?php
global $up_options;
get_header()

?>

	<div id="container">

		<?php while ( have_posts() ) : the_post() ?>

		<div id="content" class="single attachment">
                                                
			<div id="post-<?php the_ID(); ?>">

			    <h1 class="page-title"><?php the_title(); ?> <?php if(function_exists('wp_likes_render_post')) wp_likes_render_post();?></h1>

			    <div class="entry-attachment"><?php the_attachment_link($post->post_ID, true) ?></div>
<?php the_content(more_text()); ?>

					<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'evo') . '&after=</div>') ?>
				</div>

			</div><!-- .post -->            

		</div><!-- #content -->

		<div id="discussion">

			<?php evo_comments_template(); ?>
            
        </div>

		<?php endwhile; ?>
                
        <?php evo_sidebar() ?>

	</div><!-- /#container -->

<?php get_footer() ?>