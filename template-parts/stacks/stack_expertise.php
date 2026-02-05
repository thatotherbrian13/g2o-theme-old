<?php

$stack_id = ($args['id']) ? $args['id'] : '';
$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-25 lg:py-35';

$kicker = get_sub_field('kicker');
$deck = get_sub_field('deck');

$rows = get_sub_field('services');

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-7'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-river mb-8'>" . acf_esc_html( $kicker ) . "</div>";
					if ($deck) echo "<h2 class='deck text-gunmetal mb-12'>" . acf_esc_html( $deck ) . "</h2>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row



		if ( $rows ) {
			echo "<div class='accordion accordion--expertise'>";

				$i = 1;
				foreach( $rows as $row ) {
					$heading = $row['heading'];
					$deck = $row['deck'];
					$kicker = $row['kicker'];

					$body_columns = $row['body_columns'];
					$body = $row['body'];
					$body_column_2 = $row['body_column_2'];

					$images = $row['logos'];
					$employee = $row['employee'];

					// ACCORDION ITEM
					echo "<div class='accordion-item transition-all'>";

						echo "<div class='accordion-header'>";
							echo "<div class='row gap-y-4 md:items-center py-8'>";
								echo "<div class='row-start-1  col-start-2 col-span-11  md:col-start-2 md:col-span-5'>";
									if ($heading) echo "<h3 class='font-sans text-4xl lg:text-6xl font-light leading-none tracking-tight text-river'>" . acf_esc_html( $heading ) . "</h3>";
								echo "</div>"; // col

								echo "<div class='row-start-2  md:row-start-1  col-start-2 col-span-14     md:col-start-8 md:col-span-8'>"; // md:col-start-2 md:col-span-14
									if ($deck) echo "<div class='deck text-gunmetal'>" . acf_esc_html( $deck ) . "</div>";
								echo "</div>"; // col

								echo "<div class='block md:hidden row-start-1  col-start-13 col-span-3  md:col-start-8 md:col-span-2'>";
									echo "<div class='accordion-toggle ml-auto'></div>";
								echo "</div>"; // col
							echo "</div>"; // grid
						echo "</div>"; // accordion-header

						echo "<div class='accordion-body transition-all'>";
							echo "<div class='grid grid-cols-16 gap-y-12 py-8'>";
								$full_name = $employee['full_name'];
								$role = $employee['role'];
								$linkedin_profile = $employee['linkedin_url'];
								$portrait = $employee['portrait'];

								if( !empty( $full_name ) && !empty( $portrait ) ) {
									echo "<div class='row-start-1 col-start-2 col-span-14  md:col-start-2 md:col-span-5  md:col-start-2 md:col-span-5'>";
										echo "<div class='bg-limestone text-river max-w-[300px]'>";

											if( !empty( $portrait ) ) {
												$image_id = $portrait['id'];
												$image_size = 'aspect-4-3';
												$attr = array(
													'class' => 'object-cover object-center',
													'loading' => false,
												);
												echo "<div class='block relative aspect-w-4 aspect-h-3'>";
													echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
												echo "</div>";
											}

											echo "<div class='p-6'>";
												if ($full_name) echo "<div class='font-sans text-sm font-bold leading-snug tracking-wider text-river uppercase'>" . acf_esc_html( $full_name ) . "</div>";
												if ($role) echo "<div class='font-sans text-sm font-normal leading-snug tracking-wider text-river uppercase'>" . acf_esc_html( $role ) . "</div>";
												if ($linkedin_profile) {
													echo "<a class='inline-block mt-4' href='" . esc_url( $linkedin_profile ) . "' target='_blank' rel='noopener noreferrer' aria-label='View LinkedIn profile (opens in new window)'>";
														echo "<svg enable-background='new 0 0 20 20' viewBox='0 0 20 20' width='20' height='20' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><clipPath id='a'><path d='m0 0h20v20h-20z'/></clipPath><g clip-path='url(#a)'><path d='m18.5 0h-17c-.8 0-1.5.6-1.5 1.4v17.1c0 .9.7 1.5 1.5 1.5h17c.8 0 1.5-.6 1.5-1.4v-17.2c0-.8-.7-1.4-1.5-1.4zm-12.6 17h-2.9v-9.5h3v9.5zm-1.5-10.8c-1 0-1.7-.8-1.7-1.7s.8-1.7 1.7-1.7 1.7.8 1.7 1.7c.1.9-.7 1.7-1.7 1.7zm12.6 10.8h-3v-4.6c0-1.1 0-2.5-1.5-2.5s-1.8 1.2-1.8 2.5v4.6h-3v-9.5h2.8v1.3c.4-.8 1.4-1.5 2.8-1.5 3 0 3.6 2 3.6 4.5v5.2z' fill='#234253'/></g></svg>";
													echo "</a>";
												}
											echo "</div>";
										echo "</div>";
									echo "</div>"; // col
								}

								echo "<div class='row-start-2 md:row-start-1 col-start-2 col-span-14   md:col-start-8 md:col-span-8'>";
									if ($kicker) echo "<div class='kicker pb-4 mb-10 text-river border-b border-white'>" . acf_esc_html( $kicker ) . "</div>";

									if ( $body_columns == 'row') {
										echo "<div class='flex flex-col lg:flex-row lg:flex-nowrap lg:gap-6'>";
											if ($body) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";
											if ($body_column_2) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body_column_2 ) . "</div>";
										echo "</div>";
									} else {
										if ($body) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";
									}
								echo "</div>"; // col


								if ( $images ) {
									echo "<div class='row-start-3 md:row-start-2 col-start-2 col-span-14 mt-12'>";
										echo "<div class='kicker text-gunmetal mb-8'>Our Partners</div>";
										echo "<div class='flex flex-wrap gap-4'>";
											foreach( $images as $image ) {
												echo "<div class='w-45'><img class='object-cover object-center' alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['aspect-4-3']) . "' loading='lazy'></div>";
											}
										echo "</div>"; // flex
									echo "</div>"; // col
								}

							echo "</div>"; // grid
						echo "</div>"; // accordion-body

					echo "</div>"; // accordion-item
					$i++;
				}
			echo "</div>"; // accordion
		}

	echo "</div>"; // constrain
echo "</section>"; // stack



//						echo "<div class='accordion-header row gap-y-4 md:items-center py-8' @click='openItem = openItem === {$i} ? null : {$i}'>";