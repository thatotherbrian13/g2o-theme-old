<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
//$stack_class .= ' py-15 lg:py-20';

$rows = $args['steps'] ?? get_sub_field('steps');
$link = $args['link'] ?? get_sub_field('link');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');
$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14'>";




		if( $rows ) {

					echo "<div class='steps grid grid-cols-1 lg:grid-cols-3 gap-y-15'>";
			$num = 1;
			foreach( $rows as $row ) {
				$heading = $row['heading'];
				$body = $row['body'];


							echo "<div class='step col-span-1 relative px-8'>";
echo "<div class='step-num z-20' style='background-color:" . acf_esc_html( $bg_color ) . "'>" . $num . "</div>";
						if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-gunmetal mb-6'>" . acf_esc_html( $heading ) . "</h2>";
						if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // col
					$num++;

			}

				echo "</div>"; // row

		}


		echo acf_link( $link, 'box', 'text-river box-river justify-center mt-15' );

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain
echo "</section>"; // stack