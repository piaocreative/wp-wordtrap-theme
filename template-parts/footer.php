<?php
/**
 * Displays the footer area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Footer template
$template = wordtrap_layout_template( 'footer' );

// Footer classes
$wrap_classes = array( 'footer-wrap' );
$inner_classes = array( 'footer-inner' );

// Reveal effect
if ( wordtrap_options( 'footer-reveal' ) ) {
  $wrap_classes[] = 'footer-reveal';
}

if ( $template ) : 
  /**
   * Render footer template
   */
  ?>
  <div id="footer">
    <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
      <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">
        
        <footer>
          <?php
          wordtrap_render_template( $template ); 
          ?>
        </footer>

      </div>
    </div>
  </div><!-- #footer -->
<?php
elseif ( is_active_sidebar( 'footer-area' ) ) : 
  /**
   * Render default footer
   */
  
  // Add classes according to layout
  switch ( wordtrap_options( 'footer-layout' ) ) {
    case 'wide':
      $inner_classes[] = 'container-fluid';
      break;
    case 'full':
      $inner_classes[] = 'container';
      break;
    case 'boxed':
      $wrap_classes[] = 'container';
      break;
  }
  ?>
  <div id="footer">
    <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
      <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">

        <footer>

          <?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
          
        </footer>

      </div>
    </div>
  </div><!-- #footer -->
  <?php 
endif;