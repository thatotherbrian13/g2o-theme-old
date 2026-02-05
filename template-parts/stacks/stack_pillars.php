<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-15 lg:py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$rows = $args['pillars'] ?? get_sub_field('pillars');
$stack_body = $args['body'] ?? get_sub_field('body');

// Ensure rows is an array and get count safely
if (!is_array($rows)) {
    $rows = [];
}
$count = count($rows);

if ($count == 6) {
	$slidesPerView = 2;
	$slidesPerView_640 = 3;
	$slidesPerView_768 = 4;
	$slidesPerView_1024 = 5;
	$slidesPerView_1280 = 6;

	$centeredSlides = 'false';
	$centeredSlides_640 = 'false';
	$centeredSlides_768 = 'false';
	$centeredSlides_1024 = 'false';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'false';
	$centeredSlidesBounds_640 = 'false';
	$centeredSlidesBounds_768 = 'false';
	$centeredSlidesBounds_1024 = 'false';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'false';
	$centerInsufficientSlides_640 = 'false';
	$centerInsufficientSlides_768 = 'false';
	$centerInsufficientSlides_1024 = 'false';
	$centerInsufficientSlides_1280 = 'true';

} elseif ($count == 5) {
	$slidesPerView = 2;
	$slidesPerView_640 = 3;
	$slidesPerView_768 = 4;
	$slidesPerView_1024 = 5;
	$slidesPerView_1280 = 5;

	$centeredSlides = 'false';
	$centeredSlides_640 = 'false';
	$centeredSlides_768 = 'false';
	$centeredSlides_1024 = 'true';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'false';
	$centeredSlidesBounds_640 = 'false';
	$centeredSlidesBounds_768 = 'false';
	$centeredSlidesBounds_1024 = 'true';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'false';
	$centerInsufficientSlides_640 = 'false';
	$centerInsufficientSlides_768 = 'false';
	$centerInsufficientSlides_1024 = 'true';
	$centerInsufficientSlides_1280 = 'true';

} elseif ($count == 4) {
	$slidesPerView = 2;
	$slidesPerView_640 = 3;
	$slidesPerView_768 = 4;
	$slidesPerView_1024 = 4;
	$slidesPerView_1280 = 4;

	$centeredSlides = 'false';
	$centeredSlides_640 = 'false';
	$centeredSlides_768 = 'true';
	$centeredSlides_1024 = 'true';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'false';
	$centeredSlidesBounds_640 = 'false';
	$centeredSlidesBounds_768 = 'true';
	$centeredSlidesBounds_1024 = 'true';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'true';
	$centerInsufficientSlides_640 = 'true';
	$centerInsufficientSlides_768 = 'true';
	$centerInsufficientSlides_1024 = 'true';
	$centerInsufficientSlides_1280 = 'true';



} elseif ($count == 3) {
	$slidesPerView = 2;
	$slidesPerView_640 = 3;
	$slidesPerView_768 = 3;
	$slidesPerView_1024 = 3;
	$slidesPerView_1280 = 3;

	$centeredSlides = 'false';
	$centeredSlides_640 = 'true';
	$centeredSlides_768 = 'true';
	$centeredSlides_1024 = 'true';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'false';
	$centeredSlidesBounds_640 = 'true';
	$centeredSlidesBounds_768 = 'true';
	$centeredSlidesBounds_1024 = 'true';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'false';
	$centerInsufficientSlides_640 = 'true';
	$centerInsufficientSlides_768 = 'true';
	$centerInsufficientSlides_1024 = 'true';
	$centerInsufficientSlides_1280 = 'true';

} elseif ($count == 2) {
	$slidesPerView = 2;
	$slidesPerView_640 = 2;
	$slidesPerView_768 = 2;
	$slidesPerView_1024 = 2;
	$slidesPerView_1280 = 2;

	$centeredSlides = 'true';
	$centeredSlides_640 = 'true';
	$centeredSlides_768 = 'true';
	$centeredSlides_1024 = 'true';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'true';
	$centeredSlidesBounds_640 = 'true';
	$centeredSlidesBounds_768 = 'true';
	$centeredSlidesBounds_1024 = 'true';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'true';
	$centerInsufficientSlides_640 = 'true';
	$centerInsufficientSlides_768 = 'true';
	$centerInsufficientSlides_1024 = 'true';
	$centerInsufficientSlides_1280 = 'true';

} else {
	$slidesPerView = 1;
	$slidesPerView_640 = 1;
	$slidesPerView_768 = 1;
	$slidesPerView_1024 = 1;
	$slidesPerView_1280 = 1;

	$centeredSlides = 'true';
	$centeredSlides_640 = 'true';
	$centeredSlides_768 = 'true';
	$centeredSlides_1024 = 'true';
	$centeredSlides_1280 = 'true';

	$centeredSlidesBounds = 'true';
	$centeredSlidesBounds_640 = 'true';
	$centeredSlidesBounds_768 = 'true';
	$centeredSlidesBounds_1024 = 'true';
	$centeredSlidesBounds_1280 = 'true';

	$centerInsufficientSlides = 'true';
	$centerInsufficientSlides_640 = 'true';
	$centerInsufficientSlides_768 = 'true';
	$centerInsufficientSlides_1024 = 'true';
	$centerInsufficientSlides_1280 = 'true';

}


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5 mb-18'>";
			echo "<div class='col-start-1 col-span-16 lg:col-start-3 lg:col-span-12 text-center'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-river mb-4'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-snug -tracking-[0.02em] text-river'>" . acf_esc_html( $heading ) . "</h2>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain


