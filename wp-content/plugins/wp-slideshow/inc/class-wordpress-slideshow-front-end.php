<?php
/**
 * Class WordPress Slideshow FrontEnd
 *
 * @package Wp_Slideshow
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 *  Main Slideshow class.
 */
class WordPress_SlideShow_Front_End {

	/**
	 * Construct to trigger all the required hooks on object load.
	 */
	public function __construct() {

		// enqueue child styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_slideshow_plugin_enqueue_front_scripts' ) );

		// myslideshow shoercode hook trigger.
		add_shortcode( 'myslideshow', array( $this, 'myslideshow_shortcode_callback' ) );
	}

	/**
	 * SlideShow enqueue front scripts callback function
	 */
	public function wp_slideshow_plugin_enqueue_front_scripts() {

		// enqueue custom js.
		wp_enqueue_script( 'wp-slideshow-js', SIDESHOW__PLUGIN_URL . '_assets/js/front-scripts.js', array(), SIDESHOW__VERSION, true );
	}

	/**
	 * SlideShow [myslideshow] callback function
	 */
	public function myslideshow_shortcode_callback(  ) {
		
		ob_start();
		?>

		<?php		
		return ob_get_clean();
	
	}
	

	
}
