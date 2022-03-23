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

