<?php
/**
 * Stack: Accordion
 * Expandable accordion sections.
 *
 * Variants: spread, spread_alt, simple
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Helper function to render accordion logo
if (!function_exists('g2o_render_accordion_logo')) {
	function g2o_render_accordion_logo($image, $size = 'square', $class = '') {
		if (empty($image)) return;

		$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
		$image_url = is_array($image) ? ($image['url'] ?? '') : '';
		$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

		// Use inline style as fallback for SVGs that ignore width/height attributes
		$svg_style = 'width: 40px; height: auto; display: block;';

		if ($image_id) {
			$attr = array(
				'class' => $class,
				'style' => $svg_style,
				'loading' => false
			);
			echo wp_get_attachment_image($image_id, $size, false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' style='" . esc_attr($svg_style) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}

// Get all fields with $args fallback
$heading = $args['heading'] ?? get_sub_field('heading');
$deck = $args['deck'] ?? get_sub_field('deck');
$body = $args['body'] ?? get_sub_field('body');
$accordion = $args['accordion'] ?? get_sub_field('accordion');
$link = $args['link'] ?? get_sub_field('link');

// Ensure accordion is an array
if (!is_array($accordion)) {
    $accordion = [];
}

if ($component_type == 'spread') {
	// SPREAD

	$stack_class .= ' stack-accordion-spread bg-gunmetal py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row'>";
				echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-14'>";
					if ($heading) echo "<h2 class='font-sans font-bold text-[38px] leading-tight text-sky mb-5'>" . acf_esc_html( $heading ) . "</h2>";
				echo "</div>"; // col
			echo "</div>"; // row

			echo "<div class='accordion accordion--spread'>";
				echo "<div class='row'>";
					echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-7 relative'>";
						if ($body) echo "<div class='font-sans font-normal text-base text-white mb-10'>" . acf_esc_html( $body ) . "</div>";

						if ( $accordion ) {
							$i = 1;
							echo "<div class='flex flex-col gap-y-2'>";

								foreach( $accordion as $item ) {
									echo "<div class='accordion-item flex flex-col gap-y-2'>";

										$item_heading = $item['heading'] ?? '';
										$class = ($i == 1) ? " active" : "";
										echo "<h3 class='accordion-header accordion-header-" . strval($i) . " font-sans font-bold text-2xl leading-[1.3em] tracking-tighter bg-black-stone text-white p-[25px] lg:px-10 rounded-2xl{$class}'>" . acf_esc_html($item_heading) . "</h3>";

										$item_logo    = $item['logo'] ?? null;
										$item_subhead = $item['subhead'] ?? '';
										$item_deck    = $item['deck'] ?? '';
										$item_body    = $item['body'] ?? '';
										$item_link    = $item['link'] ?? null;
										$class = ($i == 1) ? " active" : "";

										echo "<div class='accordion-body accordion-body-" . strval($i) . " transition-all bg-black-pearl rounded-2xl z-100 lg:absolute lg:top-0 lg:bottom-0 lg:left-10 lg:width-1/2 lg:translate-x-full lg:-right-10 lg:overflow-y-auto {$class}'>";
											echo "<div class='p-[25px] lg:p-10'>";
												if( !empty( $item_logo ) ) {
													g2o_render_accordion_logo($item_logo, 'square', 'max-w-full mb-3');
												}

												echo "<div class='font-sans font-bold text-xl leading-tight text-white mb-3'>" . $item_subhead . "</div>";
												echo "<div class='font-sans font-bold text-2xl text-white leading-[1.3em] mb-3'>" . $item_deck . "</div>";
												echo "<div class='font-sans font-normal text-base text-white mb-3'>" . $item_body . "</div>";
												echo acf_link( $item_link, 'box', 'text-white box-sky arrow-down mt-6' );
											echo "</div>"; // padding
										echo "</div>"; // accordion-body
										$i++;

									echo "</div>"; // accordion-item
								}
							echo "</div>"; // flex
						}

					echo "</div>"; // col
				echo "</div>"; // row
			echo "</div>"; // accordion-spread


		echo "</div>"; // constrain
	echo "</section>"; // stack




} elseif ($component_type == 'spread_alt') {
	// SPREAD ALT

	$stack_class .= ' stack-accordion-spread-alt bg-gunmetal py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='accordion accordion--spread'>";
				echo "<div class='row'>";
					echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-7 relative'>"; //   lg:col-start-2 lg:col-span-7 relative

						if ($heading) echo "<h2 class='font-serif font-light text-4xl text-white mb-10'>" . acf_esc_html( $heading ) . "</h2>";

						if ( $accordion ) {
							$i = 1;
							echo "<div class='flex flex-col gap-y-2'>";

								foreach( $accordion as $item ) {
									echo "<div class='accordion-item'>";

										$item_heading = $item['heading'] ?? '';
										$class = ($i == 1) ? " active" : "";
										echo "<h3 class='accordion-header accordion-header-" . strval($i) . " font-sans font-bold text-[28px] leading-[1.3em] tracking-tight bg-black-stone text-white p-[25px] lg:px-10 rounded-2xl{$class}'>" . acf_esc_html($item_heading) . "</h3>";

										$item_logo    = $item['logo'] ?? null;
										$item_subhead = $item['subhead'] ?? '';
										$item_deck    = $item['deck'] ?? '';
										$item_body    = $item['body'] ?? '';
										$item_link    = $item['link'] ?? null;
										$class = ($i == 1) ? " active" : "";

										echo "<div class='accordion-body accordion-body-" . strval($i) . " transition-all bg-black-pearl rounded-2xl z-100 lg:absolute lg:top-0 lg:bottom-0 lg:left-10 lg:width-1/2 lg:translate-x-full lg:-right-10 lg:overflow-y-auto {$class}'>";
											echo "<div class='p-[25px] lg:p-10'>";
												if( !empty( $item_logo ) ) {
													g2o_render_accordion_logo($item_logo, 'square', 'max-w-full mb-3');
												}
												echo "<div class='font-sans font-bold text-2xl leading-tight text-white mb-3'>" . $item_subhead . "</div>";
												echo "<div class='body text-lg text-white mb-3'>" . $item_deck . "</div>";
												echo acf_link( $item_link, 'box', 'text-white box-sky arrow-down mt-4' );
											echo "</div>"; // padding
										echo "</div>"; // accordion-body
										$i++;

									echo "</div>"; // accordion-item
								}
							echo "</div>"; // flex
						}

					echo "</div>"; // col
				echo "</div>"; // row
			echo "</div>"; // accordion-spread

		echo "</div>"; // constrain
	echo "</section>"; // stack



} else {
	// SIMPLE

	$stack_class .= ' stack-accordion-simple bg-black-pearl py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-1 col-span-full  lg:col-start-5 lg:col-span-8'>";

					echo "<div class='reveal text-center'>";
						if ($heading) echo "<h2 class='font-sans font-bold leading-tight text-[38px] text-white mb-9'>" . acf_esc_html( $heading ) . "</h2>";
						if ($deck) echo "<div class='font-sans font-light text-2xl text-white mb-9'>" . acf_esc_html( $deck ) . "</div>";
					echo "</div>"; // reveal

					// ACCORDION-SIMPLE
					if ( $accordion ) {
						echo "<div class='accordion accordion--simple   border-b border-white reveal'>";
							foreach( $accordion as $item ) {
								$item_heading = $item['heading'] ?? '';
								$item_subhead = $item['subhead'] ?? '';
								$item_deck    = $item['deck'] ?? '';
								$item_body    = $item['body'] ?? '';
								$item_link    = $item['link'] ?? null;


								// ACCORDION ITEM
								echo "<div class='accordion-item transition-all    border-x border-t border-white'>";

									echo "<div class='accordion-header border-b border-white'>";
										echo "<div class='p-5'>";
											echo "<h3 class='headline-card text-white'>" . acf_esc_html($item_heading) . "</h3>";
										echo "</div>";
									echo "</div>"; // accordion-header

									echo "<div class='accordion-body transition-all'>";
										echo "<div class='p-5'>";
											echo "<div class='font-sans font-bold text-xl leading-tight text-city mb-5'>" . $item_subhead . "</div>";
											echo "<div class='font-sans font-bold text-2xl text-white leading-[1.3em] mb-5'>" . $item_deck . "</div>";
											echo "<div class='font-sans font-normal text-base text-white mb-5'>" . $item_body . "</div>";
											echo acf_link( $item_link, 'box', 'text-white box-sky arrow-down mt-12' );
										echo "</div>";
									echo "</div>"; // accordion-body

								echo "</div>"; // accordion-item
							}
						echo "</div>"; // accordion
					}

					echo acf_link( $link, 'box', 'text-white box-city arrow-down mt-12 flex-col items-center reveal' );

				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack

/*

	$heading = get_sub_field('heading');
	$deck = get_sub_field('deck');
	$accordion = get_sub_field('accordion');
	$link = get_sub_field('link');

	$stack_class .= ' stack-accordion-simple bg-black-pearl py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-5 col-span-8' style='border: 1px solid blue;'>";

					echo "<div class='reveal'>";
						if ($heading) echo "<h2 class='font-sans font-bold leading-tight text-[38px] text-white text-center mb-5'>" . acf_esc_html( $heading ) . "</h2>";
						if ($deck) echo "<div class='font-sans font-light text-2xl text-white text-center mb-4'>" . acf_esc_html( $deck ) . "</div>";
					echo "</div>"; // reveal

					if ( $accordion ) {
						echo "<div class='accordion reveal'>";
							$i = 1;
							foreach( $accordion as $item ) {
								$item_heading = $item['heading'];
								$class = ($i == 1) ? " active" : "";

echo "<div clas='accordion-item'>";

								echo "<h3 class='accordion-header accordion-header-" . strval($i) . " border border-white font-sans font-bold text-xl leading-tight text-white p-5 {$class}'>" . acf_esc_html($item_heading) . "</h3>";

								$item_logo    = $item['logo'];
								$item_subhead = $item['subhead'];
								$item_deck    = $item['deck'];
								$item_body    = $item['body'];
								$item_link    = $item['link'];
								$class = ($i == 1) ? " active" : "";

								echo "<div class='border border-t-0 border-white accordion-spread-body accordion-spread-body-" . strval($i) . "{$class}'>";
									echo "<div class='p-5'>";



										echo "<div class='font-sans font-bold text-xl leading-tight text-city mb-5'>" . $item_subhead . "</div>";
										echo "<div class='font-sans font-bold text-2xl text-white leading-[1.3em] mb-5'>" . $item_deck . "</div>";
										echo "<div class='font-sans font-normal text-base text-white mb-5'>" . $item_body . "</div>";
										echo acf_link( $item_link, 'box', 'text-white box-sky arrow-down mt-12' );
									echo "</div>";
								echo "</div>"; // accordion-spread-body

echo "</div>"; // accordion-item

								$i++;
							}
						echo "</div>"; // accordion
					}

					echo "<div class='text-center reveal'>";
						echo acf_link( $link, 'box', 'text-white box-city arrow-down mt-12' );
					echo "</div>"; // reveal

				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack

*/
}

	//											echo "<div class='font-sans font-normal text-base text-white mb-5'>" . $item_body . "</div>";