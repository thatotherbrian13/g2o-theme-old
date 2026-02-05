<?php
/**
 * ACF Field Registration for ChangeMakers Survey 2025 Template
 *
 * This file programmatically registers all Advanced Custom Fields
 * needed for the ChangeMakers 2025 survey/feedback page template.
 *
 * @package g2o
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( array(
	'key' => 'group_changemakers_survey_2025',
	'title' => 'ChangeMakers Survey 2025 - Page Fields',
	'fields' => array(

		// HERO SECTION TAB
		array(
			'key' => 'field_cms_hero_tab',
			'label' => 'Hero Section',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cms_hero_headline_type',
			'label' => 'Hero Headline Type',
			'name' => 'cms_hero_headline_type',
			'type' => 'radio',
			'choices' => array(
				'text' => 'Text Headline',
				'svg' => 'SVG Logo',
			),
			'default_value' => 'text',
			'layout' => 'horizontal',
			'instructions' => 'Choose between a text headline or an SVG logo for the hero section',
		),

		array(
			'key' => 'field_cms_hero_headline',
			'label' => 'Hero Headline Text',
			'name' => 'cms_hero_headline',
			'type' => 'text',
			'default_value' => '3 Stories of Transformation',
			'placeholder' => 'Enter main headline',
			'instructions' => 'Main headline displayed over the hero video',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cms_hero_headline_type',
						'operator' => '==',
						'value' => 'text',
					),
				),
			),
		),

		array(
			'key' => 'field_cms_hero_logo_svg',
			'label' => 'Hero Logo (SVG)',
			'name' => 'cms_hero_logo_svg',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'svg',
			'instructions' => 'Upload SVG logo to display instead of text headline',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cms_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cms_hero_logo_width',
			'label' => 'Hero Logo Width',
			'name' => 'cms_hero_logo_width',
			'type' => 'range',
			'default_value' => 800,
			'min' => 200,
			'max' => 1400,
			'step' => 50,
			'append' => 'px',
			'instructions' => 'Control the width of the SVG logo (200px - 1400px)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cms_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cms_hero_logo_shadow',
			'label' => 'Hero Logo Shadow Intensity',
			'name' => 'cms_hero_logo_shadow',
			'type' => 'range',
			'default_value' => 30,
			'min' => 0,
			'max' => 100,
			'step' => 10,
			'append' => '%',
			'instructions' => 'Control the drop shadow intensity on the logo (0 = no shadow, 100 = maximum)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cms_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cms_hero_video',
			'label' => 'Hero Background Video',
			'name' => 'cms_hero_video',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'mp4,webm',
			'instructions' => 'Upload MP4 or WebM video (recommended: under 5MB, 1920x1080)',
		),

		array(
			'key' => 'field_cms_video_overlay_opacity',
			'label' => 'Video Overlay Opacity',
			'name' => 'cms_video_overlay_opacity',
			'type' => 'range',
			'default_value' => 70,
			'min' => 0,
			'max' => 100,
			'step' => 5,
			'append' => '%',
			'instructions' => 'Controls darkness of overlay over video (0 = transparent, 100 = solid)',
		),

		// SURVEY FORM SECTION TAB
		array(
			'key' => 'field_cms_form_tab',
			'label' => 'Survey Form',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cms_form_embed_code',
			'label' => 'Form Embed Code',
			'name' => 'cms_form_embed_code',
			'type' => 'textarea',
			'rows' => 8,
			'placeholder' => '<iframe width="640px" height="480px" src="..." frameborder="0"></iframe>',
			'instructions' => 'Paste the complete iframe embed code from Microsoft Forms (or any other form provider)',
		),

		array(
			'key' => 'field_cms_form_background_color',
			'label' => 'Form Section Background Color',
			'name' => 'cms_form_background_color',
			'type' => 'color_picker',
			'default_value' => '#F7F7F7',
			'instructions' => 'Background color for the area behind the form',
		),

		array(
			'key' => 'field_cms_form_embed_padding',
			'label' => 'Form White Border (Padding)',
			'name' => 'cms_form_embed_padding',
			'type' => 'range',
			'default_value' => 20,
			'min' => 0,
			'max' => 60,
			'step' => 1,
			'append' => 'px',
			'instructions' => 'Controls the white border/padding around the iframe (0 = no border, 60 = maximum)',
		),

		array(
			'key' => 'field_cms_form_border_radius',
			'label' => 'Form Border Radius (Rounded Corners)',
			'name' => 'cms_form_border_radius',
			'type' => 'range',
			'default_value' => 8,
			'min' => 0,
			'max' => 30,
			'step' => 1,
			'append' => 'px',
			'instructions' => 'Controls the roundedness of corners (0 = square corners, 30 = very rounded)',
		),

		// VIDEO STRIP SECTION TAB
		array(
			'key' => 'field_cms_video_strip_tab',
			'label' => 'Video Strip',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cms_video_strip',
			'label' => 'Video Strip (Bottom Separator)',
			'name' => 'cms_video_strip',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'mp4,webm',
			'instructions' => 'Upload video for visual separator between form and footer (recommended: 1920x150px, under 3MB)',
		),

	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-changemakers-survey.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'featured_image',
	),
) );
