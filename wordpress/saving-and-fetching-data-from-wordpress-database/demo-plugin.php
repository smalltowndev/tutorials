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

add_action(
	'wp_head',
	function() {
		$option_value = get_option( 'blogname', 'default value' ); // get_site_option for multisite network.

		var_dump( $option_value );
	}
);

add_action(
	'plugins_loaded',
	function() {
		update_option( 'blogname', 'Hello You!' ); // update_site_option for multisite network.

		add_option( 'test_demo_option', 'Saved this data!' ); // add_site_option for multisite network.

		$test_option = get_option( 'test_demo_option', 'fallback to this!' );

		var_dump( $test_option );

		delete_option( 'test_demo_option' ); // delete_site_option for multisite network.
	}
);
