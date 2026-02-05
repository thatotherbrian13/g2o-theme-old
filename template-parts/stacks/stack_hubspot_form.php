<?php
/**
 * Stack: HubSpot Form
 * Standalone HubSpot Form embed.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';
$stack_class .= ' py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$hubspot_form_shortcode = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
$form_id = $args['form_id'] ?? get_sub_field('form_id');
$form_slug = $args['form_slug'] ?? get_sub_field('form_slug');
$form_target = "hs-form-" . esc_attr( $stack_id );
$disclaimer = $args['disclaimer'] ?? get_sub_field('disclaimer');

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
				echo "<div class='hs-form-container '>";
					echo "<div id='". $form_target . "' class='two-col-from-container mx-auto w-4/5'>";
						// Show placeholder if no form ID
						if (empty($form_id)) {
							echo '<div style="background: #f0f0f0; padding: 40px; text-align: center; border: 2px dashed #ccc; border-radius: 8px;"><p style="margin: 0; color: #666;">Form placeholder - configure HubSpot form ID</p></div>';
						}
					echo "</div>";
					if ($disclaimer) echo "<div class='disclaimer text-sm'>" . $disclaimer . "</div>";
				echo "</div>";
			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain
echo "</section>"; // stack

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
