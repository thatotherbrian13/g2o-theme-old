<?php

$stack_id = ($args['id']) ? $args['id'] : '';
$stack_class = ($args['class']) ? $args['class'] : '';

$kicker = get_sub_field('kicker');
///$heading = get_sub_field('heading');
//$body = get_sub_field('body');
//$image = get_sub_field('image');

$rows = get_sub_field('authors');

$stack_class .= ' stack-cta-row text-gunmetal py-25 lg:py-35';
echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		if ($kicker) echo "<div class='kicker text-river text-center pb-4 mb-14 border-b border-river w-1/2 mx-auto reveal'>" . acf_esc_html( $kicker ) . "</div>";

		if ($rows) {
			echo "<div class='row gap-x-[6.25%] gap-y-20 grid-rows-1'>";
				$col_num = 2;
				foreach ($rows as $row) {
					$heading = $row['heading'];
					$body = $row['body'];
					$image = $row['image'];

					echo "<div class='col-span-10 col-start-4 sm:col-span-8 sm:col-start-5 md:col-start-{$col_num} md:col-span-4 reveal text-center'>";

						if( !empty( $image ) ) {
							$image_id = $image['id'];
							$image_size = 'aspect-5-6';
							$attr = array(
								'class' => '',
								'loading' => false,
							);
							echo "<div class='cta-image-container  mb-6'>";
								echo "<div class='cta-image aspect-w-5 aspect-h-6'>";
									echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
								echo "</div>";
							echo "</div>";
						}

						if ($heading) echo "<h2 class='font-sans text-xl lg:text-2xl font-bold leading-[1.03] -tracking-[0.02em] text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";
						if ($body) echo "<div class='body text-gunmetal'>" . acf_esc_html( $body ) . "</div>";

					echo "</div>"; // author

					$col_num = $col_num + 5;

				}
			echo "</div>"; // authors
		}
/*

		echo "<div class='row gap-x-2.5 gap-y-15 grid-rows-2 md:grid-rows-1   items-center'>";

			echo "<div class='row-start-1  col-start-2 col-span-8  md:col-start-3 md:col-span-5'>";
				if( !empty( $image ) ) {
					$image_id = $image['id'];
					$image_size = 'aspect-5-6';
					$attr = array(
						'class' => '',
						'loading' => false,
					);
					echo "<div class='cta-image-container'>";
						echo "<div class='cta-image aspect-w-5 aspect-h-6'>";
							echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
						echo "</div>";
					echo "</div>";
				}
			echo "</div>"; // col


			echo "<div class='row-start-2  md:row-start-1  col-start-8 col-span-14  md:col-start-9 md:col-span-6'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-river pb-4 mb-10 border-b border-river'>" . acf_esc_html( $kicker ) . "</div>";
					if ($heading) echo "<h2 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-river mb-6'>" . acf_esc_html( $heading ) . "</h2>";
					if ($body) echo "<div class='font-sans text-xl leading-[1.3] text-river'>" . acf_esc_html( $body ) . "</div>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row
*/

	echo "</div>"; // constrain
echo "</section>"; // stack