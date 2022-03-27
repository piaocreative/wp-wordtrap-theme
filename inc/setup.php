<?php
/**
 * Theme basic setup
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_setup_theme' ) ) {
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function wordtrap_setup_theme() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on wordtrap, use a find and replace
     * to change 'wordtrap' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'wordtrap', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'primary' => __( 'Primary Menu', 'wordtrap' ),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
      )
    );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
      'custom-logo',
      array(
        'height'      => 190,
        'width'       => 190,
        'flex-width'  => false,
        'flex-height' => false,
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles.
    add_editor_style( 'css/editor.min.css' );

    // Register our custom colors as options in the editor.
    $color_palette = wordtrap_generate_color_palette();
    if ( $color_palette ) {
      add_theme_support( 'editor-color-palette', $color_palette );
    }

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support(
      'post-formats',
      wordtrap_generate_post_formats()
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background',
      apply_filters(
        'wordtrap_custom_background_args',
        array(
          'default-color' => 'ffffff',
          'default-image' => '',
        )
      )
    );

    // Add custom editor font sizes.
    add_theme_support(
      'editor-font-sizes',
      array(
        array(
          'name'      => __( 'Small', 'wordtrap' ),
          'shortName' => __( 'S', 'wordtrap' ),
          'size'      => 19.5,
          'slug'      => 'small',
        ),
        array(
          'name'      => __( 'Normal', 'wordtrap' ),
          'shortName' => __( 'M', 'wordtrap' ),
          'size'      => 22,
          'slug'      => 'normal',
        ),
        array(
          'name'      => __( 'Large', 'wordtrap' ),
          'shortName' => __( 'L', 'wordtrap' ),
          'size'      => 36.5,
          'slug'      => 'large',
        ),
        array(
          'name'      => __( 'Huge', 'wordtrap' ),
          'shortName' => __( 'XL', 'wordtrap' ),
          'size'      => 49.5,
          'slug'      => 'huge',
        ),
      )
    );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for custom line height.
    add_theme_support( 'custom-line-height' );

    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'wordtrap_content_width', 640 );

  }
}

add_action( 'after_setup_theme', 'wordtrap_setup_theme' );