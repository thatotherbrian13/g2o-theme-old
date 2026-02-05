<?php
// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
//$stack_class .= ' py-15 lg:py-20';

$rows = $args['columns'] ?? get_sub_field('columns');
$link = $args['link'] ?? get_sub_field('link');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}

$bg_color = $args['bg_color'] ?? get_sub_field('bg_color');
$bg_color = $bg_color ?: 'transparent';

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');
$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "' style='background-color:" . acf_esc_html( $bg_color ) . "'>";
	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  md:col-start-4 md:col-span-10  lg:col-start-3 lg:col-span-12'>";

				if( $rows ) {
					echo "<div class='grid grid-cols-1 lg:grid-cols-3 gap-15'>";

						foreach( $rows as $row ) {
							$icon = $row['icon'] ?? null;
							$heading = $row['heading'] ?? '';
							$body = $row['body'] ?? '';

							echo "<div class='col-span-1 text-center'>";

								if( !empty( $icon ) ) {
									$icon_id = is_array($icon) ? ($icon['id'] ?? 0) : 0;
									$icon_url = is_array($icon) ? ($icon['url'] ?? '') : '';
									$icon_alt = is_array($icon) ? ($icon['alt'] ?? '') : '';
									echo "<div class='icon mb-6 max-w-[48px] mx-auto'>";
									if ($icon_id) {
										$icon_size = 'full';
										$attr = array(
											'class' => 'mx-auto',
											'loading' => false,
										);
										echo wp_get_attachment_image( $icon_id, $icon_size, false, $attr );
									} elseif ($icon_url) {
										echo "<img class='mx-auto' src='" . esc_url($icon_url) . "' alt='" . esc_attr($icon_alt) . "'>";
									}
									echo "</div>"; // icon
								}






								if ($heading) echo "<h3 class='font-sans font-bold text-xl lg:text-[1.375rem] leading-snug text-gunmetal mb-6'>" . acf_esc_html( $heading ) . "</h3>";
								if ($body) echo "<div class='body text-pathway'>" . acf_esc_html( $body ) . "</div>";
							echo "</div>"; // col

						}

					echo "</div>"; // row
				}

			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain
echo "</section>"; // stack