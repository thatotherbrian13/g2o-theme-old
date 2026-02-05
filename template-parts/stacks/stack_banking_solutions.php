<?php

$stack_id = ($args['id']) ? $args['id'] : '';
$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-25 lg:py-35';

$kicker = get_sub_field('kicker');
$deck = get_sub_field('deck');

$rows = get_sub_field('solutions');

$numbers = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-7'>";
				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-sky mb-8'>" . acf_esc_html( $kicker ) . "</div>";
					if ($deck) echo "<h2 class='text-gunmetal mb-12 font-bold text-3xl'>" . acf_esc_html( $deck ) . "</h2>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row


		if( $rows ) {
			echo "<div class='accordion  accordion--banking-solutions'>";

				$i = 1;
				foreach( $rows as $row ) {
					$heading = $row['heading'];
					$deck = $row['deck'];
					$services = $row['services'];
					$stat = $row['stat'];
					$source = $row['source'];
					$number = $numbers[$i];


					// ACCORDION ITEM
					echo "<div class='accordion-item transition-all'>";

						echo "<div class='accordion-header'>";
							echo "<div class='row gap-y-4 md:items-center py-12'>";

								echo "<div class='row-start-1 col-start-2 col-span-12'>";
									echo "<div class='kicker text-sky mb-2'>Solution " . $number . "</div>";
									if ($heading) echo "<div class='font-sans text-3xl lg:text-4xl font-light leading-none tracking-tight text-gunmetal'>" . acf_esc_html( $heading ) . "</div>";
								echo "</div>"; // col

								echo "<div class='block md:hidden row-start-1  col-start-13 col-span-3  md:col-start-8 md:col-span-2'>";
									echo "<div class='accordion-toggle ml-auto'></div>";
								echo "</div>"; // col

							echo "</div>"; // row
						echo "</div>"; // accordion-header

						echo "<div class='accordion-body transition-all'>";
							echo "<div class='grid grid-cols-16 gap-y-12 py-8'>"; // grid
								echo "<div class='row-start-1 col-start-2 lg:col-start-2 col-span-14 lg:col-span-7'>";
									if ($deck)     echo "<div class='body text-gunmetal'>" . acf_esc_html( $deck ) . "</div>";
									if ($services) echo "<div class='services font-bold text-gunmetal py-8'>" . acf_esc_html( $services ) . "</div>";
								echo "</div>"; // col

								echo "<div class='stat-wrapper row-start-2 lg:row-start-1 col-start-2 lg:col-start-10 col-span-14 lg:col-span-5 bg-sky flex flex-col'>";
									if ($stat) echo "<div class='font-serif text-3xl lg:text-4xl font-light text-river mb-6 px-10 py-10'>". acf_esc_html( $stat ) . "<span class='font-light text-3xl'>*</span></div>";
									if ($source) echo "<div class='px-10 mb-10 font-light'>*" . acf_esc_html( $source ) . "</div>";
								echo "</div>";

							echo "</div>"; // grid
						echo "</div>"; // accordion-body

					echo "</div>"; // accordion-item
					$i++;
				}
			echo "</div>"; // accordion
		}

	echo "</div>"; // constrain
echo "</section>"; // stack



//						echo "<div class='accordion-header row gap-y-4 md:items-center py-12' @click='openItem = openItem === {$i} ? null : {$i}'>";
//									if ($services) echo "<div class='services font-bold text-gunmetal py-8 px-4'>" . acf_esc_html( $services ) . "</div>";