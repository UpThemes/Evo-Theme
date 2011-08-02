<?php
/*  Array Options:
   
   name (string)
   desc (string)
   id (string)
   type (string) - text, color, image, select, multiple, textarea, page, pages, category, categories
   value (string) - default value - replaced when custom value is entered - (text, color, select, textarea, page, category)
   options (array)
   attr (array) - any form field attributes
   url (string) - for image type only - defines the default image
    
*/

$options = array (

    array(  "name" => "Twitter",
            "desc" => "Add your Twitter username (without the @ please). This is used when someone tweets one of your entries.",
            "id" => "twitter",
            "type" => "text"),
    
    array(  "name" => "Feedburner",
            "desc" => "Add your username to redirect RSS feeds to Feedburner",
            "id" => "feedburner",
            "type" => "text"),

    array(  "name" => "Footer Text",
            "desc" => "Enter the text you'd like to have in the footer.",
            "id" => "footertext",
            "type" => "textarea",
            "value" => "&copy; Copyright ".date('Y').' - '.get_bloginfo('name')."",
            "attr" => array("rows" => "8"))
);

/* ------------ Do not edit below this line ----------- */

//Check if theme options set
global $default_check;
global $default_options;

if(!$default_check):
    foreach($options as $option):
        if($option['type'] != 'image'):
            $default_options[$option['id']] = $option['value'];
        else:
            $default_options[$option['id']] = $option['url'];
        endif;
    endforeach;
    $update_option = get_option('up_themes_'.UPTHEMES_SHORT_NAME);
    if(is_array($update_option)):
        $update_option = array_merge($update_option, $default_options);
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $update_option);
		set_thumbnail_h_w(); // set thumbnail height and width
		update_option('medium_size_w',500);
		update_option('medium_size_h',375);
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);

?>