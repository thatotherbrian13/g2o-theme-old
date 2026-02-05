<?php
if ( is_user_logged_in() && current_user_can('administrator') ) {

	echo "<div class='bg-black text-white text-xs font-mono font-bold leading-none tracking-widest rounded-tl-lg rounded-tr-lg py-1.5 px-3 fixed bottom-0 left-1/2 -translate-x-1/2 z-9999 w-auto' title='Tailwind 3 Breakpoint'>";
		echo "<div class='block sm:hidden'>DEFAULT &lt;640px</div>";
		echo "<div class='hidden sm:block md:hidden'>SM &ge;640px</div>";
		echo "<div class='hidden md:block lg:hidden'>MD &ge;768px</div>";
		echo "<div class='hidden lg:block xl:hidden'>LG &ge;1024px</div>";
		echo "<div class='hidden xl:block 2xl:hidden'>XL &ge;1280px</div>";
		echo "<div class='hidden 2xl:block'>2XL &ge;1536px</div>";
	echo "</div>";

}