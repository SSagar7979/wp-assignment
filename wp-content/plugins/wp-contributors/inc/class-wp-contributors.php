<?php
/**
 *
 * Class WordPress Contributors
 *
 * @package Wp_Contributors
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 *  Main Contributors class.
 */
class WP_Contributors {
	/**
	 * Construct to trigger all the required hooks on object load.
	 */
	public function __construct() {
		// Register meta box hook.
		add_action( 'add_meta_boxes', array( $this, 'wp_contributors_register_meta_box' ) );

		// Save meta value with save post hook.
		add_action( 'save_post', array( $this, 'wp_contributors_save_meta_data_callback' ) );

		// Show meta value after post content filter.
		add_filter( 'the_content', array( $this, 'wp_contributors_append_data_callback' ) );

		// enqueue styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_slideshow_plugin_enqueue_styles' ) );
	}

	/**
	 * Contributors enqueue styles callback function
	 */
	public function wp_slideshow_plugin_enqueue_styles() {

		// enqueue custom css.
		wp_enqueue_style( 'wp-contributors-css', WP_CONTRIBUTORS__PLUGIN_URL . '_assets/css/style.css', array(), '1.0.0' );
	}

	/**
	 * Register the 'Contributors' meta box for the 'post' post type.
	 */
	public function wp_contributors_register_meta_box() {
		add_meta_box(
			'wp-contributors-meta-box-id',
			esc_html__( 'Contributors', 'Wp_Contributors' ),
			array( $this, 'wp_contributors_meta_box_callback' ),
			'post',
			'side',
			'high'
		);
	}
	/**
	 * Render the contents of the meta box for the 'Contributors' custom field.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function wp_contributors_meta_box_callback( $post ) {

		if ( is_single() ) {
			return ;
		}
		// Create a nonce field for verification when saving.
		wp_nonce_field( 'wp_contributors_save_meta_data', 'wp_contributors_meta_box_nonce' );

		// Get the current value of the '_contributors' custom field.
		$selected_contributors = get_post_meta( $post->ID, '_contributors' );

		// Get all the WordPress users.
		$users = get_users();

		// Loop through the users and output a checkbox input for each one.
		foreach ( $users as $user ) {
			// Check if the user's ID is in the $selected_contributors array.
			$checked = ( in_array( $user->ID, $selected_contributors ) ) ? 'checked="checked"' : '';

			// Output the checkbox input for the user.
			?>
			<div>
				<label>
					<input type="checkbox" name="contributors[]" value="<?php echo esc_attr( $user->ID ); ?>" <?php echo esc_attr( $checked ); ?> />
					<?php echo esc_attr( $user->display_name ); ?>
				</label>
			</div>
			<?php
		}
	}

	/**
	 * Save contributors' data when a post is saved or updated.
	 *
	 * @param int $post_id The ID of the post being saved.
	 * @return void
	 */
	public function wp_contributors_save_meta_data_callback( $post_id ) {
		// Verify nonce.
		if ( ! isset( $_POST['wp_contributors_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wp_contributors_meta_box_nonce'] ) ), 'wp_contributors_save_meta_data' ) ) {
			return;
		}

		// Check if the 'contributors' variable is set in $_POST and not empty.
		$contributors = isset( $_POST['contributors'] ) ? wp_unslash( $_POST['contributors'] ) : '';
		$contributors = array_map( 'sanitize_text_field', $contributors );
		if ( ! empty( $contributors ) ) {
			// Delete the old data.
			delete_post_meta( $post_id, '_contributors' );

			// Add the new data.
			foreach ( $contributors as $author_id ) {
				add_post_meta( $post_id, '_contributors', $author_id );
			}
		}
	}

	/**
	 * Append contributors' information to the end of post content.
	 *
	 * @param string $content The post content.
	 * @return string The post content with contributors data appended.
	 */
	public function wp_contributors_append_data_callback( $content ) {
		// Get contributors data from post meta.
		$contributors = get_post_meta( get_the_ID(), '_contributors' );
		// Check if there are any contributors.
		if ( ! empty( $contributors ) ) {
			// Create HTML markup for displaying contributors' information.
			$contributors_html  = '<div class="contributors-list">';
			$contributors_html .= '<h5>Contributors</h5>';
			$contributors_html .= '<ul>';
			foreach ( $contributors as $contributor ) {
				$contributor_info = get_userdata( $contributor );
				$avatar_url       = get_avatar_url( $contributor );
				// concate user.
				$contributors_html .= '<li><a href="' . esc_url( get_author_posts_url( $contributor ) ) . '" ><img src="' . esc_url( $avatar_url ) . '" title="' . esc_attr( $contributor_info->display_name ) . '" alt="' . esc_attr( $contributor_info->display_name ) . '" width="30" height="30" /> ' . esc_html( $contributor_info->display_name ) . '</a></li>';
			}
			$contributors_html .= '</ul>';
			$contributors_html .= '</div>';
			// Append contributors' information to the end of post content.
			$content .= $contributors_html;
		}
		return $content;
	}
}
