<?php
/**
 * Stack Guide Data Provider
 *
 * Provides mock data for stack components to render in the Stack Guide.
 * Data is passed directly to templates via $args parameter.
 */

if (!defined('ABSPATH')) {
    exit;
}

class G2O_Stack_Guide {

    /**
     * Create a mock image array
     * For Stack Guide, we use placeholder images from placehold.co
     */
    public static function mock_image($width = 600, $height = 400, $text = 'Image') {
        $text_encoded = urlencode($text);
        return [
            'id'       => 0,
            'ID'       => 0,
            'url'      => "https://placehold.co/{$width}x{$height}/234253/72D1F6?text={$text_encoded}",
            'alt'      => str_replace('+', ' ', $text),
            'title'    => str_replace('+', ' ', $text),
            'width'    => $width,
            'height'   => $height,
            'filename' => 'placeholder.jpg',
            'sizes'    => [
                'thumbnail'       => "https://placehold.co/150x150/234253/72D1F6?text={$text_encoded}",
                'medium'          => "https://placehold.co/300x200/234253/72D1F6?text={$text_encoded}",
                'large'           => "https://placehold.co/{$width}x{$height}/234253/72D1F6?text={$text_encoded}",
                'full'            => "https://placehold.co/{$width}x{$height}/234253/72D1F6?text={$text_encoded}",
            ],
        ];
    }

    /**
     * Create a mock link array
     */
    public static function mock_link($title = 'Learn More', $url = '#') {
        return [
            'url'    => $url,
            'title'  => $title,
            'target' => '',
        ];
    }

