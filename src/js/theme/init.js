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

    // Posts Masonry View
    if ( $.fn.themeMasonry ) {
      $( function () {
        $wrap.find( '.posts-view-masonry' ).each( function () {
          var $this = $( this ),
            options = $this.data( 'options' );
          
          if ( ! options ) {
            options = {};
          }
          options.itemSelector = '.post-wrap';
          $this.themeMasonry( options );
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

  $( document ).ready( function () {

    wordtrap_init();    

  } );

} )( window.theme, jQuery );

export default wordtrap_init;