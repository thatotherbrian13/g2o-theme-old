<?php

if( have_rows( 'home_header_stacks' ) ):

	echo "<div class='stacks relative bg-river' style='padding-top: var(--nav-height, 80px);'>";

		while ( have_rows( 'home_header_stacks' ) ) : the_row();

			$layout = get_row_layout( 'home_header_stacks' );

			$args_id = str_replace("_", "-", $layout);

			$args_class = str_replace("stack_", "stack-", $layout);
			$args_class = str_replace("_", "-", $args_class);

			$args = array(
				'id' => $args_id . '-' . get_row_index(),
				'class' => 'stack ' . $args_class,
			);

			get_template_part( 'template-parts/stacks/' . $layout , null, $args );

		endwhile;


		echo "<canvas id='gradient-home' class='gradient-river' data-transition-in></canvas>";

$gradient_home = <<<EOT
const gradientHome = new Gradient();
gradientHome.initGradient('#gradient-home');
EOT;
wp_add_inline_script( 'g2o-script', $gradient_home, 'after' );



	echo "</div>"; // stacks

else :
	// no rows found

endif;