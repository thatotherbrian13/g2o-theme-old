<?php
/**
 * Stack: Spread
 * Two-column spread with image and content.
 *
 * Variants: default, modern
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Helper function to render spread image (handles both ACF and mock)
if (!function_exists('g2o_render_spread_image')) {
	function g2o_render_spread_image($image, $size = 'square', $class = 'object-cover object-center aspect-square md:aspect-auto md:w-full md:h-full') {
		if (empty($image)) return;

		$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
		$image_url = is_array($image) ? ($image['url'] ?? '') : '';
		$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

		if ($image_id) {
			$attr = array('class' => $class, 'loading' => false);
			echo wp_get_attachment_image($image_id, $size, false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}

// MODERN
if ($component_type == 'modern') {

	$heading = $args['heading'] ?? get_sub_field('heading');

	$deck = $args['deck'] ?? get_sub_field('deck');
	$body = $args['body'] ?? get_sub_field('body');

	$link = $args['link'] ?? get_sub_field('link');
	$image = $args['image'] ?? get_sub_field('image');
	$image_alignment = $args['image_alignment'] ?? get_sub_field('image_alignment');

	$stack_class .= 'stack-spread-modern';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='grid grid-cols-1  md:grid-cols-2'>";

			$order = ($image_alignment == "right") ? "md:order-last" : "";
			echo "<div class='flex flex-col justify-center {$order}'>";


				if( !empty( $image ) ) {
					g2o_render_spread_image($image);
				}

			echo "</div>"; // col


			$order = ($image_alignment == "right") ? "md:order-first" : "";
			echo "<div class='flex flex-col justify-center {$order} bg-river'>";


				echo "<div class='grid grid-cols-8 gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-6'>";

						echo "<div class='py-15 lg:py-25'>";
							echo "<div class='reveal'>";



								if ($heading) echo "<h2 class='font-serif text-5xl font-light leading-tight tracking-tight text-sky mb-8'>" . acf_esc_html( $heading ) . "</h2>";

								if ($deck) echo "<div class='font-sans font-light text-2xl leading-normal text-white mb-6'>" . acf_esc_html( $deck ) . "</div>";
								if ($body) echo "<div class='body text-white'>" . acf_esc_html( $body ) . "</div>";
								echo acf_link( $link, 'box', 'text-white box-sky mt-12' );
							echo "</div>"; // reveal

						echo "</div>"; //

					echo "</div>"; // col
				echo "</div>"; // grid


			echo "</div>"; // col


		echo "</div>"; // row
	echo "</section>"; // stack


} else {
	$stack_class .= '';

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');

	$deck = $args['deck'] ?? get_sub_field('deck');

	$body_columns = $args['body_columns'] ?? get_sub_field('body_columns');
	$body = $args['body'] ?? get_sub_field('body');
	$body_column_2 = $args['body_column_2'] ?? get_sub_field('body_column_2');

	$link = $args['link'] ?? get_sub_field('link');
	$image = $args['image'] ?? get_sub_field('image');
	$image_alignment = $args['image_alignment'] ?? get_sub_field('image_alignment');

	$border_color = $args['border_color'] ?? get_sub_field('border_color');
	$class = ($border_color == "red") ? "border-city" : "border-limestone";



	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='grid grid-cols-1  md:grid-cols-2'>";

			$order = ($image_alignment == "right") ? "md:order-last" : "";
			echo "<div class='flex flex-col justify-center {$order}'>";


				if( !empty( $image ) ) {
					g2o_render_spread_image($image);
				}

			echo "</div>"; // col


			$order = ($image_alignment == "right") ? "md:order-first" : "";
			echo "<div class='flex flex-col justify-center {$order} bg-sky text-river'>";


				echo "<div class='grid grid-cols-8 gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-6'>";

						echo "<div class='py-15 lg:py-25'>";
							echo "<div class='reveal'>";
								if ($kicker) echo "<div class='kicker pb-4 mb-10 border-b {$class}'>" . acf_esc_html( $kicker ) . "</div>";
								if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-river mb-8'>" . acf_esc_html( $heading ) . "</h2>";
								if ($deck) echo "<div class='font-sans font-bold text-[1.375rem] leading-snug text-river mb-6'>" . acf_esc_html( $deck ) . "</div>";
								if ( $body_columns == 'row') {
									echo "<div class='flex flex-col lg:flex-row lg:flex-nowrap lg:gap-6'>";
										if ($body) echo "<div class='body text-river'>" . acf_esc_html( $body ) . "</div>";
										if ($body_column_2) echo "<div class='body text-river'>" . acf_esc_html( $body_column_2 ) . "</div>";
									echo "</div>";
								} else {
									if ($body) echo "<div class='body text-river'>" . acf_esc_html( $body ) . "</div>";
								}
								echo acf_link( $link, 'box', 'text-river box-river mt-12' );
							echo "</div>"; // reveal

						echo "</div>"; //

					echo "</div>"; // col
				echo "</div>"; // grid


			echo "</div>"; // col


		echo "</div>"; // row
	echo "</section>"; // stack


}






/*

							$url = $image['url'];
							$alt = $image['alt'];
							echo "<img src='" . esc_url( $url ) . "' alt='" . esc_attr( $alt ) . "'>";

							$id = $image['id'];
							echo $id;

							$title = $image['title'];
							echo $title;

							$filename = $image['filename'];
							echo $filename;

							$filesize = $image['filesize'];
							echo $filesize;

							$url = $image['url'];
							echo $url;

							$link = $image['link'];
							echo $link;

							$alt = $image['alt'];
							echo $alt;

							$author = $image['author'];
							echo $author;

							$description = $image['description'];
							echo $description;

							$caption = $image['caption'];
							echo $caption;

							$name = $image['name'];
							echo $name;

							$status = $image['status'];
							echo $status;

							$uploaded_to = $image['uploaded_to'];
							echo $uploaded_to;

							$date = $image['date'];
							echo $date;

							$modified = $image['modified'];
							echo $modified;

							$menu_order = $image['menu_order'];
							echo $menu_order;

							$mime_type = $image['mime_type'];
							echo $mime_type;

							$type = $image['type'];
							echo $type;

							$subtype = $image['subtype'];
							echo $subtype;

							$icon = $image['icon'];
							echo $icon;

							$width = $image['width'];
							echo $width;


							$sizes = $image['sizes'];

							$thumbnail = $sizes['thumbnail'];
							echo $thumbnail;

							$thumbnail_width = $sizes['thumbnail-width'];
							echo $thumbnail_width;

							$thumbnail_height = $sizes['thumbnail-height'];
							echo $thumbnail_height;

							$medium = $sizes['medium'];
							echo $medium;

							$medium_width = $sizes['medium-width'];
							echo $medium_width;

							$medium_height = $sizes['medium-height'];
							echo $medium_height;


							$medium_large = $sizes['medium_large'];
							echo $medium_large;

							$medium_large_width = $sizes['medium_large-width'];
							echo $medium_large_width;

							$medium_large_height = $sizes['medium_large-height'];
							echo $medium_large_height;


							$large = $sizes['large'];
							echo $large;

							$large_width = $sizes['large-width'];
							echo $large_width;

							$large_height = $sizes['large-height'];
							echo $large_height;


							$_1536x1536 = $sizes['1536x1536'];
							echo $_1536x1536;

							$_1536x1536_width = $sizes['1536x1536-width'];
							echo $_1536x1536_width;

							$_1536x1536_height = $sizes['1536x1536-height'];
							echo $_1536x1536_height;


							$_2048x2048 = $sizes['2048x2048'];
							echo $_2048x2048;

							$_2048x2048_width = $sizes['2048x2048-width'];
							echo $_2048x2048_width;

							$_2048x2048_height = $sizes['2048x2048-height'];
							echo $_2048x2048_height;
$stack = get_sub_field('stack_stack');

$ID = $article->ID;
echo get_post_field( 'post_name', $article->ID );
echo get_post_field( 'post_content', $article->ID );
echo get_post_status( $article->ID );
echo get_post_type( $article->ID );
echo get_the_author( $article->ID );
echo get_the_date( 'l F j, Y', $article->ID );
echo get_the_title( $article->ID );
*/