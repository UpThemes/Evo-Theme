<?php

//Upload Security
$upload_security = md5($_SERVER['SERVER_ADDR']);
$uploaddir = base64_decode( $_REQUEST['upload_path'] ) . "/";

if( $_FILES[$upload_security] ):

	$file = $_FILES[$upload_security];

	$file = $uploaddir . strtolower( preg_replace( array('/[^\w\(\).-]/i','/(_)\1+/') ,'_' , basename($file['name']) ) );
	
		if( file_exists( $file ) ):
			    echo "success"; 
		elseif (move_uploaded_file( $_FILES[$upload_security]['tmp_name'], $file)):
			if(chmod($file,0777)):
			    echo "success"; 
			else:
				echo "error".$_FILES[$upload_security]['tmp_name'];
			endif;
		else:
		    echo "error".$_FILES[$upload_security]['tmp_name'];
		endif;

endif;

?>