<?php
/**
 * Stack: Form
 * Contact and lead capture form sections.
 *
 * Variants: spread, team, download, shadow
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

$form_layout = $args['form_layout'] ?? get_sub_field('form_layout');

// Helper function to get form shortcode (handles mock data gracefully)
if (!function_exists('g2o_render_form_shortcode')) {
	function g2o_render_form_shortcode($form_source, $gravity_form, $hubspot_form) {
		if ($form_source == 'gravity' && $gravity_form) {
			return do_shortcode($gravity_form, true);
		} elseif ($form_source == 'hubspot' && $hubspot_form) {
			return do_shortcode($hubspot_form, true);
		}
		// Return placeholder for preview
		return '<div style="background: #f0f0f0; padding: 40px; text-align: center; border: 2px dashed #ccc; border-radius: 8px;"><p style="margin: 0; color: #666;">Form placeholder - configure Gravity Forms or HubSpot</p></div>';
	}
}

// Helper function to render form image
if (!function_exists('g2o_render_form_image')) {
	function g2o_render_form_image($image, $size = 'aspect-5-6', $class = '') {
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

if ($form_layout == 'spread') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$body = $args['body'] ?? get_sub_field('body');
	$disclaimer = $args['disclaimer'] ?? get_sub_field('disclaimer');

	$include_vcard = $args['include_vcard'] ?? get_sub_field('include_vcard');
	$bg_color_field = $args['bg_color'] ?? get_sub_field('bg_color');
	$text_color_field = $args['text_color'] ?? get_sub_field('text_color');
	$bg_color = $bg_color_field ?: 'transparent';
	$text_color = $text_color_field ?: '#234253';

	$form_source = $args['form_source'] ?? get_sub_field('form_source');
	$gravity_form_field = $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode');
	$hubspot_form_field = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
	$form_shortcode = g2o_render_form_shortcode($form_source, $gravity_form_field, $hubspot_form_field);

	$unique_id = $args['unique_id'] ?? get_sub_field('unique_id');
	$id = ($unique_id) ? $unique_id : $stack_id;

	$stack_class .= ' stack-form--spread py-25';
	echo "<section id='" . esc_attr( $id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "; color:" . acf_esc_html( $text_color ) . ";'>";
		echo "<div class='constrain'>";
//			echo "<div class='row gap-x-2.5 items-center gap-y-10'>";

//		echo "<div class='constrain  row gap-y-4'>";
			echo "<div class='row gap-x-2.5 gap-y-10 items-center'>";



				echo "<div class='col-start-2 col-span-14   md:col-start-2 md:col-span-6  xl:col-start-2 xl:col-span-5'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] mb-6'>" . acf_esc_html( $heading ) . "</h3>";
						if ($deck) echo "<div class='deck mb-12'>" . acf_esc_html( $deck ) . "</div>";
						if ($body) echo "<div class='body m-0 opacity-80'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // reveal


					if ($include_vcard == 'yes') {
						$map_url = get_field( 'location_map_url', 'option' );
						$street_address_1 = get_field( 'location_street_address_1', 'option' );
						$street_address_2 = get_field( 'location_street_address_2', 'option' );
						$city = get_field( 'location_city', 'option' );
						$state = get_field( 'location_state', 'option' );
						$zip_code = get_field( 'location_zip_code', 'option' );
						$tel = get_field( 'location_tel', 'option' );
						echo "<div class='reveal vcard mt-12 mb-0'>";
							echo "<div class='adr'>";
								if ($map_url) echo "<a class='inline-block' href='" . esc_url( $map_url ) . "' target='_blank' rel='noopener noreferrer' aria-label='View location on map (opens in new window)'>";
									if ($street_address_1) echo "<div class='street-address'>" . acf_esc_html( $street_address_1 ) . "</div>";
									if ($street_address_2) echo "<div class='street-address'>" . acf_esc_html( $street_address_2 ) . "</div>";
									if ($city) echo "<span class='locality'>" . acf_esc_html( $city ) . ", </span>";
									if ($state) echo "<span class='region'>" . acf_esc_html( $state ) . " </span>";
									if ($zip_code) echo "<span class='postal-code'>" . acf_esc_html( $zip_code ) . "</span>";
								if ($map_url) echo "</a>";
							echo "</div>";

							if ($tel) echo "<div class='tel'><a href='tel:" . esc_url( $tel ) . "'>" . acf_esc_html( $tel ) . "</a></div>";
						echo "</div>"; // vcard
					}

				echo "</div>"; // col



//				echo "<div class='col-start-2 col-span-14  md:col-start-9 md:col-span-7  xl:col-start-9 xl:col-span-6'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-9 md:col-span-8  xl:col-start-9 xl:col-span-6'>";

					echo "<div class='form-container'>";
						echo "<div class='form-main' role='region' aria-label='" . esc_attr__('Contact form', 'g2o') . "'>" . $form_shortcode . "</div>";
						if ($disclaimer) echo "<div class='disclaimer text-sm mt-6'>" . acf_esc_html( $disclaimer ) . "</div>";
					echo "</div>";
				echo "</div>"; // col

			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack


} elseif ($form_layout == 'team') {

	$heading = $args['heading'] ?? get_sub_field('heading');
	$body = $args['body'] ?? get_sub_field('body');
	$person = $args['person'] ?? get_sub_field('person');

	$bg_color_field = $args['bg_color'] ?? get_sub_field('bg_color');
	$text_color_field = $args['text_color'] ?? get_sub_field('text_color');
	$accent_color_field = $args['accent_color'] ?? get_sub_field('accent_color');
	$bg_color = $bg_color_field ?: '#FFFFFF';
	$text_color = $text_color_field ?: '#234253';
	$accent_color = $accent_color_field ?: '#ff4f55';

	$form_source = $args['form_source'] ?? get_sub_field('form_source');
	$gravity_form_field = $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode');
	$hubspot_form_field = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
	$form_shortcode = g2o_render_form_shortcode($form_source, $gravity_form_field, $hubspot_form_field);

	$unique_id = $args['unique_id'] ?? get_sub_field('unique_id');
	$id = ($unique_id) ? $unique_id : $stack_id;


	$stack_class .= ' stack-form--team text-river py-25';
	echo "<section id='" . esc_attr( $id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . ";color:" . acf_esc_html( $text_color ) . ";'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-10 md:gap-10 grid grid-cols-8 md:grid-cols-16 items-center'>";

				echo "<div class='col-start-1 col-span-8  md:col-start-2 md:col-span-10   lg:col-start-1 lg:col-span-5'>";
					echo "<div class='reveal'>";
						if ($heading) echo "<h3 class='font-sans font-bold text-3xl lg:text-[40px] leading-[1.03] -tracking-[0.02em] mb-6' style='color:" . acf_esc_html( $accent_color ) . ";'>" . acf_esc_html( $heading ) . "</h3>";
						if ($body) echo "<div class='body text-lg m-0'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // reveal
				echo "</div>"; // col



				echo "<div class='col-start-3 col-span-4    md:col-start-12 md:col-span-4  lg:col-start-6 lg:col-span-3'>";
					echo "<div class='reveal'>";
						if ( $person ) {
							$portrait = $person['portrait'] ?? null;
							$full_name = $person['full_name'] ?? '';
							$role = $person['role'] ?? '';

							if( !empty( $portrait ) ) {
								echo "<div class='cta-image aspect-w-4 aspect-h-5 mb-3'>";
									g2o_render_form_image($portrait, 'aspect-5-6', 'img-fluid');
								echo "</div>";
							}
							if ($full_name) echo "<div class='font-sans font-bold leading-normal tracking-tight text-2xl mb-2'>" . acf_esc_html( $full_name ) . "</div>";
							if ($role) echo "<div class='font-sans font-bold text-sm leading-normal uppercase'>" . acf_esc_html( $role ) . "</div>";
						}
					echo "</div>"; // reveal
				echo "</div>"; // col




				echo "<div class='col-start-1 col-span-8    md:col-start-2 md:col-span-14  lg:col-start-10 lg:col-span-7'>";
					echo "<div class='form-container'>";
						echo "<div class='form-main' role='region' aria-label='" . esc_attr__('Contact form', 'g2o') . "'>" . $form_shortcode . "</div>";
					echo "</div>";
				echo "</div>"; // col


			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack







} elseif ($form_layout == 'download') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$body = $args['body'] ?? get_sub_field('body');
	$disclaimer = $args['disclaimer'] ?? get_sub_field('disclaimer');

	$include_vcard = $args['include_vcard'] ?? get_sub_field('include_vcard');
	$form_image = $args['form_image'] ?? get_sub_field('form_image');

	$form_source = $args['form_source'] ?? get_sub_field('form_source');
	$gravity_form_field = $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode');
	$hubspot_form_field = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
	$form_shortcode = g2o_render_form_shortcode($form_source, $gravity_form_field, $hubspot_form_field);

	$unique_id = $args['unique_id'] ?? get_sub_field('unique_id');
	$id = ($unique_id) ? $unique_id : $stack_id;

	$stack_class .= ' stack-form--download bg-white text-river py-25';
	echo "<section id='" . esc_attr( $id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5 items-center gap-y-10'>";

				echo "<div class='col-start-2 col-span-14   md:col-start-2 md:col-span-6  xl:col-start-3 xl:col-span-5'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-sky m-0'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-river mt-8'>" . acf_esc_html( $heading ) . "</h3>";
						if ($deck) echo "<div class='deck text-river mt-6'>" . acf_esc_html( $deck ) . "</div>";
						if ($body) echo "<div class='body text-river mt-12'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // reveal


					if ($include_vcard == 'yes') {
						$map_url = get_field( 'location_map_url', 'option' );
						$street_address_1 = get_field( 'location_street_address_1', 'option' );
						$street_address_2 = get_field( 'location_street_address_2', 'option' );
						$city = get_field( 'location_city', 'option' );
						$state = get_field( 'location_state', 'option' );
						$zip_code = get_field( 'location_zip_code', 'option' );
						$tel = get_field( 'location_tel', 'option' );
						echo "<div class='reveal vcard mt-12 mb-0'>";
							echo "<div class='adr'>";
								if ($map_url) echo "<a class='inline-block' href='" . esc_url( $map_url ) . "' target='_blank' rel='noopener noreferrer' aria-label='View location on map (opens in new window)'>";
									if ($street_address_1) echo "<div class='street-address'>" . acf_esc_html( $street_address_1 ) . "</div>";
									if ($street_address_2) echo "<div class='street-address'>" . acf_esc_html( $street_address_2 ) . "</div>";
									if ($city) echo "<span class='locality'>" . acf_esc_html( $city ) . ", </span>";
									if ($state) echo "<span class='region'>" . acf_esc_html( $state ) . " </span>";
									if ($zip_code) echo "<span class='postal-code'>" . acf_esc_html( $zip_code ) . "</span>";
								if ($map_url) echo "</a>";
							echo "</div>";

							if ($tel) echo "<div class='tel'><a href='tel:" . esc_url( $tel ) . "'>" . acf_esc_html( $tel ) . "</a></div>";
						echo "</div>"; // vcard
					}

				echo "</div>"; // col

				echo "<div class='col-start-2 col-span-14  md:col-start-9 md:col-span-7  xl:col-start-9 xl:col-span-6'>";
					echo "<div class='form-container bg-sky mt-0 p-3 sm:p-5 lg:p-10'>";
						if (!empty($form_image)) {
							$url = is_array($form_image) ? ($form_image['url'] ?? '') : '';
							$alt = is_array($form_image) ? ($form_image['alt'] ?? '') : '';
							if ($url) {
								echo "<div class='form-image'>";
									echo "<img class='' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
								echo "</div>"; // form-image
							}
						}

						echo "<div class='form-main' role='region' aria-label='" . esc_attr__('Contact form', 'g2o') . "'>" . $form_shortcode . "</div>";
						if ($disclaimer) echo "<div class='disclaimer text-sm mt-6'>" . acf_esc_html( $disclaimer ) . "</div>";
					echo "</div>"; // form-container
				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack





} elseif ($form_layout == 'shadow') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$body = $args['body'] ?? get_sub_field('body');
	$disclaimer = $args['disclaimer'] ?? get_sub_field('disclaimer');

	$include_vcard = $args['include_vcard'] ?? get_sub_field('include_vcard');
	$bg_color_field = $args['bg_color'] ?? get_sub_field('bg_color');
	$text_color_field = $args['text_color'] ?? get_sub_field('text_color');
	$bg_color = $bg_color_field ?: 'transparent';
	$text_color = $text_color_field ?: '#234253';

	$form_source = $args['form_source'] ?? get_sub_field('form_source');
	$gravity_form_field = $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode');
	$hubspot_form_field = $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode');
	$form_shortcode = g2o_render_form_shortcode($form_source, $gravity_form_field, $hubspot_form_field);

	$unique_id = $args['unique_id'] ?? get_sub_field('unique_id');
	$id = ($unique_id) ? $unique_id : $stack_id;

	$stack_class .= ' stack-form--shadow py-25 lg:py-35';
	echo "<section id='" . esc_attr( $id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "; color:" . acf_esc_html( $text_color ) . ";'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";

				echo "<div class='col-start-2 col-span-14   md:col-start-2 md:col-span-6  xl:col-start-3 xl:col-span-4'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] mb-6'>" . acf_esc_html( $heading ) . "</h3>";
						if ($deck) echo "<div class='deck mb-12'>" . acf_esc_html( $deck ) . "</div>";
						if ($body) echo "<div class='body opacity-80'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // reveal


					if ($include_vcard == 'yes') {
						$map_url = get_field( 'location_map_url', 'option' );
						$street_address_1 = get_field( 'location_street_address_1', 'option' );
						$street_address_2 = get_field( 'location_street_address_2', 'option' );
						$city = get_field( 'location_city', 'option' );
						$state = get_field( 'location_state', 'option' );
						$zip_code = get_field( 'location_zip_code', 'option' );
						$tel = get_field( 'location_tel', 'option' );
						echo "<div class='reveal'>";
							echo "<div class='vcard mt-12'>";
								echo "<div class='adr'>";
									if ($map_url) echo "<a class='inline-block' href='" . esc_url( $map_url ) . "' target='_blank' rel='noopener noreferrer' aria-label='View location on map (opens in new window)'>";
										if ($street_address_1) echo "<div class='street-address'>" . acf_esc_html( $street_address_1 ) . "</div>";
										if ($street_address_2) echo "<div class='street-address'>" . acf_esc_html( $street_address_2 ) . "</div>";
										if ($city) echo "<span class='locality'>" . acf_esc_html( $city ) . ", </span>";
										if ($state) echo "<span class='region'>" . acf_esc_html( $state ) . " </span>";
										if ($zip_code) echo "<span class='postal-code'>" . acf_esc_html( $zip_code ) . "</span>";
									if ($map_url) echo "</a>";
								echo "</div>";

								if ($tel) echo "<div class='tel'><a href='tel:" . esc_url( $tel ) . "'>" . acf_esc_html( $tel ) . "</a></div>";
							echo "</div>"; // vcard
						echo "</div>"; // reveal
					}

				echo "</div>"; // col

				echo "<div class='col-start-2 col-span-14  md:col-start-9 md:col-span-7  xl:col-start-9 xl:col-span-6'>";
					echo "<div class='form-container mt-30'>";
						echo "<div class='form-main' role='region' aria-label='" . esc_attr__('Contact form', 'g2o') . "'>" . $form_shortcode . "</div>";
						if ($disclaimer) echo "<div class='disclaimer text-sm mt-6'>" . acf_esc_html( $disclaimer ) . "</div>";
					echo "</div>";
				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack


} // end if form_layout