<?php
/**
 * Stack: Tout
 * Promotional highlight or callout section.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
//$stack_class .= ' py-15 lg:py-20';

$heading = $args['heading'] ?? get_sub_field('heading');
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

				if ($heading) echo "<h3 class='font-sans font-bold text-2xl lg:text-3xl leading-[1.4] -tracking-[0.02em] text-pathway'>" . acf_esc_html( $heading ) . "</h3>";
				echo acf_link( $link, 'box', 'text-river box-river mt-10' );

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack