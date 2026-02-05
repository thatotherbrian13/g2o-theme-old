<?php
/**
 * Stack: Graphs
 * Data visualization carousel with graphs and statistics.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
$stack_class .= ' py-15 lg:py-25';

// Field values: check $args first, then fall back to ACF
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$heading_alignment = $args['heading_alignment'] ?? get_sub_field('heading_alignment') ?? 'left';
$subhead = $args['subhead'] ?? get_sub_field('subhead');
$rows = $args['graphs'] ?? get_sub_field('graphs');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}

$count = count($rows);

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5 mb-18'>";

			echo "<div class='col-start-2 col-span-14 lg:col-start-3 lg:col-span-12 text-" . acf_esc_html( $heading_alignment ) . "'>";
				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-sky mb-4'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-snug -tracking-[0.02em] text-river'>" . acf_esc_html( $heading ) . "</h2>";
				echo "</div>"; // reveal
			echo "</div>"; // col

		echo "</div>"; // row
	echo "</div>"; // constrain



	echo "<div class='constrain'>";

		if ($subhead) {
			echo "<div class='row gap-x-2.5 mb-18'>";
//				echo "<div class='col-start-1 col-span-16 lg:col-start-3 lg:col-span-12 text-center'>";
				echo "<div class='col-start-2 col-span-14 lg:col-start-3 lg:col-span-12 text-center'>";

					echo "<div class='kicker text-river mb-4'>" . acf_esc_html( $subhead ) . "</div>";
				echo "</div>"; // col
			echo "</div>"; // row
		}


		if ( count($rows) ) {

			echo "<div class='row gap-x-2.5'>";
//				echo "<div class='col-start-2 col-span-14'>";
//				echo "<div class='col-start-1 col-span-16 lg:col-start-3 lg:col-span-12'>";

				echo "<div class='col-start-2 col-span-14 lg:col-start-3 lg:col-span-12'>";

					echo "<div class='swiper swiper-graphs w-full'>";
						echo "<div class='swiper-wrapper w-full'>";

							foreach( $rows as $row ) {
								$heading = $row['heading'];
								$body = $row['body'];
								$image = $row['image'];

								echo "<div class='swiper-slide swiper-slide-graphs bg-white'>";
//									echo "<div class='flex flex-col gap-y-12 md:flex-row w-full'>";

									echo "<div class='grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12 lg:gap-x-24 w-full'>";


//										echo "<div class='flex items-center md:w-1/2 md:order-last' style='border: 1px solid red'>";
										echo "<div class='flex items-center col-span-1 md:col-start-2 md:order-last'>";
											if( !empty( $image ) ) {
												echo "<img class='mx-auto max-w-full h-auto' src='" . esc_url($image['url']) . "' alt='" . esc_attr($image['alt']) . "'>";
											}
										echo "</div>"; // col

//										echo "<div class='flex items-center md:w-1/2 md:order-first' style='border: 1px solid red'>";
										echo "<div class='flex items-center col-span-1 md:col-start-1 md:order-first'>";
											echo "<div class='swiper-slide-content w-full'>";
												if ($heading) echo "<div class='font-sans text-3xl lg:text-4xl font-bold leading-snug -tracking-[0.02em] text-river     mb-8 text-center md:text-left'>" . acf_esc_html( $heading ) . "</div>";
												if ($body) echo "<div class='body text-pathway text-center md:text-left'>" . acf_esc_html( $body ) . "</div>";
											echo "</div>"; // swiper-slide-content
										echo "</div>"; // col

									echo "</div>"; // row
								echo "</div>"; // swiper-slide
							}

						echo "</div>"; // swiper-wrapper


						echo "<div class='swiper-buttons-graphs'>";
							echo "<div class='swiper-button-prev swiper-button-prev-graphs'></div>";
							echo "<div class='swiper-button-next swiper-button-next-graphs'></div>";
							echo "<div class='swiper-pagination swiper-pagination-graphs'></div>";
						echo "</div>"; // swiper-buttons

					echo "</div>"; // swiper

				echo "</div>"; // col
			echo "</div>"; // row
		}

	echo "</div>"; // constrain

echo "</section>"; // stack








$swiper_graphs = <<<EOT
var swiperGraphs = new Swiper(".swiper-graphs", {
	effect: "fade",
	keyboard: {
		enabled: true,
	},
	speed: 600,
	fadeEffect: {
		crossFade: true
	},
	preventInteractionOnTransition: false,
	freeMode: false,
	loop: true,
	roundLengths: true,
	slideToClickedSlide: true,
	spaceBetween: 0,
	pagination: { clickable: true, el: ".swiper-pagination-graphs" },
	navigation: {
		nextEl: '.swiper-button-next-graphs',
		prevEl: '.swiper-button-prev-graphs',
	},
});
EOT;
//wp_enqueue_script( 'wpdocs-my-script', 'https://url-to/my-script.js' );
wp_add_inline_script( 'g2o-script', $swiper_graphs, 'after' );


//		nextEl: '.swiper-button-next-graphs',