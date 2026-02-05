<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' pt-0';

$kicker = get_sub_field('kicker');
$heading = get_sub_field('heading');


$rows = get_sub_field('solutions');

$numbers = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='intro-container'>";
		echo "<div class='constrain  row'>";
			echo "<div class='col-start-1 col-span-full md:col-start-2 md:col-span-14 relative'>";
				echo "<div class='intro-boxed py-10 px-10 md:py-20 md:px-15'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-sky mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='text-gunmetal mb-0 font-bold text-2xl md:text-3xl lg:text-4xl leading-normal lg:leading-normal'>" . acf_esc_html( $heading ) . "</h2>";
					echo "</div>"; // reveal
				echo "</div>"; // intro-boxed
			echo "</div>"; // col
		echo "</div>"; // constrain
	echo "</div>"; // intro-container

	if( $rows ) {
		echo "<div class='accordion  accordion--public-sector'>";
			$i = 1;
			foreach( $rows as $row ) {

				$kicker = $row['kicker'];
				$heading = $row['heading'];
				$deck = $row['deck'];
				$link_label = $row['link_label'];
				$subhead = $row['subhead'];
				$body = $row['body'];

				$color = $row['color'] ?? []; // Ensure $color is an array or empty array
				$bg_color     = $color['bg_color'] ?? "#192C36";
				$text_color   = $color['text_color'] ?? "#FFFFFF";
				$accent_color = $color['accent_color'] ?? "#72D1F6";
				$link_color = $color['link_color'] ?? "sky";


					// ACCORDION ITEM
				echo "<div class='accordion-item transition-all' style='background-color:" . acf_esc_html( $bg_color ) . "; color:" . acf_esc_html( $text_color ) . "'>";

					echo "<div class='accordion-header'>";
						echo "<div class='constrain  row gap-y-4 md:items-center py-25'>";
							echo "<div class='row-start-1 col-start-2 col-span-12'>";
								if ($kicker) echo "<div class='kicker mb-3' style='color: " . acf_esc_html( $accent_color ) . ";'>" . acf_esc_html( $kicker ) . "</div>";
								if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-light leading-none tracking-tight mb-12'>" . acf_esc_html( $heading ) . "</h3>";
								if ($deck) echo "<div class='body mb-12'>" . acf_esc_html( $deck ) . "</div>";

								echo "<div class='link-box text-{$link_color} box-{$link_color} mt-12 arrow-down accordion-toggle'>";
									echo "<div class='anchor'><span><span>" . acf_esc_html( $link_label ) . "</span></span><span class='box'></span></div>";
								echo "</div>"; // link-box
							echo "</div>"; // col
						echo "</div>"; // constrain
					echo "</div>"; // accordion-header row

					echo "<div class='accordion-body transition-all'>";
						echo "<div class='constrain  row gap-y-12 pb-18'>";
							echo "<div class='col-start-2 col-span-12'>";
								if ($subhead) echo "<h4 class='font-sans font-bold text-3xl leading-normal tracking-tight mb-12'>" . acf_esc_html( $subhead ) . "</h4>";
								optimized_content_output($body, $accent_color);
							echo "</div>";
						echo "</div>";
					echo "</div>"; // accordion-body

				echo "</div>"; // accordion-item
				$i++;
			}
		echo "</div>"; // accordion
	}

echo "</section>"; // stack

//					echo "<div class='accordion-header reveal' @click='openItem = openItem === {$i} ? null : {$i}'>";

	//							echo acf_link( 'anchor', 'box', 'text-' . $link_color . ' box-' . $link_color . ' mt-12 arrow-down accordion-toggle', $link_label);