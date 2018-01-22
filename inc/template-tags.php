<?php
/**
 * Alexander Georgiev (www.ageorgiev.com) - Extra functions
 * 
 * @package one-minmal
 */
function meta_tags() {		
echo '
<ul class="meta">
	<li class="post-date">';
if(is_singular('jetpack-portfolio')) :?>
	<strong>Date</strong>
<?php endif; ?><?php echo '<i class="fa fa-calendar"></i> <a title="Posted at '.get_the_date("G:i").'"><time itemprop="datePublished" datetime="'.get_the_date('Y-m-d H:i:s').'">'.get_the_date().'</time></a>
	<span class="sr-only datemodified" itemprop="dateModified">'.get_the_modified_date('Y-m-d H:i:s').'</span>
	</li>
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="sr-only">
	<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
      <meta itemprop="url" content="'.get_header_image().'">
      <meta itemprop="width" content="600">
      <meta itemprop="height" content="60">
    </div>
	<meta itemprop="name" content="'.get_bloginfo('name').'">
	</div>
	<li class="post-views">';
	if(is_singular('jetpack-portfolio')) :?>
	<strong>Views</strong>
	<?php endif;
	echo ''.postViews(get_the_ID()).'</li>';
if ( has_category() ) {
echo '<li itemprop="genre">'.get_the_category_list().'</li>';
$tag_list      = get_the_tag_list('', __(', ', 'one-minimal'));
	if ($tag_list) {
		one_minimal_post_tags($tag_list);
	}
}
elseif (is_singular('jetpack-portfolio')) {
	echo '<li><strong>Services</strong> <span itemprop="genre">'.get_the_term_list(get_the_ID(), 'jetpack-portfolio-type', '', ', ', '').'</span></li>';
	echo '<li><strong>Skills</strong> <span itemprop="inLanguage">'.get_the_term_list(get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '').'</span></li>';
}
echo '</ul>';
}

function postViews($post_ID) {
 
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count'; 
     
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
     
    //If the the Post Custom Field value is empty. 
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post. 
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
       return ' <i class="fa fa-eye"></i> ' .$count . ' View';
     
    //If the the Post Custom Field value is NOT empty.
    }
    else {
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
       return '<i class="fa fa-eye"></i> ' .$count . ' View';
        }
        //In all other cases return (count) Views
        else {
        return ' <i class="fa fa-eye"></i> ' .$count . ' Views';
        }
    }
}

if (!function_exists('bootstrapBasicFullPageSearchForm')) {
	/**
	 * Display full page search form
	 * 
	 * @return string the search form element
	 */
	function bootstrapBasicFullPageSearchForm() 
	{
		$output = '<form class="row search-form row" method="get" action="' . esc_url(home_url('/')) . '" role="form">';
		
		$output .= '<div class="col-md-10 col-sm-8">';
		$output .= '<label for="search" class="sr-only">Password</label>';
		$output .= '<input type="text" name="s" value="' . esc_attr(get_search_query()) . '" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder', 'one-minimal') . '" title="' . esc_attr_x('Search for', 'label', 'one-minimal') . '" class="form-control form-control-lg" />';
		$output .= '</div>';
		$output .= '<div class="col-md-2 col-sm-4">';
		$output .= '<button type="submit" class="btn btn-primary btn-block">' . __('Search', 'one-minimal') . '</button></div>';
		
		$output .= '</form>';

		return $output;
	}// bootstrapBasicFullPageSearchForm
}



if (!function_exists('one_minimal_post_tags')) {
	/**
	 * display tags list
	 * 
	 * @param string $tags_list
	 * @return string
	 */
	function one_minimal_post_tags($tags_list = '') 
	{
		echo get_the_tag_list('<ul class="list-inline tag-list"><li>','</li><li>','</li></ul>');
	}// one_minimal_post_tags
}

