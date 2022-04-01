<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * 
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php
if ( have_posts() ) :

  ?>

  <div>sort by, show, view</div>
  <?php
  
  // Load posts loop.
  while ( have_posts() ) {
    the_post();
    get_template_part( 'template-parts/content/content', get_post_format() );
  }

  ?>

  <div>show, pagination</div>
  <?php

  // Previous/next page navigation.
  wordtrap_the_posts_navigation();

else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
