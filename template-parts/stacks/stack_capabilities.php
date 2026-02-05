<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-limestone py-25 lg:py-35';

$kicker = get_sub_field('kicker');
$heading = get_sub_field('heading');
$deck = get_sub_field('deck');

$body_columns = get_sub_field('body_columns');
$body = get_sub_field('body');
$body_column_2 = get_sub_field('body_column_2');

$link = get_sub_field('link');
$rows = get_sub_field('results');


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-span-full  md:col-start-2 md:col-span-14'>";

				echo "<div class='bg-white py-12 px-6  lg:px-12'>";

					if( $rows ) {
						echo "<div class='hidden lg:flex lg:flex-row lg:gap-16 lg:mb-25'>";

							foreach( $rows as $row ) {
								echo "<div class='flex flex-1'>";
									echo "<div class='border-l border-l-city pl-8 reveal'>";
										$value = $row['value'];
										$description = $row['description'];

										if ($value) echo "<div class='result-value font-serif font-light text-[90px] text-river leading-none tracking-tighter mb-4'>" . acf_esc_html( $value ) . "</div>";
										if ($description) echo "<div class='result-description font-serif font-light text-3xl text-river'>" . wp_kses_post( $description ) . "</div>";

										$result_link = $row['link'];
										if( $result_link ) {
											$link_url = $result_link['url'];
											$link_title = $result_link['title'];
											$link_target = $result_link['target'] ? $result_link['target'] : '_self';
											echo "<div class='font-sans text-xs tracking-wider uppercase leading-[1.2] mt-5'><span class='font-bold text-river'>Source:</span> <a class='underline decoration-1 underline-offset-2 text-river' href='" . esc_url( $link_url ) . "' target='" . esc_attr( $link_target ) . "'>" . esc_html( $link_title ) . "</a></div>";
										}

									echo "</div>"; // border
								echo "</div>"; // col
							}

						echo "</div>"; // row
					}


					echo "<div class='grid grid-cols-1 lg:grid-cols-3 auto-rows-auto gap-x-16 gap-y-12'>";

						echo "<div class='col-span-1 lg:col-span-1'>";
							echo "<div class='reveal'>";
								if ($kicker) echo "<div class='kicker text-river mb-8'>" . acf_esc_html( $kicker ) . "</div>";
								if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-river mb-6'>" . acf_esc_html( $heading ) . "</h3>";
								if ($deck) echo "<div class='deck text-river'>" . acf_esc_html( $deck ) . "</div>";
							echo "</div>"; // reveal
						echo "</div>"; // col

						echo "<div class='col-span-1 lg:col-span-2'>";
							echo "<div class='reveal'>";
								echo "<div class='lg:border-l lg:border-l-sky lg:pl-8'>";
									if ( $body_columns == 'row') {
										echo "<div class='flex flex-col md:flex-row md:flex-nowrap md:gap-24'>";
											if ($body) echo "<div class='body text-river md:w-1/2'>" . acf_esc_html( $body ) . "</div>";
											if ($body_column_2) echo "<div class='body text-river md:w-1/2'>" . acf_esc_html( $body_column_2 ) . "</div>";
										echo "</div>";
									} else {
										if ($body) echo "<div class='body text-river w-full'>" . acf_esc_html( $body ) . "</div>";
									}
								echo "</div>"; // border
							echo "</div>"; // reveal
						echo "</div>"; // col

						echo "<div class='col-span-full'>";
							echo "<div class='reveal'>";
								echo acf_link( $link, 'box', 'text-river box-river justify-end' );
							echo "</div>"; // reveal
						echo "</div>"; // col

					echo "</div>"; // row




				echo "</div>"; // bg

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain

echo "</section>"; // stack