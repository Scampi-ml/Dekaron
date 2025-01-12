/*
 * jQuery Foundation Magellan 0.0.1
 * http://foundation.zurb.com
 * Copyright 2012, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/

/*jslint unparam: true, browser: true, indent: 2 */

;(function ($, window, undefined) {
  'use strict';

  $.fn.foundationMagellan = function(options) {
    var $fixedMagellan = $('[data-magellan-expedition=fixed]'),
    	defaults = {
      threshold: ($fixedMagellan.length) ? $fixedMagellan.outerHeight(true) : 25,
      activeClass: 'active'
    },

    options = $.extend({}, defaults, options);

    // Indicate we have arrived at a destination
    $(document).on('magellan.arrival', '[data-magellan-arrival]', function(e) {
      var $expedition = $(this).closest('[data-magellan-expedition]'),
          activeClass = $expedition.attr('data-magellan-active-class') || options.activeClass;
      $(this)
        .closest('[data-magellan-expedition]')
        .find('[data-magellan-arrival]')
        .not(this)
        .removeClass(activeClass);
      $(this).addClass(activeClass);
    });

    // Set starting point as the current destination
    var $expedition = $('[data-magellan-expedition]');
    $expedition.find('[data-magellan-arrival]:first')
      .addClass($expedition.attr('data-magellan-active-class') || options.activeClass);

    // Update fixed position
    $fixedMagellan.on('magellan.update-position', function(){
      var $el = $(this);
      $el.data("magellan-fixed-position","");
      $el.data("magellan-top-offset", "");
    });

    $fixedMagellan.trigger('magellan.update-position');

    $(window).on('resize.magellan', function() {
      $fixedMagellan.trigger('magellan.update-position');
    });
    
    $(window).on('scroll.magellan', function() {
      var windowScrollTop = $(window).scrollTop();
      $fixedMagellan.each(function() {
        var $expedition = $(this);
        if ($expedition.data("magellan-top-offset") === "") {
          $expedition.data("magellan-top-offset", $expedition.offset().top);
        }
        var fixed_position = (windowScrollTop + options.threshold) > $expedition.data("magellan-top-offset");
        if ($expedition.data("magellan-fixed-position") != fixed_position) {
          $expedition.data("magellan-fixed-position", fixed_position);
          if (fixed_position) {
            $expedition.css({backgroundColor:"black", 'z-index':'99999',  borderRadius:"8px", MozborderRadius:"7px", WebkitborderRadius:"7px", padding:"5px", width:"940px", fontWeight:"bold", position:"fixed", top:60});
          } else {
            $expedition.css({position:"", top:""});
          }
        }
      });
    });

    // Determine when a destination has been reached, ah0y!
    $(window).on('scroll.magellan', function(e){
      var windowScrollTop = $(window).scrollTop();
      $('[data-magellan-destination]').each(function(){
        var $destination = $(this),
            destination_name = $destination.attr('data-magellan-destination'),
            topOffset = $destination.offset().top - windowScrollTop;
        if (topOffset <= options.threshold) {
          $('[data-magellan-arrival=' + destination_name + ']')
            .trigger('magellan.arrival');
        }
      });
    });
  };
}(jQuery, this));
