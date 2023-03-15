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

class Wordpress_SlideShow{     
     public function __construct(){

          // Add admin menu item and settings page
          add_action( 'admin_menu', array($this,'wp_slideshow_plugin_admin_menu') );          
     }

     protected function wp_slideshow_plugin_admin_menu() {
          add_menu_page(
               'WP Slideshow',
               'Slideshow',
               'manage_options',
               'wp-slideshow',
               array($this,'my_slideshow_plugin_options_page')
          );
     }

     protected function my_slideshow_plugin_options_page() {
          ?>
          <div class="wrap">
              <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
              <form action="options.php" method="post" enctype="multipart/form-data">
                  <?php
                  settings_fields( 'my_slideshow_plugin' );
                  do_settings_sections( 'my_slideshow_plugin' );
                  submit_button();
                  ?>
              </form>
          </div>
          <?php
     }
}