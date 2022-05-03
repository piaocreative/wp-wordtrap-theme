<?php
/**
 * Show options for ordering
 *
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$show_sort = wordtrap_options( 'products-sort' );
$show_count = wordtrap_options( 'products-show-count' );
$show_view_mode = wordtrap_options( 'products-view-mode' );

if ( ! ( $show_sort || $show_count || $show_view_mode ) ) {
  return;
}

$products_counts = $show_count ? wordtrap_options( 'products-counts' ) : false;
if ( ! is_array( $products_counts ) ) {
  $products_counts = array( get_option( 'posts_per_page' ) );
}
$default_count = $products_counts[ 0 ];
$products_per_page = isset( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : $default_count;

$default_view_mode = wordtrap_options( 'products-default-view-mode') ? 'grid' : 'list';
$view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

?>
<nav class="posts-filter-nav" id="posts-filter-above">
  <form class="posts-filter woocommerce-ordering" method="get">
    <div class="posts-filter-wrap">

      <?php if ( $show_sort ) : ?>
        <label>
          <?php _e( 'Sort by:', 'wordtrap' ) ?>
          <select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'wordtrap' ); ?>">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
              <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
          </select>
        </label>
      <?php endif; ?>

      <?php if ( $show_count || $show_view_mode ) : ?>
        <div class="posts-view d-flex justify-content-center">

          <?php if ( $show_count ) : ?>
            <label>
              <?php _e( 'Show:', 'wordtrap') ?>
              <select name="posts_per_page" class="posts_per_page" aria-label="<?php esc_attr_e( 'Products per page', 'wordtrap' ); ?>">
              <?php foreach ( $products_counts as $count ) : ?>
                <option value="<?php echo esc_attr( $count ); ?>" <?php selected( $products_per_page, $count ); ?>><?php echo esc_html( $count ); ?></option>
              <?php endforeach; ?>
              </select>
            </label>
          <?php endif; ?>

          <?php if ( $show_view_mode ) : ?>
            <div class="posts-view-mode">
              <label>
                <input type="radio" name="view" value="grid" <?php checked( $view_mode, 'grid' ) ?>/>
                <i class="fa fa-th"></i>
              </label>
              <label>
                <input type="radio" name="view" value="list" <?php checked( $view_mode, 'list' ) ?>/>
                <i class="fa fa-th-list"></i>
              </label>
            </div>
          <?php endif; ?>

        </div>
      <?php endif; ?>

      <input type="hidden" name="paged" value="1" />
      <?php wc_query_string_form_fields( null, array( 'orderby', 'posts_per_page', 'view', 'submit', 'paged', 'product-page' ) ); ?>

    </div>    
  </form>
</nav>
