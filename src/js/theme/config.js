/*
* Theme configuration
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Theme
window.theme = {};

( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  $.extend( theme, {

    // Breackpoints
    breakpoints_sm: parseInt( wordtrap_vars.breakpoints_sm ),
    breakpoints_md: parseInt( wordtrap_vars.breakpoints_md ),
    breakpoints_lg: parseInt( wordtrap_vars.breakpoints_lg ),
    breakpoints_xl: parseInt( wordtrap_vars.breakpoints_xl ),
    breakpoints_xxl: parseInt( wordtrap_vars.breakpoints_xxl ),

    // Sticky header
    sticky_header_xs: parseInt( wordtrap_vars.sticky_header_xs ),
    sticky_header_sm: parseInt( wordtrap_vars.sticky_header_sm ),
    sticky_header_md: parseInt( wordtrap_vars.sticky_header_md ),
    sticky_header_lg: parseInt( wordtrap_vars.sticky_header_lg ),
    sticky_header_xl: parseInt( wordtrap_vars.sticky_header_xl ),
    sticky_header_xxl: parseInt( wordtrap_vars.sticky_header_xxl ),
    
    // Request timeout
    requestTimeout: function ( fn, delay ) {
      var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
      if ( !handler ) {
        return setTimeout( fn, delay );
      }
      var start, rt = new Object();

      function loop( timestamp ) {
        if ( !start ) {
          start = timestamp;
        }
        var progress = timestamp - start;
        progress >= delay ? fn.call() : rt.val = handler( loop );
      };

      rt.val = handler( loop );
      return rt;
    },

    // Delete timeout
    deleteTimeout: function ( timeoutID ) {
      if ( !timeoutID ) {
        return;
      }
      var handler = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame;
      if ( !handler ) {
        return clearTimeout( timeoutID );
      }
      if ( timeoutID.val ) {
        return handler( timeoutID.val );
      }
    },

    // Admin bar height
    adminBarHeight: function () {
      var obj = document.getElementById( 'wpadminbar' );
      if ( obj && obj.offsetHeight && window.innerWidth > 600 ) {
        return obj.offsetHeight;
      }

      return 0;
    },

    // Request frame
    requestFrame: function ( fn ) {
			var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
			if ( ! handler ) {
				return setTimeout( fn, 1000 / 60 );
			}
			var rt = new Object()
			rt.val = handler( fn );
			return rt;
		},
  } );

} )( window.theme, jQuery );

/* Smart Resize  */
( function ( $, theme, sr ) {
  'use strict';

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function ( func, threshold, execAsap ) {
    var timeout;

    return function debounced() {
      var obj = this, args = arguments;
      function delayed() {
        if ( !execAsap )
          func.apply( obj, args );
        timeout = null;
      }

      if ( timeout && timeout.val )
        theme.deleteTimeout( timeout );
      else if ( execAsap )
        func.apply( obj, args );

      timeout = theme.requestTimeout( delayed, threshold || 100 );
    };
  };
  // smartresize 
  jQuery.fn[ sr ] = function ( fn ) { return fn ? this.on( 'resize', debounce( fn ) ) : this.trigger( sr ); };
} )( jQuery, window.theme, 'smartresize' );

