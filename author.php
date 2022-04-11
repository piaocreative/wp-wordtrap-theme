<?php
/**
 * The template for displaying the author pages
 *
 * @link https://codex.wordpress.org/Author_Templates
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

<?php if ( have_posts() ) : ?>

  <header class="author-header">
  <?php
  if ( get_query_var( 'author_name' ) ) {
    $curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
  } else {
    $curauth = get_userdata( intval( $author ) );
  }

  if ( ! empty( $curauth->ID ) ) {
    $alt = sprintf(
      /* translators: %s: author name */
      _x( 'Profile picture of %s', 'Avatar alt', 'wordtrap' ),
      $curauth->display_name
    );
    echo get_avatar( $curauth->ID, 96, '', $alt );
  }

  if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) {
    ?>
    <dl>
      <?php if ( ! empty( $curauth->user_url ) ) : ?>
        <dt><?php esc_html_e( 'Website', 'wordtrap' ); ?></dt>
        <dd>
          <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
        </dd>
      <?php endif; ?>

      <?php if ( ! empty( $curauth->user_description ) ) : ?>
        <dt>
          <?php
          printf(
            /* translators: %s: author name */
            esc_html__( 'About %s', 'wordtrap' ),
            $curauth->display_name
          );
          ?>
        </dt>
        <dd><?php echo esc_html( $curauth->user_description ); ?></dd>
      <?php endif; ?>
    </dl>
    <?php
  } else {
    ?>
    <dl>
      <dt><?php echo esc_html( $curauth->display_name ); ?></dt>
    </dl>
    <?php
  }

  if ( have_posts() ) {
    printf(
      /* translators: %s: author name */
      '<h2 class="screen-reader-text">' . esc_html__( 'Posts by %s', 'wordtrap' ) . '</h2>',
      $curauth->display_name
    );
  }
  ?>
  </header><!-- .page-header -->

  <?php 
  if ( $pagination ) : ?>
    <div class="posts-pagination-container posts-pagination-<?php echo esc_attr( $pagination ) ?>">
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
      </div><!-- .post-wrap -->
    <?php 
    endif;
    
  endwhile;

  if ( $view_mode === 'grid' ) : ?>
    </div><!-- .posts-grid -->
  <?php
  endif;

  wordtrap_posts_filter_navigation( 'posts-filter-below' );

  if ( $pagination ) : ?>
    </div><!-- .posts-pagination-container -->
  <?php
  endif;
  
else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
