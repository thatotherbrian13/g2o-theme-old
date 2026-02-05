<?php
/**
 * Stack: Subscribe
 * Newsletter subscription section.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';
$stack_class .= ' bg-white';

$heading = $args['heading'] ?? get_sub_field('heading');
$body = $args['body'] ?? get_sub_field('body');

$image = $args['image'] ?? get_sub_field('image');

// Helper function to render subscribe image
if (!function_exists('g2o_render_subscribe_image')) {
	function g2o_render_subscribe_image($image, $size = 'square', $class = '') {
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

$form_source = $args['form_source'] ?? get_sub_field('form_source');
$gravity_form_field = $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode');
$hubspot_form_field = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
if ($form_source == 'gravity' && $gravity_form_field) {
	$form_shortcode = do_shortcode($gravity_form_field, true);
} elseif ($form_source == 'hubspot' && $hubspot_form_field) {
	$form_shortcode = do_shortcode($hubspot_form_field, true);
} else {
	// Placeholder for preview
	$form_shortcode = '<div style="background: #f0f0f0; padding: 40px; text-align: center; border: 2px dashed #ccc; border-radius: 8px;"><p style="margin: 0; color: #666;">Form placeholder - configure Gravity Forms or HubSpot</p></div>';
}


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='grid grid-cols-1  md:grid-cols-2'>";

		echo "<div class='flex flex-col justify-center'>";

			if( !empty( $image ) ) {
				g2o_render_subscribe_image($image, 'square', 'object-cover object-center aspect-square md:aspect-auto md:w-full md:h-full');
			}

		echo "</div>"; // col


		echo "<div class='flex flex-col justify-center text-river'>";

			echo "<div class='grid grid-cols-8 gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-6  lg:col-start-2 lg:col-span-6'>";

					echo "<div class='py-15 lg:py-25'>";
						echo "<div class='reveal'>";

							if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-river mb-8'>" . acf_esc_html( $heading ) . "</h2>";
							if ($body) echo "<div class='body text-river pb-10'>" . acf_esc_html( $body ) . "</div>";

							echo $form_shortcode;

						echo "</div>"; // reveal
					echo "</div>"; //

				echo "</div>"; // col
			echo "</div>"; // grid


		echo "</div>"; // col


	echo "</div>"; // row
echo "</section>"; // stack