<?php
/**
 * Theme enqueue scripts
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_enqueue_scripts' ) ) {
  /**
   * Load theme's JavaScript and CSS sources.
   */
  function wordtrap_enqueue_scripts() {
    // Get the theme data.
    $the_theme         = wp_get_theme();
    $theme_version     = $the_theme->get( 'Version' );
    $suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    // Grab asset urls.
    $upload_dir    = wp_upload_dir();
    $theme_styles  = "/wordtrap_styles/theme{$suffix}.css";

    // Get version
    $css_version = $theme_version . '.' . filemtime( $upload_dir['basedir'] . $theme_styles );
    
    // Theme style
    wp_enqueue_style( 'wordtrap-styles', $upload_dir['baseurl'] . $theme_styles, array(), $css_version );

    // Templates styles
    $templates_styles  = "/wordtrap_styles/templates{$suffix}.css";
    wp_enqueue_style( 'wordtrap-templates-styles', $upload_dir['baseurl'] . $templates_styles, array(), $css_version );

    // Theme script
    $theme_scripts = "/js/theme{$suffix}.js";
    $js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );
    wp_enqueue_script( 'wordtrap-scripts', get_template_directory_uri() . $theme_scripts, array( 'jquery' ), $js_version, true );

    // Theme options variables
    global $wordtrap_options;
    wp_localize_script( 'wordtrap-scripts', 'wordtrap_vars',
      array( 
        'breakpoints_sm' => intval( $wordtrap_options[ 'grid-breakpoints-sm' ][ 'width' ] ) ? intval( $wordtrap_options[ 'grid-breakpoints-sm' ][ 'width' ] ) : 576,
        'breakpoints_md' => intval( $wordtrap_options[ 'grid-breakpoints-md' ][ 'width' ] ) ? intval( $wordtrap_options[ 'grid-breakpoints-md' ][ 'width' ] ) : 768,
        'breakpoints_lg' => intval( $wordtrap_options[ 'grid-breakpoints-lg' ][ 'width' ] ) ? intval( $wordtrap_options[ 'grid-breakpoints-lg' ][ 'width' ] ) : 992,
        'breakpoints_xl' => intval( $wordtrap_options[ 'grid-breakpoints-xl' ][ 'width' ] ) ? intval( $wordtrap_options[ 'grid-breakpoints-xl' ][ 'width' ] ) : 1200,
        'breakpoints_xxl' => intval( $wordtrap_options[ 'grid-breakpoints-xxl' ][ 'width' ] ) ? intval( $wordtrap_options[ 'grid-breakpoints-xxl' ][ 'width' ] ) : 1400,
        'sticky_header_xs' => intval( $wordtrap_options[ 'show-sticky-header-xs' ] ),
        'sticky_header_sm' => intval( $wordtrap_options[ 'show-sticky-header-sm' ] ),
        'sticky_header_md' => intval( $wordtrap_options[ 'show-sticky-header-md' ] ),
        'sticky_header_lg' => intval( $wordtrap_options[ 'show-sticky-header-lg' ] ),
        'sticky_header_xl' => intval( $wordtrap_options[ 'show-sticky-header-xl' ] ),
        'sticky_header_xxl' => intval( $wordtrap_options[ 'show-sticky-header' ] ),
      )
    );
    
    // Comment script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }    
  }
}

add_action( 'wp_enqueue_scripts', 'wordtrap_enqueue_scripts' );
