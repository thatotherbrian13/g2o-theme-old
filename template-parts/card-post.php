<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package g2o
 */

$category = get_the_category();
$kicker = $category[0]->cat_name;

$heading = get_the_title();
$permalink = get_permalink();

/*
$attr = array(
	'class' => 'object-cover object-center',
);
$image = get_the_post_thumbnail( '', 'full', $attr );
*/

echo "<div class='col-span-1 flex flex-col'>";

	if ( has_post_thumbnail( ) ) {
		$image_id = get_post_thumbnail_id( );
		$image_size = 'aspect-3-2';
		$attr = array(
			'class' => 'object-cover object-center',
			'loading' => false,
		);
		echo "<a href='" . esc_url( $permalink ) . "' class='aspect-w-3 aspect-h-2'>";
			echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
		echo "</a>";
	}

	echo "<div class='flex flex-col p-5 h-full'>";
		if ($kicker) echo "<div class='font-sans font-bold leading-normal text-[15px] text-gunmetal mb-6'>" . acf_esc_html( $kicker ) . "</div>";
		if ($heading) echo "<div class='body text-pathway mb-10'>" . acf_esc_html( $heading ) . "</div>";
		echo "<div class='link-arrow text-gunmetal arrow-gunmetal !mt-auto'><a href='" . esc_url( $permalink ) . "'><span>Read More</span></a></div>";
	echo "</div>"; // flex

echo "</div>"; // col
