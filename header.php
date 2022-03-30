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

if ( wordtrap_options( 'footer-reveal' ) ) {
  $body_classes[] = 'page-footer-reveal';
}

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
  
  <div id="main">
