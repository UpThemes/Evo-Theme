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
    
    array(  "name" => "Color Scheme",
            "desc" => "Select the color scheme you want to use.",
            "id" => "style",
            "type" => "select",
			"default_text" => "Default",
            "options" => array(
						 "Blue Theme" => "blue",
						 "Dark Theme" => "dark"
						 )
    ),
    
    array(  "name" => "Logo Image",
            "desc" => "Upload your own image or select from the gallery.",
            "id" => "logo",
            "type" => "image",
            "value" => "Upload Your Logo",
			"url" => get_bloginfo('wpurl')."/wp-content/themes/evo/images/default-logo.png"
    ),
    
    array(  "name" => "Default Link Color",
            "desc" => "Select a custom link color for the default state.",
            "id" => "linkcolor",
            "type" => "color"
    ),
    
    array(  "name" => "Hover Link Color",
            "desc" => "Select a custom link color for the hover state.",
            "id" => "hovercolor",
            "type" => "color"
    ),
	array(  "name" => "Active Link Color",
            "desc" => "Select a custom link color for the hover state.",
            "id" => "activecolor",
            "type" => "color"
    )
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