<?php
/**
 * Template Name: Brand Guide
 *
 * Unified style and component documentation.
 * Combines typography, colors, helper classes with stack components.
 *
 * @package g2o
 */

// Password protection - requires WP page to have password set in admin
if ( post_password_required() ) {
	get_header();
	echo '<div style="min-height:60vh;display:flex;align-items:center;justify-content:center;padding:40px;">';
	echo '<div style="max-width:400px;width:100%;">';
	echo '<h1 style="font-family:\'Work Sans\',sans-serif;font-size:24px;margin-bottom:20px;color:#234253;">Brand Guide</h1>';
	echo '<p style="font-family:\'Work Sans\',sans-serif;color:#606969;margin-bottom:20px;">This page is for internal use only. Please enter the password to continue.</p>';
	echo get_the_password_form();
	echo '</div>';
	echo '</div>';
	get_footer();
	return;
}

// Include the Stack Guide data class
require_once get_template_directory() . '/theme/inc/class-stack-guide-data.php';

// Get all stack configurations
$stacks = G2O_Stack_Guide::get_all_stacks();

// Group stacks by category
$categories = [
	'Heroes & Banners' => ['banner', 'banner_data_ai', 'billboard', 'profile_banner', 'lead', 'story'],
	'Content Blocks' => ['content', 'columns', 'card_grid', 'checklist', 'three_columns', 'spread', 'slabs', 'blockquote', 'quote', 'testimonial', 'steps', 'scroller'],
	'CTAs & Forms' => ['cta', 'form', 'gravity_form', 'hubspot_form', 'subscribe', 'tout'],
	'Carousels & Lists' => ['carousel', 'slideshow', 'marquee', 'accordion', 'pillars', 'process', 'graphs', 'video'],
	'People & Teams' => ['author', 'authors', 'team'],
	'Solutions' => ['capabilities', 'expertise', 'industries', 'solutions', 'banking_solutions', 'public_sector_solutions'],
	'Posts & Media' => ['featured_post', 'related', 'projects', 'jobs', 'image', 'study'],
];

