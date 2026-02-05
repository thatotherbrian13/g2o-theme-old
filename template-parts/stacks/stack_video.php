<?php
/**
 * Stack: Video
 * Embedded video player section.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';

// Field values: check $args first, then fall back to ACF
$video = $args['video'] ?? get_sub_field('video');

$pad_top = $args['pad_top'] ?? get_sub_field('pad_top');
$pad_bot = $args['pad_bot'] ?? get_sub_field('pad_bot');
$stack_class .= $pad_top ? ' ' . $pad_top : ' pt-15';
$stack_class .= $pad_bot ? ' ' . $pad_bot : ' pb-15';

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";
// https://www.advancedcustomfields.com/resources/oembed/
/*

// Load value.
$iframe = get_field('oembed');

// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

// Display customized HTML.
echo $iframe;
*/


				if ($video) echo "<div class='video-embed-container'>" . $video . "</div>";


	echo "</div>"; // constrain
echo "</section>"; // stack