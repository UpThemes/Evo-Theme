<?php

// create bullet-proof excerpt for meta name="description"

function evo_trim_excerpt($text) {
	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);
	  $text = str_replace('"', '\'', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}
	}
	return $text;
}

function evo_the_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	$output = str_replace('"', '\'', $output);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.','evo');
		return $output;
	}

	return $output;
	
}

function evo_excerpt_rss() {
	global $post;
	$output = '';
	$output = strip_tags($post->post_excerpt);
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.','evo');
		return $output;
}

	return apply_filters('evo_excerpt_rss', $output);

}

add_filter('evo_excerpt_rss', 'evo_trim_excerpt');

// create nice multi_tag_title
// Credits: Martin Kopischke for providing this code

function evo_tag_query() {
	$nice_tag_query = get_query_var('tag'); // tags in current query
	$nice_tag_query = str_replace(' ', '+', $nice_tag_query); // get_query_var returns ' ' for AND, replace by +
	$tag_slugs = preg_split('%[,+]%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of tag slugs
	$tag_ops = preg_split('%[^,+]*%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of operators

	$tag_ops_counter = 0;
	$nice_tag_query = '';

	foreach ($tag_slugs as $tag_slug) { 
		$tag = get_term_by('slug', $tag_slug ,'post_tag');
		// prettify tag operator, if any
		if ($tag_ops[$tag_ops_counter] == ',') {
			$tag_ops[$tag_ops_counter] = ', ';
		} elseif ($tag_ops[$tag_ops_counter] == '+') {
			$tag_ops[$tag_ops_counter] = ' + ';
		}
		// concatenate display name and prettified operators
		$nice_tag_query = $nice_tag_query.$tag->name.$tag_ops[$tag_ops_counter];
		$tag_ops_counter += 1;
	}
	 return $nice_tag_query;
}

// Returns the distance of time in words between two dates
function distance_of_time_in_words($from_time, $to_time = null, $include_seconds = false)
{
  $to_time = $to_time? $to_time: time();
 
  $distance_in_minutes = floor(abs($to_time - $from_time) / 60);
  $distance_in_seconds = floor(abs($to_time - $from_time));
 
  $string = '';
  $parameters = array();
 
  if ($distance_in_minutes <= 1)
  {
    if (!$include_seconds)
    {
      $string = $distance_in_minutes == 0 ? 'less than a minute' : '1 minute';
    }
    else
    {
      if ($distance_in_seconds <= 5)
      {
        $string = 'less than 5 seconds';
      }
      else if ($distance_in_seconds >= 6 && $distance_in_seconds <= 10)
      {
        $string = 'less than 10 seconds';
      }
      else if ($distance_in_seconds >= 11 && $distance_in_seconds <= 20)
      {
        $string = 'less than 20 seconds';
      }
      else if ($distance_in_seconds >= 21 && $distance_in_seconds <= 40)
      {
        $string = 'half a minute';
      }
      else if ($distance_in_seconds >= 41 && $distance_in_seconds <= 59)
      {
        $string = 'less than a minute';
      }
      else
      {
        $string = '1 minute';
      }
    }
  }
  else if ($distance_in_minutes >= 2 && $distance_in_minutes <= 44)
  {
    $string = '%minutes% minutes';
    $parameters['%minutes%'] = $distance_in_minutes;
  }
  else if ($distance_in_minutes >= 45 && $distance_in_minutes <= 89)
  {
    $string = 'about 1 hour';
  }
  else if ($distance_in_minutes >= 90 && $distance_in_minutes <= 1439)
  {
    $string = 'about %hours% hours';
    $parameters['%hours%'] = round($distance_in_minutes / 60);
  }
  else if ($distance_in_minutes >= 1440 && $distance_in_minutes <= 2879)
  {
    $string = '1 day';
  }
  else if ($distance_in_minutes >= 2880 && $distance_in_minutes <= 43199)
  {
    $string = '%days% days';
    $parameters['%days%'] = round($distance_in_minutes / 1440);
  }
  else if ($distance_in_minutes >= 43200 && $distance_in_minutes <= 86399)
  {
    $string = 'about 1 month';
  }
  else if ($distance_in_minutes >= 86400 && $distance_in_minutes <= 525959)
  {
    $string = '%months% months';
    $parameters['%months%'] = round($distance_in_minutes / 43200);
  }
  else if ($distance_in_minutes >= 525960 && $distance_in_minutes <= 1051919)
  {
    $string = 'about 1 year';
  }
  else
  {
    $string = 'over %years% years';
    $parameters['%years%'] = floor($distance_in_minutes / 525960);
  }
 
  return strtr($string, $parameters);
}

?>