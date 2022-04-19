/*
* Javascript for woocommerce
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

function wordtrap_woocommerce_init( $wrap ) {
  ( function ( $ ) {

    if ( !$wrap ) {
      $wrap = jQuery( document.body );
    }
  
    $wrap.trigger( 'wordtrap_woocommerce_init_start' );

    // Quantity Input
    if ( $.fn.themeQuantityInput ) {
      $( function () {
        $wrap.find( '.quantity' ).each( function () {
          var $this = $( this );
          $this.themeQuantityInput( $this.data( 'options' ) );
        } );
      } );
    }

    // Product Image
    if ( $.fn.themeProductImage ) {
      $( function () {
        $wrap.find( '.woocommerce-product-gallery' ).each( function () {
          var $this = $( this );
          $this.themeProductImage( { items: $this.data( 'columns' ) } );
        } );
      } );
    }

  } )( jQuery );
}

( function ( theme, $ ) {

  'use strict';

  $( function() {

    wordtrap_woocommerce_init();

  } );

} )( window.theme, jQuery );

export default wordtrap_woocommerce_init;