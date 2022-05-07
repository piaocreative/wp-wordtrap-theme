/*
* Theme initialize
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

function wordtrap_init( $wrap ) {
  ( function ( $ ) {

    if ( !$wrap ) {
      $wrap = jQuery( document.body );
    }
  
    $wrap.trigger( 'wordtrap_init_start' );

    // Fixed header
    if ( $.fn.themeFixedHeader ) {
      $( function () {
        $wrap.find( '.header-fixed' ).each( function () {
          var $this = $( this );
          $this.themeFixedHeader( $this.data( 'options' ) );
        } );
      } );
    }

    // Sticky header
    if ( $.fn.themeStickyHeader ) {
      $( function () {
        $wrap.find( '.header-wrap:not(.header-fixed)' ).each( function () {
          var $this = $( this );
          $this.themeStickyHeader( $this.data( 'options' ) );
        } );
      } );
    }

    // Sticky sidebar
    if ( $.fn.themeStickySidebar ) {
      $( function () {
        $wrap.find( '.sticky-sidebar' ).each( function () {
          var $this = $( this );
          $this.themeStickySidebar( $this.data( 'options' ) );
        } );
      } );
    }

    // Reveal Footer
    if ( $.fn.themeRevealFooter && $wrap.hasClass( 'page-footer-reveal' ) ) {
      $( function () {
        $wrap.each( function () {
          var $this = $( this );
          $this.themeRevealFooter( $this.data( 'options' ) );
        } );
      } );
    }

    // Scroll to Top
    if ( $.fn.themeScrollToTop ) {
      $( function () {
        $wrap.each( function () {
          var $this = $( this );
          $this.themeScrollToTop( $this.data( 'options' ) );
        } );
      } );
    }

    // WhatsApp sharing
    if ( $.fn.themeWhatsAppSharing ) {
      $( function () {
        $wrap.each( function () {
          var $this = $( this );
          $this.themeWhatsAppSharing( $this.data( 'options' ) );
        } );
      } );
    }

    // Posts Filter
    if ( $.fn.themePostsFilter ) {
      $( function () {
        $wrap.find( '.posts-filter-nav' ).each( function () {
          var $this = $( this );
          $this.themePostsFilter( $this.data( 'options' ) );
        } );
      } );
    }

    // Categories Filter
    if ( $.fn.themeCategoriesFilter ) {
      $( function () {
        $wrap.find( '.categories-filter' ).each( function () {
          var $this = $( this );
          $this.themeCategoriesFilter( $this.data( 'options' ) );
        } );
      } );
    }

    // Posts Masonry View
    if ( $.fn.themeMasonry ) {
      $( function () {
        $wrap.find( '.posts-view-masonry:not(.posts-slider)' ).each( function () {
          var $this = $( this ),
            options = $this.data( 'options' );
          
          if ( ! options ) {
            options = {};
          }

          if ( ! options.itemSelector ) {
            options.itemSelector = '.post-wrap';
            options.percentPosition = true;
          }          
          $this.themeMasonry( options );
        } );
      } );
    }

    // Posts Slider
    if ( $.fn.themeSlider ) {
      $( function () {
        $wrap.find( '.posts-slider' ).each( function () {
          var $this = $( this );
          $this.themeSlider( $this.data( 'options' ) );
        } );
      } );
    }

    // Posts Ajax Load
    if ( $.fn.themePostsAjaxLoad ) {
      $( function () {
        $wrap.find( '.posts-pagination-ajax' ).each( function () {
          var $this = $( this );
          $this.themePostsAjaxLoad( $this.data( 'options' ) );
        } );
      } );
    }    

  } )( jQuery );
}

( function ( theme, $ ) {

  'use strict';

  $( window ).on( 'load', function() {
		theme.initialized = true;
	});

  // hide page loading
  $( window ).on( 'load error', function () {
    $( 'body' ).find( '.page-loading-overlay' ).fadeOut( 500, function() {
      $( this ).remove();
      $( 'body' ).removeClass( 'page-loading' );
    } );
  } );

  $( function() {

    wordtrap_init();

  } );

  if ( $.fn.select2 ) {
    $.fn.select2.defaults.set( 'theme', 'bootstrap-5');
  }

} )( window.theme, jQuery );

export default wordtrap_init;