<?php
/**
 * Post rendering related members according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$related_members = wordtrap_get_related_members();

if ( ! $related_members->have_posts() ) {
  return;
}

$classes = array();
$options = array();

if ( wordtrap_options( 'member-related-carousel' ) ) {
  $slider_mode = 'carousel';

  $classes[] = 'posts-view-masonry';
  $classes[] = 'posts-slider';
  $classes[] = 'posts-' . $slider_mode;
  
  $options[ 'items' ] = wordtrap_options( 'member-related-columns-sm' );
  $options[ 'mode' ] = $slider_mode;
  $options[ 'slideBy' ] = 'page';
  $options[ 'autoplay' ] = true;
  $options[ 'autoHeight' ] = true;
  $options[ 'autoInnerHeight'] = $slider_mode === 'gallery';

  $options[ 'sm' ] = $options[ 'md' ] = $options[ 'lg' ] = $options[ 'xl' ] = $options[ 'xxl' ] = array();

  if ( $slider_mode === 'carousel' ) {
    $options[ 'gutter' ] = wordtrap_options( 'grid-gutter-width', 'width' ) ? floatval( wordtrap_options( 'grid-gutter-width', 'width' ) ) * 16 : 24;
  }  

  $options[ 'sm' ][ 'items' ] = wordtrap_options( 'member-related-columns-sm' );
  $options[ 'md' ][ 'items' ] = wordtrap_options( 'member-related-columns-md' );
  $options[ 'lg' ][ 'items' ] = wordtrap_options( 'member-related-columns-lg' );
  $options[ 'xl' ][ 'items' ] = wordtrap_options( 'member-related-columns-xl' );  
  $options[ 'xxl' ][ 'items' ] = wordtrap_options( 'member-related-columns-xxl' );  
} else {
  $classes[] = 'row';
  $classes[] = 'row-cols-sm-' . wordtrap_options( 'member-related-columns-sm' );
  $classes[] = 'row-cols-md-' . wordtrap_options( 'member-related-columns-md' );
  $classes[] = 'row-cols-lg-' . wordtrap_options( 'member-related-columns-lg' );
  $classes[] = 'row-cols-xl-' . wordtrap_options( 'member-related-columns-xl' );
  $classes[] = 'row-cols-xxl-' . wordtrap_options( 'member-related-columns-xxl' );
}

$options = json_encode( $options );
?>

<div class="entry-related show-nav-title">
  
  <h2 class="posts-title mb-4">

    <?php _e( 'Related Members', 'wordtrap' ) ?>

  </h2>

  <div class="posts-grid <?php echo esc_attr( implode( ' ', $classes ) ) ?>" data-options="<?php echo esc_attr( $options ); ?>">
    
    <?php
    while ( $related_members->have_posts() ) :
      $related_members->the_post();
      ?>
      
      <div class="post-wrap">
      
        <?php get_template_part( 'template-parts/member/content', 'related' ); ?>
      
      </div><!-- .post-wrap -->
      <?php
    endwhile;
    ?>

  </div><!-- .posts-grid -->

</div><!-- .entry-ralted -->
