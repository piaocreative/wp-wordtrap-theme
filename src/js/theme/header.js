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
      var self = this;

      self.resize();
      $( window ).smartresize( function () {
        self.resize()
      } );

      window.addEventListener( 'scroll', function () {
        theme.requestFrame( function () {
          self.scroll();
        } );
      }, { passive: true } );

      return self;
    },

    resize: function () {
      var $el = this.options.wrapper,
        height = $el.outerHeight(),
        html_margin = parseFloat( $( 'html' ).css( 'margin-top' ) );

      $el.css( 'top', html_margin );
      $( 'body' ).css( 'padding-top', height );

      this.scroll();
    },

    scroll: function() {
      var $el = this.options.wrapper,
        scroll_top = $( window ).scrollTop();
          
      if ( $( '#wpadminbar' ).length && $( '#wpadminbar' ).css( 'position' ) == 'absolute' ) {
        $el.stop().css( 'top', ( $( '#wpadminbar' ).height() - scroll_top ) < 0 ? 0 : $( '#wpadminbar' ).height() - scroll_top );
      }
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

// Sticky Header
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__sticky_header';

  var StickyHeader = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  StickyHeader.defaults = {
    breakpoints_sm: theme.breakpoints_sm,
    breakpoints_md: theme.breakpoints_md,
    breakpoints_lg: theme.breakpoints_lg,
    breakpoints_xl: theme.breakpoints_xl,
    breakpoints_xxl: theme.breakpoints_xxl,
    sticky_header_xs: theme.sticky_header_xs,
    sticky_header_sm: theme.sticky_header_sm,
    sticky_header_md: theme.sticky_header_md,
    sticky_header_lg: theme.sticky_header_lg,
    sticky_header_xl: theme.sticky_header_xl,
    sticky_header_xxl: theme.sticky_header_xxl
  };

  StickyHeader.prototype = {
    initialize: function ( $el, opts ) {
      if ( $el.data( instanceName ) ) {
        return this;
      }

      this.$el = $el;
      this.header = this.$el.parent();
      this.header_main = this.$el.find( '#header-main' );

      if ( ! this.header.length || ! this.header_main.length ) {
        return this;
      }

      this
        .setData()
        .setOptions( opts )
        .reset()
        .build()
        .events();

      return this;
    },

    setData: function () {
      this.$el.data( instanceName, this );

      return this;
    },

    setOptions: function ( opts ) {
      this.options = $.extend( true, {}, StickyHeader.defaults, opts, {
        wrapper: this.$el,
      } );

      return this;
    },

    checkVisivility: function() {
      var win_width = window.innerWidth,
        options = this.options;
      
      if ( 
        ( win_width >= options.breakpoints_xxl && ! options.sticky_header_xxl ) || 
        ( win_width >= options.breakpoints_xl && win_width < options.breakpoints_xxl && ! options.sticky_header_xl ) || 
        ( win_width >= options.breakpoints_lg && win_width < options.breakpoints_xl && ! options.sticky_header_lg ) ||  
        ( win_width >= options.breakpoints_md && win_width < options.breakpoints_lg && ! options.sticky_header_md ) ||  
        ( win_width >= options.breakpoints_sm && win_width < options.breakpoints_md && ! options.sticky_header_sm ) ||  
        ( win_width < options.breakpoints_sm && ! options.sticky_header_xs )  
      ) {
        return false;
      }

      return true;
    },

    reset: function() {
      var self = this,
        $el = this.options.wrapper;

      self.header.removeClass( 'sticky-header' );
      self.header.css( 'height', '' );
      $el.stop().css( 'top', 0 );
      
      self.is_sticky = false;
      self.prev_scroll_pos = $( window ).scrollTop();
      
      self.header_height = self.header.height() + parseInt( self.header.css( 'margin-top' ) );
      self.header_main_height = self.header_main.height();
      self.sticky_height = self.header_main.outerHeight();

      if ( ! self.checkVisivility() ) {
        self.sticky_height = 0;
      }

      self.sticky_pos = self.header.offset().top + self.header_height - self.sticky_height - theme.adminBarHeight() + parseInt( self.header.css( 'border-top-width' ) );

      return self;
    },

    build: function () {
      var self = this,
        $el = this.options.wrapper,
        $html = $( 'html' );

      if ( ! self.is_sticky && ( window.innerHeight + self.header_height + theme.adminBarHeight() + parseInt( self.header.css( 'border-top-width' ) ) >= $( document ).height() ) ) {
        return self;
      }

      if ( window.innerHeight > $( document.body ).height() )
        window.scrollTo( 0, 0 );

      var scroll_top = $( window ).scrollTop();

      $html.addClass('sticky-header-active');
      if ( scroll_top > this.prev_scroll_pos ) {
        $html.addClass( 'scroll-down' );
      } else {
        $html.removeClass( 'scroll-down' );
      }

      this.prev_scroll_pos = scroll_top;

      if ( $( '#wpadminbar' ).length && $( '#wpadminbar' ).css( 'position' ) == 'absolute' ) {
        self.header.parent().stop().css( 'top', ( $( '#wpadminbar' ).height() - scroll_top ) < 0 ? -$( '#wpadminbar' ).height() : -scroll_top );
      }
      
      if ( scroll_top > self.sticky_pos && self.checkVisivility() ) {
        if ( ! self.header.hasClass( 'sticky-header' ) ) {
          var header_height = self.header.outerHeight();
          self.header.addClass( 'sticky-header' ).css( 'height', header_height );
          $el.stop().css( 'top', theme.adminBarHeight() );
          self.is_sticky = true;
        }
      } else {
        if ( self.header.hasClass( 'sticky-header' ) ) {
          self.header.removeClass( 'sticky-header' );
          self.header.css( 'height', '' );
          $el.stop().css( 'top', 0 );

          self.is_sticky = false;
        }
      }

      return self;
    },

    events: function () {
      var self = this, win_width = 0;

      $( window ).smartresize( function () {
        if ( win_width != window.innerWidth ) {
          self.reset().build();
          win_width = window.innerWidth;
        }
      } );

      window.addEventListener( 'scroll', function () {
        theme.requestFrame( function () {
          self.build();
        } );
      }, { passive: true } );
    }
  };

  // expose to scope
  $.extend( theme, {
    StickyHeader: StickyHeader
  } );

  // jquery plugin
  $.fn.themeStickyHeader = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.StickyHeader( $this, opts );
    } );
  }

} )( window.theme, jQuery );