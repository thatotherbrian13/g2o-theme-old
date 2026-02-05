<?php

//$featured_post = get_field('featured_post');

/*
function acf_link( $featured_post ) {

	$output = '';

	if( $featured_post ) {

        $permalink = get_permalink( $featured_post->ID );
        $title = get_the_title( $featured_post->ID );

		$output .= "<h3><a href='" . $permalink . "' title='" . $title . "'>" . esc_html( $featured_post->post_title) . "</a></h3>";
	}


	echo $output;
}
*/


/*


<?php
$featured_posts = get_field('featured_posts');
if( $featured_posts ): ?>
    <ul>
    <?php foreach( $featured_posts as $featured_post ):
        $permalink = get_permalink( $featured_post->ID );
        $title = get_the_title( $featured_post->ID );
        $custom_field = get_field( 'field_name', $featured_post->ID );
        ?>
        <li>
            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
            <span>A custom field from this post: <?php echo esc_html( $custom_field ); ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

*/





// $link = get_field('link');
function acf_link( $link, $type = '', $class = '', $label = '' ) {

	$output = '';

	if( $link == 'anchor') {
		$link_class = ($class != '') ? $class : '';
		$link_label = ($label != '') ? $label : 'MISSING LABEL';


		if ($type == 'box') {
			$output .= "<div class='link-box " . $link_class . "' >";
				$output .= "<div class='anchor'><span><span>" . acf_esc_html( $link_label ) . "</span></span><span class='box'></span></div>";
			$output .= "</div>";
		}

		if ($type == 'arrow') {
			$output .= "<div class='link-arrow " . $link_class . "' >";
				$output .= "<div class='anchor'><span>" . acf_esc_html( $link_label ) . "</span></div>";
			$output .= "</div>";
		}


	} elseif( $link ) {
		$link_url = $link['url'];
		$link_title = $link['title'];
		$link_target = $link['target'] ? $link['target'] : '_self';
		$link_class = ($class != '') ? $class : '';

		if ($type == 'box') {
			$output .= "<div class='link-box " . $link_class . "' >";
				$output .= "<a href='" . esc_url( $link_url ) . "' target='" . esc_attr( $link_target ) . "'><span><span>" . acf_esc_html( $link_title ) . "</span></span><span class='box'></span></a>";
			$output .= "</div>";
		}

		if ($type == 'arrow') {
			$output .= "<div class='link-arrow " . $link_class . "' >";
				$output .= "<a href='" . esc_url( $link_url ) . "' target='" . esc_attr( $link_target ) . "'><span>" . acf_esc_html( $link_title ) . "</span></a>";
			$output .= "</div>";
		}


	}

	echo $output;
}




//<div class="link-box text-white box-sky mt-12"><a href="https://g2odev.wpengine.com/project/cardinal-health/" target="_self"><span><span>Learn More About The Work</span></span><div class="box"></div></a></div>
