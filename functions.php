<?php

function rssfeed(){ ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> &raquo; <?php _e('Feed','evo'); ?>" href="<?php rss(); ?>" />
<?php
}

add_theme_support( 'post-thumbnails' );
add_theme_support( 'nav-menus' );

if(function_exists('register_nav_menu')):

	register_nav_menu( 'primary_nav' , 'Primary Navigation' );
	register_nav_menu( 'footer_nav' , 'Footer Navigation' );

endif;

add_action('wp_head','rssfeed',1);

// Getting Theme and Child Theme Data
// Credits: Joern Kretzschmar

$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$version = trim($themeData['Version']);
if(!$version)
    $version = "unknown";

// set theme constants
define('THEMENAME', $themeData['Title']);
define('THEMEAUTHOR', $themeData['Author']);
define('THEMEURI', $themeData['URI']);
define('THEMATICVERSION', $version);

// Path constants
define('THEMELIB', TEMPLATEPATH . '/library');

function wp_page_menu_mod(){
	
	$menu = wp_list_pages( array('echo' => 0, 'title_li' => false ) );
	
	echo '<ul class="sf-menu">'.$menu.'</ul>';
	
}

// Load widgets
require_once(THEMELIB . '/extensions/widgets.php');

// Load custom header extensions
require_once(THEMELIB . '/extensions/header-extensions.php');

// Load custom content filters
require_once(THEMELIB . '/extensions/content-extensions.php');

// Load custom Comments filters
require_once(THEMELIB . '/extensions/comments-extensions.php');

// Load custom Widgets
require_once(THEMELIB . '/extensions/widgets-extensions.php');

// Load the Comments Template functions and callbacks
require_once(THEMELIB . '/extensions/discussion.php');

// Load custom sidebar hooks
require_once(THEMELIB . '/extensions/sidebar-extensions.php');

// Load custom footer hooks
require_once(THEMELIB . '/extensions/footer-extensions.php');

// Add Dynamic Contextual Semantic Classes
require_once(THEMELIB . '/extensions/dynamic-classes.php');

// Need a little help from our helper functions
require_once(THEMELIB . '/extensions/helpers.php');

// Load shortcodes
require_once(THEMELIB . '/extensions/shortcodes.php');

// Adds filters for the description/meta content in archives.php
add_filter( 'archive_meta', 'wptexturize' );
add_filter( 'archive_meta', 'convert_smilies' );
add_filter( 'archive_meta', 'convert_chars' );
add_filter( 'archive_meta', 'wpautop' );

// Remove the WordPress Generator – via http://blog.ftwr.co.uk/archives/2007/10/06/improving-the-wordpress-generator/
function evo_remove_generators() { return ''; }  
add_filter('the_generator','evo_remove_generators');

// Translate, if applicable
load_theme_textdomain('evo', THEMELIB . '/languages');
$locale = get_locale();
$locale_file = THEMELIB . "/languages/$locale.php";
if (is_readable($locale_file)) require_once($locale_file);

function rss_post_thumbnail($content) {
	
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = get_the_post_thumbnail($post->ID,'large') . "<br/>" . $content;
	}
	return $content;
	
}

add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');

// Enqueue Scripts
function add_scripts(){
	
	global $up_options;
			
	if(!is_admin()):
				
		wp_enqueue_script('superfish',
			get_bloginfo('stylesheet_directory') . '/library/scripts/superfish.js',
			array('jquery'),
			false );

		wp_enqueue_script('masonry',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.masonry.js',
			array('jquery'),
			false );
		
		wp_enqueue_script('jquery.onImagesLoad',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.onImagesLoad.js',
			array('jquery','masonry','global'),
			false );

		wp_enqueue_script('jquery.jflow',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.flow.js',
			array('jquery'),
			false );

		wp_enqueue_script('jquery.scrollTo',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.scrollTo.js',
			array('jquery','masonry'),
			false );

		wp_enqueue_script('supersubs',
			get_bloginfo('stylesheet_directory') . '/library/scripts/supersubs.js',
			array('jquery','superfish'),
			false );

		wp_enqueue_script('hoverIntent',
			get_bloginfo('stylesheet_directory') . '/library/scripts/hoverIntent.js',
			array('jquery','superfish','supersubs'),
			false );

		wp_enqueue_script('evo-dropdowns',
			get_bloginfo('stylesheet_directory') . '/library/scripts/evo-dropdowns.js',
			array('jquery','superfish','supersubs','hoverIntent'),
			false );

		wp_enqueue_script('jquery.metadata',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.metadata.js',
			array('jquery'),
			false );
	
		wp_enqueue_script('jquery.form',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.form.js',
			array('jquery','jquery.metadata'),
			false );

		wp_enqueue_script('jquery.validate',
			get_bloginfo('stylesheet_directory') . '/library/scripts/jquery.validate.pack.js',
			array('jquery','jquery.metadata','jquery.form'),
			false );

		wp_enqueue_script('global',
			get_bloginfo('stylesheet_directory') . '/library/scripts/global.js',
			array('jquery','masonry','jquery.scrollTo'),
			false );
		
	endif;
 
	if(isset($_REQUEST['style'])):
		$theme_color = $_REQUEST['style'];
		setcookie('style',$theme_color);
	endif;

}

