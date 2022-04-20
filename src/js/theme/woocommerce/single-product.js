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
        $el = self.$el,
        $product = $el.closest( '.product' ),
        $variation_form = $product.find( '.variations_form' ),
        carousel;
      
      if ( $.fn.themeSlider ) {
        carousel = $el.find( '.flex-control-thumbs' ).themeSlider( {
          containerClass: 'show-nav-center',
          items: self.options.items,
          gutter: 10,
          nav: false,
          loop: false
        } );
        if ( $product.hasClass( 'product-view-extended' ) ) {
          carousel = $el.find( '.woocommerce-product-gallery__wrapper' ).themeSlider( $.extend( {
            containerClass: 'show-nav-center',            
            center: $el.find( '.woocommerce-product-gallery__image' ).length === 1 ? true : false,
            nav: false,
            loop: false
          }, $product.data( 'options' ) ) );
          if ( 'function' === typeof $.fn.zoom && wc_single_product_params.zoom_enabled ) {
            var zoom_options = $.extend( {
              touch: false
            }, wc_single_product_params.zoom_options );
      
            if ( 'ontouchstart' in document.documentElement ) {
              zoom_options.on = 'click';
            }

            $el.find( '.woocommerce-product-gallery__image' ).each( function() {
              var $this = $( this ),
                galleryWidth = $this.width(),
                image = $this.find( 'img' );

              $this.trigger( 'zoom.destroy' );
              if ( image.data( 'large_image_width' ) > galleryWidth ) {
                $this.zoom( zoom_options );
              }
            } );            
          }         
        }
      }

      if ( carousel && $variation_form.length ) {
        $variation_form.on( 'update_variation_values', function() {
          setTimeout( function() {
            var slider = $el.data('flexslider');

            if (slider) {
              carousel.get(0).goTo( slider.currentSlide );
            } else {
              carousel.get(0).goTo( 0 );
            }
          }, 200 );
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