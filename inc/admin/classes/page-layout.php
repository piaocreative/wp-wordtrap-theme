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

  // Layout options
  private $options = array();

  // Template list
  private $template_list;

  // Template slug
  private $post_type = Wordtrap_Templates_Builder::POST_TYPE;

  // Template type meta key
  private $meta_type = Wordtrap_Templates_Builder::TEMPLATE_TYPE;

  // Template conditions meta key
  private $meta_conditions = '_wordtrap_template_conditions';
  
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
    wp_enqueue_script( 'wordtrap-admin-page-layout', WORDTRAP_ADMIN_URI . '/assets/js/page-layout.js', array( 'wordtrap-admin' ), WORDTRAP_VERSION, true );
  }

  /**
   * Load template list
   */
  public function load_template_list() {
    $types = array( 'header', 'left-sidebar', 'content', 'right-sidebar', 'footer' );
    $this->template_list = array();

    // load templates
    foreach ( $types as $type ) {
      $posts = get_posts(
        array(
          'post_type'   => $this->post_type,
          'meta_key'    => $this->meta_type,
          'meta_value'  => $type,
          'numberposts' => -1,
        )
      );

      $this->template_list[$type][0] = esc_html__( 'Select', 'wordtrap' );

      foreach ( $posts as $post ) {
        $this->template_list[$type][$post->ID] = $post->post_title;
      }
    }
  }

  /**
   * Load page layout options
   */
  private function load_options() {
    $this->options = array(
      'header'           => array(
        'note'           => array(
          'control'      => 'heading',
          'label'        => sprintf( 
            esc_html__( 'Select one of existing headers or %1$screate a new header%2$s.', 'wordtrap' ), 
            '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->meta_type . '=header' ) ) . '" target="_blank">', '</a>' 
          ),
        ),
        'template-blocks' => array(
          'control'      => 'select',
          'label'        => esc_html__( 'Select Header', 'wordtrap' ),
          'choices'      => $this->template_list['header'],
        ),
      ),
      'left-sidebar'     => array(
        'note'           => array(
          'control'      => 'heading',
          'label'        => sprintf( 
            esc_html__( 'Select one of existing left sidebars or %1$screate a new left sidebar%2$s.', 'wordtrap' ), 
            '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->meta_type . '=left-sidebar' ) ) . '" target="_blank">', '</a>' 
          ),
        ),
        'template-blocks' => array(
          'control'      => 'select',
          'label'        => esc_html__( 'Select Left Sidebar', 'wordtrap' ),
          'choices'      => $this->template_list['left-sidebar'],
        ),
      ),
      'content'          => array(
        'note'           => array(
          'control'      => 'heading',
          'label'        => sprintf( 
            esc_html__( 'Select one of existing content or %1$screate a new content%2$s.', 'wordtrap' ), 
            '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->meta_type . '=content' ) ) . '" target="_blank">', '</a>' 
          ),
        ),
        'template-blocks' => array(
          'control'      => 'select',
          'label'        => esc_html__( 'Select Content', 'wordtrap' ),
          'choices'      => $this->template_list['content'],
        ),
      ),
      'right-sidebar'     => array(
        'note'           => array(
          'control'      => 'heading',
          'label'        => sprintf( 
            esc_html__( 'Select one of existing right sidebars or %1$screate a new right sidebar%2$s.', 'wordtrap' ), 
            '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->meta_type . '=right-sidebar' ) ) . '" target="_blank">', '</a>' 
          ),
        ),
        'template-blocks' => array(
          'control'      => 'select',
          'label'        => esc_html__( 'Select Right Sidebar', 'wordtrap' ),
          'choices'      => $this->template_list['right-sidebar'],
        ),
      ),
      'footer'           => array(
        'note'           => array(
          'control'      => 'heading',
          'label'        => sprintf( 
            esc_html__( 'Select one of existing footers or %1$screate a new footer%2$s.', 'wordtrap' ), 
            '<a href="' . esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->meta_type . '=footer' ) ) . '" target="_blank">', '</a>' 
          ),
        ),
        'template-blocks' => array(
          'control'      => 'select',
          'label'        => esc_html__( 'Select Footer', 'wordtrap' ),
          'choices'      => $this->template_list['footer'],
        ),
      ),
    );
  }

  /**
   * Load page
   */
  public function load_page() {
    $this->load_template_list();
    $this->load_options();
    require get_template_directory() . '/inc/admin/templates/page-layout.php';
  }

  /**
   * Add control block
   */
  private function add_control( $setting, $args, $selected_block = '' ) {
    ?>
    <div class="option<?php echo 'preset' == $selected_block ? ' preset' : ''; ?>"<?php echo isset( $args['condition'] ) ? 'data-condition=' . json_encode( $args['condition'] ) : ''; ?>>
      <?php if ( 'select' == $args['control'] ) : ?>
      
        <label><?php echo esc_html( $args['label'] ); ?></label>
        
        <select class="<?php echo esc_attr( $setting ); ?>">
        <?php foreach ( $args['choices'] as $key => $value ) : ?>
          <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $selected_block, $key ); ?>><?php echo esc_html( $value ); ?></option>
        <?php endforeach ?>
        </select>
        
        <a href="#" class="layout-action layout-action-condition" title="<?php esc_html_e( 'Display Condition', 'wordtrap' ); ?>"><i class="dashicons dashicons-admin-generic"></i></a>
        <a href="#" class="layout-action layout-action-open" title="<?php esc_html_e( 'Open', 'wordtrap' ); ?>"><i class="dashicons dashicons-edit"></i></a>
        <a href="#" class="layout-action layout-action-remove" title="<?php esc_html_e( 'Remove', 'wordtrap' ); ?>"><i class="dashicons dashicons-no"></i></a>
      
      <?php elseif ( 'heading' == $args['control'] ) : ?>
      
        <h4 class="heading"><?php echo $args['label']; ?></h4>
      
      <?php endif ?>
    </div>
    <?php
  }
}

// Create admin dashboard instance
new Wordtrap_Admin_Page_Layout();