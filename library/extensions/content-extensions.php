<?php

// Located in archives.php
// Just after the content
function evo_archives() {
		do_action('evo_archives');
} // end evo_archives


// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just before the content
function evo_navigation_above() {
		do_action('evo_navigation_above');
} // end evo_navigation_above

// Located in archive.php, author.php, category.php, index.php, search.php, single.php, tag.php
// Just after the content
function evo_navigation_below() {
		do_action('evo_navigation_below');
} // end evo_navigation_below

// Located in index.php 
// Just before the loop
function evo_above_indexloop() {
    do_action('evo_above_indexloop');
} // end evo_above_indexloop

// Located in archive.php
// The Loop
function evo_archiveloop() {
		do_action('evo_archiveloop');
} // end evo_archiveloop

// Located in author.php
// The Loop
function evo_authorloop() {
		do_action('evo_authorloop');
} // end evo_authorloop

// Located in category.php
// The Loop
function evo_categoryloop() {
		do_action('evo_categoryloop');
} // end evo_categoryloop

// Located in index.php
// The Loop
function evo_indexloop() {
		do_action('evo_indexloop');
} // end evo_indexloop

// Located in search.php
// The Loop
function evo_searchloop() {
		do_action('evo_searchloop');
} // end evo_searchloop

// Located in single.php
// The Post
function evo_singlepost() {
		do_action('evo_singlepost');
} //end evo_singlepost

// Located in tag.php
// The Loop
function evo_tagloop() {
		do_action('evo_tagloop');
} // end evo_tagloop

// Located in index.php 
// Just after the loop
function evo_below_indexloop() {
    do_action('evo_below_indexloop');
} // end evo_below_indexloop


// Located in category.php 
// Just before the loop
function evo_above_categoryloop() {
    do_action('evo_above_categoryloop');
} // end evo_above_categoryloop


// Located in category.php 
// Just after the loop
function evo_below_categoryloop() {
    do_action('evo_below_categoryloop');
} // end evo_below_categoryloop


// Located in search.php 
// Just before the loop
function evo_above_searchloop() {
    do_action('evo_above_searchloop');
} // end evo_above_searchloop


// Located in search.php 
// Just after the loop
function evo_below_searchloop() {
    do_action('evo_below_searchloop');
} // end evo_below_searchloop


// Located in tag.php 
// Just before the loop
function evo_above_tagloop() {
    do_action('evo_above_tagloop');
} // end evo_above_tagloop


// Located in tag.php 
// Just after the loop
function evo_below_tagloop() {
    do_action('evo_below_tagloop');
} // end evo_below_tagloop


// Filter the page title
// located in archive.php, attachement.php, author.php, category.php, search.php, tag.php
function evo_page_title() {
		$content = '';
		if (is_attachment()) {
				$content .= '<h2 class="page-title"><a href="';
				$content .= get_permalink($post->post_parent);
				$content .= '" rev="attachment"><span class="meta-nav">&laquo; </span>';
				$content .= get_the_title($post->post_parent);
				$content .= '</a></h2>';
		} elseif (is_author()) {
				$content .= '<h1 class="page-title author">';
				$author = get_the_author();
				$content .= __('Author Archives: ', 'evo');
				$content .= '<span>';
				$content .= $author;
				$content .= '</span></h1>';
		} elseif (is_category()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Category Archives:', 'evo');
				$content .= ' <span>';
				$content .= single_cat_title('', FALSE);
				$content .= '</span></h1>' . "\n";
				$content .= '<div class="archive-meta">';
				if ( !(''== category_description()) ) : $content .= apply_filters('archive_meta', category_description()); endif;
				$content .= '</div>';
		} elseif (is_search()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Search Results for:', 'evo');
				$content .= ' <span id="search-terms">';
				$content .= wp_specialchars(stripslashes($_GET['s']), true);
				$content .= '</span></h1>';
		} elseif (is_tag()) {
				$content .= '<h1 class="page-title">';
				$content .= __('Tag Archives:', 'evo');
				$content .= ' <span>';
				$content .= __(evo_tag_query());
				$content .= '</span></h1>';
		}	elseif (is_day()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Daily Archives: <span>%s</span>', 'evo'), get_the_time(get_option('date_format')));
				$content .= '</h1>';
		} elseif (is_month()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Monthly Archives: <span>%s</span>', 'evo'), get_the_time('F Y'));
				$content .= '</h1>';
		} elseif (is_year()) {
				$content .= '<h1 class="page-title">';
				$content .= sprintf(__('Yearly Archives: <span>%s</span>', 'evo'), get_the_time('Y'));
				$content .= '</h1>';
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
				$content .= '<h1 class="page-title">';
				$content .= __('Blog Archives', 'evo');
				$content .= '</h1>';
		}
		$content .= "\n";
		echo apply_filters('evo_page_title', $content);
}

