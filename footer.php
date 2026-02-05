<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package g2o
 */

$pitch = get_field('site_pitch', 'option');
$copyright = get_field('site_copyright', 'option');

$map_url = get_field('location_map_url', 'option');
$street_address_1 = get_field('location_street_address_1', 'option');
$street_address_2 = get_field('location_street_address_2', 'option');
$city = get_field('location_city', 'option');
$state = get_field('location_state', 'option');
$zip_code = get_field('location_zip_code', 'option');
$tel = get_field('location_tel', 'option');


$facebook = get_field('social_facebook', 'option');
$instagram = get_field('social_instagram', 'option');
$linkedin = get_field('social_linkedin', 'option');
$twitter = get_field('social_twitter', 'option');


//echo '<!-- ' . basename( get_page_template() ) . ' -->';


echo "<footer id='footer' class='w-full pb-8 relative'>";
echo "<div class='relative z-20'>";

// BACKGROUND
echo "<div class='footer-bg text-white pt-28 pb-6 relative w-full'>"; // mx-5 lg:mx-8
echo "<div class='constrain'>";



// ROW 1: MAIN FOOTER CONTENT (Pitch, Menu, HQ in one row)
echo "<div class='row gap-x-2.5 mb-6 xl:mb-18'>";

// LEFT COLUMN: PITCH + SOCIAL (flexbox for mobile reordering)
echo "<div class='col-start-2 col-span-14 xl:col-start-2 xl:col-span-4 flex flex-col'>";

// PITCH - order-1 (first on mobile and desktop)
if ($pitch) echo "<div class='font-sans font-light text-[1.375rem] leading-snug mb-10 order-1'>" . acf_esc_html($pitch) . "</div>";

// SOCIAL - order-4 on mobile (last), order-2 on desktop (under pitch)
echo "<div class='order-4 xl:order-2 mt-8 xl:mt-0'>";
echo "<div class='kicker text-sky mb-5'>Connect With Us</div>";
echo "<div class='footer-social flex flex-row flex-wrap gap-8'>";
if ($linkedin) echo "<a class='w-6 h-6 text-limestone hover:text-sky transition-colors' title='LinkedIn' href='" . esc_url($linkedin) . "' target='_blank' rel='noopener noreferrer' aria-label='LinkedIn (opens in new window)'>" . file_get_contents(get_stylesheet_directory() . '/build/img/linkedin.svg') . "</a>";
if ($facebook) echo "<a class='w-6 h-6 text-limestone hover:text-sky transition-colors' title='Facebook' href='" . esc_url($facebook) . "' target='_blank' rel='noopener noreferrer' aria-label='Facebook (opens in new window)'>" . file_get_contents(get_stylesheet_directory() . '/build/img/facebook.svg') . "</a>";
if ($instagram) echo "<a class='w-6 h-6 text-limestone hover:text-sky transition-colors' title='Instagram' href='" . esc_url($instagram) . "' target='_blank' rel='noopener noreferrer' aria-label='Instagram (opens in new window)'>" . file_get_contents(get_stylesheet_directory() . '/build/img/instagram.svg') . "</a>";
if ($twitter) echo "<a class='w-6 h-6 text-limestone hover:text-sky transition-colors x-resize-logo' title='X' href='" . esc_url($twitter) . "' target='_blank' rel='noopener noreferrer' aria-label='X (opens in new window)'>" . file_get_contents(get_stylesheet_directory() . '/build/img/twitter.svg') . "</a>";
echo "</div>";
echo "</div>";

