<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php if ( have_posts() ) : ?>

  <?php
  // Start the Loop.
  while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content/content', get_post_format() );
  endwhile;

  // Previous/next page navigation.
  wordtrap_the_posts_navigation();
  
else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
