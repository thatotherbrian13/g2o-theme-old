<?php

/**
 * g2o functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package g2o
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * G2O New Navigation Feature Flag & Version Control
 * 
 * Set to true to enable the new accessible navigation system.
 * Set to false to use the legacy navigation.
 * 
 * Version control: 'v1' for stable, 'v2' for team review
 */
if (!defined('G2O_NEW_NAV')) {
	define('G2O_NEW_NAV', apply_filters('g2o_new_nav_enabled', true));
}

if (!defined('G2O_NAV_VERSION')) {
	define('G2O_NAV_VERSION', apply_filters('g2o_nav_version', 'v1')); // Using nav.css as primary file
}

/**
 * Helper function to switch navigation versions
 * 
 * Usage: 
 * - To switch to v2: add_filter('g2o_nav_version', function() { return 'v2'; });
 * - To switch back to v1: add_filter('g2o_nav_version', function() { return 'v1'; });
 * 
 * Or add this line to wp-config.php:
 * - For v2: define('G2O_NAV_VERSION_OVERRIDE', 'v2');
 * - For v1: define('G2O_NAV_VERSION_OVERRIDE', 'v1');
 */
if (defined('G2O_NAV_VERSION_OVERRIDE') && G2O_NAV_VERSION_OVERRIDE) {
	add_filter('g2o_nav_version', function() {
		return G2O_NAV_VERSION_OVERRIDE;
	}, 20);
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function g2o_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on g2o, use a find and replace
		* to change 'g2o' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('g2o', get_template_directory() . '/theme/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// Register navigation menus
	$menu_locations = array(
		'menu-primary' => esc_html__('Primary', 'g2o'),
		'menu-footer' => esc_html__('Footer', 'g2o'),
		'menu-legal' => esc_html__('Legal', 'g2o'),
	);

	// Add new navigation menu locations when new nav is enabled
	if (G2O_NEW_NAV) {
		$menu_locations['primary_menu'] = esc_html__('Primary Menu (New Nav)', 'g2o');
		$menu_locations['utility_menu'] = esc_html__('Utility Menu (New Nav)', 'g2o');
	}

	register_nav_menus($menu_locations);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'g2o_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size('aspect-2-1', 1200, 600, true);
	add_image_size('aspect-3-2', 900, 600, true);
	add_image_size('aspect-4-3', 600, 450, true);
	add_image_size('aspect-5-2', 1000, 400, true);
	add_image_size('aspect-5-6', 1000, 1200, true);
	add_image_size('aspect-6-5', 1200, 1000, true);

	add_image_size('square', 1200, 1200, true);
}
add_action('after_setup_theme', 'g2o_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function g2o_content_width()
{
	$GLOBALS['content_width'] = apply_filters('g2o_content_width', 640);
}
add_action('after_setup_theme', 'g2o_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function g2o_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'g2o'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'g2o'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'g2o_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function g2o_scripts()
{
	wp_enqueue_style('g2o-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('theme', get_template_directory_uri() . '/build/css/main.css', array(), filemtime(get_stylesheet_directory() . '/build/css/main.css'));

	// Swiper CSS (bundled by esbuild)
	$swiper_css_path = get_stylesheet_directory() . '/build/js/scripts.css';
	if (file_exists($swiper_css_path)) {
		wp_enqueue_style('swiper', get_template_directory_uri() . '/build/js/scripts.css', array(), filemtime($swiper_css_path));
	}

	wp_enqueue_script('g2o-script', get_template_directory_uri() . '/build/js/scripts.js', array(), filemtime(get_stylesheet_directory() . '/build/js/scripts.js'), true);
	wp_enqueue_script('gradient-script', get_template_directory_uri() . '/build/js/gradient.js', array(), filemtime(get_stylesheet_directory() . '/build/js/gradient.js'), false);
	wp_enqueue_script('DrawSVGPlugin', get_template_directory_uri() . '/build/js/DrawSVGPlugin.min.js', array(), filemtime(get_stylesheet_directory() . '/build/js/DrawSVGPlugin.min.js'), false);

	// Enqueue new navigation assets when feature flag is enabled
	if (G2O_NEW_NAV) {
		// Determine version suffix
		$version = G2O_NAV_VERSION;
		$suffix = ($version === 'v1') ? '' : '-' . $version;
		
		// JavaScript file path and URL
		$nav_js_filename = 'nav' . $suffix . '.js';
		$nav_js_path = get_stylesheet_directory() . '/build/js/' . $nav_js_filename;
		$nav_js_url = get_template_directory_uri() . '/build/js/' . $nav_js_filename;
		
		if (!file_exists($nav_js_path)) {
			// Fallback to base nav.js if versioned file doesn't exist
			$nav_js_path = get_stylesheet_directory() . '/build/js/nav.js';
			$nav_js_url = get_template_directory_uri() . '/build/js/nav.js';
		}
		
		wp_enqueue_script('g2o-nav', $nav_js_url, array(), filemtime($nav_js_path), true);
		
		// CSS file path and URL
		$nav_css_filename = 'nav' . $suffix . '.css';
		$nav_css_path = get_stylesheet_directory() . '/build/css/' . $nav_css_filename;
		$nav_css_url = get_template_directory_uri() . '/build/css/' . $nav_css_filename;
		
		if (!file_exists($nav_css_path)) {
			// Fallback to base nav.css if versioned file doesn't exist
			$nav_css_path = get_stylesheet_directory() . '/build/css/nav.css';
			$nav_css_url = get_template_directory_uri() . '/build/css/nav.css';
		}
		
		wp_enqueue_style('g2o-nav', $nav_css_url, array('theme'), filemtime($nav_css_path));
	}
}
add_action('wp_enqueue_scripts', 'g2o_scripts');

remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_action('in_admin_header', 'wp_global_styles_render_svg_filters');

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
// remove render_block filters which adding unnecessary stuff
remove_filter('render_block', 'wp_render_duotone_support');
remove_filter('render_block', 'wp_restore_group_inner_container');
remove_filter('render_block', 'wp_render_layout_support_flag');
// remove wp_footer actions which add's global inline styles
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/theme/inc/jetpack.php';
}

// Footer menu walkers (still used by footer.php)
require get_template_directory() . '/theme/inc/walker-footer.php';
require get_template_directory() . '/theme/inc/walker-legal.php';

// Load new navigation Walker when feature flag is enabled
if (G2O_NEW_NAV) {
	$version = G2O_NAV_VERSION;
	$walker_suffix = ($version === 'v1') ? '' : '-' . $version;
	$walker_file = '/theme/inc/class-g2o-nav-walker' . $walker_suffix . '.php';
	
	if (file_exists(get_template_directory() . $walker_file)) {
		require get_template_directory() . $walker_file;
	} else {
		// Fallback to base walker
		require get_template_directory() . '/theme/inc/class-g2o-nav-walker.php';
	}
}



require get_template_directory() . '/theme/inc/acf-link.php';

// ChangeMakers 2025 Conference Template ACF Fields
require get_template_directory() . '/theme/inc/acf-changemakers-fields.php';
require get_template_directory() . '/theme/inc/acf-changemakers-survey-fields.php';
require get_template_directory() . '/theme/inc/acf-changemakers-admin-styles.php';

require get_template_directory() . '/theme/inc/acf-functions.php';

if (function_exists('acf_add_options_page')) {

	acf_add_options_page();
}

function my_acf_input_admin_footer()
{
?>
	<script type="text/javascript">
		(function($) {
			acf.add_filter('color_picker_args', function(args, field) {
				args.palettes = ['#234253', '#72d1f6', '#F7F7F7', '#fff7ef', '#ffffff']
				return args;
			});
		})(jQuery);
	</script>
<?php
}
add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');




add_action('wp_footer', 'render_page_template');
function render_page_template()
{
	global $template;
	if (current_user_can('administrator')) {
		echo "<a class='bg-black text-white text-xs font-mono font-bold leading-none tracking-widest py-1.5 px-3 rounded-tr-lg fixed bottom-0 left-0 z-9999 w-auto' title='Edit Page Template' href='' target='_blank' rel='noreferrer'>";
		print_r(basename($template));
		echo "</a>";
	}
}

function move_yoast_to_bottom()
{
	return 'low';
}
add_filter('wpseo_metabox_prio', 'move_yoast_to_bottom');


add_filter( 'gform_confirmation_anchor', function() {
    return 200;
} );


function populate_referral_url( $form ){
    // Grab URL from HTTP Server Var and put it into a variable
    $refurl = $_SERVER['HTTP_REFERER'] ?? '';
    GFCommon::log_debug( __METHOD__ . "(): HTTP_REFERER value returned by the server: {$refurl}" );

    // Return that value to the form
    return esc_url_raw($refurl);
}
add_filter( 'gform_field_value_refurl', 'populate_referral_url');


function optimized_content_output($body, $accent_color) {
	if (!$body) {
		return; // Exit early if $body is empty
	}

	$accent_color_escaped = acf_esc_html($accent_color);

	$content = str_replace(
		['<h3>', '<li>'],
		[
			'<h3 class="font-sans font-bold leading-normal" style="color: ' . $accent_color_escaped . ';">',
			'<li class="mb-3">',
		],
		$body
	);

	echo "<div class='body'>" . $content . "</div>";
}

// Add Zodiak font weight override CSS
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style(
		'zodiak-override',
		get_template_directory_uri() . '/build/css/zodiak-override.css',
		array(), // No dependencies to ensure it loads after main styles
		'1.0.2' // Updated version to force cache refresh
	);
}, 100); // High priority to load after other stylesheets

/**
 * Add SEO meta tags (description, Open Graph, Twitter Cards)
 * Provides basic SEO without requiring a plugin
 */
add_action('wp_head', 'g2o_meta_tags', 1);
function g2o_meta_tags() {
	// Don't output if Yoast or another SEO plugin is handling this
	if (defined('WPSEO_VERSION') || function_exists('rank_math') || function_exists('aioseo')) {
		return;
	}

	$description = '';
	$title = '';
	$image = '';
	$url = '';

	if (is_singular()) {
		$post = get_queried_object();
		$title = get_the_title($post);
		$description = has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $post)), 30, '...');
		$url = get_permalink($post);

		// Get featured image for Open Graph
		if (has_post_thumbnail($post)) {
			$image = get_the_post_thumbnail_url($post, 'large');
		}
	} elseif (is_front_page()) {
		$title = get_bloginfo('name');
		$description = get_bloginfo('description');
		$url = home_url('/');
	} elseif (is_archive()) {
		$title = get_the_archive_title();
		$description = get_the_archive_description() ?: get_bloginfo('description');
		$url = get_permalink();
	}

	// Clean up description
	$description = wp_strip_all_tags($description);
	$description = preg_replace('/\s+/', ' ', $description);
	$description = trim($description);

	if ($description) {
		echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
	}

	// Open Graph tags
	if ($title) {
		echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
	}
	if ($description) {
		echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
	}
	if ($url) {
		echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
	}
	if ($image) {
		echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
	}
	echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";

	// Twitter Card tags
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	if ($title) {
		echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
	}
	if ($description) {
		echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
	}
	if ($image) {
		echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
	}
}

