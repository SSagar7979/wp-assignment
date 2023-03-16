# WordPress Slideshow Plugin

Contributors: https://profiles.wordpress.org/sagarsavani7979/
Requires at least: 4.5
Tested up to: 6.1.1
Requires PHP: 5.6
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin allows WordPress site owners to create and display a slideshow of images on their website using a simple shortcode.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the wordpress-slideshow-plugin folder to the /wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Create a new slideshow by navigating to the plugin's settings page in the WordPress admin dashboard.
4. Upload images for the slideshow, and arrange their order as desired using the jQuery UI Sortable feature.
5. Add the shortcode [myslideshow] to any page or post where you want the slideshow to appear.

== Admin-side Features ==

* Settings page to add, remove and reorder images for the slideshow.
* Ability to upload multiple images at once.
* jQuery UI Sortable feature to easily rearrange the order of images.

== Front-end Features ==

* Simple shortcode "[myslideshow]" to display the slideshow on any page or post.
* Uses any jQuery slideshow library/plugin for the actual slideshow display.


== Frequently Asked Questions ==

= Can I add captions to the slideshow images? =

Unfortunately, the plugin does not currently support adding captions to the slideshow images.

= How many images can I add to a slideshow? =

You can add as many images as you like to the slideshow, but keep in mind that the more images you add, the longer the slideshow will take to load.

= Can I use my own CSS styles for the slideshow? =

Yes, you can use custom CSS to style the slideshow however you like.


== Changelog ==

= 1.0 =
* Initial release of the plugin.

# WordPress Contributors

Contributors: https://profiles.wordpress.org/sagarsavani7979/
Requires at least: 4.5
Tested up to: 6.1.1
Requires PHP: 5.6
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==

This plugin allows users to add and display contributors to a WordPress post. A new metabox is added to the post editor page, allowing users to select and save contributors to the post. On the front-end, a "Contributors" box is displayed at the end of the post with a list of selected contributors, along with their Gravatars and clickable links to their respective author pages.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the wp-contributors folder to the /wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.


== Admin-side Features ==

* A new metabox labeled "Contributors" is added to the WordPress post editor page.
* The metabox displays a list of authors (WordPress users) with checkboxes for each author.
* Users can select one or more authors from the list and save their selections.
* When the post is saved, the states of the checkboxes for the author list in the "Contributors" box are also saved.


== Front-end Features ==

* A post-content filter is used to display a "Contributors" box at the end of the post on the front-end.
* The "Contributors" box displays a list of selected authors, along with their Gravatars and clickable links to their respective author pages.


== Libraries ==

* This plugin does not use any third-party libraries.


== Contributing == 

* Guidelines on how to contribute to the project, including coding standards, commit conventions, and pull request process.