// Action to create the above navigation
function evo_nav_above() {
		if (is_single()) { ?>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php evo_previous_post_link() ?></div>
				<div class="nav-next"><?php evo_next_post_link() ?></div>
			</div>

<?php
		} else { ?>

			<div id="nav-above" class="navigation">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'evo')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'evo')) ?></div>
				<?php } ?>
			</div>	
	
<?php
		}
}
add_action('evo_navigation_above', 'evo_nav_above', 2);

// The Archive Loop
function evo_archive_loop() {
		while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php evo_post_class() ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content(); ?>

				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;
}
add_action('evo_archiveloop', 'evo_archive_loop');

// The Author Loop
function evo_author_loop() {
		rewind_posts();
		while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php evo_post_class(); ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content ">
<?php evo_content(); ?>

				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;
}
add_action('evo_authorloop', 'evo_author_loop');

// The Category Loop
function evo_category_loop() {
		while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php evo_post_class(); ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content(); ?>

				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;
}
add_action('evo_categoryloop', 'evo_category_loop');

// The Index Loop
function evo_index_loop() {
		/* Count the number of posts so we can insert a widgetized area */ $count = 1;
		while ( have_posts() ) : the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php evo_post_class() ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content(); ?>

				<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'evo') . '&after=</div>') ?>
				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

				<?php comments_template();

				if ($count==$thm_insert_position) {
						get_sidebar('index-insert');
				}
				$count = $count + 1;
		endwhile;
}
add_action('evo_indexloop', 'evo_index_loop');

// The Single Post
function evo_single_post() { ?>
			<div id="post-<?php the_ID(); ?>" class="<?php evo_post_class(); ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content(); ?>

					<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'evo') . '&after=</div>') ?>
				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->
<?php
}
add_action('evo_singlepost', 'evo_single_post');

// The Search Loop
function evo_search_loop() {
		while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php evo_post_class() ?>">
    			
    			<?php if(has_post_thumbnail()): ?>
    				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    			<?php endif; ?>
    			
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content(); ?>

				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;
}
add_action('evo_searchloop', 'evo_search_loop');

// The Tag Loop
function evo_tag_loop() {
		while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php evo_post_class(); ?>">
    			<?php evo_postheader(); ?>
				<div class="entry-content">
<?php evo_content() ?>

				</div>
				<?php evo_postfooter(); ?>
			</div><!-- .post -->

		<?php endwhile;
}
add_action('evo_tagloop', 'evo_tag_loop');

// Filter to create the time url title displayed in Post Header
function evo_time_title() {

  $time_title = 'Y-m-d\TH:i:sO';

	// Filters should return correct 
	$time_title = apply_filters('evo_time_title', $time_title);
	
	return $time_title;
} // end evo_time_title


// Filter to create the time displayed in Post Header
function evo_time_display() {

  $time_display = get_option('date_format');

	// Filters should return correct 
	$time_display = apply_filters('evo_time_display', $time_display);
	
	return $time_display;
} // end evo_time_display


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

