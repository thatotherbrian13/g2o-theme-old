# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

G2O WordPress theme with custom navigation system, 50+ reusable stack components, and Tailwind CSS. Located in `app/public/wp-content/themes/g2o/`.

## Repository Structure

**GitHub Repository**: https://github.com/thatotherbrian13/g2o-theme-old

**Important**: The git repository tracks only the theme folder (`app/public/wp-content/themes/g2o/`), not the entire WordPress installation. The root folder (`/Users/badams/Local Sites/g2o/`) is NOT version controlled.

```
/Users/badams/Local Sites/g2o/           # NOT in git (LocalWP site root)
└── app/public/wp-content/themes/g2o/    # Git repo root (tracked on GitHub)
```

### Git Workflow
```bash
cd app/public/wp-content/themes/g2o
git add .
git commit -m "Description of changes"
git push
```

## Build System

**npm scripts** handle all asset compilation via PostCSS and esbuild.

```bash
# Install dependencies (only needed once)
cd app/public/wp-content/themes/g2o && npm install

# Build commands
npm run build      # One-time build (CSS + JS)
npm run dev        # Build + watch for changes
npm run prod       # Production build (minified)

# Individual builds
npm run build:css  # Compile CSS only
npm run build:js   # Bundle JavaScript only
npm run build:nav  # Copy nav.js to build (standalone, not bundled)

# Watch individual file types
npm run watch:css  # Watch CSS changes
npm run watch:js   # Watch JS changes
npm run watch:nav  # Watch nav.js changes
```

**PostCSS Pipeline** (postcss.config.js): postcss-import → postcss-calc → tailwindcss/nesting → tailwindcss → autoprefixer

**JavaScript Bundling** (esbuild.config.js): ES modules bundled with esbuild into single IIFE (`build/js/scripts.js`). Targets ES2020. Sourcemaps generated in development, minified in production.

**Never edit `/build/` files directly** - they are auto-generated from `/source/`. Note: `build/` IS tracked in git (not in `.gitignore`), so compiled assets must be committed alongside source changes. Always run a build before committing.

**Local Development**: Uses Local by Flywheel (LocalWP). Site runs at local URL configured in Local app.

## Theme Architecture

```
app/public/wp-content/themes/g2o/
├── functions.php                    # Theme setup, feature flags, asset enqueue
├── source/styles/main.css           # CSS entry point (imports all partials)
├── source/scripts/scripts.js        # JS entry point (ES module imports)
├── build/                           # Compiled output (auto-generated)
├── theme/inc/                       # PHP includes (walkers, ACF, utilities)
├── template-parts/stacks/           # 50+ reusable page components
└── template-parts/navigation/       # Navigation templates (site-nav.php)
```

### Key Patterns

**Stack Components**: Reusable page sections in `template-parts/stacks/stack-*.php` with matching CSS in `source/styles/stacks/stack-*.css`. Called via `get_template_part()`.

**Stack Contexts**: Different page types render stacks via dedicated files in `template-parts/`:
- `stacks-page.php` — Default page stacks (ACF flexible content)
- `stacks-post.php` — Single post stacks
- `stacks-header.php` / `stacks-home-header.php` — Page/homepage header stacks
- `stacks-footer.php` — Footer stacks
- `stacks-project.php` / `stacks-job_listing.php` — CPT-specific stacks

**Walker Classes**: Custom menu walkers in `theme/inc/walker-*.php` and `theme/inc/class-g2o-nav-walker*.php`.

**ACF Fields**: Programmatic field registration in `theme/inc/acf-*.php` files.

**Button Rendering**: Use `g2o_render_button($button)` and `g2o_render_buttons($buttons)` from `theme/inc/acf-functions.php`. These produce FSE-compatible `wp-block-button` markup with style/color support.

**Asset Loading**: Uses `filemtime()` for cache busting in functions.php.

**Custom Page Templates**: `template-changemakers.php` (conference page), `page-brand-guide.php` (component catalog), `template-stack-guide.php` (stack showcase), `page-work.php` (portfolio).

**Stack Variants**: Some stacks support a `component_type` ACF field that switches between color/layout variants. The template uses `if/elseif/else` blocks — each variant renders the same layout structure with different color classes and an optional CSS class for custom backgrounds (e.g., dark gradients). The Stack Guide (`class-stack-guide-data.php`) lists supported variants per stack and renders each automatically.

| Stack | Variants | Extra Fields |
|-------|----------|-------------|
| `card_grid` | default (subtle), `light_on_dark`, `dark_on_light` | `grid_columns` |
| `checklist` | default (limestone), `light_on_dark`, `dark_on_light` | `checkmark_color` (sky/city/river/white) |
| `banner` | default, `simple`, `wedge`, `form`, `gradient`, `boxed`, `download`, `solution` | `border_color` |
| `three_columns` | default, `simple`, `spread`, `image`, `gradient`, `clean` | — |
| `spread` | default, `modern` | `image_alignment`, `border_color` |
| `accordion` | default, `simple`, `spread`, `spread_alt` | — |
| `quote` | default, `boxed` | `bg_color` |
| `marquee` | default, `boxed` | `image_type` |
| `cta` | default, `column`, `row`, `row_left` | — |

