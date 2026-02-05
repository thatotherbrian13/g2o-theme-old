<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package g2o
 */

get_header();

echo "<main id='main'>";

	$args = array(
		'page_id' => get_queried_object_id(),
	);

	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/stacks', 'home-header', $args );
		get_template_part( 'template-parts/stacks', 'page' );
		get_template_part( 'template-parts/stacks', 'footer' );

	endwhile; // End of the loop.

echo "</main>";

get_footer();