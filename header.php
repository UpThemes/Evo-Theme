<?php global $up_options; evo_create_doctype(); echo " "; language_attributes(); echo ">\n";?>
<head profile="http://gmpg.org/xfn/11">

<?php 

evo_doctitle();
evo_create_contenttype();
evo_show_description();
evo_show_robots();
evo_canonical_url();
evo_create_stylesheet();
evo_show_pingback();
evo_show_commentreply();

wp_head(); ?>

</head>

<body class="<?php evo_body_class() ?>">

<script>
document.body.className += " js-loaded";
</script>

<?php evo_before(); ?>

<?php evo_aboveheader(); ?>   

    <div id="header" class="clearfix">
        <div id="branding">
		
			<?php if(!$up_options->logo): ?>
        
        		<?php if(is_front_page()): ?>
		    		<h1 id="blog-title"><span><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span></h1>
                <?php else: ?>
		    		<div id="blog-title"><span><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span></div>                
                <?php endif; ?>
                    
			<?php else: ?>
        
		    	<div id="blog-title"><a href="<?php bloginfo('wpurl') ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo $up_options->logo; ?>" alt="<?php bloginfo('name') ?>" /></a></div>
                    
			<?php endif; ?>
			
		</div><!-- /#branding -->
		
		<div id="access">
        
	        <?php
			wp_nav_menu(array(
				'theme_location' => 'primary_nav',
				'menu_class' => 'sf-menu',
				'container' => false,
				'fallback_cb' => 'wp_page_menu_mod'
			));
			?>
	
	    </div><!-- #access -->
        
        <?php echo get_search_form(); ?>
		
        <div class="clear"></div>
        
    </div><!-- #header-->

<?php evo_belowheader(); ?>   

<div id="wrapper" class="hfeed">    