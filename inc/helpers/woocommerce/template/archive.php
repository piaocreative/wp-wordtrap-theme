<?php
/**
 * WooCommerce single products template functions and hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Wrap the products
add_action( 'woocommerce_before_shop_loop', 'wordtrap_wrap_start_products', 1 );
add_action( 'woocommerce_after_shop_loop', 'wordtrap_wrap_end_products', 100 );

if ( ! function_exists( 'wordtrap_wrap_start_products' ) ) {
  /**
   * Display the start of the products
   */
  function wordtrap_wrap_start_products() {
    $pagination = wordtrap_options( 'products-pagination' );
    if ( $pagination ) : ?>
      <div class="posts-pagination-container posts-pagination-<?php echo esc_attr( $pagination ) ?>">
    <?php 
    endif;
  }
}

if ( ! function_exists( 'wordtrap_wrap_end_products' ) ) {
  /**
   * Display the end of the products
   */
  function wordtrap_wrap_end_products() {
    $pagination = wordtrap_options( 'products-pagination' );
    if ( $pagination ) : ?>
      </div><!-- .posts-pagination-container -->
    <?php 
    endif;
  }
}

// Unhook the products result count and ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Unhook product link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Hook the product loop item title
add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_categories', 1 );
if ( ! function_exists( 'wordtrap_shop_loop_item_categories' ) ) {
  /**
   * Add categories in list mode
   */
  function wordtrap_shop_loop_item_categories() {
    global $product;

    if ( wordtrap_options( 'products-categories' ) ) {
      echo '<span class="category-list">' . wc_get_product_category_list( $product->get_id(), ', ', '' ) . '</span>';
    }
  }
}

add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_rating_after_title', 15 );
if ( ! function_exists( 'wordtrap_shop_loop_item_rating_after_title' ) ) {
  /**
   * Add rating in list mode
   */
  function wordtrap_shop_loop_item_rating_after_title() {
    global $product;

    // View mode
    $view_mode = wc_get_loop_prop( 'view-mode', wordtrap_get_view_mode() );

    if ( $view_mode === 'list' && wordtrap_options( 'products-rating' ) ) {
      woocommerce_template_loop_rating();
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    }
  }
}

add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_description_after_title', 20 );
if ( ! function_exists( 'wordtrap_shop_loop_item_description_after_title' ) ) {
  /**
   * Add description in list mode
   */
  function wordtrap_shop_loop_item_description_after_title() {
    global $product;

    // View mode
    $view_mode = wc_get_loop_prop( 'view-mode', wordtrap_get_view_mode() );

    if ( $view_mode === 'list' ) {
      woocommerce_template_single_excerpt();
    }
  }
}

// Hook product link
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 100 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );

// Add a class for the rating in the product title
add_filter( 'woocommerce_product_loop_title_classes', 'wordtrap_add_product_rating_title_class', 10 );
if ( ! function_exists( 'wordtrap_add_product_rating_title_class' ) ) {
  /**
   * Add a class for the rating
   */
  function wordtrap_add_product_rating_title_class( $classes ) {
    global $product;

    // View mode
    $view_mode = wc_get_loop_prop( 'view-mode', wordtrap_get_view_mode() );

    if ( $view_mode === 'grid' && wordtrap_options( 'products-rating' ) && wc_review_ratings_enabled() && wc_get_rating_html( $product->get_average_rating() ) ) {
      $classes .= ' with-rating';
    }
    return $classes;
  }
}

