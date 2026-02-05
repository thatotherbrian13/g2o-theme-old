<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' py-15 lg:py-25';

$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Pre-fetch common fields with $args fallback
$_heading = $args['heading'] ?? get_sub_field('heading');
$_body = $args['body'] ?? get_sub_field('body');
$_link = $args['link'] ?? get_sub_field('link');
$_link_classes = $args['link_classes'] ?? get_sub_field('link_classes');
$_image_type = $args['image_type'] ?? get_sub_field('image_type');
$_images = $args['images'] ?? get_sub_field('images');
$_logos = $args['logos'] ?? get_sub_field('logos');

// Ensure arrays are arrays
if (!is_array($_images)) $_images = [];
if (!is_array($_logos)) $_logos = [];


if ($component_type == 'boxed') {
	// BOXED

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . " stack-marquee-boxed'>";
		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14'>";

					echo "<div class='marquee__box bg-white py-20'>";

						// Use pre-fetched variables
						$heading = $_heading;
						$body = $_body;
						$link = $_link;
						$link_classes = $_link_classes;

						// HEADER
						if ($heading) {
							echo "<div class='row'>";
								echo "<div class='col-start-1 col-span-full text-center'>";
									echo "<h2 class='font-sans font-bold text-4xl leading-[1.3] tracking-tight mb-0 text-river'>" . acf_esc_html( $heading ) . "</h2>";
								echo "</div>"; // col
							echo "</div>"; // row
						}

						// LOGOS
						$image_type = $_image_type;
						if ($image_type == 'unlinked') {
							// UNLINKED LOGOS

							$images = $_images;
							if ($images) {

								if (is_array($images)) {
									$images_count = count($images);
								} else {
									$images_count = 0;
								}

								$images_half_count = $images_count  / 2;
								$images_first_half = array_slice($images,0,$images_half_count);
								$images_second_half = array_slice($images,$images_half_count);

								if ( $images_first_half ) {
									echo "<div class='flex flex-col max-w-full mt-16'>"; // mb-8
										echo "<div class='flex overflow-hidden select-none'>";

											echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full'>";
												foreach( $images_first_half as $image ) {

													if ($image_type == 'unlinked') {
														$alt = $image['alt'];
													} elseif ($image_type == 'linked') {
														$alt = $image['alt'];
													} else {
														$images = '';
													}

													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($alt) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
												}
											echo "</div>"; // marquee

											echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
												foreach( $images_first_half as $image ) {
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
												}
											echo "</div>"; // marquee__group

										echo "</div>"; // marquee__main
									echo "</div>"; // marquee-wrapper
								}

								if ( $images_second_half ) {
									echo "<div class='flex flex-col max-w-full'>";
										echo "<div class='flex overflow-hidden select-none'>";

											echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full'>";
												foreach( $images_second_half as $image ) {
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
												}
											echo "</div>"; // marquee__group

											echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
												foreach( $images_second_half as $image ) {
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
												}
											echo "</div>"; // marquee__group

										echo "</div>"; // marquee__main
									echo "</div>"; // marquee-wrapper
								}
							} // if images


						} elseif ($image_type == 'linked') {
							// LINKED LOGOS

							$logos = $_logos;
							if ($logos) {

								$images_count = count($logos);
								$images_half_count = $images_count  / 2;
								$images_first_half = array_slice($logos,0,$images_half_count);
								$images_second_half = array_slice($logos,$images_half_count);

								if ( $images_first_half ) {
									echo "<div class='flex flex-col max-w-full mt-16'>"; //  mb-8
										echo "<div class='flex overflow-hidden select-none'>";

											echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full'>";
												foreach( $images_first_half as $logo ) {
													$logo_image = $logo['logos_image'];
													$logo_url = $logo['logos_url'];
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
														if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
															echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
														if ($logo_url) echo "</a>";
													echo "</div>";
												}
											echo "</div>"; // marquee

											echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
												foreach( $images_first_half as $logo ) {
													$logo_image = $logo['logos_image'];
													$logo_url = $logo['logos_url'];
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
														if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
															echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
														if ($logo_url) echo "</a>";
													echo "</div>";
												}
											echo "</div>"; // marquee__group

										echo "</div>"; // marquee__main
									echo "</div>"; // marquee-wrapper
								}

								if ( $images_second_half ) {
									echo "<div class='flex flex-col max-w-full'>";
										echo "<div class='flex overflow-hidden select-none'>";

											echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full'>";
												foreach( $images_second_half as $logo ) {
													$logo_image = $logo['logos_image'];
													$logo_url = $logo['logos_url'];
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
														if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
															echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
														if ($logo_url) echo "</a>";
													echo "</div>";
												}
											echo "</div>"; // marquee__group

											echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
												foreach( $images_second_half as $logo ) {
													$logo_image = $logo['logos_image'];
													$logo_url = $logo['logos_url'];
													echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
														if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
															echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
														if ($logo_url) echo "</a>";
													echo "</div>";
												}
											echo "</div>"; // marquee__group

										echo "</div>"; // marquee__main
									echo "</div>"; // marquee-wrapper
								}
							} // if logos

						} else {
							// Handle the case where image_type is neither 'unlinked' nor 'linked'
//							echo 'Image type not specified.';
						}

						// BODY
						if ($body) {
							echo "<div class='row'>";
								echo "<div class='col-start-1 col-span-full md:col-start-5 md:col-span-8 text-center'>";
									echo "<div class='font-sans font-normal leading-relaxed text-river mt-6'>" . acf_esc_html( $body ) . "</div>";
								echo "</div>"; // col
							echo "</div>"; // row
						}


						if ($link) {
							echo "<div class='mx-auto relative z-10 px-4 md:px-8 flex justify-center'>";
								echo acf_link( $link, 'box', 'text-river box-river mt-12 ' . $link_classes );
							echo "</div>"; // col
						}

					echo "</div>"; // marquee__box

				echo "</div>"; // col
			echo "</div>"; // row
		echo "</div>"; // constrain
	echo "</section>"; // stack

} else {
	// SIMPLE

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . " stack-marquee-simple'>";

		// Use pre-fetched variables
		$heading = $_heading;
		$body = $_body;
		$link = $_link;
		$link_classes = $_link_classes;

		if ($heading || $body) {
			echo "<div class='constrain mx-auto'>";
				echo "<div class='row'>";
					echo "<div class='col-start-1 col-span-full md:col-start-4 md:col-span-10 text-center'>";
						if ($heading) echo "<h2 class='font-sans font-bold text-4xl leading-[1.3] tracking-tight mb-0 text-river'>" . acf_esc_html( $heading ) . "</h2>";
						if ($body) echo "<div class='font-sans font-normal leading-relaxed text-river mt-6'>" . acf_esc_html( $body ) . "</div>";
					echo "</div>"; // col
				echo "</div>"; // row
			echo "</div>"; // constrain
		}


		$image_type = $_image_type;

		if ($image_type == 'unlinked') {
			$images = $_images;

if ($images) {

			if(is_array($images)){
				$images_count = count($images);
			} else {
				$images_count = 0;
			}


///			$images_count = count($images);
			$images_half_count = $images_count  / 2;
			$images_first_half = array_slice($images,0,$images_half_count);
			$images_second_half = array_slice($images,$images_half_count);

			if ( $images_first_half ) {
				echo "<div class='flex flex-col max-w-full mt-16'>"; //  mb-8
					echo "<div class='flex overflow-hidden select-none'>";

						echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full'>";
							foreach( $images_first_half as $image ) {

								if ($image_type == 'unlinked') {
									$alt = $image['alt'];

								} elseif ($image_type == 'linked') {
									$alt = $image['alt'];

								} else {
									$images = '';
								}


								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($alt) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
							}
						echo "</div>"; // marquee

						echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
							foreach( $images_first_half as $image ) {
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
							}
						echo "</div>"; // marquee__group

					echo "</div>"; // marquee__main
				echo "</div>"; // marquee-wrapper
			}


			if ( $images_second_half ) {
				echo "<div class='flex flex-col max-w-full'>";
					echo "<div class='flex overflow-hidden select-none'>";

						echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full'>";
							foreach( $images_second_half as $image ) {
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
							}
						echo "</div>"; // marquee__group

						echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
							foreach( $images_second_half as $image ) {
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'><img alt='" . esc_attr($image['alt']) . "' src='" . esc_url($image['sizes']['thumbnail']) . "' loading='lazy'></div>";
							}
						echo "</div>"; // marquee__group

					echo "</div>"; // marquee__main
				echo "</div>"; // marquee-wrapper
			}

} // if images


		} elseif ($image_type == 'linked') {
			$logos = $_logos;

if ($logos) {

			$images_count = count($logos);
			$images_half_count = $images_count  / 2;
			$images_first_half = array_slice($logos,0,$images_half_count);
			$images_second_half = array_slice($logos,$images_half_count);

			if ( $images_first_half ) {
				echo "<div class='flex flex-col max-w-full mt-16'>"; // mb-8
					echo "<div class='flex overflow-hidden select-none'>";

						echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full'>";
							foreach( $images_first_half as $logo ) {
								$logo_image = $logo['logos_image'];
								$logo_url = $logo['logos_url'];
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
									if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
										echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
									if ($logo_url) echo "</a>";
								echo "</div>";
							}
						echo "</div>"; // marquee

						echo "<div class='marquee flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
							foreach( $images_first_half as $logo ) {
								$logo_image = $logo['logos_image'];
								$logo_url = $logo['logos_url'];
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
									if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
										echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
									if ($logo_url) echo "</a>";
								echo "</div>";
							}
						echo "</div>"; // marquee__group

					echo "</div>"; // marquee__main
				echo "</div>"; // marquee-wrapper
			}


			if ( $images_second_half ) {
				echo "<div class='flex flex-col max-w-full'>";
					echo "<div class='flex overflow-hidden select-none'>";

						echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full'>";
							foreach( $images_second_half as $logo ) {
								$logo_image = $logo['logos_image'];
								$logo_url = $logo['logos_url'];
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
									if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
										echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
									if ($logo_url) echo "</a>";
								echo "</div>";
							}
						echo "</div>"; // marquee__group

						echo "<div class='marquee marquee--reverse flex shrink-0 items-center justify-around min-w-full' aria-hidden='true'>";
							foreach( $images_second_half as $logo ) {
								$logo_image = $logo['logos_image'];
								$logo_url = $logo['logos_url'];
								echo "<div class='flex justify-center items-center w-50 h-full overflow-hidden'>";
									if ($logo_url) echo "<a href='". esc_url($logo_url) . "' target='_blank' rel='noopener noreferrer' aria-label='Visit partner website (opens in new window)'>";
										echo "<img alt='" . esc_attr($logo['logos_image']['alt']) . "' src='" . esc_url($logo['logos_image']['sizes']['thumbnail']) . "' width='" . esc_attr($logo['logos_image']['sizes']['thumbnail-width']) . "' height='" . esc_attr($logo['logos_image']['sizes']['thumbnail-height']) . "' loading='lazy'>";
									if ($logo_url) echo "</a>";
								echo "</div>";
							}
						echo "</div>"; // marquee__group

					echo "</div>"; // marquee__main
				echo "</div>"; // marquee-wrapper
			}
} // if logos


		} else {
			// Handle the case where image_type is neither 'unlinked' nor 'linked'
			echo 'Image type not specified.';
		}

		if ($link) {
			echo "<div class='mx-auto relative z-10 px-4 md:px-8 flex justify-center'>";
				echo acf_link( $link, 'box', 'text-river box-river mt-12 ' . $link_classes );
			echo "</div>"; // col
		}


	echo "</section>"; // stack


}