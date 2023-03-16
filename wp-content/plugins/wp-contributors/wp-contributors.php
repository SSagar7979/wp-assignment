<?php
/**
 * Plugin Name:     WordPress Contributors
 * Plugin URI:      https://github.com/SSagar7979/wp-assignment/
 * Description:     This plugin is just for WordPress assignment
 * Author:          Sagar Savani
 * Author URI:      https://github.com/SSagar7979
 * Text Domain:     wp-contributors
 * Version:         1.0
 *
 * @package         Wp_Contributors
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'WP_CONTRIBUTORS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_CONTRIBUTORS__PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// Load slideshow class file.
require_once WP_CONTRIBUTORS__PLUGIN_DIR . 'inc/class-wp-contributors.php';

// Called the slideshow object.
add_action( 'plugins_loaded', 'run_contributors_plugin' );

/**
 * Plugin callback function.
 */
function run_contributors_plugin() {
	new WP_Contributors();
}
