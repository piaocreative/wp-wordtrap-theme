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
  class Wordtrap_Admin_Dashboard {

    public function __construct() {
      if ( current_user_can( 'edit_theme_options' ) ) {
        if ( is_super_admin() && is_admin_bar_showing() ) {
          add_action( 'wp_before_admin_bar_render', array( $this, 'add_wp_toolbar_menu' ) );
        }

        if ( is_admin() ) {
          add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ), 1000 );
      }
    }

    public function add_wp_toolbar_menu() {
      
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
      
      wordtrap_add_toolbar_node( 
        __( 'Template Builder', 'wordtrap' ), 
        'wordtrap', 
        admin_url( 'edit.php?post_type=wordtrap_builder' ) ,
        'wordtrap-builder'
      );
    }  

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

    public function enqueue_styles() {
      wp_enqueue_style( 'wordtrap-admin-page', WORDTRAP_ADMIN_URI . '/assets/css/style.css', false, WORDTRAP_VERSION, 'all' );
    }

    public function dashboard() {
      require get_template_directory() . '/inc/admin/templates/dashboard.php';
    }
  }
}

new Wordtrap_Admin_Dashboard();