    /**
     * Get all stack configurations with mock data
     */
    public static function get_all_stacks() {
        return [
            // ============================================
            // HEROES/BANNERS
            // ============================================
            'banner' => [
                'label'       => 'Banner',
                'description' => 'Hero banner with multiple layout variants for page headers.',
                'file'        => 'stack_banner.php',
                'fields'      => [
                    'component_type'         => 'select',
                    'kicker'                 => 'text',
                    'headline'               => 'text',
                    'deck'                   => 'textarea',
                    'body'                   => 'wysiwyg',
                    'link'                   => 'link',
                    'bg_image'               => 'image',
                    'border_color'           => 'select',
                ],
                'variants'    => ['simple', 'wedge', 'form', 'gradient', 'boxed', 'download', 'solution'],
                'options'     => [
                    'Border color: red or default (limestone)',
                    'Background image support',
                ],
                'data'        => [
                    'component_type' => '',
                    'kicker'         => 'Welcome to G2O',
                    'headline'       => 'Transforming Government Through Technology',
                    'deck'           => 'We help federal agencies modernize their operations with innovative digital solutions.',
                    'body'           => '<p>Our team of experts works alongside your agency to deliver mission-critical technology solutions.</p>',
                    'link'           => self::mock_link('Get Started'),
                    'border_color'   => '',
                ],
            ],

            'banner_data_ai' => [
                'label'       => 'Banner Data AI',
                'description' => 'Specialized banner for data and AI content pages.',
                'file'        => 'stack_banner_data_ai.php',
                'fields'      => [
                    'kicker'   => 'text',
                    'headline' => 'text',
                    'deck'     => 'textarea',
                    'body'     => 'wysiwyg',
                    'stats'    => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Stats repeater for key metrics'],
                'data'        => [
                    'kicker'   => 'Data & AI',
                    'headline' => 'Unlock the Power of Your Data',
                    'deck'     => 'Harness artificial intelligence and machine learning to drive better outcomes.',
                    'body'     => '<p>Our data scientists and engineers help you extract actionable insights from your data assets.</p>',
                    'stats'    => [
                        ['stat' => '500+', 'label' => 'Projects Delivered'],
                        ['stat' => '98%', 'label' => 'Client Satisfaction'],
                        ['stat' => '50M+', 'label' => 'Records Processed'],
                    ],
                ],
            ],

            'billboard' => [
                'label'       => 'Billboard',
                'description' => 'Large hero section with prominent messaging and image.',
                'file'        => 'stack_billboard.php',
                'fields'      => [
                    'kicker'   => 'text',
                    'headline' => 'text',
                    'deck'     => 'textarea',
                    'link'     => 'link',
                    'image'    => 'image',
                ],
                'variants'    => [],
                'options'     => ['Full-width layout', 'Image aspect ratio configurable'],
                'data'        => [
                    'kicker'   => 'Featured',
                    'headline' => 'Building the Future of Digital Government',
                    'deck'     => 'Our innovative approach combines technology expertise with deep domain knowledge.',
                    'link'     => self::mock_link('Explore Our Work'),
                    'image'    => self::mock_image(1200, 600, 'Billboard'),
                ],
            ],

            'profile_banner' => [
                'label'       => 'Profile Banner',
                'description' => 'Banner optimized for profile or about pages.',
                'file'        => 'stack_profile_banner.php',
                'fields'      => [
                    'headline' => 'text',
                    'deck'     => 'textarea',
                    'image'    => 'image',
                ],
                'variants'    => [],
                'options'     => ['Portrait image support'],
                'data'        => [
                    'headline' => 'Meet Our Leadership Team',
                    'deck'     => 'Experienced professionals dedicated to mission success.',
                    'image'    => self::mock_image(500, 600, 'Profile'),
                ],
            ],

            'lead' => [
                'label'       => 'Lead',
                'description' => 'Lead-in section to introduce page content.',
                'file'        => 'stack_lead.php',
                'fields'      => [
                    'lead'      => 'wysiwyg',
                    'full_name' => 'text',
                    'role'      => 'text',
                    'bg_color'  => 'color_picker',
                    'pad_top'   => 'select',
                    'pad_bot'   => 'select',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'lead'      => '<p>We put users at the center of everything we build. By understanding the needs of end users, we create solutions that are intuitive, efficient, and impactful.</p>',
                    'full_name' => 'Jane Smith',
                    'role'      => 'Chief Strategy Officer',
                    'bg_color'  => '',
                    'pad_top'   => 'pt-15',
                    'pad_bot'   => 'pb-15',
                ],
            ],

            'story' => [
                'label'       => 'Story',
                'description' => 'Narrative section with image and storytelling content.',
                'file'        => 'stack_story.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'deck'    => 'textarea',
                    'body'    => 'wysiwyg',
                    'link'    => 'link',
                    'image'   => 'image',
                ],
                'variants'    => [],
                'options'     => ['Image positioning options'],
                'data'        => [
                    'kicker'  => 'Our Story',
                    'heading' => 'Two Decades of Public Service',
                    'deck'    => 'Since 2004, we have been helping government agencies succeed.',
                    'body'    => '<p>What started as a small team with a big vision has grown into one of the leading federal technology consultancies.</p>',
                    'link'    => self::mock_link('Read Our History'),
                    'image'   => self::mock_image(600, 500, 'Story'),
                ],
            ],

            // ============================================
            // CONTENT BLOCKS
            // ============================================
            'content' => [
                'label'       => 'Content',
                'description' => 'Basic content block with icon, heading, body, and link.',
                'file'        => 'stack_content.php',
                'fields'      => [
                    'icon'     => 'image',
                    'kicker'   => 'text',
                    'heading'  => 'text',
                    'deck'     => 'textarea',
                    'body'     => 'wysiwyg',
                    'link'     => 'link',
                    'bg_color' => 'color_picker',
                    'pad_top'  => 'select',
                    'pad_bot'  => 'select',
                ],
                'variants'    => [],
                'options'     => ['Background color customizable', 'Top/bottom padding options'],
                'data'        => [
                    'kicker'   => 'Content Block',
                    'heading'  => 'Delivering Excellence in Every Engagement',
                    'deck'     => 'Our commitment to quality drives everything we do.',
                    'body'     => '<p>From initial discovery through final delivery, we maintain the highest standards of professionalism and technical excellence.</p><ul><li>Agile methodology</li><li>Continuous improvement</li><li>Transparent communication</li></ul>',
                    'link'     => self::mock_link('Our Process'),
                    'bg_color' => '',
                    'pad_top'  => 'pt-15',
                    'pad_bot'  => 'pb-15',
                ],
            ],

            'columns' => [
                'label'       => 'Columns',
                'description' => 'Multi-column layout for grouped content.',
                'file'        => 'stack_columns.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'deck'    => 'textarea',
                    'columns' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Flexible column count'],
                'data'        => [
                    'kicker'  => 'Our Values',
                    'heading' => 'What Drives Us Forward',
                    'deck'    => 'These principles guide our work every day.',
                    'columns' => [
                        ['heading' => 'Innovation', 'body' => 'We embrace new technologies and approaches to solve complex problems.', 'link' => self::mock_link()],
                        ['heading' => 'Integrity', 'body' => 'We operate with honesty and transparency in everything we do.', 'link' => self::mock_link()],
                    ],
                ],
            ],

            'three_columns' => [
                'label'       => 'Three Columns',
                'description' => 'Three-column layout with multiple style variants.',
                'file'        => 'stack_three_columns.php',
                'fields'      => [
                    'component_type' => 'select',
                    'kicker'         => 'text',
                    'heading'        => 'text',
                    'deck'           => 'textarea',
                    'subhead'        => 'text',
                    'body'           => 'wysiwyg',
                    'columns'        => 'repeater',
                    'image'          => 'image',
                ],
                'variants'    => ['simple', 'spread', 'image', 'gradient', 'clean'],
                'options'     => ['Column items with heading, body, link', 'Optional image for image variant'],
                'data'        => [
                    'component_type' => '',
                    'kicker'         => 'Services',
                    'heading'        => 'How We Can Help',
                    'deck'           => 'Comprehensive solutions for your toughest challenges.',
                    'columns'        => [
                        ['heading' => 'Digital Transformation', 'body' => 'Modernize legacy systems and processes for the modern era.', 'link' => self::mock_link()],
                        ['heading' => 'Data Analytics', 'body' => 'Turn data into actionable insights that drive decisions.', 'link' => self::mock_link()],
                        ['heading' => 'Cloud Solutions', 'body' => 'Secure, scalable infrastructure for your applications.', 'link' => self::mock_link()],
                    ],
                ],
            ],

            'spread' => [
                'label'       => 'Spread',
                'description' => 'Two-column spread with image and content.',
                'file'        => 'stack_spread.php',
                'fields'      => [
                    'component_type'   => 'select',
                    'kicker'           => 'text',
                    'heading'          => 'text',
                    'deck'             => 'textarea',
                    'body'             => 'wysiwyg',
                    'body_columns'     => 'select',
                    'body_column_2'    => 'wysiwyg',
                    'link'             => 'link',
                    'image'            => 'image',
                    'image_alignment'  => 'select',
                    'border_color'     => 'select',
                ],
                'variants'    => ['default', 'modern'],
                'options'     => ['Image alignment: left or right', 'Border color: red or default', 'Two-column body option'],
                'data'        => [
                    'component_type'  => '',
                    'kicker'          => 'Case Study',
                    'heading'         => 'Modernizing Federal Benefits Systems',
                    'deck'            => 'How we helped streamline citizen services.',
                    'body'            => '<p>Working closely with our federal partner, we transformed a decades-old system into a modern, user-friendly platform that serves millions of citizens.</p>',
                    'link'            => self::mock_link('Read the Case Study'),
                    'image'           => self::mock_image(600, 600, 'Spread+Image'),
                    'image_alignment' => 'left',
                    'border_color'    => '',
                ],
            ],

            'slabs' => [
                'label'       => 'Slabs',
                'description' => 'Horizontal slab sections for feature highlights.',
                'file'        => 'stack_slabs.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'body'    => 'textarea',
                    'slabs'   => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Repeatable slab items'],
                'data'        => [
                    'kicker'  => 'Capabilities',
                    'body'    => 'Our proven expertise across critical technology domains.',
                    'slabs'   => [
                        ['body' => 'AWS, Azure, and GCP certified experts ready to build your cloud infrastructure.', 'link' => self::mock_link('Cloud Engineering', '#cloud')],
                        ['body' => 'Security-first development practices integrated into every stage.', 'link' => self::mock_link('DevSecOps', '#devsecops')],
                        ['body' => 'Scalable data pipelines and analytics platforms for insights at scale.', 'link' => self::mock_link('Data Engineering', '#data')],
                    ],
                ],
            ],

            'blockquote' => [
                'label'       => 'Blockquote',
                'description' => 'Featured quote or testimonial highlight.',
                'file'        => 'stack_blockquote.php',
                'fields'      => [
                    'blockquote'  => 'textarea',
                    'bg_color'    => 'color_picker',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'blockquote'  => 'G2O has been an invaluable partner in our digital transformation journey. Their expertise and dedication have helped us achieve results we never thought possible.',
                    'bg_color'    => '',
                ],
            ],

            'quote' => [
                'label'       => 'Quote',
                'description' => 'Styled quote section with optional logo.',
                'file'        => 'stack_quote.php',
                'fields'      => [
                    'component_type' => 'select',
                    'body'           => 'textarea',
                    'attribution'    => 'text',
                    'affiliation'    => 'text',
                    'logo'           => 'image',
                    'bg_color'       => 'color_picker',
                ],
                'variants'    => ['default', 'boxed'],
                'options'     => ['Background color for boxed variant', 'Optional company logo'],
                'data'        => [
                    'component_type' => '',
                    'body'           => 'The team at G2O consistently delivers high-quality solutions that exceed our expectations. Their collaborative approach makes them a true extension of our team.',
                    'attribution'    => 'Michael Johnson',
                    'affiliation'    => 'Program Manager, Department of Defense',
                    'logo'           => self::mock_image(120, 60, 'Logo'),
                ],
            ],

            'testimonial' => [
                'label'       => 'Testimonial',
                'description' => 'Client testimonial with photo and details.',
                'file'        => 'stack_testimonial.php',
                'fields'      => [
                    'body'        => 'textarea',
                    'attribution' => 'text',
                    'role'        => 'text',
                    'image'       => 'image',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'body'        => 'Working with G2O has transformed how we approach technology challenges. Their collaborative approach and deep expertise made all the difference in our modernization effort.',
                    'attribution' => 'Sarah Williams',
                    'role'        => 'Deputy Director',
                    'image'       => self::mock_image(200, 200, 'Photo'),
                ],
            ],

            'steps' => [
                'label'       => 'Steps',
                'description' => 'Process steps or numbered content sections.',
                'file'        => 'stack_steps.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'steps'   => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Auto-numbered steps'],
                'data'        => [
                    'kicker'  => 'Our Process',
                    'heading' => 'How We Work',
                    'steps'   => [
                        ['heading' => 'Discovery', 'body' => 'We start by understanding your unique challenges and goals.'],
                        ['heading' => 'Design', 'body' => 'Our team creates solutions tailored to your specific needs.'],
                        ['heading' => 'Develop', 'body' => 'We build with quality and security as top priorities.'],
                        ['heading' => 'Deploy', 'body' => 'Smooth transitions with comprehensive training and support.'],
                    ],
                ],
            ],

            'scroller' => [
                'label'       => 'Scroller',
                'description' => 'Horizontal scrolling content section.',
                'file'        => 'stack_scroller.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'items'   => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Smooth scroll behavior'],
                'data'        => [
                    'kicker'  => 'Featured Work',
                    'heading' => 'Recent Projects',
                    'items'   => [
                        ['heading' => 'Project Alpha', 'body' => 'A comprehensive modernization effort for a major agency.', 'image' => self::mock_image(400, 300, 'Project+1')],
                        ['heading' => 'Project Beta', 'body' => 'Innovative data platform development and deployment.', 'image' => self::mock_image(400, 300, 'Project+2')],
                        ['heading' => 'Project Gamma', 'body' => 'Cloud migration success story with zero downtime.', 'image' => self::mock_image(400, 300, 'Project+3')],
                    ],
                ],
            ],

