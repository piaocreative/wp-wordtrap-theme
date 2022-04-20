/*
* Javascript for the slider
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

import {tns} from '../tiny-slider';

// Slider
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__slider';

  var Slider = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  // https://github.com/ganlanyuan/tiny-slider#options
  Slider.defaults = $.extend( {}, {
    container: '.slider',
    containerClass: '',
    mode: 'carousel',
    axis: 'horizontal',
    items: 1,
    gutter: 0,
    edgePadding: 0,
    fixedWidth: false,
    autoWidth: false,
    viewportMax: false,
    slideBy: '1',
    center: false,
    controls: true,
    controlsPosition: 'top',
    controlsText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    controlsContainer: false,
    prevButton: false,
    nextButton: false,
    nav: true,
    navPosition: 'bottom',
    navContainer: false,
    navAsThumbnails: false,
    arrowKeys: false,
    speed: 300,
    autoplay: false,
    autoplayPosition: 'top',
    autoplayTimeout: 5000,
    autoplayDirection: 'forward',
    autoplayText: ['<i class="fa fa-play"></i>', '<i class="fa fa-stop"></i>'],
    autoplayHoverPause: false,
    autoplayButton: false,
    autoplayButtonOutput: false,
    autoplayResetOnVisibility: true,
    animateIn: 'tns-fadeIn',
    animateOut: 'tns-fadeOut',
    animateNormal: 'tns-normal',
    animateDelay: false,
    loop: true,
    rewind: false,
    autoHeight: false,
    autoInnerHeight: false,
    responsive: false,
    lazyload: false,
    lazyloadSelector: '.tns-lazy-img',
    touch: true,
    mouseDrag: false,
    swipeAngle: 15,
    preventActionWhenRunning: false,
    preventScrollOnTouch: false,
    nested: false,
    freezable: true,
    disable: false,
    startIndex: 0,
    onInit: false,
    useLocalStorage: false,
    nonce: false
  } );

  Slider.prototype = {
    initialize: function ( $el, opts ) {
      if ( $el.data( instanceName ) ) {
        return this;
      }

      this.$el = $el;
      this.slider = false;

      this
        .setData()
        .setOptions( opts )
        .build();

      return this;
    },

    setData: function () {
      this.$el.data( instanceName, true );

      return this;
    },

    setOptions: function ( opts ) {

      this.options = $.extend( true, {}, Slider.defaults, opts );

      return this;
    },

    build: function () {
      if ( ! tns ) {
        return this;
      }

      var self = this,
        $el = self.$el,
        options = self.options,
        sm = options.sm,
        md = options.md,
        lg = options.lg,
        xl = options.xl,
        xxl = options.xxl;

      options.container = $el.get(0);
      $( options.container ).parent().addClass( this.options.containerClass );
      
      if ( ( sm || md || lg || xl || xxl ) && !options.responsive) {
        options.responsive = {};
      }
      if ( sm ) options.responsive[theme.breakpoints_sm] = sm;
      if ( md ) options.responsive[theme.breakpoints_md] = md;
      if ( lg ) options.responsive[theme.breakpoints_lg] = lg;
      if ( xl ) options.responsive[theme.breakpoints_xl] = xl;
      if ( xxl ) options.responsive[theme.breakpoints_xxl] = xxl;
      
      if ( options.autoHeight && options.autoInnerHeight ) {
        options.onInit = self.calcHeight;
      }

      var slider = tns( options );

      if ( options.autoHeight && options.autoInnerHeight ) {
        if ( options.mode == 'gallery' ) {
          slider.events.on( 'indexChanged', self.initHeight );
          slider.events.on( 'indexChanged', self.calcHeight );
        } else {
          slider.events.on( 'indexChanged', self.initHeight );
          slider.events.on( 'transitionStart', self.initHeight );
          slider.events.on( 'transitionEnd', self.calcHeight );
        }
        $( window ).smartresize( function() {
          slider.goTo( 'next' );
        });
      }

      this.slider = slider;

      return this;
    },

    initHeight: function( info, eventName ) {
      var slider_id = info.container.id,
        $outer = $('#' + slider_id + '-ow');

        $outer.find( '.tns-item' ).stop().css( { height: 'auto' } );
    },

    calcHeight: function( info, eventName ) {
      var slider_id = info.container.id,
        $middle = $('#' + slider_id + '-mw'),
        $inner = $('#' + slider_id + '-iw');

      setTimeout( function() {
        if ( $middle.length ) {
          $middle.find( '.tns-item.tns-slide-active' ).stop().css( { height: $middle.height() } );
        } else if ( $inner.length ) {
          $inner.find( '.tns-item.tns-slide-active' ).stop().css( { height: $inner.height() } );
        }
      }, 0);
    },

    goTo: function( index ) {
      this.slider.goTo( index);

      return this;
    }

  };

  // expose to scope
  $.extend( theme, {
    Slider: Slider
  } );

  // jquery plugin
  $.fn.themeSlider = function ( opts ) {
    return this.map( function () {
      var $this = $( this );

      if ( $this.data( instanceName ) ) {
        return $this;
      } else {
        return new theme.Slider( $this, opts );
      }

    } );
  };

} )( window.theme, jQuery );