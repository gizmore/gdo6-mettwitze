"use strict"
$(function(){
	window.GDO.Mettwitze = {
		'revealJoke': function(id) {
			$('#joke_'+id).animate({
				opacity: 1.0,
			}, 1500, function() {
			});
		}
	};
});