            // ============================================
            // CTAs/FORMS
            // ============================================
            'cta' => [
                'label'       => 'Call to Action',
                'description' => 'Flexible CTA sections with image and text layouts.',
                'file'        => 'stack_cta.php',
                'fields'      => [
                    'component_type' => 'select',
                    'kicker'         => 'text',
                    'heading'        => 'text',
                    'deck'           => 'textarea',
                    'body'           => 'wysiwyg',
                    'link'           => 'link',
                    'image'          => 'image',
                ],
                'variants'    => ['column', 'row', 'row_left'],
                'options'     => ['Image aspect ratio: 5:6', 'Text colors: gunmetal (heading), pathway (body)'],
                'data'        => [
                    'component_type' => '',
                    'kicker'         => 'Ready to Start?',
                    'heading'        => 'Let\'s Build Something Great Together',
                    'deck'           => 'Our team is ready to help you achieve your mission objectives.',
                    'body'           => '<p>Contact us today to discuss your next project and discover how we can help.</p>',
                    'link'           => self::mock_link('Contact Us'),
                    'image'          => self::mock_image(500, 600, 'CTA+Image'),
                ],
            ],

            'form' => [
                'label'       => 'Form',
                'description' => 'Contact or lead capture form sections.',
                'file'        => 'stack_form.php',
                'fields'      => [
                    'form_layout'            => 'select',
                    'kicker'                 => 'text',
                    'heading'                => 'text',
                    'deck'                   => 'textarea',
                    'body'                   => 'wysiwyg',
                    'disclaimer'             => 'textarea',
                    'include_vcard'          => 'true_false',
                    'bg_color'               => 'color_picker',
                    'form_source'            => 'select',
                    'gravity_form_shortcode' => 'text',
                    'hubspot_form_shortcode' => 'text',
                    'person'                 => 'group',
                    'form_image'             => 'image',
                ],
                'variants'    => ['spread', 'team', 'download', 'shadow'],
                'options'     => ['Gravity Forms or HubSpot integration', 'Optional vCard display', 'Custom colors support'],
                'data'        => [
                    'form_layout'            => 'spread',
                    'kicker'                 => 'Contact Us',
                    'heading'                => 'Get in Touch',
                    'deck'                   => 'We would love to hear from you about your project.',
                    'body'                   => '<p>Fill out the form and our team will respond within 24 hours.</p>',
                    'disclaimer'             => 'By submitting this form, you agree to our privacy policy.',
                    'include_vcard'          => 'no',
                    'bg_color'               => '',
                    'form_source'            => '',
                    'gravity_form_shortcode' => '',
                    'hubspot_form_shortcode' => '',
                    'person'                 => [
                        'portrait'  => ['url' => 'https://placehold.co/400x500/234253/72D1F6?text=Team+Member', 'alt' => 'Team member portrait'],
                        'full_name' => 'Jane Smith',
                        'role'      => 'Client Relations Director',
                    ],
                    'form_image'             => ['url' => 'https://placehold.co/600x400/72D1F6/234253?text=Download+Guide', 'alt' => 'Download guide'],
                ],
                'note'        => 'Form embed requires Gravity Forms or HubSpot shortcode.',
            ],

