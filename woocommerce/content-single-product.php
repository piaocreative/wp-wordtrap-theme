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
$centered_view = false;
$classes = array();
$classes[] = 'product-view-' . $product_view;
if ( in_array( $product_view, array( 'default', 'transparent', 'centered-vertical-zoom' ) ) ) {
  $classes[] = 'product-thumbs-carousel';
}
if ( in_array( $product_view, array( 'grid', 'sticky-info', 'sticky-both-info' ) ) ) {
  $classes[] = 'product-thumbnails-grid';
}
if ( in_array( $product_view, array( 'sticky-info', 'sticky-both-info' ) ) ) {
  $classes[] = 'product-sticky-info';
}
if ( in_array( $product_view, array( 'transparent', 'centered-vertical-zoom' ) ) ) {
  $classes[] = 'product-vertical-carousel';
}
if ( in_array( $product_view, array( 'sticky-both-info', 'centered-vertical-zoom' ) ) ) {
  $classes[] = 'product-centered-view';
  $centered_view = true;
}

$wrapper_classes = array();
if ( $layout === 'wide' || $layout === 'full' ) {
  $wrapper_classes[] = 'wide-width';
}

$slider_options = array();
// Extended product
if ( $product_view === 'extended' ) {
  $slider_options[ 'items' ] = wordtrap_options( 'product-images-columns-sm' );
  $slider_options[ 'autoplay' ] = true;
  $slider_options[ 'autoHeight' ] = true;

	$slider_options[ 'sm' ] = $slider_options[ 'md' ] = $slider_options[ 'lg' ] = $slider_options[ 'xl' ] = $slider_options[ 'xxl' ] = array();
	$slider_options[ 'sm' ][ 'items' ] = wordtrap_options( 'product-images-columns-sm' );
  $slider_options[ 'md' ][ 'items' ] = wordtrap_options( 'product-images-columns-md' );
  $slider_options[ 'lg' ][ 'items' ] = wordtrap_options( 'product-images-columns-lg' );
  $slider_options[ 'xl' ][ 'items' ] = wordtrap_options( 'product-images-columns-xl' );  
  $slider_options[ 'xxl' ][ 'items' ] = wordtrap_options( 'product-images-columns-xxl' );
}
$slider_options = json_encode( $slider_options );

$carousel_options = array();
if ( $product_view === 'default' ) {
  $carousel_options[ 'containerClass' ] = 'show-nav-center';
}
if ( in_array( $product_view, array( 'transparent', 'centered-vertical-zoom' ) ) ) {
  $carousel_options[ 'axis' ] = 'vertical';
  $carousel_options[ 'gutter' ] = 0;
  $carousel_options[ 'containerClass' ] = 'show-nav-vertical';
}
$carousel_options = json_encode( $carousel_options );
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $classes, $product ); ?> data-slider-options="<?php echo esc_attr( $slider_options ) ?>" data-carousel-options="<?php echo esc_attr( $carousel_options ) ?>">

  <div class="product-summary-wrapper <?php echo esc_attr( implode( ' ', $wrapper_classes ) ) ?>">

    <?php
    if ( $product_view !== 'extended' ) {
      if ( $layout === 'wide' ) {
        echo '<div class="container-fluid">';
      } else if ( $layout === 'full' ) {
        echo '<div class="container">';
      }
    }

    if ( $centered_view ) : ?>

      <div class="wordtrap-before-summary">
        
        <?php do_action( 'wordtrap_before_single_product_summary' ) ?>

      </div>

      <div class="summary entry-summary wordtrap-summary">
        
        <?php do_action( 'wordtrap_single_product_summary' ) ?>

      </div>

    <?php
    endif;

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
