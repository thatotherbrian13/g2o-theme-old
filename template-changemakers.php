<?php
/**
 * Template Name: ChangeMakers Conference 2025
 *
 * Custom page template for the ChangeMakers 2025 conference page.
 * Features video background hero, speaker profiles, and survey CTA.
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

// Custom stylesheet for this template
wp_enqueue_style(
	'changemakers-2025',
	get_template_directory_uri() . '/build/css/changemakers-2025.css',
	array( 'theme' ),
	filemtime( get_stylesheet_directory() . '/build/css/changemakers-2025.css' )
);

// Custom JavaScript for video playback
wp_enqueue_script(
	'changemakers-video',
	get_template_directory_uri() . '/build/js/changemakers-video.js',
	array(),
	filemtime( get_stylesheet_directory() . '/build/js/changemakers-video.js' ),
	true
);

// Custom JavaScript for modal disclaimer
wp_enqueue_script(
	'changemakers-modal',
	get_template_directory_uri() . '/build/js/changemakers-modal.js',
	array(),
	filemtime( get_stylesheet_directory() . '/build/js/changemakers-modal.js' ),
	true
);

// Get header
get_header();

// Get ACF field values
$hero_headline_type = get_field( 'cm_hero_headline_type' ) ?: 'text';
$hero_headline = get_field( 'cm_hero_headline' ) ?: '3 Stories of Transformation';
$hero_logo_svg_id = get_field( 'cm_hero_logo_svg' );
$hero_logo_svg = $hero_logo_svg_id ? wp_get_attachment_url( $hero_logo_svg_id ) : '';
$hero_logo_width = get_field( 'cm_hero_logo_width' ) ?: 800;
$hero_logo_shadow = get_field( 'cm_hero_logo_shadow' );
if ( $hero_logo_shadow === false || $hero_logo_shadow === null || $hero_logo_shadow === '' ) {
	$hero_logo_shadow = 30;
}
$hero_video_id = get_field( 'cm_hero_video' );
$hero_video = $hero_video_id ? wp_get_attachment_url( $hero_video_id ) : '';
$video_overlay_opacity = get_field( 'cm_video_overlay_opacity' );
if ( $video_overlay_opacity === false || $video_overlay_opacity === null || $video_overlay_opacity === '' ) {
	$video_overlay_opacity = 70;
}

// Calculate shadow opacity (0-100 becomes 0-0.6 opacity)
$shadow_opacity = $hero_logo_shadow / 100 * 0.6;

$thankyou_headline = get_field( 'cm_thankyou_headline' ) ?: 'Thank you';
$thankyou_content = get_field( 'cm_thankyou_content' );

$speakers_header_logo_id = get_field( 'cm_speakers_header_logo' );
$speakers_header_logo = $speakers_header_logo_id ? wp_get_attachment_url( $speakers_header_logo_id ) : '';
$speakers_label = get_field( 'cm_speakers_label' ) ?: 'CHANGE MAKERS 2025';
$speakers = get_field( 'cm_speakers' );

$survey_headline = get_field( 'cm_survey_headline' ) ?: 'Take our Survey';
$survey_content = get_field( 'cm_survey_content' );
$survey_button_text = get_field( 'cm_survey_button_text' ) ?: 'Tell us what you think';
$survey_button_link = get_field( 'cm_survey_button_link' );

$video_strip_id = get_field( 'cm_video_strip' );
$video_strip = $video_strip_id ? wp_get_attachment_url( $video_strip_id ) : '';

// Calculate overlay opacity for inline style
$overlay_opacity = $video_overlay_opacity / 100;
?>

<main id="main" class="changemakers-page">

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

	<!-- CONTENT WRAPPER: Thank You + Speakers -->
	<div class="changemakers-content-wrapper">

		<!-- THANK YOU SECTION -->
		<section class="changemakers-thankyou">
			<h2 class="changemakers-thankyou__headline">
				<?php echo esc_html( $thankyou_headline ); ?>
			</h2>
			<div class="changemakers-thankyou__content">
				<?php echo wp_kses_post( $thankyou_content ); ?>
			</div>
		</section>

		<!-- SPEAKERS SECTION -->
		<section class="changemakers-speakers">
			<?php if ( $speakers_header_logo ) : ?>
				<div class="changemakers-speakers__header-logo">
					<?php
					$svg_path = str_replace( home_url(), ABSPATH, $speakers_header_logo );
					if ( file_exists( $svg_path ) ) {
						echo file_get_contents( $svg_path );
					}
					?>
				</div>
			<?php endif; ?>

			<div class="changemakers-speakers__label">
				<?php echo esc_html( $speakers_label ); ?>
			</div>

			<div class="changemakers-speakers__grid">
				<?php if ( $speakers ) : ?>
					<?php foreach ( $speakers as $speaker ) :
						$photo_id = $speaker['photo'];
						$photo = $photo_id ? wp_get_attachment_url( $photo_id ) : '';
						$first_name = $speaker['first_name'];
						$last_name = $speaker['last_name'];
						$title = $speaker['title'];
						$organization = $speaker['organization'];
						$company_logo_id = $speaker['company_logo'];
						$company_logo = $company_logo_id ? wp_get_attachment_url( $company_logo_id ) : '';
						$logo_size = $speaker['logo_size'] ?: 'normal';
						$bio = $speaker['bio'];
						$content_ready = $speaker['content_ready'] ?? false;
						$pdf_link = $speaker['pdf_link'];
						$pdf_button_text = $speaker['pdf_button_text'] ?: 'Download Notes';
						$podcast_link = $speaker['podcast_link'];
						$podcast_button_text = $speaker['podcast_button_text'] ?: 'Download Podcast';
					?>
						<article class="changemakers-speaker-card">
							<div class="changemakers-speaker-card__header">
								<div class="changemakers-speaker-card__photo-wrapper">
									<?php if ( $photo ) : ?>
										<img
											src="<?php echo esc_url( $photo ); ?>"
											alt="<?php echo esc_attr( $first_name . ' ' . $last_name ); ?>"
											class="changemakers-speaker-card__photo"
										>
									<?php else : ?>
										<div class="changemakers-speaker-card__photo--placeholder">
											Speaker Photo
										</div>
									<?php endif; ?>
								</div>

								<?php if ( $company_logo ) : ?>
									<div class="changemakers-speaker-card__logo changemakers-speaker-card__logo--<?php echo esc_attr( $logo_size ); ?>">
										<?php
										$logo_extension = pathinfo( $company_logo, PATHINFO_EXTENSION );
										if ( strtolower( $logo_extension ) === 'svg' ) {
											echo file_get_contents( str_replace( home_url(), ABSPATH, $company_logo ) );
										} else {
											echo '<img src="' . esc_url( $company_logo ) . '" alt="' . esc_attr( $organization ) . ' logo">';
										}
										?>
									</div>
								<?php endif; ?>
							</div>

							<h3 class="changemakers-speaker-card__name">
								<span class="first-name"><?php echo esc_html( $first_name ); ?></span>
								<span class="last-name"> <?php echo esc_html( $last_name ); ?></span>
							</h3>

							<div class="changemakers-speaker-card__title">
								<?php echo esc_html( strtoupper( $title ) ); ?>
								<?php if ( $organization ) : ?>
									<br><span class="organization-name"><?php echo esc_html( strtoupper( $organization ) ); ?></span>
								<?php endif; ?>
							</div>

							<div class="changemakers-speaker-card__bio">
								<?php echo wp_kses_post( $bio ); ?>
							</div>

							<div class="changemakers-speaker-card__buttons">
								<?php if ( $content_ready && $pdf_link ) : ?>
									<a href="<?php echo esc_url( $pdf_link ); ?>" class="changemakers-download-btn changemakers-download-btn--pdf" target="_blank" rel="noopener noreferrer">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm2-6h8v2H8v-2zm0 4h8v2H8v-2z"/>
										</svg>
										<?php echo esc_html( $pdf_button_text ); ?>
									</a>
								<?php elseif ( ! $content_ready ) : ?>
									<div class="changemakers-download-btn changemakers-download-btn--disabled">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6zm2-6h8v2H8v-2zm0 4h8v2H8v-2z"/>
										</svg>
										<span>Coming Soon</span>
									</div>
								<?php endif; ?>

								<?php if ( $content_ready && $podcast_link ) : ?>
									<a href="<?php echo esc_url( $podcast_link ); ?>" class="changemakers-download-btn changemakers-download-btn--audio" target="_blank" rel="noopener noreferrer">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s-1-.45-1-1V5zm6 6c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
										</svg>
										<?php echo esc_html( $podcast_button_text ); ?>
									</a>
								<?php elseif ( ! $content_ready ) : ?>
									<div class="changemakers-download-btn changemakers-download-btn--disabled">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3zm-1-9c0-.55.45-1 1-1s1 .45 1 1v6c0 .55-.45 1-1 1s-1-.45-1-1V5zm6 6c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
										</svg>
										<span>Coming Soon</span>
									</div>
								<?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</section>

	</div><!-- .changemakers-content-wrapper -->

	<!-- SURVEY SECTION -->
	<section class="changemakers-survey">
		<h2 class="changemakers-survey__headline">
			<?php echo esc_html( $survey_headline ); ?>
		</h2>
		<div class="changemakers-survey__content">
			<?php echo wp_kses_post( $survey_content ); ?>
		</div>
		<?php if ( $survey_button_link ) : ?>
			<a
				href="<?php echo esc_url( $survey_button_link['url'] ); ?>"
				class="changemakers-survey__button"
				<?php if ( $survey_button_link['target'] ) : ?>
					target="<?php echo esc_attr( $survey_button_link['target'] ); ?>"
				<?php endif; ?>
				<?php if ( $survey_button_link['target'] === '_blank' ) : ?>
					rel="noopener noreferrer"
				<?php endif; ?>
			>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
				</svg>
				<?php echo esc_html( $survey_button_text ); ?>
			</a>
		<?php endif; ?>
	</section>

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

	<!-- MODAL DISCLAIMER -->
	<?php get_template_part( 'template-parts/modals/disclaimer-modal' ); ?>

</main>

<?php
get_footer();
