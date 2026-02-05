<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-river py-25 lg:py-35';

$kicker = get_sub_field('kicker');
$heading = get_sub_field('heading');
$body = get_sub_field('body');

$link = get_sub_field('link');
$image = get_sub_field('image');
$bg_image = get_sub_field('bg_image');


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5 gap-y-15 auto-rows-auto lg:grid-rows-1'>";

			echo "<div class='col-start-8 col-span-8  row-start-1 lg:row-start-1  lg:col-start-10 lg:col-span-5'>";

				if( !empty( $image ) ) {
					$image_id = $image['id'];
					$image_size = 'aspect-6-5';
					$attr = array(
						'class' => 'object-cover object-center',
						'loading' => false,
					);
					echo "<div class='story-image relative aspect-w-1 aspect-h-1 reveal'>";
						echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
					echo "</div>";
				}

			echo "</div>"; // col


			echo "<div class='col-start-2 col-span-14  row-start-2 lg:row-start-1  lg:col-start-2 lg:col-span-7'>";
				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-sky mb-8'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-limestone mb-8'>" . acf_esc_html( $heading ) . "</h2>";
					if ($body) echo "<div class='body text-pathway-light'>" . acf_esc_html( $body ) . "</div>";
					echo acf_link( $link, 'box', 'text-white box-sky mt-12' );
				echo "</div>"; // reveal

			echo "</div>"; // col

		echo "</div>"; // row
	echo "</div>"; // constrain

	if ($bg_image) {
		$url = $bg_image['url'];
		$title = $bg_image['title'];
		$alt = $bg_image['alt'];
		$filename = $bg_image['filename'];
		echo "<img class='absolute inset-0 z-0 w-full h-full object-cover object-center' src='" . esc_url($url) . "' alt='" . esc_attr($alt) . "'>";
	}

echo "</section>"; // stack


