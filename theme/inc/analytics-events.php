<?php
/**
 * Conversion events for Google Tag Manager (GTM-PWCWDNTQ, loaded in header.php).
 *
 * Every successful conversion pushes one event:
 *
 *   dataLayer.push({
 *     event: 'g2o_conversion',
 *     conversion_type: 'lead' | 'download' | 'newsletter' | 'job_application',
 *     form_provider:   'gravity' | 'hubspot' | 'job_manager',
 *     form_id:         plugin form ID (job post ID for applications), as a string,
 *     form_name:       readable name from the maps below (job title for applications),
 *     page_path:       location.pathname
 *   });
 *
 * No personal data goes in the push: only the fixed values above.
 * GA4/gtag code lives in the GTM container, not here. PDF link clicks are left
 * to GA4 enhanced measurement.
 *
 * How success is detected:
 * - Gravity Forms: `gform_confirmation` only runs after a submission passes
 *   validation (including reCAPTCHA), so the push is appended to the confirmation
 *   itself. Entries marked as spam are skipped. Download forms that redirect to a
 *   PDF show a short message, push, then redirect.
 * - HubSpot: the embed's own success callbacks (v2 postMessage, v4 window event).
 * - WP Job Manager Applications: the plugin's after-save hooks set a short-lived
 *   cookie (job ID and title); the page the applicant lands on next
 *   (/page-success-application/ via a WPCode redirect snippet, or the job page)
 *   reads it, pushes and clears it. Visiting either page directly pushes nothing.
 *
 * @package g2o
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gravity Forms map: form ID => [conversion_type, form_name].
 * Unmapped forms push as 'lead' with their Gravity Forms title.
 *
 *  2  lead        Banking Consulting           /industries-expertise/banking-consulting/
 *  4  download    The AI Opportunity White Paper /what-is-the-ai-opportunity/ (redirects to the PDF)
 *  5  lead        Public Sector Contact        /industries-expertise/public-sector-consulting/
 *  6  lead        Data & Analytics             /data-analytics-consulting/, and the "Let's Chat"
 *                                              form on /ai-ready-data-foundations-white-paper/ (that
 *                                              white paper is an ungated direct link, not a form gate)
 *  7  newsletter  Newsletter Sign-up           footer subscribe stack (not currently shown)
 *  8  lead        Data & AI Strategy Assessment /data-ai-strategy-assessment/
 *  9  lead        Contact                      /contact/
 * 10  lead        Innovation Sprint            /innovation-alignment-sprint/, /strategy-to-impact-roadmapping/,
 *                                              /ai-powered-legacy-software-modernization/, /performance-testing-services/
 * 11  lead        AI Consulting                /artificial-intelligence-consulting/
 * 12  lead        Contentful Migration         /contentful-migration-services/
 * 13  download    Huntington Expo Presentation /huntington/ (redirects to the PDF)
 *
 * @return array
 */
function g2o_conversion_gravity_map() {
	return array(
		2  => array( 'lead', 'Banking Consulting' ),
		4  => array( 'download', 'The AI Opportunity White Paper' ),
		5  => array( 'lead', 'Public Sector Contact' ),
		6  => array( 'lead', 'Data & Analytics' ),
		7  => array( 'newsletter', 'Newsletter Sign-up' ),
		8  => array( 'lead', 'Data & AI Strategy Assessment' ),
		9  => array( 'lead', 'Contact' ),
		10 => array( 'lead', 'Innovation Sprint' ),
		11 => array( 'lead', 'AI Consulting' ),
		12 => array( 'lead', 'Contentful Migration' ),
		13 => array( 'download', 'Huntington Expo Presentation' ),
	);
}

/**
 * HubSpot map: form GUID => [conversion_type, form_name].
 * Unmapped forms push as 'lead' named "HubSpot form <guid>".
 *
 * c6273db5-…  lead        Service Page Contact   /customer-experience-consulting/, /product-consulting-services/,
 *                                                /technology-consulting-and-solutions/, /talent-to-task/, /industries-expertise/
 * ac7eb177-…  newsletter  Experience Next Newsletter  /experience-next-whats-new-and-next-in-cx/
 *
 * @return array
 */
