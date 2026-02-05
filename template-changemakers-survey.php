<?php
/**
 * Template Name: ChangeMakers Survey 2025
 *
 * Custom page template for the ChangeMakers 2025 survey/feedback page.
 * Features same video background hero as main conference page, with embedded form below.
 *
 * @package g2o
 */

// Enqueue custom fonts and styles BEFORE header
// Typekit - Lust Script Display
wp_enqueue_style( 'typekit-lust-script', 'https://use.typekit.net/iiq0tdp.css', array(), null );

// Google Fonts - Work Sans Light
wp_enqueue_style(
	'google-fonts-work-sans',
	'https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap',
	array(),
	null
);

// ChangeMakers base stylesheet for hero styles
wp_enqueue_style(
	'changemakers-2025',
	get_template_directory_uri() . '/build/css/changemakers-2025.css',
	array( 'theme' ),
	filemtime( get_stylesheet_directory() . '/build/css/changemakers-2025.css' )
);

// Survey-specific stylesheet
wp_enqueue_style(
	'changemakers-survey',
	get_template_directory_uri() . '/build/css/changemakers-survey.css',
	array( 'changemakers-2025' ),
	filemtime( get_stylesheet_directory() . '/build/css/changemakers-survey.css' )
);

// Custom JavaScript for video playback
wp_enqueue_script(
	'changemakers-video',
	get_template_directory_uri() . '/build/js/changemakers-video.js',
	array(),
	filemtime( get_stylesheet_directory() . '/build/js/changemakers-video.js' ),
	true
);

// Get header
get_header();

// Get ACF field values - Hero Section
$hero_headline_type = get_field( 'cms_hero_headline_type' ) ?: 'text';
$hero_headline = get_field( 'cms_hero_headline' ) ?: '3 Stories of Transformation';
$hero_logo_svg_id = get_field( 'cms_hero_logo_svg' );
$hero_logo_svg = $hero_logo_svg_id ? wp_get_attachment_url( $hero_logo_svg_id ) : '';
$hero_logo_width = get_field( 'cms_hero_logo_width' ) ?: 800;
$hero_logo_shadow = get_field( 'cms_hero_logo_shadow' );
if ( $hero_logo_shadow === false || $hero_logo_shadow === null || $hero_logo_shadow === '' ) {
	$hero_logo_shadow = 30;
}
$hero_video_id = get_field( 'cms_hero_video' );
$hero_video = $hero_video_id ? wp_get_attachment_url( $hero_video_id ) : '';
$video_overlay_opacity = get_field( 'cms_video_overlay_opacity' );
if ( $video_overlay_opacity === false || $video_overlay_opacity === null || $video_overlay_opacity === '' ) {
	$video_overlay_opacity = 70;
}

// Calculate shadow opacity (0-100 becomes 0-0.6 opacity)
$shadow_opacity = $hero_logo_shadow / 100 * 0.6;

// Get ACF field values - Survey Form
$form_embed_code = get_field( 'cms_form_embed_code' );
$form_background_color = get_field( 'cms_form_background_color' ) ?: '#F7F7F7';
$form_embed_padding = get_field( 'cms_form_embed_padding' );
if ( $form_embed_padding === false || $form_embed_padding === null || $form_embed_padding === '' ) {
	$form_embed_padding = 20;
}
$form_border_radius = get_field( 'cms_form_border_radius' );
if ( $form_border_radius === false || $form_border_radius === null || $form_border_radius === '' ) {
	$form_border_radius = 8;
}

// Get ACF field values - Video Strip
$video_strip_id = get_field( 'cms_video_strip' );
$video_strip = $video_strip_id ? wp_get_attachment_url( $video_strip_id ) : '';

// Calculate overlay opacity for inline style
$overlay_opacity = $video_overlay_opacity / 100;
?>

