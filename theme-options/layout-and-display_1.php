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

    array(  "name" => "Show Title on Grid Pages",
            "desc" => "Do you want to show post titles on pages where items are shown in a grid layout?",
            "id" => "show_title",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Show Excerpt on Grid Pages",
            "desc" => "Do you want to show post excerpts on pages where items are shown in a grid layout?",
            "id" => "show_excerpt",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Show Category on Single Posts",
            "desc" => "Do you want to show categories on single posts?",
            "id" => "show_single_category",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Show Author Information on Single Posts",
            "desc" => "Do you want to show author info on single posts?",
            "id" => "show_single_author",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Show Tags on Single Posts",
            "desc" => "Do you want to show tags on single posts?",
            "id" => "show_single_tags",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Show Content on Single Posts",
            "desc" => "Do you want to show content on single posts?",
            "id" => "show_single_content",
            "type" => "select",
			"default_text" => "No",
            "options" => array(
				"Yes" => true
			)),

    array(  "name" => "Index Insert Position",
            "desc" => "This allows for a widgetized area to be inserted in between your posts on the index page. Select the number of the post you'd like to insert a widgetized area after.",
            "id" => "insert_position",
            "type" => "select",
            "options" => array(
				"0" => 0,
				"1" => 1,
				"2" => 2,
				"3" => 3,
				"4" => 4,
				"5" => 5,
				"6" => 6,
				"7" => 7,
				"8" => 8,
				"9" => 9,
				"10" => 10,
				"11" => 11,
				"12" => 12,
				"13" => 13,
				"14" => 14,
				"15" => 15
			)),

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
    else:
        update_option('up_themes_'.UPTHEMES_SHORT_NAME, $default_options);
    endif;
endif;

render_options($options);


?>