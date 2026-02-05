<?php
/**
 * Stack: Call to Action
 * Flexible CTA sections with image and text layouts.
 *
 * Variants: column, row, row_left
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
$link = $args['link'] ?? get_sub_field('link');
$image = $args['image'] ?? get_sub_field('image');
$component_type = $args['component_type'] ?? get_sub_field('component_type');


// Helper function to output image (handles both ACF and mock)
if (!function_exists('g2o_render_cta_image')) {
	function g2o_render_cta_image($image, $size = 'aspect-5-6', $class = '') {
		if (empty($image)) return;

		$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
		$image_url = is_array($image) ? ($image['url'] ?? '') : '';
		$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

		if ($image_id) {
			$attr = array('class' => $class, 'loading' => false);
			echo wp_get_attachment_image($image_id, $size, false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}


// ROW LEFT
if ($component_type == "row_left") {
	$stack_class .= ' stack-cta-row-left text-gunmetal py-10 md:py-20 lg:py-25 xl:py-35';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5 gap-y-15 grid-rows-2 md:grid-rows-1   items-center'>";

				echo "<div class='row-start-1  col-start-4 col-span-10   md:col-start-3 md:col-span-5'>";
					if( !empty( $image ) ) {
						echo "<div class='relative reveal'>";
							echo "<div class='cta-image aspect-w-5 aspect-h-6'>";
								g2o_render_cta_image($image, 'aspect-5-6');
							echo "</div>";
						echo "</div>";
					}
				echo "</div>"; // col


				echo "<div class='row-start-2  md:row-start-1  col-start-2 col-span-14  md:col-start-9 md:col-span-6'>";

					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-gunmetal mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-gunmetal mb-6'>" . $heading . "</h2>";
						if ($deck) echo "<div class='body text-pathway'>" . acf_esc_html( $deck ) . "</div>";
						echo acf_link( $link, 'box', 'text-river box-river mt-12' );
					echo "</div>"; // reveal

				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack



// ROW
} elseif ($component_type == "row") {
	$stack_class .= ' stack-cta-row text-gunmetal py-10 md:py-20 lg:py-25 xl:py-35';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5 gap-y-15 grid-rows-2 md:grid-rows-1   items-center'>";

				echo "<div class='row-start-1  col-start-2 col-span-14  md:col-start-9 md:col-span-5'>";
					if( !empty( $image ) ) {
						echo "<div class='cta-image-container'>";
							echo "<div class='cta-image aspect-w-5 aspect-h-6'>";
								g2o_render_cta_image($image, 'aspect-5-6');
							echo "</div>";
						echo "</div>";
					}
				echo "</div>"; // col


				echo "<div class='row-start-2  md:row-start-1  col-start-2 col-span-14  md:col-start-4 md:col-span-4'>";

					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-gunmetal mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-gunmetal mb-6'>" . acf_esc_html( $heading ) . "</h2>";
						if ($deck) echo "<div class='deck text-gunmetal mb-12'>" . acf_esc_html( $deck ) . "</div>";
						if ($body) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";
						echo acf_link( $link, 'box', 'text-river box-river mt-12' );
					echo "</div>"; // reveal

				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack


// COLUMN (default)
} else {
	$stack_class .= ' stack-cta-col text-gunmetal py-10 md:py-20 lg:py-25 xl:py-35';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row'>";
				echo "<div class='col-start-2 col-span-14   md:col-start-5 md:col-span-8 text-center'>";

					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-gunmetal mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='font-serif text-2xl lg:text-3xl font-light leading-[1.4] text-gunmetal mb-12'>" . acf_esc_html( $heading ) . "</h2>";
						if ($deck) echo "<div class='deck text-gunmetal mb-12'>" . acf_esc_html( $deck ) . "</div>";
						if ($body) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";
						echo acf_link( $link, 'box', 'text-river box-river justify-center mt-12' );
					echo "</div>"; // reveal

				echo "</div>"; // col
			echo "</div>"; // grid

		echo "</div>"; // constrain
	echo "</section>"; // stack

}
