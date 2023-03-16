<?php
/**
 * Class WordPress Slideshow
 *
 * @package Wp_Slideshow
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 *  Main Slideshow class.
 */
class WordPress_SlideShow {

	/**
	 * Construct to trigger all the required hooks on object load.
	 */
	public function __construct() {

		// enqueue child styles.
		add_action( 'admin_enqueue_scripts', array( $this, 'wp_slideshow_plugin_enqueue_scripts' ) );

		// Add admin menu item and settings page.
		add_action( 'admin_menu', array( $this, 'wp_slideshow_plugin_admin_menu' ) );

		// Ajax.
		add_action( 'wp_ajax_wp_slideshow_images_ajax', array( $this, 'wp_slideshow_images_ajax_callback' ) );
	}

	/**
	 * SlideShow enqueue scripts callback function
	 */
	public function wp_slideshow_plugin_enqueue_scripts() {

		// enqueue media js.
		wp_enqueue_media();

		// enqueue custom js.
		wp_enqueue_script( 'wp-slideshow-js', SIDESHOW__PLUGIN_URL . '_assets/js/scripts.js', array(), '1.0', true );
		wp_localize_script(
			'wp-slideshow-js',
			'ajax_obj',
			array(
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'wp_slideshow_nonce' ),
			)
		);
	}

	/**
	 * SlideShow admin menu callback function
	 */
	public function wp_slideshow_plugin_admin_menu() {
		add_menu_page( 'WP Slideshow', 'Slideshow', 'manage_options', 'wp-slideshow', array( $this, 'wp_slideshow_plugin_options_page' ) );
	}

	/**
	 * SlideShow option page callback function
	 */
	public function wp_slideshow_plugin_options_page() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Get current images.
		$images = get_option( 'wp_slideshow_images', array() );

		// Output JavaScript to handle media selection.
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<div class="tablenav top">
				<div class="alignright actions">							
					<button type="button" class="button" id="wp-slideshow-plugin-media-button" data-editor="content" data-selectedImg="<?php echo implode(',',$images);?>">
						Insert Media
					</button>	
				</div>
			</div>
			<table id="SlideShowTbl" class="wp-list-table widefat fixed striped table-view-list">
				<thead>
					<tr>
						<th scope="col" id="attachmentID" class="manage-column column-attachmentID column-primary">Attachment ID </th>					
						<th scope="col" id="image-thumb" class="manage-column column-image-thumb">Image</th>
					</tr>
				</thead>
				<tbody id="the-list">
					<?php 
					foreach ($images as $key => $imageID) : 
						?>
						<tr id="<?php echo esc_attr( $imageID ); ?>">
							<td class="attachmentID column-attachmentID column-primary" data-colname="Attachment ID"><?php echo esc_attr( $imageID ); ?></td>
							<td class="thumb column-thumb" data-colname="Image">
								<?php echo wp_get_attachment_image( $imageID, array('70', '70'), '', array( "class" => "img-responsive" ) );
								?>
							</td>
						</tr>
						<?php 
					endforeach;?>					
				</tbody>
				<tfoot>
					<tr>
						<th scope="col" class="manage-column column-attachmentID">Attachment ID </th>					
						<th scope="col" class="manage-column column-image-thumb">Image</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php
	}

	/**
	 * Ajax Callback function
	 */
	public function wp_slideshow_images_ajax_callback() {
		// Save images in DB.
		if ( isset( $_POST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wp_slideshow_nonce' ) ) {
			wp_send_json_error( 'Invalid nonce.' );
		}
		
		$images = isset( $_POST['wp_slideshow_images'] ) ? (array) wp_unslash( $_POST['wp_slideshow_images'] )  : '';
		
		update_option( 'wp_slideshow_images', $images );

		wp_send_json_success( 'Success!' );

		wp_die();
	}
}
