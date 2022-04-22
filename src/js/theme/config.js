/*
* Theme configuration
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

/* easing */
jQuery.extend( jQuery.easing, {
  def: 'easeOutQuad',
  swing: function ( x, t, b, c, d ) {
    return jQuery.easing[ jQuery.easing.def ]( x, t, b, c, d );
  },
  easeOutQuad: function ( x, t, b, c, d ) {
    return -c * ( t /= d ) * ( t - 2 ) + b;
  },
  easeInOutQuart: function ( x, t, b, c, d ) {
    if ( ( t /= d / 2 ) < 1 ) return c / 2 * t * t * t * t + b;
    return -c / 2 * ( ( t -= 2 ) * t * t * t - 2 ) + b;
  },
  easeOutQuint: function ( x, t, b, c, d ) {
    return c * ( ( t = t / d - 1 ) * t * t * t * t + 1 ) + b;
  }
} );

// Theme
window.theme = {};

( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  $.extend( theme, {

    // Loading
    initialized: false,

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

    sticky_header_height: 0,

    // Woocommerce
    product_thumbnails_columns: parseInt( wordtrap_vars.product_thumbnails_columns ),

    // Messages
    loading: wordtrap_vars.loading,
    
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

    scrollToElement: function ( $element, timeout ) {
      if ( $element.length ) {
        $( 'html, body' ).stop().animate( {
          scrollTop: $element.offset().top - theme.adminBarHeight() - theme.sticky_header_height - parseInt( $( '#primary').css( 'margin-top' ) ) || 0
        }, timeout, 'easeOutQuad' );
      }
    },

    addLoading: function ( $element ) {
      if ( $element.length ) {
        $element.addClass('ajax-loading-container');
        $element.append( '<div class="ajax-loading"><div role="status"><span class="visually-hidden">' + theme.loading + '</span></div></div>' );
      }
    },

    removeLoading: function ( $element ) {
      if ( $element.length ) {
        $element.find( '> .ajax-loading').remove();
        $element.removeClass('ajax-loading-container');        
      }
    },

    requestFrame: function ( fn ) {
      var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;
      if ( !handler ) {
        return setTimeout( fn, 1000 / 60 );
      }
      var rt = new Object()
      rt.val = handler( fn );
      return rt;
    },

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

