<?php
/**
 * Compile theme styles
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_compile_styles' ) ) {
  /**
   * Compile theme styles
   * 
   * @param boolean $enqueue    Flag for enqueueing styles or generating CSS files.
   */
  function wordtrap_compile_styles( $enqueue = false ) {
    if ( ! current_user_can( 'manage_options' ) ) {
      return;
    }

    // Make wordtrap styles directory
    $upload_dir = wp_upload_dir();
    $style_path = $upload_dir['basedir'] . '/wordtrap_styles';
    if ( ! file_exists( $style_path ) ) {
      wp_mkdir_p( $style_path );
    }

    // Custom CSS
    $custom_css = wordtrap_options( 'css-code' );

    // Write scss variables
    ob_start();
    require dirname( __FILE__ ) . '/scss-variables.php';
    $scss_variables = ob_get_clean();

    // Load scss compiler
    if ( ! class_exists( 'scssc' ) ) {
      require_once get_template_directory() . '/inc/scssphp/scss.inc.php';
    }

    // Initialize the WordPress filesystem, no more using file_put_contents function
    global $wp_filesystem;
    if ( empty( $wp_filesystem ) ) {
      require_once ABSPATH . '/wp-admin/includes/file.php';
      WP_Filesystem();
    }

    // Compile styles
    $compiler = new \ScssPhp\ScssPhp\Compiler();
    $compiler->setImportPaths( get_template_directory() . '/src/sass/' );
    
    // Generate and Write styles
    if ( $enqueue ) {
      $compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::EXPANDED );

      // theme styles
      $result = $compiler->compileString( $scss_variables . ' @import "theme.scss"; ' . $custom_css );
      wp_register_style( 'wordtrap-theme-customizer', false );
      wp_enqueue_style( 'wordtrap-theme-customizer' );
      wp_add_inline_style( 'wordtrap-theme-customizer', $result->getCss() );

      // templates styles
      $result = $compiler->compileString( $scss_variables . ' @import "templates.scss";' );
      wp_register_style( 'wordtrap-templates-customizer', false );
      wp_enqueue_style( 'wordtrap-templates-customizer' );
      wp_add_inline_style( 'wordtrap-templates-customizer', $result->getCss() );
    } else {
      $compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::EXPANDED );

      // theme styles
      $result = $compiler->compileString( $scss_variables . ' @import "theme.scss"; ' . $custom_css );
      $file = $style_path . '/theme.css';
      wordtrap_check_file_write_permission( $file );
      $wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );

      // template styles
      $result = $compiler->compileString( $scss_variables . ' @import "templates.scss";' );
      $file = $style_path . '/templates.css';
      wordtrap_check_file_write_permission( $file );
      $wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );
  
      $compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
    
      // theme minimized styles
      $result = $compiler->compileString( $scss_variables . ' @import "theme.scss"; ' . $custom_css );
      $file = $style_path . '/theme.min.css';
      wordtrap_check_file_write_permission( $file );
      $wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );

      // templates minimized styles
      $result = $compiler->compileString( $scss_variables . ' @import "templates.scss";' );
      $file = $style_path . '/templates.min.css';
      wordtrap_check_file_write_permission( $file );
      $wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );
    }
  }
}
add_action( 'wordtrap_compile_styles', 'wordtrap_compile_styles', 10 );

if ( ! function_exists( 'wordtrap_compile_styles_after_active' ) ) {
  /**
   * Generate styles after activate or update theme
   */
  function wordtrap_compile_styles_after_active() {
    $wordtrap_cur_version = get_option( 'wordtrap_version' );
    if ( version_compare( WORDTRAP_VERSION, $wordtrap_cur_version, '!=' ) ) {
      do_action( 'wordtrap_compile_styles' );
      update_option( 'wordtrap_version', WORDTRAP_VERSION );
    }
  }
}
add_action( 'init', 'wordtrap_compile_styles_after_active' );