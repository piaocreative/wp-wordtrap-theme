<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Body classes
$body_classes = array();

if ( wordtrap_options( 'loading-overlay' ) ) {
  $body_classes[] = 'page-loading';
}

if ( wordtrap_options( 'footer-reveal' ) ) {
  $body_classes[] = 'page-footer-reveal';
}

// Main layout
$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];

// Primary classes
$primary_classes = array( 'content-area' );
$wrap_classes = array( 'primary-wrap' );
$inner_classes = array( 'primary-inner' );

$wrap_classes[] = 'site-layout-' . esc_attr( $layout );
if ( in_array( $layout, array( 'full-without-sidebars', 'full-left-sidebar', 'full-right-sidebar', 'full-both-sidebars' ) ) ) {
  $inner_classes[] = 'container-fluid';
} else {
  $inner_classes[] = 'container';
}

$primary_classes = apply_filters( 'wordtrap_filter_primary_classes', $primary_classes );
$wrap_classes = apply_filters( 'wordtrap_filter_primary_wrap_classes', $wrap_classes );
$inner_classes = apply_filters( 'wordtrap_filter_primary_inner_classes', $inner_classes );

// Main classes
$main_classes = array( 'site-main', 'order-2' );
if ( in_array( $layout, array( 'full-without-sidebars', 'without-sidebars' ) ) ) {
  $main_classes[] = '';
} else if ( in_array( $layout, array( 'full-left-sidebar', 'full-right-sidebar', 'left-sidebar', 'right-sidebar' ) ) ) {
  $main_classes[] = 'col-md-8 col-lg-9';
} else if ( in_array( $layout, array( 'full-both-sidebars', 'both-sidebars' ) ) ) {
  $main_classes[] = 'col-lg-6';
}

$main_classes = apply_filters( 'wordtrap_filter_site_main_classes', $main_classes );

// Main templates
$main_top_template = wordtrap_layout_template( 'main', 'main-top' );
$content_top_template = wordtrap_layout_template( 'main', 'content-top' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <!-- Favicon -->
  <?php if ( wordtrap_options( 'favicon' ) ) : ?>
    <link rel="shortcut icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', wordtrap_options( 'favicon', 'url' ) ) ); ?>" type="image/x-icon" />
  <?php endif; ?>

  <!-- iPhone Icon -->
  <?php if ( wordtrap_options( 'icon-iphone' ) ) : ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', wordtrap_options( 'icon-iphone', 'url' ) ) ); ?>">
  <?php endif; ?>

  <!-- iPhone Retina Icon -->
  <?php if ( wordtrap_options( 'icon-iphone-retina' ) ) : ?>
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', wordtrap_options( 'icon-iphone-retina', 'url' ) ) ); ?>">
  <?php endif; ?>

  <!-- iPad Icon -->
  <?php if ( wordtrap_options( 'icon-ipad' ) ) : ?>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', wordtrap_options( 'icon-ipad', 'url' ) ) ); ?>">
  <?php endif; ?>

  <!-- iPad Retina -->
  <?php if ( wordtrap_options( 'icon-ipad-retina' ) ) : ?>
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', wordtrap_options( 'icon-ipad-retina', 'url' ) ) ); ?>">
  <?php endif; ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class( implode( ' ', $body_classes ) ); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site">

  <a class="skip-link sr-only sr-only-focusable" href="#content"><?php _e( 'Skip to content', 'wordtrap' ); ?></a>

  <?php get_template_part( 'template-parts/header' ) ?>

  <?php get_template_part( 'template-parts/page-title' ) ?>    

  <div id="primary" class="<?php echo esc_attr( implode( ' ', $primary_classes ) ) ?>">

    <?php
    /**
     * Render main top template
     */
    wordtrap_render_template( $main_top_template ); 
    ?>

    <div class="<?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
        <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ) ?>">

          <div class="row">

            <?php if ( in_array( $layout, array( 'full-left-sidebar', 'full-both-sidebars', 'left-sidebar', 'both-sidebars' ) ) ) : ?>
              <?php get_template_part( 'template-parts/sidebar/sidebar', 'left' ); ?>
            <?php endif; ?>

            <main id="main" class="<?php echo esc_attr( implode( ' ', $main_classes ) ) ?>" role="main">

              <?php
              /**
               * Render content top template
               */
              wordtrap_render_template( $content_top_template ); 
              ?>
