<?php
/**
 * Displays the header area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Global Theme Options
global $wordtrap_options;

// Header template
$template = false; wordtrap_layout_template( 'header' );

// Header classes
$wrap_classes = array( 'header-wrap' );
$inner_classes = array( 'header-inner' );

// Add classes according to position
if ( $wordtrap_options[ 'header-position' ] == 'fixed' ) {
  $wrap_classes[] = 'header-fixed';
}

if ( $template ) : 
  /**
   * Render header template
   */
  ?>
  <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
    <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">
      
      <?php
      wordtrap_render_template( $template ); 
      ?>

    </div>
  </div>
<?php
elseif ( $wordtrap_options[ 'header-position' ] != 'hide' ) : 
  /**
   * Render default header
   */
  
  // Add classes according to layout
  switch ( $wordtrap_options[ 'header-layout' ] ) {
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
  <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
    <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">

      <!-- Start Header -->
      <header id="header" class="site-header">
        <div id="navbar_main" class="navbar navbar-expand-lg navbar-<?php echo esc_attr( $wordtrap_options[ 'header-navbar-color' ] ) ?>">
          
          <!-- Logo -->	
          <?php echo wordtrap_logo(); ?>

          <!-- Toggle Naviation -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Navigation', 'wordtrap' ) ?>">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Navigation -->
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            /**
             * Primary Menu
             */
            wp_nav_menu( array(
              'theme_location'  => 'primary',
              'container_class' => 'main-menu-container me-auto',
              'container_id'    => '',
              'menu_class'      => 'navbar-nav',
              'fallback_cb'     => '',
              'menu_id'         => 'main-menu',
              'depth'           => 2,
              'walker'          => new Wordtrap_WP_Bootstrap_Navwalker(),
            ) );
            ?>

            <?php
            /**
             * Login/Logout Link
             */
            if ( ! is_user_logged_in() && $wordtrap_options[ 'header-login-link'] ) :
              ?>
              <a href="<?php echo esc_url( $wordtrap_options[ 'header-login-link' ] ) ?>" class="d-flex justify-content-center btn btn-outline-primary"><?php _e( 'Login', 'wordtrap' ) ?></a>
              <?php
            endif;
            if ( is_user_logged_in() && $wordtrap_options[ 'header-logout-link'] ) :
              ?>
              <a href="<?php echo esc_url( $wordtrap_options[ 'header-logout-link' ] ) ?>" class="d-flex justify-content-center btn btn-outline-primary"><?php _e( 'Logout', 'wordtrap' ) ?></a>
              <?php
            endif;
            ?>
          </div>

        </div>
      </header>
      <!-- End Header -->

    </div>
  </div>
  <?php 
endif;