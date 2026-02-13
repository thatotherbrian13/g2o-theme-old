<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';

$component_type  = $args['component_type'] ?? get_sub_field('component_type');
$checkmark_color = $args['checkmark_color'] ?? get_sub_field('checkmark_color');

$kicker  = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$deck    = $args['deck'] ?? get_sub_field('deck');
$items   = $args['items'] ?? get_sub_field('items');

// Ensure items is an array
if (!is_array($items)) {
	$items = [];
}

// Checkmark color mapping
$checkmark_colors = [
	'sky'   => ['bg' => 'bg-sky',   'text' => 'text-white'],
	'city'  => ['bg' => 'bg-city',  'text' => 'text-white'],
	'river' => ['bg' => 'bg-river', 'text' => 'text-white'],
	'white' => ['bg' => 'bg-white', 'text' => 'text-river'],
];
$checkmark_color = ($checkmark_color && isset($checkmark_colors[$checkmark_color])) ? $checkmark_color : 'sky';
$checkmark_bg   = $checkmark_colors[$checkmark_color]['bg'];
$checkmark_text = $checkmark_colors[$checkmark_color]['text'];


if ($component_type == 'light_on_dark') {
	// LIGHT ON DARK — White text on dark gradient background

	$stack_class .= ' stack-checklist-light-on-dark py-20 lg:py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";

				// Left column — kicker, heading, deck
				echo "<div class='col-start-2 col-span-14 lg:col-start-2 lg:col-span-5 mb-12 lg:mb-0'>";
					echo "<div class='reveal lg:sticky lg:top-40'>";

						if ($kicker) echo "<div class='kicker text-sky mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-serif font-light text-4xl lg:text-[3.5rem] leading-tight tracking-tight text-white mb-6'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<p class='font-sans font-light text-lg leading-relaxed text-white/80'>" . acf_esc_html( $deck ) . "</p>";

					echo "</div>";
				echo "</div>";

				// Right column — checklist items
				echo "<div class='col-start-2 col-span-14 lg:col-start-8 lg:col-span-8'>";
					echo "<div class='stack-checklist__items'>";

					foreach( $items as $index => $item ) {
						$item_heading = $item['heading'];
						$item_body    = $item['body'];
						$is_last      = $index === count($items) - 1;
						$border_class = $is_last ? '' : ' border-b border-white/15';

						echo "<div class='stack-checklist__item flex gap-4 lg:gap-5 py-6 lg:py-8" . $border_class . " reveal'>";

							// Checkmark circle
							echo "<div class='flex-shrink-0 w-8 h-8 lg:w-10 lg:h-10 rounded-full " . esc_attr( $checkmark_bg ) . " flex items-center justify-center mt-0.5'>";
								echo "<svg class='w-4 h-4 lg:w-5 lg:h-5 " . esc_attr( $checkmark_text ) . "' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'>";
									echo "<path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7' />";
								echo "</svg>";
							echo "</div>";

							// Text content
							echo "<div>";
								if ($item_heading) echo "<h3 class='font-sans font-bold text-lg lg:text-xl text-white mb-1 stack-checklist__heading'>" . acf_esc_html( $item_heading ) . "</h3>";
								if ($item_body) echo "<p class='font-sans font-light text-base text-white/80 leading-relaxed'>" . acf_esc_html( $item_body ) . "</p>";
							echo "</div>";

						echo "</div>";
					}

					echo "</div>";
				echo "</div>";

			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>";


} elseif ($component_type == 'dark_on_light') {
	// DARK ON LIGHT — Dark text on white background

	$stack_class .= ' bg-white py-20 lg:py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";

				// Left column — kicker, heading, deck
				echo "<div class='col-start-2 col-span-14 lg:col-start-2 lg:col-span-5 mb-12 lg:mb-0'>";
					echo "<div class='reveal lg:sticky lg:top-40'>";

						if ($kicker) echo "<div class='kicker text-city mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-serif font-light text-4xl lg:text-[3.5rem] leading-tight tracking-tight text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<p class='font-sans font-light text-lg leading-relaxed text-pathway'>" . acf_esc_html( $deck ) . "</p>";

					echo "</div>";
				echo "</div>";

				// Right column — checklist items
				echo "<div class='col-start-2 col-span-14 lg:col-start-8 lg:col-span-8'>";
					echo "<div class='stack-checklist__items'>";

					foreach( $items as $index => $item ) {
						$item_heading = $item['heading'];
						$item_body    = $item['body'];
						$is_last      = $index === count($items) - 1;
						$border_class = $is_last ? '' : ' border-b border-pathway-light';

						echo "<div class='stack-checklist__item flex gap-4 lg:gap-5 py-6 lg:py-8" . $border_class . " reveal'>";

							// Checkmark circle
							echo "<div class='flex-shrink-0 w-8 h-8 lg:w-10 lg:h-10 rounded-full " . esc_attr( $checkmark_bg ) . " flex items-center justify-center mt-0.5'>";
								echo "<svg class='w-4 h-4 lg:w-5 lg:h-5 " . esc_attr( $checkmark_text ) . "' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'>";
									echo "<path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7' />";
								echo "</svg>";
							echo "</div>";

							// Text content
							echo "<div>";
								if ($item_heading) echo "<h3 class='font-sans font-bold text-lg lg:text-xl text-river mb-1 stack-checklist__heading'>" . acf_esc_html( $item_heading ) . "</h3>";
								if ($item_body) echo "<p class='font-sans font-light text-base text-pathway leading-relaxed'>" . acf_esc_html( $item_body ) . "</p>";
							echo "</div>";

						echo "</div>";
					}

					echo "</div>";
				echo "</div>";

			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>";


} else {
	// DEFAULT — Limestone background

	$stack_class .= ' bg-limestone py-20 lg:py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";

				// Left column — kicker, heading, deck
				echo "<div class='col-start-2 col-span-14 lg:col-start-2 lg:col-span-5 mb-12 lg:mb-0'>";
					echo "<div class='reveal lg:sticky lg:top-40'>";

						if ($kicker) echo "<div class='kicker text-city mb-4'>" . acf_esc_html( $kicker ) . "</div>";

						if ($heading) echo "<h2 class='font-serif font-light text-4xl lg:text-[3.5rem] leading-tight tracking-tight text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<p class='font-sans font-light text-lg leading-relaxed text-pathway'>" . acf_esc_html( $deck ) . "</p>";

					echo "</div>";
				echo "</div>";

				// Right column — checklist items
				echo "<div class='col-start-2 col-span-14 lg:col-start-8 lg:col-span-8'>";
					echo "<div class='stack-checklist__items'>";

					foreach( $items as $index => $item ) {
						$item_heading = $item['heading'];
						$item_body    = $item['body'];
						$is_last      = $index === count($items) - 1;
						$border_class = $is_last ? '' : ' border-b border-pathway-light';

						echo "<div class='stack-checklist__item flex gap-4 lg:gap-5 py-6 lg:py-8" . $border_class . " reveal'>";

							// Checkmark circle
							echo "<div class='flex-shrink-0 w-8 h-8 lg:w-10 lg:h-10 rounded-full " . esc_attr( $checkmark_bg ) . " flex items-center justify-center mt-0.5'>";
								echo "<svg class='w-4 h-4 lg:w-5 lg:h-5 " . esc_attr( $checkmark_text ) . "' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'>";
									echo "<path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7' />";
								echo "</svg>";
							echo "</div>";

							// Text content
							echo "<div>";
								if ($item_heading) echo "<h3 class='font-sans font-bold text-lg lg:text-xl text-river mb-1 stack-checklist__heading'>" . acf_esc_html( $item_heading ) . "</h3>";
								if ($item_body) echo "<p class='font-sans font-light text-base text-pathway leading-relaxed'>" . acf_esc_html( $item_body ) . "</p>";
							echo "</div>";

						echo "</div>";
					}

					echo "</div>";
				echo "</div>";

			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>";

}
