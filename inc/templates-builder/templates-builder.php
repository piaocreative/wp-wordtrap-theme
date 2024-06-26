<?php
/**
 * Load wordtrap templates builder
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

require dirname( __FILE__ ) . '/helpers/general.php';

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
  const POST_TYPE     = 'wordtrap_template';

  // Taxonomy slug, Meta kwy
  const TEMPLATE_TYPE = 'wordtrap_template_type';

  // Template meta box option
  const METABOX_OPTION = WORDTRAP_METABOX_OPTION;

  // Capability
  private $capability = 'edit_pages';

  // Template types
  private $template_types;

  // Current directory
  private $dir;

  /**
   * Constructor
   */
  public function __construct() {

    $this->dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
    
    $this->template_types = array(
      'block'         => __( 'Block', 'wordtrap' ),
      'header'        => __( 'Header', 'wordtrap' ),
      'left-sidebar'  => __( 'Left Sidebar', 'wordtrap' ),
      'main'          => __( 'Main Block', 'wordtrap' ),
      'right-sidebar' => __( 'Right Sidebar', 'wordtrap' ),
      'footer'        => __( 'Footer', 'wordtrap' ),
    );

    $this->template_types = apply_filters( 'wordtrap_template_types', $this->template_types );

    // register template post type and template types as taxonomies
    add_action( 'init', array( $this, 'add_template_type' ) );

    // add menu
    add_action( 'admin_menu', array( $this, 'add_admin_menu' ), 20 );  
    
    // add toolbar menu
    if ( is_super_admin() && is_admin_bar_showing() ) {
      add_action( 'wp_before_admin_bar_render', array( $this, 'toolbar_menu' ), 20 );
    }

    if ( is_admin() ) {
      // enqueue styles and scripts
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

      // add template types in templates list page
      add_filter( 'views_edit-' . self::POST_TYPE, array( $this, 'admin_header_tabs' ) );

      // manage admin column header
      add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', array( $this, 'admin_column_header' ) );

      // manage admin column content
      add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', array( $this, 'admin_column_content' ), 10, 2 );

      // add dialog to select the template type when click add new
      add_action(  'admin_footer', array( $this, 'admin_template_type_dialog' ) );

      // insert new template and redirect
      add_action( 'admin_action_wordtrap-new-template', array( $this, 'insert_template' ) );

      // add meta boxes
      add_action( 'init', array( $this, 'add_meta_boxes' ) );

      // get posts or taxonomies by search query
      add_action( 'wp_ajax_wordtrap_template_search_query', array( $this, 'ajax_search_query' ) );

      // save conditions
      add_action( 'wp_ajax_wordtrap-singular-conditions', array( $this, 'ajax_save_singular_conditions' ) );
      add_action( 'wp_ajax_wordtrap-archive-conditions', array( $this, 'ajax_save_archive_conditions' ) );
      add_action( 'save_post', array( $this, 'save_post') );
    }
  }

  /**
   * Register template post type and template types as taxonomies
   */
  public function add_template_type() {
    $singular_name = __( 'Template Builder', 'wordtrap' );
    $name          = __( 'Templates Builder', 'wordtrap' );
    $current_type  = $singular_name;
    
    if ( ! empty( $_REQUEST[ self::TEMPLATE_TYPE ] ) && isset( $this->template_types[ $_REQUEST[ self::TEMPLATE_TYPE ] ] ) ) {
      $current_type = $this->template_types[ $_REQUEST[ self::TEMPLATE_TYPE ] ];
    }
    
    // register template post type
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

    // register template type as taxonomy
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
      'default_term'         => array(
        'name'               => 'block',
        'slug'               => 'block'
      )
    );
    register_taxonomy( self::TEMPLATE_TYPE, self::POST_TYPE, $args );
  }

  /**
   * Add admin menu
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
   * Add toolbar menu
   */
  public function toolbar_menu() {
    wordtrap_add_toolbar_node( 
      __( 'Templates Builder', 'wordtrap' ), 
      'wordtrap', 
      admin_url( 'edit.php?post_type=' . self::POST_TYPE ), 
      'wordtrap-templates-builder' 
    );
  }

  /**
   * Enqueue styles and scripts
   */
  public function enqueue() {
    $screen = get_current_screen();
    
    if ( $screen && $screen->base == 'edit' && $screen->id == 'edit-' . self::POST_TYPE ) {
      wp_enqueue_style( 'wordtrap-admin-template-type', WORDTRAP_TEMPLATES_BUILDER_URI . '/assets/css/template-type.css', null, WORDTRAP_VERSION );

      wp_enqueue_script( 'wordtrap-admin-templates-type', WORDTRAP_TEMPLATES_BUILDER_URI . '/assets/js/template-type.js', array('jquery-ui-dialog'), WORDTRAP_VERSION );
      wp_enqueue_style( 'wp-jquery-ui-dialog' );
    }
    
    if ( $screen && $screen->base == 'post' && $screen->id == self::POST_TYPE ) {
      wp_enqueue_style( 'wordtrap-theme-options', WORDTRAP_OPTIONS_URI . '/assets/css/theme_options.css', false, WORDTRAP_VERSION );
      wp_enqueue_style( 'wordtrap-admin-edit-templates', WORDTRAP_TEMPLATES_BUILDER_URI . '/assets/css/edit-template.css', null, WORDTRAP_VERSION );
      
      wp_enqueue_script( 'wordtrap-admin-edit-template', WORDTRAP_TEMPLATES_BUILDER_URI . '/assets/js/edit-template.js', array('jquery-ui-dialog'), WORDTRAP_VERSION, true );
      wp_enqueue_style( 'wp-jquery-ui-dialog' );
    }
  }

  /**
   * Add template types in templates list page
   */
  public function admin_header_tabs( $views ) {
    if ( ! current_user_can( $this->capability ) ) {
      return;
    }

    $active_class = ' nav-tab-active';
    $current_type = '';

    if ( ! empty( $_REQUEST[ self::TEMPLATE_TYPE ] ) ) {
      $current_type = $_REQUEST[ self::TEMPLATE_TYPE ];
      $active_class = '';
    }

    $baseurl = add_query_arg( 'post_type', self::POST_TYPE, admin_url( 'edit.php' ) );
    
    require $this->dir . '/templates/header-tabs.php';
    
    return $views;
  }

  /**
   * Manage admin column header
   */
  public function admin_column_header( $defaults ) {
    $defaults[ 'condition' ] = __( 'Display Conditions', 'wordtrap' );
    $defaults[ 'shortcode' ] = __( 'Shortcode', 'wordtrap' );
    return $defaults;
  }

  /**
   * Manage admin column content
   */
  public function admin_column_content( $column_name, $post_id ) {
    if ( 'condition' === $column_name ) {
      echo wordtrap_template_conditions_html( $post_id );
    } elseif ( 'shortcode' === $column_name ) {
      $shortcode = sprintf( '[wordtrap_template id="%d"]', $post_id );
      printf( '<input class="wordtrap-template-shortcode" type="text" readonly="readonly" onfocus="this.select()" value="%s" />', esc_attr( $shortcode ) );
    }
  }

  /**
   * Add dialog to select the template type when click add new
   */
  public function admin_template_type_dialog() {
    $screen = get_current_screen();
    if ( $screen && $screen->base == 'edit' && $screen->id == 'edit-' . self::POST_TYPE ) {
      require $this->dir . '/templates/template-type-dialog.php';
    }
    if ( $screen && $screen->base == 'post' && $screen->id == self::POST_TYPE ) {
      $post_id = isset( $_REQUEST[ 'post' ] ) ? $_REQUEST[ 'post' ] : $_REQUEST[ 'post_id' ];
      require $this->dir . '/templates/display-conditions-dialog.php';
    }
  }

  /**
   * Insert new template and redirect
   */
  public function insert_template() {
    if ( current_user_can( $this->capability ) && ! empty( $_POST[ 'template-type' ] ) && ! empty( $_POST[ 'template-name' ] ) ) {
      check_admin_referer( 'wordtrap-add-template' );
      $template_type = sanitize_text_field( $_POST[ 'template-type' ] );
      $template_name = sanitize_text_field( $_POST[ 'template-name' ] );

      $post_data = array(
        'post_title' => $template_name,
        'post_type'  => self::POST_TYPE,
      );
      $post_id = wp_insert_post( $post_data );
      if ( $post_id && ! is_wp_error( $post_id ) ) {
        add_post_meta( $post_id, self::TEMPLATE_TYPE, $template_type );
        wp_set_post_terms( $post_id, $template_type, self::TEMPLATE_TYPE );
        wp_redirect(
          add_query_arg(
            array(
              'post'   => $post_id,
              'action' => 'edit',
            ),
            esc_url( admin_url( 'post.php' ) )
          )
        );
        exit;
      }
    }
  }

  /**
   * Add meta boxes
   */
  public function add_meta_boxes() {
    global $pagenow;

    if ( ! class_exists( 'Redux_Metaboxes' ) || ! ( $pagenow && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) ) ) {
      return;
    }
    
    $show_conditions = false;
    $show_main = false;
    $show_sidebar = false;
    $header_type = false;
    if ( $pagenow == 'post.php' && isset( $_REQUEST[ 'post' ] ) || isset( $_REQUEST[ 'post_id' ] ) ) {
      $post_id = isset( $_REQUEST[ 'post' ] ) ? $_REQUEST[ 'post' ] : $_REQUEST[ 'post_id' ];
      if ( get_post_type( $post_id ) != self::POST_TYPE ) {
        return;
      }
  
      $template_type = get_post_meta( (int) $post_id, self::TEMPLATE_TYPE, true );
      if ( $template_type && $template_type != 'block' ) {
        $show_conditions = true;
      }

      if ( $template_type == 'main' ) {
        $show_main = true;
      }

      if ( $template_type == 'header' ) {
        $header_type = true;
      }

      if ( $template_type == 'left-sidebar' || $template_type == 'right-sidebar' ) {
        $show_sidebar = true;
      }
    }

    if ( $pagenow == 'post-new.php' && ! ( isset( $_REQUEST[ 'post_type' ] ) && $_REQUEST[ 'post_type' ] == self::POST_TYPE ) ) {
      return;
    }

    $sections = array();

    // display conditions
    if ( $show_conditions ) {
      $sections[] = array(
        'title'  => esc_html__( 'Display Conditions', 'wordtrap' ),
        'id'     => 'template-conditions',
        'icon'   => 'dashicons dashicons-visibility',
        'fields' => array(
          array(
            'id'         => WORDTRAP_CONDITIONS_ALL,
            'type'       => 'switch',
            'title'      => esc_html__( 'Always Show', 'wordtrap' ),
            'default'    => false,
            'on'         => esc_html__( 'Yes', 'wordtrap' ),
            'off'        => esc_html__( 'No', 'wordtrap' ),
          ),
          array(
            'id'         => WORDTRAP_CONDITIONS_SINGULAR,
            'type'       => 'switch',
            'title'      => esc_html__( 'Show in All Singular', 'wordtrap' ),
            'required'   => array( WORDTRAP_CONDITIONS_ALL, 'equals', false ),
            'default'    => false,
            'on'         => esc_html__( 'Yes', 'wordtrap' ),
            'off'        => esc_html__( 'No', 'wordtrap' ),
          ),
          array (
            'id'         => 'conditions-singular-set',
            'type'       => 'js_button',
            'title'      => esc_html__( 'Singular Conditions', 'wordtrap' ),
            'required'   => array( WORDTRAP_CONDITIONS_SINGULAR, 'equals', false ),
            'buttons'    => array(
              array(
                'text'      => esc_html__( 'Configure', 'wordtrap' ),
                'class'     => 'button-primary',
                'function'  => 'singular_conditions_setting'
              )
            ),
          ),
          array(
            'id'         => WORDTRAP_CONDITIONS_ARCHIVE,
            'type'       => 'switch',
            'title'      => esc_html__( 'Show in All Archive', 'wordtrap' ),
            'required'   => array( WORDTRAP_CONDITIONS_ALL, 'equals', false ),
            'default'    => false,
            'on'         => esc_html__( 'Yes', 'wordtrap' ),
            'off'        => esc_html__( 'No', 'wordtrap' ),
          ),
          array (
            'id'         => 'conditions-archive-set',
            'type'       => 'js_button',
            'title'      => esc_html__( 'Archive Conditions', 'wordtrap' ),
            'required'   => array( WORDTRAP_CONDITIONS_ARCHIVE, 'equals', false ),
            'buttons'    => array(
              array(
                'text'      => esc_html__( 'Configure', 'wordtrap' ),
                'class'     => 'button-primary',
                'function'  => 'archive_conditions_setting'
              )
            ),
          ),          
        )
      );
    }

    // display main block position
    if ( $show_main ) {
      $sections[] = array(
        'title'  => esc_html__( 'Display Positions', 'wordtrap' ),
        'id'     => 'template-positions',
        'icon'   => 'dashicons dashicons dashicons-move',
        'fields' => array(
          array(
            'id'         => WORDTRAP_DISPLAY_POSITIONS,
            'type'       => 'button_set',
            'title'      => esc_html__( 'Display Positions', 'wordtrap' ),
            'multi'      => true,
            'options'    => array(
              'main-top'       => esc_html__( 'Below Header', 'wordtrap' ),
              'content-top'    => esc_html__( 'Above Content', 'wordtrap' ),
              'content-bottom' => esc_html__( 'Below Content', 'wordtrap' ),
              'main-bottom'    => esc_html__( 'Above Footer', 'wordtrap' ),
            )
          ),          
        )
      );
    }

    // display sidebar position
    if ( $show_sidebar ) {
      $sections[] = array(
        'title'  => esc_html__( 'Display Positions', 'wordtrap' ),
        'id'     => 'template-positions',
        'icon'   => 'dashicons dashicons dashicons-move',
        'fields' => array(
          array(
            'id'         => WORDTRAP_DISPLAY_POSITIONS,
            'type'       => 'button_set',
            'title'      => esc_html__( 'Display Positions', 'wordtrap' ),
            'multi'      => true,
            'options'    => array(
              'top'      => esc_html__( 'Top', 'wordtrap' ),
              'bottom'   => esc_html__( 'Bottom', 'wordtrap' ),
            )
          ),          
        )
      );
    }

    // custom css
    $sections[] = array(
      'title'  => esc_html__( 'Custom CSS', 'wordtrap' ),
      'id'     => 'template-css',
      'icon'   => 'dashicons dashicons-editor-code',
      'fields' => array(
        array(
          'id'         => 'css-code',
          'title'      => esc_html__( 'Custom CSS', 'wordtrap' ),
          'type'       => 'ace_editor',
          'mode'       => 'css',
          'theme'      => 'chrome',
          'default'    => '',
          'full_width' => true,
        ),
      )
    );

    // javascript code
    $sections[] = array(
      'title'  => esc_html__( 'Javascript Code', 'wordtrap' ),
      'id'     => 'template-js',
      'icon'   => 'dashicons dashicons-editor-code',
      'fields' => array(
        array(
          'id'         => 'js-code',
          'title'      => esc_html__( 'Javascript Code', 'wordtrap' ),
          'type'       => 'ace_editor',
          'mode'       => 'javascript',
          'theme'      => 'chrome',
          'default'    => '',
          'full_width' => true
        ),
      )
    );

    Redux_Metaboxes::set_box(
      self::METABOX_OPTION,
      array(
        'id'         => 'wordtrap-template-metaboxes',
        'title'      => esc_html__( 'Template Options', 'wordtrap' ),
        'post_types' => array( self::POST_TYPE ),
        'position'   => 'normal',
        'priority'   => 'high',
        'sections'   => $sections,
      )
    );
  }  

  /**
   * Get posts or taxonomies by search query
   */
  public function ajax_search_query() {
    check_ajax_referer( 'wordtrap-template-conditions', 'nonce' );
    
    $query = sanitize_text_field( $_REQUEST[ 'q' ] );
    $type = sanitize_text_field( $_REQUEST[ 'type' ] );
    $sub_type = sanitize_text_field( $_REQUEST[ 'sub_type' ] );

    $response = array();
    if ( ! $sub_type || $type == $sub_type ) {
      if ( post_type_exists( $type ) ) {
        global $wpdb;
        $results = $wpdb->get_results(
          $wpdb->prepare(
            "SELECT ID AS id, post_title AS title
              FROM {$wpdb->posts} 
              WHERE post_status = 'publish' AND ( ID = %d OR post_title LIKE '%%%s%%' ) AND post_type='" . $type . "'",
            intval( $query ) ? intval( $query ) : -1,
            $wpdb->esc_like( stripslashes( $query ) )
          ),
          ARRAY_A
        );

        if ( is_array( $results ) && ! empty( $results ) ) {
          foreach ( $results as $value ) {
            $response[] = array(
              'id'    => intval( $value[ 'id' ] ),
              'value' => esc_html( $value[ 'title' ] ),
            );
          }
        }
      }
    } elseif ( taxonomy_exists( $sub_type ) ) {
      $results = get_terms(
        array(
          'taxonomy'   => $sub_type,
          'hide_empty' => false,
          'search'     => $query,
        )
      );

      if ( is_array( $results ) && ! empty( $results ) ) {
        foreach ( $results as $value ) {
          $response[] = array(
            'id'    => intval( $value->term_id ),
            'value' => esc_html( $value->name ),
          );
        }
      }
    }
    
    echo json_encode( $response );
    die;
  }

  /**
   * Save singular conditions
   */
  public function ajax_save_singular_conditions() {
    check_ajax_referer( 'wordtrap-singular-conditions', 'nonce' );
    
    $post_id = sanitize_text_field( $_REQUEST[ 'post_id' ] );
    if ( ! $post_id && ! intval( $post_id ) ) {
      die;
    }

    $conditions = $this->_get_condition_values();
    update_post_meta( $post_id, WORDTRAP_SINGULAR_CONDITIONS, $conditions );

    // update page layout display conditions
    wordtrap_page_layout_save_conditions();
    die;
  }

  /**
   * Save archive conditions
   */
  public function ajax_save_archive_conditions() {
    check_ajax_referer( 'wordtrap-archive-conditions', 'nonce' );
    
    $post_id = sanitize_text_field( $_REQUEST[ 'post_id' ] );
    if ( ! $post_id && ! intval( $post_id ) ) {
      die;
    }

    $conditions = $this->_get_condition_values();
    update_post_meta( $post_id, WORDTRAP_ARCHIVE_CONDITIONS, $conditions );

    // update page layout display conditions
    wordtrap_page_layout_save_conditions();
    die;
  }

  /**
   * Get condition values
   */
  private function _get_condition_values() {
    $check = $_REQUEST[ 'check' ];
    $select = $_REQUEST[ 'select' ];
    $check = is_array( $check ) ? $check : array();
    $select = is_array( $select ) ? $select : array();

    $option_values = array();
    $option_values[ 'checked' ] = array();
    $option_values[ 'selected' ] = array();
    
    foreach ( $check as $key => $value ) {
      $option_values[ 'checked' ][] = sanitize_text_field( $key );
    }

    foreach ( $select as $key => $values ) {
      if ( ! is_array( $values ) ) {
        continue;
      }

      $key = sanitize_text_field( $key );
      $option_values[ 'selected' ][ $key ] = array();
      foreach ( $values as $value ) {
        $option_values[ 'selected' ][ $key ][] = sanitize_text_field( $value );
      }
    }

    return $option_values;
  }

  /**
   * Save post
   * 
   * @params int      @post_id    Post ID.
   *         WP_Post  @post       Post Object.
   *         bool     @update     Whether this is an existing post being updated.
   */
  public function save_post( $post_id ) {
    if ( self::POST_TYPE !== get_post_type( $post_id ) ) return;
    
    // update page layout display conditions
    wordtrap_page_layout_save_conditions();
  }
}

new Wordtrap_Templates_Builder();