// Hook after shop loop item title
add_action( 'woocommerce_after_shop_loop_item_title', 'wordtrap_after_shop_loop_item_title', 1 );
if ( ! function_exists( 'wordtrap_after_shop_loop_item_title' ) ) {
  /**
   * Show or hide a rating, price, add to cart, etc
   */
  function wordtrap_after_shop_loop_item_title() {
    if ( ! wordtrap_options( 'products-rating' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    }

    if ( ! wordtrap_options( 'products-price' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    }

    if ( ! wordtrap_options( 'products-add-to-cart' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
  }
}

/**
 * Product type: Cart on Image's Top, Cart on Image's Bottom
 */

// Hook before shop loop item title
add_action( 'woocommerce_before_shop_loop_item_title', 'wordtrap_show_add_to_cart_before_shop_loop_item_title', 50 );
if ( ! function_exists( 'wordtrap_show_add_to_cart_before_shop_loop_item_title' ) ) {
  /**
   * Add add to cart button on thumbnail
   */
  function wordtrap_show_add_to_cart_before_shop_loop_item_title() {
    if ( in_array( wordtrap_options( 'products-view' ), array( 'cart-onimage-top', 'cart-onimage-bottom' ) ) && wordtrap_options( 'products-add-to-cart' ) ) {
      woocommerce_template_loop_add_to_cart();
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
  }
}

/**
 * Product type: Show Quantity Input
 */
add_filter( 'woocommerce_loop_add_to_cart_link', 'wordtrap_show_quantity_input_in_shop_loop', 10, 3 );
if ( ! function_exists( 'wordtrap_show_quantity_input_in_shop_loop' ) ) {
  /**
   * Show quantity input
   */
  function wordtrap_show_quantity_input_in_shop_loop( $content, $product, $args ) {
    if ( in_array( wordtrap_options( 'products-view' ), array( 'quantity-input' ) ) && $product->get_type() === 'simple' && $product->is_purchasable() && $product->is_in_stock() ) {
      return woocommerce_quantity_input( array(), null, false ) . $content;
    }

    return $content;
  }
}

/**
 * Cart Notification
 */
add_action( 'woocommerce_after_main_content', 'wordtrap_cart_notification_template', 100 );
if ( ! function_exists( 'wordtrap_cart_notification_template' ) ) {
  /**
   * Add template for cart notification
   */
  function wordtrap_cart_notification_template() {
    if ( wordtrap_options( 'products-cart-notify' ) === 'modal' ) :
      ?>
      <div id="modal-cart-notification" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php esc_html_e( 'You\'ve just added to the cart', 'wordtrap' ) ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr( 'Close', 'wordtrap' ) ?>"></button>
            </div>
            <div class="modal-body text-center">
              <h6 class="product-title"></h6>
              <div class="product-thumbnail"></div>            
            </div>
            <div class="modal-footer">
              <div class="cart-link"></div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php esc_html_e( 'Continue', 'wordtrap' ) ?></button>            
            </div>
          </div>
        </div>
      </div>
      <?php
    endif;

    if ( wordtrap_options( 'products-cart-notify' ) === 'toast' ) :
      ?>
      <div class="toast-cart-notification-wrap position-fixed bottom-0 end-0 p-2"></div>
      <div id="toast-cart-notification" class="toast mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body opacity-1">
          <div class="d-flex">
            <div class="flex-shrink-0 product-thumbnail"></div> 
            <div class="flex-grow-1 ms-3">
              <p class="mb-0"><strong class="product-title"></strong></p>
              <?php esc_html_e( 'has been added to your cart', 'wordtrap' ) ?>
            </div>
          </div>          
          <div class="mt-2 pt-2 text-end">
            <div class="cart-link d-inline-block"></div>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast"><?php esc_html_e( 'Continue', 'wordtrap' ) ?></button>
          </div>
        </div>
      </div>
      <?php
    endif;    
  }
}

// Unhook category link
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

// Hook category link
add_action( 'woocommerce_before_subcategory_title', 'woocommerce_template_loop_category_link_close', 100 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_open', 9 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_link_close', 11 );

// Hook shop loop subcategory title
add_action( 'woocommerce_shop_loop_subcategory_title', 'wordtrap_shop_loop_subcategory_description', 20 );

if ( ! function_exists( 'wordtrap_shop_loop_subcategory_description' ) ) {
  /**
   * Show subcategory description
   */
  function wordtrap_shop_loop_subcategory_description( $category ) {
    // View mode
    $view_mode = wc_get_loop_prop( 'view-mode', wordtrap_get_view_mode() );

    if ( $view_mode === 'list' ) {
      ?>
      <div class="woocommerce-product-details__short-description">
        <?php echo wordtrap_trim_excerpt( $category->description, 55 ) ?>
      </div>
      <?php
    }
  }
}