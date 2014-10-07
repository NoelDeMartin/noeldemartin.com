/* GENERAL DOCUMENT READY OPERATIONS */
$(document).ready(function(){

  // Nothing to do!

});

/* GENERAL WINDOW LOAD OPERATIONS */
$(window).load(function(){

    // Nothing to do!

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
 *     <a href="users" data-method="delete" data-datum="2">destroy</a>
 *     // Will trigger the route Route::delete('users')
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