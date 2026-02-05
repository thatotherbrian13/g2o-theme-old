<?php
/**
 * ACF Admin Styles for ChangeMakers Speakers
 *
 * Adds custom CSS to improve visual clarity of speaker repeater fields
 *
 * @package g2o
 */

/**
 * Enqueue custom admin styles for ACF speakers field
 */
function changemakers_acf_admin_styles() {
	// Only load on post edit screens
	$screen = get_current_screen();
	if ( ! $screen || $screen->base !== 'post' ) {
		return;
	}
	?>
	<style>
		/* ChangeMakers Speakers - Enhanced Visual Separation */

		/* Each speaker block gets a bordered card */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row {
			background: #fff;
			border: 2px solid #dcdcde;
			border-radius: 6px;
			margin-bottom: 20px !important;
			padding: 20px !important;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
			transition: all 0.2s ease;
		}

		/* Hover state for speaker blocks */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row:hover {
			border-color: #72d1f6;
			box-shadow: 0 2px 8px rgba(114, 209, 246, 0.15);
		}

		/* Collapsed speaker block */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row.-collapsed {
			background: #f6f7f7;
			padding: 15px 20px !important;
			border-color: #c3c4c7;
		}

		/* Collapsed block hover */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row.-collapsed:hover {
			background: #fff;
			border-color: #72d1f6;
		}

		/* Collapsed row handle (show speaker name) */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row.-collapsed .acf-row-handle {
			font-size: 16px;
			font-weight: 600;
			color: #234253;
			padding: 8px 0;
		}

		/* Expanded row handle */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row:not(.-collapsed) .acf-row-handle {
			background: #234253;
			color: #fff;
			margin: -20px -20px 20px -20px;
			padding: 12px 20px;
			border-radius: 4px 4px 0 0;
			font-weight: 600;
		}

		/* Collapse/Expand button styling */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon {
			color: #72d1f6;
		}

		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row:not(.-collapsed) .acf-row-handle .acf-icon {
			color: #fff;
		}

		/* Remove row button (delete) - make it more prominent */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon.-minus {
			background: #d63638;
			color: #fff;
			border-radius: 3px;
			padding: 4px;
			transition: all 0.2s ease;
		}

		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon.-minus:hover {
			background: #a83234;
			transform: scale(1.1);
		}

		/* Add speaker button */
		.acf-field[data-name="cm_speakers"] .acf-repeater > .acf-actions .acf-button {
			background: #234253;
			color: #fff;
			border-color: #234253;
			padding: 10px 20px;
			font-weight: 600;
			border-radius: 4px;
			transition: all 0.2s ease;
		}

		.acf-field[data-name="cm_speakers"] .acf-repeater > .acf-actions .acf-button:hover {
			background: #72d1f6;
			border-color: #72d1f6;
			color: #234253;
			transform: translateY(-1px);
			box-shadow: 0 2px 8px rgba(114, 209, 246, 0.3);
		}

		/* Drag handle - make it more obvious */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon.-collapse {
			order: 2;
			margin-left: auto;
		}

		/* Order number - style it better */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon.-minus {
			order: 3;
			margin-left: 10px;
		}

		/* Speaker number indicator */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-row-handle .acf-icon.-collapse:before {
			content: "▼";
		}

		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row.-collapsed .acf-row-handle .acf-icon.-collapse:before {
			content: "▶";
		}

		/* Field labels within speaker block - better hierarchy */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-field .acf-label label {
			font-weight: 600;
			color: #234253;
		}

		/* Required asterisk */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-field .acf-label .acf-required {
			color: #d63638;
		}

		/* Better spacing between fields */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-field {
			margin-bottom: 16px;
		}

		/* Last field no margin */
		.acf-field[data-name="cm_speakers"] .acf-repeater .acf-row .acf-field:last-child {
			margin-bottom: 0;
		}

		/* Empty state message */
		.acf-field[data-name="cm_speakers"] .acf-repeater.-empty .acf-table {
			border: 2px dashed #c3c4c7;
			border-radius: 6px;
			padding: 40px;
			text-align: center;
			background: #f6f7f7;
		}

		.acf-field[data-name="cm_speakers"] .acf-repeater.-empty:before {
			content: "No speakers added yet. Click 'Add Speaker' to get started.";
			display: block;
			color: #646970;
			font-size: 14px;
			margin-bottom: 20px;
		}
	</style>
	<?php
}
add_action( 'acf/input/admin_head', 'changemakers_acf_admin_styles' );
