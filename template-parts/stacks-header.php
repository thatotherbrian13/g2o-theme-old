<?php

if( have_rows( 'header_stacks' ) ):

	echo "<div class='stacks stacks--header'>";

		while ( have_rows( 'header_stacks' ) ) : the_row();

			$layout = get_row_layout( 'header_stacks' );

			$args_id = str_replace("_", "-", $layout);

			$args_class = str_replace("stack_", "stack-", $layout);
			$args_class = str_replace("_", "-", $args_class);

			$args = array(
				'id' => $args_id . '-' . get_row_index(),
				'class' => 'stack ' . $args_class,
			);

			get_template_part( 'template-parts/stacks/' . $layout , null, $args );

		endwhile;


	echo "</div>"; // stacks

else :
	// no rows found

endif;