function g2o_conversion_hubspot_map() {
	return array(
		'c6273db5-409e-4cbb-8c3b-3130c3f82a6b' => array( 'lead', 'Service Page Contact' ),
		'ac7eb177-b25e-42fa-93b1-5d328fb26388' => array( 'newsletter', 'Experience Next Newsletter' ),
	);
}

/**
 * Shared push helper, defined early in <head>.
 *
 * Pushes to the top window's dataLayer (Gravity Forms AJAX confirmations render in
 * an iframe), adds page_path and drops repeats of the same provider + form within 3s.
 */
add_action(
	'wp_head',
	function () {
		?>
<script>
window.g2oConversion = function (data, opts) {
	var w = window, key = data.form_provider + ':' + data.form_id, now = Date.now();
	try { if (window.parent !== window && window.parent.location.host === window.location.host) w = window.parent; } catch (e) {}
	w.g2oConversionSent = w.g2oConversionSent || {};
	if (w.g2oConversionSent[key] && now - w.g2oConversionSent[key] < 3000) return false;
	w.g2oConversionSent[key] = now;
	data.event = 'g2o_conversion';
	data.page_path = w.location.pathname;
	if (opts && opts.then) { data.eventCallback = opts.then; data.eventTimeout = 1500; }
	w.dataLayer = w.dataLayer || [];
	w.dataLayer.push(data);
	return true;
};
</script>
		<?php
	},
	1
);

/**
 * Build the inline script for one conversion.
 *
 * @param array  $data  conversion_type, form_provider, form_id, form_name.
 * @param string $after Optional JS to run once GTM has handled the event (or after 1.5s).
 * @return string
 */
function g2o_conversion_script( $data, $after = '' ) {
	$json = wp_json_encode( $data );
	if ( ! $after ) {
		return '<script>window.g2oConversion&&window.g2oConversion(' . $json . ');</script>';
	}
	return '<script>(function(){var done=false,go=function(){if(done)return;done=true;' . $after . '};'
		. 'if(window.g2oConversion){window.g2oConversion(' . $json . ',{then:go});}'
		. 'setTimeout(go,1500);})();</script>';
}

/**
 * Gravity Forms: push after a successful submission.
 */
add_filter(
	'gform_confirmation',
	function ( $confirmation, $form, $entry, $is_ajax ) {
		if ( 'spam' === rgar( $entry, 'status' ) ) {
			return $confirmation;
		}

		$map  = g2o_conversion_gravity_map();
		$id   = absint( $form['id'] );
		$data = array(
			'conversion_type' => isset( $map[ $id ] ) ? $map[ $id ][0] : 'lead',
			'form_provider'   => 'gravity',
			'form_id'         => (string) $id,
			'form_name'       => isset( $map[ $id ] ) ? $map[ $id ][1] : $form['title'],
		);

		// Text confirmation: append the push.
		if ( is_string( $confirmation ) ) {
			return $confirmation . g2o_conversion_script( $data );
		}

		// Redirect confirmation (the gated PDFs): show a short message, push, then redirect,
		// so the conversion is recorded before the browser leaves the site.
		if ( is_array( $confirmation ) && ! empty( $confirmation['redirect'] ) ) {
			$url      = $confirmation['redirect'];
			$message  = '<div id="gform_confirmation_wrapper_' . $id . '" class="gform_confirmation_wrapper">';
			$message .= '<div class="gform_confirmation_message">';
			$message .= esc_html__( 'Thanks! Your download is starting.', 'g2o' ) . ' ';
			$message .= '<a href="' . esc_url( $url ) . '">' . esc_html__( 'If it doesn’t open, click here.', 'g2o' ) . '</a>';
			$message .= '</div></div>';

			return $message . g2o_conversion_script( $data, 'try{window.parent.location.href=' . wp_json_encode( $url ) . ';}catch(e){window.location.href=' . wp_json_encode( $url ) . ';}' );
		}

		return $confirmation;
	},
	20,
	4
);

