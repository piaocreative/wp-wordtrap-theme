<?php
/**
 * The template for displaying all single posts
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php
// Start the Loop.
while ( have_posts() ) :
  the_post();

  get_template_part( 'template-parts/content/content', 'single' );

  wordtrap_edit_post_link();

  wordtrap_post_nav();

  // If comments are open or we have at least one comment, load up the comment template.
  if ( wordtrap_options( 'post-comments' ) && ( comments_open() || get_comments_number() ) ) {
    comments_template();
  }

  // Related posts
  if ( wordtrap_options( 'post-related' ) ) {
    get_template_part( 'template-parts/post/related-posts' );
  }

endwhile; // End the loop.
?>

<?php
get_footer();