## Navigation System

### Feature Flags
```php
// functions.php
define('G2O_NEW_NAV', apply_filters('g2o_new_nav_enabled', true));
define('G2O_NAV_VERSION', apply_filters('g2o_nav_version', 'v1'));
```

### Version Switching
```php
// Method 1: Filter
add_filter('g2o_nav_version', function() { return 'v2'; });

// Method 2: wp-config.php
define('G2O_NAV_VERSION_OVERRIDE', 'v2');
```

### Navigation Files
| Component | Files |
|-----------|-------|
| Walkers | `theme/inc/class-g2o-nav-walker.php`, `class-g2o-nav-walker-v2.php` |
| Template | `template-parts/navigation/site-nav.php` |
| CSS | `build/css/nav.css` (manually maintained in `build/`, no source equivalent — edit directly) |
| JS | `build/js/nav.js` (copied directly from `source/scripts/nav.js`, not bundled) |

**Important**: `nav.js` is copied as-is to `build/` — it is NOT processed through esbuild. It must be written as vanilla browser-compatible JavaScript (no ES module `import`/`export` syntax, no Node APIs). All other scripts go through esbuild bundling via `source/scripts/scripts.js`.

### Navigation Behavior

**Desktop**: Hover-based dropdowns (160ms open delay, 120ms close). Clicking parent items is prevented (they're containers, not pages). Keyboard navigation via arrow keys.

**Mobile**: Full-screen hamburger menu with accordion submenus. Click toggles open/close. Only one section open at a time.

**Accessibility**: WCAG 2.2 AA compliant. ARIA roles (`menubar`, `menu`, `menuitem`), keyboard navigation, focus trapping in mobile menu.

### State Management
- Dual tracking with both `aria-expanded` and `data-expanded` attributes
- CSS dropdowns controlled by JavaScript setting `aria-hidden`
- 200ms hover block after clicks prevents conflicts

## JavaScript Libraries

Bundled via esbuild in scripts.js:
- **GSAP 3.12.1** - animations (with ScrollTrigger, MotionPathPlugin)
- **Alpine.js 3.12.2** - reactive components (with collapse, intersect plugins)
- **Swiper 11.1.3** - carousels
- **Lenis** - smooth scrolling
- **ScrollReveal 4.0.9** - scroll-triggered reveals

Loaded separately (NOT bundled):
- **Splitting.js** - text animations (loaded via CDN in header.php)
- **DrawSVGPlugin** / **ScrollSmoother** - GSAP premium plugins (`build/js/`, not in source)

## CSS Architecture

- **Tailwind CSS 3** with custom config in `tailwind.config.js`
- **Tailwind plugins**: `@tailwindcss/aspect-ratio`, `@tailwindcss/typography`, `@tailwindcss/forms`
- **BEM methodology** for custom components
- **CSS Custom Properties** for brand tokens (defined in `source/styles/main.css`)
- **PurgeCSS/Content** configured to scan `*.php`, `theme/inc/*.php`, `template-parts/**` (including `components/` and `stacks/`), `source/**`
- **Safelist**: `tailwind-safelist.txt` forces specific classes into the build (bypasses PurgeCSS)

### Brand Colors (tailwind.config.js)
```
river: #234253        (primary dark teal)
river-light: #3B6C80
gunmetal: #192C36
black-pearl: #0b181e
black-stone: #10212a
sky: #72D1F6          (accent light blue)
city: #ff4f55         (coral red highlight)
limestone: #FFF7EF    (warm white)
light: #F7F7F7
pathway: #606969
pathway-light: #DFE1E1
regent-gray: #8698a1
```

### Fonts (tailwind.config.js)
- `font-sans`: Work Sans
- `font-serif`: Zodiak
- `font-mono`: Andale Mono

### Brand Typography Rules

**Zodiak (serif):**
- Use Light (300) weight ONLY
- Override CSS in `source/styles/zodiak-override.css` enforces this

**Work Sans (sans-serif):**
| Weight | Tailwind Class | Usage |
|--------|----------------|-------|
| 700 (Bold) | `font-bold` | Headlines, emphasis, buttons |
| 400 (Regular) | `font-normal` | Small body copy, captions only |
| 300 (Light) | `font-light` | Main body copy, decks |

**NEVER USE these Work Sans weights:**
- `font-semibold` (600) - use `font-bold` instead
- `font-medium` (500) - use `font-normal` instead
- `font-extrabold` (800) - use `font-bold` instead

**Italics:** OK in sparing doses

### Layout Utilities (main.css)
- `.constrain` — max-width container with horizontal padding (`max-w-screen-2xl mx-auto px-5 lg:px-8`)
- `.row` — 16-column CSS grid (`grid grid-cols-16`)
- `.body` — prose wrapper with list styling
- Grid custom properties: `--grid-max-width: 1600px`, `--grid-columns: 16`, `--grid-gutter: 32px`

### Color Validation

The primary brand color is `river: #234253`. Watch for the common typo `#234353` (wrong) in SVG data URIs.

## Menu Locations

```php
'menu-primary'   // Main navigation
'menu-footer'    // Footer navigation
'menu-legal'     // Legal links
'menu-solutions' // Solutions menu
'menu-mobile'    // Mobile menu
'primary_menu'   // New nav system
'utility_menu'   // Utility links
```

## Image Sizes

Custom sizes registered: `aspect-2-1`, `aspect-3-2`, `aspect-4-3`, `aspect-5-2`, `aspect-5-6`, `aspect-6-5`, `square`

## Adding New Components

1. Create CSS: `source/styles/stacks/stack-newname.css`
2. Create template: `template-parts/stacks/stack-newname.php`
3. Add import to `source/styles/main.css`
4. Register ACF fields in `theme/inc/acf-newname-fields.php` if needed
5. Add mock data entry to `theme/inc/class-stack-guide-data.php` for the Brand Guide
6. Add the stack key to the appropriate category in `page-brand-guide.php`
7. Run `npm run build` or let `npm run dev` auto-compile

## Stack Anchor Links

Stack IDs like `#stack-form-9` are auto-generated for deep linking to specific sections on a page.

### How IDs Are Generated

In `template-parts/stacks-page.php`, each stack gets an ID based on its layout type and position:

```php
$layout = get_row_layout('page_stacks');     // e.g., "stack_form"
$args_id = str_replace("_", "-", $layout);   // e.g., "stack-form"
$args = array(
    'id' => $args_id . '-' . get_row_index(), // e.g., "stack-form-9"
);
```

**The number is the stack's 1-indexed position on the page** (from ACF's `get_row_index()`).

