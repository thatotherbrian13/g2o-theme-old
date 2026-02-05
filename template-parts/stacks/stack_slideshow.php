<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-river py-15 lg:py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$rows = $args['slides'] ?? $args['slideshow'] ?? get_sub_field('slideshow');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}



echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' itemscope itemtype='https://schema.org/FAQPage'>";

	if ($kicker) {
		echo "<div class='constrain mb-20'>";
			echo "<div class='row'>";
				echo "<div class='col-start-2 col-span-14 text-center'>";
					echo "<div class='kicker text-sky'>" . acf_esc_html( $kicker ) . "</div>";
				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	}

	if ( $rows ) {
		echo "<div class='constrain'>";
			echo "<div class='row gap-y-4'>";
				echo "<div class='col-start-2 col-span-14'>";

					echo "<div class='swiper swiper-slideshow px-0 md:px-10 lg:px-20 xl:px-30'>";
						echo "<div class='swiper-wrapper'>";
							foreach( $rows as $row ) {
								$row_heading = $row['heading'];
								$row_body = $row['body'];


								echo "<div class='swiper-slide items-center relative px-0 md:px-10 lg:px-20 xl:px-30' itemscope itemprop='mainEntity' itemtype='https://schema.org/Question'>";
									echo "<div class='pb-12 relative'>";
										if ($row_heading) echo "<h3 class='font-serif text-3xl lg:text-4xl font-light leading-[1.3] -tracking-[0.02em] text-white mb-15' itemprop='name''>" . acf_esc_html( $row_heading ) . "</h3>";
										if ($row_body) echo "<div class='font-sans font-normal leading-relaxed text-white' itemscope itemprop='acceptedAnswer' itemtype='https://schema.org/Answer'><div itemprop='text'>" . acf_esc_html( $row_body ) . "</div></div>";
									echo "</div>";
								echo "</div>"; // swiper-slide
							}
						echo "</div>"; // swiper-wrapper

						echo "<div class='swiper-button-next swiper-button-next-slideshow hidden md:block'></div>";
						echo "<div class='swiper-button-prev swiper-button-prev-slideshow hidden md:block'></div>";


						echo "<div class='swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal'>";
							echo "<span class='swiper-pagination-bullet' aria-current='true'></span>";
						echo "</div>";
					echo "</div>"; // swiper

				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain

	}

echo "</section>"; // stack



$swiper_slideshow = <<<EOT
var swiperSlideshow = new Swiper(".swiper-slideshow", {
	spaceBetween: 0,
	slidesPerView: 1,
	keyboard: {
		enabled: true,
	},
	navigation: {
		nextEl: ".swiper-button-next-slideshow",
		prevEl: ".swiper-button-prev-slideshow",
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	autoplay: {
		delay: 20000,
		disableOnInteraction: false,
	},
	centeredSlides: true,
	loop: true,
});
EOT;
wp_add_inline_script( 'g2o-script', $swiper_slideshow, 'after' );
