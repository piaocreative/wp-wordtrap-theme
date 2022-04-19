/*
* Javascript for the single product
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Product Image
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__product_image';

  var ProductImage = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  ProductImage.defaults = {
    items: 4
  };

  ProductImage.prototype = {
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
      this.options = $.extend( true, {}, ProductImage.defaults, opts );

      return this;
    },

    build: function () {
      var self = this,
        $el = self.$el;
      
      if ( $.fn.themeSlider ) {
        $el.find( '.flex-control-thumbs' ).themeSlider( {
          containerClass: 'show-nav-center',
          items: self.options.items,
          gutter: 10,
          nav: false,
          loop: false
        } );
      }

      return this;
    }
  };

  // expose to scope
  $.extend( theme, {
    ProductImage: ProductImage
  } );

  // jquery plugin
  $.fn.themeProductImage = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      } else {
        return new theme.ProductImage( $this, opts );
      }
    } );
  }

} )( window.theme, jQuery );