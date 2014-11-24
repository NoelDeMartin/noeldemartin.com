/* METHODS */

var $window = $(window);
var $body, $header, $nav, $mainContent;
var header_timer_id, header_animation_running = false;

function start_header_animation() {
	header_animation_running = true;
	header_timer_id = setInterval(update_header_color, 100);
}

function stop_header_animation() {
	header_animation_running = false;
	clearInterval(header_timer_id);
}

function update_header_color() {
	$header.css('background-color', 'hsl(' + ((new Date().getTime() / 100) % 360) + ', 40%, 80%)');
}

function update_navigation_bar() {
	if ($window.scrollTop() > $header.height()) {
		$body.addClass('navigation-stuck');
		$mainContent.css('margin-top', $('nav').height() + 'px');
		if (header_animation_running) {
			stop_header_animation();
		}
	} else {
		$body.removeClass('navigation-stuck');
		$mainContent.css('margin-top', '0');
		if (!header_animation_running) {
			start_header_animation();
		}
	}
}

/* GENERAL DOCUMENT READY OPERATIONS */

$(document).ready(function(){

	$body = $('body');
	$header = $('header');
	$nav = $('nav');
	$mainContent = $('#main-content');

});

/* GENERAL WINDOW LOAD OPERATIONS */

$window.load(function(){

	update_navigation_bar();
	$('header h1').fitText(0.7);
	$window.scroll(update_navigation_bar);

});

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

/**
 * =========================================================
 * FitText.js 1.2 - https://github.com/davatron5000/FitText.js
 * =========================================================
 *
 * Copyright 2011, Dave Rupert http://daverupert.com
 * Released under the WTFPL license
 * http://sam.zoy.org/wtfpl/
 *
 * Date: Thu May 05 14:23:00 2011 -0600
 */

(function($){

	$.fn.fitText = function(kompressor, options) {

		// Setup options
		var compressor = kompressor || 1,
				settings = $.extend({
					'minFontSize': Number.NEGATIVE_INFINITY,
					'maxFontSize': Number.POSITIVE_INFINITY
				}, options);

		return this.each(function(){
			// Store the object
			var $this = $(this);

			// Resizer() resizes items based on the object width divided by the compressor * 10
			var resizer = function () {
				$this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
			};

			// Call once to set.
			resizer();

			// Call on resize. Opera debounces their resize by default.
			$(window).on('resize.fittext orientationchange.fittext', resizer);
		});
	};
})(jQuery);