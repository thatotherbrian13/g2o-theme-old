<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' bg-river';

$kicker = get_sub_field('kicker');

//$featured_post = get_sub_field('featured_post');


$recent_posts = wp_get_recent_posts( array( 'numberposts' => '1' ) );
$featured_post = $recent_posts[0]['ID'];

$heading = get_the_title( $featured_post );
$link = get_permalink( $featured_post );
$image = get_sub_field('image');
$image_alignment = get_sub_field( 'image_alignment', $featured_post->ID );

$border_color = get_sub_field( 'border_color', $featured_post->ID );
$class = ($border_color == "red") ? "border-city" : "border-limestone";


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='grid grid-cols-1  md:grid-cols-2'>";

 		$order = ($image_alignment == "right") ? "md:order-last" : "";
		echo "<div class='flex flex-col justify-center {$order}'>";

/*
			$image_id = get_post_thumbnail_id( $featured_post );
			if( !empty( $image_id ) ) {
				$image_size = 'square';
				$attr = array(
					'class' => 'object-cover object-center  aspect-square  md:aspect-auto  md:w-full md:h-full',
				);
				echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
			}
*/

			if( !empty( $image ) ) {
				$image_id = $image['id'];
				$image_size = 'square';
				$attr = array(
					'class' => 'object-cover object-center  aspect-square  md:aspect-auto  md:w-full md:h-full',
					'loading' => false,
				);
				echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
			}



		echo "</div>"; // col


		$order = ($image_alignment == "right") ? "md:order-first" : "";
		echo "<div class='flex flex-col justify-center {$order} bg-sky text-river'>";


			echo "<div class='grid grid-cols-8 gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-6'>";

					echo "<div class='py-15 lg:py-25'>";
						echo "<div class='reveal'>";
							if ($kicker) echo "<div class='kicker pb-4 mb-10 border-b {$class}'>" . acf_esc_html( $kicker ) . "</div>";
							if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.3] -tracking-[0.02em] text-river mb-8'>" . acf_esc_html( $heading ) . "</h2>";
							echo "<div class='link-box text-river box-river mt-12'><a href='" . esc_url( $link ) . "'><span><span>Discover More</span></span><div class='box'></div></a></div>";
						echo "</div>"; // reveal
					echo "</div>"; //

				echo "</div>"; // col
			echo "</div>"; // grid


		echo "</div>"; // col


	echo "</div>"; // row
echo "</section>"; // stack