add_action('init','add_scripts');

// Enqueue Styles
function add_styles(){
  
  if( !is_admin() ){
    global $up_options;

  	$stylesheet_dir = get_bloginfo('template_directory');
	
	if( $up_options->style ):
	    $theme_color = $up_options->style;
		$myStyleUrl =  $stylesheet_dir . "/style-" . $theme_color . ".css";
		wp_enqueue_style('gallery', $myStyleUrl, array(), false, 'screen');
	endif;
    
  }
  
}

add_action('wp_print_styles','add_styles');

function slideshow(){

	if( is_single() ):
	
		echo '<script>
		if(jQuery("#mySlides img").length > 1 && jQuery("#myController").length >= 1){
			jQuery("#myController").jFlow({
				slides: "#mySlides",
				duration: 400
			});
		}
		</script>';
	
	endif;
	
}

add_action('wp_footer','slideshow');

function custom_fonts(){
	global $up_options;

	$custom_fonts = '<style type="text/css">';

	if($up_options->primary_font):

		$primaryFont = (int) $up_options->primary_font;
		
		switch($primaryFont):

			default:
				$primaryFontStack = 'Helvetica, Arial, Tahoma, Verdana, sans-serif';
				break;
			case 1:
				$primaryFontStack = 'Franchise, Helvetica, Arial, Tahoma, sans-serif';
				$primaryFontFace 	= 'franchise';
				break;
			case 2:
				$primaryFontStack = '"Winterthur Condensed Regular", Helvetica, Arial, Tahoma, sans-serif';
				$primaryFontFace 	= 'winterthur-condensed';
				break;
			case 3:
				$primaryFontStack = '"Yanone Kaffeesatz Regular", Helvetica, Arial, Tahoma, sans-serif';
				$primaryFontFace 	= 'yanone-kaffeesatz';
				break;
			case 4:
				$primaryFontStack = '"Bebas Neue", Helvetica, Arial, Tahoma, sans-serif';
				$primaryFontFace 	= 'bebas-neue';
				break;
			case 5:
				$primaryFontStack = 'Helvetica, Arial, Tahoma, Verdana, sans-serif';
				break;
			case 6:
				$primaryFontStack = 'Garamond, Avant Garde, Palatino, "Times New Roman", serif';
				break;
				
		endswitch;
		
		if($primaryFontFace)
			echo "<link href='" . get_bloginfo('template_directory') . "/library/fonts/" . $primaryFontFace . "/stylesheet.css' rel='stylesheet' type='text/css' />";

		$custom_fonts .= "
			#content h1,
			#content h2,
			#content h3,
			#content h4,
			#content h5,
			#content h6, 
			#discussion h1,
			#discussion h2,
			#discussion h3,
			#discussion h4,
			#discussion h5,
			#discussion h6,
			#header,
			#header input,
			#header button,
			#footer,
			.said,
			.time,
			.comment-reply-link,
			#more a,
			legend,
			label{ 
				font-family: {$primaryFontStack};
				text-transform: uppercase;
			}";

	endif;

	if($up_options->secondary_font):

		$secondaryFont = (int) $up_options->secondary_font;
		
		switch($secondaryFont):

			default:
				$secondaryFontStack = 'Helvetica, Arial, Tahoma, Verdana, sans-serif';
				break;
			case 1:
				$secondaryFontStack = 'Franchise, Helvetica, Arial, Tahoma, sans-serif';
				$secondaryFontFace 	= 'franchise';
				break;
			case 2:
				$secondaryFontStack = '"Winterthur Condensed", Helvetica, Arial, Tahoma, sans-serif';
				$secondaryFontFace 	= 'winterthur-condensed';
				break;
			case 3:
				$secondaryFontStack = '"Yanone Kaffeesatz Regular", Helvetica, Arial, Tahoma, sans-serif';
				$secondaryFontFace 	= 'yanone-kaffeesatz';
				break;
			case 4:
				$secondaryFontStack = '"Bebas Neue", Helvetica, Arial, Tahoma, sans-serif';
				$secondaryFontFace 	= 'bebas-neue';
				break;
			case 5:
				$secondaryFontStack = 'Helvetica, Arial, Tahoma, Verdana, sans-serif';
				break;
			case 6:
				$secondaryFontStack = 'Garamond, Avant Garde, Palatino, "Times New Roman", serif';
				break;
				
		endswitch;
		
		if($secondaryFontFace)
			echo "<link href='" . get_bloginfo('template_directory') . "/library/fonts/" . $secondaryFontFace . "/stylesheet.css' rel='stylesheet' type='text/css' />";

		$custom_fonts .= "
			#content h1,
			#content h2,
			#content h3,
			#content h4,
			#content h5,
			#content h6, 
			#discussion h1,
			#discussion h2,
			#discussion h3,
			#discussion h4,
			#discussion h5,
			#discussion h6,
			#header,
			#header input,
			#header button,
			#footer,
			.said,
			.time,
			.comment-reply-link,
			#more a{ 
				font-family: {$secondaryFontStack};
				text-transform: uppercase;
			}";

	endif;

	$custom_fonts .= "</style>";

	if($custom_fonts)
		echo $custom_fonts;

}
add_action('wp_head', 'custom_fonts');

