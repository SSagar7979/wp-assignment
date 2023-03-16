<?php
/**
 * Plugin Name:     WordPress SlideShow Plugin
 * Plugin URI:      https://github.com/SSagar7979/wp-assignment/
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
define( 'SIDESHOW__VERSION', 1.0 );

// Load slideshow admin class file.
require_once SIDESHOW__PLUGIN_DIR . 'inc/class-wordpress-slideshow.php';

// Load slideshow frontend class file.
require_once SIDESHOW__PLUGIN_DIR . 'inc/class-wordpress-slideshow-front-end.php';

// Called the slideshow object.
add_action( 'plugins_loaded', 'run_slideshow' );

/**
 * Plugin callback function.
 */
function run_slideshow() {
	new WordPress_SlideShow();
	new WordPress_SlideShow_Front_End();
}

// This is the end of the file.
