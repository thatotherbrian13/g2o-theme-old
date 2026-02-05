<?php

$stack_id = ($args['id']) ? $args['id'] : '';
$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= '  bg-river';

$kicker = get_sub_field('kicker');
$rows = get_sub_field('jobs');

$border_color = get_sub_field('border_color');
$class = ($border_color == "red") ? "border-city" : "border-limestone";

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";


echo "<div class='swiper swiper-jobs w-full h-auto mx-auto'>";
	echo "<div class='swiper-wrapper'>";

		if ($rows) {
			foreach( $rows as $row ) {
				$image = $row['image'];
				$heading = $row['heading'];
				$subhead = $row['subhead'];
				$body = $row['body'];
				$link = $row['link'];

				echo "<div class='swiper-slide relative flex h-auto bg-river'>";
					echo "<div class='flex flex-col md:flex-row w-full'>";

						echo "<div class='w-full h-full md:w-1/2 md:h-full md:order-last'>";
							if( !empty( $image ) ) {
								$image_id = $image['id'];
								$image_size = 'square';
								$attr = array(
									'class' => 'object-cover object-center w-full h-full',
									'loading' => false,
								);
								echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
							}
						echo "</div>"; // col

						echo "<div class='w-full h-full md:w-1/2 md:h-full md:order-first flex items-center'>";
							echo "<div class='pt-25 pb-40 w-4/5 mx-auto'>";
								if ($kicker) echo "<div class='kicker pb-4 mb-10 text-limestone border-b {$class}'>" . acf_esc_html( $kicker ) . "</div>";
								if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-limestone mb-6'>" . acf_esc_html( $heading ) . "</h2>";
								if ($subhead) echo "<div class='body text-regent-gray mb-4'>" . acf_esc_html( $subhead ) . "</div>";
								if ($body) echo "<div class='body text-limestone'>" . acf_esc_html( $body ) . "</div>";
/*


	if( $link ) {
		$link_url = $link['url'];
		$link_title = $link['title'];

		echo "<div class='link-arrow text-white box-sky mt-12'>";
//			echo "<a href='" . esc_url( $link_url ) . "'><span>Learn More About The Work</span></a>";
			echo "<a href='" . esc_url( $link_url ) . "'>Learn More About The Work</a>";
		echo "</div>";
	}

//<div class="link-box text-white box-sky mt-12"><a href="https://g2odev.wpengine.com/project/cardinal-health/" target="_self"><span><span>Learn More About The Work</span></span><div class="box"></div></a></div>

*/


								echo acf_link( $link, 'arrow', 'text-white arrow-sky mt-12' );
							echo "</div>";
						echo "</div>"; // col

					echo "</div>"; // row
				echo "</div>"; // swiper-slide

			}
		}

	echo "</div>"; // swiper-wrapper


	echo "<div class='swiper-buttons-jobs-container w-full md:w-1/2 left-0 right-auto bottom-12 absolute z-50'>";
		echo "<div class='swiper-buttons-jobs'>";
			echo "<div class='swiper-button-prev swiper-button-prev-jobs'></div>";
			echo "<div class='swiper-button-next swiper-button-next-jobs'></div>";
		echo "</div>";
	echo "</div>";


echo "</div>"; // swiper


/*


	echo "<div class='swiper swiper-jobs w-full h-auto mx-auto'>";
		echo "<div class='swiper-wrapper'>";

			if ($rows) {
				foreach( $rows as $row ) {
					$image = $row['image'];
					$heading = $row['heading'];
					$subhead = $row['subhead'];
					$body = $row['body'];
					$link = $row['link'];

					echo "<div class='swiper-slide flex items-center bg-river h-auto'>"; // h-auto
						echo "<div class='grid grid-cols-1  md:grid-cols-2 md:h-full'>";


							echo "<div class='flex flex-col justify-center md:order-last md:h-full'>";

								if( !empty( $image ) ) {
									$image_id = $image['id'];
									$image_size = 'square';
									$attr = array(
										'class' => 'object-cover object-center  aspect-square  md:aspect-auto  md:w-full md:h-full',
									);
									echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
								}
							echo "</div>"; // col

							echo "<div class='flex flex-col justify-center md:order-first md:h-full'>";

								echo "<div class='grid grid-cols-8 gap-x-2.5'>";
									echo "<div class='col-start-2 col-span-6 pt-15 lg:pt-25 pb-25'>";

										echo "<div class='reveal'>";
											if ($kicker) echo "<div class='kicker pb-4 mb-10 text-limestone border-b {$class}'>" . acf_esc_html( $kicker ) . "</div>";
											if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-limestone mb-6'>" . acf_esc_html( $heading ) . "</h2>";

											if ($subhead) echo "<div class='body text-regent-gray mb-4'>" . acf_esc_html( $subhead ) . "</div>";

											if ($body) echo "<div class='body text-limestone'>" . acf_esc_html( $body ) . "</div>";
											echo acf_link( $link, 'box', 'text-white box-sky mt-12' );
										echo "</div>"; // reveal

									echo "</div>"; // col
								echo "</div>"; // grid

							echo "</div>"; // col

						echo "</div>"; // row
					echo "</div>"; // swiper-slide
				}
			}

		echo "</div>"; // swiper-wrapper


		echo "<div class='swiper-button-next swiper-button-next-jobs'></div>";
		echo "<div class='swiper-button-prev swiper-button-prev-jobs'></div>";
//		echo "<div class='swiper-pagination swiper-pagination-jobs'></div>";


	echo "</div>"; // swiper
*/

echo "</section>"; // stack

$swiper_jobs = <<<EOT
var swiperjobs = new Swiper(".swiper-jobs", {
	effect: "fade",
	virtual: true,
	autoplay: {
		delay: 8000,
	},
	navigation: {
		nextEl: ".swiper-button-next-jobs",
		prevEl: ".swiper-button-prev-jobs"
	},
	pagination: {
		el: ".swiper-pagination-jobs"
	}
});
EOT;

//wp_enqueue_script( 'wpdocs-my-script', 'https://url-to/my-script.js' );
wp_add_inline_script( 'g2o-script', $swiper_jobs, 'after' );

