// This file controls how Tailwind processes your CSS. For details, see
// https://tailwindcss.com/docs/configuration

module.exports =
{
  //
  // WARNING: By default, CodeKit automatically populates the `content` array with all entries from [Project Settings > PurgeCSS]
  // in CodeKit's UI. If you add ANY entries to the `content` array here, CodeKit will not auto-populate the array; it becomes your
  // responsibility to include every type of file in your project that uses CSS rules. It is preferable to edit the PurgeCSS content
  // list in CodeKit's UI.
  //
  // WARNING: DO NOT delete `content` or comment it out. If you do, CodeKit will treat this as a Tailwind 2.x project instead of 3.x.
  //
	content: {
		relative: true,
		files: [
			'./*.php',

			'./theme/inc/*.php',
			'./template-parts/*.php',
			'./template-parts/components/*.php',
			'./template-parts/stacks/*.php',

			'./source/scripts/*.js',
			'./source/styles/*.css',
			'./tailwind-safelist.txt'
		],
	},

  //
  // All other TailwindCSS options are 100% under your control. Edit this config file as shown in the Tailwind Docs
  // to enable the settings or customizations you need.
  //
  theme: {

    aspectRatio: {
      auto: 'auto',
      square: '1 / 1',
      video: '16 / 9',
      1: '1',
      2: '2',
      3: '3',
      4: '4',
      5: '5',
      6: '6',
      7: '7',
      8: '8',
      9: '9',
      10: '10',
      11: '11',
      12: '12',
      13: '13',
      14: '14',
      15: '15',
      16: '16',

      20: '20',
      21: '21',
    },


    extend: {




		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			'black': '#000000',

			'river': '#234253',
			'river-light': '#3B6C80',
			'gunmetal': '#192C36',

			'white': '#ffffff',
			'limestone': '#FFF7EF',

			'sky': '#72D1F6',

			'city': '#ff4f55', // red

			'light': '#F7F7F7',
			'pathway-light': '#DFE1E1',
			'pathway': '#606969',

'black-pearl': '#0b181e',
'black-stone': '#10212a',


			'regent-gray': '#8698a1', // rgba(255, 255, 255, 0.45) over river

			'blue': 'blue', // dev
			'red': 'red', // dev
			'fuchsia': 'fuchsia', // dev
			'aqua': 'aqua', // dev
			'yellow': 'yellow', // dev

		},


/*
      flexBasis: {
        '1/16': '6.25%',
        '2/16': '12.5%',
        '3/16': '18.75%',
        '4/16': '25%',
        '5/16': '31.25%',
        '6/16': '37.5%',
        '7/16': '43.75%',
        '8/16': '50%',
        '9/16': '56.25%',
        '10/16': '62.5%',
        '11/16': '68.75%',
        '12/16': '75%',
        '13/16': '81.25%',
        '14/16': '87.5%',
        '15/16': '93.75%',
        '16/16': '100%',
      },
*/



		fontFamily: { // font-
			mono: ['Andale Mono', 'AndaleMono', 'monospace'],
			sans: ['Work Sans', 'sans-serif'],
			serif: ['Zodiak', 'serif'], // light, regular,
		},

/*
text-xs: 0.75rem; // 12px
	line-height: 1rem; // 16px

text-sm: 0.875rem; // 14px
	line-height: 1.25rem; // 20px

text-base: 1rem; // 16px
	line-height: 1.5rem; // 24px

text-lg: 1.125rem; // 18px
	line-height: 1.75rem; // 28px

text-xl: 1.25rem; // 20px
	line-height: 1.75rem; // 28px

text-2xl: 1.5rem; // 24px
	line-height: 2rem; // 32px
text-3xl: 1.875rem; // 30px
	line-height: 2.25rem; // 36px
text-4xl: 2.25rem; // 36px
	line-height: 2.5rem; // 40px
text-5xl: 3rem; // 48px
	line-height: 1;
text-6xl: 3.75rem; // 60px
	line-height: 1;
text-7xl: 4.5rem; // 72px
	line-height: 1;
text-8xl: 6rem; // 96px
	line-height: 1;
text-9xl: 8rem; // 128px
	line-height: 1;
*/


		fontSize: {
			'inherit': 'inherit',
			'1xl': '1.375rem', /* 22px */
			'9xl': '7.5rem', /* 120px */
		},

		fontWeight: {
			thin: 100,
			light: 300,
			normal: 400,
			medium: 500,
			semibold: 600,
			bold: 700,
			extrabold: 800,
			black: 900,
		},


//		lineHeight: {
//		},




		gridTemplateColumns: {
        '16': 'repeat(16, minmax(0, 1fr))',
        '18': 'repeat(18, minmax(0, 1fr))',
        },

      gridColumn: {
        'span-13': 'span 13 / span 13',
        'span-14': 'span 14 / span 14',
        'span-15': 'span 15 / span 15',
        'span-16': 'span 16 / span 16',
        'span-17': 'span 17 / span 17',
        'span-18': 'span 18 / span 17',
      },

      gridColumnStart: {
        '13': '13',
        '14': '14',
        '15': '15',
        '16': '16',
        '17': '17',
        '18': '18',
      },
      gridColumnEnd: {
        '13': '13',
        '14': '14',
        '15': '15',
        '16': '16',
        '17': '17',
        '18': '18',
        '19': '19',
      },

	gridRow: {
        'span-7': 'span 7 / span 7',
        'span-8': 'span 8 / span 8',
        'span-9': 'span 9 / span 9',
        'span-10': 'span 10 / span 10',
        'span-11': 'span 11 / span 11',
        'span-12': 'span 12 / span 12',
        'span-13': 'span 13 / span 13',
        'span-14': 'span 14 / span 14',
      },

      gridRowStart: {
        '8': '8',
        '9': '9',
        '10': '10',
        '11': '11',
        '12': '12',
        '13': '13',
        '14': '14',
      },

      gridTemplateRows: {
		'14': 'repeat(14, minmax(0, 1fr))',
      },

      height: {
        'screen-1/2': '50vh',
      },

    minHeight: {
      '1/2': '50vh',
      '3/5': '60vh',
      '3/4': '75vh',
      '4/5': '80vh',
    },

		spacing: {
			'5': '1.25rem', /* 20px */
			'10': '2.5rem', /* 40px */
			'15': '3.75rem', /* 60px */
			'18': '4.5rem', /* 72px */
			'20': '5rem', /* 80px */
			'25': '6.25rem', /* 100px */
			'30': '7.5rem', /* 120px */
			'35': '8.75rem', /* 140px */
			'40': '10rem', /* 160px */
			'45': '11.25rem', /* 180px */
			'50': '12.5rem', /* 200px */
			'55': '13.75rem', /* 220px */
			'60': '15rem', /* 240px */
			'65': '16.25rem', /* 260px */
			'75': '18.75rem', /* 300px */
			'100': '25rem', /* 400px */
			'150': '37.5rem', /* 600px */
		},

      textDecorationThickness: {
        3: '3px',
      },
/*
		tracking: {
//			'open': '0.25em',
			'013': '0.13em',
			'005': '0.05em',
			'004': '0.04em',
			'002': '0.02em',
			'0': '0em',



		},
*/


      width: {
        '1/16': '6.25%',
        '2/16': '12.5%',
        '3/16': '18.75%',
        '4/16': '25%',
        '5/16': '31.25%',
        '6/16': '37.5%',
        '7/16': '43.75%',
        '8/16': '50%',
        '9/16': '56.25%',
        '10/16': '62.5%',
        '11/16': '68.75%',
        '12/16': '75%',
        '13/16': '81.25%',
        '14/16': '87.5%',
        '15/16': '93.75%',
        '16/16': '100%',


        '30/32': '93.75%',

      },


			zIndex: {
				'60': '60',
				'70': '70',
				'80': '80',
				'90': '90',
				'100': '100',

				'998': '998',
				'999': '999', // mobile menu backdrop
				'1000': '1000', // mobile menu
				'1001': '1001', // mobile menu header
				'9999': '9999', // admin only
				'10000': '10000',
				'99999': '99999', // wp-admin bar
				'100000': '100000', // dev
			},


    }
  },

  variants: {},

  corePlugins: {
    aspectRatio: false,
  },

  //
  // If you want to run any Tailwind plugins (such as 'tailwindcss-typography'), simply install those into the Project via the
  // Packages area in CodeKit, then pass their names (and, optionally, any configuration values) here.
  // Full file paths are not necessary; CodeKit will find them.
  //
  // https://github.com/tailwindlabs/tailwindcss-aspect-ratio
  //
	plugins: [
		require('@tailwindcss/aspect-ratio'),
		require('@tailwindcss/typography'),
		require("@tailwindcss/forms")({
			strategy: 'base', // only generate global styles
		}),
	]
}