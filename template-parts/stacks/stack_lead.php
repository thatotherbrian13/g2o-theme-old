<?php
/**
 * Stack: Lead
 * Lead-in section to introduce page content.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Field values: check $args first, then fall back to ACF
$lead = $args['lead'] ?? get_sub_field('lead');
$full_name = $args['full_name'] ?? get_sub_field('full_name');
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
			echo "<div class='col-start-1 col-span-15  md:col-start-2 md:col-span-13  lg:col-start-3 lg:col-span-11   xl:col-start-3 xl:col-span-10'>";

				if ($lead) echo "<div class='lead text-gunmetal'>" . acf_esc_html( $lead ) . "</div>";

				if ($full_name) echo "<div class='font-sans text-sm font-bold leading-snug tracking-wider text-river-light uppercase mt-6'>" . acf_esc_html( $full_name ) . "</div>";
				if ($role) echo "<div class='font-sans text-sm font-normal leading-snug tracking-wider text-river-light uppercase'>" . acf_esc_html( $role ) . "</div>";

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack
