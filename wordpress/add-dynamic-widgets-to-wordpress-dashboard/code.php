<?php
add_action( 'wp_dashboard_setup', 'test_dashboard_widget' );

/**
 * Registers dashboard widget.
 */
function test_dashboard_widget() {
	wp_add_dashboard_widget(
		'test_dashboard_widget',
		esc_html( 'Test widget' ),
		'test_dashboard_widget_func',
		null,
		null,
		'normal',
		'high'
	);
}

/**
 * Renders "Test widget" data at dashboard.
 */
function test_dashboard_widget_func() {
	echo '<h1>Our top users:</h1>';

	$response = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );
	$response = wp_remote_retrieve_body( $response );
	$response = json_decode( $response );

	foreach ( $response as $key => $values ) {
		$escaped_text = esc_html( $values->username );
		echo "<p>{$escaped_text}</p>";
	}

}