### Finding/Predicting Stack Numbers

1. Open the page in WordPress editor
2. Count the stack's position in the "Page Stacks" flexible content field
3. The ID will be `stack-{type}-{position}`

### Custom IDs (Form Stacks)

Form stacks (`stack_form.php`) support a `unique_id` ACF field that overrides auto-generated IDs:

```php
$unique_id = get_sub_field('unique_id');
$id = ($unique_id) ? $unique_id : $stack_id;
```

**To use a custom ID:**
1. Edit the form stack in the page editor
2. Fill in the "Unique ID" field (e.g., `contact-form`)
3. Link to it as `#contact-form` instead of `#stack-form-9`

Custom IDs are stable and won't change when stacks are reordered.

### Stack ID Pattern

All stacks follow the pattern `#stack-{type}-{n}` where `{type}` is the layout name with underscores replaced by hyphens (e.g., `stack_gravity_form` → `#stack-gravity-form-{n}`).

## z-Index Layers

Key z-index values in `tailwind.config.js`:
- `999`: Mobile menu backdrop
- `1000`: Mobile menu
- `1001`: Mobile menu header
- `99999`: WP admin bar

## Known Issues & Solutions

**CSS Specificity**: Theme styles may override nav styles. Use `!important` and high-specificity selectors like `html body .nav__item`.

**Dropdown State**: Desktop dropdowns use JavaScript-only control (no CSS `:hover`). Mobile uses dual attribute tracking.

## Debugging

```javascript
// Console access for navigation debugging (development only)
window.g2oNavigation.cleanup();  // Reset state
window.g2oNavigation.destroy();  // Remove all listeners
```

Admin users see a template name indicator fixed at the bottom-left corner of pages.

## Brand Guide (Internal)

An interactive style guide and component catalog at `/brand-guide/`.

**URL:** `https://<your-local-site>/brand-guide/` (check Local by Flywheel for the site domain)

**File:** `page-brand-guide.php` (Page Template)

**Features:**
- Typography specimens with Tailwind classes
- Color palette reference
- Helper class documentation
- 50+ stack component previews with live examples

**Tabs:**
- **Styles** - Typography, colors, helper classes, specifications
- **Components** - All stack components organized by category

**Access:** Password protected. To set or change the password:
1. Go to WP Admin → Pages
2. Create/edit a page using the "Brand Guide" template
3. In "Summary" panel → Visibility → Password protected
4. Enter your chosen password
5. Update/Publish the page

## Testing

`phpunit.xml` is configured but no test suite currently exists (`tests/` directory is absent).

## Additional Documentation

Detailed docs in `/docs/` (at project root, outside git repo):
- `NAVIGATION-IMPLEMENTATION.md` — Full nav system guide with testing checklist
- `CHANGEMAKERS_SETUP_INSTRUCTIONS.md` — ChangeMakers conference page setup

## PHP Coding Standards

A `phpcs.xml.dist` is configured with WordPress and WPThemeReview rulesets. PHP should follow WordPress coding standards (spaces not tabs for indentation in PHP, `snake_case` functions, Yoda conditions, etc.).

## Browser Support

Chrome 90+, Firefox 90+, Safari 14+, Edge 90+. ES6+ JavaScript, modern CSS features (backdrop-filter, custom properties, nesting).
