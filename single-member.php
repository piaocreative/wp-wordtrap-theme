<?php
/**
 * The template for displaying all single member posts
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

  get_template_part( 'template-parts/content/content', 'member' );

  wordtrap_edit_post_link();  

endwhile; // End the loop.
?>

<?php
get_footer();
