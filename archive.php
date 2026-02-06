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

/* $post_id = get_option('page_for_posts');

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
endif; */
?>

<?php
$taxonomy_prefix = 'category';
$term_id = get_the_category()[0]->cat_ID;
$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;
?>
<div class="stacks stacks--header">
	<section id="stack-banner-1" class="stack stack-banner stack-banner-wedge pt-15 pb-25">
		<div class="constrain">
			<div class="row gap-x-2.5">
				<div class="col-start-2 col-span-13  lg:col-start-3 lg:col-span-9">
					<div class="reveal" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
						<h1 class="kicker text-river mb-8">Perspectives</h1>
						<h2 class="headline text-4xl lg:text-7xl leading-[1.2] lg:leading-[1.2] text-river">
							<span class="zodiak"><?php the_field( 'category_headline_thin', $term_id_prefixed ); ?></span> 
							<span class="work-sans-bold"><?php the_field( 'category_headline_bold', $term_id_prefixed ); ?></span>
						</h2>
						<div class="deck text-pathway mt-16"><?php the_field( 'category_copy', $term_id_prefixed ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php





	echo "<div class='constrain pb-25'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-span-full  lg:col-start-2 lg:col-span-14'>";

				echo "<div class='grid grid-cols-1  sm:grid-cols-2  md:grid-cols-3  xl:grid-cols-4  auto-rows-auto  gap-x-6 gap-y-12  lg:gap-x-12 lg:gap-y-12'>";
					echo "<div class='md:col-span-full xl:col-span-1 flex items-center'>";
						echo "<div class='reveal'>";

							echo "<div class='categories'>";




								echo "<ul>";
//								$all_posts_url = get_post_type_archive_link( 'projects' );
//								echo "<li><a href='" . esc_url( $all_posts_url ) . "'>All</a></li>";
									wp_list_categories( array(

//										'taxonomy' => 'projects',
										'hide_title_if_empty' => true,
										'title_li' => NULL,
										'show_option_all' => "All",
										'show_option_none' => NULL,
										'orderby' => 'name',
										'order' => 'ASC',
										'hide_empty' => true,
										'style' => 'list',
										'use_desc_for_title' => 0,

									) );
								echo "</ul>";
							echo "</div>"; // categories

						echo "</div>"; // reveal
					echo "</div>"; // col




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


?>


<?php

get_footer();