// Information in Post Header
function evo_postheader() {
    global $id, $post, $authordata;
    
    // Create $posteditlink    
    $posteditlink .= '<a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
    $posteditlink .= '" title="' . __('Edit post', 'evo') .'">';
    $posteditlink .= __('Edit', 'evo') . '</a>';
    $posteditlink = apply_filters('evo_postheader_posteditlink',$posteditlink); 

    
    if (is_single() || is_page()) {
        $posttitle = '<h1 class="entry-title">' . get_the_title() . "</h1>\n";
    } elseif (is_404()) {    
        $posttitle = '<h1 class="entry-title">' . __('Not Found', 'evo') . "</h1>\n";
    } else {
        $posttitle = '<h2 class="entry-title"><a href="';
        $posttitle .= get_permalink();
        $posttitle .= '" title="';
        $posttitle .= __('Permalink to ', 'evo') . the_title_attribute('echo=0');
        $posttitle .= '" rel="bookmark">';
        $posttitle .= get_the_title();   
        $posttitle .= "</a></h2>\n";
    }
    $posttitle = apply_filters('evo_postheader_posttitle',$posttitle); 
    
    $postmeta = '<div class="entry-meta">';
    $postmeta .= '<span class="meta-prep meta-prep-author">' . __('By ', 'evo') . '</span>';
    $postmeta .= '<span class="author vcard">'. '<a class="url fn n" href="';
    $postmeta .= get_author_link(false, $authordata->ID, $authordata->user_nicename);
    $postmeta .= '" title="' . __('View all posts by ', 'evo') . get_the_author() . '">';
    $postmeta .= get_the_author();
    $postmeta .= '</a></span><span class="meta-sep meta-sep-entry-date"> | </span>';
    $postmeta .= '<span class="meta-prep meta-prep-entry-date">' . __('Published: ', 'evo') . '</span>';
    $postmeta .= '<span class="entry-date"><abbr class="published" title="';
    $postmeta .= get_the_time(evo_time_title()) . '">';
    $postmeta .= get_the_time(evo_time_display());
    $postmeta .= '</abbr></span>';
    // Display edit link
    if (current_user_can('edit_posts')) {
        $postmeta .= ' <span class="meta-sep meta-sep-edit">|</span> ' . '<span class="edit">' . $posteditlink . '</span>';
    }               
    $postmeta .= "</div><!-- .entry-meta -->\n";
    $postmeta = apply_filters('evo_postheader_postmeta',$postmeta); 

    
    if ($post->post_type == 'page' || is_404()) {
        $postheader = $posttitle;        
    } else {
        $postheader = $posttitle . $postmeta;    
    }
    
    echo apply_filters( 'evo_postheader', $postheader ); // Filter to override default post header
} // end evo_postheader


//creates the content
function evo_content() {

	if (is_home() || is_front_page()) { 
		$content = 'full';
	} elseif (is_single()) {
		$content = 'full';
	} elseif (is_tag()) {
		$content = 'excerpt';
	} elseif (is_search()) {
		$content = 'excerpt';	
	} elseif (is_category()) {
		$content = 'excerpt';
	} elseif (is_author()) {
		$content = 'excerpt';
	} elseif (is_archive()) {
		$content = 'excerpt';
	}
	
	$content = apply_filters('evo_content', $content);

	if ( strtolower($content) == 'full' ) {
		$post = get_the_content(more_text());
		$post = apply_filters('the_content', $post);
		$post = str_replace(']]>', ']]&gt;', $post);
	} elseif ( strtolower($content) == 'excerpt') {
		$post = get_the_excerpt();
	} elseif ( strtolower($content) == 'none') {
	} else {
		$post = get_the_content(more_text());
		$post = apply_filters('the_content', $post);
		$post = str_replace(']]>', ']]&gt;', $post);
	}
	echo apply_filters('evo_post', $post);
} // end evo_content

// Functions that hook into evo_archives()

		// Open .archives-page
		function evo_archivesopen() { ?>
				<ul id="archives-page" class="xoxo">
		<?php }
		add_action('evo_archives', 'evo_archivesopen', 1);

		// Display the Category Archives
		function evo_category_archives() { ?>
						<li id="category-archives" class="content-column">
							<h2><?php _e('Archives by Category', 'evo') ?></h2>
							<ul>
								<?php wp_list_categories('optioncount=1&feed=RSS&title_li=&show_count=1') ?> 
							</ul>
						</li>
		<?php }
		add_action('evo_archives', 'evo_category_archives', 3);

		// Display the Monthly Archives
		function evo_monthly_archives() { ?>
						<li id="monthly-archives" class="content-column">
							<h2><?php _e('Archives by Month', 'evo') ?></h2>
							<ul>
								<?php wp_get_archives('type=monthly&show_post_count=1') ?>
							</ul>
						</li>
		<?php }
		add_action('evo_archives', 'evo_monthly_archives', 5);

		// Close .archives-page
		function evo_archivesclose() { ?>
				</ul>
		<?php }
		add_action('evo_archives', 'evo_archivesclose', 9);
		
// End of functions that hook into evo_archives()