// MENU + OUR HQ - order-2 on mobile (grid with HQ inline)
echo "<div class='order-2 xl:hidden grid grid-cols-4 gap-x-2.5 gap-y-12 mb-12 hyphens-none'>";
wp_nav_menu(
  array(
    'walker' => new Footer_Menu_Walker(),
    'theme_location' => 'menu-footer',
    'container' => null,
    'item_class' => 'col-span-2 pr-4',
    'link_class' => 'dart dart-sky',
    'items_wrap' => '%3$s',
  )
);
// OUR HQ - inline with menu items on mobile
echo "<div class='col-span-2 pr-4'>";
echo "<div class='kicker text-sky mb-5'>Our HQ</div>";
echo "<div class='vcard'>";
echo "<div class='adr'>";
if ($map_url) echo "<a class='inline-block' href='" . esc_url($map_url) . "' target='_blank' rel='noopener noreferrer' aria-label='View location on map (opens in new window)'>";
if ($street_address_1) echo "<div class='street-address'>" . acf_esc_html($street_address_1) . "</div>";
if ($street_address_2) echo "<div class='street-address'>" . acf_esc_html($street_address_2) . "</div>";
if ($city) echo "<span class='locality'>" . acf_esc_html($city) . ", </span>";
if ($state) echo "<span class='region'>" . acf_esc_html($state) . " </span>";
if ($zip_code) echo "<span class='postal-code'>" . acf_esc_html($zip_code) . "</span>";
if ($map_url) echo "</a>";
echo "</div>";
if ($tel) echo "<div class='tel'><a href='tel:" . acf_esc_html($tel) . "'>" . acf_esc_html($tel) . "</a></div>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "</div>"; // left col

// CENTER + RIGHT: MENU + HQ in 2x2 grid (desktop only)
echo "<div class='hidden xl:grid col-start-7 col-span-8 grid-cols-2 gap-x-8 gap-y-12 hyphens-none'>";

// Output menu items (3 items: Careers, Perspectives, Contact - each takes 1 grid cell)
wp_nav_menu(
  array(
    'walker' => new Footer_Menu_Walker(),
    'theme_location' => 'menu-footer',
    'container' => null,
    'item_class' => 'pr-4',
    'link_class' => 'dart dart-sky',
    'items_wrap' => '%3$s',
  )
);

// OUR HQ - 4th item in the 2x2 grid
echo "<div class='pr-4'>";
echo "<div class='kicker text-sky mb-5'>Our HQ</div>";
echo "<div class='vcard'>";
echo "<div class='adr'>";
if ($map_url) echo "<a class='inline-block' href='" . esc_url($map_url) . "' target='_blank' rel='noopener noreferrer' aria-label='View location on map (opens in new window)'>";
if ($street_address_1) echo "<div class='street-address'>" . acf_esc_html($street_address_1) . "</div>";
if ($street_address_2) echo "<div class='street-address'>" . acf_esc_html($street_address_2) . "</div>";
if ($city) echo "<span class='locality'>" . acf_esc_html($city) . ", </span>";
if ($state) echo "<span class='region'>" . acf_esc_html($state) . " </span>";
if ($zip_code) echo "<span class='postal-code'>" . acf_esc_html($zip_code) . "</span>";
if ($map_url) echo "</a>";
echo "</div>";
if ($tel) echo "<div class='tel'><a href='tel:" . acf_esc_html($tel) . "'>" . acf_esc_html($tel) . "</a></div>";
echo "</div>";
echo "</div>";

echo "</div>";

echo "</div>"; // row



// BORDER
echo "<div class='row'>";
echo "<div class='border-t border-t-white my-16 col-start-2 col-span-14'></div>";
echo "</div>"; // grid



// ROW 3
echo "<div class='row gap-x-2.5'>";
// LEGAL
echo "<div class='col-start-2 col-span-14 xl:col-start-2 xl:col-span-7'>";
wp_nav_menu(
  array(
    'container' => '',
    'theme_location' => 'menu-legal',
    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
    'menu_class' => 'flex flex-col xl:flex-row flex-wrap gap-x-10 gap-y-6',
    'item_class' => 'font-sans font-normal text-xs text-river-light leading-normal', // current-menu-item
    'walker' => new Legal_Menu_Walker(),
    'link_class' => '',
  )
);
echo "</div>"; // col

// COPYRIGHT
echo "<div class='col-start-2 col-span-14 xl:col-start-9 xl:col-span-7'>";
if ($copyright) echo "<div class='font-sans font-normal text-xs text-river-light leading-normal mt-6 xl:mt-0 xl:text-right'>" . acf_esc_html($copyright) . "</div>";
echo "</div>"; // col
echo "</div>"; // grid




echo "</div>"; // constrain
echo "</div>"; // bg

echo "</div>"; // relative
echo "</footer>";



//	echo "</div>"; // smoother-wrapper
//echo "</div>"; // smoother-content

wp_footer();

// get_template_part( 'theme/inc/admin-grid', 'page' );
get_template_part( 'theme/inc/admin-breakpoint');

echo "</body>";
echo "</html>";