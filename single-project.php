<?php
/**
 * The template for displaying all single projects
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package g2o
 */

get_header();

echo "<main id='main'>";

	while ( have_posts() ) :
		the_post();
		
//		get_template_part( 'template-parts/content', get_post_type() );
		get_template_part( 'template-parts/stacks', 'header' );
		get_template_part( 'template-parts/stacks', 'project' );
		get_template_part( 'template-parts/stacks', 'footer' );

	endwhile; // End of the loop.

echo "</main>";

get_footer();