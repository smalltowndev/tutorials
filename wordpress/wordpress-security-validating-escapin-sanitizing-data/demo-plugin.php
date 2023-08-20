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
function demo_custom_menu_renderer() {

	// Get AJAX URL.
	$ajax_url = admin_url( 'admin-ajax.php?action=demo_menu_form' );

	$option_prefix = 'demo_plugin_form_';

	// Get saved data from settings.
	$full_name = get_option( $option_prefix . 'full_name', '' );
	$email     = get_option( $option_prefix . 'email', '' );
	$license   = get_option( $option_prefix . 'license', '' );
	?>

	<h1>Demo Menu Page</h1>
	<form action="<?php echo esc_url( $ajax_url ); ?>" method="POST">

		<div style="margin-bottom: 20px;">
			<label>Full name</label>
			<input type="text" name="full_name" placeholder="Your full name" value="<?php echo esc_attr( $full_name ); ?>"/>
		</div>

		<div style="margin-bottom: 20px;">
			<label>Email</label>
			<input type="email" name="email" placeholder="Your email" value="<?php echo esc_attr( $email ); ?>"/>
		</div>

		<div style="margin-bottom: 20px;">
			<label>License</label>
			<input type="text" name="license" placeholder="License key" value="<?php echo esc_attr( $license ); ?>"/>
		</div>


		<?php wp_nonce_field( 'demo_plugin_form' ); ?>
		<button type="submit" class="button button-primary">Submit</button>
	</form>

	<?php
}


add_action(
	'wp_ajax_demo_menu_form',
	function() {

		if ( ! check_ajax_referer( 'demo_plugin_form' ) ) {
			wp_send_json_error(
				array(
					'message' => 'Invalid Data',
				)
			);
		}

		// Rememeber to replace the url with a custom one from httpdump.app.
		wp_remote_post(
			'https://httpdump.app/dumps/1f322f4a-3211-4a82-89ef-2e88df174a8a',
			array(
				'body' => array(
					$_REQUEST,
				),
			)
		);

		$option_prefix = 'demo_plugin_form_';
		$keys          = wp_unslash( $_REQUEST );

		$sanitized_keys = array();

		$sanitized_keys['full_name'] = sanitize_text_field( $keys['full_name'] );
		$sanitized_keys['email']     = sanitize_email( $keys['email'] );
		$sanitized_keys['license']   = sanitize_key( $keys['license'] );

		foreach ( $sanitized_keys as $key => $value ) {
			if ( in_array( $key, array( 'full_name', 'email', 'license' ) ) ) {
				update_option( $option_prefix . $key, $value );
			}
		}

		wp_safe_redirect( $_REQUEST['_wp_http_referer'] );
	}
);
