<?php
// Hook into AJAX request event.
add_action( 'wp_ajax_demo_plugin_form', 'demo_process_form' );

/**
 * Process AJAX event.
 *
 * @return void
 */
function demo_process_form() {
	if ( ! check_ajax_referer( 'demo_plugin_form_nonce', '_wpnonce' ) ) {
		exit( 'Unauthorized' );
	}

	$name     = wp_unslash( $_REQUEST['name'] ) ?? ''; // phpcs:ignore.
	$username = wp_unslash ( $_REQUEST['username'] ) ?? ''; // phpcs:ignore.
	$email    = wp_unslash( $_REQUEST['email'] ) ?? ''; // phpcs:ignore.

	// Do anything with the form data below.
	global $wpdb;

	$table_name = $wpdb->prefix . 'demo_form';

	$wpdb->insert(
		$table_name,
		array(
			'name'     => $name,
			'username' => $username,
			'email'    => $email,
		)
	);

	// Redirect back to origin.
	$referrer = $_REQUEST['_wp_http_referer'];
	wp_safe_redirect( $referrer );
	die();
}
