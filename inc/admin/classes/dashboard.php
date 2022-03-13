<?php

/**
 * Load wordtrap admin dashboard
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! class_exists('Wordtrap_Admin_Dashboard' ) ) {

  /**
   * Class Wordtrap_Admin_Dashboard
   *
   * Admin dashboard class.
   *
   * @access public
   */
  class Wordtrap_Admin_Dashboard {

    /**
     * Constructor
     *
     * add toolbar menus, admin menus
     */
    public function __construct() {
      if ( current_user_can( 'edit_theme_options' ) ) {
        if ( is_super_admin() && is_admin_bar_showing() ) {
          add_action( 'wp_before_admin_bar_render', array( $this, 'toolbar_menu' ) );
        }

        if ( is_admin() ) {
          add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }
      }
    }

    /**
     * Add toolbar menus
     */
    public function toolbar_menu() {
      
      // Add parent menu
      wordtrap_add_toolbar_node( 
        '<span class="ab-icon"></span><span class="ab-label">' . __( 'Wordtrap', 'wordtrap' ) . '</span>', 
        false, 
        admin_url( 'admin.php?page=wordtrap' ), 
        'wordtrap',
        array( 'class' => 'wordtrap-menu' ),
      );

      // Add sub menus
      wordtrap_add_toolbar_node( 
        __( 'Dashboard', 'wordtrap' ), 
        'wordtrap', 
        admin_url( 'admin.php?page=wordtrap' ), 
        'wordtrap-dashboard' 
      );
      
      wordtrap_add_toolbar_node( 
        __( 'Customize', 'wordtrap' ), 
        'wordtrap', 
        admin_url( 'customize.php' ) ,
        'wordtrap-customize'
      );
      
      wordtrap_add_toolbar_node( 
        __( 'Theme Options', 'wordtrap' ), 
        'wordtrap', 
        admin_url( 'themes.php?page=wordtrap_options' ) ,
        'wordtrap-options'
      );
    }

    /**
     * Add admin menu
     */
    public function admin_menu() {
      add_menu_page( 
        __( 'Wordtrap', 'wordtrap' ), 
        __( 'Wordtrap', 'wordtrap' ), 
        'administrator', 
        'wordtrap', 
        array( $this, 'dashboard' ), 
        'dashicons-wordtrap-logo', 
        59 
      );

      add_submenu_page( 
        'wordtrap', 
        __( 'Dashboard', 'wordtrap' ), 
        __( 'Dashboard', 'wordtrap' ), 
        'administrator', 
        'wordtrap', 
        array( $this, 'dashboard' ) 
      );

      add_submenu_page( 
        'wordtrap', 
        __( 'Customize', 'wordtrap' ), 
        __( 'Customize', 'wordtrap' ), 
        'administrator', 
        'customize.php' 
      );
      
      add_submenu_page( 
        'wordtrap', 
        __( 'Theme Options', 'wordtrap' ), 
        __( 'Theme Options', 'wordtrap' ), 
        'administrator', 
        'themes.php?page=wordtrap_options' 
      );
    }

    /**
     * Load dashboard page
     */
    public function dashboard() {
      require get_template_directory() . '/inc/admin/templates/dashboard.php';
    }
  }
}

// Create admin dashboard instance
new Wordtrap_Admin_Dashboard();