/**
 * WP Job Manager Applications: flag the saved application for the next page render.
 *
 * Both hooks fire after the application is saved. The deprecated `new_job_application`
 * fires first, and the "Job Application Redirect" WPCode snippet hooks it at priority 999
 * to redirect to /page-success-application/ and exit, so the newer
 * `job_manager_applications_new_job_application` never runs while that snippet is active.
 * Hooking both (priority 10) covers either setup; the static guard sets the cookie once.
 *
 * @param int $application_id Saved application ID.
 * @param int $job_id         Job listing ID.
 */
function g2o_conversion_flag_job_application( $application_id, $job_id ) {
	static $done = false;
	if ( $done || headers_sent() || is_object( $job_id ) ) {
		return;
	}
	$done   = true;
	$job_id = absint( $job_id );
	setrawcookie(
		'g2o_conv_job',
		rawurlencode( $job_id . '|' . wp_strip_all_tags( get_the_title( $job_id ) ) ),
		array(
			'expires'  => time() + 300,
			'path'     => COOKIEPATH ? COOKIEPATH : '/',
			'domain'   => COOKIE_DOMAIN,
			'secure'   => is_ssl(),
			'httponly' => false, // the next page's script reads and clears it
			'samesite' => 'Lax',
		)
	);
}
add_action( 'new_job_application', 'g2o_conversion_flag_job_application', 10, 2 );
add_action( 'job_manager_applications_new_job_application', 'g2o_conversion_flag_job_application', 10, 2 );

/**
 * Pages a successful application can land on (the success page, or the job page with
 * ?application_success=1): push once if the flag is set, then clear it. A direct visit has
 * no flag, so it pushes nothing. Reading the cookie in the browser keeps this working
 * when the page HTML is cached.
 */
add_action(
	'wp_footer',
	function () {
		if ( ! is_singular( 'job_listing' ) && ! is_page( 'page-success-application' ) ) {
			return;
		}
		?>
<script>
(function () {
	var m = document.cookie.match(/(?:^|;\s*)g2o_conv_job=([^;]+)/);
	if (!m) return;
	document.cookie = 'g2o_conv_job=; Max-Age=0; path=<?php echo esc_js( COOKIEPATH ? COOKIEPATH : '/' ); ?>';
	var v = decodeURIComponent(m[1]), i = v.indexOf('|');
	if (i < 1 || !window.g2oConversion) return;
	window.g2oConversion({
		conversion_type: 'job_application',
		form_provider: 'job_manager',
		form_id: v.slice(0, i),
		form_name: v.slice(i + 1)
	});
})();
</script>
		<?php
	}
);

/**
 * HubSpot embedded forms: push on their success callbacks.
 */
add_action(
	'wp_footer',
	function () {
		?>
<script>
(function () {
	var map = <?php echo wp_json_encode( g2o_conversion_hubspot_map() ); ?>;
	function push(guid) {
		guid = guid || 'unknown';
		var m = map[guid];
		if (window.g2oConversion) window.g2oConversion({
			conversion_type: m ? m[0] : 'lead',
			form_provider: 'hubspot',
			form_id: guid,
			form_name: m ? m[1] : 'HubSpot form ' + guid
		});
	}
	// Legacy (v2) embeds post a message to the page.
	window.addEventListener('message', function (e) {
		var d = e.data;
		if (d && d.type === 'hsFormCallback' && d.eventName === 'onFormSubmitted') push(d.id);
	});
	// v4 embeds dispatch a window event.
	window.addEventListener('hs-form-event:on-submission:success', function (e) {
		push(e.detail && (e.detail.formId || e.detail.formGuid));
	});
})();
</script>
		<?php
	},
	100
);
