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
	$demo_menu_suffix = add_menu_page(
		'Custom Menu Title',
		'Demo Menu',
		'manage_options',
		'demo_custom_menu_page',
		'demo_custom_menu_renderer',
		'dashicons-tagcloud',
		6
	);

	add_action( 'load-' . $demo_menu_suffix, 'demo_menu_init' );
}
add_action( 'admin_menu', 'demo_custom_menu_page' );

/**
 * Initiate menu page hooks.
 *
 * @return void
 */
function demo_menu_init() {
	add_action( 'admin_enqueue_scripts', 'demo_menu_enqueue_scripts' );
}

/**
 * Enqueue scripts at menu page.
 *
 * @return void
 */
function demo_menu_enqueue_scripts() {
	wp_enqueue_script( 'demo-menu-script', plugin_dir_url( __FILE__ ) . '/assets/admin.js', array( 'jquery', 'wp-api', 'wp-api-fetch' ), filemtime( plugin_dir_path( __FILE__ ) . '/assets/admin.js' ), array() );
}

/**
 * Renders menu page.
 */
function demo_custom_menu_renderer() {
	?>
	<h1>Demo Menu Page</h1>
	<form id="demo-form">
		<div style="margin-bottom: 20px;">
			<label>Search term</label>
			<input type="text" name="search_term" placeholder="Enter a search text" />
		</div>
		<button type="submit" class="button button-primary">Submit</button>
	</form>

	<h2 style="margin-top: 40px;">Results:</h2>
	<div id="demo-content" style="margin-top: 20px;"></div>
	<?php
}