/**
 * Add JSON-LD structured data for Organization
 */
add_action('wp_head', 'g2o_schema_markup', 2);
function g2o_schema_markup() {
	// Organization schema on all pages
	$schema = array(
		'@context' => 'https://schema.org',
		'@type' => 'Organization',
		'name' => get_bloginfo('name'),
		'url' => home_url('/'),
		'logo' => get_template_directory_uri() . '/assets/images/g2o-logo.svg',
	);

	// Add social profiles if available
	$social_profiles = array();
	$linkedin = get_field('social_linkedin', 'option');
	$facebook = get_field('social_facebook', 'option');
	$twitter = get_field('social_twitter', 'option');
	$instagram = get_field('social_instagram', 'option');

	if ($linkedin) $social_profiles[] = $linkedin;
	if ($facebook) $social_profiles[] = $facebook;
	if ($twitter) $social_profiles[] = $twitter;
	if ($instagram) $social_profiles[] = $instagram;

	if (!empty($social_profiles)) {
		$schema['sameAs'] = $social_profiles;
	}

	// Add address if available
	$street = get_field('location_street_address_1', 'option');
	$city = get_field('location_city', 'option');
	$state = get_field('location_state', 'option');
	$zip = get_field('location_zip_code', 'option');

	if ($street && $city && $state) {
		$schema['address'] = array(
			'@type' => 'PostalAddress',
			'streetAddress' => $street,
			'addressLocality' => $city,
			'addressRegion' => $state,
			'postalCode' => $zip,
			'addressCountry' => 'US',
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";

	// Add Article schema for blog posts
	if (is_singular('post')) {
		$post = get_queried_object();
		$article_schema = array(
			'@context' => 'https://schema.org',
			'@type' => 'Article',
			'headline' => get_the_title($post),
			'url' => get_permalink($post),
			'datePublished' => get_the_date('c', $post),
			'dateModified' => get_the_modified_date('c', $post),
			'author' => array(
				'@type' => 'Organization',
				'name' => get_bloginfo('name'),
			),
			'publisher' => array(
				'@type' => 'Organization',
				'name' => get_bloginfo('name'),
				'logo' => array(
					'@type' => 'ImageObject',
					'url' => get_template_directory_uri() . '/assets/images/g2o-logo.svg',
				),
			),
		);

		if (has_post_thumbnail($post)) {
			$article_schema['image'] = get_the_post_thumbnail_url($post, 'large');
		}

		echo '<script type="application/ld+json">' . wp_json_encode($article_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
	}
}
