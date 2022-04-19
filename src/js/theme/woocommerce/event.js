/*
* Javascript for events
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

import { Modal, Toast } from '../../bootstrap';

function wordtrap_woocommerce_events() {
  ( function ( $ ) {

    // Add view cart on thumbnail
    $( document.body ).on( 'added_to_cart', function( e, fragments, cart_hash, $button ) {

      var $view_cart_button = $button.parent().find( '.added_to_cart' );
      if ( ! wc_add_to_cart_params.is_cart && $view_cart_button.length ) {
        var $cart_modal = $( '#modal-cart-notification' ),
          $cart_toast = $( '#toast-cart-notification' ),
          $product = $button.closest( '.product' ),
          $product_thumbnail = $product.find( '.product-thumbnail' );

        if ( $cart_modal.length ) {
          var modal = new Modal($cart_modal.get(0)),
            $cart_link = $cart_modal.find( '.cart-link' ),
            $thumbail = $cart_modal.find( '.product-thumbnail' );
          
          $cart_modal.find( '.product-title' ).html( $product.find( '.woocommerce-loop-product__title' ).html() );
          $thumbail.html( '' );
          $thumbail.append( $product_thumbnail.find( 'img' ).clone().get(0) );
          $view_cart_button.addClass( 'btn btn-primary' ).removeClass( 'added_to_cart' );
          $cart_link.html( '' );
          $cart_link.append( $view_cart_button );
          
          modal.show();

          setTimeout(function(){
            modal.hide();
          }, 4000);
          return;
        }

        if ( $cart_toast.length ) {
          var $toast = $cart_toast.clone(),
            $cart_link = $toast.find( '.cart-link' ),
            $thumbail = $toast.find( '.product-thumbnail' );
          
          $toast.removeAttr( 'id' );
          $toast.find( '.product-title' ).html( $product.find( '.woocommerce-loop-product__title' ).html() );
          $thumbail.html( '' );
          $thumbail.append( $product_thumbnail.find( 'img' ).clone().get(0) );
          $view_cart_button.addClass( 'btn btn-primary btn-sm' ).removeClass( 'added_to_cart' );
          $cart_link.html( '' );
          $cart_link.append( $view_cart_button );
          $( '.toast-cart-notification-wrap').append( $toast );

          var toast = new Toast($toast.get(0));
          toast.show();
          return;
        }

        if ( $button.closest( '.product-thumbnail').length ) {
          return;
        }

        if ( $product_thumbnail.length ) {
          if ( $product_thumbnail.find( '.added_to_cart' ).length === 0 ) {
            $product_thumbnail.append( $view_cart_button );
          } else {
            $view_cart_button.remove();
          }
        }
      }
    } );

    // Add quantity input
    $( document.body ).on( 'should_send_ajax_request.adding_to_cart', function( e, $button ) {
      var $quantity = $button.prev();

      if ( $quantity.length && $quantity.hasClass( 'quantity' ) ) {
        var $qty = $quantity.find( '.qty' );

        if ( ! $qty.length) {
          return false;
        }
        
        $button.attr( 'data-quantity', $qty.val() );
      }

      return true;
    } );    

  } )( jQuery );
}

( function ( theme, $ ) {

  'use strict';

  $( function() {

    wordtrap_woocommerce_events();

  } );

} )( window.theme, jQuery );