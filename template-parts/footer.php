<?php
/**
 * Displays the footer area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Global Theme Options
global $wordtrap_options;

// Footer template
$template = false; wordtrap_layout_template( 'footer' );

// Footer classes
$wrap_classes = array( 'footer-wrap' );
$inner_classes = array( 'footer-inner' );

// Reveal effect
if ( $wordtrap_options[ 'footer-reveal' ] ) {
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
else : 
  /**
   * Render default footer
   */
  
  // Add classes according to layout
  switch ( $wordtrap_options[ 'footer-layout' ] ) {
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
          <div id="footer-bottom" class="navbar navbar-<?php echo esc_attr( $wordtrap_options[ 'footer-navbar-color' ] ) ?><?php echo ( $wordtrap_options[ 'footer-copyright' ] && has_nav_menu( 'footer' ) ) ? '' : ' justify-content-center' ?>">
            
            <?php
            /**
             * Footer Menu
             */
            wp_nav_menu( array(
              'theme_location'  => 'footer',
              'container_class' => 'footer-menu-container',
              'container_id'    => '',
              'menu_class'      => 'navbar-nav',
              'fallback_cb'     => '',
              'menu_id'         => 'footer-menu',
              'depth'           => 1,
              'walker'          => new Wordtrap_WP_Bootstrap_Navwalker(),
            ) );
            ?>

            <?php
            /**
             * Copyright
             */
            if ( $wordtrap_options[ 'footer-copyright' ] ) : ?>
              <div class="footer-copyright"><?php esc_html_e( $wordtrap_options[ 'footer-copyright' ] ) ?></div>
            <?php endif; ?>

          </div>
        </footer>

      </div>
    </div>
  </div><!-- #footer -->
  <?php 
endif;