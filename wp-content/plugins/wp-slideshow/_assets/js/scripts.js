/**
 * WordPress Slideshow script file
 */

jQuery( function ($)  {
	$( document ).on( 'click', '#wp-slideshow-plugin-media-button', function () {
		let $this = $(this);
		const mediaUploader = wp.media({
			multiple: true,
			button: {
				text: 'Upload images'
			},
			library : {
				type : 'image'
			},
			autoSelect : true,
		});
		mediaUploader.on('close',function() {
			// On close, get selections and save to the hidden input
			// plus other AJAX stuff to refresh the image preview
			const selection =  mediaUploader.state().get('selection');
			console.log(mediaUploader.state());
			console.log(mediaUploader.state().get('selection'));
			
			const gallery_ids = new Array();
			selection.each(function(attachment) {
			   attachment = attachment.toJSON();
			   gallery_ids.push( attachment.id );
			});
			var ids = gallery_ids.join( "," );
			$this.attr( 'data-selectedImg',ids );
			
		});
		

		mediaUploader.on('open', () => {
			const selection = mediaUploader.state().get('selection');
			const ids_value = $this.attr('data-selectedImg');
			if(ids_value.length > 0) {
				var ids = ids_value.split(',');
				ids.forEach( id => {
					attachment = wp.media.attachment(id);
				attachment.fetch();
				selection.add(attachment ? [attachment] : []);
				});
			}
			
		});
		mediaUploader.on('select', () => {
			const selection  = mediaUploader.state().get( 'selection' );
			const mediaArray = [];
			$( '#SlideShowTbl tbody tr' ).remove();
			selection.map( attachment => {
				attachment = attachment.toJSON();
				mediaArray.push( attachment.id );
				
				// Append new row to table
				let newRow = $('<tr></tr>').attr('id',attachment.id);
				let attachTD = $('<td></td>').addClass('attachmentID column-attachmentID column-primary').attr('data-colname','Attachment ID').html(attachment.id);
				let imgTD = $('<td></td>').addClass('thumb column-thumb').attr('data-colname','Image');
				imgTD.html('<img src="'+attachment.sizes.thumbnail.url+'" width="70" height="70"/>');
				newRow.append(attachTD);
				newRow.append(imgTD);
				$('#SlideShowTbl tbody').append(newRow);
				
			});
			$.ajax({
				data: {
					action: 'wp_slideshow_images_ajax',
					nonce: ajax_obj.nonce,
					wp_slideshow_images: mediaArray
				},
				type : 'POST',
				url  : ajax_obj.url,
				datatype:'json',
				success: function(data) {
					return data; 
				}
			});
		});
		mediaUploader.open();
	});


	$("#SlideShowTbl").sortable({
		items: 'tbody tr',
		cursor: 'move',
		axis: 'y',
		dropOnEmpty: false,
		start: function (e, ui) {
			ui.item.addClass("selected");
		},
		stop: function (e, ui) {
			ui.item.removeClass("selected");
		},
		update: function (event, ui) {
			const SortArray = $(this).sortable('toArray');
			$.ajax({
				data: {
					wp_slideshow_images: SortArray,
					action: 'wp_slideshow_images_ajax',
					nonce: ajax_obj.nonce,
				},
				type : 'POST',
				url  : ajax_obj.url,
			});
		 }
	 });
});