// Action hook called in 404.php
function evo_404() {
	do_action('evo_404');
} // end evo_404


	// 404 content injected into evo_404
	function evo_404_content() { ?>
   			<?php evo_postheader(); ?>
   			
				<div class="entry-content">
					<p><?php _e('Apologies, but we were unable to find what you were looking for. Perhaps  searching will help.', 'evo') ?></p>
				</div>
				
				<form id="error404-searchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="error404-s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="40" />
						<input id="error404-searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'evo') ?>" />
					</div>
				</form>
	<?php } // end evo_404_content
	
	add_action('evo_404','evo_404_content');


// creates the $more_link_text for the_content
function more_text() {
	$content = ''.__('Read More <span class="meta-nav">&raquo;</span>', 'evo').'';
	return apply_filters('more_text', $content);
} // end more_text


// creates the $more_link_text for the_content
function list_bookmarks_args() {
	$content = 'title_before=<h2>&title_after=</h2>';
	return apply_filters('list_bookmarks_args', $content);
} // end more_text


// Information in Post Footer
function evo_postfooter() {
    global $id, $post;

    // Create $posteditlink    
    $posteditlink .= '<span class="edit"><a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id;
    $posteditlink .= '" title="' . __('Edit post', 'evo') .'">';
    $posteditlink .= __('Edit', 'evo') . '</a></span>';
    $posteditlink = apply_filters('evo_postfooter_posteditlink',$posteditlink); 
    
    // Display the post categories  
    $postcategory .= '<span class="cat-links">';
    if (is_single()) {
        $postcategory .= __('This entry was posted in ', 'evo') . get_the_category_list(', ');
        $postcategory .= '</span>';
    } elseif ( is_category() && $cats_meow = evo_cats_meow(', ') ) { /* Returns categories other than the one queried */
        $postcategory .= __('Also posted in ', 'evo') . $cats_meow;
        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
    } else {
        $postcategory .= __('Posted in ', 'evo') . get_the_category_list(', ');
        $postcategory .= '</span> <span class="meta-sep meta-sep-tag-links">|</span>';
    }
    $postcategory = apply_filters('evo_postfooter_postcategory',$postcategory); 
    
    // Display the tags
    if (is_single()) {
        $tagtext = __(' and tagged', 'evo');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span>');
    } elseif ( is_tag() && $tag_ur_it = evo_tag_ur_it(', ') ) { /* Returns tags other than the one queried */
        $posttags = '<span class="tag-links">' . __(' Also tagged ', 'evo') . $tag_ur_it . '</span> <span class="meta-sep meta-sep-comments-link">|</span>';
    } else {
        $tagtext = __('Tagged', 'evo');
        $posttags = get_the_tag_list("<span class=\"tag-links\"> $tagtext ",', ','</span> <span class="meta-sep meta-sep-comments-link">|</span>');
    }
    $posttags = apply_filters('evo_postfooter_posttags',$posttags); 
    
    // Display comments link and edit link
    if (comments_open()) {
        $postcommentnumber = get_comments_number();
        if ($postcommentnumber > '1') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'evo') . the_title_attribute('echo=0') . '">';
            $postcomments .= get_comments_number() . __(' Comments', 'evo') . '</a></span>';
        } elseif ($postcommentnumber == '1') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'evo') . the_title_attribute('echo=0') . '">';
            $postcomments .= get_comments_number() . __(' Comment', 'evo') . '</a></span>';
        } elseif ($postcommentnumber == '0') {
            $postcomments = ' <span class="comments-link"><a href="' . get_permalink() . '#comments" title="' . __('Comment on ', 'evo') . the_title_attribute('echo=0') . '">';
            $postcomments .= __('Leave a comment', 'evo') . '</a></span>';
        }
    } else {
        $postcomments = ' <span class="comments-link comments-closed-link">' . __('Comments closed', 'evo') .'</span>';
    }
    // Display edit link
    if (current_user_can('edit_posts')) {
        $postcomments .= ' <span class="meta-sep meta-sep-edit">|</span> ' . $posteditlink;
    }               
    $postcomments = apply_filters('evo_postfooter_postcomments',$postcomments); 
    
    // Display permalink, comments link, and RSS on single posts
    $postconnect .= __('. Bookmark the ', 'evo') . '<a href="' . get_permalink() . '" title="' . __('Permalink to ', 'evo') . the_title_attribute('echo=0') . '">';
    $postconnect .= __('permalink', 'evo') . '</a>.';
    if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Comments are open */
        $postconnect .= ' <a class="comment-link" href="#respond" title ="' . __('Post a comment', 'evo') . '">' . __('Post a comment', 'evo') . '</a>';
        $postconnect .= __(' or leave a trackback: ', 'evo');
        $postconnect .= '<a class="trackback-link" href="' . trackback_url(FALSE) . '" title ="' . __('Trackback URL for your post', 'evo') . '" rel="trackback">' . __('Trackback URL', 'evo') . '</a>.';
    } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) { /* Only trackbacks are open */
        $postconnect .= __(' Comments are closed, but you can leave a trackback: ', 'evo');
        $postconnect .= '<a class="trackback-link" href="' . trackback_url(FALSE) . '" title ="' . __('Trackback URL for your post', 'evo') . '" rel="trackback">' . __('Trackback URL', 'evo') . '</a>.';
    } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Only comments open */
        $postconnect .= __(' Trackbacks are closed, but you can ', 'evo');
        $postconnect .= '<a class="comment-link" href="#respond" title ="' . __('Post a comment', 'evo') . '">' . __('post a comment', 'evo') . '</a>.';
    } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) { /* Comments and trackbacks closed */
        $postconnect .= __(' Both comments and trackbacks are currently closed.', 'evo');
    }
    // Display edit link on single posts
    if (current_user_can('edit_posts')) {
        $postconnect .= ' ' . $posteditlink;
    }
    $postconnect = apply_filters('evo_postfooter_postconnect',$postconnect); 
    
    
    // Add it all up
    if ($post->post_type == 'page' && current_user_can('edit_posts')) { /* For logged-in "page" search results */
        $postfooter = '<div class="entry-utility">' . '<span class="edit">' . $posteditlink . '</span>';
        $postfooter .= "</div><!-- .entry-utility -->\n";    
    } elseif ($post->post_type == 'page') { /* For logged-out "page" search results */
        $postfooter = '';
    } else {
        if (is_single()) {
            $postfooter = '<div class="entry-utility">' . $postcategory . $posttags . $postconnect;
        } else {
            $postfooter = '<div class="entry-utility">' . $postcategory . $posttags . $postcomments;
        }
        $postfooter .= "</div><!-- .entry-utility -->\n";    
    }
    
    // Put it on the screen
    echo apply_filters( 'evo_postfooter', $postfooter ); // Filter to override default post footer
} // end evo_postfooter


