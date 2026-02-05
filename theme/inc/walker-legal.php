<?php
/**
 * https://awhitepixel.com/blog/wordpress-menu-walkers-tutorial/
 */

class Legal_Menu_Walker extends Walker_Nav_Menu {

	// Outputs the HTML for the start of a new level (the opening <ul> tag).
	function start_lvl(&$output, $depth=0, $args=null) {
	}

	// Outputs each element's HTML (the opening <li> and the <a> tag with the link title/label).
	function start_el(&$output, $item, $depth=0, $args=null, $id=0) {

		$item_class = ($args->item_class) ? $args->item_class : '';
		$output .= "<li class='" . $item_class .  implode(" ", $item->classes) . "'>";

		$link_class = ($args->link_class) ? $args->link_class : '';
		if ($item->url && $item->url != '#') {
			$output .= "<a class='" . $link_class . "' href='" . $item->url . "'>";
		} else {
			$output .= "<span class='" . $link_class . "'>";
		}


		$output .= $item->title;

		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}

	// Outputs the closing of an element (the closing </li> tag).
	function end_el(&$output, $item, $depth=0, $args=null) {
	}

	// Outputs the HTML for the end of a level (the closing </ul> tag).
	function end_lvl(&$output, $depth=0, $args=null) {
	}

	// Inherited function from the general Walker class, responsible for traversing.
	// This is the function that calls all of the above functions in turn.
	// If you want to prevent traversing a whole branch, use this function for that.
	// function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
	// }

}


/*
wp_nav_menu([
	'walker' => new Legal_Menu_Walker(),
]);
*/