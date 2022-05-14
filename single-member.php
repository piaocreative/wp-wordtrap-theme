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

$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];

get_header();
?>

<?php
// Start the Loop.
while ( have_posts() ) :
  the_post();

  get_template_part( 'template-parts/member/content', 'single' );

  wordtrap_edit_post_link(); 
  
  if ( $layout === 'full-without-sidebars' ) {
    echo '<div class="container-fluid">';
  } else if ( $layout === 'without-sidebars' ) {
    echo '<div class="container">';
  }

  wordtrap_post_nav();

  // Related members
  if ( wordtrap_options( 'member-related' ) ) {
    get_template_part( 'template-parts/member/related' );
  }

  if ( $layout === 'full-without-sidebars' || $layout === 'without-sidebars' ) {
    echo '</div>';
  }

endwhile; // End the loop.
?>

<?php
get_footer();