            'gravity_form' => [
                'label'       => 'Gravity Form',
                'description' => 'Standalone Gravity Form embed.',
                'file'        => 'stack_gravity_form.php',
                'fields'      => [
                    'heading'                => 'text',
                    'gravity_form_shortcode' => 'text',
                ],
                'variants'    => [],
                'options'     => ['Direct shortcode embed'],
                'data'        => [
                    'heading'                => 'Submit Your Information',
                    'gravity_form_shortcode' => '',
                ],
                'note'        => 'Requires Gravity Forms plugin with configured form.',
            ],

            'hubspot_form' => [
                'label'       => 'HubSpot Form',
                'description' => 'Standalone HubSpot Form embed.',
                'file'        => 'stack_hubspot_form.php',
                'fields'      => [
                    'heading'                => 'text',
                    'hubspot_form_shortcode' => 'text',
                ],
                'variants'    => [],
                'options'     => ['Direct HubSpot embed code'],
                'data'        => [
                    'heading'                => 'Subscribe to Our Newsletter',
                    'hubspot_form_shortcode' => '',
                ],
                'note'        => 'Requires HubSpot integration.',
            ],

            'subscribe' => [
                'label'       => 'Subscribe',
                'description' => 'Newsletter subscription section.',
                'file'        => 'stack_subscribe.php',
                'fields'      => [
                    'heading'                => 'text',
                    'body'                   => 'textarea',
                    'image'                  => 'image',
                    'form_source'            => 'select',
                    'gravity_form_shortcode' => 'text',
                    'hubspot_form_shortcode' => 'text',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'heading'                => 'Subscribe to Our Newsletter',
                    'body'                   => '<p>Get the latest insights delivered to your inbox. Stay updated with our news and updates.</p>',
                    'image'                  => ['url' => 'https://placehold.co/800x800/234253/72D1F6?text=Subscribe', 'alt' => 'Newsletter subscription'],
                    'form_source'            => '',
                    'gravity_form_shortcode' => '',
                    'hubspot_form_shortcode' => '',
                ],
            ],

