<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';

// Field values: check $args first, then fall back to ACF
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$body = $args['body'] ?? get_sub_field('body');

$image = $args['image'] ?? get_sub_field('image');
$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');
$rows = $args['items'] ?? $args['slides'] ?? get_sub_field('slides');

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$wedge = $args['wedge'] ?? get_sub_field('wedge');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}

if ($bg_image) {
	// IMAGE WITH TRANSPARENT WEDGE
	$stack_class .= ' bg-river pt-30';
} else {
	// WEDGE
	if ($wedge) {
		$stack_class .= ' pt-30 pb-75';
	} else {
		$stack_class .= ' py-25';
	}
}

if ($bg_color == 'white') {
	$text_class = '';
} else {
	$text_class = 'text-white';
}

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>"; // data-lenis-prevent


	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14 lg:col-start-2 lg:col-span-7'>";

//				echo "<div class='mb-12 pl-8 md:pl-25 border border-yellow'>";
//					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-sky mb-6'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h3 class='headline-section " . $text_class . "'>" . acf_esc_html( $heading ) . "</h3>";
						if ($body) echo "<div class='body " . $text_class . "'>" . acf_esc_html( $body ) . "</div>";
//					echo "</div>"; // reveal
//				echo "</div>";


				if( $rows ) {

//		echo "<div class='grid grid-cols-8 gap-x-2.5'>";
//		echo "<div class='col-start-1 col-span-15 lg:col-start-1 lg:col-span-8   xl:col-start-1 xl:col-span-8 border border-aqua'>";
		echo "<div class='grid grid-cols-2 gap-8 mt-18'>";

							foreach( $rows as $row ) {
								echo "<div class='col-span-2 sm:col-span-1'>"; //   h-100
									$row_kicker = $row['kicker'] ?? '';
									$row_heading = $row['heading'] ?? '';
									$row_body = $row['body'] ?? '';
									$icon = $row['icon'] ?? $row['image'] ?? null;

									if (!empty($icon)) {
										$icon_id = is_array($icon) ? ($icon['id'] ?? 0) : 0;
										$icon_url = is_array($icon) ? ($icon['url'] ?? '') : '';
										if ($icon_id) {
											$icon_src = wp_get_attachment_url( $icon_id );
											echo "<img class='max-w-[36px] mb-6' alt='' src='" . esc_url( $icon_src ) . "' width='36' height='36' loading='lazy'>";
										} elseif ($icon_url) {
											echo "<img class='max-w-[36px] mb-6' alt='' src='" . esc_url( $icon_url ) . "' width='36' height='36' loading='lazy'>";
										}
									}
									if ($row_kicker) echo "<div class='kicker text-sky mb-6'>" . acf_esc_html( $row_kicker ) . "</div>";
									if ($row_heading) echo "<h3 class='headline-section text-white mb-6'>" . acf_esc_html( $row_heading ) . "</h3>";
									if ($row_body) echo "<div class='body text-white'>" . acf_esc_html( $row_body ) . "</div>";

								echo "</div>"; // swiper-slide
							}



		echo "</div>"; // row

				}

			echo "</div>"; // col

			echo "<div class='hidden lg:block col-start-10 col-span-5'>";
				if( !empty( $image ) ) {
					$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
					$image_url = is_array($image) ? ($image['url'] ?? '') : '';
					$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';
					echo "<div class='scroller-image relative aspect-w-5 aspect-h-6'>";
					if ($image_id) {
						$image_size = 'aspect-5-6';
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
			echo "</div>"; // col

		echo "</div>"; // row
	echo "</div>"; // constrain


if( $wedge ) {
	if( !empty( $bg_image ) ) {
		$bg_image_id = is_array($bg_image) ? ($bg_image['id'] ?? 0) : 0;
		$bg_image_url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
		$bg_image_alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
		$image_size = 'aspect-2-1';
		$attr = array(
			'class' => 'object-cover object-center',
			'loading' => false,
		);
		echo "<div class='scroller-bg-image relative aspect-w-2 aspect-h-1'>";
		if ($bg_image_id) {
			echo wp_get_attachment_image( $bg_image_id, $image_size, false, $attr );
		} elseif ($bg_image_url) {
			echo "<img class='object-cover object-center' src='" . esc_url($bg_image_url) . "' alt='" . esc_attr($bg_image_alt) . "'>";
		}
		echo "</div>";
	} else {
		echo "<div class='wedge-reverse wedge-scroller wedge-river'></div>";

	}
}

/*


	if ($bg_image) {
		$image_id = $bg_image['id'];
		$image_size = 'aspect-2-1';
		$attr = array(
			'class' => '',
		);
		echo "<div class='scroller-bg-image'>";
		echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
		echo "</div>";
	} else {

		echo "<div class='wedge-reverse wedge-scroller wedge-river'></div>";

	}
*/




echo "</section>"; // stack