/*
* Javascript for the sidebar 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Sticky Sidebar
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__sticky_sidebar';

  var StickySidebar = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  StickySidebar.defaults = {
    
  };

  StickySidebar.prototype = {
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
      this.options = $.extend( true, {}, StickySidebar.defaults, opts );

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
        gap = 15;

      if ( parseInt( $('#primary').css( 'padding-top' ) ) > gap ) {
        gap = parseInt( $('#primary').css( 'padding-top' ) );
      }
      $el.css( 'top', theme.adminBarHeight() + theme.sticky_header_height + gap );
    }
  };

  // expose to scope
  $.extend( theme, {
    StickySidebar: StickySidebar
  } );

  // jquery plugin
  $.fn.themeStickySidebar = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.StickySidebar( $this, opts );
    } );
  }

} )( window.theme, jQuery );