function custom_css(){
    global $up_options;
    $custom_css = '<style type="text/css">';
    
    	$custom_css .= '.list .hentry{width:' . get_option('medium_size_w') . 'px;}';
	
		if($up_options->linkcolor)
			$custom_css .= "a{ color: ".$up_options->linkcolor.";}";

		if($up_options->hovercolor)
			$custom_css .= "a:hover{ color: ".$up_options->hovercolor.";}";

		if($up_options->activecolor)
			$custom_css .= "a:active{ color: ".$up_options->activecolor.";}";

    $custom_css .= '</style>';

	echo $custom_css;
}
add_action('wp_head', 'custom_css');

// Create Header Ads
function ads_below_header(){
	global $up_options;

  if($up_options->top_ads){ ?>
  
    <div id="ads_below_header">
     <?php echo $up_options->top_ads; ?>
    </div>
    
	<?php
	}
}
add_action('evo_belowheader', 'ads_below_header');

// Create Footer Ads
function ads_above_footer(){
	global $up_options;

  if($up_options->bottom_ads){ ?>
  
    <div id="ads_above_footer">
     <?php echo $up_options->bottom_ads; ?>
    </div>
    
	<?php
	}
}
add_action('evo_abovefooter', 'ads_above_footer');

// Fix Thickbox image paths
function thickbox_image_paths() {
	global $post;
	wp_reset_query();
	if (is_singular()) {
		$thickbox_path = get_option('siteurl') . '/wp-includes/js/thickbox/';
		echo "<script type=\"text/javascript\">\n";
		echo "	var tb_pathToImage = \"${thickbox_path}loadingAnimation.gif\";\n";
		echo "	var tb_closeImage = \"${thickbox_path}tb-close.png\";\n";
		echo "</script>\n";
	}
}
add_action('wp_footer', 'thickbox_image_paths');

// Function to get width of thumbnails
function get_thumbnail_width($px=false){
    
    global $up_options;
  
  if($up_options->thumbnail_w){
    $thumbnail_width = (int)$up_options->thumbnail_w;
  } else {
    $thumbnail_width = '125';
  }
  
  if($px==true){
    return $thumbnail_width . 'px';
  }else{
    return $thumbnail_width;
  }
  
}

// Function to get height of thumbnails
function get_thumbnail_height($px=false){

   global $up_options;
  
  if(isset($up_options->thumbnail_h)){
    $thumbnail_height = (int)$up_options->thumbnail_h;
  } else {
    $thumbnail_height = '125';
  }
  
  if($px==true){
    return $thumbnail_height . 'px';
  }else{
    return $thumbnail_height;
  }
}

