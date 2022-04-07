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

// View mode
$view_mode = wordtrap_get_view_mode();

// Pagination
$pagination = wordtrap_options( 'posts-pagination' );

get_header();
?>

<?php
if ( have_posts() ) :

  if ( $pagination ) : ?>
    <div class="posts-pagination-<?php echo esc_attr( $pagination ) ?>">
  <?php
  endif;

  wordtrap_posts_filter_navigation( 'posts-filter-above' );

  if ( $view_mode === 'grid' ) : ?>
    <div class="posts-grid posts-view-<?php echo esc_attr( wordtrap_options( 'posts-grid-view' ) ) ?> row <?php echo esc_attr( wordtrap_grid_view_classes() ) ?>">
  <?php
  endif;

  $prev_year           = null;
  $prev_month          = null;
  $count               = 1;
  $timeline_view       = $view_mode === 'grid' && wordtrap_options( 'posts-grid-view' ) === 'timeline';

  // Load posts loop.
  while ( have_posts() ) :
    the_post();

    $timestamp   = strtotime( get_the_date() );
    $year        = get_the_date( 'o' );
    $month       = date( 'n', $timestamp );
    
    if ( $timeline_view && ( $prev_month != $month || ( $prev_month == $month && $prev_year != $year ) ) ) :
      $post_count = 1;
      $prev_year  = $year;
      $prev_month = $month;
      ?>
      <div class="timeline-date"><span><?php echo get_the_date( 'F Y' ); ?></span></div>
    <?php endif;
    
    if ( $view_mode === 'grid' ) : 
    ?>
      <div class="post-wrap<?php echo $timeline_view ? ( ( 1 == $post_count++ % 2 ? ' left' : ' right' ) ) : '' ?>">
    <?php 
    endif;

    get_template_part( 'template-parts/content/content', get_post_format() );

    if ( $view_mode === 'grid' ) : 
    ?>
      </div>
    <?php 
    endif;
    
  endwhile;

  if ( $view_mode === 'grid' ) : ?>
    </div>
  <?php
  endif;

  wordtrap_posts_filter_navigation( 'posts-filter-below' );

  if ( $pagination ) : ?>
    </div>
  <?php
  endif;

else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
