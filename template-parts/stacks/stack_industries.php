<?php

$stack_id = ($args['id']) ? $args['id'] : '';
$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-river py-25 lg:py-35';

$kicker = get_sub_field('kicker');
$heading = get_sub_field('heading');

$rows = get_sub_field('industries');


echo "<section id='" . esc_attr($stack_id) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14'>";
				echo "<div class='reveal'>";
					if ($kicker)  echo "<div class='kicker text-white mb-8'>" . acf_esc_html($kicker) . "</div>";
					if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-sky mb-12'>" . acf_esc_html($heading) . "</h2>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row



		if ($rows) {
			echo "<div class='accordion accordion--industries'>";
				$i = 1;
				foreach ($rows as $row) {
					$heading = $row['heading'];
					$deck = $row['deck'];
					$icon = $row['icon'];
					$images = $row['logos'];
					$project = $row['project'];

					// ACCORDION ITEM
					echo "<div class='accordion-item transition-all'>";

						// ACCORDION HEADER
						echo "<div class='accordion-header accordion-header-" . strval($i) . "'>";
							echo "<div class='row gap-y-4 md:items-center py-8'>";
								echo "<div class='row-start-1  col-start-2 col-span-11  md:col-start-2 md:col-span-6'>";
									if ($heading) echo "<h3 class='font-sans text-4xl lg:text-6xl font-light leading-none tracking-tight text-sky'>" . acf_esc_html($heading) . "</h3>";
								echo "</div>"; // col

								echo "<div class='hidden md:block row-start-1  col-start-14 col-span-2  md:col-start-8 md:col-span-2'>";
									if ($icon) {
										$icon_id = $icon['id'];
										$icon_src = wp_get_attachment_url($icon_id);
										echo "<img class='mx-auto max-w-[50px]' alt='' src='" . esc_url($icon_src) . "'>";
									}
								echo "</div>"; // col

								echo "<div class='block md:hidden row-start-1  col-start-13 col-span-3  md:col-start-8 md:col-span-2'>";
									echo "<div class='accordion-toggle ml-auto'></div>";
								echo "</div>"; // col

								echo "<div class='row-start-2  md:row-start-1  col-start-2 col-span-14   md:col-start-10 md:col-span-7'>";
									if ($deck) echo "<div class='deck text-white'>" . acf_esc_html($deck) . "</div>";
								echo "</div>"; // col
							echo "</div>"; // row
						echo "</div>"; // accordion-header


						// ACCORDION BODY
						echo "<div class='accordion-body transition-all'>";
							echo "<div class='row grid-cols-16 gap-y-12 py-8'>"; // grid

								$project_heading = $project['heading'];
								$project_body = $project['body'];
								$project_link = $project['link'];
								$project_image = $project['image'];

								if ($project_heading != '' && $project_image != '') {
									echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-6 lg:col-start-2 lg:col-span-5'>";
										echo "<div class='bg-limestone text-river'>";

											if (!empty($project_image)) {
												$image_id = $project_image['id'];
												$image_size = 'aspect-5-2';
												$attr = array(
													'class' => 'object-cover object-center',
													'loading' => false,
												);
												echo "<div class='block aspect-w-5 aspect-h-2'>";
													echo wp_get_attachment_image($image_id, $image_size, false, $attr);
												echo "</div>"; // block
											}

											echo "<div class='p-8'>";
												if ($project_heading) echo "<div class='font-sans font-bold leading-normal text-[15px] text-gunmetal mb-6'>" . acf_esc_html($project_heading) . "</div>";
												if ($project_body)    echo "<div class='body text-gunmetal'>" . acf_esc_html($project_body) . "</div>";
												echo acf_link($project_link, 'arrow', 'text-gunmetal arrow-gunmetal mt-6');
											echo "</div>"; // p-8

										echo "</div>"; // bg-limestone
									echo "</div>"; // col
								}


								if ($images) {
									echo "<div class='col-start-2 col-span-14  md:col-start-10 md:col-span-7'>";
										echo "<div class='kicker text-white mb-8'>Our Clients</div>";
										echo "<div class='flex flex-wrap gap-4'>";
											foreach ($images as $image) {
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




//				echo "<div class='accordion-item' x-data='{ open: false }' :class='{ \"active\": open }'>";
//					echo "<div class='accordion-header row gap-y-4 md:items-center py-8' @click='open = !open'>";

//				echo "<div class='accordion-item' x-data='{ open: false }' :class='{ \"active\": open }'>";


//					echo "<div class='accordion-body row gap-y-12 py-8' x-show='open' x-collapse>";



//						echo "<div class='accordion-header accordion-header-" . strval($i) . " row gap-y-4 md:items-center py-8' data-target='accordion-header-" . strval($i) . "'>";