/*
* Javascript for the masonry layout
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

import Isotope from '../isotope';

// Masonry
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__masonry';

  var Masonry = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  Masonry.defaults = {
    itemSelector: 'li'
  };

  Masonry.prototype = {
    initialize: function ( $el, opts ) {
      if ( $el.data( instanceName ) ) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions( opts )
        .build();

      return this;
    },

    setData: function () {
      this.$el.data( instanceName, this );

      return this;
    },

    setOptions: function ( opts ) {
      this.options = $.extend( true, {}, Masonry.defaults, opts );

      return this;
    },

    build: function () {
      if ( ! Isotope && ! $.fn.imagesLoaded ) {
        return this;
      }

      var $el = this.$el,
        el = $el.get(0);

      $el.imagesLoaded( function() {
        var isotope = new Isotope( el, this.options );
        isotope.on( 'layoutComplete', function () {
          if ( typeof this.options.callback == 'function' ) {
            this.options.callback.call();
          }
        } );
  
        $el.data('isotope', isotope);
      } );

      return this;
    }
  };

  // expose to scope
  $.extend( theme, {
    Masonry: Masonry
  } );

  // jquery plugin
  $.fn.themeMasonry = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      } else {
        return new theme.Masonry( $this, opts );
      }
    } );
  }

} )( window.theme, jQuery );
