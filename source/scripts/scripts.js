/**
 * G2O Main Scripts
 * ES Module imports (replaces CodeKit @codekit-prepend directives)
 */

// GSAP and plugins
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { MotionPathPlugin } from 'gsap/MotionPathPlugin';

// Alpine.js and plugins
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import intersect from '@alpinejs/intersect';

// Swiper
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// Register Alpine plugins and start
Alpine.plugin(collapse);
Alpine.plugin(intersect);
window.Alpine = Alpine;
Alpine.start();

// Make GSAP available globally for inline scripts
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.MotionPathPlugin = MotionPathPlugin;

// Make Swiper available globally for inline scripts
window.Swiper = Swiper;

// Configure GSAP defaults
gsap.defaults({ ease: "none" });
gsap.registerPlugin(MotionPathPlugin, ScrollTrigger);

ScrollTrigger.defaults({
	markers: false
});












/*
const smoother = ScrollSmoother.create({
	wrapper: "#smoother-wrapper",
	content: "#smoother-content",
	smooth: 6,
	effects: false,
	normalizeScroll: true
});
*/



let containers = gsap.utils.toArray(".reveal");
//let containers = document.querySelectorAll(".showme");
containers.forEach((container, i) => {
  let tl = gsap.timeline({
    scrollTrigger: {
      trigger: container,
      scrub: false,
      //      start: () => `top+=${i * window.innerHeight} bottom`,
      //      end: () => `top+=${(i + 1) * window.innerHeight} top-=100%`,

      start: "top 90%",
      end: "bottom 10%",
      //      end: "bottom top-=100%",
      toggleActions: "play none none reverse",
//      markers: { startColor: "red", endColor: "red" }
    }
  });

  tl.from(container, {
    duration: 1,
    ease: "power1.inOut",
    opacity: 0,
    //    yPercent: -20
    y: 50
  });
});





//ScrollTrigger.normalizeScroll(true); // turning this on disables the mobile nav scroll!!!

//			toggleActions: "play none none reverse",
/*
let containers = document.querySelectorAll(".reveal");
containers.forEach((container, i) => {
	let tl = gsap.timeline({
		scrollTrigger: {
			trigger: container,
			start: "top 90%",
			end: "top bottom",
			toggleActions: "play none none none",
		}
	});

	tl.from(container, {
		duration: 1,
		ease: "power1.in",
		opacity: 0,
		yPercent: 20,
	});
});
*/




// NAVIGATION
let mm = gsap.matchMedia();

//gsap.set("#primary-menu", { autoAlpha: 1 });

mm.add("(min-width: 1024px)", () => {

/*
	gsap.to("#primary-menu", {
		duration: 1.5,
		ease: "power1.inOut",
//		opacity: 0,
//		visibility: "hidden",
		autoAlpha: 0,
//		xPercent: 200,
		scrollTrigger: {
			start: `${window.innerHeight / 2} top`,
			end: "bottom",
			toggleActions: "restart none none reverse",
		}
	});
*/


	gsap.to("#primary-menu", {
		autoAlpha: 0,
		duration: 1.25,
		ease: "power1.inOut",
		xPercent: 200,
		scrollTrigger: {
			start: `${window.innerHeight / 2} top`,
			end: "bottom",
			toggleActions: "restart none none reverse",
		}
	});

	gsap.set("#open", { autoAlpha: 0 });
	gsap.to("#open", {
		autoAlpha: 1,
		duration: 0.5,
		ease: "none",
		scrollTrigger: {
			start: `${window.innerHeight / 2} top`,
			end: "bottom",
			toggleActions: "restart none none reverse",
		}
	});

	gsap.to("#masthead-bg", {
		duration: 1,
		ease: "power1.inOut",
		opacity: 0.3,
		scrollTrigger: {
			start: `${window.innerHeight / 2} top`,
			end: "bottom",
			trigger: "body",
			toggleActions: "restart none none reverse",
		}
	});

});





let menu = gsap.timeline({ paused: true, reversed: true });

menu.to("#menu", {
	duration: 0.75,
	ease: "power2.inOut",
	left: 0
});

