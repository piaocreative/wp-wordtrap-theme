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
        // Product thumbs carousel
        if ( $product.hasClass( 'product-thumbs-carousel' ) ) {
          carousel = $el.find( '.flex-control-thumbs' ).themeSlider( $.extend( {
            items: self.options.items,
            gutter: 10,
            nav: false,
            loop: false
          }, $product.data( 'carousel-options') ) );
        }

        // Product view: Extended
        if ( $product.hasClass( 'product-view-extended' ) ) {
          carousel = $el.find( '.woocommerce-product-gallery__wrapper' ).themeSlider( $.extend( {
            containerClass: 'show-nav-center',            
            center: $el.find( '.woocommerce-product-gallery__image' ).length === 1 ? true : false,
            nav: false,
            loop: false
          }, $product.data( 'slider-options' ) ) );
        }
      }
     
      self.initProductImages();

      // Sticky info
      if ( $product.hasClass( 'product-sticky-info' ) ) {
        $product.find( '.summary' ).css( 'top', theme.adminBarHeight() + theme.sticky_header_height + 15 );

        $( window ).smartresize( function () {
          $product.find( '.summary' ).css( 'top', theme.adminBarHeight() + theme.sticky_header_height + 15 );
        } );
      }

      var slider = $el.data( 'flexslider' );
      if ( slider ) {
        $el.find( '.flex-control-nav li' ).eq(0).addClass( 'active' );
        slider.vars.before = function( slider ) {
          $el.find( '.flex-control-nav li' ).removeClass( 'active' );
          $el.find( '.flex-control-nav li' ).eq( slider.animatingTo ).addClass( 'active' );
        }
      }

      $variation_form.on( 'update_variation_values', function() {
        setTimeout( function() {
          if ( carousel ) {
            if (slider) {
              carousel.get(0).goTo( slider.currentSlide );
            } else {
              carousel.get(0).goTo( 0 );
            }            
          }
          self.initProductImages();
        }, 200 );
      } );      

      return this;
    },

    initProductImages: function() {
      var $el = this.$el,
        $product = $el.closest( '.product' ),
        zoom_options = this.zoomOptions();

      if ( ! ( $product.hasClass( 'product-view-extended' ) || $product.hasClass( 'product-thumbnails-grid' ) ) || ! zoom_options ) {
        return;
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
    },

    zoomOptions: function() {
      if ( 'function' === typeof $.fn.zoom && wc_single_product_params.zoom_enabled ) {
        var zoom_options = $.extend( {
          touch: false
        }, wc_single_product_params.zoom_options );
  
        if ( 'ontouchstart' in document.documentElement ) {
          zoom_options.on = 'click';
        }
        return zoom_options;
      }

      return false;
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