            'tout' => [
                'label'       => 'Tout',
                'description' => 'Promotional highlight or callout section.',
                'file'        => 'stack_tout.php',
                'fields'      => [
                    'kicker'   => 'text',
                    'heading'  => 'text',
                    'body'     => 'wysiwyg',
                    'link'     => 'link',
                    'bg_color' => 'color_picker',
                ],
                'variants'    => [],
                'options'     => ['Background color customizable'],
                'data'        => [
                    'kicker'   => 'Now Hiring',
                    'heading'  => 'Join Our Team',
                    'body'     => '<p>We are always looking for talented individuals who are passionate about making a difference in government technology.</p>',
                    'link'     => self::mock_link('View Open Positions'),
                    'bg_color' => '#FFF7EF',
                ],
            ],

            // ============================================
            // CAROUSELS/LISTS
            // ============================================
            'carousel' => [
                'label'       => 'Carousel',
                'description' => 'Swiper-based carousel for slides.',
                'file'        => 'stack_carousel.php',
                'fields'      => [
                    'kicker'       => 'text',
                    'heading'      => 'text',
                    'subhead'      => 'text',
                    'icon'         => 'image',
                    'link'         => 'link',
                    'link_classes' => 'text',
                    'slides'       => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Auto-scrolling slides', 'Navigation arrows'],
                'data'        => [
                    'kicker'       => 'Our Impact',
                    'heading'      => 'Success Stories Across Government',
                    'link'         => self::mock_link('View All'),
                    'link_classes' => '',
                    'slides'       => [
                        ['heading' => 'DOD Modernization', 'body' => 'Transforming defense operations with modern technology solutions.', 'image' => self::mock_image(600, 400, 'Slide+1')],
                        ['heading' => 'VA Digital Services', 'body' => 'Improving veteran experiences nationwide through digital innovation.', 'image' => self::mock_image(600, 400, 'Slide+2')],
                        ['heading' => 'DHS Cybersecurity', 'body' => 'Protecting critical infrastructure with advanced security solutions.', 'image' => self::mock_image(600, 400, 'Slide+3')],
                    ],
                ],
            ],

            'slideshow' => [
                'label'       => 'Slideshow',
                'description' => 'Full-width text slideshow with FAQ schema.',
                'file'        => 'stack_slideshow.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'slides'  => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Full-width display', 'Auto-advance option', 'FAQ schema markup'],
                'data'        => [
                    'kicker'  => 'Frequently Asked',
                    'slides'  => [
                        ['heading' => 'What services does G2O provide?', 'body' => 'We offer digital transformation, data analytics, cloud solutions, and cybersecurity services to federal agencies.'],
                        ['heading' => 'How long has G2O been in business?', 'body' => 'G2O has been serving government clients for over 20 years, delivering mission-critical technology solutions.'],
                        ['heading' => 'What makes G2O different?', 'body' => 'Our deep domain expertise combined with cutting-edge technology capabilities sets us apart in the federal market.'],
                    ],
                ],
            ],

            'marquee' => [
                'label'       => 'Marquee',
                'description' => 'Scrolling marquee for logos or text.',
                'file'        => 'stack_marquee.php',
                'fields'      => [
                    'component_type' => 'select',
                    'heading'        => 'text',
                    'image_type'     => 'select',
                    'images'         => 'repeater',
                    'logos'          => 'repeater',
                ],
                'variants'    => ['default', 'boxed'],
                'options'     => ['Continuous scroll animation', 'Logo repeater'],
                'data'        => [
                    'component_type' => '',
                    'heading'        => 'Trusted by Leading Agencies',
                    'image_type'     => 'unlinked',
                    'images'         => [
                        self::mock_image(150, 60, 'Agency+1'),
                        self::mock_image(150, 60, 'Agency+2'),
                        self::mock_image(150, 60, 'Agency+3'),
                        self::mock_image(150, 60, 'Agency+4'),
                        self::mock_image(150, 60, 'Agency+5'),
                        self::mock_image(150, 60, 'Agency+6'),
                    ],
                    'logos'          => [],
                ],
            ],

            'accordion' => [
                'label'       => 'Accordion',
                'description' => 'Expandable accordion sections.',
                'file'        => 'stack_accordion.php',
                'fields'      => [
                    'component_type' => 'select',
                    'heading'        => 'text',
                    'deck'           => 'textarea',
                    'body'           => 'wysiwyg',
                    'accordion'      => 'repeater',
                    'link'           => 'link',
                ],
                'variants'    => ['simple', 'spread', 'spread_alt'],
                'options'     => ['Accordion items with heading, subhead, deck, body, link, logo', 'Different visual styles per variant'],
                'data'        => [
                    'component_type' => '',
                    'heading'        => 'Frequently Asked Questions',
                    'deck'           => 'Find answers to common questions about our services.',
                    'accordion'      => [
                        [
                            'heading' => 'What industries do you serve?',
                            'subhead' => 'Government Focus',
                            'deck'    => 'We specialize in federal government contracts.',
                            'body'    => 'Our primary clients include DOD, VA, DHS, and civilian agencies across the federal government.',
                            'link'    => self::mock_link('Learn More'),
                        ],
                        [
                            'heading' => 'What is your approach to security?',
                            'subhead' => 'Security First',
                            'deck'    => 'Security is built into everything we do.',
                            'body'    => 'We follow NIST frameworks and hold multiple security certifications including FedRAMP.',
                            'link'    => self::mock_link('Our Security'),
                        ],
                        [
                            'heading' => 'How do you ensure quality?',
                            'subhead' => 'Quality Assurance',
                            'deck'    => 'Rigorous testing and review processes.',
                            'body'    => 'Every deliverable goes through multiple quality gates before deployment.',
                            'link'    => self::mock_link('Quality Process'),
                        ],
                    ],
                    'link'           => self::mock_link('Contact Us'),
                ],
            ],