function menuToggle() {
//	let html = document.querySelector("html,body");
//	html.classList.toggle("noscroll");
	menu.reversed() ? menu.play() : menu.reverse();
}



/*
function slideout() {
	return {
		open: false,
		usedKeyboard: false,
		init() {
			this.$watch("open", value => {
				value && this.$refs.closeButton.focus()
				this.toggleOverlay()
			})
			this.toggleOverlay()
		},
		toggleOverlay() {
			document.body.classList[this.open ? "add" : "remove"]("h-screen", "overflow-hidden")
		}
	}
}
*/




/*
const text = document.querySelector('.reveal');
gsap.from(text, {
	yPercent: 100,
	opacity: 0,
	duration: 1,
	scrollTrigger: {
		trigger: text,
		start: "bottom bottom",
		end: "bottom top",
		delay: -2,
		toggleActions: "play none none none",
		markers: true,
	},
});
*/






/*

//let texts = gsap.utils.toArray(".reveal");

gsap.set(".reveal", { autoAlpha: 1 });

texts.forEach(text => {
	gsap.to(text, {
		duration: 1.5,
		ease: "power1.in",
//		opacity: 1,
		stagger: 2,
		yPercent: -20,
		scrollTrigger: {
			trigger: text,
			start: "top 90%",
			end: "top bottom",
			toggleActions: "play none none none",
//			toggleClass: "red",
		},
	});
});

*/



/*
let texts = gsap.utils.toArray(".reveal");
gsap.set(".reveal", { autoAlpha: 1 });
texts.forEach(text => {
	gsap.to(text, {
		duration: 1.5,
		ease: "power1.inOut",
//		opacity: 1,
		stagger: 2,
//		yPercent: -20,
y: -100,
		scrollTrigger: {
			trigger: text,
			start: "top 90%",
			end: "top bottom",
			toggleActions: "play none none none",
//			toggleClass: "red",
		},
	});
});
*/


/*
let revealContainers = document.querySelectorAll(".reveal");

revealContainers.forEach((container) => {
  let tl = gsap.timeline({
    scrollTrigger: {
      trigger: container,
      toggleActions: "restart none none reset"
    }
  });

  tl.set(container, { autoAlpha: 1 });
  tl.from(container, 1.5, {
    yPercent: 100,
	opacity: 0,
    ease: Power4.easeOut
  });
  tl.from(image, 1.5, {
    xPercent: 100,
    scale: 1.3,
    delay: -1.5,
    ease: Power2.out
  });

});
*/





/**
 * Split-text headline animation
 * Uses Splitting.js (loaded via CDN) for text splitting
 * https://codepen.io/cameronknight/pen/wvMZoNN
 */
window.addEventListener("load", function() {
	// Check if Splitting is available (loaded via CDN in header.php)
	if (typeof window.Splitting === 'undefined') {
		console.warn('Splitting.js not loaded - headline animation skipped');
		// Make split-text visible even without animation
		document.querySelectorAll('.split-text').forEach(el => {
			el.style.visibility = 'visible';
		});
		return;
	}

	let splitTextElements = document.querySelectorAll(".split-text");
	if (splitTextElements.length === 0) return;

	let results = window.Splitting({
		target: splitTextElements,
		by: "lines"
	});

	results.forEach((splitResult) => {
		const wrappedLines = splitResult.lines
			.map(
				(wordsArr) => `
				<span class="line"><div class="words">
				${wordsArr
				.map(
				(word) => `${word.outerHTML}<span class="whitespace">
				</span>`
				)
				.join("")}
				</div></span>`
			)
			.join("");
		splitResult.el.innerHTML = wrappedLines;
	});

	splitTextElements.forEach((element) => {
		const lines = element.querySelectorAll(".line .words");

		let tl = gsap.timeline({
			scrollTrigger: {
				trigger: element,
				toggleActions: "restart none none reset",
			}
		});
		tl.set(element, {
			autoAlpha: 1
		});
		tl.from(lines, {
			duration: 1,
			yPercent: 100,
			ease: "power3.out",
			stagger: 0.25,
			delay: 0.2
		});
	});
});


















