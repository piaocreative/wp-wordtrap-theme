<?php
/**
 * Compile theme styles
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Compile theme styles
if ( ! function_exists( 'wordtrap_compile_styles' ) ) {
  function wordtrap_compile_styles() {
    if ( ! current_user_can( 'manage_options' ) ) {
      return;
    }

    // Make wordtrap styles directory
    $upload_dir = wp_upload_dir();
    $style_path = $upload_dir['basedir'] . '/wordtrap_styles';
    if ( ! file_exists( $style_path ) ) {
      wp_mkdir_p( $style_path );
    }

    // Write scss variables
		ob_start();
		require get_template_directory() . '/inc/compiler/scss-variables.php';
		$scss_variables = ob_get_clean();

		file_put_contents('D:/tt.txt', $scss_variables);

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
		$compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::EXPANDED );
		$result = $compiler->compileString( $scss_variables . ' @import "theme.scss";' );

		$file = $style_path . '/theme.css';
		wordtrap_check_file_write_permission( $file );
		$wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );

		$compiler->setOutputStyle( \ScssPhp\ScssPhp\OutputStyle::COMPRESSED );
		$result = $compiler->compileString( $scss_variables . ' @import "theme.scss";' );

		$file = $style_path . '/theme.min.css';
		wordtrap_check_file_write_permission( $file );
		$wp_filesystem->put_contents( $file, $result->getCss(), FS_CHMOD_FILE );

		update_option( 'wordtrap_generate_theme_styles', true );
  }
}
add_action( 'wordtrap_compile_styles', 'wordtrap_compile_styles', 10 );

// // Generate styles when loading admin page
// if ( ! function_exists( 'wordtrap_compile_styles_on_admin' ) ) {
// 	function wordtrap_compile_styles_on_admin() {
// 		if ( ! get_option( 'wordtrap_generate_theme_styles' ) ) {
// 			do_action( 'wordtrap_compile_styles' );
// 		}
// 	}
// }
// add_action( 'admin_init', 'wordtrap_compile_styles_on_admin' );

// Generate styles after activate or update theme
if ( ! function_exists( 'wordtrap_compile_styles_after_active' ) ) {
	function wordtrap_compile_styles_after_active() {
		$wordtrap_cur_version = get_option( 'wordtrap_version' );
		if ( version_compare( WORDTRAP_VERSION, $wordtrap_cur_version, '!=' ) ) {
			do_action( 'wordtrap_compile_styles' );
			update_option( 'wordtrap_version', WORDTRAP_VERSION );
		}
	}
}
add_action( 'init', 'wordtrap_compile_styles_after_active' );