<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-25 lg:py-35 bg-light';

$heading = get_sub_field('heading');
$deck = get_sub_field('deck');
$body = get_sub_field('body');
$link = get_sub_field('link');
$source = get_sub_field('source');

echo "<aside id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-span-full  lg:col-start-2 lg:col-span-14'>";


				echo "<div class='grid grid-cols-1  sm:grid-cols-2  md:grid-cols-3  xl:grid-cols-4  auto-rows-auto  gap-x-6 gap-y-12  lg:gap-x-12 lg:gap-y-12'>";

					echo "<div class='md:col-span-full xl:col-span-1 flex items-center'>";
						echo "<div class='reveal'>";
							if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";
							if ($deck) echo "<div class='deck text-river mb-12'>" . acf_esc_html( $deck ) . "</div>";
							if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
							echo acf_link( $link, 'box', 'text-river box-river mt-12' );
						echo "</div>"; // reveal
					echo "</div>"; // col

					if ($source == 'from_posts') {
						$rows = get_sub_field('posts');
						if ( $rows ) {
							foreach( $rows as $row ) {

								// WORK
								if( get_post_type( $row->ID ) == 'project') {

									$kicker = get_the_title( $row->ID );

									if( have_rows('header_stacks', $row->ID ) ) {
										while ( have_rows('header_stacks', $row->ID ) ) {
											the_row();
											if( get_row_layout() == 'stack_banner' ) {
												$headline = get_sub_field('headline');
											}
										}
									} else {
										// no rows found
									}

									$permalink = get_permalink( $row->ID );
									$link_label = "Read More";

									$attr = array(
										'class' => 'object-cover object-center',
									);
									$image = get_the_post_thumbnail( $row->ID, 'aspect-3-2', $attr );
								} else {

								// POST
									$category = get_the_category( $row->ID );
									$kicker = $category[0]->cat_name;
									$headline = get_the_title( $row->ID );

									$permalink = get_permalink( $row->ID );
									$link_label = "Discover More";

									$attr = array(
										'class' => 'object-cover object-center',
									);
									$image = get_the_post_thumbnail( $row->ID, 'aspect-3-2', $attr );
								}

								echo "<div class='col-span-1 flex flex-col bg-river reveal'>";
									if ($image) {
										echo "<a href='" . esc_url( $permalink ) . "' class='aspect-w-3 aspect-h-2'>";
											echo $image;
										echo "</a>";
									}

									echo "<div class='flex flex-col p-5 h-full'>";
										if ($kicker) echo "<div class='font-sans font-bold leading-normal text-[15px] text-sky mb-6'>" . acf_esc_html( $kicker ) . "</div>";
										if ($headline) echo "<div class='body text-white mb-10'>" . acf_esc_html( $headline ) . "</div>";
										echo "<div class='link-arrow text-sky arrow-white !mt-auto'><a href='" . esc_url( $permalink ) . "'><span>" . $link_label . "</span></a></div>";
									echo "</div>"; // flex
								echo "</div>"; // col
							}
						}



					} elseif ($source == 'from_terms') {

						$terms = get_sub_field('terms');
						if ($terms) {
							// Query arguments
							$args = array(
								'post_type'      => 'post', // Change this if you are querying a different post type
								'posts_per_page' => 3,
								'orderby'        => 'date',
								'order'          => 'DESC',
								'tax_query'      => array(
									array(
										'taxonomy' => 'category', // Change this if you are using a different taxonomy
										'field'    => 'term_id',
										'terms'    => $terms,
									),
								),
							 );

							// Execute the query
							$query = new WP_Query($args);

							// Check if the query returns any posts
							if ($query->have_posts()) {
								while ($query->have_posts()) {
									$query->the_post();
									// Output the post details
									$category = get_the_category();
									$kicker = $category[0]->cat_name;
									$headline = get_the_title();
									$permalink = get_permalink();
									$link_label = "Discover More";
									$attr = array(
										'class' => 'object-cover object-center',
									);
									$image = get_the_post_thumbnail( get_the_ID(), 'aspect-3-2', $attr );

									echo "<div class='col-span-1 flex flex-col bg-river reveal'>";
										if ($image) {
											echo "<a href='" . esc_url( $permalink ) . "' class='aspect-w-3 aspect-h-2'>";
												echo $image;
											echo "</a>";
										}
										echo "<div class='flex flex-col p-5 h-full'>";
											if ($kicker) echo "<div class='font-sans font-bold leading-normal text-[15px] text-sky mb-6'>" . acf_esc_html( $kicker ) . "</div>";
											if ($headline) echo "<div class='body text-white mb-10'>" . acf_esc_html( $headline ) . "</div>";
											echo "<div class='link-arrow text-sky arrow-white !mt-auto'><a href='" . esc_url( $permalink ) . "'><span>" . $link_label . "</span></a></div>";
										echo "</div>"; // flex
									echo "</div>"; // col
								}
								// Restore original Post Data
								wp_reset_postdata();
							} else {
								// echo '<p>No posts found.</p>';
							}
						} else {
							// echo '<p>No categories selected.</p>';
						}
					}

				echo "</div>"; // grid

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain

echo "</aside>"; // stack