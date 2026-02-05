<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package g2o
 */

get_header();

echo "<main id='main'>";

	get_template_part( 'template-parts/stacks', 'header' );




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
										'taxonomy' => 'projects',
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


query_posts(array(
        'post_type' => 'project',
        'showposts' => 10
    ) );

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




		/*



				if ( have_posts() ) :

					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/card', 'project' );
					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
		*/

				echo "</div>"; // grid

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain

echo "</main>";


get_footer();