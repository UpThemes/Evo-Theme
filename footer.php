    
</div><!-- #wrapper .hfeed -->

<?php evo_abovefooter(); ?>    
	<div id="footer">
        <?php get_sidebar('subsidiary'); ?>
        <div id="siteinfo">
              
	        <?php
			wp_nav_menu(array(
				'theme_location' => 'footer_nav',
				'container' => false
			));
			?>
			
			<span><?php /* footer text set in theme options */ echo do_shortcode(__(stripslashes(evo_footertext($thm_footertext)), 'evo')); ?></span>
            
		</div><!-- #siteinfo -->
	</div><!-- #footer -->
	
<?php evo_belowfooter(); ?>  


<?php wp_footer(); ?>

<?php evo_after(); ?>
</body>
</html>