/*
gsap.registerPlugin(ScrollTrigger);

let revealContainers = document.querySelectorAll(".reveal");

revealContainers.forEach((container) => {
//  let image = container.querySelector("img");
  let tl = gsap.timeline({
    scrollTrigger: {

      trigger: container,
      toggleActions: "restart none none reset"
    }
  });

  tl.set(container, { autoAlpha: 1 });
  tl.from(container, 1.5, {
    yPercent: 100,
	opacity: 0,
    ease: Power4.easeOut
  });
  tl.from(image, 1.5, {
    xPercent: 100,
    scale: 1.3,
    delay: -1.5,
    ease: Power2.out
  });

});
*/


/*
gsap.registerPlugin(ScrollTrigger);

const text = document.querySelector('.reveal');

gsap.from(text, {
	yPercent: 100,
  opacity: 0,
  duration: 1,
  scrollTrigger: {
	markers: true,
	trigger: text,
//	start: "-100% bottom",
	start: "bottom bottom",
	end: "bottom top",
//	start: '-100 bottom',
	delay: -2,
//	end: 'bottom 0',
//      toggleActions: "restart none none reset"
      toggleActions: "play none none none"
  },
});
*/

// Var has function-level scope, meaning that a variable declared with var is accessible within the function it was declared in (or globally if it was declared outside of any function).
// const you can’t reassign it
// Let and const have block-level scope, meaning that a variable declared with let or const is only accessible within the block it was declared in (including any nested blocks).

//gsap.registerPlugin(ScrollTrigger);

/*
const text = document.querySelector('#primary-menu');

gsap.to(text, {
//	yPercent: 100,
	opacity: 0,
	duration: 1,

	scrollTrigger: {
		markers: true,
		trigger: text,
		//	start: "-100% bottom",
//		start: "top top",
//		end: "bottom bottom",
		//	start: '-100 bottom',
//		delay: -2,
		//	end: 'bottom 0',
		//      toggleActions: "restart none none reset"
		toggleActions: "play none reverse none"
	},

});
*/

/*
window.addEventListener("load", function() {
	let tl = gsap.timeline();

	tl.to("#primary-menu", {
			duration: 3,
//			xPercent: 100,
			opacity: 0,

			scrollTrigger: {
				trigger: "#primary-menu",
				toggleActions: "play complete reverse reset",
			}
		}

	);
});

*/
/*
gsap.registerPlugin(ScrollTrigger);
gsap.to("#primary-menu", {
//	y: 200,
	opacity: 0,
	scrollTrigger: {
		trigger: "#primary-menu",
		markers: true,
//		start: "top 75%",
//		end: "bottom 25%",
		// onEnter, onLeave, onEnterBack, and onLeaveBack
		// onEnter: when animation enters viewport
		// onLeave: when animation leaves viewport
		// onEnterBack: scroll back down
		// onLeaveBack: leave viewport completely
		// play pause resume reverse restart reset complete none
		toggleActions: "restart pause reverse reset",
		scrub: true,
	}

});
*/

/*
const showBackToTop = gsap.from(".backToTop", {
  yPercent: -100,
  paused: true,
  duration: 0.2
});

ScrollTrigger.create({
  start: "50vh bottom",
  end: "50vh bottom",
  markers: true,
  onEnter: () => showBackToTop.play(),
  onEnterBack: () => showBackToTop.reverse()
})
*/








// later, if we need to revert all the animations/ScrollTriggers...
// mm.revert();




/*



gsap.registerPlugin(ScrollTrigger);

const text = document.querySelector('.reveal');

gsap.from(text, {
	yPercent: 100,
	opacity: 0,
	duration: 1,
	scrollTrigger: {
		markers: true,
		trigger: text,
		//	start: "-100% bottom",
		start: "bottom bottom",
		end: "bottom top",
		//	start: '-100 bottom',
		delay: -2,
		//	end: 'bottom 0',
		//      toggleActions: "restart none none reset"
		toggleActions: "play none none none"
	},
});

*/


