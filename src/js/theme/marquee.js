/*
* Javascript for the marquee
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

import 'jquery.marquee';

// Marquee
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__marquee';

  var Marquee = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  Marquee.defaults = $.extend( {}, {
    allowCss3Support: true,
    css3easing: 'linear',
    easing: 'linear',
    delayBeforeStart: 1000,
    direction: 'left',
    duplicated: false,
    duration: 5000,
    speed: 0,
    gap: 20,
    pauseOnCycle: false,
    pauseOnHover: false,
    startVisible: false
  } );

  Marquee.prototype = {
    initialize: function ( $el, opts ) {
      if ( $el.data( instanceName ) ) {
        return this;
      }

      this.$el = $el;
      this.marquee = false;

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

      this.options = $.extend( true, {}, Marquee.defaults, opts );

      return this;
    },

    build: function () {
      var self = this,
        $el = self.$el,
        options = self.options;
      
      $el.css( 'overflow', 'hidden' );
      var marquee = $el.marquee( options );

      this.marquee = marquee;

      return this;
    },
  };

  // expose to scope
  $.extend( theme, {
    Marquee: Marquee
  } );

  // jquery plugin
  $.fn.themeMarquee = function ( opts ) {
    return this.map( function () {
      var $this = $( this );

      if ( $this.data( instanceName ) ) {
        return $this;
      } else {
        return new theme.Marquee( $this, opts );
      }

    } );
  };

} )( window.theme, jQuery );