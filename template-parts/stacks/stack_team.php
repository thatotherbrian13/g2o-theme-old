<?php
/**
 * Stack: Team
 * Team member grid display.
 *
 * Variants: collocated, staggered
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Get component type first
$component_type = $args['component_type'] ?? get_sub_field('component_type');

// Helper function to render portrait image
if (!function_exists('g2o_render_team_portrait')) {
	function g2o_render_team_portrait($image, $size = 'aspect-5-6', $class = '') {
		if (empty($image)) return;

		$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
		$image_url = is_array($image) ? ($image['url'] ?? '') : '';
		$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';

		if ($image_id) {
			$attr = array('class' => $class, 'loading' => false);
			echo wp_get_attachment_image($image_id, $size, false, $attr);
		} elseif ($image_url) {
			echo "<img class='" . esc_attr($class) . "' src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
		}
	}
}

// COLLOCATED GRID
if ($component_type == 'collocated') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');
	$rows = $args['employees'] ?? get_sub_field('employees');

	$stack_class .= ' stack-team--collocated bg-limestone py-8 lg:py-15 xl:py-25';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
		echo "<div class='constrain  row gap-y-4'>";
			echo "<div class='row-start-1 col-start-2 col-span-14 reveal'>";

				if ($heading) echo "<h2 class='font-sans font-bold text-3xl lg:text-4xl leading-none tracking-tight text-river mb-20 text-center'>" . acf_esc_html( $heading ) . "</h2>";

				if ( $rows ) {
					// Dynamic grid columns based on team member count
					$count = count($rows);
					if ($count == 1) {
						$grid_cols = 'lg:grid-cols-1 lg:max-w-md lg:mx-auto';
					} elseif ($count == 2) {
						$grid_cols = 'lg:grid-cols-2 lg:max-w-3xl lg:mx-auto';
					} elseif ($count == 4) {
						$grid_cols = 'lg:grid-cols-4';
					} else {
						$grid_cols = 'lg:grid-cols-3';
					}

					echo "<div class='row gap-x-2.5'>";
						echo "<div class='col-start-2 col-span-14'>";
							echo "<div class='grid grid-cols-1 " . $grid_cols . " gap-10 lg:gap-12'>";
								$col_num = 2;
								foreach( $rows as $row ) {

									$full_name = $row['full_name'] ?? '';
									$body = $row['body'] ?? '';
									$role = $row['role'] ?? '';
									$image = $row['portrait'] ?? null;


									echo "<div class='h-full px-2 py-5 md:py-8'>";
										if( !empty( $image ) ) {
											echo "<div class='cta-image-container mb-6 max-w-44 mx-auto'>";
												echo "<div class='cta-image aspect-w-4 aspect-h-5'>";
													g2o_render_team_portrait($image, 'aspect-5-6');
												echo "</div>";
											echo "</div>";
										}

										echo "<div class='mb-4 lg:mb-5 text-center'>";
											if ($full_name) echo "<h3 class='headline-card text-river'>" . acf_esc_html( $full_name ) . "</h3>";
											if ($role) echo "<div class='font-sans text-sm font-bold leading-snug tracking-wider text-river uppercase mt-2'>" . acf_esc_html( $role ) . "</div>";
										echo "</div>"; // author

										if ($body) echo "<div class='body text-gunmetal text-sm leading-relaxed'>" . acf_esc_html( $body ) . "</div>";

									echo "</div>";
									$col_num = $col_num + 4;
								}
							echo "</div>"; // grid row
						echo "</div>"; // col
					echo "</div>"; // row
				}

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</section>"; // stack


// STAGGERED GRID
} elseif ($component_type == 'staggered') {

	$kicker = $args['kicker'] ?? get_sub_field('kicker');
	$heading = $args['heading'] ?? get_sub_field('heading');
	$rows = $args['employees'] ?? get_sub_field('employees');

	$stack_class .= ' stack-team--staggered bg-white pt-5 pb-10 lg:pt-8 lg:pb-12';
	echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

		echo "<div class='constrain'>";
			echo "<div class='row gap-x-2.5 mb-12'>";
				echo "<div class='col-start-2 col-span-14  md:col-start-4 md:col-span-10  lg:col-start-5 lg:col-span-8  text-center'>";

					echo "<div class='reveal'>";
						if ($kicker) echo "<div class='kicker text-gunmetal mb-8'>" . acf_esc_html( $kicker ) . "</div>";
						if ($heading) echo "<h2 class='font-serif text-2xl lg:text-3xl font-light leading-[1.4] text-gunmetal mb-6'>" . acf_esc_html( $heading ) . "</h2>";
					echo "</div>"; // reveal

				echo "</div>"; // col
			echo "</div>"; // row


			if( $rows ) {
				echo "<div class='row gap-x-2.5'>";
					echo "<div class='col-start-2 col-span-14'>";

				echo "<div class='employees'>";

						foreach( $rows as $row ) {
							$full_name = $row['full_name'] ?? '';
							$role = $row['role'] ?? '';
							$linkedin_profile = $row['linkedin_profile'] ?? '';
							$image = $row['portrait'] ?? null;
							$profile_link = $row['profile_link'] ?? '';


							echo "<div class='employee relative'>";

								if( !empty( $image ) ) {
									echo "<div class='relative z-10'>";
										if ($profile_link) echo "<a href='" . esc_url( $profile_link ) . "'>";
											g2o_render_team_portrait($image, 'full', 'object-cover');
										if ($profile_link) echo "</a>";
									echo "</div>"; // employee-portrait
								}

								echo "<div class='employee-info'>";
									if ($full_name) {
										echo "<div class='font-sans text-sm font-bold leading-snug tracking-wider text-river uppercase'>";
											echo acf_esc_html( $full_name );
										echo "</div>";
									}
									if ($role) echo "<div class='font-sans text-sm font-normal leading-snug tracking-wider text-river uppercase'>" . acf_esc_html( $role ) . "</div>";
									if ($linkedin_profile) echo "<a class='linkedin-profile inline-block lg:pl-7 relative font-sans text-sm lg:text-base font-normal leading-none text-river mt-4 underline decoration-current underline-offset-2 lg:no-underline' href='" . esc_url( $linkedin_profile ) . "' target='_self' rel='noopener noreferrer'>Learn More</a>";
								echo "</div>"; // employee-info

							echo "</div>"; // employee
						}


					echo "</div>"; // employees

					echo "</div>"; // col
				echo "</div>"; // row
			}

		echo "</div>"; // constrain
	echo "</section>"; // stack

}
