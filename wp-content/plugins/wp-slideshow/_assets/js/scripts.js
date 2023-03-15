/**
 * WordPress Slideshow script file
 */

jQuery( function ( $ ) {
	$( document ).on( 'click', '#wp-slideshow-plugin-media-button', function () {
		var mediaUploader = wp.media({
			multiple: true,
		});
		mediaUploader.on('select', function() {
			var selection  = mediaUploader.state().get( 'selection' );
			var mediaArray = [];
			selection.map(function( attachment ) {
				attachment = attachment.toJSON();
				mediaArray.push( attachment.id );
			});
			jQuery.post(
				ajax_obj.url,
				{
					action: 'wp_slideshow_images_ajax',
					nonce: ajax_obj.nonce,
					wp_slideshow_images: mediaArray
				},
				function( response ) {
					console.log( 'Media array saved!' );
				}
			);
		});
		mediaUploader.open();
	});
});
