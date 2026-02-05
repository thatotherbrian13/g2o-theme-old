<?php
/**
 * ACF Field Registration for ChangeMakers 2025 Template
 *
 * This file programmatically registers all Advanced Custom Fields
 * needed for the ChangeMakers 2025 conference page template.
 *
 * @package g2o
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

/**
 * Customize collapsed speaker row label to show "First Last"
 *
 * @param string $title The current row title
 * @param array $field The repeater field array
 * @param array $layout The layout being used
 * @param int $i The current row index
 * @return string The modified row title
 */
add_filter( 'acf/fields/repeater/layout_title', function( $title, $field, $layout, $i ) {
	// Only apply to speakers repeater
	if ( $field['name'] !== 'cm_speakers' ) {
		return $title;
	}

	// Get first and last name values
	$first_name = get_sub_field( 'first_name' );
	$last_name = get_sub_field( 'last_name' );

	// If both exist, show "First Last"
	if ( $first_name && $last_name ) {
		return $first_name . ' ' . $last_name;
	}

	// If only first name exists
	if ( $first_name ) {
		return $first_name;
	}

	// If only last name exists
	if ( $last_name ) {
		return $last_name;
	}

	// Fallback to default
	return $title;
}, 10, 4 );

acf_add_local_field_group( array(
	'key' => 'group_changemakers_2025',
	'title' => 'ChangeMakers 2025 - Page Fields',
	'fields' => array(

		// HERO SECTION TAB
		array(
			'key' => 'field_cm_hero_tab',
			'label' => 'Hero Section',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_hero_headline_type',
			'label' => 'Hero Headline Type',
			'name' => 'cm_hero_headline_type',
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
			'key' => 'field_cm_hero_headline',
			'label' => 'Hero Headline Text',
			'name' => 'cm_hero_headline',
			'type' => 'text',
			'default_value' => '3 Stories of Transformation',
			'placeholder' => 'Enter main headline',
			'instructions' => 'Main headline displayed over the hero video (the "3" will be styled automatically)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_hero_headline_type',
						'operator' => '==',
						'value' => 'text',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_hero_logo_svg',
			'label' => 'Hero Logo (SVG)',
			'name' => 'cm_hero_logo_svg',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'svg',
			'instructions' => 'Upload SVG logo to display instead of text headline',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_hero_logo_width',
			'label' => 'Hero Logo Width',
			'name' => 'cm_hero_logo_width',
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
						'field' => 'field_cm_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_hero_logo_shadow',
			'label' => 'Hero Logo Shadow Intensity',
			'name' => 'cm_hero_logo_shadow',
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
						'field' => 'field_cm_hero_headline_type',
						'operator' => '==',
						'value' => 'svg',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_hero_video',
			'label' => 'Hero Background Video',
			'name' => 'cm_hero_video',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'mp4,webm',
			'instructions' => 'Upload MP4 or WebM video (recommended: under 5MB, 1920x1080)',
		),

		array(
			'key' => 'field_cm_video_overlay_opacity',
			'label' => 'Video Overlay Opacity',
			'name' => 'cm_video_overlay_opacity',
			'type' => 'range',
			'default_value' => 70,
			'min' => 0,
			'max' => 100,
			'step' => 5,
			'append' => '%',
			'instructions' => 'Controls darkness of overlay over video (0 = transparent, 100 = solid)',
		),

		// THANK YOU SECTION TAB
		array(
			'key' => 'field_cm_thankyou_tab',
			'label' => 'Thank You Section',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_thankyou_headline',
			'label' => 'Thank You Headline',
			'name' => 'cm_thankyou_headline',
			'type' => 'text',
			'default_value' => 'Thank you',
			'placeholder' => 'Enter headline',
		),

		array(
			'key' => 'field_cm_thankyou_content',
			'label' => 'Thank You Content',
			'name' => 'cm_thankyou_content',
			'type' => 'wysiwyg',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 0,
			'default_value' => '<p>Lorem ipsum dolor sit amet diam mollis vivamus tempor cras cursus. Donec proin justo curabitur tincidunt cursus velit aliquam ornare praesent. Nunc bibendum risus etiam faucibus lobortis aenean iaculis lacinia eiusmod suspendisse.</p><p>Lorem ipsum dolor sit amet porttitor turpis phasellus dictumst enim aliquet. Purus vulputate ornare.</p>',
		),

		// SPEAKERS SECTION TAB
		array(
			'key' => 'field_cm_speakers_tab',
			'label' => 'Speakers',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_speakers_header_logo',
			'label' => 'Speakers Section Header Logo (SVG)',
			'name' => 'cm_speakers_header_logo',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'svg',
			'instructions' => 'Upload SVG logo for speakers section header (optional)',
		),

		array(
			'key' => 'field_cm_speakers_label',
			'label' => 'Speakers Section Label',
			'name' => 'cm_speakers_label',
			'type' => 'text',
			'default_value' => 'CHANGE MAKERS 2025',
			'placeholder' => 'CHANGE MAKERS 2025',
		),

		array(
			'key' => 'field_cm_speakers',
			'label' => 'Speakers',
			'name' => 'cm_speakers',
			'type' => 'repeater',
			'layout' => 'block',
			'collapsed' => 'field_cm_speaker_first_name',
			'button_label' => 'Add Speaker',
			'min' => 0,
			'max' => 10,
			'sub_fields' => array(

				array(
					'key' => 'field_cm_speaker_photo',
					'label' => 'Speaker Photo',
					'name' => 'photo',
					'type' => 'image',
					'return_format' => 'id',
					'preview_size' => 'medium',
					'library' => 'all',
					'instructions' => 'Upload square headshot (recommended: 600x600px)',
				),

				array(
					'key' => 'field_cm_speaker_first_name',
					'label' => 'First Name',
					'name' => 'first_name',
					'type' => 'text',
					'placeholder' => 'Michael',
					'required' => 1,
				),

				array(
					'key' => 'field_cm_speaker_last_name',
					'label' => 'Last Name',
					'name' => 'last_name',
					'type' => 'text',
					'placeholder' => 'Harris',
					'required' => 1,
				),

				array(
					'key' => 'field_cm_speaker_title',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'placeholder' => 'Vice Chairman & Global Head of Capital Markets',
					'required' => 1,
				),

				array(
					'key' => 'field_cm_speaker_organization',
					'label' => 'Organization',
					'name' => 'organization',
					'type' => 'text',
					'placeholder' => 'NYSE',
					'required' => 0,
				),

				array(
					'key' => 'field_cm_speaker_company_logo',
					'label' => 'Company Logo',
					'name' => 'company_logo',
					'type' => 'file',
					'return_format' => 'id',
					'library' => 'all',
					'mime_types' => 'svg,png,jpg,jpeg',
					'instructions' => 'Upload company logo (SVG preferred, max width 120px)',
				),

				array(
					'key' => 'field_cm_speaker_logo_size',
					'label' => 'Logo Size',
					'name' => 'logo_size',
					'type' => 'select',
					'choices' => array(
						'normal' => 'Normal (120px)',
						'large' => 'Large (180px - for wide logos)',
					),
					'default_value' => 'normal',
					'instructions' => 'Use "Large" for wide/short logos like American Eagle',
				),

				array(
					'key' => 'field_cm_speaker_bio',
					'label' => 'Bio',
					'name' => 'bio',
					'type' => 'wysiwyg',
					'tabs' => 'all',
					'toolbar' => 'basic',
					'media_upload' => 0,
					'default_value' => '<p>Lorem ipsum dolor sit amet diam mollis vivamus tempor cras cursus. Donec proin justo curabitur tincidunt cursus velit aliquam ornare praesent. Nunc bibendum risus etiam.</p>',
				),

				array(
					'key' => 'field_cm_speaker_content_ready',
					'label' => 'Content Ready',
					'name' => 'content_ready',
					'type' => 'true_false',
					'ui' => 1,
					'ui_on_text' => 'Live',
					'ui_off_text' => 'Coming Soon',
					'default_value' => 0,
					'instructions' => 'Toggle to "Live" when AI summaries are ready to publish',
				),

				array(
					'key' => 'field_cm_speaker_pdf_link',
					'label' => 'PDF Download Link',
					'name' => 'pdf_link',
					'type' => 'url',
					'placeholder' => 'https://example.com/notes.pdf',
					'instructions' => 'URL to PDF of summarized notes',
				),

				array(
					'key' => 'field_cm_speaker_pdf_button_text',
					'label' => 'PDF Button Text',
					'name' => 'pdf_button_text',
					'type' => 'text',
					'default_value' => 'Download Notes',
					'placeholder' => 'Download Notes',
					'instructions' => 'Custom text for PDF download button',
				),

				array(
					'key' => 'field_cm_speaker_podcast_link',
					'label' => 'Podcast Download Link',
					'name' => 'podcast_link',
					'type' => 'url',
					'placeholder' => 'https://example.com/podcast.mp3',
					'instructions' => 'URL to podcast audio file',
				),

				array(
					'key' => 'field_cm_speaker_podcast_button_text',
					'label' => 'Podcast Button Text',
					'name' => 'podcast_button_text',
					'type' => 'text',
					'default_value' => 'Download Podcast',
					'placeholder' => 'Download Podcast',
					'instructions' => 'Custom text for podcast download button',
				),
			),
		),

		// SURVEY SECTION TAB
		array(
			'key' => 'field_cm_survey_tab',
			'label' => 'Survey Section',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_survey_headline',
			'label' => 'Survey Headline',
			'name' => 'cm_survey_headline',
			'type' => 'text',
			'default_value' => 'Take our Survey',
			'placeholder' => 'Enter headline',
		),

		array(
			'key' => 'field_cm_survey_content',
			'label' => 'Survey Content',
			'name' => 'cm_survey_content',
			'type' => 'wysiwyg',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 0,
			'default_value' => '<p>Lorem ipsum dolor sit amet diam mollis vivamus tempor cras cursus. Donec proin justo curabitur tincidunt cursus velit aliquam ornare praesent. Nunc bibendum risus etiam faucibus lobortis aenean iaculis lacinia eiusmod suspendisse.</p>',
		),

		array(
			'key' => 'field_cm_survey_button_text',
			'label' => 'Button Text',
			'name' => 'cm_survey_button_text',
			'type' => 'text',
			'default_value' => 'Tell us what you think',
			'placeholder' => 'Enter button text',
		),

		array(
			'key' => 'field_cm_survey_button_link',
			'label' => 'Button Link',
			'name' => 'cm_survey_button_link',
			'type' => 'link',
			'return_format' => 'array',
			'instructions' => 'Choose an internal page or enter an external URL',
		),

		// VIDEO STRIP SECTION TAB
		array(
			'key' => 'field_cm_video_strip_tab',
			'label' => 'Video Strip',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_video_strip',
			'label' => 'Video Strip (Bottom Separator)',
			'name' => 'cm_video_strip',
			'type' => 'file',
			'return_format' => 'id',
			'library' => 'all',
			'mime_types' => 'mp4,webm',
			'instructions' => 'Upload video for visual separator between survey and footer (recommended: 1920x150px, under 3MB)',
		),

		// MODAL DISCLAIMER TAB
		array(
			'key' => 'field_cm_modal_tab',
			'label' => 'Modal Disclaimer',
			'name' => '',
			'type' => 'tab',
			'placement' => 'top',
		),

		array(
			'key' => 'field_cm_modal_enabled',
			'label' => 'Enable Modal Disclaimer',
			'name' => 'cm_modal_enabled',
			'type' => 'true_false',
			'ui' => 1,
			'ui_on_text' => 'Enabled',
			'ui_off_text' => 'Disabled',
			'default_value' => 1,
			'instructions' => 'Show content acknowledgement modal on page load',
		),

		array(
			'key' => 'field_cm_modal_title',
			'label' => 'Modal Title',
			'name' => 'cm_modal_title',
			'type' => 'text',
			'default_value' => 'Change Makers 2025',
			'placeholder' => 'Enter modal title',
			'instructions' => 'Main title displayed at top of modal (styled with Work Sans Bold, coral color)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_modal_subtitle',
			'label' => 'Modal Subtitle',
			'name' => 'cm_modal_subtitle',
			'type' => 'text',
			'default_value' => 'Content Acknowledgement',
			'placeholder' => 'Enter modal subtitle',
			'instructions' => 'Subtitle text below the main title (styled with Work Sans, uppercase, navy)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_modal_content',
			'label' => 'Modal Content',
			'name' => 'cm_modal_content',
			'type' => 'wysiwyg',
			'tabs' => 'visual',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'default_value' => '<p>The Change Makers event is an intimate, invite-only gathering created to share personal stories of transformation and leadership.</p><p>The ideas, insights, and materials presented by our featured speakers are shared for inspiration and reflection only, and remain the intellectual property of their respective creators.</p><p>By proceeding, you agree to treat all speaker content as confidential and not to reproduce, publish, or distribute it without permission. Please enjoy and respect the spirit of trust that makes Change Makers possible.</p>',
			'instructions' => 'Main message displayed in the modal',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_modal_require_checkbox',
			'label' => 'Require Checkbox',
			'name' => 'cm_modal_require_checkbox',
			'type' => 'true_false',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 1,
			'instructions' => 'Require users to check a box before accepting (if disabled, only OK button shows)',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_modal_checkbox_label',
			'label' => 'Checkbox Label',
			'name' => 'cm_modal_checkbox_label',
			'type' => 'text',
			'default_value' => 'I acknowledge and agree to these terms',
			'placeholder' => 'Enter checkbox label',
			'instructions' => 'Text displayed next to checkbox',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
					array(
						'field' => 'field_cm_modal_require_checkbox',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

		array(
			'key' => 'field_cm_modal_button_text',
			'label' => 'Button Text',
			'name' => 'cm_modal_button_text',
			'type' => 'text',
			'default_value' => 'OK',
			'placeholder' => 'Enter button text',
			'instructions' => 'Text displayed on the confirmation button',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_cm_modal_enabled',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
		),

	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-changemakers.php',
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
