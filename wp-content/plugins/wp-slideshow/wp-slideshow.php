<?php
/**
 * Plugin Name:     WordPress SlideShow Plugin
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     This is a assignment slideshow plugin.
 * Author:          Sagar Savani
 * Author URI:      https://github.com/SSagar7979
 * Text Domain:     wp-slideshow
 * Domain Path:     /languages
 * Version:         1.0
 *
 * @package         Wp_Slideshow
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'SIDESHOW__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SIDESHOW__PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// Load slideshow class file.
require_once SIDESHOW__PLUGIN_DIR . 'inc/class-wordpress-slideshow.php';

// Called the slideshow object.
add_action( 'plugins_loaded', 'run_slideshow' );

/**
 * Plugin callback function.
 */
function run_slideshow() {
	new WordPress_SlideShow();
}

// This is the end of the file.
