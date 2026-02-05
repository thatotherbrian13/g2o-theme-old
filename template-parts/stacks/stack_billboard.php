<?php
/**
 * Stack: Billboard
 * Large hero section with prominent messaging and optional featured article.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';

$stack_class = $args['class'] ?? '';
$stack_class .= ' text-limestone pt-15 pb-25 lg:pt-20 lg:pb-35';

$heading = $args['heading'] ?? get_sub_field('heading');
$deck = $args['deck'] ?? get_sub_field('deck');
$kicker = $args['kicker'] ?? get_sub_field('kicker');
$rows = $args['featured_article'] ?? get_sub_field('featured_article');

echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";
	echo "<div class='constrain'>";

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-1 col-span-16  sm:col-start-2 sm:col-span-14'>";
				if ($heading) echo "<h2 class='headline-hero mb-16 split-text'>" . acf_esc_html( $heading ) . "</h2>";
			echo "</div>"; // col
		echo "</div>"; // row

		echo "<div class='row gap-x-2.5 mb-16'>";
			echo "<div class='col-start-1 col-span-16   sm:col-start-2 sm:col-span-14  md:col-start-2 md:col-span-12  lg:col-start-2 lg:col-span-10     2xl:col-start-2 2xl:col-span-8'>";
				if ($deck) echo "<div class='font-sans font-normal text-lg lg:text-[1.375rem] leading-[1.3] reveal'>" . acf_esc_html( $deck ) . "</div>";
			echo "</div>"; // col
		echo "</div>"; // row

//col-start-2 col-span-14
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-13     sm:col-start-4 sm:col-span-8     md:col-start-6 md:col-span-10     lg:col-start-8 lg:col-span-7      xl:col-start-9 xl:col-span-6'>";

					if ( $rows ) {
						echo "<div class='featured-article'>";

						foreach( $rows as $row ) {

							$heading = get_the_title( $row->ID );
							$attr = array(
								'class' => 'object-cover object-center',
							);
							$permalink = get_permalink( $row->ID );

							echo "<div class='grid grid-cols-1 md:grid-cols-5 gap-x-5 gap-y-12 reveal'>";


								echo "<div class='col-span-1 md:col-span-2 relative'>";
									if ($kicker) echo "<div class='kicker text-sky mb-4'>" . acf_esc_html( $kicker ) . "</div>";
									if ($heading) echo "<div class='body'>" . acf_esc_html( $heading ) . "</div>";
									echo "<div class='link-arrow text-sky arrow-white mt-6'><a href='" . esc_url( $permalink ) . "'><span>Read Now</span></a></div>";
								echo "</div>"; // col

								echo "<div class='col-span-1 md:col-span-3 relative'>";

									$image_id = get_post_thumbnail_id( $row->ID );
									if( !empty( $image_id ) ) {
										$image_size = 'aspect-3-2';
										$attr = array(
											'class' => 'object-cover object-center',
											'loading' => false,
										);
										echo "<div class='featured-thumb aspect-w-3 aspect-h-2'>";
											echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
										echo "</div>";
									}

								echo "</div>"; // col
							echo "</div>"; // grid
						}
				echo "</div>"; // featured-article

					}

			echo "</div>"; // col
		echo "</div>"; // row

	echo "</div>"; // constrain
echo "</section>"; // stack





/*
				$featured = get_sub_field('featured_article');
				if( $featured ) {

					$article = $featured['article'];
					if( !empty( $article ) ) {

						$permalink = get_permalink( $article->ID );
						$title = get_the_title( $article->ID );
//				        $custom_field = get_field( 'field_name', $article->ID );

						echo "<a href='" . esc_url( $permalink ) . "'>";

							$kicker = $featured['kicker'];
							echo "<div class='kicker'>" . esc_attr( $kicker ) . "</div>";
							echo "<div class='heading'>" . acf_esc_html( $title ) . "</div>";

							echo "<div class='link'>Read Now</div>";

							$image = $featured['image'];
							if( !empty( $image ) ) {
								$url = $image['url'];
								$alt = $image['alt'];
								echo "<img src='" . esc_url( $url ) . "' alt='" . esc_attr( $alt ) . "'>";
							}

							$image = $featured['image'];
							echo acf_responsive_image( $image );

						echo "</a>";

					}

				}
*/






//	}
//}






/*
if( have_rows('featured_article') ) {
	while( have_rows('featured_article') ) {

		// increment row
		the_row();

		// vars
		$kicker = get_sub_field('featured_article_kicker');
		echo "<div class='kicker'>{$kicker}</div>";

		$heading = get_sub_field('featured_article_heading');
		echo $heading;



		$image = get_sub_field('featured_article_thumbnail');
		if( !empty( $image ) ) {
			echo "<img src='" . esc_url($image['url']) . "' alt='" . esc_attr($image['alt']) . "'>";
		}





		$image = get_sub_field('featured_article_thumbnail');
		echo acf_responsive_image( $image );


		$link = get_sub_field('featured_article_post_object_post_object');
		echo acf_link( $link );


	}
}
*/








/*
        // Case: Paragraph layout.
        if( get_row_layout() == 'billboard' ):
            $heading = get_sub_field('billboard_heading');
            echo $heading;
            // Do something...

        // Case: Download layout.
        elseif( get_row_layout() == 'featured_article' ):
            $heading = get_sub_field('featured_article_heading');
            echo $heading;
            // Do something...

        endif;

*/



/*


$fields = get_fields();

if ( $fields ) {
	echo "<ul>";
		foreach( $fields as $field ) {
			if (is_array($field)) {
				echo "<li>is array</li>";
			} else {
//				echo "<li>" . $field['name'] . ": " . $field['value'] . "</li>";
				echo "<li><strong>" . $field . "</strong></li>";
			}
		}
	echo "</ul>";
}

$fields = get_field_objects();
if ( $fields ) {
	echo "<ul>";
		foreach( $fields as $field ) {
			if (is_array($field)) {
				echo "<li>is array</li>";
				foreach ($field as $item) {
					echo $item;
				}
			} else {
//				echo "<li>" . $field['label'] . ": " . $field['value'] . "</li>";
				echo "<li>" . $field['value'] . "</li>";
			}
		}
	echo "</ul>";
}

*/
/*

$fields = get_sub_field( 'billboard' );
if( $fields ): ?>
    <ul>
        <?php foreach( $fields as $field ): ?>
            <li><b><?php echo $field['name']; ?></b> <?php echo $field['value']; ?></li>

        <?php endforeach; ?>
    </ul>
<?php endif;

$heading = get_sub_field( 'billboard_billboard_heading' );
echo "<h3>$heading</h3>";


echo "<h2>BILLBOARD</h2>";

$heading = get_sub_field( 'billboard_heading' );
echo "<h3>$heading</h3>";

$body = get_sub_field('billboard_body');
echo "<p>$body</p>";


$heading = get_sub_field( 'featured_article_heading' );
echo "<h3>$heading</h3>";

$kicker = get_sub_field('featured_article_kicker');
echo "<p>$kicker</p>";


*//*
										if ($image) {
											$image_id = $image['id'];
											$image_size = 'full';
											$attr = array(
												'class' => '',
											);
											echo "<a class='article-thumb' href='" . esc_url( $link_url ) . "'>";
												echo wp_get_attachment_image( $image_id, $image_size, false, $attr );
											echo "</a>";
											echo "<div class='article-outline'></div>";
										}
*/
