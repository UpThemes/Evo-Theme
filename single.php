<?php
global $up_options;
get_header()

?>

	<div id="container">

		<?php while ( have_posts() ) : the_post() ?>

		<div id="content" class="single post entry">
            
            <?php evo_navigation_above();?>
            
            <?php get_sidebar('single-top') ?>
                        
			<div id="post-<?php the_ID(); ?>" <?php if(function_exists('p75HasVideo')) { if(p75HasVideo($post->ID)){ echo 'class="video"'; } } ?>>

								<?php
								if(function_exists('p75HasVideo')){
									if(p75HasVideo($post->ID)){
										echo p75GetVideo($post->ID);
										$p75 = true;
									}
								}
								
								if(!$p75){
									if(get_post_meta($post->ID, 'full-image', true)){ 
										$imgsrc = get_post_meta($post->ID, 'full-image', true);
										
										if($imgsrc){
											
											echo '<img src="' . $imgsrc . '" alt="' . $imgalt . '" class="medium" />';
											
										}elseif(checkimage()){ 
										
											postimages('original'); 
											
										}else{
											
											echo '<img src="' . get_bloginfo('template_directory') . '/images/full-image-default.jpg" alt=""/>';
										}
										
									}elseif(checkimage()) { 
										
										postimages('original'); 
										
									}elseif(!checkimage()){
										echo '<img src="' . get_bloginfo('template_directory') . '/images/full-image-default.jpg" alt=""/>';
									}
								}

?>

			    <h1 class="page-title"><?php the_title(); ?> <?php if(function_exists('wp_likes_render_post')) wp_likes_render_post();?></h1>

			    <?php if( $up_options->show_single_author == true ): ?>
			    	<div class="author"><?php echo __('Posted by','evo') . " " . get_avatar( get_the_author_meta('user_email'), 24 ); ?> <?php the_author_posts_link(); ?></div>
			    <?php endif; ?>

			    <?php if( $up_options->show_single_content == true ): ?>
			    	<div class="post-content"><?php the_content(); ?></div>
			    <?php endif; ?>

				<div class="pre_meta">

				    <?php if( $up_options->show_single_category == true ): ?>
				    	<div class="category"><?php the_category(' '); ?></div>
				    <?php endif; ?>
	              
				    <?php if( $up_options->show_single_tags == true ): ?>
				    	<div class="tags"><?php the_tags('<span class="tag">',' </span><span class="tag"> ','</span>'); ?></div>
				    <?php endif; ?>

				</div>

			</div><!-- .post -->

			
			<?php get_sidebar('single-insert') ?>
            
            <?php evo_navigation_below();?>

		</div><!-- #content -->

		<div id="discussion">

			<?php evo_comments_template(); ?>
            
        </div>

		<?php endwhile; ?>
        
        <?php get_sidebar('single-bottom') ?>
        
        <?php evo_sidebar() ?>

	</div><!-- /#container -->

<?php get_footer() ?>
