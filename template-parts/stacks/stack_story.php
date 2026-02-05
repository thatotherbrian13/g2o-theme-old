<?php
/**
 * Stack: Story
 * Narrative section with image and storytelling content.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
$stack_class .= ' py-25 lg:py-35';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');

$body_columns = $args['body_columns'] ?? get_sub_field('body_columns');
$body = $args['body'] ?? get_sub_field('body');
$body_column_2 = $args['body_column_2'] ?? get_sub_field('body_column_2');

$link = $args['link'] ?? get_sub_field('link');
$link_classes = $args['link_classes'] ?? get_sub_field('link_classes') ?? '';
$image = $args['image'] ?? get_sub_field('image');
$images = $args['images'] ?? get_sub_field('images');
$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');
$bg_color = $args['bg_color'] ?? get_sub_field('bg_color') ?? '';

if( empty( $images ) ) {
	$col2_start_classes = 'hidden lg:block col-start-8 col-span-8  row-start-1 lg:row-start-1  lg:col-start-11 lg:col-span-4';
} else {
	$col2_start_classes = 'col-span-14 col-start-2 row-start-2 lg:row-start-1 lg:col-span-6';
}

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . " " . $bg_color . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5 gap-y-15 auto-rows-auto lg:grid-rows-1'>";

			echo "<div class='" . $col2_start_classes . "'>";

				if( !empty( $image ) ) {
					$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
					$image_url = is_array($image) ? ($image['url'] ?? '') : '';
					$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

					echo "<div class='story-image relative aspect-w-1 aspect-h-1 reveal'>";
					if ($image_id) {
						$image_size = 'aspect-6-5';
						$attr = array(
							'class' => 'object-cover object-center',
							'loading' => false,
						);
						echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
					} elseif ($image_url) {
						echo "<img class='object-cover object-center' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
					}
					echo "</div>";
				}

				if( !empty( $images ) && is_array($images) ) {
					echo "<div class='story-images'>";
						foreach( $images as $img ) {
							$img_id = is_array($img) ? ($img['id'] ?? 0) : 0;
							$img_url = is_array($img) ? ($img['url'] ?? '') : '';
							$img_alt = is_array($img) ? ($img['alt'] ?? '') : '';

							if ($img_id) {
								$image_size = 'aspect-6-5';
								$attr = array(
									'class' => 'object-cover object-center',
									'loading' => false,
								);
								echo wp_get_attachment_image( $img_id, $image_size, false, $attr );
							} elseif ($img_url) {
								echo "<img class='object-cover object-center' src='" . esc_url($img_url) . "' alt='" . esc_attr($img_alt) . "'>";
							}
						}
					echo "</div>";
				}

			echo "</div>"; // col

			echo "<div class='col-start-2 col-span-14 row-start-1    lg:row-start-1 lg:col-start-3 lg:col-span-6'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-river mb-12'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h2 class='font-serif text-2xl lg:text-3xl font-light leading-[1.4] text-gunmetal mb-6'>" . acf_esc_html( $heading ) . "</h2>";
					if ( $body_columns == 'row') {
						echo "<div class='flex flex-col lg:flex-row lg:flex-nowrap lg:gap-6'>";
							if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
							if ($body_column_2) echo "<div class='body text-pathway'>" . acf_esc_html( $body_column_2 ) . "</div>";
						echo "</div>";
					} else {
						if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
					}
					echo acf_link( $link, 'box', 'text-river box-river mt-12 ' . $link_classes );
				echo "</div>"; // reveal

			echo "</div>"; // col

		echo "</div>"; // row
	echo "</div>"; // constrain


	if ($bg_image) {
		$url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
		$alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
		if ($url) {
			echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-center' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
		}
	}

echo "</section>"; // stack