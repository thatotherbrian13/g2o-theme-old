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
//		get_template_part( 'template-parts/stacks', 'header' );


//$page_id = get_queried_object_id();
$post_id = get_option('page_for_posts');


//$page_id = ($args['page_id']) ? $args['page_id'] : get_queried_object_id();

if( have_rows( 'header_stacks', $post_id ) ):

	echo "<div class='stacks'>";

		while ( have_rows( 'header_stacks', $post_id ) ) : the_row();

			$layout = get_row_layout( 'header_stacks' );

			$args_id = str_replace("_", "-", $layout);

			$args_class = str_replace("stack_", "stack-", $layout);
			$args_class = str_replace("_", "-", $args_class);

			$args = array(
				'id' => $args_id . '-' . get_row_index(),
				'class' => 'stack ' . $args_class,
			);

			get_template_part( 'template-parts/stacks/' . $layout , null, $args );

		endwhile;


	echo "</div>"; // stacks

else :
	// no rows found

endif;







	echo "<div class='constrain pb-25'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-span-full  lg:col-start-2 lg:col-span-14'>";

				echo "<div class='grid grid-cols-1  sm:grid-cols-2  md:grid-cols-3  xl:grid-cols-4  auto-rows-auto  gap-x-6 gap-y-12  lg:gap-x-12 lg:gap-y-12'>";
					echo "<div class='md:col-span-full xl:col-span-1 flex items-center'>";


							echo "<div class='categories'>";




								echo "<ul>";
								$all_posts_url = get_post_type_archive_link( 'projects' );
								echo "<li class='current-cat'><a href='" . esc_url( $all_posts_url ) . "'>All</a></li>";
									wp_list_categories( array(

//										'taxonomy' => 'projects',
										'hide_title_if_empty' => true,
										'title_li' => NULL,
										'show_option_all' => NULL,
										'show_option_none' => NULL,
										'orderby' => 'name',
										'order' => 'ASC',
										'hide_empty' => true,
										'style' => 'list',
										'use_desc_for_title' => 0,

									) );
								echo "</ul>";
							echo "</div>"; // categories


					echo "</div>"; // col



/*
	while ( have_posts() ) :
		the_post();

				get_template_part( 'template-parts/card', get_post_type() );

	endwhile; // End of the loop.

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
*/


		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
//				get_template_part( 'template-parts/card', 'project' );
				get_template_part( 'template-parts/card', get_post_type() );
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;







				echo "</div>"; // grid

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain

echo "</main>";

get_footer();


/*
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'owl-carousel' );
}, 11);
*/