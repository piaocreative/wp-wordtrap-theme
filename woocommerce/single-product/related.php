<?php
/**
 * Related Products
 *
 * @package     Wordtrap
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_set_loop_prop( 'view-mode', 'grid' );

$classes = array();
$options = array();
if ( wordtrap_options( 'product-related-carousel' ) ) {
	$slider_mode = 'gallery';

	$classes[] = 'posts-slider';
  $classes[] = 'posts-' . $slider_mode;

  $options[ 'items' ] = wordtrap_options( 'product-related-columns-sm' );
  $options[ 'mode' ] = $slider_mode;
  $options[ 'slideBy' ] = 'page';
  $options[ 'autoplay' ] = true;
  $options[ 'autoHeight' ] = true;  
	$options[ 'autoInnerHeight'] = $slider_mode === 'gallery';

	$options[ 'sm' ] = $options[ 'md' ] = $options[ 'lg' ] = $options[ 'xl' ] = $options[ 'xxl' ] = array();

	if ( $slider_mode === 'carousel' ) {
    $options[ 'gutter' ] = 24;
    $options[ 'xl' ][ 'gutter' ] = 30;
  }
  
	$options[ 'sm' ][ 'items' ] = wordtrap_options( 'product-related-columns-sm' );
  $options[ 'md' ][ 'items' ] = wordtrap_options( 'product-related-columns-md' );
  $options[ 'lg' ][ 'items' ] = wordtrap_options( 'product-related-columns-lg' );
  $options[ 'xl' ][ 'items' ] = wordtrap_options( 'product-related-columns-xl' );  
  $options[ 'xxl' ][ 'items' ] = wordtrap_options( 'product-related-columns-xxl' );  
} else {
	$classes[] = 'row';
	$classes[] = 'row-cols-sm-' . wordtrap_options( 'product-related-columns-sm' );
  $classes[] = 'row-cols-md-' . wordtrap_options( 'product-related-columns-md' );
  $classes[] = 'row-cols-lg-' . wordtrap_options( 'product-related-columns-lg' );
  $classes[] = 'row-cols-xl-' . wordtrap_options( 'product-related-columns-xl' );
  $classes[] = 'row-cols-xxl-' . wordtrap_options( 'product-related-columns-xxl' );
}
wc_set_loop_prop( 'view-classes', implode( ' ', $classes ) );
wc_set_loop_prop( 'view-options', json_encode( $options ) );

if ( $related_products ) : ?>

	<section class="related related-products show-nav-title">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'wordtrap' ) );

		if ( $heading ) :
			?>
			<h2 class="mb-0"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();
