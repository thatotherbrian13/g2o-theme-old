<?php
/**
 * Stack: Content
 * Basic content block with icon, heading, body, and link.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Field values: check $args first, then fall back to ACF
$icon = $args['icon'] ?? get_sub_field('icon');
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$deck = $args['deck'] ?? get_sub_field('deck');
$body = $args['body'] ?? get_sub_field('body');
$link = $args['link'] ?? get_sub_field('link');

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');
$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  md:col-start-3 md:col-span-12  lg:col-start-4 lg:col-span-10  xl:col-start-5 xl:col-span-8'>";

				if( !empty( $icon ) ) {
					// Handle both ACF image array and mock image array
					$icon_url = is_array($icon) ? ($icon['url'] ?? '') : '';
					$icon_id = is_array($icon) ? ($icon['id'] ?? 0) : 0;
					$icon_alt = is_array($icon) ? ($icon['alt'] ?? 'Icon') : 'Icon';

					// Check if this is an SVG (wp_get_attachment_image doesn't handle SVGs well)
					$is_svg = false;
					if ($icon_id) {
						$mime_type = get_post_mime_type($icon_id);
						$is_svg = ($mime_type === 'image/svg+xml');
					} elseif ($icon_url) {
						$is_svg = (pathinfo($icon_url, PATHINFO_EXTENSION) === 'svg');
					}

					echo "<div class='icon mb-6'>";
					if ($is_svg && $icon_url) {
						// SVGs: use direct img tag with explicit dimensions (wp_get_attachment_image doesn't work for SVGs)
						echo "<img src='" . esc_url($icon_url) . "' alt='" . esc_attr($icon_alt) . "' width='192' height='192' class='w-48 h-auto'>";
					} elseif ($icon_id) {
						// Raster images: use WordPress function for responsive images
						$attr = array(
							'class' => '',
							'loading' => false,
						);
						echo wp_get_attachment_image( $icon_id, 'full', false, $attr );
					} elseif ($icon_url) {
						// Fallback for mock images or URLs without ID
						echo "<img src='" . esc_url($icon_url) . "' alt='" . esc_attr($icon_alt) . "'>";
					}
					echo "</div>"; // icon
				}

				if ($kicker) echo "<div class='kicker text-river-light mb-4'>" . acf_esc_html( $kicker ) . "</div>";
				if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";
				if ($deck) echo "<div class='deck text-gunmetal mb-6'>" . acf_esc_html( $deck ) . "</div>";
				if ($body) echo "<div class='body prose text-pathway'>" . $body . "</div>";
				echo acf_link( $link, 'box', 'text-river box-river mt-10' );

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack
