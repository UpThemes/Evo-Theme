<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php
global $up_options;
get_header()

?>

	<div id="container">

		<?php while ( have_posts() ) : the_post() ?>

		<div id="content" class="single four04">
                        
			<div id="post-<?php the_ID(); ?>">

			    <h1 class="page-title"><?php _e('Sorry, Page Not Found (404)','evo'); ?></h1>

			    <p><?php _e('This page has either moved, the link is invalid, or you mistyped the URL. Sorry dude.','evo'); ?></p>

			</div><!-- .post -->

		</div><!-- #content -->

		<?php endwhile; ?>
                
        <?php evo_sidebar() ?>

	</div><!-- /#container -->

<?php get_footer() ?>