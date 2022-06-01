<?php
/**
 * Related post rendering content according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Post classes
$post_classes = array();
if ( wordtrap_options( 'posts-featured-image' ) && has_post_thumbnail( $post->ID ) ) {
  $post_classes[] = wordtrap_options( 'post-related-view' );
}
?>

<article <?php post_class( $post_classes ); ?> id="post-<?php the_ID(); ?>">

  <?php if ( wordtrap_options( 'posts-featured-image' ) && has_post_thumbnail( $post->ID ) ) : ?>
    <div class="post-thumbnail">

      <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
        <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

        <?php if ( wordtrap_options( 'posts-format' ) && $format_icon = wordtrap_post_format_icon() ) : ?>
          <div class="post-format">
            <?php echo $format_icon ?>
          </div>
        <?php endif; ?>
      </a>

    </div><!-- .post-thumbnail -->
  <?php endif; ?>

  <div class="content-wrap">

    <header class="entry-header">

      <?php if ( wordtrap_options( 'posts-title' ) ) : ?>

        <?php 
        if ( is_sticky() && wordtrap_options( 'sticky-post-label' ) ) {
          the_title( 
            sprintf( '<h2 class="entry-title d-inline-block position-relative"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '<span class="position-absolute top-0 start-100 badge rounded-pill bg-danger">' . wordtrap_options( 'sticky-post-label' ) . '</span></a></h2>' 
          );
        } else {
          the_title(
            sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h2>'
          );
        }
        ?>

      <?php endif; ?>

      <?php wordtrap_post_metas(); ?>

    </header><!-- .entry-header -->

    <div class="entry-content">

      <?php the_excerpt(); ?>

    </div><!-- .entry-content -->

    <?php wordtrap_entry_footer(); ?>

  </div>

</article><!-- #post-## -->
