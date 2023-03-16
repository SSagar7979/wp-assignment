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
		// Slick CSS & JS files.
		wp_enqueue_style( 'slick-css', SIDESHOW__PLUGIN_URL . '_assets/css/slick.css', array(), '1.8.0' );
		wp_enqueue_style( 'slick-theme-css', SIDESHOW__PLUGIN_URL . '_assets/css/slick-theme.css', array(), '1.8.0' );
		wp_enqueue_script( 'slick-min-js', SIDESHOW__PLUGIN_URL . '_assets/js/slick.min.js', array( 'jquery' ), '1.8.0', true );

		// enqueue custom js.
		wp_enqueue_script( 'wp-slideshow-js', SIDESHOW__PLUGIN_URL . '_assets/js/front-scripts.js', array( 'jquery' ), SIDESHOW__VERSION, true );
	}

	/**
	 * SlideShow [myslideshow] callback function
	 */
	public function myslideshow_shortcode_callback() {
		// Get current images.
		$images = get_option( 'wp_slideshow_images', array() );

		ob_start();
		?>
		<div class="slider slideshow-images">
			<?php
			foreach ( $images as $key => $image_id ) :
				?>
				<div class="slide-image slide-<?php echo esc_attr( $image_id ); ?>">
					<?php
						echo wp_get_attachment_image( $image_id, 'full', '', array( 'class' => 'img-responsive' ) );
					?>
				</div>
				<?php
			endforeach;
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}
