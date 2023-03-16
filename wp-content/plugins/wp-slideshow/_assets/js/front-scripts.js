/**
 * WordPress Slideshow front script file
 */

jQuery( function ( $ )  {
	$( '.slideshow-images' ).slick({
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true
	});
} );
