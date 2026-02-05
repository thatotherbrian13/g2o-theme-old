# G2O WordPress Theme

Custom WordPress theme with 50+ reusable stack components, Tailwind CSS, and a custom navigation system.

## Quick Start

```bash
# Install dependencies
npm install

# Development (build + watch)
npm run dev

# Production build
npm run prod
```

## Build Commands

| Command | Description |
|---------|-------------|
| `npm run build` | One-time build (CSS + JS) |
| `npm run dev` | Build + watch for changes |
| `npm run prod` | Production build (minified) |
| `npm run build:css` | Compile CSS only |
| `npm run build:js` | Bundle JavaScript only |

## Architecture

```
├── source/
│   ├── styles/main.css      # CSS entry point
│   └── scripts/scripts.js   # JS entry point
├── build/                   # Compiled output (auto-generated)
├── theme/inc/               # PHP includes (walkers, ACF, utilities)
├── template-parts/
│   ├── stacks/              # 50+ reusable page components
│   └── navigation/          # Navigation templates
└── functions.php            # Theme setup
```

## Stack System

Build pages with reusable components in `template-parts/stacks/`. Each stack has:
- PHP template: `stack-*.php`
- CSS: `source/styles/stacks/stack-*.css`
- ACF fields for content management

## Tech Stack

- **CSS**: Tailwind CSS 3, PostCSS, custom properties
- **JS**: ES modules bundled with esbuild
- **Libraries**: GSAP, Alpine.js, Swiper, Lenis
- **WordPress**: ACF Pro for custom fields

## Development

This theme uses Local by Flywheel for local development. The git repository tracks only the theme files, not WordPress core.
