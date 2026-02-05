<?php
/**
 * Stack: Profile Banner
 * Personal profile hero section for leadership pages.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
$stack_class .= ' text-limestone pt-50 pb-25 lg:pt-50 lg:pb-35';

// Field values: check $args first, then fall back to ACF
$full_name = $args['full_name'] ?? get_sub_field('full_name');
$role = $args['role'] ?? get_sub_field('role');
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$body = $args['body'] ?? get_sub_field('body');

$linkedin_profile = $args['linkedin_profile'] ?? get_sub_field('linkedin_profile');
$image = $args['portrait'] ?? get_sub_field('portrait');


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='padding-top: 15rem !important;'>";

	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14 md:col-start-2 md:col-span-5'>";

				if ($full_name) echo "<h1 class='font-serif font-light text-3xl md:text-5xl lg:text-7xl text-white'>" . acf_esc_html( $full_name ) . "</h1>";
				if ($role) echo "<div class='deck text-light mt-4'>" . acf_esc_html( $role ) . "</div>";
				if ($kicker) echo "<div class='kicker text-light mt-10 mb-4'>" . acf_esc_html( $kicker ) . "</div>";
				if ($body) echo "<div class='body text-light'>" . acf_esc_html( $body ) . "</div>";
				if ($linkedin_profile) echo "<a class='inline-block relative font-sans text-sm lg:text-base font-normal leading-none text-white mt-10 no-underline decoration-current underline-offset-2' href='" . esc_url( $linkedin_profile ) . "' target='_blank' rel='noopener noreferrer' aria-label='View LinkedIn profile (opens in new window)'><svg fill='none' height='30' viewBox='0 0 30 30' width='30' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><clipPath id='a'><path d='m0 0h30v30h-30z'/></clipPath><g clip-path='url(#a)'><path d='m27.7793 0h-25.56446c-1.224606 0-2.21484.966797-2.21484 2.16211v25.66989c0 1.1953.990234 2.168 2.21484 2.168h25.56446c1.2246 0 2.2207-.9727 2.2207-2.1621v-25.67579c0-1.195313-.9961-2.16211-2.2207-2.16211zm-18.87891 25.5645h-4.45312v-14.3204h4.45312zm-2.22656-16.27153c-1.42969 0-2.58399-1.1543-2.58399-2.57813 0-1.42382 1.1543-2.57812 2.58399-2.57812 1.42383 0 2.57812 1.1543 2.57812 2.57812 0 1.41797-1.15429 2.57813-2.57812 2.57813zm18.89067 16.27153h-4.4473v-6.961c0-1.6582-.0293-3.7969-2.3145-3.7969-2.3144 0-2.666 1.8106-2.666 3.6797v7.0782h-4.4414v-14.3204h4.2656v1.9571h.0586c.5918-1.125 2.045-2.3145 4.2071-2.3145 4.5058 0 5.3379 2.9649 5.3379 6.8203z' fill='#72d1f6'/></g></svg></a>";

			echo "</div>"; // col

			echo "<div class='col-start-3 col-span-12   md:col-start-9 md:col-span-6    lg:col-start-9 lg:col-span-5'>";

					if( !empty( $image ) ) {
						$image_id = is_array($image) ? ($image['id'] ?? 0) : 0;
						$image_url = is_array($image) ? ($image['url'] ?? '') : '';
						$image_alt = is_array($image) ? ($image['alt'] ?? '') : '';
						echo "<div class='profile-image-container'>";
							echo "<div class='profile-image aspect-w-4 aspect-h-5'>";
							if ($image_id) {
								$image_size = 'aspect-5-6';
								$attr = array(
									'class' => '',
									'loading' => false,
								);
								echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
							} elseif ($image_url) {
								echo "<img src='" . esc_url($image_url) . "' alt='" . esc_attr($image_alt) . "'>";
							}
							echo "</div>";
						echo "</div>";
					}

			echo "</div>"; // col

		echo "</div>"; // row
	echo "</div>"; // constrain

	echo "<div class='wedge-reverse wedge-scroller wedge-river'></div>";
echo "</section>"; // stack