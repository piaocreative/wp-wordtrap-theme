<?php
/**
 * Wordtrap admin general functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'wordtrap_add_toolbar_node' ) ) {
  /**
   * Adds a node to the toolbar menu.
   *
   * @param string $title   Title of the node.
   *        string $parent  Optional. ID of the parent node.
   *        string $href    Optional. Link for the item.
   *        string $id      Optional. ID of the item.
   *        array  $meta    Meta data including the following keys: 'html', 'class', 'rel', 'lang', 'dir',
   *                          'onclick', 'target', 'title', 'tabindex'. Default empty.
   */
  function wordtrap_add_toolbar_node( $title, $parent = false, $href = '', $id = '', $custom_meta = array() ) {
    global $wp_admin_bar;

    // Set ID
    if ( !$id ) {
      $id = strtolower( str_replace( ' ', '-', $title ) );
    }

    // links from the current host will open in the current window
    $meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' );

    $meta = array_merge( $meta, $custom_meta );
    $wp_admin_bar->add_node(
      array(
        'parent' => $parent,
        'id'     => $id,
        'title'  => $title,
        'href'   => $href,
        'meta'   => $meta,
      )
    );
  }
}

if ( ! function_exists( 'wordtrap_admin_enqueue_scripts' ) ) {
  /**
   * Load admin styles.
   */
  function wordtrap_admin_enqueue_scripts() {
    if ( current_user_can( 'edit_theme_options' ) ) {
      wp_enqueue_style( 'wordtrap-icon', WORDTRAP_ADMIN_URI . '/assets/css/icon.css', false, WORDTRAP_VERSION );
      
      global $pagenow;
      if ( ( $pagenow == 'themes.php' || $pagenow == 'admin.php' ) 
        && isset( $_GET['page'] ) && 
        ( $_GET['page'] === WORDTRAP_OPTIONS || $_GET['page'] == 'wordtrap' ) ) {
        wp_enqueue_style( 'wordtrap-admin', WORDTRAP_ADMIN_URI . '/assets/css/admin.css', false, WORDTRAP_VERSION );
        wp_enqueue_script( 'wordtrap-admin', WORDTRAP_ADMIN_URI . '/assets/js/admin.js', array( 'jquery' ), WORDTRAP_VERSION, true );
      }      
    }
  }
}
add_action( 'admin_enqueue_scripts', 'wordtrap_admin_enqueue_scripts' );

if ( ! function_exists( 'wordtrap_toolbar_icon_enqueue_scripts' ) ) {
  /**
   * Load admin styles.
   */
  function wordtrap_toolbar_icon_enqueue_scripts() {
    if ( is_admin_bar_showing() ) {
      wp_enqueue_style( 'wordtrap-icon', WORDTRAP_ADMIN_URI . '/assets/css/icon.css', false, WORDTRAP_VERSION );
    }
  }
}
add_action( 'wp_enqueue_scripts', 'wordtrap_toolbar_icon_enqueue_scripts' );
