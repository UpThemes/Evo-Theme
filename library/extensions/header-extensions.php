<?php


// Creates the DOCTYPE section
function evo_create_doctype() {
    $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml"';
    echo apply_filters('evo_create_doctype', $content);
} // end evo_create_doctype


// Get the page number adapted from http://efficienttips.com/wordpress-seo-title-description-tag/
function pageGetPageNo() {
    if (get_query_var('paged')) {
        print ' | Page ' . get_query_var('paged');
    }
} // end pageGetPageNo


// Located in header.php 
// Creates the content of the Title tag
// Credits: Tarski Theme
function evo_doctitle() {
    $site_name = get_bloginfo('name');
    $separator = '|';
        	
    if ( is_single() ) {
      $content = single_post_title('', FALSE);
    }
    elseif ( is_home() || is_front_page() ) { 
      $content = get_bloginfo('description');
    }
    elseif ( is_page() ) { 
      $content = single_post_title('', FALSE); 
    }
    elseif ( is_search() ) { 
      $content = __('Search Results for:', 'evo'); 
      $content .= ' ' . wp_specialchars(stripslashes(get_search_query()), true);
    }
    elseif ( is_category() ) {
      $content = __('Category Archives:', 'evo');
      $content .= ' ' . single_cat_title("", false);;
    }
    elseif ( is_tag() ) { 
      $content = __('Tag Archives:', 'evo');
      $content .= ' ' . evo_tag_query();
    }
    elseif ( is_404() ) { 
      $content = __('Not Found', 'evo'); 
    }
    else { 
      $content = get_bloginfo('description');
    }

    if (get_query_var('paged')) {
      $content .= ' ' .$separator. ' ';
      $content .= 'Page';
      $content .= ' ';
      $content .= get_query_var('paged');
    }

    if($content) {
      if ( is_home() || is_front_page() ) {
          $elements = array(
            'site_name' => $site_name,
            'separator' => $separator,
            'content' => $content
          );
      }
      else {
          $elements = array(
            'content' => $content
          );
      }  
    } else {
      $elements = array(
        'site_name' => $site_name
      );
    }

    // Filters should return an array
    $elements = apply_filters('evo_doctitle', $elements);
	
    // But if they don't, it won't try to implode
    if(is_array($elements)) {
      $doctitle = implode(' ', $elements);
    }
    else {
      $doctitle = $elements;
    }
    
    $doctitle = "\t" . "<title>" . $doctitle . "</title>" . "\n\n";
    
    echo $doctitle;
} // end evo_doctitle


// Creates the content-type section
function evo_create_contenttype() {
    $content  = "\t";
    $content .= "<meta http-equiv=\"Content-Type\" content=\"";
    $content .= get_bloginfo('html_type'); 
    $content .= "; charset=";
    $content .= get_bloginfo('charset');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('evo_create_contenttype', $content);
} // end evo_create_contenttype

// The master switch for SEO functions
function evo_seo() {
		$content = TRUE;
		return apply_filters('evo_seo', $content);
}

// Creates the canonical URL
function evo_canonical_url() {
		if (evo_seo()) {
    		if ( is_singular() ) {
        		$canonical_url = "\t";
        		$canonical_url .= '<link rel="canonical" href="' . get_permalink() . '" />';
        		$canonical_url .= "\n\n";        
        		echo apply_filters('evo_canonical_url', $canonical_url);
				}
    }
} // end evo_canonical_url


// switch use of evo_the_excerpt() - default: ON
function evo_use_excerpt() {
    $display = TRUE;
    $display = apply_filters('evo_use_excerpt', $display);
    return $display;
} // end evo_use_excerpt


// switch use of evo_the_excerpt() - default: OFF
function evo_use_autoexcerpt() {
    $display = FALSE;
    $display = apply_filters('evo_use_autoexcerpt', $display);
    return $display;
} // end evo_use_autoexcerpt


// Creates the meta-tag description
function evo_create_description() {
		if (evo_seo()) {
    		if (is_single() || is_page() ) {
      		  if ( have_posts() ) {
          		  while ( have_posts() ) {
            		    the_post();
										if (evo_the_excerpt() == "") {
                    		if (evo_use_autoexcerpt()) {
                        		$content ="\t";
														$content .= "<meta name=\"description\" content=\"";
                        		$content .= evo_excerpt_rss();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		} else {
                    		if (evo_use_excerpt()) {
                        		$content ="\t";
                        		$content .= "<meta name=\"description\" content=\"";
                        		$content .= evo_the_excerpt();
                        		$content .= "\" />";
                        		$content .= "\n\n";
                    		}
                		}
            		}
        		}
    		} elseif ( is_home() || is_front_page() ) {
        		$content ="\t";
        		$content .= "<meta name=\"description\" content=\"";
        		$content .= get_bloginfo('description');
        		$content .= "\" />";
        		$content .= "\n\n";
    		}
    		echo apply_filters ('evo_create_description', $content);
		}
} // end evo_create_description


// meta-tag description is switchable using a filter
function evo_show_description() {
    $display = TRUE;
    $display = apply_filters('evo_show_description', $display);
    if ($display) {
        evo_create_description();
    }
} // end evo_show_description


// create meta-tag robots
function evo_create_robots() {
		if (evo_seo()) {
    		$content = "\t";
    		if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
						$content .= "<meta name=\"robots\" content=\"index,follow\" />";
    		} elseif (is_search()) {
        		$content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
    		} else {	
        		$content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
    		}
    		$content .= "\n\n";
    		if (get_option('blog_public')) {
    				echo apply_filters('evo_create_robots', $content);
    		}
		}
} // end evo_create_robots


// meta-tag robots is switchable using a filter
function evo_show_robots() {
    $display = TRUE;
    $display = apply_filters('evo_show_robots', $display);
    if ($display) {
        evo_create_robots();
    }
} // end evo_show_robots


// Located in header.php
// creates link to style.css
function evo_create_stylesheet() {
    $content = "\t";
    $content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"";
    $content .= get_bloginfo('stylesheet_url');
    $content .= "\" />";
    $content .= "\n\n";
    echo apply_filters('evo_create_stylesheet', $content);
}

// pingback usage is switchable using a filter
function evo_show_pingback() {
    $display = TRUE;
    apply_filters('evo_show_pingback', $display);
    if ($display) {
        $content = "\t";
        $content .= "<link rel=\"pingback\" href=\"";
        $content .= get_bloginfo('pingback_url');
        $content .= "\" />";
        $content .= "\n\n";
        echo $content;
    }
} // end evo_show_pingback


// comment reply usage is switchable using a filter
function evo_show_commentreply() {
    $display = TRUE;
    apply_filters('evo_show_commentreply', $display);
    if ($display)
        if ( is_singular() ) 
            wp_enqueue_script( 'comment-reply' ); // support for comment threading
} // end evo_show_commentreply


// Just after the opening body tag, before anything else.
function evo_before() {
    do_action('evo_before');
} // end evo_before

// Just before the header div
function evo_aboveheader() {
    do_action('evo_aboveheader');
} // end evo_aboveheader
		
// Just after the header div
function evo_belowheader() {
    do_action('evo_belowheader');
} // end evo_belowheader
		

?>