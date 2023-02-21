<?php
/**
 * Load wordtrap admin page layout
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! class_exists( 'Wordtrap_Admin_Page_Layout' ) ) {
  return;
}

/**
 * Class Wordtrap_Admin_Page_Layout
 *
 * Admin page layout class.
 *
 * @access public
 */
class Wordtrap_Admin_Page_Layout {

  // Layout blocks
  private $blocks = array();

  // Template list
  private $template_list;

  // Template slug
  private $post_type = Wordtrap_Templates_Builder::POST_TYPE;

  // Template type
  private $template_type = Wordtrap_Templates_Builder::TEMPLATE_TYPE;

  /**
   * Constructor
   *
   * add toolbar menus, admin menus, enqueue styles and scripts
   */
  public function __construct() {
    if ( current_user_can( 'edit_theme_options' ) ) {
      if ( is_super_admin() && is_admin_bar_showing() ) {
        add_action( 'wp_before_admin_bar_render', array( $this, 'toolbar_menu' ) );
      }

      if ( is_admin() ) {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
      }

      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
      add_action( 'wp_ajax_wordtrap_page_layout_open_template', array( $this, 'get_template_url' ) );
      add_action( 'wp_ajax_wordtrap_page_layout_conditions', array( $this, 'get_template_conditions' ) );
      add_action( 'wp_ajax_wordtrap_page_layout_save', array( $this, 'save_layout' ) );
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
      array( 'class' => 'wordtrap-menu' )
    );

    // Add sub menus
    wordtrap_add_toolbar_node( 
      __( 'Page Layout', 'wordtrap' ), 
      'wordtrap', 
      admin_url( 'admin.php?page=wordtrap' ), 
      'wordtrap-page-layout' 
    );
    
    wordtrap_add_toolbar_node( 
      __( 'Customize', 'wordtrap' ), 
      'wordtrap', 
      admin_url( 'customize.php' ) ,
      'wordtrap-customize'
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
      array( $this, 'load_page' ), 
      'dashicons-wordtrap-logo', 
      59 
    );

    add_submenu_page( 
      'wordtrap', 
      __( 'Page Layout', 'wordtrap' ), 
      __( 'Page Layout', 'wordtrap' ), 
      'administrator', 
      'wordtrap', 
      array( $this, 'load_page' ) 
    );

    add_submenu_page( 
      'wordtrap', 
      __( 'Customize', 'wordtrap' ), 
      __( 'Customize', 'wordtrap' ), 
      'administrator', 
      'customize.php' 
    );
  }

  /** 
   * Enqueue styles and scripts
   */
  public function enqueue() {
    wp_enqueue_style( 'wordtrap-admin-page-layout', WORDTRAP_ADMIN_URI . '/assets/css/page-layout.css', array( 'wordtrap-admin' ), WORDTRAP_VERSION );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );
        
