<?php
/**
 * Stack: Banner
 * Hero banner with multiple layout variants for page headers.
 *
 * Variants: simple, wedge, form, gradient, boxed, download, solution
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Get component type first to determine which fields to load
$component_type = $args['component_type'] ?? get_sub_field('component_type');

// WEDGE
if ($component_type == 'wedge') {
	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');
	$deck = $args['deck'] ?? get_sub_field('deck');

	$stack_class .= ' stack-banner-wedge pt-10 pb-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-3 lg:col-span-9'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<p class='kicker text-river mb-4'>" . acf_esc_html( $kicker ) . "</p>";
						if ($headline) echo "<h1 class='headline font-serif font-light text-4xl lg:text-7xl leading-[1.2] lg:leading-[1.2] text-river'>" . acf_esc_html( $headline ) . "</h1>";
						if ($deck) echo "<div class='deck text-pathway mt-6'>" . acf_esc_html( $deck ) . "</div>";
					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack

// WEDGE W/FORM
} elseif ($component_type == 'form') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$include_vcard = $args['include_vcard'] ?? get_sub_field('include_vcard');

	$gravity_form_shortcode = do_shortcode( $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode') ?? '', true );
	$hubspot_form_shortcode = do_shortcode( $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode') ?? '', true );


	$stack_class .= ' stack-banner-form py-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-3 lg:col-span-10'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<p class='kicker text-river mb-8'>" . acf_esc_html( $kicker ) . "</p>";
						if ($headline) echo "<h1 class='headline font-serif font-light text-4xl lg:text-7xl leading-[1.2] lg:leading-[1.2] text-river mb-16'>" . wp_kses( $headline, array('span' => array('class' => array()), 'br' => array()) ) . "</h1>";
						if ($deck) echo "<div class='deck text-pathway'>" . acf_esc_html( $deck ) . "</div>";
					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row


			echo "<div class='row gap-x-2.5 mt-12'>";

				echo "<div class='col-start-2 col-span-14 lg:col-start-3 lg:col-span-4  xl:col-start-3 xl:col-span-5'>";
					if ($include_vcard == 'yes') {

						$map_url = get_field( 'location_map_url', 'option' );
						$street_address_1 = get_field( 'location_street_address_1', 'option' );
						$street_address_2 = get_field( 'location_street_address_2', 'option' );
						$city = get_field( 'location_city', 'option' );
						$state = get_field( 'location_state', 'option' );
						$zip_code = get_field( 'location_zip_code', 'option' );
						$tel = get_field( 'location_tel', 'option' );

						echo "<div class='reveal'>";
							echo "<div class='vcard mt-30'>";
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

				echo "<div class='col-span-full md:col-start-2 md:col-span-12  lg:col-start-7 lg:col-span-7  xl:col-start-8 xl:col-span-6'>";
					echo "<div class='form-container mt-30'><div class='form-main'>";
						if ($gravity_form_shortcode) {
							echo $gravity_form_shortcode;
						} elseif ($hubspot_form_shortcode) {
							echo $hubspot_form_shortcode;
						}
					echo "</div></div>";
				echo "</div>"; // col

			echo "</div>"; // row
		echo "</div>"; // constrain

		echo "<div class='wedge wedge-limestone'></div>";

	echo "</section>"; // stack



// WEDGE W/GRADIENT
} elseif ($component_type == 'gradient') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');
	$body = $args['body'] ?? get_sub_field('body');
	$link = $args['link'] ?? get_sub_field('link');

	$stack_class .= ' stack-banner-gradient pt-35 pb-75';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-3 lg:col-span-10'>";
					echo "<div class='reveal'>";

						if ($kicker) echo "<p class='kicker text-river mb-8'>" . acf_esc_html( $kicker ) . "</p>";
						if ($headline) echo "<h1 class='headline font-serif font-light text-4xl lg:text-7xl leading-[1.2] lg:leading-[1.2] text-river mb-15'>" . acf_esc_html( $headline ) . "</h1>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ($body) {
				echo "<div class='reveal'>";
					echo "<div class='row gap-x-2.5'>";
						echo "<div class='col-start-1 col-span-16  sm:col-start-3 sm:col-span-13  md:col-start-5 md:col-span-10  lg:col-start-7 lg:col-span-8  xl:col-start-8 xl:col-span-7'>";
							echo "<div class='wedge-border'>";
								echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";
							echo "</div>"; // wedge-border
								echo acf_link( $link, 'arrow', 'text-river arrow-river justify-end mt-6' );
						echo "</div>"; // col
					echo "</div>"; // row
				echo "</div>"; // reveal
			}

		echo "</div>"; // constrain

		echo "<canvas id='gradient-banner' class='gradient-sky' data-transition-in></canvas>";
	echo "</section>"; // stack

	$gradient = <<<EOT
	const gradientBanner = new Gradient();
	gradientBanner.initGradient('#gradient-banner');
	EOT;
	wp_add_inline_script( 'g2o-script', $gradient, 'after' );



// BOXED
} elseif ($component_type == 'boxed') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$footnote = $args['footnote'] ?? get_sub_field('footnote');
	$link = $args['link'] ?? get_sub_field('link');
	$border_color = $args['border_color'] ?? get_sub_field('border_color');
	$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');

	$stack_class .= ' stack-banner-boxed min-h-screen lg:h-screen flex items-center bg-pathway-light py-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5 gap-y-5 auto-rows-auto lg:grid-rows-1'>";
				echo "<div class='row-start-2 lg:row-start-1  col-span-full  sm:col-start-2 sm:col-span-14  lg:col-start-4 lg:col-span-10'>";

					$class = ($border_color == 'red') ? " after:border-city" : " after:border-sky";
					echo "<div class='banner-boxed {$class}'>";
						echo "<div class='boxed-container'>";
							echo "<div class='reveal'>";

								if ($kicker) echo "<p class='kicker text-river mb-8'>" . acf_esc_html( $kicker ) . "</p>";
								if ($headline) echo "<h1 class='headline font-serif font-light text-3xl md:text-5xl lg:text-7xl text-river'>" . acf_esc_html( $headline ) . "</h1>";


								if ($deck) echo "<div class='deck text-pathway mt-12'>" . acf_esc_html( $deck ) . "</div>";
								echo acf_link( $link, 'box', 'text-river box-river justify-end mt-12' );

								if ($footnote) echo "<div class='footnote text-pathway mt-12'>" . acf_esc_html( $footnote ) . "</div>";

							echo "</div>"; // reveal
						echo "</div>"; // boxed-container

					echo "</div>"; // banner-boxed

				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain

		if ($bg_image) {
			$url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
			$alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
			if ($url) {
				echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-center' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
			}
		}
	echo "</section>"; // stack


// DOWNLOAD W/FORM
} elseif ($component_type == 'download') {

	$headline = $args['headline'] ?? get_sub_field('headline');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$subhead = $args['subhead'] ?? get_sub_field('subhead');
	$rows = $args['bullet_points'] ?? get_sub_field('bullet_points');
	$gravity_form_shortcode = do_shortcode( $args['gravity_form_shortcode'] ?? get_sub_field('gravity_form_shortcode') ?? '', true );
	$hubspot_form_shortcode = do_shortcode( $args['hubspot_form_shortcode'] ?? get_sub_field('hubspot_form_shortcode') ?? '', true );
	$form_image = $args['form_image'] ?? get_sub_field('form_image');
	$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');

	$stack_class .= ' stack-banner-download pt-35 pb-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-span-full md:col-start-2 md:col-span-6 mb-12'>";
					echo "<div class='reveal'>";
						if ($headline) echo "<h1 class='font-serif font-light text-3xl md:text-5xl lg:text-6xl leading-[1.1] md:leading-[1.1] lg:leading-[1.1] text-river mb-16'>" . acf_esc_html( $headline ) . "</h1>";
						if ($deck) echo "<div class='font-sans text-base leading-snug mb-6 text-river'>" . acf_esc_html( $deck ) . "</div>";
						if ($subhead) echo "<div class='font-sans font-bold text-sm leading-normal tracking-widest uppercase text-city mb-4'>" . acf_esc_html( $subhead ) . "</div>";
						if ($rows) {
							echo "<ul class='list-disc list-outside pl-6'>";
								foreach ($rows as $row) {
									$bullet_point = $row['bullet_point'];
									if ($bullet_point) echo "<li class='font-sans font-bold text-xl leading-[1.1] text-river mb-4 last:mb-0'>" . acf_esc_html( $bullet_point ) . "</li>";
								}
							echo "</ul>"; // list-disc
						}

					echo "</div>"; // reveal
				echo "</div>"; // col

				if ($gravity_form_shortcode) {
					echo "<div class='col-span-full md:col-start-9 md:col-span-6'>";
						echo "<div class='form-container mt-0'>";
							if ($form_image) {
								$url = is_array($form_image) ? ($form_image['url'] ?? '') : '';
								$alt = is_array($form_image) ? ($form_image['alt'] ?? '') : '';
								if ($url) {
									echo "<div class='form-image'>";
										echo "<img class='' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
									echo "</div>"; // form-image
								}
							}
							echo "<div class='form-main'>" . $gravity_form_shortcode . "</div>";
						echo "</div>"; // form-container

					echo "</div>"; // col
				}

				if ($hubspot_form_shortcode) {
					echo "<div class='col-span-full md:col-start-9 md:col-span-6'>";
						echo "<div class='form-container mt-0'>";
							if ($form_image) {
								$url = is_array($form_image) ? ($form_image['url'] ?? '') : '';
								$alt = is_array($form_image) ? ($form_image['alt'] ?? '') : '';
								if ($url) {
									echo "<div class='form-image'>";
										echo "<img class='' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
									echo "</div>"; // form-image
								}
							}
							echo "<div class='form-main'>" . $hubspot_form_shortcode . "</div>";
						echo "</div>"; // form-container

					echo "</div>"; // col
				}


			echo "</div>"; // row


		echo "</div>"; // constrain

		if ($bg_image) {
			$url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
			$alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
			if ($url) {
				echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-center' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
			}
		}

	echo "</section>"; // stack



// SOLUTION
} elseif ($component_type == 'solution') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');
	$deck = $args['deck'] ?? get_sub_field('deck');
	$subhead = $args['subhead'] ?? get_sub_field('subhead');
	$link = $args['link'] ?? get_sub_field('link');
	$bg_image = $args['bg_image'] ?? get_sub_field('bg_image');


	$quote = $args['quote'] ?? get_sub_field('quote');
	$body = is_array($quote) ? ($quote['body'] ?? '') : '';
	$attribution = is_array($quote) ? ($quote['attribution'] ?? '') : '';
	$affiliation = is_array($quote) ? ($quote['affiliation'] ?? '') : '';

	$stack_class .= ' stack-banner-solution flex items-center';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain z-1   flex flex-col  min-h-screen  pt-35 pb-0'>";

			echo "<div class='row gap-x-2.5 mt-35'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-13  lg:col-start-2 lg:col-span-12'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<p class='font-sans font-bold text-sm leading-normal tracking-widest uppercase text-white mb-8'>" . acf_esc_html( $kicker ) . "</p>";
						if ($headline) echo "<h1 class='headline font-serif font-light text-3xl md:text-5xl lg:text-[72px] text-white mb-15'>" . acf_esc_html( $headline ) . "</h1>";
					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row


			echo "<div class='row gap-x-2.5 gap-y-5 mt-auto'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-6  xl:col-start-2 xl:col-span-6  pb-25'>";
					echo "<div class='reveal'>";
						if ($deck) echo "<div class='font-sans font-light text-xl leading-snug text-white mb-10'>" . acf_esc_html( $deck ) . "</div>";
						if ($subhead) echo "<div class='font-sans font-bold text-2xl text-white mb-10'>" . acf_esc_html( $subhead ) . "</div>";
						echo acf_link( $link, 'box', 'text-white box-city arrow-down mt-12' );
					echo "</div>"; // reveal
				echo "</div>"; // col

				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-9 lg:col-span-5  xl:col-start-9 xl:col-span-5 flex flex-col justify-end'>";
					echo "<div class='reveal solution__quote bg-white p-10 pb-25 flex flex-col'>";
						if ($body) echo "<div class='font-sans font-bold text-[26px] tracking-tight leading-snug text-river mb-10'>" . acf_esc_html( $body ) . "</div>";
						if ($attribution) echo "<div class='font-sans font-bold text-sm leading-normal tracking-widest uppercase text-river'>" . acf_esc_html( $attribution ) . "</div>";
						if ($affiliation) echo "<div class='font-sans font-bold text-sm leading-normal tracking-widest uppercase text-sky'>" . acf_esc_html( $affiliation ) . "</div>";
					echo "</div>"; // solution__quote
				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain

		if ($bg_image) {
			$url = is_array($bg_image) ? ($bg_image['url'] ?? '') : '';
			$alt = is_array($bg_image) ? ($bg_image['alt'] ?? '') : '';
			if ($url) {
				echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-center' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
			}
		}
	echo "</section>"; // stack



// SIMPLE (default)
} else {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$headline = $args['headline'] ?? get_sub_field('headline');

	$stack_class .= ' stack-banner-simple pt-35 pb-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5 mt-35'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-3 lg:col-span-10'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-gunmetal mb-8'>" . esc_html( $kicker ) . "</div>";
						if ($headline) echo "<h1 class='font-serif font-light text-4xl lg:text-6xl leading-[1.1] lg:leading-[1.1] tracking-tight text-river'>" . acf_esc_html( $headline ) . "</h1>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section>"; // stack

}
