<?php
/**
 * Stack: Blockquote
 * Featured quote or testimonial highlight.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';
$stack_class .= ' py-20 lg:py-25';

// Field values: check $args first, then fall back to ACF
$blockquote = $args['blockquote'] ?? get_sub_field('blockquote');
$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';


echo "<aside id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  md:col-start-3 md:col-span-12  lg:col-start-4 lg:col-span-10  xl:col-start-5 xl:col-span-8 text-center'>";

				if ($blockquote) echo "<div class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-gunmetal'>" . acf_esc_html( $blockquote ) . "</div>";

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</aside>"; // stack
