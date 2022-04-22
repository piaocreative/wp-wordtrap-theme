/*
* Javascript for the sticky
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Sticky
( function ( theme, $ ) {
  'use strict';

  // jQuery Pin plugin
  $.fn.themePin = function ( options ) {
    var scrollY = 0, 
      lastScrollY = 0, 
      elements = [], 
      disabled = false, 
      $window = $( window ), 
      fixedSideTop = [], 
      fixedSideBottom = [], 
      prevDataTo = [];

    options = options || {};

    var recalculateLimits = function () {
      for ( var i = 0, len = elements.length; i < len; i++ ) {
        var $this = elements[ i ];
        if ( options.minWidth && window.innerWidth < options.minWidth ) {
          if ( $this.parent().hasClass( "pin-wrapper" ) ) { $this.unwrap(); }
          $this.css( { width: "", left: "", top: "", position: "" } );
          if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
          $this.removeClass( 'sticky-transition' );
          $this.removeClass( 'sticky-absolute' );
          disabled = true;
          continue;
        } else {
          disabled = false;
        }

        var $container = options.containerSelector ? ( $this.closest( options.containerSelector ).length ? $this.closest( options.containerSelector ) : $( options.containerSelector ) ) : $( document.body ),
          offset = $this.offset(),
          containerOffset = $container.offset();

        if ( typeof containerOffset == 'undefined' ) {
          continue;
        }

        var pad = $.extend( {
          top: 0,
          bottom: 0
        }, options.padding || {} );

        var $pin = $this.parent(),
          parentOffset = $pin.offset(),
          pt = parseInt( $pin.css( 'padding-top' ) ), 
          pb = parseInt( $pin.css( 'padding-bottom' ) );

        if ( options.autoInit ) {
          pad.top = theme.adminBarHeight() + theme.sticky_header_height;
          if ( typeof options.paddingOffsetTop != 'undefined' ) {
            pad.top += parseInt( options.paddingOffsetTop, 10 );
          } else {
            pad.top += 18;
          }
          if ( typeof options.paddingOffsetBottom != 'undefined' ) {
            pad.bottom = parseInt( options.paddingOffsetBottom, 10 );
          } else {
            pad.bottom = 0;
          }
        }

        var o_h = $pin.outerHeight() - $this.innerHeight();
        $this.css( { width: $this.outerWidth() <= $pin.width() ? $this.outerWidth() : $pin.width() } );
        $pin.css( "height", $this.outerHeight() + o_h );

        if ( ( !options.autoFit && !options.fitToBottom ) || $this.outerHeight() <= $window.height() ) {
          $this.data( "themePin", {
            pad: pad,
            from: ( options.containerSelector ? containerOffset.top : offset.top ) - pad.top + pt + parseInt($container.css('padding-top')),
            pt: pt,
            pb: pb,
            parentTop: parentOffset.top - pt,
            offset: o_h
          } );
        } else {
          $this.data( "themePin", {
            pad: pad,
            fromFitTop: ( options.containerSelector ? containerOffset.top : offset.top ) - pad.top + pt + parseInt($container.css('padding-top')),
            from: ( options.containerSelector ? containerOffset.top : offset.top ) + $this.outerHeight() - window.innerHeight + pt + parseInt($container.css('padding-top')),
            pt: pt,
            pb: pb,
            parentTop: parentOffset.top - pt,
            offset: o_h
          } );
        }
      }
    };

    var onScroll = function () {
      if ( disabled ) { return; }

      scrollY = $window.scrollTop();

      var window_height = window.innerHeight || $window.height();

      for ( var i = 0, len = elements.length; i < len; i++ ) {
        var $this = $( elements[ i ] ),
          data = $this.data( "themePin" ),
          sidebarTop;

        if ( !data || typeof data.pad == 'undefined' ) { // Removed element
          continue;
        }

        var $container = options.containerSelector ? ( $this.closest( options.containerSelector ).length ? $this.closest( options.containerSelector ) : $( options.containerSelector ) ) : $( document.body ),
          isFitToTop = ( !options.autoFit && !options.fitToBottom ) || ( $this.outerHeight() + data.pad.top ) <= window_height;
          data.end = $container.offset().top + $container.outerHeight();

        if ( isFitToTop ) {
          data.to = $container.offset().top + $container.outerHeight() - $this.outerHeight() - data.pad.bottom - data.pb + data.pt - parseInt($container.css('padding-bottom'));
        } else {
          data.to = $container.offset().top + $container.outerHeight() - window_height - data.pb + data.pt - parseInt($container.css('padding-bottom'));
          data.to2 = $container.outerHeight() - $this.outerHeight() - data.pad.bottom - data.pb + data.pt - parseInt($container.css('padding-bottom'));
        }

        if ( prevDataTo[ i ] === 0 ) {
          prevDataTo[ i ] = data.to;
        }

        if ( isFitToTop ) {
          var from = data.from - data.pad.bottom,
            to = data.to - data.pad.top - data.offset;
          if ( typeof data.fromFitTop != 'undefined' && data.fromFitTop ) {
            from = data.fromFitTop - data.pad.bottom;
          }

          if ( from + $this.outerHeight() > data.end || from >= to ) {
            $this.css( { position: "", top: "", left: "" } );
            if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
            continue;
          }
          if ( scrollY > from && scrollY < to ) {
            !( $this.css( "position" ) == "fixed" ) && $this.css( {
              left: $this.offset().left,
              top: data.pad.top
            } ).css( "position", "fixed" );
            if ( options.activeClass ) { $this.addClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
          } else if ( scrollY >= to ) {
            $this.css( {
              left: "",
              top: to - data.parentTop + data.pad.top
            } ).css( "position", "absolute" );
            if ( options.activeClass ) { $this.addClass( options.activeClass ); }
            if ( $this.hasClass( 'sticky-absolute' ) ) $this.addClass( 'sticky-transition' );
            $this.addClass( 'sticky-absolute' );
          } else {
            $this.css( { position: "", top: "", left: "" } );
            if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
          }
        } else if ( options.fitToBottom ) {
          var from = data.from,
            to = data.to;
          if ( data.from + window_height > data.end || data.from >= to ) {
            $this.css( { position: "", top: "", bottom: "", left: "" } );
            if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
            continue;
          }
          if ( scrollY > from && scrollY < to ) {
            !( $this.css( "position" ) == "fixed" ) && $this.css( {
              left: $this.offset().left,
              bottom: data.pad.bottom,
              top: ""
            } ).css( "position", "fixed" );
            if ( options.activeClass ) { $this.addClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
          } else if ( scrollY >= to ) {
            $this.css( {
              left: "",
              top: data.to2,
              bottom: ""
            } ).css( "position", "absolute" );
            if ( options.activeClass ) { $this.addClass( options.activeClass ); }
            if ( $this.hasClass( 'sticky-absolute' ) ) $this.addClass( 'sticky-transition' );
            $this.addClass( 'sticky-absolute' );
          } else {
            $this.css( { position: "", top: "", bottom: "", left: "" } );
            if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            $this.removeClass( 'sticky-transition' );
            $this.removeClass( 'sticky-absolute' );
          }
        } else { // auto fit
          var this_height = $this.outerHeight()
          if ( prevDataTo[ i ] != data.to ) {
            if ( fixedSideBottom[ i ] && this_height + $this.offset().top + data.pad.bottom < scrollY + window_height ) {
              fixedSideBottom[ i ] = false;
            }
          }
          if ( ( this_height + data.pad.top + data.pad.bottom ) > window_height || fixedSideTop[ i ] || fixedSideBottom[ i ] ) {
            var padTop = parseInt( $this.parent().parent().css( 'padding-top' ) );
            // Reset the sideSortables style when scrolling to the top.
            if ( scrollY + data.pad.top - padTop <= data.parentTop ) {
              $this.css( { position: "", top: "", bottom: "", left: "" } );
              fixedSideTop[ i ] = fixedSideBottom[ i ] = false;
              if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            } else if ( scrollY >= data.to ) {
              $this.css( {
                left: "",
                top: data.to2,
                bottom: ""
              } ).css( "position", "absolute" );
              if ( options.activeClass ) { $this.addClass( options.activeClass ); }
            } else {

              // When scrolling down.
              if ( scrollY >= lastScrollY ) {
                if ( fixedSideTop[ i ] ) {

                  // Let it scroll.
                  fixedSideTop[ i ] = false;
                  sidebarTop = $this.offset().top - data.parentTop;

                  $this.css( {
                    left: "",
                    top: sidebarTop,
                    bottom: ""
                  } ).css( "position", "absolute" );
                  if ( options.activeClass ) { $this.addClass( options.activeClass ); }
                } else if ( !fixedSideBottom[ i ] && this_height + $this.offset().top + data.pad.bottom < scrollY + window_height ) {
                  // Pin the bottom.
                  fixedSideBottom[ i ] = true;

                  !( $this.css( "position" ) == "fixed" ) && $this.css( {
                    left: $this.offset().left,
                    bottom: data.pad.bottom,
                    top: ""
                  } ).css( "position", "fixed" );
                  if ( options.activeClass ) { $this.addClass( options.activeClass ); }
                }

                // When scrolling up.
              } else if ( scrollY < lastScrollY ) {
                if ( fixedSideBottom[ i ] ) {
                  // Let it scroll.
                  fixedSideBottom[ i ] = false;
                  sidebarTop = $this.offset().top - data.parentTop;

                  $this.css( {
                    left: "",
                    top: sidebarTop,
                    bottom: ""
                  } ).css( "position", "absolute" );
                  if ( options.activeClass ) { $this.addClass( options.activeClass ); }
                } else if ( !fixedSideTop[ i ] && $this.offset().top >= scrollY + data.pad.top ) {
                  // Pin the top.
                  fixedSideTop[ i ] = true;

                  !( $this.css( "position" ) == "fixed" ) && $this.css( {
                    left: $this.offset().left,
                    top: data.pad.top,
                    bottom: ''
                  } ).css( "position", "fixed" );
                  if ( options.activeClass ) { $this.addClass( options.activeClass ); }
                } else if ( !fixedSideBottom[ i ] && fixedSideTop[ i ] && $this.css( 'position' ) == 'absolute' && $this.offset().top >= scrollY + data.pad.top ) {
                  fixedSideTop[ i ] = false;
                }
              }
            }
          } else {
            // If the sidebar container is smaller than the viewport, then pin/unpin the top when scrolling.
            if ( scrollY >= ( data.parentTop - data.pad.top ) ) {
              $this.css( {
                position: 'fixed',
                top: data.pad.top
              } );
            } else {
              $this.css( { position: "", top: "", bottom: "", left: "" } );
              if ( options.activeClass ) { $this.removeClass( options.activeClass ); }
            }

            fixedSideTop[ i ] = fixedSideBottom[ i ] = false;
          }
        }

        prevDataTo[ i ] = data.to;
      }

      lastScrollY = scrollY;
    };

    var update = function () { recalculateLimits(); onScroll(); },
      r_timer = null;

    this.each( function () {
      var $this = $( this ),
        data = $this.data( 'themePin' ) || {};

      if ( data && data.update ) { return; }
      elements.push( $this );
      $( "img", this ).one( "load", function () {
        if ( r_timer ) {
          theme.deleteTimeout( r_timer );
        }
        r_timer = theme.requestFrame( recalculateLimits );
      } );
      data.update = update;
      $this.data( 'themePin', data );
      fixedSideTop.push( false );
      fixedSideBottom.push( false );
      prevDataTo.push( 0 );
    } );

    window.addEventListener( 'touchmove', onScroll, { passive: true } );
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    recalculateLimits();

    if (!theme.initialized) {
      $window.on( 'load', update );
    }

    $( this ).on( 'recalc.pin', function () {
      recalculateLimits();
      onScroll();
    } );

    return this;
  };

  theme = theme || {};

  var instanceName = '__sticky';

  var Sticky = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  Sticky.defaults = {
    autoInit: true,
    minWidth: 768,
    activeClass: 'sticky-active',
    padding: {
      top: 0,
      bottom: 0
    },
    offsetTop: 0,
    offsetBottom: 0,
    autoFit: false,
    fitToBottom: false
  };

  Sticky.prototype = {
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
      this.options = $.extend( true, {}, Sticky.defaults, opts );

      return this;
    },

    build: function () {
      if ( ! $.fn.themePin ) {
        return this;
      }

      var $el = this.$el,
        stickyResizeTrigger;

      $el.themePin( this.options );

      $( window ).smartresize( function () {
        var $parent = $el.parent();

        $el.outerWidth( $parent.width() );
        if ( $el.css( 'position' ) == 'fixed' ) {
          $el.css( 'left', $parent.offset().left );
        }

        if ( stickyResizeTrigger ) {
          clearTimeout( stickyResizeTrigger );
        }
        stickyResizeTrigger = setTimeout( function () {
          $el.trigger( 'recalc.pin' );
        }, 800 );
      } );

      return this;
    }
  };

  // expose to scope
  $.extend( theme, {
    Sticky: Sticky
  } );

  // jquery plugin
  $.fn.themeSticky = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        $this.trigger( 'recalc.pin' );
        setTimeout( function () {
          $this.trigger( 'recalc.pin' );
        }, 800 );

        return $this.data( instanceName );
      } else {
        return new theme.Sticky( $this, opts );
      }

    } );
  }

} )( window.theme, jQuery );