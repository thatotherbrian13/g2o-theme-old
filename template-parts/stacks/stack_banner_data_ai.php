<?php
/**
 * Stack: Banner Data AI
 * Full-screen hero banner for Data/AI solutions page.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Field values: check $args first, then fall back to ACF
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$deck = $args['deck'] ?? get_sub_field('deck');
$body = $args['body'] ?? get_sub_field('body');
$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');


$stack_class .= ' stack-banner-data-ai  flex items-center min-h-screen bg-river'; // min-h-screen lg:h-screen
echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='constrain z-1   flex flex-col    pt-35 pb-35'>"; // min-h-screen lg:h-screen

		echo "<div class='row mt-35 mb-20'>";
			echo "<div class='col-start-1 col-span-full  sm:col-start-3 sm:col-span-12  lg:col-start-4 lg:col-span-10 text-center'>";
				echo "<div class='reveal'>";
					if ($kicker) echo "<p class='kicker text-city mb-6 lg:mb-12'>" . acf_esc_html( $kicker ) . "</p>";
					if ($heading) echo "<h1 class='headline-hero text-white'>" . acf_esc_html( $heading ) . "</h1>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row


		echo "<div class='row'>";
			echo "<div class='col-start-1 col-span-full  sm:col-start-4 sm:col-span-10  lg:col-start-5 lg:col-span-8'>";
				echo "<div class='reveal bg-river p-10'>";
					if ($deck) echo "<div class='font-sans font-light text-xl lg:text-2xl leading-normal text-white mb-10'>" . acf_esc_html( $deck ) . "</div>";
					if ($body) echo "<div class='font-sans font-light text-lg tracking-tight text-white'>" . acf_esc_html( $body ) . "</div>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain


	if (!empty($bg_image)) {
		$url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
		$alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
		if ($url) {
			echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-top' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
		}
	}
echo "</section>"; // stack



//wp_reset_postdata();
