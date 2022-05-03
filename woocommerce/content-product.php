<?php
/**
 * The template for displaying product content within loops
 *
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
  return;
}

?>
<div class="product-wrap">
  <div <?php wc_product_class( '', $product ); ?>>
    <div class="product-thumbnail">
      <?php
      /**
       * Hook: woocommerce_before_shop_loop_item.
       *
       * @hooked woocommerce_template_loop_product_link_open - 10 : Removed
       */
      do_action( 'woocommerce_before_shop_loop_item' );

      /**
       * Hook: woocommerce_before_shop_loop_item_title.
       *
       * @hooked woocommerce_show_product_loop_sale_flash - 10
       * @hooked woocommerce_template_loop_product_thumbnail - 10
       */
      do_action( 'woocommerce_before_shop_loop_item_title' );
      ?>
    </div>

    <div class="product-inner">

      <div class="product-detail-top">
      
        <?php
        /**
         * Hook: woocommerce_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        ?>

      </div>

      <div class="product-detail-bottom">

        <div class="detail-left">
          <?php
          /**
           * Hook: woocommerce_after_shop_loop_item_title.
           *
           * @hooked woocommerce_template_loop_rating - 5
           * @hooked woocommerce_template_loop_price - 10
           */
          do_action( 'woocommerce_after_shop_loop_item_title' );
          ?>
        </div>

        <div class="detail-right">
          <?php
          /**
           * Hook: woocommerce_after_shop_loop_item.
           *
           * @hooked woocommerce_template_loop_product_link_close - 5 : Removed
           * @hooked woocommerce_template_loop_add_to_cart - 10
           */
          do_action( 'woocommerce_after_shop_loop_item' );
          ?>
        </div>

      </div>
      
    </div>
  </div>
</div>