/*
gsap.registerPlugin(ScrollTrigger);
//fromTo(o,{alpha:0,y:"6rem"},{alpha:1,y:0,duration:1.5,stagger:.1,ease:"power3"},.5)

gsap.from( ".reveal", {
	scrollTrigger: {
		// element
		trigger: ".reveal",
		toggleActions: "restart none none reset",
		// element, viewport
//		start: "top center",
//		start: "center center",
//		end: "center center",
		markers: true,
		// onEnter, onLeave, onEnterBack, and onLeaveBack
//		toggleActions: "play none none reset", // play pause resume reverse restart reset complete none
	},

	yPercent: 100,
	opacity: 0,
	ease: Power4.easeOut,
//	stagger: 0.25,
	y: 0,
	opacity: 0,
//	duration: 2,
});

*/








/*
// Define the animation using GSAP and ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

const text = document.querySelector('.animated-text');

gsap.from(text, {
  y: 100,
  opacity: 0,
  duration: 1,
  scrollTrigger: {
	trigger: text,
	start: 'top 80%',
	end: 'center center',
	toggleActions: 'play none none reverse',
  },
});
*/

















/*
document.addEventListener('alpine:init', () => {
	Alpine.store('navOpen', false);
	Alpine.store('mainNav', false);
});

function navigation() {
	return {
		showTitle: true,
		toggleNav() {
			this.$store.navOpen = ! this.$store.navOpen;
			if (this.$store.navOpen === true) {
				this.$store.mainNav = true;
				document.body.classList.add('overflow-hidden');
				document.body.setAttribute('data-fire-lock-body', true);
			} else {
				this.$store.mainNav = false;
				this.$store.isSubMenuOpen = false;
				document.body.classList.remove('overflow-hidden');
				document.body.setAttribute('data-fire-lock-body', false);
			}
		},
	}
}
*/
/*
		toggleTitle(){
			const currentScroll = window.pageYOffset;
			if (currentScroll < 80) {
				this.showTitle = true;
				return;
			} else {
				this.showTitle = false;
			}
		}
*/

















/*



lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time)=>{
  lenis.raf(time * 1000)
});
*/





/*
https://www.youtube.com/watch?v=gRKuzQTXq74

.stack { height: 100vh; }

let sections = gsap.utils.toArray('.stack');
sections.forEach(section => {
	gsap.to(section, {
		yPercent: 100,
		ease: 'none',
		scrollTrigger: {
			trigger: section,
			start: 'bottom bottom',
			end: 'bottom top',
			scrub: true,
		}
	});
});
*/


// accordions
/*
function scrollToElement($el, time = 500) {
  const scrollTop = $el.getBoundingClientRect().top + window.pageYOffset;
  const scrollOptions = {
    top: scrollTop,
    behavior: 'smooth'
  };
  window.scrollTo(scrollOptions);
}
*/

function scrollToElement($el, time = 500) {
  const scrollTop = $el.getBoundingClientRect().top + window.pageYOffset - 200; // Subtract 100px
  const scrollOptions = {
    top: scrollTop,
    behavior: 'smooth'
  };
  window.scrollTo(scrollOptions);
}













/*
gsap.registerPlugin(ScrollTrigger);
const masthead = document.getElementById('masthead');
const siteLogo = document.getElementById('site-logo');
const mastheadHeight = masthead.offsetHeight;
//const sections = document.querySelectorAll('section');

let sections = gsap.utils.toArray("section");

sections.forEach(section => {
const scrollTrigger = {
  trigger: section,
//  start: `top+=${mastheadHeight} top`,
//  end: `bottom-=${mastheadHeight} top`,

 start: 'top top',
	end: 'bottom top',

  scrub: true,
  markers: true, // For debugging, remove this in production
  onToggle: self => {
	const isDarkBackground = section.classList.contains('bg-river');
	if (isDarkBackground) {
	  siteLogo.classList.remove('logo-dark');
	  siteLogo.classList.add('logo-light');
	} else {
	  siteLogo.classList.remove('logo-light');
	  siteLogo.classList.add('logo-dark');
	}
  }
};
gsap.to(siteLogo, scrollTrigger);
});


*/
/*

const masthead = document.getElementById('masthead');
const mastheadHeight = masthead.offsetHeight;
  const siteLogo = document.getElementById('site-logo');

  const sections = document.querySelectorAll('section');

  sections.forEach(section => {
    ScrollTrigger.create({
      trigger: section,
 start: 'top top',
	end: 'bottom bottom',
    markers: true, // For debugging, remove this in production
      scrub: true,
      onEnter: () => {
        const isRiverBackground = section.classList.contains('bg-river');
        if (isRiverBackground) {
          siteLogo.classList.remove('logo-light');
          siteLogo.classList.add('logo-dark');
        } else {
          siteLogo.classList.remove('logo-dark');
          siteLogo.classList.add('logo-light');
        }
      },
      onEnterBack: () => {
        const isRiverBackground = section.classList.contains('bg-river');
        if (isRiverBackground) {
          siteLogo.classList.remove('logo-light');
          siteLogo.classList.add('logo-dark');
        } else {
          siteLogo.classList.remove('logo-dark');
          siteLogo.classList.add('logo-light');
        }
      }
    });
  });
*/






