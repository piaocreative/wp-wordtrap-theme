<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// View mode
$default_view_mode = wordtrap_options( 'posts-default-view-mode') ? 'grid' : 'list';
$view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

// Post classes
$post_classes = array();
if ( wordtrap_options( 'posts-featured-image' ) && has_post_thumbnail( $post->ID ) ) {
  $post_classes[] = wordtrap_options( 'posts-' . $view_mode . '-view' );
}
?>

<article <?php post_class( $post_classes ); ?> id="post-<?php the_ID(); ?>">

  <?php if ( wordtrap_options( 'posts-featured-image' ) && has_post_thumbnail( $post->ID ) ) : ?>
    <div class="post-thumbnail<?php echo is_single() ? ' single' : ''; ?>">

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

  <div class="post-wrap">

    <header class="entry-header">

      <?php if ( wordtrap_options( 'posts-title' ) ) : ?>

        <?php 
        if ( is_sticky() && wordtrap_options( 'sticky-post-label' ) ) {
          the_title( 
            sprintf( '<h2 class="entry-title d-inline-block position-relative"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '<span class="position-absolute top-0 start-100 badge rounded-pill bg-danger fs-6 ms-2"><small>' . wordtrap_options( 'sticky-post-label' ) . '</small></span></a></h2>' 
          );
        } else {
          the_title(
            sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h2>'
          );
        }
        ?>

      <?php endif; ?>

      <div class="entry-meta">

        <?php wordtrap_post_metas(); ?>

      </div><!-- .entry-meta -->

    </header><!-- .entry-header -->

    <div class="entry-content">

      <?php the_excerpt(); ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">

      <?php wordtrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

  </div>

</article><!-- #post-## -->
