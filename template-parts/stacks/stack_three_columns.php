<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
//$stack_class .= ' three-col-bg  py-20 ';
//$stack_class .= '';

$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Pre-fetch all fields with $args fallback
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$heading = $args['heading'] ?? get_sub_field('heading');
$deck = $args['deck'] ?? get_sub_field('deck');
$subhead = $args['subhead'] ?? get_sub_field('subhead');
$body = $args['body'] ?? get_sub_field('body');
$columns = $args['columns'] ?? get_sub_field('columns');
$image = $args['image'] ?? get_sub_field('image');

// Ensure columns is an array
if (!is_array($columns)) {
    $columns = [];
}

if ($component_type == 'gradient') {
	// GRADIENT

	$stack_class .= ' stack-three-columns-gradient pt-25 pb-15';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-2 xl:col-span-8'>";
					echo "<div class='reveal'>";

						if ($heading) echo "<h2 class='font-sans font-bold text-4xl text-white mb-5'>" . acf_esc_html( $heading ) . "</h2>";


						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-white mb-16'>" . acf_esc_html( $deck ) . "</div>";


						if ($subhead) echo "<div class='font-sans font-bold text-xl text-white mb-30'>" . acf_esc_html( $subhead ) . "</div>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $columns ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-18'>";
							foreach( $columns as $column ) {




								$column_heading = $column['heading'];
								$column_body    = $column['body'];
								$column_link    = $column['link'];

								echo "<div class='h-full px-4 pb-5  md:px-5 md:pb-15 border-s border-city border-solid reveal'>";

									echo "<div class='flex flex-col'>";
										echo "<h3 class='font-sans font-light text-2xl leading-snug text-white strong-city'>" . acf_esc_html($column_heading) . "</h3>";
										echo "<p class='font-sans text-white'>" . $column_body . "</p>";
									echo "</div>";

									if ($column_link) {
										echo acf_link( $column_link, 'box', 'text-white box-white mt-12' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid row
					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack



} elseif ($component_type == 'clean') {
	// CLEAN (white background)

	$stack_class .= ' stack-three-columns-clean bg-white pt-25 pb-15';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-2 xl:col-span-8'>";
					echo "<div class='reveal'>";

						if ($heading) echo "<h2 class='font-sans font-bold text-4xl text-river mb-5'>" . acf_esc_html( $heading ) . "</h2>";

						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-river mb-16'>" . acf_esc_html( $deck ) . "</div>";

						if ($subhead) echo "<div class='font-sans font-bold text-xl text-river mb-30'>" . acf_esc_html( $subhead ) . "</div>";

					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $columns ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-18'>";
							foreach( $columns as $column ) {

								$column_heading = $column['heading'];
								$column_body    = $column['body'];
								$column_link    = $column['link'];

								echo "<div class='h-full px-4 pb-5  md:px-5 md:pb-15 border-s border-city border-solid reveal'>";

									echo "<div class='flex flex-col'>";
										echo "<h3 class='font-sans font-light text-2xl leading-snug text-river strong-city'>" . acf_esc_html($column_heading) . "</h3>";
										echo "<p class='font-sans text-river'>" . $column_body . "</p>";
									echo "</div>";

									if ($column_link) {
										echo acf_link( $column_link, 'box', 'text-river box-river mt-12' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid row
					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack



} elseif ($component_type == 'image') {
	// IMAGE

	$stack_class .= ' stack-three-columns-image bg-white py-25';

	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10  xl:col-start-7 xl:col-span-9'>";
					echo "<div class='reveal'>";
						if ($heading) echo "<h2 class='font-serif font-light text-5xl tracking-tight leading-tight text-river mb-10'>" . acf_esc_html( $heading ) . "</h2>";
						if ($deck) echo "<div class='font-sans font-light text-[22px] leading-snug text-river mb-16'>" . acf_esc_html( $deck ) . "</div>";
					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $columns ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-18'>";

							echo "<div class='h-full px-4 pb-5  md:px-5 md:pb-15'>";
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
							echo "</div>";

							foreach( $columns as $column ) {
								$column_heading = $column['heading'];
								$column_body    = $column['body'];
								$column_link    = $column['link'];

								echo "<div class='h-full py-4 pb-5  md:py-5 md:pb-15 border-t-2 border-river border-solid reveal'>";

									echo "<div class='flex flex-col'>";
										echo "<h3 class='font-sans font-light text-2xl leading-snug text-river strong-city'>" . acf_esc_html($column_heading) . "</h3>";
										echo "<p class='font-sans text-river'>" . $column_body . "</p>";
									echo "</div>";

									if ($column_link) {
										echo acf_link( $column_link, 'box', 'text-river box-river mt-12' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid row
					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack



} elseif ($component_type == 'spread') {
	// SPREAD

//	$stack_class .= ' three-col-bg  py-20 ';
	$stack_class .= ' stack-three-columns-spread py-20';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14'>";
					echo "<div class='grid grid-cols-1 lg:grid-cols-3 gap-15'>";

						echo "<div class=''>";
//							echo "<div class='flex flex-col'>";
								if ($heading) echo "<h2 class='font-sans font-bold text-4xl tracking-tighter text-river mb-5'>" . acf_esc_html( $heading ) . "</h2>";

								if ($body) echo "<div class='font-sans font-normal text-base leading-relaxed text-river'>" . acf_esc_html( $body ) . "</div>";
//							echo "</div>";
						echo "</div>";

						if ( $columns ) {
							foreach( $columns as $column ) {

								$column_heading = $column['heading'];
								$column_body    = $column['body'];
								$column_link    = $column['link'];

//								echo "<div class='h-full px-4 py-5  md:px-5 md:py-10'>";
								echo "<div class='justify-between flex flex-col  px-4 pb-5  md:px-5 md:pb-5 border-s border-city border-solid'>";

									echo "<div class='block mb-10'>";
										if ($column_heading) echo "<h3 class='font-serif font-light text-3xl tracking-tighter text-river mb-5'>" . acf_esc_html($column_heading) . "</h3>";
										if ($column_body) echo "<div class='font-sans font-normal text-base text-river mb-5'>" . acf_esc_html($column_body) . "</div>";

									echo "</div>"; // block

									echo acf_link( $column_link, 'box', 'text-river box-river' );

								echo "</div>";
							}
						}

						echo "</div>"; // grid row
					echo "</div>"; // col
				echo "</div>"; // row


		echo "</div>"; // constrain
	echo "</section>"; // stack



} else {
	// SIMPLE

//	$stack_class .= ' three-col-bg  py-20 ';
	$stack_class .= ' stack-three-columns-simple py-20';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-14 text-center'>";
					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-river mb-4'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='text-gunmetal mb-4 text-2xl  md:text-3xl font-serif md:w-1/2 mx-auto font-light'>" . acf_esc_html( $heading ) . "</h2>";
					echo "</div>"; // reveal
				echo "</div>"; // col
			echo "</div>"; // row

			if ( $columns ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";
						echo "<div class='grid grid-cols-1 lg:grid-cols-3 gap-15'>";
							foreach( $columns as $column ) {

								$column_heading = $column['heading'];
								$column_body    = $column['body'];
								$column_link    = $column['link'];

								echo "<div class='h-full px-4 py-5  md:px-5 md:py-10'>";
									echo "<div class='flex flex-col'>";
										echo "<h3 class='mb-4 font-bold text-xl uppercase'>" . acf_esc_html($column_heading) . "</h3>";
										echo "<p class='text-base'>" . $column_body . "</p>";
									echo "</div>";
									if ($column_link) {
										echo acf_link( $column_link, 'box', 'text-river box-river mt-12' );
									}
								echo "</div>";
							}
						echo "</div>"; // grid row
					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack

}