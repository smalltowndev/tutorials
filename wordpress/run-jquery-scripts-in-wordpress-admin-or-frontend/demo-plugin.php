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

 define( 'DEMO_PLUGIN_PATH', __FILE__ );

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
}

add_action( 'wp_enqueue_scripts', function() {
		wp_enqueue_script( 'demo-script', plugins_url( '/js/demo-script.js', DEMO_PLUGIN_PATH ), array( 'jquery' ), filemtime( plugin_dir_path( DEMO_PLUGIN_PATH ) . 'js/demo-script.js' ), true );

		wp_localize_script( 'demo-script', 'demoData', array(
			'wp_version' => get_bloginfo( 'version' )
		) );
} );