            'pillars' => [
                'label'       => 'Pillars',
                'description' => 'Vertical pillar cards for key offerings.',
                'file'        => 'stack_pillars.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'pillars' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Card-based layout'],
                'data'        => [
                    'kicker'  => 'Core Services',
                    'heading' => 'Our Pillars of Excellence',
                    'pillars' => [
                        ['heading' => 'Strategy', 'body' => 'Aligning technology with mission goals for maximum impact.', 'image' => self::mock_image(80, 80, 'Icon')],
                        ['heading' => 'Development', 'body' => 'Building secure, scalable solutions that stand the test of time.', 'image' => self::mock_image(80, 80, 'Icon')],
                        ['heading' => 'Operations', 'body' => 'Ensuring reliable, continuous service and support.', 'image' => self::mock_image(80, 80, 'Icon')],
                    ],
                ],
            ],

            'process' => [
                'label'       => 'Process',
                'description' => 'Process flow visualization with swiper carousel.',
                'file'        => 'stack_process.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'subhead' => 'text',
                    'icon'    => 'image',
                    'slides'  => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Visual flow indicators', 'Swiper carousel'],
                'data'        => [
                    'kicker'  => 'Methodology',
                    'heading' => 'Our Proven Process',
                    'subhead' => 'Step by step approach',
                    'slides'  => [
                        ['image' => self::mock_image(800, 500, 'Step+1+Assess')],
                        ['image' => self::mock_image(800, 500, 'Step+2+Plan')],
                        ['image' => self::mock_image(800, 500, 'Step+3+Execute')],
                        ['image' => self::mock_image(800, 500, 'Step+4+Optimize')],
                    ],
                ],
            ],

            'graphs' => [
                'label'       => 'Graphs',
                'description' => 'Data visualization carousel with statistics.',
                'file'        => 'stack_graphs.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'subhead' => 'text',
                    'graphs'  => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Fade effect carousel', 'Chart/graph display'],
                'data'        => [
                    'kicker'  => 'By the Numbers',
                    'heading' => 'Our Impact in Data',
                    'subhead' => 'Key Performance Indicators',
                    'heading_alignment' => 'center',
                    'graphs'  => [
                        ['heading' => '500+ Projects Completed', 'body' => 'Successfully delivered mission-critical solutions across all federal agencies.', 'image' => self::mock_image(400, 300, 'Graph+1')],
                        ['heading' => '98% Client Satisfaction', 'body' => 'Our commitment to excellence is reflected in consistently high satisfaction scores.', 'image' => self::mock_image(400, 300, 'Graph+2')],
                        ['heading' => '20+ Years Experience', 'body' => 'Two decades of trusted partnership with government organizations.', 'image' => self::mock_image(400, 300, 'Graph+3')],
                    ],
                ],
            ],

            'video' => [
                'label'       => 'Video',
                'description' => 'Video embed section.',
                'file'        => 'stack_video.php',
                'fields'      => [
                    'video' => 'oembed',
                ],
                'variants'    => [],
                'options'     => ['YouTube/Vimeo embed support'],
                'data'        => [
                    'video' => '<div style="background: #234253; color: #72D1F6; padding: 60px; text-align: center; aspect-ratio: 16/9; display: flex; align-items: center; justify-content: center; font-family: sans-serif; font-size: 24px; border-radius: 8px;">Video Placeholder</div>',
                ],
            ],

            // ============================================
            // PEOPLE/TEAMS
            // ============================================
            'author' => [
                'label'       => 'Author',
                'description' => 'Single author bio section.',
                'file'        => 'stack_author.php',
                'fields'      => [
                    'full_name'        => 'text',
                    'role'             => 'text',
                    'body'             => 'wysiwyg',
                    'portrait'         => 'image',
                    'linkedin_profile' => 'url',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'full_name'        => 'Dr. Emily Chen',
                    'role'             => 'Chief Technology Officer',
                    'body'             => '<p>Dr. Chen brings over 20 years of experience in federal technology leadership. She has led digital transformation initiatives across multiple agencies.</p>',
                    'portrait'         => self::mock_image(400, 500, 'Portrait'),
                    'linkedin_profile' => '#',
                ],
            ],

            'authors' => [
                'label'       => 'Authors',
                'description' => 'Multiple author/contributor display.',
                'file'        => 'stack_authors.php',
                'fields'      => [
                    'heading' => 'text',
                    'authors' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Grid layout for multiple authors'],
                'data'        => [
                    'heading' => 'Meet the Authors',
                    'authors' => [
                        ['full_name' => 'John Smith', 'role' => 'Senior Consultant', 'portrait' => self::mock_image(300, 375, 'Author+1')],
                        ['full_name' => 'Maria Garcia', 'role' => 'Principal Engineer', 'portrait' => self::mock_image(300, 375, 'Author+2')],
                    ],
                ],
            ],

            'team' => [
                'label'       => 'Team',
                'description' => 'Team member grid display.',
                'file'        => 'stack_team.php',
                'fields'      => [
                    'component_type' => 'select',
                    'kicker'         => 'text',
                    'heading'        => 'text',
                    'employees'      => 'repeater',
                ],
                'variants'    => ['collocated', 'staggered'],
                'options'     => ['Employee items with name, role, body, portrait, LinkedIn'],
                'data'        => [
                    'component_type' => 'collocated',
                    'kicker'         => 'Our Team',
                    'heading'        => 'Leadership',
                    'employees'      => [
                        ['full_name' => 'Robert Johnson', 'role' => 'CEO', 'body' => 'Visionary leader with 25 years in federal consulting.', 'portrait' => self::mock_image(300, 375, 'Team+1'), 'linkedin_profile' => '#', 'profile_link' => '#'],
                        ['full_name' => 'Sarah Williams', 'role' => 'COO', 'body' => 'Operations expert driving organizational excellence.', 'portrait' => self::mock_image(300, 375, 'Team+2'), 'linkedin_profile' => '#', 'profile_link' => '#'],
                        ['full_name' => 'Michael Brown', 'role' => 'CTO', 'body' => 'Technology innovator and thought leader.', 'portrait' => self::mock_image(300, 375, 'Team+3'), 'linkedin_profile' => '#', 'profile_link' => '#'],
                    ],
                ],
            ],

            // ============================================
            // INDUSTRY/SOLUTIONS
            // ============================================
            'capabilities' => [
                'label'       => 'Capabilities',
                'description' => 'Capability showcase section.',
                'file'        => 'stack_capabilities.php',
                'fields'      => [
                    'kicker'       => 'text',
                    'heading'      => 'text',
                    'capabilities' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Capability cards with icons'],
                'data'        => [
                    'kicker'       => 'What We Do',
                    'heading'      => 'Our Capabilities',
                    'capabilities' => [
                        ['heading' => 'Agile Development', 'body' => 'Iterative, user-centered software development methodologies.', 'icon' => self::mock_image(60, 60, 'Icon')],
                        ['heading' => 'Cloud Migration', 'body' => 'Secure transitions to cloud environments with zero downtime.', 'icon' => self::mock_image(60, 60, 'Icon')],
                        ['heading' => 'Data Engineering', 'body' => 'Building robust data pipelines and platforms at scale.', 'icon' => self::mock_image(60, 60, 'Icon')],
                    ],
                ],
            ],

            'expertise' => [
                'label'       => 'Expertise',
                'description' => 'Domain expertise showcase.',
                'file'        => 'stack_expertise.php',
                'fields'      => [
                    'kicker'    => 'text',
                    'heading'   => 'text',
                    'deck'      => 'textarea',
                    'expertise' => 'repeater',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'kicker'    => 'Domain Knowledge',
                    'heading'   => 'Our Areas of Expertise',
                    'deck'      => 'Deep experience across critical government domains.',
                    'expertise' => [
                        ['heading' => 'Healthcare IT', 'body' => 'HIPAA-compliant health information systems.'],
                        ['heading' => 'Financial Systems', 'body' => 'Treasury and financial management solutions.'],
                        ['heading' => 'Logistics', 'body' => 'Supply chain and asset management systems.'],
                    ],
                ],
            ],

            'industries' => [
                'label'       => 'Industries',
                'description' => 'Industry sector showcase.',
                'file'        => 'stack_industries.php',
                'fields'      => [
                    'kicker'     => 'text',
                    'heading'    => 'text',
                    'industries' => 'repeater',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'kicker'     => 'Sectors',
                    'heading'    => 'Industries We Serve',
                    'industries' => [
                        ['heading' => 'Defense', 'body' => 'Supporting warfighters with modern technology solutions.', 'image' => self::mock_image(400, 300, 'Defense')],
                        ['heading' => 'Civilian', 'body' => 'Improving citizen services across federal agencies.', 'image' => self::mock_image(400, 300, 'Civilian')],
                        ['heading' => 'Intelligence', 'body' => 'Secure solutions for the IC community.', 'image' => self::mock_image(400, 300, 'Intel')],
                    ],
                ],
            ],

            'solutions' => [
                'label'       => 'Solutions',
                'description' => 'Solution offerings display.',
                'file'        => 'stack_solutions.php',
                'fields'      => [
                    'kicker'    => 'text',
                    'heading'   => 'text',
                    'solutions' => 'repeater',
                ],
                'variants'    => [],
                'options'     => [],
                'data'        => [
                    'kicker'    => 'Solutions',
                    'heading'   => 'Technology Solutions',
                    'solutions' => [
                        ['heading' => 'Custom Development', 'body' => 'Tailored applications for unique requirements.', 'link' => self::mock_link()],
                        ['heading' => 'Platform Integration', 'body' => 'Connecting systems for seamless operations.', 'link' => self::mock_link()],
                        ['heading' => 'Managed Services', 'body' => 'Ongoing support and optimization services.', 'link' => self::mock_link()],
                    ],
                ],
            ],

            'banking_solutions' => [
                'label'       => 'Banking Solutions',
                'description' => 'Financial/banking focused solutions.',
                'file'        => 'stack_banking_solutions.php',
                'fields'      => [
                    'kicker'    => 'text',
                    'heading'   => 'text',
                    'solutions' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Banking-specific styling'],
                'data'        => [
                    'kicker'    => 'Financial Services',
                    'heading'   => 'Banking & Financial Solutions',
                    'solutions' => [
                        ['heading' => 'Core Banking', 'body' => 'Modern core banking platforms for the digital age.'],
                        ['heading' => 'Payment Systems', 'body' => 'Secure payment processing and settlement.'],
                        ['heading' => 'Compliance', 'body' => 'Regulatory compliance solutions and reporting.'],
                    ],
                ],
            ],

            'public_sector_solutions' => [
                'label'       => 'Public Sector Solutions',
                'description' => 'Government-specific solutions showcase.',
                'file'        => 'stack_public_sector_solutions.php',
                'fields'      => [
                    'kicker'    => 'text',
                    'heading'   => 'text',
                    'solutions' => 'repeater',
                ],
                'variants'    => [],
                'options'     => ['Government-focused content'],
                'data'        => [
                    'kicker'    => 'Public Sector',
                    'heading'   => 'Government Solutions',
                    'solutions' => [
                        ['heading' => 'Citizen Services', 'body' => 'Digital portals for citizen engagement and self-service.'],
                        ['heading' => 'Benefits Administration', 'body' => 'Modern benefits processing and management systems.'],
                        ['heading' => 'Case Management', 'body' => 'Streamlined case workflow and tracking solutions.'],
                    ],
                ],
            ],

            // ============================================
            // POSTS/PROJECTS
            // ============================================
            'featured_post' => [
                'label'       => 'Featured Post',
                'description' => 'Highlighted blog post or article.',
                'file'        => 'stack_featured_post.php',
                'fields'      => [
                    'kicker'          => 'text',
                    'image'           => 'image',
                    'image_alignment' => 'select',
                    'border_color'    => 'select',
                ],
                'variants'    => [],
                'options'     => ['Pulls latest post automatically', 'Image alignment: left or right'],
                'data'        => [
                    'kicker'          => 'Featured Insight',
                    'image'           => self::mock_image(600, 600, 'Featured'),
                    'image_alignment' => 'left',
                    'border_color'    => '',
                ],
                'note'        => 'Uses WP_Query for latest post. Preview shows with actual site content.',
            ],

            'related' => [
                'label'       => 'Related Posts',
                'description' => 'Related content recommendations.',
                'file'        => 'stack_related.php',
                'fields'      => [
                    'heading' => 'text',
                    'posts'   => 'relationship',
                ],
                'variants'    => [],
                'options'     => ['Manual post selection or auto-related'],
                'data'        => [
                    'heading' => 'Related Articles',
                ],
                'note'        => 'Uses WP_Query for related posts. Preview shows with actual site content.',
            ],

            'projects' => [
                'label'       => 'Projects',
                'description' => 'Project portfolio display.',
                'file'        => 'stack_projects.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                ],
                'variants'    => [],
                'options'     => ['Pulls from projects CPT'],
                'data'        => [
                    'kicker'  => 'Our Work',
                    'heading' => 'Featured Projects',
                ],
                'note'        => 'Uses WP_Query for projects. Preview shows with actual site content.',
            ],

            'jobs' => [
                'label'       => 'Jobs',
                'description' => 'Job listings display.',
                'file'        => 'stack_jobs.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                ],
                'variants'    => [],
                'options'     => ['Job board integration'],
                'data'        => [
                    'kicker'  => 'Careers',
                    'heading' => 'Open Positions',
                ],
                'note'        => 'May use external job feed.',
            ],

            // ============================================
            // MEDIA
            // ============================================
            'image' => [
                'label'       => 'Image',
                'description' => 'Standalone image display section.',
                'file'        => 'stack_image.php',
                'fields'      => [
                    'image'   => 'image',
                    'caption' => 'text',
                ],
                'variants'    => [],
                'options'     => ['Full-width or contained', 'Optional caption'],
                'data'        => [
                    'image'   => self::mock_image(1200, 600, 'Full+Width+Image'),
                    'caption' => 'Our team collaborating on a client project.',
                ],
            ],

            'study' => [
                'label'       => 'Study/Case Study',
                'description' => 'Case study detail section.',
                'file'        => 'stack_study.php',
                'fields'      => [
                    'kicker'  => 'text',
                    'heading' => 'text',
                    'deck'    => 'textarea',
                    'body'    => 'wysiwyg',
                    'stats'   => 'repeater',
                    'image'   => 'image',
                ],
                'variants'    => [],
                'options'     => ['Stats/metrics display'],
                'data'        => [
                    'kicker'  => 'Case Study',
                    'heading' => 'Transforming Veteran Services',
                    'deck'    => 'How we helped the VA improve benefits processing.',
                    'body'    => '<p>Working with the VA, we implemented a modern benefits processing system that reduced wait times by 60% and improved accuracy significantly.</p>',
                    'stats'   => [
                        ['stat' => '60%', 'label' => 'Faster Processing'],
                        ['stat' => '95%', 'label' => 'Accuracy Rate'],
                        ['stat' => '2M+', 'label' => 'Veterans Served'],
                    ],
                    'image'   => self::mock_image(800, 500, 'Case+Study'),
                ],
            ],
        ];
    }
}
