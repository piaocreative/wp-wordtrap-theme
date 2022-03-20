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

if ( ! function_exists( 'wordtrap_page_layout_save_conditions' ) ) {
  /**
   * Save page layout display conditions
   */
  function wordtrap_page_layout_save_conditions() {
    $layout_option = get_option( WORDTRAP_PAGE_LAYOUT, array() );
    $blocks = array_keys( $layout_option );
    $display_conditions = get_option( WORDTRAP_DISPLAY_CONDITIONS, array() );
    foreach ( $blocks as $block ) {
      $templates = $layout_option[ $block ];
      $display_conditions[ $block ] = array();
      
      if ( $block == 'left-sidebar' || $block == 'right-sidebar' ) {
        $display_conditions[ $block ][ 'top' ] = array();
        $display_conditions[ $block ][ 'bottom' ] = array();
      } else if ( $block == 'main' ) {
        $display_conditions[ $block ][ 'main-top' ] = array();
        $display_conditions[ $block ][ 'content-top' ] = array();
        $display_conditions[ $block ][ 'content-bottom' ] = array();
        $display_conditions[ $block ][ 'main-bottom' ] = array();
      }
      
      foreach ( $templates as $id ) {
        $template = get_post( $id );
        if ( $template->post_type != Wordtrap_Templates_Builder::POST_TYPE ) continue;
        $template_type = get_post_meta( (int) $id, Wordtrap_Templates_Builder::TEMPLATE_TYPE, true );
        if ( $template_type != $block ) continue;

        $conditions = array();
        $conditions[ WORDTRAP_CONDITIONS_ALL ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ALL, true );
        $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] = get_post_meta( $id, WORDTRAP_CONDITIONS_SINGULAR, true );
        $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ARCHIVE, true );
        if ( $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] && $conditions[ WORDTRAP_CONDITIONS_ARCHIVE] ) {
          $conditions[ WORDTRAP_CONDITIONS_ALL ] = true;
        }
        if ( ! $conditions[ WORDTRAP_CONDITIONS_ALL] ) {
          if ( ! $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] ) {
            $singular_conditions = get_post_meta( $id, WORDTRAP_SINGULAR_CONDITIONS, true );
            if ( ! $singular_conditions ) {
              $singular_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_SINGULAR_CONDITIONS ] = $singular_conditions;
          }
          if ( ! $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] ) {
            $archive_conditions = get_post_meta( $id, WORDTRAP_ARCHIVE_CONDITIONS, true );
            if ( ! $archive_conditions ) {
              $archive_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_ARCHIVE_CONDITIONS ] = $archive_conditions;
          }
        }

        if ( $block == 'left-sidebar' || $block == 'right-sidebar' || $block == 'main' ) {
          $position = get_post_meta( $id, WORDTRAP_DISPLAY_POSITIONS, true );
          if ( ! $position ) break;
          if ( is_array( $position ) ) {
            foreach ( $position as $pos ) {
              $display_conditions[ $block ][ $pos ][ $id ] = $conditions;
            }
          } else {
            $display_conditions[ $block ][ $position ][ $id ] = $conditions;
          }
        } else {
          $display_conditions[ $block ][ $id ] = $conditions;
        }
      }
    }
    update_option( WORDTRAP_DISPLAY_CONDITIONS, $display_conditions );
  }
}