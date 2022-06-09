<?php
/**
 * Displays the page title area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ( is_front_page() && is_home() ) || is_front_page() || is_404() || ! apply_filters( 'wordtrap_filter_show_page_title', true ) ) {
  return;
}

// Classes
$wrap_classes = array( 'page-header-wrap' );
$inner_classes = array( 'page-header-inner' );

// Add classes according to layout
switch ( wordtrap_options( 'page-header-layout' ) ) {
  case 'full':
    $inner_classes[] = 'container-fluid';
    break;
  case 'wide':
    $inner_classes[] = 'container';
    break;
  case 'boxed':
    $wrap_classes[] = 'container';
    break;
}

?>
<div id="page-header" class="page-header">
  <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
    <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">
      
      <?php
      if ( class_exists('Woocommerce') && ( is_cart() || is_checkout() ) ) :
        $step = 3;
        if ( is_cart() ) $step = 1;
        if ( is_checkout() && ! is_order_received_page() ) $step = 2;
        ?>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb links">
            <li>
              <a class="back-to-link" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                <?php
                  echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'wordtrap' ) ) );
                ?>
              </a>
            </li>
          </ul>
        </nav>
        
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb woo-breadcrumb">
            <li class="breadcrumb-item<?php echo $step === 1 ? ' current' : ( $step > 1 ? ' passed' : '') ?>">
              <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <?php esc_html_e( 'Shopping Cart', 'wordtrap' ); ?>
                <span class="delimiter"></span>
              </a>
            </li>
            <li class="breadcrumb-item<?php echo $step === 2 ? ' current' : ( $step > 2 ? ' passed' : '') ?>">
              <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                <?php esc_html_e( 'Checkout', 'wordtrap' ); ?>
                <span class="delimiter"></span>
              </a>
            </li>
            <li class="breadcrumb-item<?php echo $step === 3 ? ' current' : '' ?>">
            <?php esc_html_e( 'Order Complete', 'wordtrap' ); ?>
            </li>
          </ol>
        </nav>
        <?php
      else :
        $back_link = wordtrap_back_to_link();
        $title = wordtrap_page_title();    
        ?>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb links<?php echo ( ! is_singular() && $title ) ? ' with-title' : '' ?>">
            <li>
              <a class="back-to-link" href="<?php echo esc_url( $back_link[ 'link' ] ); ?>">
                <?php
                  echo esc_html( $back_link[ 'title' ] );
                ?>
              </a>
            </li>
          </ul>
        </nav>
        <?php
        if ( ! is_singular() && $title ) : 
          ?>
          <h1 class="page-title">
            <?php echo $title ?>
          </h1>
          <?php
        endif;
      endif;
      ?>

    </div>
  </div>
</div><!-- #page-title -->
