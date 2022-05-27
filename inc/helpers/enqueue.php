<?php
/**
 * Theme enqueue scripts
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', 'wordtrap_enqueue_scripts' );
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
    wp_enqueue_style( 'wordtrap-styles', $upload_dir['baseurl'] . $theme_styles, array( 'dashicons' ), $css_version );

    // Templates styles
    $templates_styles  = "/wordtrap_styles/templates{$suffix}.css";
    wp_enqueue_style( 'wordtrap-templates-styles', $upload_dir['baseurl'] . $templates_styles, array(), $css_version );

    // Font Awesome styles
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . "/vendors/fontawesome-free/css/all{$suffix}.css", array(), $css_version );

    // Theme script
    $theme_scripts = "/js/theme{$suffix}.js";
    $js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );
    wp_enqueue_script( 'wordtrap-scripts', get_template_directory_uri() . $theme_scripts, array( 'jquery', 'imagesloaded' ), $js_version, true );

    // Theme options variables
    wp_localize_script( 'wordtrap-scripts', 'wordtrap_vars',
      array( 
        'breakpoints_sm' => intval( wordtrap_options( 'grid-breakpoints-sm', 'width' ) ) ? intval( wordtrap_options( 'grid-breakpoints-sm', 'width' ) ) : 576,
        'breakpoints_md' => intval( wordtrap_options( 'grid-breakpoints-md', 'width' ) ) ? intval( wordtrap_options( 'grid-breakpoints-md', 'width' ) ) : 768,
        'breakpoints_lg' => intval( wordtrap_options( 'grid-breakpoints-lg', 'width' ) ) ? intval( wordtrap_options( 'grid-breakpoints-lg', 'width' ) ) : 992,
        'breakpoints_xl' => intval( wordtrap_options( 'grid-breakpoints-xl', 'width' ) ) ? intval( wordtrap_options( 'grid-breakpoints-xl', 'width' ) ) : 1200,
        'breakpoints_xxl' => intval( wordtrap_options( 'grid-breakpoints-xxl', 'width' ) ) ? intval( wordtrap_options( 'grid-breakpoints-xxl', 'width' ) ) : 1400,
        'sticky_header_xs' => intval( wordtrap_options( 'show-sticky-header-xs' ) ),
        'sticky_header_sm' => intval( wordtrap_options( 'show-sticky-header-sm' ) ),
        'sticky_header_md' => intval( wordtrap_options( 'show-sticky-header-md' ) ),
        'sticky_header_lg' => intval( wordtrap_options( 'show-sticky-header-lg' ) ),
        'sticky_header_xl' => intval( wordtrap_options( 'show-sticky-header-xl' ) ),
        'sticky_header_xxl' => intval( wordtrap_options( 'show-sticky-header' ) ),
        'product_thumbnails_columns' => intval( wordtrap_options( 'product-thumbnails-columns' ) ),
        'loading' => __( 'Loading...', 'wordtrap' )
      )
    );
    
    // Comment script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }
    
    wp_set_script_translations( 
      'wordtrap-i18n-js',
      'default',
      get_template_directory() . '/languages'
    );
  }
}

// Output javascript code in theme options
add_action( 'wp_head', 'wordtrap_output_js_code_in_head' );
add_action( 'wp_footer', 'wordtrap_output_js_code' );

if ( ! function_exists( 'wordtrap_output_js_code_in_head' ) ) {
  /**
   * Output javascript code in head
   */
  function wordtrap_output_js_code_in_head() {
    if ( wordtrap_options( 'js-code-head' ) ) :
      ?>
      <script>
        <?php echo trim( preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', wordtrap_options( 'js-code-head' ) ) ); ?>
      </script>
      <?php
    endif;
  }
}

if ( ! function_exists( 'wordtrap_output_js_code' ) ) {
  /**
   * Output javascript code in head
   */
  function wordtrap_output_js_code() {
    if ( wordtrap_options( 'js-code' ) ) :
      ?>
      <script>
        <?php echo trim( preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', wordtrap_options( 'js-code' ) ) ); ?>
      </script>
      <?php
    endif;
  }
}

// Output styles for showing the loading overlay
add_action( 'wp_head', 'wordtrap_output_loading_overlay_styles' );
if ( ! function_exists( 'wordtrap_output_loading_overlay_styles' ) ) {
  /**
   * Output styles for showing the loading overlay
   */
  function wordtrap_output_loading_overlay_styles() {
    if ( wordtrap_options( 'loading-overlay' ) ) :
      ?>
      <style>
        /* Loading Overlay */
        @keyframes spinner-border {
          to { transform: rotate(360deg); }
        }
        .page-loading-overlay {
          background: <?php echo wordtrap_options( 'body-bg') ? wordtrap_options( 'body-bg') : '#f5f5f5' ?>;
          position: fixed;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          z-index: 99998;
        }
        .page-loading-progress {          
          display: inline-block;
          vertical-align: -0.125em;
          border: 0.25em solid currentColor;
          border-right-color: transparent;
          border-radius: 50%;
          -webkit-animation: 0.75s linear infinite spinner-border;
          animation: 0.75s linear infinite spinner-border;
          color: <?php echo wordtrap_options( 'primary') ? wordtrap_options( 'primary') : '#3d98f4' ?>;
          position: absolute;
          width: 3rem;
          height: 3rem;
          left: 50%;
          top: 50%;
          margin-left: -1.5rem;
          margin-top: -1.5rem;
        }
        .visually-hidden {
          display: none;
        }
      </style>
      <?php
    endif;
  }
}