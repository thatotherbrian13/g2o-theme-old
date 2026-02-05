<?php
/**
 * Modal Disclaimer Template
 *
 * Displays a content acknowledgement modal on the Change Makers page
 * Content is managed via ACF fields
 *
 * @package g2o
 */

// Get modal settings from ACF
$modal_enabled = get_field( 'cm_modal_enabled' );

// Exit if modal is disabled
if ( ! $modal_enabled ) {
	return;
}

$modal_title = get_field( 'cm_modal_title' ) ?: 'Change Makers 2025';
$modal_subtitle = get_field( 'cm_modal_subtitle' ) ?: 'Content Acknowledgement';
$modal_content = get_field( 'cm_modal_content' );
$require_checkbox = get_field( 'cm_modal_require_checkbox' );
$checkbox_label = get_field( 'cm_modal_checkbox_label' ) ?: 'I acknowledge and agree to these terms';
$button_text = get_field( 'cm_modal_button_text' ) ?: 'OK';
?>

<div class="cm-modal-overlay" id="cmDisclaimerModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="cmModalTitle">
	<div class="cm-modal" role="document">
		<div class="cm-modal__header">
			<h2 class="cm-modal__title" id="cmModalTitle">
				<?php echo esc_html( $modal_title ); ?>
			</h2>
			<?php if ( $modal_subtitle ) : ?>
				<div class="cm-modal__subtitle">
					<?php echo esc_html( $modal_subtitle ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="cm-modal__body">
			<?php echo wp_kses_post( $modal_content ); ?>
		</div>

		<div class="cm-modal__footer">
			<?php if ( $require_checkbox ) : ?>
				<label class="cm-modal__checkbox-wrapper">
					<input
						type="checkbox"
						id="cmModalCheckbox"
						class="cm-modal__checkbox"
						aria-required="true"
					>
					<span class="cm-modal__checkbox-label">
						<?php echo esc_html( $checkbox_label ); ?>
					</span>
				</label>
			<?php endif; ?>

			<button
				type="button"
				class="cm-modal__button"
				id="cmModalButton"
				<?php if ( $require_checkbox ) : ?>
					disabled
					aria-disabled="true"
				<?php endif; ?>
			>
				<?php echo esc_html( $button_text ); ?>
			</button>
		</div>
	</div>
</div>
