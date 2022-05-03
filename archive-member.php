<?php
/**
 * The archive template file for member post type
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$categories = get_categories(
  array(
    'taxonomy'   => 'member_category',
    'hide_empty' => true,
    'orderby'    => wordtrap_options( 'members-cat-orderby' ),
    'order'      => wordtrap_options( 'members-cat-order' ),
  )
);

// View mode
$view_mode = wordtrap_get_view_mode();

// Pagination
$pagination = wordtrap_options( 'members-pagination' );

get_header();
?>

<?php
if ( have_posts() ) :
  ?>

  <div class="categories-filter-wrap">
  
    <?php
    if ( $pagination ) : ?>
      <div class="posts-pagination-container posts-pagination-<?php echo esc_attr( $pagination ) ?>">
    <?php
    endif;

    wordtrap_posts_filter_navigation( 'posts-filter-above', 'member_category', $categories );

    if ( $view_mode === 'grid' ) : 
      ?>
      <div class="posts-grid categories-filter-items posts-view-masonry <?php echo esc_attr( wordtrap_grid_view_classes() ) ?>">
      <?php
    else:
      ?>
      <div class="categories-filter-items">
      <?php
    endif;
    
      // Load posts loop.
      while ( have_posts() ) :
        the_post();

        if ( $view_mode === 'grid' ) : 
          ?>
            <div class="post-wrap">
          <?php 
        endif;

        get_template_part( 'template-parts/content/content', 'member' );    

        if ( $view_mode === 'grid' ) : 
          ?>
            </div><!-- .post-wrap -->
          <?php 
        endif;
        
      endwhile;

    ?>
    </div><!-- .post-wrap -->
    <?php
    wordtrap_posts_filter_navigation( 'posts-filter-below' );

    if ( $pagination ) : ?>
      </div><!-- .posts-pagination-container -->
    <?php
    endif;
    ?>
  </div>
  <?php
else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
