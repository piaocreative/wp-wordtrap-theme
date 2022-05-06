<?php
/**
 * The template for displaying 404 pages (not found)
 * 
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="error-404 not-found">

  <header class="page-header mt-5">

    <h1 class="page-title text-primary"><?php _e( 'we&rsquo;re sorry', 'wordtrap' ); ?></h1>

  </header><!-- .page-header -->

  <div class="page-content">

    <p class="lead">
      <?php _e( 'but the page you were looking for doesn&rsquo;t exist', 'wordtrap' ); ?>

      <img src="<?php echo get_template_directory_uri() . '/images/404.png' ?>" alt="<?php esc_html_e( '404', 'wordtrap' ) ?>"/>
    </p>

    <a class="btn btn-lg btn-primary" href="<?php echo esc_url( get_home_url( null, '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><?php _e( 'Home Page', 'wordtrap' ) ?></a>

  </div><!-- .page-content -->

</div><!-- .error-404 -->

<?php
get_footer();