// Count total stacks
$total_stacks = 0;
foreach ($categories as $cat_stacks) {
	foreach ($cat_stacks as $key) {
		if (isset($stacks[$key])) $total_stacks++;
	}
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brand Guide - G2O</title>
	<?php wp_head(); ?>
	<!-- CRITICAL: These styles MUST come after wp_head() to override theme CSS -->
	<style>
		/* ============================================================
		   BRAND GUIDE - Full Width with Collapsible Nav
		   ============================================================ */

		/* NUCLEAR: Reset ALL possible constraints */
		html,
		html body,
		html body.brand-guide-page,
		body.brand-guide-page,
		body.brand-guide-page *:not(.catalog-nav-grid):not(.catalog-nav-category):not(.catalog-nav-category *):not(.styles-content *):not(.color-grid):not(.color-card):not(.color-card *):not(.style-sample):not(.style-sample *),
		body.brand-guide-page #page,
		body.brand-guide-page #content,
		body.brand-guide-page #primary,
		body.brand-guide-page #main,
		body.brand-guide-page .site,
		body.brand-guide-page .site-content,
		body.brand-guide-page .content-area,
		body.brand-guide-page .entry-content,
		body.brand-guide-page > div,
		body.brand-guide-page > main,
		body.brand-guide-page > article {
			width: 100% !important;
			max-width: none !important;
			min-width: 0 !important;
			margin-left: 0 !important;
			margin-right: 0 !important;
			box-sizing: border-box !important;
		}

		/* Override Tailwind's max-width utilities */
		body.brand-guide-page .max-w-screen-2xl,
		body.brand-guide-page .max-w-screen-xl,
		body.brand-guide-page .max-w-screen-lg,
		body.brand-guide-page .max-w-screen-md,
		body.brand-guide-page .max-w-7xl,
		body.brand-guide-page .max-w-6xl,
		body.brand-guide-page .max-w-5xl,
		body.brand-guide-page .max-w-4xl,
		body.brand-guide-page .max-w-3xl,
		body.brand-guide-page .max-w-2xl,
		body.brand-guide-page .max-w-xl,
		body.brand-guide-page .max-w-lg,
		body.brand-guide-page [class*="max-w-"] {
			max-width: none !important;
		}

		/* Override mx-auto centering */
		body.brand-guide-page .constrain,
		body.brand-guide-page .mx-auto:not(.catalog-header h1 span):not(.icon):not(.styles-content .mx-auto) {
			margin-left: 0 !important;
			margin-right: 0 !important;
		}

		html, body {
			margin: 0 !important;
			padding: 0 !important;
			overflow-x: hidden !important;
			width: 100% !important;
			max-width: 100% !important;
		}

		/* CRITICAL: Override nav.css body { position: relative; } that breaks fixed positioning */
		html body.brand-guide-page {
			position: static !important;
			padding-top: 60px !important; /* Space for sticky header */
		}

		/* Hide ALL theme elements */
		html body.brand-guide-page .site-header,
		html body.brand-guide-page .site-nav,
		html body.brand-guide-page .nav__primary,
		html body.brand-guide-page #masthead,
		html body.brand-guide-page .site-footer,
		html body.brand-guide-page #colophon,
		html body.brand-guide-page header.site-header,
		html body.brand-guide-page .header,
		html body.brand-guide-page #site-header,
		html body.brand-guide-page .nav,
		html body.brand-guide-page nav.nav,
		html body.brand-guide-page [data-header="container"] {
			display: none !important;
		}

		/* CRITICAL: Brand guide header layout */
		#brand-guide-header {
			display: flex !important;
			flex-direction: row !important;
			flex-wrap: nowrap !important;
			align-items: center !important;
			gap: 12px !important;
			overflow: visible !important;
		}

		#brand-guide-header .tab,
		#brand-guide-header .bg-header-btn,
		#brand-guide-header button {
			display: inline-flex !important;
			visibility: visible !important;
			opacity: 1 !important;
			flex-grow: 0 !important;
			flex-shrink: 0 !important;
			width: auto !important;
			min-width: auto !important;
			max-width: none !important;
		}

		#brand-guide-header img {
			width: 50px !important;
			max-width: 50px !important;
			height: 20px !important;
			flex: 0 0 50px !important;
		}

		#brand-guide-header > span {
			white-space: nowrap !important;
			flex: 0 0 auto !important;
		}

		#brand-guide-header > span > span {
			white-space: nowrap !important;
		}

		/* ============================================================
		   Sticky Header Bar - FLEXBOX LAYOUT
		   ============================================================ */
		html body .catalog-header,
		.catalog-header {
			position: fixed !important;
			top: 0 !important;
			left: 0 !important;
			right: 0 !important;
			width: 100% !important;
			height: 60px !important;
			background: #192C36 !important;
			display: flex !important;
			justify-content: space-between !important;
			align-items: center !important;
			padding: 0 24px !important;
			margin: 0 !important;
			z-index: 99999 !important;
			box-shadow: 0 2px 10px rgba(0,0,0,0.3) !important;
			box-sizing: border-box !important;
			gap: 24px !important;
			overflow: visible !important;
		}

		/* Logo section */
		html body .catalog-header-logo,
		.catalog-header-logo {
			display: flex !important;
			align-items: center !important;
			gap: 8px !important;
			flex-shrink: 0 !important;
			overflow: visible !important;
		}

		html body .catalog-header-logo svg,
		.catalog-header-logo svg {
			width: 40px !important;
			height: 16px !important;
			display: block !important;
			flex-shrink: 0 !important;
		}

		html body .catalog-header-title,
		.catalog-header-title {
			font-family: 'Work Sans', sans-serif !important;
			font-size: 16px !important;
			font-weight: 600 !important;
			color: #72D1F6 !important;
			white-space: nowrap !important;
		}

		/* Tabs section */
		html body .catalog-header-tabs,
		.catalog-header-tabs {
			display: inline-flex !important;
			gap: 4px !important;
			flex-shrink: 0 !important;
		}

		html body .catalog-header-tabs .tab,
		.catalog-header-tabs .tab {
			display: inline-block !important;
			background: transparent !important;
			border: none !important;
			color: #8698a1 !important;
			padding: 8px 16px !important;
			font-family: 'Work Sans', sans-serif !important;
			font-size: 13px !important;
			font-weight: 600 !important;
			border-radius: 4px !important;
			cursor: pointer !important;
			transition: all 0.2s !important;
			white-space: nowrap !important;
		}

		html body .catalog-header-tabs .tab:hover,
		.catalog-header-tabs .tab:hover {
			color: #fff !important;
		}

		html body .catalog-header-tabs .tab.active,
		.catalog-header-tabs .tab.active {
			background: #234253 !important;
			color: #72D1F6 !important;
		}

		/* Jump button */
		html body .catalog-header-jump,
		.catalog-header-jump {
			display: inline-flex !important;
			align-items: center !important;
			justify-content: center !important;
			gap: 6px !important;
			background: #234253 !important;
			border: none !important;
			color: #fff !important;
			padding: 8px 12px !important;
			font-family: 'Work Sans', sans-serif !important;
			font-size: 12px !important;
			font-weight: 600 !important;
			border-radius: 4px !important;
			cursor: pointer !important;
			transition: background 0.2s !important;
			white-space: nowrap !important;
			flex-shrink: 0 !important;
			overflow: visible !important;
		}

		html body .catalog-header-jump:hover,
		.catalog-header-jump:hover {
			background: #3B6C80 !important;
		}

		html body .catalog-header-jump svg,
		.catalog-header-jump svg {
			width: 14px !important;
			height: 14px !important;
			flex-shrink: 0 !important;
		}

		/* ============================================================
		   Navigation Modal - SOLID BACKGROUND (no transparency)
		   ============================================================ */
		.catalog-nav-overlay {
			display: none;
			position: fixed;
			top: 60px;
			left: 0;
			right: 0;
			bottom: 0;
			background: #0b181e;
			z-index: 9998;
			overflow-y: auto;
			padding: 40px;
		}

		.catalog-nav-overlay.active {
			display: block;
		}

		.catalog-nav-section {
			display: none;
			max-width: 1400px;
			margin: 0 auto;
		}

		.catalog-nav-section.active {
			display: block;
		}

		.catalog-nav-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 30px;
		}

		.catalog-nav-category h3 {
			font-family: 'Work Sans', sans-serif;
			font-size: 12px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			color: #72D1F6;
			margin: 0 0 12px;
			padding-bottom: 8px;
			border-bottom: 1px solid rgba(114, 209, 246, 0.3);
		}

		.catalog-nav-category ul {
			list-style: none;
			margin: 0;
			padding: 0;
		}

		.catalog-nav-category a {
			display: block;
			padding: 8px 0;
			font-family: 'Work Sans', sans-serif;
			font-size: 14px;
			color: #DFE1E1;
			text-decoration: none;
			transition: color 0.15s;
		}

		.catalog-nav-category a:hover {
			color: #72D1F6;
		}

		/* ============================================================
		   Tab Content Areas
		   ============================================================ */
		.tab-content {
			display: none;
		}

		.tab-content.active {
			display: block;
		}

		/* ============================================================
		   Styles Tab Content - Comprehensive Layout
		   ============================================================ */
		.styles-content {
			background: #fff;
			padding: 0;
		}

		.styles-section {
			padding: 60px 40px;
			border-bottom: 1px solid #DFE1E1;
		}

		.styles-section:last-child {
			border-bottom: none;
		}

		.styles-container {
			max-width: 1200px;
			margin: 0 auto;
		}

		.section-title {
			font-family: 'Work Sans', sans-serif;
			font-size: 0.75rem;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.1em;
			color: #72D1F6;
			margin-bottom: 2rem;
		}

		.section-intro {
			font-family: 'Work Sans', sans-serif;
			font-size: 1rem;
			color: #606969;
			margin-bottom: 2rem;
			max-width: 800px;
		}

		/* Style Sample Box - Comprehensive Format */
		.style-sample {
			margin-bottom: 2rem;
			padding: 2rem;
			background-color: #F7F7F7;
			border-radius: 8px;
		}

		.style-sample:last-child {
			margin-bottom: 0;
		}

		.style-name {
			font-family: 'Work Sans', sans-serif;
			font-size: 0.875rem;
			font-weight: 600;
			color: #192C36;
			margin-bottom: 0.5rem;
		}

		.style-class {
			font-family: 'Andale Mono', monospace;
			font-size: 0.75rem;
			color: #ff4f55;
			background-color: rgba(255, 79, 85, 0.1);
			padding: 0.125rem 0.375rem;
			border-radius: 3px;
			margin-left: 0.5rem;
		}

		.style-preview {
			margin: 1.5rem 0;
			color: #234253;
		}

		.style-meta {
			display: flex;
			flex-wrap: wrap;
			gap: 1rem;
			padding-top: 1.5rem;
			border-top: 1px solid #DFE1E1;
		}

		.style-meta-item {
			font-family: 'Work Sans', sans-serif;
			font-size: 0.75rem;
			color: #606969;
		}

		.style-meta-item strong {
			color: #234253;
		}

		/* Color Grid - Simple swatches without Aa */
		.color-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
			gap: 1.5rem;
			max-width: 1200px;
			margin: 0 auto;
		}

		.color-card {
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		}

		.color-swatch {
			height: 100px;
		}

		.color-info {
			padding: 1rem;
			background-color: #fff;
		}

		.color-name {
			font-family: 'Work Sans', sans-serif;
			font-weight: 600;
			font-size: 0.875rem;
			color: #234253;
			margin-bottom: 0.25rem;
		}

		.color-value {
			font-family: 'Andale Mono', monospace;
			font-size: 0.75rem;
			color: #606969;
			margin-bottom: 0.5rem;
		}

		.color-classes {
			display: flex;
			flex-wrap: wrap;
			gap: 4px;
		}

		.color-classes span {
			font-family: 'Andale Mono', monospace;
			font-size: 0.625rem;
			background: #F7F7F7;
			padding: 2px 6px;
			border-radius: 3px;
			color: #606969;
		}

		/* Specification Tables */
		.spec-table {
			width: 100%;
			border-collapse: collapse;
			font-size: 0.875rem;
			margin-top: 2rem;
		}

		.spec-table th,
		.spec-table td {
			text-align: left;
			padding: 0.75rem 1rem;
			border-bottom: 1px solid #DFE1E1;
		}

		.spec-table th {
			font-family: 'Work Sans', sans-serif;
			font-weight: 600;
			background-color: #F7F7F7;
			color: #234253;
		}

		.spec-table td {
			font-family: 'Work Sans', sans-serif;
			color: #606969;
		}

		.spec-table code {
			font-family: 'Andale Mono', monospace;
			font-size: 0.75rem;
			color: #ff4f55;
			background-color: rgba(255, 79, 85, 0.1);
			padding: 0.125rem 0.375rem;
			border-radius: 3px;
		}

		/* ============================================================
		   Main Content - Full Width (Components Tab)
		   ============================================================ */
		.brand-guide-page .stack-content,
		.stack-content {
			width: 100vw !important;
			max-width: 100vw !important;
			margin: 0 !important;
			padding: 0 !important;
		}

		/* Override .constrain - Tailwind sets max-width: 1536px */
		.brand-guide-page .constrain,
		.brand-guide-page .stack-content .constrain,
		.brand-guide-page .stack-render .constrain,
		.brand-guide-page section .constrain,
		.brand-guide-page aside .constrain,
		.brand-guide-page div .constrain {
			max-width: 100% !important;
			width: 100% !important;
			padding-left: 40px !important;
			padding-right: 40px !important;
			box-sizing: border-box !important;
			margin-left: 0 !important;
			margin-right: 0 !important;
		}

		/* Override ALL max-width classes */
		.brand-guide-page [class*="max-w-"],
		.brand-guide-page .max-w-screen-2xl,
		.brand-guide-page .max-w-screen-xl,
		.brand-guide-page .max-w-7xl,
		.brand-guide-page .max-w-6xl,
		.brand-guide-page .max-w-5xl,
		.brand-guide-page .max-w-4xl,
		.brand-guide-page .max-w-3xl,
		.brand-guide-page .max-w-2xl {
			max-width: 100% !important;
		}

		/* Override .row grid */
		.brand-guide-page .row {
			width: 100% !important;
			max-width: 100% !important;
		}

		/* Force full width on sections */
		.brand-guide-page section,
		.brand-guide-page aside,
		.brand-guide-page .stack-render,
		.brand-guide-page .stack-render > * {
			width: 100% !important;
			max-width: 100% !important;
		}

		/* ============================================================
		   Stack Label Banner - Sticky within viewport
		   ============================================================ */
		.stack-label-banner {
			position: sticky;
			top: 60px;
			z-index: 100;
			background: linear-gradient(135deg, #234253 0%, #192C36 100%);
			padding: 12px 24px;
			border-bottom: 3px solid #72D1F6;
			display: flex;
			align-items: center;
			gap: 16px;
			flex-wrap: wrap;
		}

		.stack-label-banner h2 {
			font-family: 'Work Sans', sans-serif;
			font-size: 20px;
			font-weight: 700;
			color: #fff;
			margin: 0;
		}

		.stack-label-banner .stack-file {
			font-family: 'Andale Mono', monospace;
			font-size: 12px;
			background: rgba(114, 209, 246, 0.2);
			color: #72D1F6;
			padding: 4px 10px;
			border-radius: 4px;
		}

		.stack-label-banner .stack-variants {
			font-family: 'Work Sans', sans-serif;
			font-size: 11px;
			color: #ff4f55;
			background: rgba(255, 79, 85, 0.15);
			padding: 3px 8px;
			border-radius: 3px;
		}

		/* ============================================================
		   Category Divider
		   ============================================================ */
		.category-divider {
			background: #0b181e;
			padding: 50px 24px;
			text-align: center;
		}

		.category-divider h2 {
			font-family: 'Work Sans', sans-serif;
			font-size: 36px;
			font-weight: 700;
			color: #72D1F6;
			margin: 0 0 8px;
		}

		.category-divider p {
			font-family: 'Work Sans', sans-serif;
			font-size: 14px;
			color: #8698a1;
			margin: 0;
		}

		/* ============================================================
		   Variant Label
		   ============================================================ */
		.variant-label {
			background: #FFF7EF;
			padding: 8px 24px;
			border-left: 4px solid #ff4f55;
		}

		.variant-label span {
			font-family: 'Work Sans', sans-serif;
			font-size: 12px;
			font-weight: 700;
			color: #192C36;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}

		/* ============================================================
		   Stack Render Area
		   ============================================================ */
		.stack-render {
			width: 100% !important;
			background: #fff;
		}

		.stack-render section,
		.stack-render aside {
			width: 100% !important;
			max-width: 100% !important;
		}

		/* ============================================================
		   Stack Error Display
		   ============================================================ */
		.stack-error {
			background: #fff5f5;
			border: 1px solid #ff4f55;
			border-left-width: 4px;
			padding: 20px 24px;
			margin: 0;
		}

		.stack-error p {
			font-family: 'Work Sans', sans-serif;
			font-size: 14px;
			color: #192C36;
			margin: 0;
		}

		.stack-error code {
			background: #ffe0e0;
			padding: 2px 6px;
			border-radius: 3px;
			font-size: 12px;
		}

		/* ============================================================
		   Divider
		   ============================================================ */
		.stack-divider {
			height: 40px;
			background: linear-gradient(to bottom, #F7F7F7 0%, #e0e0e0 50%, #F7F7F7 100%);
		}

		/* ============================================================
		   Note
		   ============================================================ */
		.stack-note {
			background: #FFF7EF;
			border-left: 4px solid #ff4f55;
			padding: 10px 24px;
			font-family: 'Work Sans', sans-serif;
			font-size: 13px;
			color: #606969;
		}

		/* Admin bar adjustment - .admin-bar class is on html element in WordPress */
		html.admin-bar .catalog-header {
			top: 32px !important;
		}

		html.admin-bar body.brand-guide-page {
			padding-top: 92px !important;
		}

		html.admin-bar .catalog-nav-overlay {
			top: 92px;
		}

		html.admin-bar .stack-label-banner {
			top: 92px;
		}

		@media (max-width: 782px) {
			html.admin-bar .catalog-header {
				top: 46px !important;
			}
			html.admin-bar body.brand-guide-page {
				padding-top: 106px !important;
			}
			html.admin-bar .catalog-nav-overlay {
				top: 106px;
			}
			html.admin-bar .stack-label-banner {
				top: 106px;
			}

			.catalog-header {
				padding: 0 12px;
			}

			.catalog-header h1 span {
				display: none;
			}

			.brand-guide-tabs .tab {
				padding: 6px 10px;
				font-size: 12px;
			}

			.style-sample {
				padding: 1.5rem;
			}

			.style-meta {
				flex-direction: column;
				gap: 0.5rem;
			}

			.color-grid {
				grid-template-columns: repeat(2, 1fr);
				gap: 12px;
			}

			.spec-table {
				font-size: 0.75rem;
			}

			.spec-table th,
			.spec-table td {
				padding: 0.5rem;
			}
		}
	</style>
</head>

<body <?php body_class('brand-guide-page'); ?> style="width: 100% !important; max-width: 100% !important; margin: 0 !important; padding-top: 60px !important;">
<?php wp_body_open(); ?>

<!-- Sticky Header Bar -->
<div id="brand-guide-header" style="position:fixed;top:0;left:0;right:0;height:60px;background:#192C36;padding:0 20px;z-index:99999;box-shadow:0 2px 10px rgba(0,0,0,0.3);display:flex;align-items:center;gap:12px;">
	<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/g2o-logo.svg'); ?>" alt="G2O" style="height:20px;">
	<b style="color:#72D1F6;font-weight:600;font-size:14px;white-space:nowrap;">Brand Guide</b>
	<button class="tab active" data-tab="styles" onclick="switchTab('styles')" style="background:#234253;color:#72D1F6;border:none;padding:6px 12px;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;white-space:nowrap;">Styles</button>
	<button class="tab" data-tab="components" onclick="switchTab('components')" style="background:transparent;color:#8698a1;border:none;padding:6px 12px;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;white-space:nowrap;">Components</button>
	<button onclick="toggleNav()" style="align-items:center;gap:4px;background:#234253;color:#fff;border:none;padding:6px 10px;font-size:11px;font-weight:600;border-radius:4px;cursor:pointer;white-space:nowrap;">
		<svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
		Jump
	</button>
</div>

<!-- Navigation Overlay -->
<div class="catalog-nav-overlay" id="navOverlay">
	<!-- Styles Navigation -->
	<div class="catalog-nav-section active" id="nav-styles">
		<div class="catalog-nav-grid">
			<div class="catalog-nav-category">
				<h3>Styles</h3>
				<ul>
					<li><a href="#typography" onclick="closeNav()">Typography</a></li>
					<li><a href="#helper-classes" onclick="closeNav()">Helper Classes</a></li>
					<li><a href="#colors" onclick="closeNav()">Colors</a></li>
					<li><a href="#specifications" onclick="closeNav()">Specifications</a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Components Navigation -->
	<div class="catalog-nav-section" id="nav-components">
		<div class="catalog-nav-grid">
			<?php foreach ($categories as $category_name => $stack_keys) : ?>
				<div class="catalog-nav-category">
					<h3><?php echo esc_html($category_name); ?></h3>
					<ul>
						<?php foreach ($stack_keys as $stack_key) :
							if (!isset($stacks[$stack_key])) continue;
							$stack = $stacks[$stack_key];
						?>
							<li>
								<a href="#stack-<?php echo esc_attr($stack_key); ?>" onclick="closeNav()">
									<?php echo esc_html($stack['label']); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- ============================================================
     STYLES TAB CONTENT
     ============================================================ -->
<div class="tab-content active" id="styles-content">
	<div class="styles-content">

		<!-- Typography Section -->
		<section class="styles-section" id="typography">
			<div class="styles-container">
				<h2 class="section-title">Typography</h2>
				<p class="section-intro">Heading styles using Zodiak (serif) and Work Sans (sans-serif) fonts with Tailwind utility classes.</p>

				<!-- H1 -->
				<div class="style-sample">
					<div class="style-name">Heading 1 <span class="style-class">h1, .h1</span></div>
					<div class="style-preview">
						<span class="font-serif text-5xl lg:text-[7.5rem] font-light leading-none tracking-tight">Making an impact together</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Zodiak (serif)</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 3rem (48px) / 7.5rem (120px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.1</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.04em</span>
					</div>
				</div>

				<!-- H1 Alt -->
				<div class="style-sample">
					<div class="style-name">Heading 1 Alt <span class="style-class">.h1-alt</span></div>
					<div class="style-preview">
						<span class="font-sans text-5xl lg:text-[7.5rem] font-bold leading-none tracking-tight">Making an impact together</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 800 (Extra Bold)</span>
						<span class="style-meta-item"><strong>Size:</strong> 3rem (48px) / 7.5rem (120px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.1</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.02em</span>
					</div>
				</div>

				<!-- H2 -->
				<div class="style-sample">
					<div class="style-name">Heading 2 <span class="style-class">.h2</span></div>
					<div class="style-preview">
						<span class="font-serif text-4xl lg:text-[4.5rem] font-light leading-tight tracking-tight">Strategy and innovation</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Zodiak (serif)</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 2.25rem (36px) / 4.5rem (72px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.15</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.04em</span>
					</div>
				</div>

				<!-- H2 Alt -->
				<div class="style-sample">
					<div class="style-name">Heading 2 Alt <span class="style-class">.h2-alt</span></div>
					<div class="style-preview">
						<span class="font-sans text-4xl lg:text-[4.5rem] font-normal leading-tight tracking-tight">Strategy and innovation</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 400 (Regular)</span>
						<span class="style-meta-item"><strong>Size:</strong> 4.5rem (72px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.15</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.02em</span>
					</div>
				</div>

				<!-- H3 -->
				<div class="style-sample">
					<div class="style-name">Heading 3 <span class="style-class">h3, .h3</span></div>
					<div class="style-preview">
						<span class="font-sans text-3xl lg:text-4xl font-bold leading-none tracking-tight">Our approach to digital transformation</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 700 (Bold)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1.875rem (30px) / 2.25rem (36px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.03</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.02em</span>
					</div>
				</div>

				<!-- H4 -->
				<div class="style-sample">
					<div class="style-name">Heading 4 <span class="style-class">h4, .h4</span></div>
					<div class="style-preview">
						<span class="font-sans text-2xl lg:text-[2rem] font-bold leading-none tracking-tight">Building digital solutions that scale</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 700 (Bold)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1.5rem (24px) / 2rem (32px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.03</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> -0.02em</span>
					</div>
				</div>

				<!-- H5 -->
				<div class="style-sample">
					<div class="style-name">Heading 5 <span class="style-class">h5, .h5</span></div>
					<div class="style-preview">
						<span class="font-serif text-[1.625rem] lg:text-[1.875rem] font-light leading-snug">We partner with organizations to create meaningful change</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Zodiak (serif)</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1.625rem (26px) / 1.875rem (30px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.3</span>
					</div>
				</div>

				<!-- Split-Text Pattern -->
				<div class="style-sample">
					<div class="style-name">Split-Text Pattern <span class="style-class">.font-serif strong</span></div>
					<div class="style-preview">
						<span class="font-serif text-[1.875rem] font-light leading-relaxed">of buyers are willing to <strong class="font-sans font-bold">pay more for a great customer experience.</strong></span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Base:</strong> Zodiak Light (300)</span>
						<span class="style-meta-item"><strong>Strong:</strong> Work Sans Bold (700)</span>
						<span class="style-meta-item"><strong>Pattern:</strong> Serif text with sans-serif bold emphasis</span>
					</div>
				</div>

			</div>
		</section>

		<!-- Helper Classes Section -->
		<section class="styles-section" id="helper-classes">
			<div class="styles-container">
				<h2 class="section-title">Helper Classes</h2>
				<p class="section-intro">Utility classes for common text patterns and UI elements.</p>

				<!-- Eyebrow -->
				<div class="style-sample">
					<div class="style-name">Eyebrow <span class="style-class">.eyebrow</span></div>
					<div class="style-preview">
						<span class="eyebrow">Case Study</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 700 (Bold)</span>
						<span class="style-meta-item"><strong>Size:</strong> 0.75rem (12px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> 0.1em</span>
						<span class="style-meta-item"><strong>Transform:</strong> uppercase</span>
					</div>
				</div>

				<!-- Kicker -->
				<div class="style-sample">
					<div class="style-name">Kicker <span class="style-class">.kicker</span></div>
					<div class="style-preview">
						<span class="kicker">Featured Solution</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 700 (Bold)</span>
						<span class="style-meta-item"><strong>Size:</strong> 0.875rem (14px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.5</span>
						<span class="style-meta-item"><strong>Letter Spacing:</strong> 0.1em</span>
						<span class="style-meta-item"><strong>Transform:</strong> uppercase</span>
					</div>
				</div>

				<!-- Deck -->
				<div class="style-sample">
					<div class="style-name">Deck <span class="style-class">.deck</span></div>
					<div class="style-preview">
						<span class="deck">We help organizations navigate complex challenges and build digital solutions that drive meaningful outcomes for communities and stakeholders.</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1.25rem (20px) / 1.375rem (22px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.4 (snug)</span>
					</div>
				</div>

				<!-- Lead -->
				<div class="style-sample">
					<div class="style-name">Lead <span class="style-class">.lead</span></div>
					<div class="style-preview">
						<span class="lead">Our team brings decades of experience in public sector transformation, combining strategic insight with technical expertise to deliver lasting impact.</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Zodiak (serif)</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1.5rem (24px) / 1.875rem (30px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.4</span>
					</div>
				</div>

				<!-- Body -->
				<div class="style-sample">
					<div class="style-name">Body <span class="style-class">.body</span></div>
					<div class="style-preview">
						<span class="body">G2O is a strategy and technology consulting firm that partners with government agencies and organizations to solve complex challenges. We specialize in digital transformation, data analytics, and customer experience design.</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 400 (Regular)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1rem (16px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.5</span>
					</div>
				</div>

				<!-- Caption -->
				<div class="style-sample">
					<div class="style-name">Caption <span class="style-class">.caption</span></div>
					<div class="style-preview">
						<span class="caption">Photo: G2O team members collaborating on a client workshop, Washington D.C., 2024</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 400 (Regular)</span>
						<span class="style-meta-item"><strong>Size:</strong> 0.75rem (12px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.5</span>
					</div>
				</div>

				<!-- Footnote -->
				<div class="style-sample">
					<div class="style-name">Footnote <span class="style-class">.footnote</span></div>
					<div class="style-preview">
						<span class="footnote">Data sources include federal agency reports and third-party research. Results may vary based on implementation approach and organizational context.</span>
					</div>
					<div class="style-meta">
						<span class="style-meta-item"><strong>Font:</strong> Work Sans</span>
						<span class="style-meta-item"><strong>Weight:</strong> 300 (Light)</span>
						<span class="style-meta-item"><strong>Size:</strong> 1rem (16px)</span>
						<span class="style-meta-item"><strong>Line Height:</strong> 1.4 (snug)</span>
					</div>
				</div>

			</div>
		</section>

		<!-- Colors Section -->
		<section class="styles-section" id="colors">
			<div class="styles-container">
				<h2 class="section-title">Brand Colors</h2>
				<p class="section-intro">Brand color palette available as Tailwind utility classes (bg-*, text-*, border-*).</p>

				<div class="color-grid">

					<!-- Primary Colors -->
					<div class="color-card">
						<div class="color-swatch" style="background-color: #234253;"></div>
						<div class="color-info">
							<div class="color-name">River</div>
							<div class="color-value">#234253</div>
							<div class="color-classes">
								<span>bg-river</span>
								<span>text-river</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #3B6C80;"></div>
						<div class="color-info">
							<div class="color-name">River Light</div>
							<div class="color-value">#3B6C80</div>
							<div class="color-classes">
								<span>bg-river-light</span>
								<span>text-river-light</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #192C36;"></div>
						<div class="color-info">
							<div class="color-name">Gunmetal</div>
							<div class="color-value">#192C36</div>
							<div class="color-classes">
								<span>bg-gunmetal</span>
								<span>text-gunmetal</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #0b181e;"></div>
						<div class="color-info">
							<div class="color-name">Black Pearl</div>
							<div class="color-value">#0b181e</div>
							<div class="color-classes">
								<span>bg-black-pearl</span>
								<span>text-black-pearl</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #10212a;"></div>
						<div class="color-info">
							<div class="color-name">Black Stone</div>
							<div class="color-value">#10212a</div>
							<div class="color-classes">
								<span>bg-black-stone</span>
								<span>text-black-stone</span>
							</div>
						</div>
					</div>

					<!-- Accent Colors -->
					<div class="color-card">
						<div class="color-swatch" style="background-color: #72D1F6;"></div>
						<div class="color-info">
							<div class="color-name">Sky</div>
							<div class="color-value">#72D1F6</div>
							<div class="color-classes">
								<span>bg-sky</span>
								<span>text-sky</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #ff4f55;"></div>
						<div class="color-info">
							<div class="color-name">City</div>
							<div class="color-value">#ff4f55</div>
							<div class="color-classes">
								<span>bg-city</span>
								<span>text-city</span>
							</div>
						</div>
					</div>

					<!-- Neutrals -->
					<div class="color-card">
						<div class="color-swatch" style="background-color: #FFF7EF;"></div>
						<div class="color-info">
							<div class="color-name">Limestone</div>
							<div class="color-value">#FFF7EF</div>
							<div class="color-classes">
								<span>bg-limestone</span>
								<span>text-limestone</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #F7F7F7; border: 1px solid #DFE1E1;"></div>
						<div class="color-info">
							<div class="color-name">Light</div>
							<div class="color-value">#F7F7F7</div>
							<div class="color-classes">
								<span>bg-light</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #DFE1E1; border: 1px solid #ccc;"></div>
						<div class="color-info">
							<div class="color-name">Pathway Light</div>
							<div class="color-value">#DFE1E1</div>
							<div class="color-classes">
								<span>bg-pathway-light</span>
								<span>text-pathway-light</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #606969;"></div>
						<div class="color-info">
							<div class="color-name">Pathway</div>
							<div class="color-value">#606969</div>
							<div class="color-classes">
								<span>bg-pathway</span>
								<span>text-pathway</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #8698a1;"></div>
						<div class="color-info">
							<div class="color-name">Regent Gray</div>
							<div class="color-value">#8698a1</div>
							<div class="color-classes">
								<span>bg-regent-gray</span>
								<span>text-regent-gray</span>
							</div>
						</div>
					</div>

					<!-- Black & White -->
					<div class="color-card">
						<div class="color-swatch" style="background-color: #ffffff; border: 1px solid #DFE1E1;"></div>
						<div class="color-info">
							<div class="color-name">White</div>
							<div class="color-value">#ffffff</div>
							<div class="color-classes">
								<span>bg-white</span>
								<span>text-white</span>
							</div>
						</div>
					</div>

					<div class="color-card">
						<div class="color-swatch" style="background-color: #000000;"></div>
						<div class="color-info">
							<div class="color-name">Black</div>
							<div class="color-value">#000000</div>
							<div class="color-classes">
								<span>bg-black</span>
								<span>text-black</span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!-- Specifications Section -->
		<section class="styles-section" id="specifications">
			<div class="styles-container">
				<h2 class="section-title">Quick Reference</h2>
				<p class="section-intro">Typography specifications at a glance.</p>

				<table class="spec-table">
					<thead>
						<tr>
							<th>Style</th>
							<th>Class</th>
							<th>Font</th>
							<th>Weight</th>
							<th>Size (Mobile/Desktop)</th>
							<th>Line Height</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>H1</td>
							<td><code>h1, .h1</code></td>
							<td>Zodiak</td>
							<td>300</td>
							<td>3rem / 7.5rem</td>
							<td>1.1</td>
						</tr>
						<tr>
							<td>H1 Alt</td>
							<td><code>.h1-alt</code></td>
							<td>Work Sans</td>
							<td>800</td>
							<td>3rem / 7.5rem</td>
							<td>1.1</td>
						</tr>
						<tr>
							<td>H2</td>
							<td><code>.h2</code></td>
							<td>Zodiak</td>
							<td>300</td>
							<td>2.25rem / 4.5rem</td>
							<td>1.15</td>
						</tr>
						<tr>
							<td>H2 Alt</td>
							<td><code>.h2-alt</code></td>
							<td>Work Sans</td>
							<td>400</td>
							<td>4.5rem</td>
							<td>1.15</td>
						</tr>
						<tr>
							<td>H3</td>
							<td><code>h3, .h3</code></td>
							<td>Work Sans</td>
							<td>700</td>
							<td>1.875rem / 2.25rem</td>
							<td>1.03</td>
						</tr>
						<tr>
							<td>H4</td>
							<td><code>h4, .h4</code></td>
							<td>Work Sans</td>
							<td>700</td>
							<td>1.5rem / 2rem</td>
							<td>1.03</td>
						</tr>
						<tr>
							<td>H5</td>
							<td><code>h5, .h5</code></td>
							<td>Zodiak</td>
							<td>300</td>
							<td>1.625rem / 1.875rem</td>
							<td>1.3</td>
						</tr>
						<tr>
							<td>Eyebrow</td>
							<td><code>.eyebrow</code></td>
							<td>Work Sans</td>
							<td>700</td>
							<td>0.75rem</td>
							<td>1</td>
						</tr>
						<tr>
							<td>Kicker</td>
							<td><code>.kicker</code></td>
							<td>Work Sans</td>
							<td>700</td>
							<td>0.875rem</td>
							<td>1.5</td>
						</tr>
						<tr>
							<td>Deck</td>
							<td><code>.deck</code></td>
							<td>Work Sans</td>
							<td>300</td>
							<td>1.25rem / 1.375rem</td>
							<td>1.4</td>
						</tr>
						<tr>
							<td>Lead</td>
							<td><code>.lead</code></td>
							<td>Zodiak</td>
							<td>300</td>
							<td>1.5rem / 1.875rem</td>
							<td>1.4</td>
						</tr>
						<tr>
							<td>Body</td>
							<td><code>.body</code></td>
							<td>Work Sans</td>
							<td>400</td>
							<td>1rem</td>
							<td>1.5</td>
						</tr>
						<tr>
							<td>Caption</td>
							<td><code>.caption</code></td>
							<td>Work Sans</td>
							<td>400</td>
							<td>0.75rem</td>
							<td>1.5</td>
						</tr>
						<tr>
							<td>Footnote</td>
							<td><code>.footnote</code></td>
							<td>Work Sans</td>
							<td>300</td>
							<td>1rem</td>
							<td>1.4</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>

	</div>
</div>

<!-- ============================================================
     COMPONENTS TAB CONTENT
     ============================================================ -->
<div class="tab-content" id="components-content">
	<div class="stack-content" style="width: 100% !important; max-width: 100% !important; margin: 0 !important;">

		<?php foreach ($categories as $category_name => $stack_keys) : ?>

			<!-- Category Divider -->
			<div class="category-divider" id="cat-<?php echo esc_attr(sanitize_title($category_name)); ?>">
				<h2><?php echo esc_html($category_name); ?></h2>
				<p><?php
					$count = 0;
					foreach ($stack_keys as $key) {
						if (isset($stacks[$key])) $count++;
					}
					echo $count . ' components';
				?></p>
			</div>

			<?php foreach ($stack_keys as $stack_key) :
				if (!isset($stacks[$stack_key])) continue;
				$stack = $stacks[$stack_key];
				$has_variants = !empty($stack['variants']);
			?>

				<!-- Stack Label Banner -->
				<div class="stack-label-banner" id="stack-<?php echo esc_attr($stack_key); ?>">
					<h2><?php echo esc_html($stack['label']); ?></h2>
					<span class="stack-file"><?php echo esc_html($stack['file']); ?></span>
					<?php if ($has_variants) : ?>
						<span class="stack-variants"><?php echo count($stack['variants']); ?> variants</span>
					<?php endif; ?>
				</div>

				<?php if (!empty($stack['note'])) : ?>
					<div class="stack-note">
						<strong>Note:</strong> <?php echo esc_html($stack['note']); ?>
					</div>
				<?php endif; ?>

				<?php
				// Prepare mock data for the template
				$mock_data = $stack['data'];
				$mock_data['id'] = 'preview-' . $stack_key;
				$mock_data['class'] = 'stack stack-preview';

				// Get the template file name without extension
				$template_name = str_replace('.php', '', $stack['file']);

				// Render based on whether there are variants
				if ($has_variants && !empty($stack['variants'])) :
					foreach ($stack['variants'] as $variant) :
						$variant_data = $mock_data;
						$variant_data['component_type'] = $variant;
						$variant_data['id'] = 'preview-' . $stack_key . '-' . $variant;
						?>

						<div class="variant-label">
							<span>Variant: <?php echo esc_html($variant); ?></span>
						</div>

						<div class="stack-render">
							<?php
							// Capture output to catch errors
							ob_start();
							try {
								get_template_part('template-parts/stacks/' . $template_name, null, $variant_data);
								$output = ob_get_clean();
								echo $output;
							} catch (Exception $e) {
								ob_end_clean();
								echo '<div class="stack-error"><p>Error rendering <code>' . esc_html($stack['file']) . '</code> (' . esc_html($variant) . '): ' . esc_html($e->getMessage()) . '</p></div>';
							}
							?>
						</div>

					<?php endforeach;
				else :
					?>
					<div class="stack-render">
						<?php
						ob_start();
						try {
							get_template_part('template-parts/stacks/' . $template_name, null, $mock_data);
							$output = ob_get_clean();
							echo $output;
						} catch (Exception $e) {
							ob_end_clean();
							echo '<div class="stack-error"><p>Error rendering <code>' . esc_html($stack['file']) . '</code>: ' . esc_html($e->getMessage()) . '</p></div>';
						}
						?>
					</div>
				<?php endif; ?>

				<div class="stack-divider"></div>

			<?php endforeach; ?>
		<?php endforeach; ?>

	</div>
</div>

<script>
// Brand Guide Navigation & Tabs - Inline version
(function() {
	'use strict';

	// Toggle nav overlay
	window.toggleNav = function() {
		document.getElementById('navOverlay').classList.toggle('active');
	};

	// Close nav overlay
	window.closeNav = function() {
		document.getElementById('navOverlay').classList.remove('active');
	};

	// Switch tabs
	window.switchTab = function(tabId) {
		var tabs = document.querySelectorAll('.tab');
		var tabContents = document.querySelectorAll('.tab-content');
		var navSections = document.querySelectorAll('.catalog-nav-section');

		// Update tab styles
		tabs.forEach(function(t) {
			if (t.dataset.tab === tabId) {
				t.style.background = '#234253';
				t.style.color = '#72D1F6';
				t.classList.add('active');
			} else {
				t.style.background = 'transparent';
				t.style.color = '#8698a1';
				t.classList.remove('active');
			}
		});

		// Show/hide content
		tabContents.forEach(function(c) { c.classList.remove('active'); });
		var targetContent = document.getElementById(tabId + '-content');
		if (targetContent) targetContent.classList.add('active');

		// Update nav sections
		navSections.forEach(function(s) { s.classList.remove('active'); });
		var targetNav = document.getElementById('nav-' + tabId);
		if (targetNav) targetNav.classList.add('active');

		closeNav();
	};

	// Close nav on escape
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') closeNav();
	});

	// Close nav on background click
	document.addEventListener('click', function(e) {
		var overlay = document.getElementById('navOverlay');
		if (e.target === overlay) closeNav();
	});

	// Handle hash navigation
	window.addEventListener('hashchange', function() {
		var hash = window.location.hash;
		if (!hash) return;
		var stylesAnchors = ['#typography', '#helper-classes', '#colors', '#specifications'];
		if (stylesAnchors.includes(hash)) {
			switchTab('styles');
		} else if (hash.startsWith('#stack-') || hash.startsWith('#cat-')) {
			switchTab('components');
		}
	});

	console.log('Brand Guide: Ready');
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
