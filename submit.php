<?php

/*
Template Name: Post Page
*/

global $up_options;
$lp_feedburner_url = "http://feeds2.feedburner.com/" . $up_options->feedburner;

get_header();

?>

	<div id="container">
	
        <div id="content">
        
<?php

function submission_form( $errormsg = null ){
	
	global $up_options;

	$wp_nonce = wp_create_nonce('wp_nonce');

	global $post;
	
	foreach($up_options->include_categories as $category):
		
		$idObj = get_category_by_slug($category); 
		$id = $idObj->term_id;
		
		$include_categories[] = $id;
			
	endforeach;
		
	$category_args = array(
		'show_count' => 0,
		'hide_empty' => 0,
		'include' => $include_categories
	);
	
?>
		  <h1><?php the_title(); ?></h1>
          
          <?php if( isset($errormsg) ) echo '<div class="messages">' . $errormsg . '</div>'; ?>
										
          <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data" id="submission_form" name="submission_form">

              <input type="hidden" value="submit" name="action" />
              <input type="hidden" value="<?php echo $wp_nonce; ?>" name="wp_nonce" />

              <fieldset>
                                
                <label for="title"><?php _e('Title','evo'); ?></label>
                <input type="text" name="title" id="title" class="required" value="<?php if($_REQUEST['title']): echo $_REQUEST['title']; endif; ?>" />
                
                <?php if( $up_options->allow_descriptions == 1 ): ?>
                <label for="body"><?php _e('Description','evo'); ?></label>
                <textarea name="body" id="body" class="required"><?php if($_REQUEST['body']): echo $_REQUEST['body']; endif; ?></textarea>
                <?php endif; ?>
                
                <?php if( $up_options->allow_categories == 1 ): ?>
                <label for="cat"><?php _e('Category:','evo'); ?></label>
                <?php wp_dropdown_categories($category_args); ?>
                <?php endif; ?>
                
                <?php if( $up_options->allow_tags == 1 ): ?>
                <label for="tags"><?php _e('Tags (optional):','evo'); ?></label>
                <input type="text" name="tags" id="tags" value="" class="haskbd" />
                <kbd><?php _e('Please separate tags with commas (ex: "web design,websites,red,blue,green").','evo'); ?></kbd>
                <?php endif; ?>
                
                <?php if( $up_options->allow_image_submissions == 1 ): ?>
                <label for="image-attachment"><?php _e('Attach an Image (JPG, GIF, or PNG accepted)','evo'); ?></label>
                <input type="file" name="image-attachment" id="image-attachment" />
                <?php endif; ?>

              </fieldset>

              <fieldset class="buttons">

                  <input type="submit" value="Submit" name="submit" />
              
              </fieldset>
          
          </form>
<script type="text/javascript">
jQuery('#submission_form').validate();
</script>


<?php

}

global $user_ID, $current_user;

  get_currentuserinfo();
  
if ( $current_user->user_level >= $up_options->submission_permissions ):

	$errormsg = '';

	if(isset($_REQUEST['action']) && isset($_REQUEST['wp_nonce'])):

		$new_post = array();

		$wp_nonce = $_REQUEST['wp_nonce'];

		if( !wp_verify_nonce($wp_nonce, 'wp_nonce') ):
			$error = 1;
			$errormsg .= '<div class="error">' . __('Security error, please try your submission again.','evo') . '</div>';
		endif;
	
		if( !$_REQUEST['title'] ):
			$error = 1;
			$errormsg .= '<div class="error">' . __('Please enter a title.','evo') . '</div>';
		else:
			$new_post['post_title'] = $_REQUEST['title'];
		endif;
		
		if( $up_options->allow_image_submissions == 1 && empty($_REQUEST['body']) ):
			$error = 1;
			$errormsg .= '<div class="error">' . __('Please enter a description.','evo') . '</div>';
		else:
			$new_post['post_content'] = $_REQUEST['body'];
		endif;
		
		if( $_FILES['image-attachment']['error'] ):
			$error = 1;
			$errormsg .= '<div class="error">' . __('Please attach a valid image (PNG, GIF, or JPG).','evo') . '</div>';
		else:

		endif;

		if( $error != 1 ):
		
			if( isset( $up_options->post_status ) )
				$new_post['post_status'] = $up_options->post_status;
			else
				$new_post['post_status'] = 'draft';
			
			if( $user_ID )
				$new_post['post_author'] = $user_ID;
			if( !empty($_REQUEST['cat']) )
				$new_post['post_category'] = explode(',',$_REQUEST['cat']);
			if( !empty($_REQUEST['tags']) )
				$new_post['tags_input'] = explode(',',$_REQUEST['tags']);
			
			$result = wp_insert_post( $new_post, true );
		
			if(is_wp_error($result))
				die($result->get_error_message());
			
			$post_ID = $result;
		
			$image_attachment = $_FILES['image-attachment'];
		
			$counter=0;
			foreach ($_FILES as $file): 
				$counter++;
				if ($file['tmp_name'] > ''): 
					
					$uploaded_file[$counter] = wp_upload_bits($file["name"], null, file_get_contents($file["tmp_name"]));
					
					if( !empty($uploaded_file[$counter]['error']) ):
						die($uploaded_file[$counter]['error']);
					else:
						
						$filename = $uploaded_file[$counter]['file'];
						
						$wp_filetype = wp_check_filetype(basename($filename), null );
						$attachment = array(
							 'post_mime_type' => $wp_filetype['type'],
							 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
							 'post_content' => '',
							 'post_status' => 'inherit'
						);
						$attach_id = wp_insert_attachment( $attachment, $filename, $post_ID);
						
						// you must first include the image.php file
						// for the function wp_generate_attachment_metadata() to work
						require_once(ABSPATH . "wp-admin" . '/includes/image.php');
						$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
						wp_update_attachment_metadata( $attach_id,  $attach_data );

						if( preg_match("/image/",$wp_filetype['type']) && !get_post_meta($post_ID,'_thumbnail_id',true) ):

							$thumbnail_html = wp_get_attachment_image( $attach_id, 'thumbnail' );
							if ( !empty($thumbnail_html) ) {
								update_post_meta( $post_ID, '_thumbnail_id', $attach_id );
							}
			
						endif;
														
					endif;
					
				endif;

			endforeach;
			
			if( $up_options->send_email == '1' ):
			
				$admin_email = get_option('admin_email');
				
				$title = __('New Submission from ','evo') . get_bloginfo('name');
				$body = __('A new submission has been created on ','evo') . get_bloginfo('name') . __('. Please visit ','evo') . get_bloginfo('url') . '/wp-admin/post.php?post=' . $post_ID . '&action=edit ' . __('to edit (or publish) this submission.','evo');
				
				wp_mail( $admin_email, $title, $body );
				
			endif;

			echo "<h1>" . $up_options->submission_accepted_title . "</h1>";
			echo "<p>" . $up_options->submission_accepted_message . "</p>";

		elseif( $error == 1 ):
		
			submission_form( $errormsg );
		
		endif;

	else:
		
			submission_form();

	endif;

else:

?>

                    <h1><?php echo $up_options->user_level_denied_title; ?></h1>
                    <p><?php echo $up_options->user_level_denied_message; ?></p>
                    
                    <?php if( !is_user_logged_in() ): ?>
          
                    <p><a class="button" href="<?php echo wp_login_url( get_permalink() ); ?>" title="Sign In"><?php _e('Sign In','evo'); ?></a></p>
                    
                    <?php endif; ?>

<?php

endif;

?>

	    </div>
    
	</div>

<?php wp_footer() ?>