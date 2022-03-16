<?php
/**
 * Load wordtrap templates builder
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! class_exists( 'Wordtrap_Templates_Builder' ) ) {
  return;
}

/**
 * Class Wordtrap_Template_Builder
 *
 * Templates builder class.
 *
 * @access public
 */
class Wordtrap_Templates_Builder {

  // Template slug
  const POST_TYPE     = 'wordtrap_builder';

  // Taxonomy slug, Meta kwy
  const TEMPLATE_TYPE = 'wordtrap_builder_type';

  // Template meta option
  const META_OPTION   = 'wordtrap_builder';

  // Capability
  private $capability = 'edit_pages';

  // Builder types
  private $builder_types;

  /**
   * Constructor
   */
  public function __construct() {
    
    $this->builder_types = array(
      'header'        => __( 'Header', 'wordtrap' ),
      'left-sidebar'  => __( 'Left Sidebar', 'wordtrap' ),
      'content'       => __( 'Content', 'wordtrap' ),
      'right-sidebar' => __( 'Right Sidebar', 'wordtrap' ),
      'footer'        => __( 'Footer', 'wordtrap' ),
    );

    $this->builder_types = apply_filters( 'wordtrap_template_builder_types', $this->builder_types );

    // register builder post type and builder types as taxonomies
    add_action( 'init', array( $this, 'add_builder_type' ) );

    // add builder menu
    add_action( 'admin_menu', array( $this, 'add_admin_menu' ), 20 );  
    
    // add builder menu in toolbar
    if ( is_super_admin() && is_admin_bar_showing() ) {
      add_action( 'wp_before_admin_bar_render', array( $this, 'toolbar_menu' ), 20 );
    }
  }

  /**
   * Register builder post type and builder types as taxonomies
   */
  public function add_builder_type() {
    $singular_name = __( 'Template Builder', 'wordtrap' );
    $name          = __( 'Templates Builder', 'wordtrap' );
    $current_type  = $singular_name;
    
    if ( ! empty( $_REQUEST[ self::TEMPLATE_TYPE ] ) && isset( $this->builder_types[ $_REQUEST[ self::TEMPLATE_TYPE ] ] ) ) {
      $current_type = $this->builder_types[ $_REQUEST[ self::TEMPLATE_TYPE ] ];
    }
    
    // register builder post type
    $labels = array(
      'name'               => $name,
      'singular_name'      => $current_type,
      'add_new'            => sprintf( __( 'Add New %s', 'wordtrap' ), str_replace( $singular_name, '', $current_type ) ),
      'add_new_item'       => sprintf( __( 'Add New %s', 'wordtrap' ), $current_type ),
      'edit_item'          => sprintf( __( 'Edit %s', 'wordtrap' ), $current_type ),
      'new_item'           => sprintf( __( 'New %s', 'wordtrap' ), $current_type ),
      'view_item'          => sprintf( __( 'View %s', 'wordtrap' ), $current_type ),
      'search_items'       => sprintf( __( 'Search %s', 'wordtrap' ), $name ),
      'not_found'          => sprintf( __( 'No %s found', 'wordtrap' ), $name ),
      'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'wordtrap' ), $name ),
      'parent_item_colon'  => '',
    );

    $args = array(
      'labels'               => $labels,
      'public'               => true,
      'rewrite'              => false,
      'menu_icon'            => 'dashicons-admin-page',
      'show_ui'              => true,
      'show_in_menu'         => false,
      'show_in_nav_menus'    => false,
      'exclude_from_search'  => true,
      'capability_type'      => 'post',
      'hierarchical'         => false,
      'show_in_rest'         => true,
      'supports'             => array(
        'title',
        'thumbnail',
        'author',
        'editor',
      ),      
    );
    register_post_type( self::POST_TYPE, $args );

    // register builder type as taxonomy
    $args = array(
      'hierarchical'         => false,
      'show_ui'              => false,
      'show_in_nav_menus'    => false,
      'show_admin_column'    => true,
      'query_var'            => is_admin(),
      'rewrite'              => false,
      'public'               => false,
      'label'                => __( 'Type', 'wordtrap' ),
      'show_in_rest'         => true,
    );
    register_taxonomy( self::TEMPLATE_TYPE, self::POST_TYPE, $args );

    // add meta boxes
    $this->add_meta_boxes();
  }

  /**
   * Add meta boxes
   */
  public function add_meta_boxes() {
    Redux_Metaboxes::set_box(
      self::META_OPTION,
      array(
        'id'         => 'wordtrap-builder-metaboxes',
        'title'      => esc_html__( 'Template Options', 'wordtrap' ),
        'post_types' => array( self::POST_TYPE ),
        'position'   => 'normal',
        'priority'   => 'high',
        'sections'   => array(
          array(
            'title'  => esc_html__( 'Custom CSS', 'wordtrap' ),
            'id'     => 'template-css',
            'icon'   => 'dashicons dashicons-editor-code',
            'fields' => array(
              array(
                'id'         => 'css-code',
                'type'       => 'ace_editor',
                'mode'       => 'css',
                'default'    => '',
                'full_width' => true,
              ),
            )
          ),
          array(
            'title'  => esc_html__( 'JS Code', 'wordtrap' ),
            'id'     => 'template-js',
            'icon'   => 'dashicons dashicons-editor-code',
            'fields' => array(
              array(
                'id'         => 'js-code',
                'type'       => 'ace_editor',
                'mode'       => 'javascript',
                'default'    => '',
                'full_width' => true
              ),
            )
          ),          
        ),
      )
    );    
  }

  /**
   * Add builder admin menu
   */
  public function add_admin_menu() {
    add_submenu_page( 
      'wordtrap', 
      __( 'Templates Builder', 'wordtrap' ), 
      __( 'Templates Builder', 'wordtrap' ), 
      'administrator', 
      'edit.php?post_type=' . self::POST_TYPE
    );
  }

  /**
   * Add toolbar menus
   */
  public function toolbar_menu() {
    wordtrap_add_toolbar_node( 
      __( 'Templates Builder', 'wordtrap' ), 
      'wordtrap', 
      admin_url( 'edit.php?post_type=' . self::POST_TYPE ), 
      'wordtrap-templates-builder' 
    );
  }

}

new Wordtrap_Templates_Builder();