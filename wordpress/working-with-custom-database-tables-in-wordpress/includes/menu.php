<?php
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
	echo '<h1>Demo Menu Form</h1>';
	?>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" style="display: grid; grid-gap: 15px;">
		<div>
			<p>Name</p>
			<input type="text" name="name" placeholder="Enter a name" />
		</div>
		<div>
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter a username" />
		</div>
		<div>
			<p>Email</p>
			<input type="email" name="email" placeholder="Enter an email" />
		</div>
		<div>
			<?php wp_nonce_field( 'demo_plugin_form_nonce' ); ?>
			<input type="hidden" name="action" value="demo_plugin_form" />
			<input type="submit" class="button button-primary" value="Submit" />
		</div>
	</form>
	<?php

	// Maybe show registered users below.
	demo_show_saved_users();
}

function demo_show_saved_users() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'demo_form';

	$users = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM %1$s', $table_name ) );

	echo '<h2>Saved Users</h2>';

	if ( ! empty( $users ) ) {
		foreach ( $users as $user ) {
			echo "<p>{$user->name}: {$user->email}</p>";
		}
	}
}
