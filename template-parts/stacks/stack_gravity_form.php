<?php
/**
 * Stack: Gravity Form
 * Standalone Gravity Form embed.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';
$stack_class .= ' py-25';

// Get row data - ACF may store with field keys instead of names
$row_data = function_exists('get_row') ? get_row() : [];

// Helper to find field value by checking both field names and searching row data
$find_field_value = function($field_names, $row_data, $pattern = null) {
	// First try standard get_sub_field with each name
	foreach ((array)$field_names as $name) {
		$value = get_sub_field($name);
		if ($value) return $value;
	}
	// If row data has field keys, search for matching content
	if ($pattern && is_array($row_data)) {
		foreach ($row_data as $key => $value) {
			if (is_string($value) && preg_match($pattern, $value)) {
				return $value;
			}
		}
	}
	return null;
};

$kicker = $args['kicker'] ?? $find_field_value('kicker', $row_data);
$heading = $args['heading'] ?? $find_field_value('heading', $row_data);
// For gravity form shortcode, also search for [gravityform pattern in row data
$gravity_form_shortcode = $args['gravity_form_shortcode']
	?? $find_field_value(['gravity_form_shortcode', 'form_shortcode', 'shortcode'], $row_data, '/\[gravityform/i');
$disclaimer = $args['disclaimer'] ?? $find_field_value('disclaimer', $row_data);

// Get form shortcode (use shortcode if provided, otherwise show placeholder)
if ($gravity_form_shortcode) {
	$form_shortcode = do_shortcode($gravity_form_shortcode, true);
} else {
	$form_shortcode = '<div style="background: #f0f0f0; padding: 40px; text-align: center; border: 2px dashed #ccc; border-radius: 8px;"><p style="margin: 0; color: #666;">Form placeholder - configure Gravity Forms shortcode</p></div>';
}

$form_slug = $args['form_slug'] ?? get_sub_field('form_slug');
if (!empty($form_slug)) {
	$stack_id = $form_slug;
}

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain mx-auto'>";

		echo "<div class='row'>";
			echo "<div class='col-span-full text-center'>";
				echo "<div class='reveal'>";
					if ($heading) echo "<h2 class='text-gunmetal mb-4 font-bold text-3xl px-4'>" . acf_esc_html( $heading ) . "</h2>";
					if ($kicker) echo "<div class='text-gunmetal mb-8 font-bold'>" . acf_esc_html( $kicker ) . "</div>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row

		echo "<div class='row  mt-12'>";
			echo "<div class='col-span-full '>";

				echo "<div class='gravity-form-container'>";
					echo "<div class='two-col-from-container mx-auto w-4/5'>";
						echo $form_shortcode;
					echo "</div>";
					if ($disclaimer) echo "<div class='disclaimer text-sm'>" . $disclaimer . "</div>";
				echo "</div>"; // gravity-form-container

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain
echo "</section>"; // stack

/*
if ($form_id)
{
	$form = <<<EOT
		window.hsFormsOnReady = window.hsFormsOnReady || [];
		window.hsFormsOnReady.push(()=>{
			hbspt.forms.create({
				region: "na1",
				portalId: "3865288",
				formId: "$form_id",
				target: "#$form_target",
				css: '.hs-form input { background-color: transparent; }'
			})
		});
	EOT;

	// wp_enqueue_script( 'hubspot-form', 'https://js.hsforms.net/forms/embed/v2.js' );
	wp_add_inline_script( 'g2o-script', $form, 'after' );
}

*/