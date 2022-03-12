<?php
/**
 * Load wordtrap admin
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Wordtrap_Admin {

	private $dir;

	public function __construct() {

		$this->dir = dirname( __FILE__ );

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
		$this->add_wp_toolbar_menu_item( 
			'<span class="ab-icon"></span><span class="ab-label">' . __( 'Wordtrap', 'wordtrap' ) . '</span>', 
			false, 
			admin_url( 'admin.php?page=wordtrap' ), 
			'wordtrap',
			array( 'class' => 'wordtrap-menu' ), 				
		);

		// Add sub menus
		$this->add_wp_toolbar_menu_item( 
			__( 'Dashboard', 'wordtrap' ), 
			'wordtrap', 
			admin_url( 'admin.php?page=wordtrap' ), 
			'wordtrap-dashboard' 
		);
		
		$this->add_wp_toolbar_menu_item( 
			__( 'Page Layout', 'wordtrap' ), 
			'wordtrap', 
			admin_url( 'admin.php?page=wordtrap-page-layout' ),
			'wordtrap-page-layout' 
		);

		$this->add_wp_toolbar_menu_item( 
			__( 'Customize', 'wordtrap' ), 
			'wordtrap', 
			admin_url( 'customize.php' ) ,
			'wordtrap-customize'
		);
		
		$this->add_wp_toolbar_menu_item( 
			__( 'Theme Options', 'wordtrap' ), 
			'wordtrap', 
			admin_url( 'themes.php?page=wordtrap_options' ) ,
			'wordtrap-options'
		);
		
		$this->add_wp_toolbar_menu_item( 
			__( 'Template Builder', 'wordtrap' ), 
			'wordtrap', 
			admin_url( 'edit.php?post_type=wordtrap_builder' ) ,
			'wordtrap-builder'
		);
	}

	public function add_wp_toolbar_menu_item( $title, $parent = false, $href = '', $custom_id = '', $custom_meta = array() ) {
		global $wp_admin_bar;
		
		// Set custom ID
		if ( $custom_id ) {
			$id = $custom_id;
		} else { // Generate ID based on $title
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
		require $this->dir . '/pages/dashboard.php';
	}
}

new Wordtrap_Admin();
