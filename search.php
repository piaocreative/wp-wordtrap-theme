<?php
/**
 * The template for displaying search results pages
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_type = ( isset( $_GET['post_type'] ) && $_GET['post_type'] ) ? sanitize_text_field( $_GET['post_type'] ) : null;
if ( isset( $post_type ) && locate_template( 'archive-' . $post_type . '.php' ) ) {
	get_template_part( 'archive', $post_type );
  exit;
}

get_header();
?>

<?php if ( have_posts() ) : ?>

  <?php
  // Start the Loop.
  while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content/content', 'search' );
  endwhile;

  ?>
  <footer class="page-navigation">
    <?php
    // Previous/next page navigation.
    wordtrap_the_posts_navigation();
    ?>
  </footer><!-- .page-navigation -->
  <?php

else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
