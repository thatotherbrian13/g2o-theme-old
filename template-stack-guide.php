<?php
/**
 * Template Name: Stack Guide
 *
 * Displays all stack components with documentation and dummy content.
 * Useful for designers and developers to preview available stacks.
 */

get_header('stack-guide');

// Load the stack guide data class
require_once get_template_directory() . '/theme/inc/class-stack-guide-data.php';

// Get all stack configurations
$stacks = G2O_Stack_Guide::get_all_stacks();

// Group stacks by category for the TOC
$categories = [
    'Heroes/Banners' => ['banner', 'banner_data_ai', 'billboard', 'profile_banner', 'lead', 'story'],
    'Content Blocks' => ['content', 'columns', 'three_columns', 'spread', 'slabs', 'blockquote', 'quote', 'testimonial', 'steps', 'scroller'],
    'CTAs/Forms' => ['cta', 'form', 'gravity_form', 'hubspot_form', 'subscribe', 'tout'],
    'Carousels/Lists' => ['carousel', 'slideshow', 'marquee', 'accordion', 'pillars', 'process', 'graphs', 'video'],
    'People/Teams' => ['author', 'authors', 'team'],
    'Industry/Solutions' => ['capabilities', 'expertise', 'industries', 'solutions', 'banking_solutions', 'public_sector_solutions'],
    'Posts/Projects' => ['featured_post', 'related', 'projects', 'jobs'],
    'Media' => ['image', 'study'],
];
?>

<main id="main" class="stack-guide">
    <!-- Sticky Table of Contents -->
    <nav class="stack-guide__toc" aria-label="Stack Guide Navigation">
        <div class="stack-guide__toc-inner">
            <h2 class="stack-guide__toc-title">Stack Components</h2>
            <div class="stack-guide__toc-count"><?php echo count($stacks); ?> stacks</div>

            <?php foreach ($categories as $category => $stack_names) : ?>
                <div class="stack-guide__toc-category">
                    <h3 class="stack-guide__toc-category-title"><?php echo esc_html($category); ?></h3>
                    <ul class="stack-guide__toc-list">
                        <?php foreach ($stack_names as $name) :
                            if (!isset($stacks[$name])) continue;
                            $config = $stacks[$name];
                        ?>
                            <li>
                                <a href="#stack-<?php echo esc_attr($name); ?>" class="stack-guide__toc-link">
                                    <?php echo esc_html($config['label']); ?>
                                    <?php if (!empty($config['variants'])) : ?>
                                        <span class="stack-guide__toc-badge"><?php echo count($config['variants']); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="stack-guide__content">
        <!-- Page Header -->
        <header class="stack-guide__page-header">
            <div class="stack-guide__page-header-inner">
                <h1 class="stack-guide__page-title">Stack Component Guide</h1>
                <p class="stack-guide__page-desc">
                    This guide displays all <?php echo count($stacks); ?> stack components available in the G2O theme.
                    Each stack is shown with its default/primary variant and documentation including available fields,
                    variants, and customization options.
                </p>
                <div class="stack-guide__page-meta">
                    <span>Theme: G2O</span>
                    <span>Generated: <?php echo date('F j, Y'); ?></span>
                </div>
            </div>
        </header>

        <?php
        // Counter for stack numbering
        $stack_number = 0;

        foreach ($stacks as $name => $config) :
            $stack_number++;
            $has_variants = !empty($config['variants']);
            $has_note = !empty($config['note']);
        ?>
            <section id="stack-<?php echo esc_attr($name); ?>" class="stack-guide__section">
                <!-- Documentation Panel -->
                <header class="stack-guide__header">
                    <div class="stack-guide__header-inner">
                        <div class="stack-guide__header-top">
                            <span class="stack-guide__number"><?php echo $stack_number; ?></span>
                            <h2 class="stack-guide__title"><?php echo esc_html($config['label']); ?></h2>
                            <code class="stack-guide__filename"><?php echo esc_html($config['file']); ?></code>
                        </div>

                        <p class="stack-guide__desc"><?php echo esc_html($config['description']); ?></p>

                        <?php if ($has_note) : ?>
                            <div class="stack-guide__note">
                                <strong>Note:</strong> <?php echo esc_html($config['note']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="stack-guide__docs">
                            <!-- ACF Fields -->
                            <div class="stack-guide__doc-section">
                                <h4>ACF Fields</h4>
                                <ul class="stack-guide__fields">
                                    <?php foreach ($config['fields'] as $field => $type) : ?>
                                        <li>
                                            <code><?php echo esc_html($field); ?></code>
                                            <span class="stack-guide__field-type"><?php echo esc_html($type); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- Variants -->
                            <?php if ($has_variants) : ?>
                                <div class="stack-guide__doc-section">
                                    <h4>Layout Variants</h4>
                                    <ul class="stack-guide__variants">
                                        <?php foreach ($config['variants'] as $variant) : ?>
                                            <li>
                                                <code><?php echo esc_html($variant); ?></code>
                                                <?php if ($variant === $config['variants'][0] || empty($config['data']['component_type']) && $variant === $config['variants'][0]) : ?>
                                                    <span class="stack-guide__variant-badge">shown</span>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <!-- Customization Options -->
                            <?php if (!empty($config['options'])) : ?>
                                <div class="stack-guide__doc-section">
                                    <h4>Customization</h4>
                                    <ul class="stack-guide__options">
                                        <?php foreach ($config['options'] as $option) : ?>
                                            <li><?php echo esc_html($option); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <!-- Rendered Stack Component -->
                <div class="stack-guide__preview">
                    <div class="stack-guide__preview-label">
                        <span>Preview</span>
                        <?php if ($has_variants) : ?>
                            <span class="stack-guide__preview-variant">
                                Variant: <?php echo esc_html(!empty($config['data']['component_type']) ? $config['data']['component_type'] : (!empty($config['data']['form_layout']) ? $config['data']['form_layout'] : 'default')); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php
                    // Merge stack guide data with template args
                    // The stack templates will check $args first before falling back to get_sub_field()
                    $template_args = array_merge(
                        [
                            'id' => 'preview-' . $name,
                            'class' => 'stack-guide__stack',
                            'stack_guide_mode' => true,
                        ],
                        $config['data']
                    );

                    // Render the stack template with data passed via $args
                    get_template_part('template-parts/stacks/stack_' . $name, null, $template_args);
                    ?>
                </div>
            </section>
        <?php endforeach; ?>

        <!-- Footer -->
        <footer class="stack-guide__footer">
            <div class="stack-guide__footer-inner">
                <p>End of Stack Guide. Total: <?php echo count($stacks); ?> components.</p>
                <p><a href="#main" class="stack-guide__back-top">Back to Top</a></p>
            </div>
        </footer>
    </div>
</main>

<?php get_footer(); ?>
