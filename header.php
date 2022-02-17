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

// $bootstrap_version = get_theme_mod( 'wordtrap_bootstrap_version', 'bootstrap4' );
// $navbar_type       = get_theme_mod( 'wordtrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div id="page" class="site">

	<a class="skip-link sr-only sr-only-focusable" href="#content"><?php _e( 'Skip to content', 'wordtrap' ); ?></a>

	<header id="masthead" class="site-header">		

		<!-- <?php get_template_part( 'teamplate-parts/navbar', $navbar_type . '-' . $bootstrap_version ); ?> -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