//	echo "<div class='max-w-screen-2xl mx-auto relative z-10 px-0 lg:px-8'>";

	if( $rows ) {
		echo "<div class='mx-auto relative z-10 px-0'>";

			echo "<div class='swiper swiper-pillars pb-18 w-min mx-auto'>";
				echo "<div class='swiper-wrapper w-min mx-auto'>";
					foreach( $rows as $row ) {

						$heading = $row['heading'];
						$body = $row['body'];
						$image = $row['image'];

						echo "<div class='swiper-slide swiper-slide-pillars h-full cursor-grab'>";


							if( !empty( $image ) ) {

								echo "<img class='mx-auto' src='" . esc_url($image['url']) . "' alt='" . esc_attr($image['alt']) . "'>";

							}

							echo "<div class='slide-content w-4/5 mx-auto relative'>";
								if ($heading) echo "<div class='heading text-river mb-3 text-center'>" . acf_esc_html( $heading ) . "</div>";
								if ($body) echo "<div class='body text-pathway text-left'>" . acf_esc_html( $body ) . "</div>";
							echo "</div>"; // w
						echo "</div>"; // swiper-slide
					}

				echo "</div>"; // swiper-wrapper

//						echo "<div class='swiper-button-next swiper-button-next-pillars'></div>";
//						echo "<div class='swiper-button-prev swiper-button-prev-pillars'></div>";

				echo "<div class='swiper-pagination swiper-pagination-pillars'></div>";

			echo "</div>"; // swiper


			if ($stack_body) {
				echo "<div class='row gap-x-2.5 mt-8'>";
					echo "<div class='col-start-2 col-span-14 lg:col-start-4 lg:col-span-10 text-center'>";
						echo "<div class='pillar-border'>";
							echo "<div class='body text-river w-1/2 mx-auto'>". acf_esc_html( $stack_body ) . "</div>";
						echo "</div>"; // pillar-border
					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; //
	}

echo "</section>"; // stack




/*
	centeredSlides: true,
	centeredSlidesBounds: true,
	centerInsufficientSlides: true,
	setWrapperSize: false,
	navigation: {
		nextEl: ".swiper-button-next-pillars",
		prevEl: ".swiper-button-prev-pillars",
	},
*/

$swiper_pillars = <<<EOT
var swiperPillars = new Swiper(".swiper-pillars", {
	freeMode: {
		enabled: true,
		momentum: true,
	},
	roundLengths: true,
	slidesPerView: "auto",
	spaceBetween: 0,
	pagination: { clickable: true, el: ".swiper-pagination-pillars" },
});
EOT;
//wp_enqueue_script( 'wpdocs-my-script', 'https://url-to/my-script.js' );
wp_add_inline_script( 'g2o-script', $swiper_pillars, 'after' );


/*
	slidesPerView: {$slidesPerView},
	centeredSlides: {$centeredSlides},
	centeredSlidesBounds: {$centeredSlides},
	centerInsufficientSlides: {$centerInsufficientSlides},
	breakpoints: {
		640: {
			slidesPerView: {$slidesPerView_640},
			centeredSlides: {$centeredSlides_640},
			centeredSlidesBounds: {$centeredSlides_640},
			centerInsufficientSlides: {$centerInsufficientSlides_640},
		},
		768: {
			slidesPerView: {$slidesPerView_768},
			centeredSlides: {$centeredSlides_768},
			centeredSlidesBounds: {$centeredSlides_768},
			centerInsufficientSlides: {$centerInsufficientSlides_768},
		},
		1024: {
			slidesPerView: {$slidesPerView_1024},
			centeredSlides: {$centeredSlides_1024},
			centeredSlidesBounds: {$centeredSlides_1024},
			centerInsufficientSlides: {$centerInsufficientSlides_1024},
		},
		1280: {
			slidesPerView: {$slidesPerView_1280},
			centeredSlides: {$centeredSlides_1280},
			centeredSlidesBounds: {$centeredSlides_1280},
			centerInsufficientSlides: {$centerInsufficientSlides_1280},
		},
	},
*/


/*
$swiper_pillars = <<<EOT
var swiperPillars = new Swiper(".swiper-pillars", {
	slidesPerView: 2,
	spaceBetween: 0,
	roundLengths: true,
	setWrapperSize: true,



	breakpoints: {
		640: {
			slidesPerView: 3,
		},
		768: {
			slidesPerView: 4,
		},
		1024: {
			slidesPerView: 5,
		},
		1280: {
			slidesPerView: 6,
		},
		1536: {
			slidesPerView: 6,
		}
	},
	navigation: {
		nextEl: ".swiper-button-next-pillars",
		prevEl: ".swiper-button-prev-pillars",
	},
});
EOT;
*/