<?php
/**
 * Site Navigation Template Part
 * 
 * Clean, accessible navigation using wp_nav_menu with G2O_Nav_Walker
 * 
 * @package g2o
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

// Only render if new nav is enabled
if (!G2O_NEW_NAV) {
	return;
}

// Determine Walker class based on version
$nav_version = G2O_NAV_VERSION;
$walker_class = ($nav_version === 'v2') ? 'G2O_Nav_Walker_V2' : 'G2O_Nav_Walker';

// Check if the Walker class exists, fallback to base walker
if (!class_exists($walker_class)) {
	$walker_class = 'G2O_Nav_Walker';
}

// Get menu locations
$primary_menu_location = 'primary_menu';
$utility_menu_location = 'utility_menu';

// Check if we have menus assigned to our locations
$has_primary_menu = has_nav_menu($primary_menu_location);
$has_utility_menu = has_nav_menu($utility_menu_location);

// Don't render anything if no menus are assigned
if (!$has_primary_menu && !$has_utility_menu) {
	return;
}
?>

<nav class="nav" role="navigation" aria-label="<?php esc_attr_e('Primary navigation', 'g2o'); ?>" data-nav="container">
	
	<?php if ($has_primary_menu) : ?>
		<!-- Desktop Navigation -->
		<div class="nav__desktop" data-nav="desktop">
			<?php
			wp_nav_menu(array(
				'theme_location'  => $primary_menu_location,
				'menu_class'      => 'nav__menu',
				'container'       => false,
				'fallback_cb'     => false,
				'walker'          => new $walker_class(),
				'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar" data-nav="menu">%3$s</ul>',
				'depth'           => 2, // Limit to 2 levels for performance
			));
			?>
		</div>

		<!-- Mobile Navigation Toggle -->
		<button 
			type="button" 
			class="nav__toggle" 
			data-nav="toggle"
			aria-expanded="false" 
			aria-controls="nav-mobile" 
			aria-label="<?php esc_attr_e('Open navigation menu', 'g2o'); ?>"
		>
			<span class="nav__toggle-icon" aria-hidden="true">
				<span class="nav__toggle-line"></span>
				<span class="nav__toggle-line"></span>
				<span class="nav__toggle-line"></span>
			</span>
			<span class="nav__toggle-text sr-only">
				<span data-nav="toggle-text-open"><?php esc_html_e('Menu', 'g2o'); ?></span>
				<span data-nav="toggle-text-close" hidden><?php esc_html_e('Close', 'g2o'); ?></span>
			</span>
		</button>

		<!-- Mobile Navigation Panel -->
		<div 
			id="nav-mobile" 
			class="nav__mobile" 
			data-nav="mobile"
			role="dialog"
			aria-modal="true"
			aria-labelledby="nav-mobile-title"
			aria-hidden="true"
		>
			<!-- Mobile header -->
			<div class="nav__mobile-header">
				<h2 id="nav-mobile-title" class="nav__mobile-title sr-only">
					<?php esc_html_e('Navigation Menu', 'g2o'); ?>
				</h2>
				
				<!-- G2O Logo - clickable home link -->
				<a href="<?php echo esc_url(home_url('/')); ?>" class="nav__mobile-logo" aria-label="<?php esc_attr_e('Go to homepage', 'g2o'); ?>">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/g2o-logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="nav__mobile-logo-svg" width="84" height="32">
					</a>

				<button 
					type="button" 
					class="nav__mobile-close" 
					data-nav="close"
					aria-label="<?php esc_attr_e('Close navigation menu', 'g2o'); ?>"
				>
					<span class="nav__close-icon" aria-hidden="true">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</span>
				</button>
			</div>

			<!-- Mobile menu content -->
			<div class="nav__mobile-content">
				<?php
				wp_nav_menu(array(
					'theme_location'  => $primary_menu_location,
					'menu_class'      => 'nav__mobile-menu nav__mobile-menu--accordion',
					'container'       => false,
					'fallback_cb'     => false,
					'walker'          => new $walker_class(),
					'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menu" data-mobile-menu="accordion">%3$s</ul>',
					'depth'           => 2,
				));
				?>

				<?php if ($has_utility_menu) : ?>
					<!-- Utility menu in mobile -->
					<div class="nav__mobile-utility">
						<?php
						wp_nav_menu(array(
							'theme_location'  => $utility_menu_location,
							'menu_class'      => 'nav__utility-menu',
							'container'       => false,
							'fallback_cb'     => false,
							'walker'          => new $walker_class(),
							'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
							'depth'           => 1, // Keep utility simple
						));
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- Mobile backdrop -->
		<div class="nav__backdrop" data-nav="backdrop" aria-hidden="true"></div>

	<?php endif; ?>

	<?php if ($has_utility_menu) : ?>
		<!-- Desktop Utility Menu -->
		<div class="nav__utility" data-nav="utility">
			<?php
			wp_nav_menu(array(
				'theme_location'  => $utility_menu_location,
				'menu_class'      => 'nav__utility-menu',
				'container'       => false,
				'fallback_cb'     => false,
				'walker'          => new $walker_class(),
				'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
				'depth'           => 1,
			));
			?>
		</div>
	<?php endif; ?>

</nav>