<main id="main" class="changemakers-page changemakers-survey-page">

	<!-- HERO SECTION -->
	<section class="changemakers-hero">
		<?php if ( $hero_video ) :
			// Auto-detect video format from file extension
			$video_extension = strtolower( pathinfo( $hero_video, PATHINFO_EXTENSION ) );
			$video_type = ( $video_extension === 'webm' ) ? 'video/webm' : 'video/mp4';
		?>
			<video
				class="changemakers-hero__video"
				muted
				autoplay
				playsinline
				loop
			>
				<source src="<?php echo esc_url( $hero_video ); ?>" type="<?php echo esc_attr( $video_type ); ?>">
			</video>
		<?php endif; ?>

		<div class="changemakers-hero__overlay" style="background-color: rgba(35, 66, 83, <?php echo esc_attr( $overlay_opacity ); ?>);"></div>

		<div class="changemakers-hero__content">
			<?php if ( $hero_headline_type === 'svg' && $hero_logo_svg ) : ?>
				<div class="changemakers-hero__logo" style="--logo-width: <?php echo esc_attr( $hero_logo_width ); ?>px; --shadow-opacity: <?php echo esc_attr( $shadow_opacity ); ?>;">
					<?php
					// Load SVG inline for better styling control
					$svg_path = str_replace( home_url(), ABSPATH, $hero_logo_svg );
					if ( file_exists( $svg_path ) ) {
						echo file_get_contents( $svg_path );
					}
					?>
				</div>
			<?php else : ?>
				<h1 class="changemakers-hero__headline">
					<span class="number-three">3</span>
					<span><?php echo esc_html( str_replace( '3 ', '', $hero_headline ) ); ?></span>
				</h1>
			<?php endif; ?>
		</div>
	</section>

	<!-- SURVEY FORM SECTION -->
	<?php if ( $form_embed_code ) : ?>
		<section class="changemakers-survey-form" style="background-color: <?php echo esc_attr( $form_background_color ); ?>;">
			<div class="changemakers-survey-form__container">
				<div class="changemakers-survey-form__embed" style="padding: <?php echo esc_attr( $form_embed_padding ); ?>px; border-radius: <?php echo esc_attr( $form_border_radius ); ?>px;">
					<?php
					// Output the embed code - allows iframe and basic HTML
					$allowed_html = array(
						'iframe' => array(
							'src' => array(),
							'width' => array(),
							'height' => array(),
							'frameborder' => array(),
							'marginwidth' => array(),
							'marginheight' => array(),
							'style' => array(),
							'allowfullscreen' => array(),
							'webkitallowfullscreen' => array(),
							'mozallowfullscreen' => array(),
							'msallowfullscreen' => array(),
							'allow' => array(),
						),
						'div' => array(
							'class' => array(),
							'id' => array(),
							'style' => array(),
						),
						'script' => array(
							'src' => array(),
							'type' => array(),
						),
					);
					echo wp_kses( $form_embed_code, $allowed_html );
					?>
				</div>
			</div>
		</section>
	<?php else : ?>
		<section class="changemakers-survey-form">
			<div class="changemakers-survey-form__container">
				<div class="changemakers-survey-form__placeholder">
					<p>No survey form has been configured yet. Please add the form embed code in the page editor.</p>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- VIDEO STRIP SEPARATOR -->
	<?php if ( $video_strip ) :
		// Auto-detect video format from file extension
		$strip_extension = strtolower( pathinfo( $video_strip, PATHINFO_EXTENSION ) );
		$strip_type = ( $strip_extension === 'webm' ) ? 'video/webm' : 'video/mp4';
	?>
		<section class="changemakers-video-strip">
			<video
				class="changemakers-video-strip__video"
				muted
				autoplay
				playsinline
				loop
			>
				<source src="<?php echo esc_url( $video_strip ); ?>" type="<?php echo esc_attr( $strip_type ); ?>">
			</video>
		</section>
	<?php endif; ?>

</main>

<?php
get_footer();