/* 
		this function shows how to create a simple two way relationship field
		the example assumes that you are using either a single relationship field
		where posts of the same type are related or you can have 2 relationship
		fields on two different post types. this example also assumes that
		the relationship field(s) do not impose any limits on the number
		of selections
		
		The concept covered in this file has also been coverent on the ACF site
		on this page https://www.advancedcustomfields.com/resources/bidirectional-relationships/
		The example shown there is very similar, but requires but is created to work
		where the field name is the same, similar to my plugin that does this.
		This example will let you have fields of different names
	*/
	
	// add the filter for your relationship field
	add_filter('acf/update_value/key=field_565b126351f32', 'acf_reciprocal_relationship', 10, 3);
	// if you are using 2 relationship fields on different post types
	// add second filter for that fields as well
	add_filter('acf/update_value/key=field_58f8a18afda1f', 'acf_reciprocal_relationship', 10, 3);
	
	function acf_reciprocal_relationship($value, $post_id, $field) {
		
		// set the two fields that you want to create
		// a two way relationship for
		// these values can be the same field key
		// if you are using a single relationship field
		// on a single post type
		
		// the field key of one side of the relationship
		$key_a = 'field_565b126351f32';
		// the field key of the other side of the relationship
		// as noted above, this can be the same as $key_a
		$key_b = 'field_58f8a18afda1f';
		
		// figure out wich side we're doing and set up variables
		// if the keys are the same above then this won't matter
		// $key_a represents the field for the current posts
		// and $key_b represents the field on related posts
		if ($key_a != $field['key']) {
			// this is side b, swap the value
			$temp = $key_a;
			$key_a = $key_b;
			$key_b = $temp;
		}
		
		// get both fields
		// this gets them by using an acf function
		// that can gets field objects based on field keys
		// we may be getting the same field, but we don't care
		$field_a = get_field_object($key_a);
		$field_b = get_field_object($key_b);
		
		// set the field names to check
		// for each post
		$name_a = $field_a['name'];
		$name_b = $field_b['name'];
		
		// get the old value from the current post
		// compare it to the new value to see
		// if anything needs to be updated
		// use get_post_meta() to a avoid conflicts
		$old_values = get_post_meta($post_id, $name_a, true);
		// make sure that the value is an array
		if (!is_array($old_values)) {
			if (empty($old_values)) {
				$old_values = array();
			} else {
				$old_values = array($old_values);
			}
		}
		// set new values to $value
		// we don't want to mess with $value
		$new_values = $value;
		// make sure that the value is an array
		if (!is_array($new_values)) {
			if (empty($new_values)) {
				$new_values = array();
			} else {
				$new_values = array($new_values);
			}
		}
		
		// get differences
		// array_diff returns an array of values from the first
		// array that are not in the second array
		// this gives us lists that need to be added
		// or removed depending on which order we give
		// the arrays in
		
		// this line is commented out, this line should be used when setting
		// up this filter on a new site. getting values and updating values
		// on every relationship will cause a performance issue you should
		// only use the second line "$add = $new_values" when adding this
		// filter to an existing site and then you should switch to the
		// first line as soon as you get everything updated
		// in either case if you have too many existing relationships
		// checking end updated every one of them will more then likely
		// cause your updates to time out.
		//$add = array_diff($new_values, $old_values);
		$add = $new_values;
		$delete = array_diff($old_values, $new_values);
		
		// reorder the arrays to prevent possible invalid index errors
		$add = array_values($add);
		$delete = array_values($delete);
		
		if (!count($add) && !count($delete)) {
			// there are no changes
			// so there's nothing to do
			return $value;
		}
		
		// do deletes first
		// loop through all of the posts that need to have
		// the recipricol relationship removed
		for ($i=0; $i<count($delete); $i++) {
			$related_values = get_post_meta($delete[$i], $name_b, true);
			if (!is_array($related_values)) {
				if (empty($related_values)) {
					$related_values = array();
				} else {
					$related_values = array($related_values);
				}
			}
			// we use array_diff again
			// this will remove the value without needing to loop
			// through the array and find it
			$related_values = array_diff($related_values, array($post_id));
			// insert the new value
			update_post_meta($delete[$i], $name_b, $related_values);
			// insert the acf key reference, just in case
			update_post_meta($delete[$i], '_'.$name_b, $key_b);
		}
		
		// do additions, to add $post_id
		for ($i=0; $i<count($add); $i++) {
			$related_values = get_post_meta($add[$i], $name_b, true);
			if (!is_array($related_values)) {
				if (empty($related_values)) {
					$related_values = array();
				} else {
					$related_values = array($related_values);
				}
			}
			if (!in_array($post_id, $related_values)) {
				// add new relationship if it does not exist
				$related_values[] = $post_id;
			}
			// update value
			update_post_meta($add[$i], $name_b, $related_values);
			// insert the acf key reference, just in case
			update_post_meta($add[$i], '_'.$name_b, $key_b);
		}
		
		return $value;
		
	} // end function acf_reciprocal_relationship