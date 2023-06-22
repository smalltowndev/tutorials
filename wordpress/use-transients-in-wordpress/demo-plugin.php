<?php
/**
 * Plugin Name: Demo Plugin
 * Plugin URI: https://smalltowndev.com
 * Description: A demo plugin to show how to WordPress.
 * Author: SmallTownDev Co.
 * Version: 1.0.0
 * Author URI: https://smalltowndev.com
 *
 * @package wordpress-reset
 */

/**
 * Register a custom menu page.
 */
function demo_custom_menu_page() {
	add_menu_page(
		'Custom Menu Title',
		'Demo Menu',
		'manage_options',
		'demo_custom_menu_page',
		'demo_custom_menu_renderer',
		'dashicons-tagcloud',
		6
	);
}
add_action( 'admin_menu', 'demo_custom_menu_page' );

/**
 * Renders menu page.
 */
function  demo_custom_menu_renderer() {
    echo "<h1>Demo Menu Page</h1>";

    $posts_data = get_transient( 'demo_data' );
    // get_site_transient for multisite


    if ( ! $posts_data ) {
        $posts_data = wp_remote_get( 'https://jsonplaceholder.typicode.com/posts' );
        $posts_data = wp_remote_retrieve_body( $posts_data );
        $posts_data = json_decode( $posts_data );

        // MINUTE_IN_SECONDS
        // HOUR_IN_SECONDS
        // DAY_IN_SECONDS

        set_transient( 'demo_data', $posts_data, 24 * HOUR_IN_SECONDS ); 
        // set_site_transient for multisite

        $posts_data = get_transient( 'demo_data' );
    }

    echo "<ol>";
    foreach ($posts_data as $key => $value) {
        echo "<li>{$value->title}</li>";
    }
    echo "</ol>";

    // delete_transient( '' ); for deleting transients.
}