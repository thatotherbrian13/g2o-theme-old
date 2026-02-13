<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';

$component_type = $args['component_type'] ?? get_sub_field('component_type');
$grid_columns   = $args['grid_columns'] ?? get_sub_field('grid_columns');

// Pre-fetch all fields with $args fallback
$kicker  = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$deck    = $args['deck'] ?? get_sub_field('deck');
$cards   = $args['cards'] ?? get_sub_field('cards');
$link    = $args['link'] ?? get_sub_field('link');

// Ensure cards is an array
if (!is_array($cards)) {
	$cards = [];
}

// Grid column classes
$grid_class = 'grid grid-cols-1 md:grid-cols-2 gap-8';
if ($grid_columns === '3') {
	$grid_class = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8';
}


if ($component_type == 'light_on_dark') {
	// LIGHT ON DARK — Limestone cards on dark gradient background

	$stack_class .= ' stack-card-grid-light-on-dark pt-25 pb-15';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-2 xl:col-span-8'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<div class='kicker text-sky mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-sans font-bold text-4xl text-white mb-5'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-white/80 mb-16'>" . acf_esc_html( $deck ) . "</div>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $cards ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='" . esc_attr( $grid_class ) . "'>";
							foreach( $cards as $card ) {
								$card_heading = $card['heading'];
								$card_body    = $card['body'];
								$card_link    = isset($card['link']) ? $card['link'] : null;

								echo "<div class='bg-limestone rounded-sm border-t-2 border-city p-8 reveal'>";
									echo "<h3 class='font-sans font-bold text-xl text-river mb-3'>" . acf_esc_html($card_heading) . "</h3>";
									echo "<p class='font-sans font-light text-base text-gunmetal leading-relaxed'>" . acf_esc_html($card_body) . "</p>";
									if ($card_link) {
										echo acf_link( $card_link, 'source', 'text-river mt-6' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid
					echo "</div>"; // col
				echo "</div>"; // row
			}

			if ($link) {
				echo "<div class='row gap-x-2.5 mt-16'>";
					echo "<div class='col-start-2 col-span-14 text-center reveal'>";
						echo acf_link( $link, 'box', 'text-white box-white' );
					echo "</div>";
				echo "</div>";
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack



} elseif ($component_type == 'dark_on_light') {
	// DARK ON LIGHT — Dark river cards on limestone background

	$stack_class .= ' stack-card-grid-dark-on-light bg-limestone pt-25 pb-15';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-2 xl:col-span-8'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<div class='kicker text-city mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-sans font-bold text-4xl text-river mb-5'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-river mb-16'>" . acf_esc_html( $deck ) . "</div>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $cards ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='" . esc_attr( $grid_class ) . "'>";
							foreach( $cards as $card ) {
								$card_heading = $card['heading'];
								$card_body    = $card['body'];
								$card_link    = isset($card['link']) ? $card['link'] : null;

								echo "<div class='bg-river rounded-sm border-l-2 border-sky p-8 reveal'>";
									echo "<h3 class='font-sans font-bold text-xl text-white mb-3'>" . acf_esc_html($card_heading) . "</h3>";
									echo "<p class='font-sans font-light text-base text-white/80 leading-relaxed'>" . acf_esc_html($card_body) . "</p>";
									if ($card_link) {
										echo acf_link( $card_link, 'source', 'text-white mt-6' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid
					echo "</div>"; // col
				echo "</div>"; // row
			}

			if ($link) {
				echo "<div class='row gap-x-2.5 mt-16'>";
					echo "<div class='col-start-2 col-span-14 text-center reveal'>";
						echo acf_link( $link, 'box', 'text-river box-river' );
					echo "</div>";
				echo "</div>";
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack



} else {
	// SUBTLE — White cards with soft shadow on light background

	$stack_class .= ' stack-card-grid-subtle py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-2 xl:col-span-8'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<div class='kicker text-city mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-sans font-bold text-4xl text-river mb-5'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-river mb-16'>" . acf_esc_html( $deck ) . "</div>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $cards ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='" . esc_attr( $grid_class ) . "'>";
							foreach( $cards as $card ) {
								$card_heading = $card['heading'];
								$card_body    = $card['body'];
								$card_link    = isset($card['link']) ? $card['link'] : null;

								echo "<div class='bg-white rounded-sm shadow-sm border-l-2 border-city p-8 reveal'>";
									echo "<h3 class='font-sans font-bold text-xl text-river mb-3'>" . acf_esc_html($card_heading) . "</h3>";
									echo "<p class='font-sans font-light text-base text-pathway leading-relaxed'>" . acf_esc_html($card_body) . "</p>";
									if ($card_link) {
										echo acf_link( $card_link, 'source', 'text-river mt-6' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid
					echo "</div>"; // col
				echo "</div>"; // row
			}

			if ($link) {
				echo "<div class='row gap-x-2.5 mt-16'>";
					echo "<div class='col-start-2 col-span-14 text-center reveal'>";
						echo acf_link( $link, 'box', 'text-river box-river' );
					echo "</div>";
				echo "</div>";
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack

}
