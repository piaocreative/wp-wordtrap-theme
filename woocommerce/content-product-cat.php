<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
?>
<div class="category-wrap">
  <div <?php wc_product_cat_class( '', $category ); ?>>
    <div class="category-thumbnail">
      <?php
      /**
       * The woocommerce_before_subcategory hook.
       *
       * @hooked woocommerce_template_loop_category_link_open - 10 : Removed
       */
      do_action( 'woocommerce_before_subcategory', $category );

      /**
       * The woocommerce_before_subcategory_title hook.
       *
       * @hooked woocommerce_subcategory_thumbnail - 10
       */
      do_action( 'woocommerce_before_subcategory_title', $category );
      ?>
    </div>

    <div class="category-inner">

      <div class="category-detail-top">
        <?php
        /**
         * The woocommerce_shop_loop_subcategory_title hook.
         *
         * @hooked woocommerce_template_loop_category_title - 10
         */
        do_action( 'woocommerce_shop_loop_subcategory_title', $category );
        ?>
      </div>

      <div class="category-detail-bottom">
        <?php
        /**
         * The woocommerce_after_subcategory_title hook.
         */
        do_action( 'woocommerce_after_subcategory_title', $category );

        /**
         * The woocommerce_after_subcategory hook.
         *
         * @hooked woocommerce_template_loop_category_link_close - 10 : Removed
         */
        do_action( 'woocommerce_after_subcategory', $category );
        ?>
      </div>
    </div>
  </div>
</div>
