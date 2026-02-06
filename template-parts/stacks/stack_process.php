<?php
/**
 * Stack: Process
 * Process flow visualization with slides.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
$stack_class .= ' bg-river py-15 lg:py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$subhead = $args['subhead'] ?? get_sub_field('subhead');
$icon = $args['icon'] ?? get_sub_field('icon');

$rows = $args['slides'] ?? get_sub_field('slides');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5 mb-18'>";
			echo "<div class='col-start-3 col-span-12 text-center'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-white mb-4'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-white mb-9'>" . acf_esc_html( $heading ) . "</h3>";
					if( !empty( $icon ) ) {
						$icon_url = is_array($icon) ? ($icon['url'] ?? '') : '';
						$icon_alt = is_array($icon) ? ($icon['alt'] ?? '') : '';
						if ($icon_url) {
							echo "<div class='text-center mb-9'><img class='mx-auto' style='max-width: 80px; height: auto;' src='" . esc_url($icon_url) . "' alt='" . esc_attr($icon_alt) . "'></div>";
						}
					}
					if ($subhead) echo "<div class='kicker text-white mb-4'>" . acf_esc_html( $subhead ) . "</div>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain


//	echo "<div class='max-w-screen-2xl mx-auto relative z-10 px-0 lg:px-8'>";
	echo "<div class='mx-auto relative z-10'>";
//		echo "<div class='row gap-x-2.5'>";


//			echo "<div class='col-span-full      lg:col-start-3 lg:col-span-12'>";

				if( $rows ) {
					echo "<div class='swiper swiper-process'>";
						echo "<div class='swiper-wrapper'>";

							foreach( $rows as $row ) {

								$slide_icon = $row['icon'] ?? null;
								$slide_heading = $row['heading'] ?? null;
								$slide_body = $row['body'] ?? null;
								$image = $row['image'] ?? null;

								// Tighter spacing on heading when no body copy
								$heading_margin = $slide_body ? 'mb-6' : 'mb-4';

								echo "<div class='swiper-slide items-center text-center relative px-4'>";

									// Slide icon (sized elegantly)
									if( !empty( $slide_icon ) ) {
										$slide_icon_url = is_array($slide_icon) ? ($slide_icon['url'] ?? '') : '';
										$slide_icon_alt = is_array($slide_icon) ? ($slide_icon['alt'] ?? '') : '';
										if ($slide_icon_url) {
											echo "<div class='text-center mb-4'><img class='mx-auto' style='max-width: 64px; height: auto;' src='" . esc_url($slide_icon_url) . "' alt='" . esc_attr($slide_icon_alt) . "'></div>";
										}
									}

									if ($slide_heading) echo "<h3 class='font-serif font-light text-3xl lg:text-4xl leading-[1.3] -tracking-[0.02em] text-white " . $heading_margin . "'>" . acf_esc_html( $slide_heading ) . "</h3>";
									if ($slide_body) echo "<div class='body text-limestone mb-6'>" . acf_esc_html( $slide_body ) . "</div>";

//echo "</div>";

									if( !empty( $image ) ) {
										$image_url = is_array($image) ? ($image['url'] ?? '') : '';
										$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';
										if ($image_url) {
											echo "<div class='image'><img class='' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'></div>";
										}
									}

/*
									if ($image) {
										$image_id = $image['id'];
										$image_size = 'full';
										$attr = array(
											'class' => '',
										);
										echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
									}
*/

								echo "</div>"; // swiper-slide
							}

						echo "</div>"; // swiper-wrapper

						echo "<div class='swiper-button-next swiper-button-next-process'></div>";
						echo "<div class='swiper-button-prev swiper-button-prev-process'></div>";

					echo "</div>"; // swiper
				}
//			echo "</div>"; // col


//		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack



$swiper_process = <<<EOT
var swiperProcess = new Swiper(".swiper-process", {

	slidesPerView: 1,
	spaceBetween: 0,
	keyboard: {
		enabled: true,
	},
	breakpoints: {
		640: {
			slidesPerView: 1,
		},
		768: {
			slidesPerView: 2,
		},
		1024: {
			slidesPerView: 3,
		},
		1280: {
			slidesPerView: 3,
		}
	},

	navigation: {
		nextEl: ".swiper-button-next-process",
		prevEl: ".swiper-button-prev-process",
	},
});
EOT;
//wp_enqueue_script( 'wpdocs-my-script', 'https://url-to/my-script.js' );
wp_add_inline_script( 'g2o-script', $swiper_process, 'after' );