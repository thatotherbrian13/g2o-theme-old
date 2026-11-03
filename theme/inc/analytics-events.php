<?php
/**
 * GA4 conversion events pushed to the GTM dataLayer.
 *
 * GTM (GTM-T8H9RVD4, loaded in header.php) can't see these on its own:
 * - form_submit      Gravity Forms success (server-side confirmation) and HubSpot embeds (postMessage).
 * - file_download    Gated downloads whose Gravity Forms confirmation redirects to a PDF.
 * - job_application  WP Job Manager Applications success (?application_success=1 on the job page).
 *
 * Direct PDF links are left to GA4 enhanced measurement (its own file_download event).
 *
 * @package g2o
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a <script> that pushes events to the dataLayer (the parent window's, for AJAX iframes).
 *
 * @param array  $events  dataLayer objects.
 * @param string $after   Optional JS to run after the last event has been handed to GTM.
 * @return string
 */
function g2o_datalayer_script( $events, $after = '' ) {
	$json = wp_json_encode( array_values( $events ) );
	$js   = '(function(){var w=window.parent||window;w.dataLayer=w.dataLayer||[];var ev=' . $json . ';';
	if ( $after ) {
		// Run $after once, when GTM has fired the last event's tags or after 1.5s, whichever is first.
		$js .= 'var done=false,go=function(){if(done)return;done=true;' . $after . '};';
		$js .= 'ev[ev.length-1].eventCallback=go;ev[ev.length-1].eventTimeout=1500;setTimeout(go,1500);';
	}
	$js .= 'ev.forEach(function(e){w.dataLayer.push(e);});})();';
	return '<script>' . $js . '</script>';
}

/**
 * Gravity Forms: push form_submit with every confirmation, and file_download for PDF redirects.
 */
add_filter(
	'gform_confirmation',
	function ( $confirmation, $form, $entry, $is_ajax ) {
		$page_path = wp_parse_url( (string) rgar( $entry, 'source_url' ), PHP_URL_PATH );
		$events    = array(
			array(
				'event'         => 'form_submit',
				'form_provider' => 'gravity_forms',
				'form_id'       => (string) $form['id'],
				'form_name'     => $form['title'],
				'page_path'     => $page_path ? $page_path : '',
			),
		);

		// Message confirmation: append the push to the message.
		if ( is_string( $confirmation ) ) {
			return $confirmation . g2o_datalayer_script( $events );
		}

		// Redirect confirmation (the gated PDF downloads): show a short message, push, then redirect.
		if ( is_array( $confirmation ) && ! empty( $confirmation['redirect'] ) ) {
			$url  = $confirmation['redirect'];
			$path = (string) wp_parse_url( $url, PHP_URL_PATH );

			if ( preg_match( '/\.pdf$/i', $path ) ) {
				$events[] = array(
					'event'          => 'file_download',
					'file_name'      => basename( $path ),
					'file_extension' => 'pdf',
					'link_url'       => $url,
					'form_name'      => $form['title'],
				);
			}

			$message  = '<div id="gform_confirmation_wrapper_' . absint( $form['id'] ) . '" class="gform_confirmation_wrapper">';
			$message .= '<div class="gform_confirmation_message">';
			$message .= esc_html__( 'Thanks! Your download is starting.', 'g2o' ) . ' ';
			$message .= '<a href="' . esc_url( $url ) . '">' . esc_html__( 'If it doesn’t open, click here.', 'g2o' ) . '</a>';
			$message .= '</div></div>';

			return $message . g2o_datalayer_script( $events, 'w.location.href=' . wp_json_encode( $url ) . ';' );
		}

		return $confirmation;
	},
	20,
	4
);

/**
 * WP Job Manager Applications: push job_application on the success page.
 */
add_action(
	'wp_footer',
	function () {
		if ( empty( $_GET['application_success'] ) || ! is_singular( 'job_listing' ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return;
		}
		echo g2o_datalayer_script( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-encoded.
			array(
				array(
					'event'     => 'job_application',
					'job_id'    => (string) get_the_ID(),
					'job_title' => get_the_title(),
					'page_path' => wp_parse_url( get_permalink(), PHP_URL_PATH ),
				),
			)
		);
	}
);

/**
 * HubSpot embedded forms: listen for their submit callbacks and push form_submit.
 */
add_action(
	'wp_footer',
	function () {
		?>
<script>
(function () {
	var sent = {};
	function push(formId) {
		var key = formId || 'unknown';
		if (sent[key] && Date.now() - sent[key] < 3000) return; // v2 and v4 embeds can both fire
		sent[key] = Date.now();
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: 'form_submit',
			form_provider: 'hubspot',
			form_id: key,
			form_name: 'HubSpot ' + key,
			page_path: window.location.pathname
		});
	}
	// Legacy (v2) embeds post a message to the page.
	window.addEventListener('message', function (e) {
		var d = e.data;
		if (d && d.type === 'hsFormCallback' && d.eventName === 'onFormSubmitted') push(d.id);
	});
	// v4 embeds dispatch a window event.
	window.addEventListener('hs-form-event:on-submission:success', function (e) {
		var id = e.detail && (e.detail.formId || e.detail.formGuid);
		push(id);
	});
})();
</script>
		<?php
	},
	100
);
