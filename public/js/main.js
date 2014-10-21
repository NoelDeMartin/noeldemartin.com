/* GENERAL DOCUMENT READY OPERATIONS */
$(document).ready(function(){

	header = $('header');
	setInterval(update_header_color, 100);

});

/* GENERAL WINDOW LOAD OPERATIONS */
$(window).load(function(){

	// Nothing to do!

});

/* METHODS */

var header, header_color_hue = Math.floor(Math.random() * (360));

function update_header_color() {
	header_color_hue = (header_color_hue + 1) % 360;
	header.css('background-color', 'hsl(' + header_color_hue + ', 40%, 80%)');
}

/* JQUERY PLUGINS */
/**
 * =========================================================
 * Restfulize.js - https://gist.github.com/froztbytes/5385905
 * =========================================================
 * Taken from http://paste.laravel.com/b8n
 * and added a datum attr to submit data along with the RESTful request
 *
 * Restfulize any hiperlink that contains a data-method attribute by
 * creating a mini form with the specified method and adding a trigger
 * within the link.
 * Requires jQuery!
 *
 * Ex in Laravel:
 *	 <a href="users" data-method="delete" data-datum="2">destroy</a>
 *	 // Will trigger the route Route::delete('users')
 *
 */
(function($){
	$.fn.restfulize = function (options) {
		var defaults = {
			confirm: function() { return true; },
			method: 'POST'
		};
		var options = $.extend(defaults, options);
		return this.each(function(){
			var $link = $(this);
			$link.append(
				"<form action='"+$link.attr('href')+"' method='POST' style='display:none'>"+
				  "<input type='hidden' name='_method' value='"+options.method+"'>"+
				"</form>")
			.removeAttr('href')
			.attr('style','cursor:pointer;')
			.bind('click', function() {if(options.confirm())$(this).find("form").submit();});
		});
	};
})(jQuery);