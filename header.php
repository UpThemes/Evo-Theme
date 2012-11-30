<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.4
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <div id="header">
    <div id="branding">
  		<?php if( !get_header_image() ): ?>
	    	<div id="blog-title"><span><a href="<?php echo get_site_url(); ?>" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span></div>
	      <div id="blog-description"><?php bloginfo('description'); ?></div>
	    <?php else: ?>
    	  <div id="blog-title"><a href="<?php echo get_site_url(); ?>" title="<?php bloginfo('name') ?>" rel="home"><img src="<?php echo get_header_image(); ?>" alt="<?php bloginfo('name') ?>" /></a></div>
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
    <div class="clear"></div>
  </div><!-- #header-->
  <div id="wrapper" class="hfeed">