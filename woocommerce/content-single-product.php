<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package Wordtrap
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];

?>
<div class="product-before-summary">
  <?php
  if ( $layout === 'wide' ) {
    echo '<div class="container-fluid">';
  } else if ( $layout === 'full' ) {
    echo '<div class="container">';
  }

  /**
   * Hook: woocommerce_before_single_product.
   *
   * @hooked woocommerce_output_all_notices - 10
   */
  do_action( 'woocommerce_before_single_product' );

  if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
  }

  if ( $layout === 'wide' || $layout === 'full' ) {
    echo '</div>';
  }  
  ?>
</div><!-- .product-before-summary -->

<?php
if ( post_password_required() ) {
  return;
}

$product_view = wordtrap_options( 'product-view' );
$classes = array();
$classes[] = 'product-view-' . $product_view;

$wrapper_classes = array();
if ( $layout === 'wide' || $layout === 'full' ) {
  $wrapper_classes[] = 'wide-width';
}

$options = array();
if ( wordtrap_options( 'product-view' ) === 'extended' ) {
  $options[ 'items' ] = wordtrap_options( 'product-extended-columns-sm' );
  $options[ 'autoplay' ] = true;
  $options[ 'autoHeight' ] = true;

	$options[ 'sm' ] = $options[ 'md' ] = $options[ 'lg' ] = $options[ 'xl' ] = $options[ 'xxl' ] = array();  
	$options[ 'sm' ][ 'items' ] = wordtrap_options( 'product-extended-columns-sm' );
  $options[ 'md' ][ 'items' ] = wordtrap_options( 'product-extended-columns-md' );
  $options[ 'lg' ][ 'items' ] = wordtrap_options( 'product-extended-columns-lg' );
  $options[ 'xl' ][ 'items' ] = wordtrap_options( 'product-extended-columns-xl' );  
  $options[ 'xxl' ][ 'items' ] = wordtrap_options( 'product-extended-columns-xxl' );
}
$options = json_encode( $options )
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $classes, $product ); ?> data-options="<?php echo esc_attr( $options ) ?>">

  <div class="product-summary-wrapper <?php echo esc_attr( implode( ' ', $wrapper_classes ) ) ?>">

    <?php
    if ( $product_view !== 'extended' ) {
      if ( $layout === 'wide' ) {
        echo '<div class="container-fluid">';
      } else if ( $layout === 'full' ) {
        echo '<div class="container">';
      }
    }      

    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );

    if ( $product_view === 'extended' ) {
      if ( $layout === 'wide' ) {
        echo '<div class="container-fluid">';
      } else if ( $layout === 'full' ) {
        echo '<div class="container">';
      }
    } 
    ?>

    <div class="summary entry-summary">
      <?php
      /**
       * Hook: woocommerce_single_product_summary.
       *
       * @hooked woocommerce_template_single_title - 5
       * @hooked woocommerce_template_single_rating - 10
       * @hooked woocommerce_template_single_price - 10
       * @hooked woocommerce_template_single_excerpt - 20
       * @hooked woocommerce_template_single_add_to_cart - 30
       * @hooked woocommerce_template_single_meta - 40
       * @hooked woocommerce_template_single_sharing - 50
       * @hooked WC_Structured_Data::generate_product_data() - 60
       */
      do_action( 'woocommerce_single_product_summary' );
      ?>
    </div>

    <?php
    if ( $layout === 'wide' || $layout === 'full' ) {
      echo '</div>';
    }
    ?>
  </div><!-- .product-summary-wrapper -->

  <div class="product-after-summary">
    <?php
    if ( $layout === 'wide' ) {
      echo '<div class="container-fluid">';
    } else if ( $layout === 'full' ) {
      echo '<div class="container">';
    }

    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );

    if ( $layout === 'wide' || $layout === 'full' ) {
      echo '</div>';
    }
    ?>
  </div><!-- .product-after-summary -->
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
