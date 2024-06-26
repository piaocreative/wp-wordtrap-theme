<?php
/**
 * The header template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Hook body open
add_action( 'wp_body_open', 'wordtrap_loading_overlay', 1 );
if ( ! function_exists( 'wordtrap_loading_overlay' ) ) {
  /**
   * Render loading overlay
   */
  function wordtrap_loading_overlay() {
    if ( wordtrap_options( 'loading-overlay' ) ) :
      ?>
      <div class="page-loading-overlay">
        <div class="page-loading-progress">
          <span class="visually-hidden"><?php _e( 'Loading...', 'wordtrap' ) ?></span>
        </div>
      </div>
      <?php
    endif;
  }
}

if ( ! function_exists( 'wordtrap_logo' ) ) {
  /**
   * Render Logo HTML
   *
   * @param string $html Markup.
   *
   * @return string
   */
  function wordtrap_logo() {
    ob_start();
  
    if ( is_front_page() || is_home() ) : ?>
      <h1 class="navbar-brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home" itemprop="url">
    <?php else : ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home" itemprop="url">
    <?php endif; ?>
    
      <?php
      if ( wordtrap_options( 'logo', 'url' ) ) {
        $logo = wordtrap_options( 'logo', 'url' );
        
        $retina_logo = '';
        if ( wordtrap_options( 'logo-retina', 'url' ) ) {
          $retina_logo = wordtrap_options( 'logo-retina', 'url' );
        }
        ?>	
        <img class="img-fluid" src="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $logo ) ); ?>"<?php echo $retina_logo ? ' srcset="' . $retina_logo .  ' 2x"' : ''; ?> alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />	
        <?php				
      } else {
        bloginfo( 'name' );
      }
      ?>

    <?php if ( is_front_page() || is_home() ) : ?>
      </a></h1>
    <?php else : ?>
      </a>
    <?php endif; ?>

    <?php
    return apply_filters( 'wordtrap_logo', ob_get_clean() );
  }
}

if ( ! function_exists( 'wordtrap_mobile_web_app_meta' ) ) {
  /**
   * Add mobile-web-app meta.
   */
  function wordtrap_mobile_web_app_meta() {
    echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
  }
}
add_action( 'wp_head', 'wordtrap_mobile_web_app_meta' );

