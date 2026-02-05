<?php

$stack_id = ($args['id']) ? $args['id'] : '';

$stack_class = ($args['class']) ? $args['class'] : '';
$stack_class .= ' pb-25 pb:py-35';

$kicker = get_sub_field('kicker');
$body = get_sub_field('body');
$heading = get_sub_field('heading');
$rows = get_sub_field('solutions');


echo "<section id='" . esc_attr( $stack_id ) . "' class='" . $stack_class . "'>";

	echo "<div class='constrain'>";
		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-6'>";

				echo "<div class='reveal'>";
					if ($kicker) echo "<div class='kicker text-sky mb-6'>" . acf_esc_html( $kicker ) . "</div>";
					if ($body) echo "<div class='body text-limestone mb-20'>" . acf_esc_html( $body ) . "</div>";
				echo "</div>"; // reveal

			echo "</div>"; // col
		echo "</div>"; // row

		echo "<div class='row gap-x-2.5'>";
			echo "<div class='col-start-2 col-span-14  lg:col-start-2 lg:col-span-8'>";
				echo "<div class='reveal'>";
					if ($heading) echo "<h3 class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-limestone'>" . acf_esc_html( $heading ) . "</h3>";
				echo "</div>"; // reveal
			echo "</div>"; // col
		echo "</div>"; // row
	echo "</div>"; // constrain





	echo "<div class='constrain reveal'>";
		echo "<div class='row gap-x-2.5'>";

			echo "<div class='hidden md:block col-start-1 col-span-1 relative'>";
//				echo "<div class='swiper-button-prev swiper-button-prev-solutions'></div>";
			echo "</div>"; // col

			echo "<div class='col-start-2 col-span-14  md:col-start-2 md:col-span-7 relative'>";

				if( $rows ) {
					    echo "<div id='swiperSolutions' class='swiper swiper-solutions'>";
						echo "<div class='swiper-wrapper'>";

							foreach( $rows as $row ) {
								echo "<div class='swiper-slide'>";
									echo "<div class='swiper-slide-content'>";

										$kicker = $row['kicker'];
										$heading = $row['heading'];
										$body = $row['body'];
										$link = $row['link'];

										if ($kicker) echo "<div class='kicker text-sky mb-6'>" . acf_esc_html( $kicker ) . "</div>";
										if ($heading) echo "<div class='font-sans text-3xl lg:text-4xl font-bold leading-[1.03] -tracking-[0.02em] text-limestone mb-6'>" . acf_esc_html( $heading ) . "</div>";
										if ($body) echo "<div class='body text-limestone'>" . acf_esc_html( $body ) . "</div>";
										echo acf_link( $link, 'arrow', 'text-sky arrow-white mt-12' );
									echo "</div>";
								echo "</div>";
							}

						echo "</div>"; // swiper-wrapper
//						echo "<div class='swiper-pagination swiper-pagination-solutions'></div>";
					echo "</div>"; // swiper-solutions
				}

			echo "</div>"; // col
			echo "<div class='hidden col-start-1 col-span-15  md:block md:col-start-9 md:col-span-7'>";
echo <<<EOT
    <svg id="svgSolutions" class="mx-auto" viewBox="0 0 767 750">
      <path class="line" d="M452.7,375c0.8,0.8,1.8,2.1,2.3,2.6c110.8,124.5,220.2,62.7,221.2,0.1c1.2-74.4-171.8-125.4-287.3,82.9" />
      <path class="line" d="M388.9,460.5c-0.6,1-1.4,2.4-1.8,3c-86.6,142.4,4.5,228.9,64.7,211.5c71.4-20.6,69.6-200.9-163.4-250.4" />
      <path class="line" d="M288.2,424.6c-1.1-0.3-3.6-0.9-4.3-1.1c-161.4-41.6-217.7,70.8-183.6,123.3C140.8,609.2,313,558.3,292.7,321" />
      <path class="line" d="M292.6,320.6c-0.1-1.1-0.3-4.6-0.4-5.3c-16.5-165.8-141.4-180-179-129.9c-44.6,59.4,58.3,205.4,274.1,104.7" />
      <path class="line" d="M387.5,290c1-0.5,4.2-1.9,4.8-2.2c149.7-73.2,119.5-195.2,59.5-213c-71.2-21.1-169,132.5,0.5,299.8" />

      <path id="path1" class="path" d="M452.7,375c0.8,0.8,1.8,2.1,2.3,2.6c110.8,124.5,220.2,62.7,221.2,0.1c1.2-74.4-171.8-125.4-287.3,82.9" />
      <path id="path2" class="path" d="M388.9,460.5c-0.6,1-1.4,2.4-1.8,3c-86.6,142.4,4.5,228.9,64.7,211.5c71.4-20.6,69.6-200.9-163.4-250.4" />
      <path id="path3" class="path" d="M288.2,424.6c-1.1-0.3-3.6-0.9-4.3-1.1c-161.4-41.6-217.7,70.8-183.6,123.3C140.8,609.2,313,558.3,292.7,321" />
      <path id="path4" class="path" d="M292.6,320.6c-0.1-1.1-0.3-4.6-0.4-5.3c-16.5-165.8-141.4-180-179-129.9c-44.6,59.4,58.3,205.4,274.1,104.7" />
      <path id="path5" class="path" d="M387.5,290c1-0.5,4.2-1.9,4.8-2.2c149.7-73.2,119.5-195.2,59.5-213c-71.2-21.1-169,132.5,0.5,299.8" />

      <circle id="point1" class="point" cx="388.9" cy="460.5" r="8" />
      <circle id="point2" class="point" cx="288.2" cy="424.6" r="8" />
      <circle id="point3" class="point" cx="292.6" cy="320.6" r="8" />
      <circle id="point4" class="point" cx="387.5" cy="290" r="8" />
      <circle id="point5" class="point" cx="452.7" cy="375" r="8" />

      <path class="triangle" d="M352.3,373.9l-7.9-8.5l-6.3-6.8h40v43L364,386.5L352.3,373.9z" />
    </svg>
