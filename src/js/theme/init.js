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

    // Reveal Footer
    if ( $.fn.themeRevealFooter && $wrap.hasClass( 'page-footer-reveal' ) ) {
      $( function () {
        $wrap.each( function () {
          var $this = $( this ),
            opts;

          var pluginOptions = $this.data( 'plugin-options' );
          if ( pluginOptions )
            opts = pluginOptions;

          $this.themeRevealFooter( opts );
        } );
      } );
    }
  } )( jQuery );  
}


( function ( theme, $ ) {

  'use strict';

  $( document ).ready( function () {

    wordtrap_init();

    // WhatsApp Sharing
		if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
			$( '.share-whatsapp' ).show();
		}
		$( document ).ajaxComplete( function ( event, xhr, options ) {
			if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
				$( '.share-whatsapp' ).show();
			}
		} );

  } );

} )( window.theme, jQuery );