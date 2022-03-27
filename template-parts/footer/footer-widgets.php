<?php
/**
 * Displays the footer widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'footer-area' ) ) : ?>

  <aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'wordtrap' ); ?>">
    <?php dynamic_sidebar( 'footer-area' ); ?>
  </aside><!-- .widget-area -->

<?php endif; ?>
