  </div><!-- #wrapper .hfeed -->

  <div id="footer">
    <?php get_sidebar('subsidiary'); ?>
  
    <div id="siteinfo">
  
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer_nav',
        'container' => false
      ));
      ?>
  
      <span><?php _e('Copyright 2012 Evo Theme. All Rights Reserved.','evo'); ?></span>
            
  	</div><!-- #siteinfo -->
  </div><!-- #footer -->
	
<?php wp_footer(); ?>

</body>
</html>