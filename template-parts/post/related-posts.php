<?php
/**
 * Post rendering related posts according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$related_posts = wordtrap_get_related_posts();

if ( ! $related_posts->have_posts() ) {
  return;
}

$classes = array();
$options = array();

$posts_view = wordtrap_options( 'post-related-view' );
$classes[] = 'posts-view-' . $posts_view;
if ( wordtrap_options( 'post-related-carousel' ) ) {
  $slider_mode = $posts_view === 'grid' ? 'gallery' : 'carousel';

  $classes[] = 'posts-slider';
  $classes[] = 'posts-' . $slider_mode;
  
  $options[ 'items' ] = wordtrap_options( 'post-related-columns-sm' );
  $options[ 'mode' ] = $slider_mode;
  $options[ 'slideBy' ] = 'page';
  $options[ 'autoplay' ] = true;
  $options[ 'autoHeight' ] = true;
  $options[ 'autoInnerHeight'] = $slider_mode === 'gallery';

  $options[ 'sm' ] = $options[ 'md' ] = $options[ 'lg' ] = $options[ 'xl' ] = $options[ 'xxl' ] = array();

  if ( $slider_mode === 'carousel' ) {
    $options[ 'gutter' ] = 24;
    $options[ 'xl' ][ 'gutter' ] = 30;
  }  

  $options[ 'sm' ][ 'items' ] = wordtrap_options( 'post-related-columns-sm' );
  $options[ 'md' ][ 'items' ] = wordtrap_options( 'post-related-columns-md' );
  $options[ 'lg' ][ 'items' ] = wordtrap_options( 'post-related-columns-lg' );
  $options[ 'xl' ][ 'items' ] = wordtrap_options( 'post-related-columns-xl' );  
  $options[ 'xxl' ][ 'items' ] = wordtrap_options( 'post-related-columns-xxl' );  
} else {
  $classes[] = 'row';
  $classes[] = 'row-cols-sm-' . wordtrap_options( 'post-related-columns-sm' );
  $classes[] = 'row-cols-md-' . wordtrap_options( 'post-related-columns-md' );
  $classes[] = 'row-cols-lg-' . wordtrap_options( 'post-related-columns-lg' );
  $classes[] = 'row-cols-xl-' . wordtrap_options( 'post-related-columns-xl' );
  $classes[] = 'row-cols-xxl-' . wordtrap_options( 'post-related-columns-xxl' );
}

$options = json_encode( $options );
?>

<div class="entry-related show-nav-title">
  
  <h2 class="posts-title mb-0">

    <?php _e( 'Related Posts', 'wordtrap' ) ?>

  </h2>

  <div class="posts-grid <?php echo esc_attr( implode( ' ', $classes ) ) ?>" data-options="<?php echo esc_attr( $options ); ?>">
    
    <?php
    while ( $related_posts->have_posts() ) :
      $related_posts->the_post();
      ?>
      
      <div class="post-wrap">
      
        <?php get_template_part( 'template-parts/content/content', 'related' ); ?>
      
      </div><!-- .post-wrap -->
      <?php
    endwhile;
    ?>

  </div><!-- .posts-grid -->

</div><!-- .entry-ralted -->
