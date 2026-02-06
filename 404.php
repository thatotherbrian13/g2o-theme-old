<?php

/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package g2o
 */

get_header();

echo "<main id='main'>";

	echo "<section id='stack-banner-1' class='stack stack-banner stack-banner-wedge py-25 lg:py-50'>";
		echo "<div class='constrain'>";

			echo "<div class='row gap-x-2.5'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-4 lg:col-span-10  text-center'>";
					echo "<div class='reveal'>";
						echo "<h1 class='font-sans font-bold text-3xl md:text-5xl lg:text-7xl tracking-tight text-gunmetal'>404</h1>";
						echo "<div class='deck text-river'>Not the outcome you were looking for?<br>We have solutions for you!</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row gap-x-2.5 mt-25'>";
				echo "<div class='col-start-2 col-span-13  lg:col-start-4 lg:col-span-10'>";
					echo "<div class='grid grid-cols-2  md:grid-cols-4  auto-rows-auto  gap-x-6 gap-y-12  lg:gap-x-12 lg:gap-y-12'>";
						echo "<div class='col-span-1 pr-4'><a class='dart dart-gunmetal' href='" . esc_url(home_url('/industries-expertise/')) . "'><span class='description'>Explore the benefits of Customer Experience Transformation and our Solutions</span></a></div>";
						echo "<div class='col-span-1 pr-4'><a class='dart dart-gunmetal' href='" . esc_url(home_url('/perspectives/')) . "'><span class='description'>Dive into our Perspective articles</span></a></div>";
						echo "<div class='col-span-1 pr-4'><a class='dart dart-gunmetal' href='" . esc_url(home_url('/about/')) . "'><span class='description'>Learn what it's like to work with us</span></a></div>";
						echo "<div class='col-span-1 pr-4'><a class='dart dart-gunmetal' href='" . esc_url(home_url('/contact/')) . "'><span class='description'>If you still can't find what you need, simply contact us</span></a></div>";
					echo "</div>";
				echo "</div>";
			echo "</div>"; // row

		echo "</div>"; // constrain
	echo "</section> ";

echo "</main>";

get_footer();