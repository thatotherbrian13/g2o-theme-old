<?php
/**
 * https://awhitepixel.com/blog/wordpress-menu-walkers-tutorial/
 */


/*
if ( !class_exists('Footer_Nav_Walker') ) {
	class Footer_Nav_Walker extends Walker_Nav_Menu {

		function start_lvl( &$output, $depth = 0, $args = null ) {
			$output = "<div class='grid grid-cols-6 gap-x-2.5'>";
		}

		function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
			$output .= "<div class='col-span-2'>";

				if ($item->url && $item->url != '#') {
					$output .= "<div class='h6'><a href='{$item->url}'>";
				} else {
					$output .= "<div class='h6'>";
				}

				$output .= $item->title;

				if ($item->url && $item->url != '#') {
					$output .= '</a></div>';
				} else {
					$output .= '</div>';
				}

				$output .= "<p>" . $item->description . "</p>";
			$output .= "</div>";
		}

		function end_lvl( &$output, $depth = 0, $args = null ) {
			$output = "</div>";
		}

	}
}
*/



class Footer_Menu_Walker extends Walker_Nav_Menu {

	// Outputs the HTML for the start of a new level (the opening <ul> tag).
	function start_lvl(&$output, $depth=0, $args=null) {
//		$output = "";
	}

	// Outputs each element's HTML (the opening <li> and the <a> tag with the link title/label).
	function start_el(&$output, $item, $depth=0, $args=null, $id=0) {


		$item_class = ($args->item_class) ? $args->item_class : '';
		$output .= "<div class='" . $item_class .  implode(" ", $item->classes) . "'>";

		$link_class = ($args->link_class) ? $args->link_class : '';
		if ($item->url && $item->url != '#') {
			$output .= "<a class='" . $link_class . "' href='" . $item->url . "'>";
		} else {
			$output .= "<span class='" . $link_class . "'>";
		}

		$output .= "<span class='kicker text-sky mb-5'>" . $item->title . "</span>";


		// Include the link description.
		if ($depth == 0 && !empty($item->description)) {
			$output .= '<span class="description">' . $item->description . '</span>';
		}


		if ($item->url && $item->url != '#') {
			$output .= "</a>";
		} else {
			$output .= "</span>";
		}

	}

	// Outputs the closing of an element (the closing </li> tag).
	function end_el(&$output, $item, $depth=0, $args=null) {
			$output .= "</div>";
	}

	// Outputs the HTML for the end of a level (the closing </ul> tag).
	function end_lvl(&$output, $depth=0, $args=null) {
//		$output .= "";
	}

	// Inherited function from the general Walker class, responsible for traversing.
	// This is the function that calls all of the above functions in turn.
	// If you want to prevent traversing a whole branch, use this function for that.
	// function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
	// }

}


/*
wp_nav_menu([
	'walker' => new Solutions_Menu_Walker(),
]);
*/






/*
class Footer_Menu_Walker extends Walker_Nav_Menu {

	// Outputs the HTML for the start of a new level (the opening <ul> tag).
	function start_lvl(&$output, $depth=0, $args=null) {
	}

	// Outputs each element's HTML (the opening <li> and the <a> tag with the link title/label).
	function start_el(&$output, $item, $depth=0, $args=null, $id=0) {

		$output .= "<div class='" .  implode(" ", $item->classes) . "'>";

		$link_class = ($args->link_class) ? $args->link_class : '';
		if ($item->url && $item->url != '#') {
			$output .= "<a class='" . $link_class . "' href='" . $item->url . "'>";
		} else {
			$output .= "<span class='" . $link_class . "'>";
		}


		$output .= "<span class='h6 mb-5'>" . $item->title . "</span>";


		// Include the link description.
		if ($depth == 0 && !empty($item->description)) {
			$output .= '<span class="description">' . $item->description . '</span>';
		}

		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		$output .= "</div>";


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
*/


/*
wp_nav_menu([
	'walker' => new Footer_Menu_Walker(),
]);
*/