<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package g2o
 */

$post_id = get_the_ID();
$post_class = get_post_class( '', $post_id );

$author = get_field('author');

echo "<article id='post-" . $post_id . "' class='" . esc_attr( implode( ' ', $post_class ) )  . "'>";

	// Background image for all blog post headers
	$header_bg_url = content_url( '/uploads/2023/07/46_72dpi-2048x1536.png' );

	echo "<header class='stack stack-header-post pt-35 lg:pt-45 relative xl:min-h-3/4' style='background-image: url(" . esc_url( $header_bg_url ) . "); background-size: cover; background-position: center;'>";
		echo "<div class='constrain z-30 relative'>";

			echo "<div class='row'>";
				echo "<div class='col-start-2 col-span-14 sm:col-start-2 sm:col-span-9 lg:col-start-3 lg:col-span-8 pb-20 sm:pb-45 lg:pb-55'>";

					$categories = get_the_category();
					$has_kicker = count($categories) > 0;
					if ($has_kicker) {
						echo "<div class='kicker text-river mb-8'>";
							foreach( $categories as $category) {
								$name = $category->name;
								$category_link = get_category_link( $category->term_id );
								echo "<a href='" . $category_link . "'>" . esc_attr( $name) . "</a>";
							}
						echo "</div>"; // kicker
					}

					$title_class = $has_kicker ? '' : 'mt-8';
					the_title( "<h1 class='font-serif font-light text-4xl lg:text-6xl leading-[1.2] lg:leading-[1.2] tracking-tight text-river mb-15 " . $title_class . "'>", "</h1>" );

					if ( $author ) echo "<div class='font-sans font-normal text-sm text-river mb-3'>" . esc_html( $author ) . "</div>";

					echo "<div class='font-sans font-medium text-xs text-pathway'>";
						g2o_posted_on();
					echo "</div>";

				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain

		// Featured image in bottom right corner - positioned absolute to header, aligned to browser edge
		if ( has_post_thumbnail( ) ) {
			$image_id = get_post_thumbnail_id( );
			$image_size = 'aspect-3-2';
			$attr = array(
				'class' => 'w-full h-auto block',
				'loading' => false,
			);
			echo "<div class='post-featured-image' style='display: none; position: absolute; bottom: 0; right: 0; width: 38%; z-index: 20;'>";
				echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
			echo "</div>";
			echo "<style>.post-featured-image { display: block !important; } @media (max-width: 639px) { .post-featured-image { display: none !important; } }</style>";
		}

	echo "</header>"; // stack

	get_template_part( 'template-parts/stacks', 'post' );


echo "</article>";