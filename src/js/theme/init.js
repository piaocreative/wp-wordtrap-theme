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
          var $this = $( this ),
            opts;

          var pluginOptions = $this.data( 'plugin-options' );
          if ( pluginOptions )
            opts = pluginOptions;

          $this.themeFixedHeader( opts );
        } );
      } );
    }

    // Sticky header
    if ( $.fn.themeStickyHeader ) {
      $( function () {
        $wrap.find( '.header-wrap:not(.header-fixed)' ).each( function () {
          var $this = $( this ),
            opts;

          var pluginOptions = $this.data( 'plugin-options' );
          if ( pluginOptions )
            opts = pluginOptions;

          $this.themeStickyHeader( opts );
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