<?php

// Custom callback to list comments in the Thematic style
function evo_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
    ?>
    	<li id="comment-<?php comment_ID() ?>" class="<?php evo_comment_class() ?>">
    		<div class="comment-meta-wrapper">
            <span class="comment-author vcard"><?php
            
						list($year, $month, $day, $hour, $minute, $second) = preg_Split('~[\- :]~', $comment->comment_date);
						$comment_timestamp = mktime($hour, $minute, $second, $month, $day, $year);

						$commenter = get_comment_author_link();
            if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
              $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
            } else {
              $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
            }
            $avatar_email = get_comment_author_email();
            $avatar_size = apply_filters( 'avatar_size', '64' ); // Available filter: avatar_size
            $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, $avatar_size ) );
            echo $avatar . ' <span class="said"><span class="fn n">' . $commenter . '</span> ' . __('said','evo') . '</span>';
            echo '<span class="time">' . distance_of_time_in_words($comment_timestamp, time(), true) . " " . __('ago','evo');
            edit_comment_link(__('(Edit)','evo'),'  ','');
            echo '</span>';

            ?></span>
            <span class="comment-meta">
              
            </span>
        </div>
        <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'evo') ?>

            <div class="comment-content">
        		<?php comment_text() ?>
    		</div>
			<?php // echo the comment reply link with help from Justin Tadlock http://justintadlock.com/ and Will Norris http://willnorris.com/
				if($args['type'] == 'all' || get_comment_type() == 'comment') :
					comment_reply_link(array_merge($args, array(
						'reply_text' => __('Add Reply','evo'), 
						'login_text' => __('Log in to reply.','evo'),
						'depth' => $depth,
						'before' => '<div class="comment-reply-link">', 
						'after' => '</div>'
					)));
				endif;
			?>
<?php }

// Custom callback to list pings in the Thematic style
function evo_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
    		<li id="comment-<?php comment_ID() ?>" class="<?php evo_comment_class() ?>">
    			<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'evo'),
    					get_comment_author_link(),
    					get_comment_date(),
    					get_comment_time() );
    					edit_comment_link(__('Edit', 'evo'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'evo') ?>
            <div class="comment-content">
    			<?php comment_text() ?>
			</div>
<?php }

?>