<?php
/**
 * The header for the G2O theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package g2o
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="font-sans font-normal text-base antialiased scroll-smooth outline-none">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

<style>[x-cloak] { display: none !important; }

/* Zodiak font - Light (300) is the brand-approved weight */
@font-face {
  font-family: 'Zodiak';
  src: url('<?php echo get_template_directory_uri(); ?>/fonts/Zodiak-Light.woff2') format('woff2'),
       url('<?php echo get_template_directory_uri(); ?>/fonts/Zodiak-Light.woff') format('woff');
  font-weight: 300;
  font-style: normal;
  font-display: swap;
}

@font-face {
  font-family: 'Zodiak';
  src: url('<?php echo get_template_directory_uri(); ?>/fonts/Zodiak-Regular.woff2') format('woff2'),
       url('<?php echo get_template_directory_uri(); ?>/fonts/Zodiak-Regular.woff') format('woff');
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}

.zodiak {
  font-family: 'Zodiak', serif;
  font-weight: 300; /* Light weight - brand approved */
}

.work-sans-bold {
  font-family: 'Work Sans', sans-serif;
  font-weight: 700; /* Bold weight - brand approved (not 800/extrabold) */
}





	</style><?php /* ALPINEJS */ ?>

<!-- Non-critical CSS loaded with print media trick for better performance -->
<link rel="stylesheet" href="https://unpkg.com/splitting/dist/splitting.css" media="print" onload="this.media='all'">
<noscript>
	<link rel="stylesheet" href="https://unpkg.com/splitting/dist/splitting.css">
</noscript>

<!-- Deferred scripts to prevent render blocking -->
<script src="https://unpkg.com/splitting/dist/splitting.min.js" defer></script>
<!-- Swiper is now bundled in scripts.js -->


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T8H9RVD4');</script>
<!-- End Google Tag Manager -->

<?php wp_head(); ?>
</head>


<?php
$page_theme = get_field('page_theme');

if( $page_theme ) {
	if( $page_theme == 'light' ) {
		$theme_color = "page-theme-light";
	} else {
		$theme_color = "page-theme-dark";
	}
} else {
	$theme_color = "page-theme-dark";
}

?>

<body <?php body_class( 'relative ' . $theme_color ); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T8H9RVD4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<?php wp_body_open(); ?>
<?php

// Load the accessible navigation system
get_template_part('template-parts/header/site-header');
?>

<?php
//echo "<div id='smoother-wrapper'>";
//	echo "<div id='smoother-content'>";