EOT;
			echo "</div>"; // col

			echo "<div class='hidden md:block col-start-16 col-span-1 relative'>";
//				echo "<div class='swiper-button-next swiper-button-next-solutions'></div>";
			echo "</div>"; // col



		echo "</div>"; // row


//	echo "<div class='swiper-buttons-solutions-container'>";
		echo "<div class='swiper-buttons-solutions'>";
//			echo "<div class='swiper-button-prev swiper-button-prev-projects'></div>";
//			echo "<div class='swiper-button-next swiper-button-next-projects'></div>";


			echo "<div class='swiper-button-prev swiper-button-prev-solutions'></div>";
			echo "<div class='swiper-button-next swiper-button-next-solutions'></div>";
			echo "<div class='swiper-pagination swiper-pagination-solutions'></div>";

		echo "</div>";
//	echo "</div>";





	echo "</div>"; // constrain
echo "</section>"; // stack




$swiper_solutions = <<<EOT
gsap.registerPlugin(DrawSVGPlugin, MotionPathPlugin);

MotionPathPlugin.convertToPath(
  "circle, rect, ellipse, line, polygon, polyline"
);

const numSlides = document
  .getElementById("swiperSolutions")
  .getElementsByClassName("swiper-slide").length;

const swiperSolutions = new Swiper(".swiper-solutions", {
  mousewheel: { enabled: false },
  observer: true,
  observeParents: true,
  watchSlidesProgress: true,
  slideToClickedSlide: true,
  virtual: true,

  centeredSlides: false,
  keyboard: { enabled: true },
  spaceBetween: 32,
speed: 500,

  navigation: {
    nextEl: '.swiper-button-next-solutions',
    prevEl: '.swiper-button-prev-solutions',
  },

	pagination: { clickable: false, el: ".swiper-pagination-solutions" },

	breakpoints: {
		640: {
		},
		768: {
		},
		1024: {
		},
		1280: {
		},
	},

  on: {
    slideNextTransitionStart: function () {
      let index = this.activeIndex;
      let i = index % numSlides;
      rotateForward(i);
    },
    slidePrevTransitionStart: function () {
      let index = this.activeIndex;
      let i = index % numSlides;
      rotateReverse(i);
    }
  }
});

var tl = gsap.timeline();

gsap.set("#path2, #path3, #path4, #path5", { drawSVG: "0%" });
gsap.set("#point2, #point3, #point4, #point5", {
  scale: 0,
  transformOrigin: "center"
});
gsap.set("#point1", { opacity: 1 });

function rotateForward(i) {
  gsap.set(".path", { visibility: "visible" });
  if (i === 1) {
    tl.to("#path2", {
      duration: 0.75,
      drawSVG: "100%",
      ease: "power1.inOut"
    }).to("#point2", { duration: 0.25, opacity: 1, scale: 1 });
  }
  if (i === 2) {
    tl.to("#path3", {
      duration: 0.75,
      drawSVG: "100%",
      ease: "power1.inOut"
    }).to("#point3", { duration: 0.25, opacity: 1, scale: 1 });
  }
  if (i === 3) {
    tl.to("#path4", {
      duration: 0.75,
      drawSVG: "100%",
      ease: "power1.inOut"
    }).to("#point4", { duration: 0.25, opacity: 1, scale: 1 });
  }
  if (i === 4) {
    tl.to("#path5", {
      duration: 0.75,
      drawSVG: "100%",
      ease: "power1.inOut"
    }).to("#point5", { duration: 0.25, opacity: 1, scale: 1 });
  }
}


function rotateReverse(i) {
  if (i == 0) {
    tl.to("#point2", { duration: 0.15, opacity: 0, scale: 0 }).to("#path2", {
      duration: 0.5,
      drawSVG: "0%",
      ease: "power1.inOut"
    });
  }
  if (i === 1) {
    tl.to("#point3", { duration: 0.15, opacity: 0, scale: 0 }).to("#path3", {
      duration: 0.5,
      drawSVG: "0%",
      ease: "power1.inOut"
    });
  }
  if (i === 2) {
    tl.to("#point4", { duration: 0.15, opacity: 0, scale: 0 }).to("#path4", {
      vduration: 0.75,
      drawSVG: "0%",
      ease: "power1.inOut"
    });
  }
  if (i === 3) {
    tl.to("#point5", { duration: 0.15, opacity: 0, scale: 0 }).to("#path5", {
      duration: 0.5,
      drawSVG: "0%",
      ease: "power1.inOut"
    });
  }
  if (i === 4) {
    tl.to("#point1", { duration: 0.15, opacity: 0, scale: 0 }).to("#path1", {
      duration: 0.5,
      drawSVG: "0%",
      ease: "power1.inOut"
    });
  }
}


EOT;
//wp_enqueue_script( 'wpdocs-my-script', 'https://url-to/my-script.js' );
wp_add_inline_script( 'g2o-script', $swiper_solutions, 'after' );