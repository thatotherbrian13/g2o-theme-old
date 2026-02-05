<?php
/**
 * Stack: Testimonial
 * Client testimonial with quote and attribution.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
//$stack_class .= ' py-15 lg:py-20';

$quote = $args['body'] ?? $args['quote'] ?? get_sub_field('quote');
$attribution = $args['attribution'] ?? get_sub_field('attribution');
$role = $args['role'] ?? get_sub_field('role');

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');
$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-span-full  md:col-start-2 md:col-span-14  lg:col-start-3 lg:col-span-12  xl:col-start-4 xl:col-span-10'>";

				echo "<div class='testimonial relative'>";
					echo "<div class='grid grid-cols-10 gap-x-2.5'>";

						echo "<div class='col-start-3 col-span-8   sm:col-start-2 sm:col-span-9'>";

							if ($quote) echo "<div class='font-sans font-bold text-3xl lg:text-4xl text-gunmetal leading-[1.3] mb-8'>" . acf_esc_html( $quote ) . "</div>";
							if ($attribution) echo "<div class='font-sans font-bold text-xs text-gunmetal leading-normal tracking-widest uppercase'>" . acf_esc_html( $attribution ) . "</div>";
							if ($role) echo "<div class='font-sans font-normal text-xs text-pathway leading-normal tracking-widest uppercase'>" . acf_esc_html( $role ) . "</div>";
						echo "</div>"; // col

					echo "</div>"; // row
				echo "</div>"; // testimonial

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack