<?php
/**
 * Plugin Name:     Wordpress SlideShow Plugin
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

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

new Wordpress_SlideShow();

class Wordpress_SlideShow { 

     public function __construct(){

          /* enqueue child styles */
          add_action( 'admin_enqueue_scripts', array($this,'wp_slideshow_plugin_enqueue_styles' )  );

          /* Add admin menu item and settings page */
          add_action( 'admin_menu', array($this,'wp_slideshow_plugin_admin_menu') );
          
          /* Ajax */
          add_action( 'wp_ajax_wp_slideshow_images_ajax', array($this,'wp_slideshow_images_ajax_callback') );
     }

     public function wp_slideshow_plugin_enqueue_styles() {

          //enqueue media js 
          wp_enqueue_media();

          //enqueue custom js 
          wp_enqueue_script( 'wp-slideshow-js', plugin_dir_url( __FILE__ ) . '_assets/js/scripts.js', array(), '1.0' );
          wp_localize_script( 'wp-slideshow-js', 'ajax_obj', array( 'url' => admin_url( 'admin-ajax.php' )));
         
      }

     public function wp_slideshow_plugin_admin_menu() {
          add_menu_page(
               'WP Slideshow',
               'Slideshow',
               'manage_options',
               'wp-slideshow',
               array($this,'wp_slideshow_plugin_options_page')
          );
     }

     public function wp_slideshow_plugin_options_page() {
          // Check user capabilities
          if (!current_user_can('manage_options')) {
               return;
          }
          
          // Get current images
          $images = get_option('wp_slideshow_images', array());
          
          // Output JavaScript to handle media selection
          ?>
          <div class="wrap">
               <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
               
               <button type="button" class="button" id="wp-slideshow-plugin-media-button" data-editor="content" onclick="add_my_plugin_media();">
                    Insert Media
               </button>
          </div>
          <?php
     }

     public function wp_slideshow_images_ajax_callback() {
          /* Save images in DB */
          $images = isset($_POST['wp_slideshow_images']) ? $_POST['wp_slideshow_images'] : array();
          update_option( 'wp_slideshow_images', $images );
          wp_die();
     }
}

