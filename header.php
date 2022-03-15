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

// Global Theme Options
global $wordtrap_options;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!-- Favicon -->
	<?php if ( $wordtrap_options['favicon'] ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $wordtrap_options['favicon']['url'] ) ); ?>" type="image/x-icon" />
	<?php endif; ?>

	<!-- iPhone Icon -->
	<?php if ( $wordtrap_options['icon-iphone'] ) : ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $wordtrap_options['icon-iphone']['url'] ) ); ?>">
	<?php endif; ?>

	<!-- iPhone Retina Icon -->
	<?php if ( $wordtrap_options['icon-iphone-retina'] ) : ?>
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $wordtrap_options['icon-iphone-retina']['url'] ) ); ?>">
	<?php endif; ?>

	<!-- iPad Icon -->
	<?php if ( $wordtrap_options['icon-ipad'] ) : ?>
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $wordtrap_options['icon-ipad']['url'] ) ); ?>">
	<?php endif; ?>

	<!-- iPad Retina -->
	<?php if ( $wordtrap_options['icon-ipad-retina'] ) : ?>
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $wordtrap_options['icon-ipad-retina']['url'] ) ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div id="page" class="site">

	<a class="skip-link sr-only sr-only-focusable" href="#content"><?php _e( 'Skip to content', 'wordtrap' ); ?></a>

	<header id="header" class="site-header">

		<div class="navbar navbar-expand-lg navbar-light">
		
			<?php 
			// Header Layout
			$header_layout = $wordtrap_options['header-layout']; 
			?>
			
			<?php if ( $header_layout !== 'full' ) : ?>
				<div class="container-<?php echo $header_layout; ?>">
			<?php endif; ?>

				<!-- Logo
				============================================= -->				
				<?php echo wordtrap_logo(); ?>

				<!-- Navbar Toggler
				============================================= -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar Collapse
				============================================= -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarCollapse',
						'menu_class'      => 'navbar-nav me-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Wordtrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>

			<?php if ( $header_layout !== 'full' ) : ?>
				</div><!-- .container-(fluid) -->
			<?php endif; ?>

		</div>

	</header><!-- #header -->

	<div id="content" class="site-content">
