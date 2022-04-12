<?php
/**
 * Declaring widgets
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'widgets_init', 'wordtrap_widgets_init' );

if ( ! function_exists( 'wordtrap_widgets_init' ) ) {
  /**
   * Initializes themes widgets.
   */
  function wordtrap_widgets_init() {
    register_sidebar(
      array(
        'name'          => __( 'Left Sidebar', 'wordtrap' ),
        'id'            => 'left-sidebar',
        'description'   => __( 'Left sidebar widget area', 'wordtrap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>'
      )
    );
    
    register_sidebar(
      array(
        'name'          => __( 'Right Sidebar', 'wordtrap' ),
        'id'            => 'right-sidebar',
        'description'   => __( 'Right sidebar widget area', 'wordtrap' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>'
      )
    );

    register_sidebar(
      array(
        'name'          => __( 'Footer Area', 'wordtrap' ),
        'id'            => 'footer-area',
        'description'   => __( 'Full sized footer widget area with dynamic grid', 'wordtrap' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div><!-- .footer-widget -->'
      )
    );

  }
}
