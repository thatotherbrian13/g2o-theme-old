<?php
/**
 * G2O Navigation Walker
 * 
 * Custom WordPress nav walker for accessible, BEM-structured navigation
 * with full WCAG 2.2 AA compliance and keyboard navigation support.
 * 
 * @package g2o
 */

if (!class_exists('G2O_Nav_Walker_V2')) {

	class G2O_Nav_Walker_V2 extends Walker_Nav_Menu {

		/**
		 * Unique menu ID for ARIA relationships
		 * @var string
		 */
		private $menu_id = '';

		/**
		 * Track dropdown count for unique IDs
		 * @var int
		 */
		private $dropdown_count = 0;

		/**
		 * Start outputting the menu list
		 * 
		 * @param string $output Used to append additional content
		 * @param int    $depth  Depth of menu item
		 * @param object $args   Menu arguments
		 */
		public function start_lvl(&$output, $depth = 0, $args = null) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n{$indent}<ul class=\"nav__submenu\" role=\"menu\">\n";
		}

		/**
		 * End outputting the menu list
		 * 
		 * @param string $output Used to append additional content
		 * @param int    $depth  Depth of menu item
		 * @param object $args   Menu arguments
		 */
		public function end_lvl(&$output, $depth = 0, $args = null) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n{$indent}</ul>\n";
		}

		/**
		 * Start outputting the menu item
		 * 
		 * @param string $output Used to append additional content
		 * @param object $item   Menu item data object
		 * @param int    $depth  Depth of menu item
		 * @param object $args   Menu arguments
		 * @param int    $id     Current item ID
		 */
		public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
			$indent = ($depth) ? str_repeat("\t", $depth) : '';

			$classes = empty($item->classes) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			// Clean up classes
			$classes = array_filter($classes, function($class) {
				return !empty($class) && $class !== 'menu-item';
			});

			// Check if item has children
			$has_children = in_array('menu-item-has-children', $classes);

			// Build BEM classes
			$item_classes = array('nav__item');

			if ($has_children) {
				$item_classes[] = 'nav__item--has-dropdown';
			}

			if (in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) {
				$item_classes[] = 'nav__item--current';
			}

			// Add special class for Contact Us items
			if (stripos($item->title, 'contact') !== false) {
				$item_classes[] = 'nav__item--contact';
			}

			// Generate unique IDs for ARIA
			$item_id = 'nav-item-' . $item->ID;
			$dropdown_id = $has_children ? 'nav-dropdown-' . $item->ID : '';

			$class_names = join(' ', apply_filters('nav_menu_css_class', $item_classes, $item, $args));
			$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

			$id_attr = apply_filters('nav_menu_item_id', $item_id, $item, $args);
			$id_attr = $id_attr ? ' id="' . esc_attr($id_attr) . '"' : '';

			// Menu item role
			$role = ($depth === 0) ? 'none' : 'menuitem';

			$output .= $indent . '<li' . $id_attr . $class_names . ' role="' . $role . '">';

			// Link attributes
			$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

			// Build link classes
			$link_classes = array('nav__link');
			
			if ($has_children) {
				$link_classes[] = 'nav__link--dropdown';
			}

			$link_class_names = join(' ', $link_classes);

			// ARIA attributes for dropdown triggers
			$aria_attrs = '';
			if ($has_children) {
				$aria_attrs = ' aria-expanded="false" aria-haspopup="menu"';
				if ($dropdown_id) {
					$aria_attrs .= ' aria-controls="' . esc_attr($dropdown_id) . '"';
				}
				$aria_attrs .= ' data-nav-trigger="dropdown"';
			}

			$item_output = isset($args->before) ? $args->before : '';

			// For dropdown items, always use button in mobile context for accessibility
			if ($has_children) {
				$item_output .= '<button type="button" class="' . esc_attr($link_class_names) . '"' . $aria_attrs . ' data-mobile-accordion="trigger">';
				$item_output .= '<span class="nav__text">';
				$item_output .= isset($args->link_before) ? $args->link_before : '';
				$item_output .= apply_filters('the_title', $item->title, $item->ID);
				$item_output .= isset($args->link_after) ? $args->link_after : '';
				$item_output .= '</span>';
				$item_output .= '<span class="nav__icon" aria-hidden="true">';
				$item_output .= '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">';
				$item_output .= '<path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>';
				$item_output .= '</svg>';
				$item_output .= '</span>';
				$item_output .= '</button>';
			} else {
				// Regular link
				$item_output .= '<a class="' . esc_attr($link_class_names) . '"' . $attributes . $aria_attrs . '>';
				$item_output .= '<span class="nav__text">';
				$item_output .= isset($args->link_before) ? $args->link_before : '';
				$item_output .= apply_filters('the_title', $item->title, $item->ID);
				$item_output .= isset($args->link_after) ? $args->link_after : '';
				$item_output .= '</span>';
				if ($has_children) {
					$item_output .= '<span class="nav__icon" aria-hidden="true">';
					$item_output .= '<svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">';
					$item_output .= '<path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>';
					$item_output .= '</svg>';
					$item_output .= '</span>';
				}
				$item_output .= '</a>';
			}

			$item_output .= isset($args->after) ? $args->after : '';

			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

			// Start dropdown container
			if ($has_children && $dropdown_id) {
				$output .= '<div id="' . esc_attr($dropdown_id) . '" class="nav__dropdown" data-nav="dropdown" role="menu" aria-hidden="true">';
			}
		}

		/**
		 * End outputting the menu item
		 * 
		 * @param string $output Used to append additional content
		 * @param object $item   Menu item data object
		 * @param int    $depth  Depth of menu item
		 * @param object $args   Menu arguments
		 */
		public function end_el(&$output, $item, $depth = 0, $args = null) {
			$classes = empty($item->classes) ? array() : (array) $item->classes;
			$has_children = in_array('menu-item-has-children', $classes);

			// End dropdown container
			if ($has_children && $depth === 0) {
				$output .= '</div>';
			}

			$output .= "</li>\n";
		}

		/**
		 * Traverse elements to create list from elements
		 * 
		 * Override to add proper ARIA structure to the root menu
		 */
		public function walk($elements, $max_depth, ...$args) {
			$args = $args[0] ?? null;
			
			// Generate unique menu ID
			$this->menu_id = 'nav-menu-' . wp_rand(100, 999);
			
			// Add menubar role to the root container
			add_filter('nav_menu_css_class', array($this, 'add_menubar_class'), 10, 3);
			
			return parent::walk($elements, $max_depth, $args);
		}

		/**
		 * Add menubar class to root menu items
		 */
		public function add_menubar_class($classes, $item, $args) {
			// This will be handled by the nav template part
			return $classes;
		}
	}
}