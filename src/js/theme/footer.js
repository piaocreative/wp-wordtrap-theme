/*
* Javascript for the footer 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Reveal Footer
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__reveal_footer';

  var RevealFooter = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  RevealFooter.defaults = {
    
  };

  RevealFooter.prototype = {
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
      this.options = $.extend( true, {}, RevealFooter.defaults, opts );

      return this;
    },

    build: function () {
      var self = this;

      self.resize();
      $( window ).smartresize( function () {
        self.resize()
      } );

      return self;
    },

    resize: function () {
      var $el = this.$el,
        $page = $el.find( '#page' ),
        height = $el.find( '#footer' ).height(),
        screen_height = window.innerHeight - theme.adminBarHeight() - theme.sticky_header_height;

      if (height < screen_height) {
        $('body').addClass('page-footer-reveal');
        $page.css( 'margin-bottom', height );
      } else {
        $('body').removeClass('page-footer-reveal');
        $page.css( 'margin-bottom', 0 );
      }
    }
  };

  // expose to scope
  $.extend( theme, {
    RevealFooter: RevealFooter
  } );

  // jquery plugin
  $.fn.themeRevealFooter = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.RevealFooter( $this, opts );
    } );
  }

} )( window.theme, jQuery );