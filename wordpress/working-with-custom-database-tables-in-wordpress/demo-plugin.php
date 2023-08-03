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

// Constant for Plugin path.
define( 'DEMO_PLUGIN_FILE_PATH', plugin_dir_path( __FILE__ ) );

// Require menu handler file.
require_once trailingslashit( DEMO_PLUGIN_FILE_PATH ) . 'includes/menu.php';


// Require AJAX handler file.
require_once trailingslashit( DEMO_PLUGIN_FILE_PATH ) . 'includes/ajax.php';


register_activation_hook( __FILE__, 'demo_create_tables' );

function demo_create_tables() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'demo_form';
	$charset_collation = $wpdb->get_charset_collate();

	$query = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    username tinytext NOT NULL,
    email varchar(55) NOT NULL,
    registered_at datetime DEFAULT now() NOT NULL,
    PRIMARY KEY (id)
) $charset_collation";

	require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $query );

	add_option( 'demo_form_table_version', '1.0.0' );
}

register_uninstall_hook( __FILE__, 'demo_delete_db_data' );

function demo_delete_db_data() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'demo_form';

	$query = "DROP TABLE $table_name";

	require_once ( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $query );

	delete_option( 'demo_form_table_version' );
}
