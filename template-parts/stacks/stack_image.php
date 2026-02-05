<?php
/**
 * Stack: Image
 * Standalone image display section.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';

$column_width = $args['column_width'] ?? get_sub_field('column_width');
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$image = $args['image'] ?? get_sub_field('image');
$caption = $args['caption'] ?? get_sub_field('caption');

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';

// Helper function to render image (handles both ACF and mock)
if (!function_exists('g2o_render_stack_image')) {
	function g2o_render_stack_image($image, $class = '') {
		if (empty($image)) return;

		$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
		$image_url = is_array($image) ? ($image['url'] ?? '') : '';
		$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

		if ($image_id) {
			$attr = array('class' => $class, 'loading' => false);
			echo wp_get_attachment_image($image_id, 'full', false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}


// narrow normal wide wider full

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');

if ($column_width == "full") {

	$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
	$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";

		if( !empty( $image ) ) {
			echo "<div class='image relative mx-auto'>";
				g2o_render_stack_image($image);
			echo "</div>"; // image
		}

	echo "</section>"; // stack


} else {

	$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
	$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';
//	$stack_class .= ' py-15 lg:py-20';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
		echo "<div class='constrain'>";


			if ($kicker) {
				echo "<div class='row gap-x-2.5 mb-15'>";
					echo "<div class='col-start-2 col-span-14  md:col-start-3 md:col-span-12'>";
						echo "<div class='kicker text-gunmetal'>" . acf_esc_html( $kicker ) . "</div>";
					echo "</div>"; // col
				echo "</div>"; // row
			}


			echo "<div class='row gap-x-2.5'>";


				switch ($column_width) {
					case "wide":
						$class = "col-start-2 col-span-14  md:col-start-3 md:col-span-12  xl:col-start-4 xl:col-span-10";

						break;
					case "wider":
						$class = "col-start-2 col-span-14  md:col-start-3 md:col-span-12";

						break;
					case "widest":

						$class = "col-start-1 col-span-full  md:col-start-2 md:col-span-14";
						break;
					default:
						// normal
						$class = "col-start-2 col-span-14  md:col-start-3 md:col-span-12  lg:col-start-4 lg:col-span-10  xl:col-start-5 xl:col-span-8";
						break;
				}


				echo "<div class='" . $class . "'>";

					if( !empty( $image ) ) {
						echo "<div class='image relative mx-auto'>";
							g2o_render_stack_image($image);
						echo "</div>"; // image
					}

					if ($caption) echo "<div class='caption text-pathway w-full md:w-11/12 lg:10/12 xl:w-9/12 mt-8'>" . esc_html( $caption ) . "</div>";

				echo "</div>"; // col

			echo "</div>"; // row
		echo "</div>"; // constrain
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