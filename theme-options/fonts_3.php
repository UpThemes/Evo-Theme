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

    array(  "name" => "Select Primary Font Stack",
            "desc" => "Select the desired font stack for primary headings and text from the drop-down to the right.",
            "id" => "primary_font",
            "type" => "select",
						"default_text" => 'Default',
						"options" => array(
							'Franchise, Helvetica, Arial, Tahoma, sans-serif' => 1,
							'"Winterthur Condensed", Helvetica, Arial, Tahoma, sans-serif' => 2,
							'"Yanone Kaffeesatz Regular", Helvetica, Arial, Tahoma, sans-serif' => 3,
							'"Bebas Neue", Helvetica, Arial, Tahoma, sans-serif' => 4,
							'Helvetica, Arial, Tahoma, Verdana, sans-serif' => 5,
							'Garamond, Avant Garde, Palatino, "Times New Roman", serif' => 6
						))

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