<?php
global $up_options;
get_header()

?>

	<div id="container">

		<?php while ( have_posts() ) : the_post() ?>

		<div id="content" class="single page entry">
		            
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
              
              
			    <h1><?php the_title(); ?> <?php if(function_exists('wp_likes_render_post')) wp_likes_render_post();?></h1>
			    
			    <?php the_content(); ?>

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
