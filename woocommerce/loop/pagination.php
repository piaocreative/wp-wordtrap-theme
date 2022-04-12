<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$show_sort = wordtrap_options( 'products-sort' );
$show_count = wordtrap_options( 'products-show-count' );
$show_view_mode = wordtrap_options( 'products-view-mode' );

$default_orderby = is_search() ? 'relevance' : '';
$orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;

$products_counts = wordtrap_options( 'products-show-count' ) ? wordtrap_options( 'products-counts' ) : false;
if ( ! is_array( $products_counts ) ) {
  $products_counts = array( get_option( 'posts_per_page' ) );
}
$default_count = $products_counts[ 0 ];
$products_per_page = isset( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : $default_count;

$default_view_mode = wordtrap_options( 'products-default-view-mode') ? 'grid' : 'list';
$view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 && ! $show_count ) {
  return;
}
?>

<nav class="posts-filter-nav" id="posts-filter-below">
  <form class="posts-filter woocommerce-ordering" method="get">
    <div class="posts-filter-wrap">

      <?php if ( $show_sort ) : ?>
        <input type="hidden" name="orderby" value="<?php echo esc_attr( $orderby ) ?>"/>
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
            <input type="hidden" name="view" value="<?php echo esc_attr( $view_mode ) ?>"/>
          <?php endif; ?>

        </div>
      <?php endif; ?>

      <?php
        $args = wp_parse_args(
          $args,
          array(
            'mid_size'           => 3,
            'prev_next'          => true,
            'prev_text'          => __( '<i class="fa fa-angle-left"></i>&nbsp;Back', 'wordtrap' ),
            'next_text'          => __( 'Next&nbsp;<i class="fa fa-angle-right"></i>', 'wordtrap' ),
            'type'               => 'array',
            'current'            => max( 1, get_query_var( 'paged' ) ),
            'screen_reader_text' => __( 'Products navigation', 'wordtrap' ),
          )
        );
        
        $links = paginate_links( apply_filters( 'woocommerce_pagination_args', $args ) );
        if ( $links ) : ?>
          <nav aria-labelledby="posts-nav-label">

            <h2 id="posts-nav-label" class="screen-reader-text">
              <?php echo esc_html( $args['screen_reader_text'] ); ?>
            </h2>

            <ul class="pagination">

              <?php
              foreach ( $links as $key => $link ) {
                ?>
                <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
                  <?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </li>
                <?php
              }
              ?>

            </ul>

          </nav>
        <?php
        endif;
      ?>
      
      <input type="hidden" name="paged" value="1" />
      <?php wc_query_string_form_fields( null, array( 'orderby', 'posts_per_page', 'view', 'submit', 'paged', 'product-page' ) ); ?>

    </div>
  </form>
</nav>