function set_thumbnail_h_w(){
	
	global $up_options;
	
	if(isset($_POST['up_save'])):
		
		if($up_options->thumbnail_h):
			update_option("thumbnail_size_h",$up_options->thumbnail_h);
		endif;
		
		if($up_options->thumbnail_w):
			update_option("thumbnail_size_w",$up_options->thumbnail_w);
		endif;
	
	endif;
}

add_action('init','set_thumbnail_h_w');

//  Gallery Child Theme Functions
function childtheme_menu_args($args) {
    $args = array(
        'show_home' => 'Home',
        'sort_column' => 'menu_order',
        'menu_class' => 'menu',
        'echo' => true
    );
	return $args;
}
add_filter('wp_page_menu_args', 'childtheme_menu_args');

// 
function theme_footer($themelink) {
    global $up_options;
    return $up_options->footertext;
}
add_filter('evo_footertext', 'theme_footer');

// Remove sidebar on gallery-style pages
function remove_sidebar() {
	global $post, $up_options;
	if(!is_single()){
		if(!$up_options->enablesidebar){
			return TRUE;
		} else {
			return FALSE;
		}
	} elseif(get_post_meta($post->ID,"custom_post_template",true) == "blog.php"){
		return TRUE;
	}
}

  add_filter('evo_sidebar', 'remove_sidebar');

//get thumbnail
function postimage($size=medium) {
	global $post;
	global $up_options;
	
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {

			$attachmentimage_thumb_src=wp_get_attachment_image_src( $image->ID, 'thumbnail' );
			$attachmentimage_medium=wp_get_attachment_image( $image->ID, 'medium' );
			$attachmentimage_src=wp_get_attachment_image_src( $image->ID, $size );
				

	  		echo '<img src="' . $attachmentimage_src[0] . ' class="thumbnail" alt="' . attribute_escape($post->post_title) . '" />';
	
		}
	} 
}

//get images
function postimages($size=medium) {

    global $up_options;

	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'order' => 'ASC',
		'post_mime_type' => 'image',)))
	{
		
		if(count($images) > 1):
		
			$slideshow = true;
		
		endif;
		
		if($slideshow == true):
		
			echo '<div id="myController"></div><!--/#myController-->

										<div id="featured-wrapper">
											<div id="featured">
												<div id="mySlides">';

		endif;
		
		foreach( $images as $image ) {

			$attachmentimage_medium=wp_get_attachment_image( $image->ID, 'medium' );
			$attachmentimage_src=wp_get_attachment_image_src( $image->ID, $size );
			$attachmentimage_large_src=wp_get_attachment_image_src( $image->ID, 'large' );

			echo '<div class="jFlowSlideContainer"><img src="' . $attachmentimage_src[0] . '" ' . $attributes . ' alt="' . attribute_escape($post->post_title) . '" /></div>';

		}

		if($slideshow == true):
		
			echo '								</div><!--/#mySlides-->
										
										
											</div><!--/#featured-wrapper-->
										</div><!--/#products-->';

		endif;


	} 
}

//check any attachment 
function checkimage($size=medium) {
	if ( $images = get_children(array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
	{
		foreach( $images as $image ) {
			$attachmentimage=wp_get_attachment_image( $image->ID, $size );
			return $attachmentimage;
		}
	} 
}

// Remove Navigation Above & Below
function remove_navigation() {
  remove_action('evo_navigation_above', 'evo_nav_above', 2);
  remove_action('evo_navigation_below', 'evo_nav_below', 2);
}
add_action('init', 'remove_navigation');

// re-create evo_nav_below

function gallery_nav_below() {
?>

		<div id="more">
			<?php next_posts_link(__('Load More Images', 'evo')) ?>
        </div>
	
<?php

}

add_action('evo_navigation_below', 'gallery_nav_below');

// Filter the Page Title
function gallery_page_title ($content) {
  if (is_category()) {
    $content = '<h1 class="page-title"><span>';
    $content .= single_cat_title("", false);
    $content .= '</span></h1>';
    if ( !(''== category_description()) ) {
	$content .= '<div class="archive-meta">';
	$content .= apply_filters('archive_meta', category_description());
	$content .= '</div>';
    }
  } elseif (is_tag()) {
    $content = '<h1 class="page-title"><span>';
    $content = evo_tag_query();
    $content = '</span></h1>';
  }
  return $content;
}
add_filter('evo_page_title', 'gallery_page_title');
// End of Filter the Page Title

// UpThemes Admin Functions
require_once('admin/functions.php');