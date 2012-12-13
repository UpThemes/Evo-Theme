<?php
/**
 * Evo functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Evo
 * @since Evo 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Evo supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Evo 1.0
 */
function evo_setup() {
	/*
	 * Makes Evo available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Evo, use a find and replace
	 * to change 'evo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'evo', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status', 'gallery' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary_nav', __( 'Primary Menu', 'evo' ) );
	register_nav_menu( 'footer_nav', __( 'Footer Menu', 'evo' ) );

  add_image_size('full-width',660,99999,false);
  add_image_size('full-width-2x',1320,99999,false);
  add_image_size('grid',232,232,false);
  add_image_size('grid-2x',464,464,false);

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'f2f2f2f2',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'evo_setup' );

/**
 * Adds support for a custom header image.
 */
include_once( get_template_directory() . '/library/custom-header.php' );

/**
 * Adds support for custom gallery sliders
 */
include_once( get_template_directory() . '/library/gallery-slider.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Evo 1.0
 */
function evo_scripts_styles() {

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'evo-navigation', get_template_directory_uri() . '/js/navigation.js', false );
  wp_enqueue_script( 'evo-hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', false );
  wp_enqueue_script( 'evo-retina', get_template_directory_uri() . '/js/jquery.retina.js', false );
  wp_enqueue_script( 'evo-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.js', array('jquery') );
  wp_enqueue_script( 'evo-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery') );
  wp_enqueue_script( 'evo-masonry', get_template_directory_uri() . '/js/jquery.masonry.js', array('evo-infinitescroll') );
  wp_enqueue_script( 'evo-scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.js', array('evo-masonry') );
  wp_enqueue_script( 'evo-fitVids', get_template_directory_uri() . '/js/fitVids.js', false );
  wp_enqueue_script( 'evo-view', get_template_directory_uri() . '/js/view.js', false );
  wp_enqueue_script( 'evo-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery') );
  wp_enqueue_script( 'evo-superfish', get_template_directory_uri() . '/js/superfish.js' );
  wp_enqueue_script( 'evo-supersubs', get_template_directory_uri() . '/js/supersubs.js', array('evo-superfish') );
  wp_enqueue_script( 'evo-global', get_template_directory_uri() . '/js/global.js', array('evo-flexslider','evo-fitvids','evo-infinitescroll','evo-retina','evo-scrollTo','evo-supersubs','evo-navigation') );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'evo-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'evo_scripts_styles' );

function evo_set_loading_gif_location(){
	$template_directory = get_template_directory_uri();
	echo "<script>"."\n";
	echo "var global = {"."\n";
	echo "	loading : '$template_directory/images/loading.gif'"."\n";
	echo "}"."\n";
	echo "</script>"."\n\n";
}

add_action("wp_head","evo_set_loading_gif_location",0);

function evo_post_thumbnail( $size ){

  global $post;

  if( isset($post->ID) && has_post_thumbnail($post->ID) ){

	  if( $size == 'grid' ):
	    $normal_size = 'grid';
	    $retina_size = 'grid-2x';
	  elseif( $size == 'full-width' ):
	    $normal_size = 'full-width';
	    $retina_size = 'full-width-2x';
	  else:
	    $normal_size = 'medium';
	    $retina_size = 'large';
	  endif;

	  $post_thumbnail_id = get_post_thumbnail_id($post->ID);

	  $normal_image = wp_get_attachment_image_src( $post_thumbnail_id, $normal_size);
	  $normal_image_src = $normal_image[0];
	  $normal_width = $normal_image[1];
	  $normal_height = $normal_image[2];
	  $retina_image = wp_get_attachment_image_src( $post_thumbnail_id, $retina_size);
	  $retina_image_src = $retina_image[0];
	  $retina_width =  $retina_image[1] ? $retina_image[1] : '200';
	  $retina_height = $retina_image[2] ? $retina_image[2] : '200';

	  if( $retina_image_src ){
	 		$retina_image = " data-retina=\"$retina_image_src\"";
	  }

	  if( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) )
	    $alt_text = ' alt="' . get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) . '"';
	  else
	    $alt_text = '';

	  echo "<img class=\"wp-post-image\" width=\"$normal_width\" height=\"$normal_height\" src=\"$normal_image_src\"$retina_image$alt_text>";
	} else {
		echo false;
	}

}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Evo 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function evo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'evo' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'evo_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Evo 1.0
 */
function evo_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'evo_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Evo 1.0
 */
function evo_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'evo' ),
		'id' => 'sidebar-primary',
		'description' => __( 'Appears on posts and pages.', 'evo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer', 'evo' ),
		'id' => 'sidebar-footer',
		'description' => __( 'Appears on footer.', 'evo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'evo_widgets_init' );

if ( ! function_exists( 'evo_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Evo 1.0
 */
function evo_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'evo' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'evo' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'evo' ) ); ?></div>
		</nav><!-- #<?php echo $nav_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'evo_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own evo_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Evo 1.0
 */
function evo_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'evo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'evo' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <span class="says">said:</span>', 'evo' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() )
						);
					?>

				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'evo' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'evo' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for evo_comment()

/**
 * Modifies the text fields for the comment form.
 *
 * @since Evo 1.4
 */
function upthemes_form_fields($fields) {
	global $commenter,$aria_req;
  $fields = array(
  	'author' => '<p class="comment-form-author"><span class="text-field-holder"><input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></span></p>',
  	'email'  => '<p class="comment-form-email"><span class="text-field-holder"><input id="email" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></span></p>',
  	'url'    => '<p class="comment-form-url"><span class="text-field-holder"><input id="url" name="url" placeholder="Web URL" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></span></p>'
  );

  return $fields;
}

add_filter('comment_form_default_fields','upthemes_form_fields');

if ( ! function_exists( 'evo_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own evo_entry_meta() to override in a child theme.
 *
 * @since Evo 1.0
 */
function evo_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'evo' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'evo' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'evo' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'evo' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'evo' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'evo' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Evo 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function evo_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'evo-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'evo_body_class' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Evo 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function evo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'evo_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Evo 1.0
 */
function evo_customize_preview_js() {
	wp_enqueue_script( 'evo-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'evo_customize_preview_js' );


/**
 * Displays heading text with post count
 *
 * @since Evo 1.0
 */
function evo_list_header(){
	
	global $wpdb,$wp_query;
	
	if(is_category()):
		$catID = get_query_var('cat');
		$post_count = (int) get_category($catID)->count;
	elseif(is_tag()):
		$tagID = get_query_var('tag');
		$post_count = (int) get_category($tagID)->count;
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
    if(is_category()):
      echo single_cat_title() . " ";               
    elseif(is_tag()):
      echo single_tag_title() . " ";               
    endif;
    ?>
    <span class="pagination">
    <?php
    $pagination = __('Showing %1$s - %2$s of %3$s','evo');
    printf($pagination, $starting_post, $ending_post, $post_count); ?>
    </span>
  </h2>
<?php
}

/**
 *  Post navigation functionality
 *
 * @since Evo 1.0
 */
function evo_navigation_below() {
  if ( is_single() ): ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php evo_previous_post_link() ?></div>
		<div class="nav-next"><?php evo_next_post_link() ?></div>
	</div>
<?php else: ?>
  <div id="more">
	  <?php next_posts_link( __('Load More', 'evo') ) ?>
  </div>
<?php
  endif;
}