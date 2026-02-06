<?php
/**
 * Site Header Template Part
 * 
 * Modern, accessible header with logo, navigation, and utility areas
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

// Get theme settings
$page_theme = get_field('page_theme');
$theme_class = 'page-theme-dark'; // Default

if ($page_theme) {
	$theme_class = ($page_theme === 'light') ? 'page-theme-light' : 'page-theme-dark';
}
?>

<!-- Skip navigation link for keyboard accessibility -->
<a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[10000] focus:bg-river focus:text-white focus:px-4 focus:py-3 focus:rounded focus:no-underline focus:font-bold">
	<?php esc_html_e('Skip to main content', 'g2o'); ?>
</a>

<header id="site-header" class="header <?php echo esc_attr($theme_class); ?>" role="banner" data-header="container">
	
	<!-- Header background for backdrop effects -->
	<div class="header__backdrop" data-header="backdrop" aria-hidden="true"></div>
	
	<!-- Main header content -->
	<div class="header__container">
		<div class="header__inner">
			
			<!-- Logo/Brand -->
			<div class="header__brand" data-header="brand">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name') . ' - ' . __('Go to homepage', 'g2o')); ?>">
					<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/g2o-logo.svg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="header__logo-svg" width="84" height="32">
						</a>
			</div>

			<!-- Primary Navigation -->
			<div class="header__navigation" data-header="nav">
				<?php get_template_part('template-parts/navigation/site-nav'); ?>
			</div>

			<!-- Header Actions (Search, CTA, etc.) -->
			<div class="header__actions" data-header="actions">
				<?php
				// Optional: Add search button, CTA button, or other header actions
				
				// Example search toggle (uncomment if needed):
				/*
				<button type="button" class="header__search-toggle" data-header="search-toggle" aria-label="<?php esc_attr_e('Open search', 'g2o'); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
						<path d="21 21L16.65 16.65" stroke="currentColor" stroke-width="2"/>
					</svg>
				</button>
				*/

				// Example CTA button (uncomment if needed):
				/*
				$header_cta = get_field('header_cta', 'option');
				if ($header_cta && !empty($header_cta['url'])) :
				?>
					<a href="<?php echo esc_url($header_cta['url']); ?>" 
					   class="header__cta btn btn--primary" 
					   <?php echo $header_cta['target'] ? 'target="_blank" rel="noopener"' : ''; ?>>
						<?php echo esc_html($header_cta['title']); ?>
					</a>
				<?php 
				endif;
				*/
				?>
			</div>

		</div>
	</div>
	
	<!-- Sticky header indicator -->
	<div class="header__sentinel" data-header="sentinel" aria-hidden="true"></div>
	
</header>