    wp_enqueue_script( 'wordtrap-admin-page-layout', WORDTRAP_ADMIN_URI . '/assets/js/page-layout.js', array( 'wordtrap-admin', 'jquery-ui-sortable', 'jquery-ui-dialog' ), WORDTRAP_VERSION, true );
    wp_localize_script( 'wordtrap-admin-page-layout', 'wordtrap_page_layout',
      array( 
        'select_template' => __( 'Please select a template.', 'wordtrap' ),
        'template_not_exist' => __( 'The template does not exist.', 'wordtrap' ),
        'nonce' => wp_create_nonce( 'wordtrap-page-layout' ),
      )
    );
  }

  /**
   * Load page
   */
  public function load_page() {
    $this->load_template_list();
    $this->load_blocks();
    require get_template_directory() . '/inc/admin/templates/page-layout.php';
  }

  /**
   * Load template list
   */
  public function load_template_list() {
    $types = array( 'header', 'left-sidebar', 'main', 'right-sidebar', 'footer' );
    $this->template_list = array();

    // load templates
    foreach ( $types as $type ) {
      $posts = get_posts(
        array(
          'post_type'   => $this->post_type,
          'meta_key'    => $this->template_type,
          'meta_value'  => $type,
          'numberposts' => -1,
        )
      );

      $this->template_list[ $type ] = array();

      foreach ( $posts as $post ) {
        $this->template_list[ $type ][ $post->ID ] = $post->post_title;
      }
    }
  }

  /**
   * Load page layout blocks
   */
  private function load_blocks() {
    $layout_option = get_option( WORDTRAP_PAGE_LAYOUT, array() );

    $this->blocks = array(
      'header'        => array(
        'heading'     => esc_html__( 'Header', 'wordtrap' ), 
        'templates'   => $this->template_list[ 'header' ],
        'selected'    => isset( $layout_option[ 'header' ] ) ? $layout_option[ 'header' ] : array()
      ),
      'left-sidebar'  => array(
        'heading'     => esc_html__( 'Left Sidebar', 'wordtrap' ), 
        'templates'   => $this->template_list[ 'left-sidebar' ],
        'selected'    => isset( $layout_option[ 'left-sidebar' ] ) ? $layout_option[ 'left-sidebar' ] : array()
      ),
      'main'          => array(
        'heading'     => esc_html__( 'Main', 'wordtrap' ), 
        'templates'   => $this->template_list[ 'main' ],
        'selected'    => isset( $layout_option[ 'main' ] ) ? $layout_option[ 'main' ] : array()
      ),
      'right-sidebar' => array(
        'heading'     => esc_html__( 'Right Sidebar', 'wordtrap' ), 
        'templates'   => $this->template_list[ 'right-sidebar' ],
        'selected'    => isset( $layout_option[ 'right-sidebar' ] ) ? $layout_option[ 'right-sidebar' ] : array()
      ),
      'footer'        => array(
        'heading'     => esc_html__( 'Footer', 'wordtrap' ), 
        'templates'   => $this->template_list[ 'footer' ],
        'selected'    => isset( $layout_option[ 'footer' ] ) ? $layout_option[ 'footer' ] : array()
      ),
    );
  }

  /**
   * Add block heading
   */
  private function add_block_heading( $block ) {
    $heading = $this->blocks[ $block ][ 'heading' ];
    ?>
    <h3>
      <?php echo esc_html( $heading ); ?>
      <a target="_blank" href="<?php echo esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->template_type . '=' . $block ) ) ?>" class="button"><?php esc_html_e( 'Manage', 'wordtrap' ) ?></a>
    </h3>
    <?php
  }

  /**
   * Add control block
   */
  private function add_control_block( $type ) {
    $templates = $this->blocks[ $type ][ 'templates' ];
    $selected = $this->blocks[ $type ][ 'selected' ];
    $template_ids = array_keys( $templates );
    if ( sizeof( $templates ) ) :
      ?>
      <ul class="layout-templates">
        <?php foreach ( $selected as $select ) : 
          if ( ! in_array( $select, $template_ids ) ) continue;
          ?>
          <li>
            <div class="option">
              <div class="sort"><i class="dashicons dashicons-sort"></i></div>
              <select class="template-blocks">
                <option value=""><?php esc_html_e( 'Select template', 'wordtrap' ) ?></option>
                <?php foreach ( $templates as $id => $name ) : ?>
                  <option value="<?php echo esc_attr( $id ); ?>"<?php echo $select == $id ? ' selected' : '' ?>><?php echo esc_html( $name ); ?></option>
                <?php endforeach ?>
              </select>
              <div class="links">
                <a href="#" class="layout-action-condition" title="<?php esc_html_e( 'Display Condition', 'wordtrap' ); ?>"><i class="dashicons dashicons-admin-generic"></i></a>
                <a href="#" class="layout-action-open" title="<?php esc_html_e( 'Edit', 'wordtrap' ); ?>"><i class="dashicons dashicons-edit"></i></a>
                <a href="#" class="layout-action-remove" title="<?php esc_html_e( 'Remove', 'wordtrap' ); ?>"><i class="dashicons dashicons-no"></i></a>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="option preset">
        <div class="sort"><i class="dashicons dashicons-sort"></i></div>
        <select class="template-blocks">
          <option value=""><?php esc_html_e( 'Select template', 'wordtrap' ) ?></option>
          <?php foreach ( $templates as $id => $name ) : ?>
            <option value="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $name ); ?></option>
          <?php endforeach ?>
        </select>
        <div class="links">
          <a href="#" class="layout-action-condition" title="<?php esc_html_e( 'Display Condition', 'wordtrap' ); ?>"><i class="dashicons dashicons-admin-generic"></i></a>
          <a href="#" class="layout-action-open" title="<?php esc_html_e( 'Edit', 'wordtrap' ); ?>"><i class="dashicons dashicons-edit"></i></a>
          <a href="#" class="layout-action-remove" title="<?php esc_html_e( 'Remove', 'wordtrap' ); ?>"><i class="dashicons dashicons-no"></i></a>
        </div>
      </div>
      <div class="actions">
        <span class="spinner"></span>
        <a href="#" class="save-layout button button-primary">
          <?php _e( 'Save Changes', 'wordtrap' ) ?>
        </a>
        <a href="#" class="add-new-layout button">
          <?php _e( 'Add New Layout', 'wordtrap' ) ?>
        </a>
      </div>
      <?php      
    else :
      ?>
      <p class="message">
        <?php _e( 'There is no existing template.', 'wordtrap' ) ?>
      </p>
      <?php
    endif;
  }

  /**
   * Get template url
   */
  public function get_template_url() {
    check_ajax_referer( 'wordtrap-page-layout', '_nonce' );
    if ( ! empty( $_REQUEST[ 'id' ] ) ) {
      $id = intval( $_REQUEST[ 'id' ] );
      $link = get_edit_post_link( $id );
      wp_send_json( array( 'link' => str_replace( '&amp;', '&', $link ) ) );
    }
    die();
  }

  /**
   * Get template conditions
   */
  public function get_template_conditions() {
    check_ajax_referer( 'wordtrap-page-layout', '_nonce' );
    if ( ! empty( $_REQUEST[ 'id' ] ) ) {
      $id = intval( $_REQUEST[ 'id' ] );
      echo wordtrap_template_conditions_html( $id );
    }
    die();
  }

  /**
   * Save layout
   */
  public function save_layout() {
    check_ajax_referer( 'wordtrap-page-layout', '_nonce' );
    if ( ! empty( $_REQUEST[ 'block' ] ) && in_array( $_REQUEST[ 'block' ], array( 'header', 'left-sidebar', 'main', 'right-sidebar', 'footer' ) ) ) {
      $block = $_REQUEST[ 'block' ];
      $ids = $_REQUEST[ 'ids' ];

      $layout_option = get_option( WORDTRAP_PAGE_LAYOUT, array() );
      $layout_option[ $block ] = array();
      $added = array();
      
      foreach ( $ids as $id ) {
        if ( in_array( $id, $added ) ) continue;
        $template = get_post( $id );
        if ( ! $template ) continue;
        $template_type = get_post_meta( (int) $id, $this->template_type, true );
        if ( $template_type != $block ) continue;
        $layout_option[ $block ][] = intval( $id );
        $added[] = $id;
      }

      update_option( WORDTRAP_PAGE_LAYOUT, $layout_option );
    }

    $this->save_display_conditions();

    die();
  }

  /**
   * Save display conditions
   */
  public function save_display_conditions() {
    wordtrap_page_layout_save_conditions();
  }  
}

// Create admin dashboard instance
new Wordtrap_Admin_Page_Layout();