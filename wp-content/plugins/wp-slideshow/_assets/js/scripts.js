

function add_my_plugin_media() {
     var mediaUploader = wp.media({
          multiple: true // allow multiple selection
     });
     mediaUploader.on('select', function() {
          var selection = mediaUploader.state().get('selection');
          var mediaArray = [];
          selection.map(function(attachment) {
               attachment = attachment.toJSON();
               mediaArray.push(attachment.id);
          });
          
          jQuery.post(
               ajax_obj.url,
               {
                    action: 'wp_slideshow_images_ajax',
                    wp_slideshow_images: mediaArray
               },
               function( response ) {
                    console.log( 'Media array saved!' );
               }
          );
     });
     mediaUploader.open();
}