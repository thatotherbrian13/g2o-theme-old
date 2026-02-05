<?php

if( have_rows( 'page_stacks' ) ):

	echo "<div class='stacks'>";

		while ( have_rows( 'page_stacks' ) ) : the_row();

			$layout = get_row_layout( 'page_stacks' );

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


/*

		$class = str_replace("_", "--", $layout);
		$args = array(
			'id' => $id,
			'class' => 'stack stack-' . get_row_index() . ' ' . $class,
			'data'  => array(
				'size' => 'large',
				'is-active' => true,
			)
		);
*/