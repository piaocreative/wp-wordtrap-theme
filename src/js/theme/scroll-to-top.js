/*
* Javascript for the scroll to top 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Scroll to Top
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__scroll_to_top';

  var ScrollToTop = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  ScrollToTop.defaults = {
    icon : 'fas fa-chevron-up',
    trigger : 300,
    id: 'scroll-to-top',
    activeClass : 'show',
    offsetX: 15,
    offsetY: 15,
    transitionDuration : 300,
    scrollDuration : 300
  };

  ScrollToTop.prototype = {
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
      this.options = $.extend( true, {}, ScrollToTop.defaults, opts );

      return this;
    },

    build: function () {
      var self = this;

      var btn = $( '<div id="' + self.options.id + '"></div>' );

      btn.prepend( '<i class="' + self.options.icon + '"></i>' );
      btn.addClass( self.options.class );
      btn.css( {
        transitionDuration: self.options.transitionDuration + 'ms',
        right: self.options.offsetX,
        bottom: self.options.offsetY
      } );
        
      $( window ).on( 'scroll', function() {
        if ( $( window ).scrollTop() > self.options.trigger ) {
          btn.addClass( self.options.activeClass );
        } else {
          btn.removeClass( self.options.activeClass );
        }
      } );    
    
      btn.on( 'click', function( e ) {    
        e.preventDefault();
        $( 'html, body' ).stop().animate( {
          scrollTop: 0
        }, self.options.scrollDuration, 'easeOutQuad' );
      } );

      self.$el.append( btn );

      return self;
    }
  };

  // expose to scope
  $.extend( theme, {
    ScrollToTop: ScrollToTop
  } );

  // jquery plugin
  $.fn.themeScrollToTop = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.ScrollToTop( $this, opts );
    } );
  }

} )( window.theme, jQuery );