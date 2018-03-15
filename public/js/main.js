/* METHODS */

var $window = $(window);
var $header;

function update_header_color() {
	$header.css('background-color', 'hsl(' + ((new Date().getTime() / 100) % 360) + ', 40%, 80%)');
	requestAnimationFrame(update_header_color);
}

/* GENERAL DOCUMENT READY OPERATIONS */

$(document).ready(function(){
	$header = $('header');
});

/* GENERAL WINDOW LOAD OPERATIONS */

$window.load(update_header_color);

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
			method: 'POST',
			params: {}
		};
		var options = $.extend(defaults, options);
		return this.each(function(){
			var $link = $(this);
			var formText = "<form action='"+$link.attr('href')+"' method='POST' style='display:none'>"+
					"<input type='hidden' name='_method' value='"+options.method+"'>";
			for (attr in options.params) {
				formText += "<input name='" + attr + "' value='" + options.params[attr] + "'>";
			}
			formText += "</form>";
			$link.append(formText)
			.removeAttr('href')
			.attr('style','cursor:pointer;')
			.bind('click', function() {if(options.confirm())$(this).find("form").submit();});
		});
	};
})(jQuery);