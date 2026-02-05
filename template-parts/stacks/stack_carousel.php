<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-river py-15 lg:py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$subhead = $args['subhead'] ?? get_sub_field('subhead');
$icon = $args['icon'] ?? get_sub_field('icon');
$link = $args['link'] ?? get_sub_field('link');
$link_classes = $args['link_classes'] ?? get_sub_field('link_classes');

$rows = $args['slides'] ?? get_sub_field('slides');

// Ensure rows is an array before proceeding
if (!is_array($rows) || empty($rows)) {
    $rows = [];
}

// Slides should be atleast double of slides per view to autoscroll
// Ref: https://github.com/nolimits4web/swiper/issues/6471
$slides = [];
if (!empty($rows)) {
    while (count($slides) < 6) {
        $slides = array_merge($slides, $rows);
    }
}

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5 mb-18'>";
			echo "<div class='col-start-3 col-span-12 text-center'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-sky mb-4'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h3 class='font-serif text-3xl lg:text-4xl font-light leading-[1.03] -tracking-[0.02em] text-white mb-9 w-4/5 mx-auto'>" . acf_esc_html( $heading ) . "</h3>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain


	echo "<div class='mx-auto relative z-10 px-4 md:px-8'>";
				if( $rows ) {
					echo "<div class='swiper swiper-process'>";
						echo "<div class='swiper-wrapper'>";

							foreach( $slides as $slide ) {

								$slide_heading = $slide['heading'];
								$slide_body = $slide['body'];
								$image = $slide['image'];


								echo "<div class='swiper-slide items-center text-center relative'>";
								echo "<div class='pb-12 px-6 relative'>";


                if ($slide_heading) echo "<h3 class=' text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-white mb-3'>" . acf_esc_html( $slide_heading ) . "</h3>";
                if ($slide_body) echo "<div class='body text-limestone'>" . acf_esc_html( $slide_body ) . "</div>";

				echo "</div>";

									if( !empty( $image ) ) {
										echo "<div class='image'><img class='' src='" . esc_url($image['url']) . "' alt='" . esc_attr($image['alt']) . "' width='" . esc_attr($image['width']) . "' height='" . esc_attr($image['height']) . "' loading='lazy'></div>";
									}

								echo "</div>"; // swiper-slide
							}

						echo "</div>"; // swiper-wrapper

						echo "<div class='swiper-button-next swiper-button-next-process'></div>";
						echo "<div class='swiper-button-prev swiper-button-prev-process'></div>";
						// echo "<div class='swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal'>";
						// 	echo "<span class='swiper-pagination-bullet' aria-current='true'>";
						// 	echo "</span>";
						// echo "</div>";
					echo "</div>"; // swiper
				}
				if ($link) {
					echo acf_link( $link, 'box', 'text-river box-river mt-12 px-4 ' . $link_classes);
				}

	echo "</div>"; // constrain
echo "</section>"; // stack



$swiper_process = <<<EOT
var swiperProcess = new Swiper(".swiper-process", {

spaceBetween: 0,
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
	// pagination: {
  //       el: ".swiper-pagination",
	// 	clickable: true,
  //   },
	autoplay: {
        delay: 4500,
        disableOnInteraction: false,
    },
	centeredSlides: true,
	loop: true,

});
EOT;
wp_add_inline_script( 'g2o-script', $swiper_process, 'after' );
