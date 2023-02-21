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

  $( function( $ ) {
    $.scroll_to_notices = function( scrollElement ) {
      theme.scrollToElement( scrollElement );
    };
  } );  

} )( window.theme, jQuery );

export default wordtrap_woocommerce_init;