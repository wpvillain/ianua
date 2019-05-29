(function($) {
	'use strict';
	// Site title
	wp.customize('blogname', function(value) {
	value.bind(function(to) {
	  $('.brand').text(to);
	});
	});	

})(jQuery);
