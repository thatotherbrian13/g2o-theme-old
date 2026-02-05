<?php
/**
 * Stack: Quote
 * Styled quote section with optional logo.
 *
 * Variants: default, boxed
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Helper function to render quote logo (handles both ACF and mock)
if (!function_exists('g2o_render_quote_logo')) {
	function g2o_render_quote_logo($logo, $size = 'square', $class = 'max-w-full') {
		if (empty($logo)) return;

		$image_id = is_array($logo) ? ($logo['id'] ?? 0) : 0;
		$image_url = is_array($logo) ? ($logo['url'] ?? '') : '';
		$image_alt = is_array($logo) ? ($logo['alt'] ?? '') : '';

		if ($image_id) {
			$attr = array('class' => $class, 'loading' => false);
			echo wp_get_attachment_image($image_id, $size, false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}

// BOXED
if ($component_type == 'boxed') {

	$body = $args['body'] ?? get_sub_field('body');
	$attribution = $args['attribution'] ?? get_sub_field('attribution');
	$affiliation = $args['affiliation'] ?? get_sub_field('affiliation');
	$logo = $args['logo'] ?? get_sub_field('logo');
	$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
	$bg_color = $bg_color ?: 'transparent';

	$stack_class .= ' stack-quote-boxed py-15';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-3 md:col-span-12  lg:col-start-4 lg:col-span-10 '>";


					echo "<div class='quote__boxed bg-white p-10 lg:p-15 reveal'>";
						if ($body) echo "<div class='quote__body font-sans font-bold text-2xl text-river leading-normal mb-15'>" . acf_esc_html( $body ) . "</div>";

						echo "<div class='flex justify-between'>";
							echo "<div class='attribution'>";
								if ($attribution) echo "<div class='font-sans font-bold text-xs text-river leading-normal uppercase'>" . acf_esc_html( $attribution ) . "</div>";
								if ($affiliation) echo "<div class='font-sans font-bold text-xs text-city leading-normal uppercase'>" . acf_esc_html( $affiliation ) . "</div>";
							echo "</div>"; // row

							if( !empty( $logo ) ) {
								g2o_render_quote_logo($logo);
							}
						echo "</div>"; // flex
					echo "</div>"; // quote__boxed


				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain

		echo "<div class='quote__bg' style='background-color:" . acf_esc_html( $bg_color ) . "'></div>";

	echo "</section>"; // stack


} else {

	$body = $args['body'] ?? get_sub_field('body');
	$attribution = $args['attribution'] ?? get_sub_field('attribution');
	$affiliation = $args['affiliation'] ?? get_sub_field('affiliation');
	$logo = $args['logo'] ?? get_sub_field('logo');

	$stack_class .= ' bg-white py-15';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-3 md:col-span-12  lg:col-start-4 lg:col-span-10  xl:col-start-5 xl:col-span-8'>";



	//				echo "<div class='grid grid-cols-10 gap-x-2.5'>";

	//				echo "<div class='col-start-2 col-span-8'>";




						if ($body) echo "<div class='quote__body font-serif font-light text-2xl text-river leading-[1.3] mb-15'>" . acf_esc_html( $body ) . "</div>";
						if ($attribution) echo "<div class='font-sans font-light text-2xl text-river leading-tight mb-2'>" . acf_esc_html( $attribution ) . "</div>";
						if ($affiliation) echo "<div class='font-sans font-normal text-base text-river leading-tight'>" . acf_esc_html( $affiliation ) . "</div>";
	//				echo "</div>"; // col


												if( !empty( $logo ) ) {
													g2o_render_quote_logo($logo, 'square', 'max-w-full mb-15');
												}


				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack

}