/*
document.addEventListener('DOMContentLoaded', function () {
  // Ensure all accordion bodies are hidden and items are inactive on load
  document.querySelectorAll('.accordion').forEach(container => {
    container.querySelectorAll('.accordion-item').forEach(item => {
      item.classList.remove('active');
      const body = item.querySelector('.accordion-body');
      if (body) {
        body.style.display = 'none';
      }
    });
  });
  // Add click handlers to all accordion headers
  document.querySelectorAll('.accordion .accordion-header').forEach(header => {
    header.addEventListener('click', function () {
      const item = header.closest('.accordion-item');
      const container = header.closest('.accordion');

      const isActive = item.classList.contains('active');

      // Close all items in this container
      container.querySelectorAll('.accordion-item').forEach(otherItem => {
        otherItem.classList.remove('active');
        const body = otherItem.querySelector('.accordion-body');
        if (body) {
          body.style.display = 'none';
        }
      });

      if (!isActive) {
        // Activate clicked item
        item.classList.add('active');
        const body = item.querySelector('.accordion-body');
        if (body) {
          body.style.display = 'block';
        }

        // Scroll the item 100px from the top of the window
        const itemTop = item.getBoundingClientRect().top + window.scrollY;
        window.scrollTo({
          top: itemTop - 100,
          behavior: 'smooth'
        });
      }
    });
  });
});
*/



/*
function setupAccordionSpread() {
	const accordionSpreadHeaders = document.querySelectorAll('.accordion-header');

	function toggleAccordionSpread() {
		const header = this;
		// 1. Find the numerical suffix of the header's class
		const headerClasses = header.classList;
		let number = null;
		for (let i = 0; i < headerClasses.length; i++) {
			const className = headerClasses[i];
			if (className.startsWith('accordion-header-')) {
				number = className.split('-').pop(); // Get the number
				break;
			}
		}

		if (number === null) {
			console.error('Header does not have a valid accordion-header class');
			return;
		}

		// 2. Construct the body selector using the extracted number
		const bodySelector = `accordion-body-${number}`;
		const targetBody = document.querySelector(`.${bodySelector}`);

		if (!targetBody) {
			console.error(`Accordion body "${bodySelector}" not found for header "${headerClass}"`);
			return;
		}

		// Close all other active bodies and headers
		document.querySelectorAll('.accordion-body.active, .accordion-header.active').forEach(el => {
			el.classList.remove('active');
		});

		// Toggle the clicked body and header
		targetBody.classList.toggle('active');
		header.classList.toggle('active');
	}

	accordionSpreadHeaders.forEach(header => {
		header.addEventListener('click', toggleAccordionSpread);
	});
}

document.addEventListener('DOMContentLoaded', function () {
	setupAccordionSpread();
});

*/





