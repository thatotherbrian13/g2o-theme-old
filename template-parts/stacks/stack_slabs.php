<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-15 lg:py-25';

$kicker = $args['kicker'] ?? get_sub_field('kicker');
$body = $args['body'] ?? get_sub_field('body');
$rows = $args['slabs'] ?? get_sub_field('slabs');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-8'>";
				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-gunmetal'>" . acf_esc_html( $kicker ) . "</div>";
					if ($body) echo "<div class='deck text-gunmetal mt-8'>" . acf_esc_html( $body ) . "</div>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row


		if( $rows ) {
			foreach( $rows as $row ) {
				$body = $row['body'];
				$link = $row['link'];

				$link_url = $link['url'];
				$link_title = $link['title'];

				echo "<div class='row gap-x-2.5 mt-15 mb-8 lg:mb-6 reveal'>";

					echo "<div class='col-start-2 col-span-14    lg:col-start-2 lg:col-span-8'>";
						echo "<a class='flex items-center relative text-3xl lg:text-4xl font-sans font-bold text-gunmetal tracking-tighter leading-tight
							underline underline-offset-2 decoration-transparent
							hover:underline hover:underline-offset-2 hover:decoration-3 hover:decoration-city transition-all mb-4
						' href='" . esc_url( $link_url ) . "'>" . acf_esc_html( $link_title ) . "</a>";
					echo "</div>"; // col

					echo "<div class='col-start-2 col-span-14   lg:col-start-11 lg:col-span-5'>";
						if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // col

				echo "</div>"; // row
			}
		}

	echo "</div>"; // constrain
echo "</section>"; // stack