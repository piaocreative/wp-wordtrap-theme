/*
* Javascript for the header 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Fixed Header
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__fixed_header';

  var FixedHeader = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  FixedHeader.defaults = {
    
  };

  FixedHeader.prototype = {
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
      this.options = $.extend( true, {}, FixedHeader.defaults, opts, {
        wrapper: this.$el
      } );

      return this;
    },

    build: function () {
      var self = this,
        $el = this.options.wrapper;

      self.resize();
      $( window ).smartresize( function () {
        self.resize()
      } );

      return this;
    },

    resize: function () {
      var $el = this.options.wrapper,
        height = $el.outerHeight(),
        html_margin = parseFloat( $( 'html' ).css( 'margin-top' ) );

      $el.css( 'top', html_margin );
      $( 'body' ).css( 'padding-top', height );
    }
  };

  // expose to scope
  $.extend( theme, {
    FixedHeader: FixedHeader
  } );

  // jquery plugin
  $.fn.themeFixedHeader = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.FixedHeader( $this, opts );
    } );
  }

} )( window.theme, jQuery );