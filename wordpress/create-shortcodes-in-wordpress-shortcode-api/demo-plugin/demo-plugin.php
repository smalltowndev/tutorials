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

add_action( 'init', function() {
	add_shortcode( 'demo-shortcode', 'demo_shortcode_render' );
} );

function demo_shortcode_render( $atts ) {
	if ( $atts && isset( $atts['prompt'] ) ) {
		$prompt = $atts['prompt'];

		return "Hello {$prompt} World!";
	}

	return "Hello World!";
}