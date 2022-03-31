<?php
/**
 * Declaring widgets
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
// add_filter( 'dynamic_sidebar_params', 'wordtrap_widget_classes' );

// if ( ! function_exists( 'wordtrap_widget_classes' ) ) {

//   function wordtrap_widget_classes( $params ) {

//     global $sidebars_widgets;

//     /*
//      * When the corresponding filter is evaluated on the front end
//      * this takes into account that there might have been made other changes.
//      */
//     $sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

//     // Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
//     if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
//       $sidebar_id   = $params[0]['id'];
//       $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

//       $widget_classes = 'widget-count-' . $widget_count;
//       if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
//         // Four widgets per row if there are exactly four or more than six widgets.
//         $widget_classes .= ' col-md-3';
//       } elseif ( 6 === $widget_count ) {
//         // If exactly six widgets are published.
//         $widget_classes .= ' col-md-2';
//       } elseif ( $widget_count >= 3 ) {
//         // Three widgets per row if there's three or more widgets.
//         $widget_classes .= ' col-md-4';
//       } elseif ( 2 === $widget_count ) {
//         // If two widgets are published.
//         $widget_classes .= ' col-md-6';
//       } elseif ( 1 === $widget_count ) {
//         // If just on widget is active.
//         $widget_classes .= ' col-md-12';
//       }

//       // Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
//       $params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
//     }

//     return $params;

//   }
// } // End of if function_exists( 'wordtrap_widget_classes' ).

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
} // End of function_exists( 'wordtrap_widgets_init' ).