/*
function setupAccordion() {
	const accordionHeaders = document.querySelectorAll('.accordion .accordion-header');

	function toggleAccordion() {
		const $parent = this.parentNode;
		const isActive = $parent.classList.contains('active');

		// Close all accordion items
		const activeItems = document.querySelectorAll('.accordion .accordion-item.active');
		activeItems.forEach(item => item.classList.remove('active'));

		if (!isActive) {
			// Open the clicked accordion item
			$parent.classList.add('active');
			scrollToElement($parent);
		}
	}

	accordionHeaders.forEach(header => {
		header.addEventListener('click', toggleAccordion);
	});
}
document.addEventListener('DOMContentLoaded', function () {
	setupAccordion();
});
*/
function setupAccordion() {
	const accordionClasses = [
		'.accordion--public-sector',
		'.accordion--industries',
		'.accordion--expertise',
		'.accordion--banking-solutions',
		'.accordion--simple'
	];

	const headerSelector = accordionClasses.map(cls => `${cls} .accordion-header`).join(', ');
	const accordionHeaders = document.querySelectorAll(headerSelector);
	const accordionSelector = accordionClasses.join(', '); // Used to find closest accordion

	function toggleAccordion() {
		const $parent = this.parentNode;
		const isActive = $parent.classList.contains('active');
		const accordion = $parent.closest(accordionSelector);

		if (!accordion) return;

		// Close all active items in this accordion
		accordion.querySelectorAll('.accordion-item.active').forEach(item =>
			item.classList.remove('active')
		);

		if (!isActive) {
			$parent.classList.add('active');
			scrollToElement($parent);
		}
	}

	accordionHeaders.forEach(header => {
		header.addEventListener('click', toggleAccordion);
	});
}

document.addEventListener('DOMContentLoaded', setupAccordion);




function setupAccordionSpread() {
	const accordionSelector = '.accordion--spread';
	const headerSelector = '.accordion-header';

	function toggleAccordionSpread(event) {
		const header = event.currentTarget;
		const accordionItem = header.closest('.accordion-item');
		const accordion = header.closest(accordionSelector);
		if (!accordion || !accordionItem) return;

		const isActive = accordionItem.classList.contains('active');

		if (isActive) {
			// Don't allow toggling off the only active item
			return;
		}

		// Deactivate all accordion-items in this accordion
		accordion.querySelectorAll('.accordion-item.active').forEach(item =>
			item.classList.remove('active')
		);

		// Activate the clicked item
		accordionItem.classList.add('active');
	}

	// Add event listeners
	document.querySelectorAll(`${accordionSelector} ${headerSelector}`).forEach(header => {
		header.addEventListener('click', toggleAccordionSpread);
	});

	// On page load, activate the first item in each accordion
	document.querySelectorAll(accordionSelector).forEach(accordion => {
		const firstItem = accordion.querySelector('.accordion-item');
		if (firstItem) {
			firstItem.classList.add('active');
		}
	});
}

document.addEventListener('DOMContentLoaded', setupAccordionSpread);



/*
function setupAccordionSpread() {
	const accordionSpreadHeaders = document.querySelectorAll('.accordion--spread .accordion-header');

	function toggleAccordionSpread() {
		const header = this;
		// 1. Find the numerical suffix of the header's class
		const headerClasses = header.classList;
		let number = null;
		for (let i = 0; i < headerClasses.length; i++) {
			const className = headerClasses[i];
			if (className.startsWith('accordion-header-')) {
				number = className.split('-').pop(); // Get the number
				break;
			}
		}

		if (number === null) {
			console.error('Header does not have a valid accordion-header class');
			return;
		}

		// 2. Construct the body selector using the extracted number
		const bodySelector = `accordion-body-${number}`;
		const targetBody = document.querySelector(`.${bodySelector}`);

		if (!targetBody) {
			console.error(`Accordion body "${bodySelector}" not found for header "${headerClass}"`);
			return;
		}

		// Close all other active bodies and headers
		document.querySelectorAll('.accordion-body.active, .accordion-header.active').forEach(el => {
			el.classList.remove('active');
		});

		// Toggle the clicked body and header
		targetBody.classList.toggle('active');
		header.classList.toggle('active');
	}

	accordionSpreadHeaders.forEach(header => {
		header.addEventListener('click', toggleAccordionSpread);
	});
}

document.addEventListener('DOMContentLoaded', function () {
	setupAccordionSpread();
});

*/