// Action to create the below navigation
function evo_nav_below() {
		if (is_single()) { ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php evo_previous_post_link() ?></div>
				<div class="nav-next"><?php evo_next_post_link() ?></div>
			</div>

<?php
		} else { ?>

			<div id="nav-below" class="navigation">
                <?php if(function_exists('wp_pagenavi')) { ?>
                <?php wp_pagenavi(); ?>
                <?php } else { ?>  
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'evo')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'evo')) ?></div>
				<?php } ?>
			</div>	
	
<?php
		}
}
add_action('evo_navigation_below', 'evo_nav_below', 2);


// creates the previous_post_link
function evo_previous_post_link() {
	$args = array ('format'              => '%link',
								 'link'                => '<span class="meta-nav">&laquo;</span> %title',
								 'in_same_cat'         => FALSE,
								 'excluded_categories' => '');
	$args = apply_filters('evo_previous_post_link_args', $args );
	previous_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end evo_previous_post_link


// creates the next_post_link
function evo_next_post_link() {
	$args = array ('format'              => '%link',
								 'link'                => '%title <span class="meta-nav">&raquo;</span>',
								 'in_same_cat'         => FALSE,
								 'excluded_categories' => '');
	$args = apply_filters('evo_next_post_link_args', $args );
	next_post_link($args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories']);
} // end evo_next_post_link


// Produces an avatar image with the hCard-compliant photo class for author info
function evo_author_info_avatar() {
    global $wp_query; $curauth = $wp_query->get_queried_object();
	$email = $curauth->user_email;
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar("$email") );
	echo $avatar;
} // end evo_author_info_avatar


// For category lists on category archives: Returns other categories except the current one (redundant)
function evo_cats_meow($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) )
		return false;

	return trim(join( $glue, $cats ));
} // end evo_cats_meow


// For tag lists on tag archives: Returns other tags except the current one (redundant)
function evo_tag_ur_it($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) )
		return false;

	return trim(join( $glue, $tags ));
} // end evo_tag_ur_it



?>