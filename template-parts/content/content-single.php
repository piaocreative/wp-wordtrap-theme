<?php
/**
 * Single post partial template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Post classes
$post_classes = array();
$post_classes[] = wordtrap_options( 'post-view' );
?>

<article <?php post_class( $post_classes ); ?> id="post-<?php the_ID(); ?>">

  <?php if ( wordtrap_options( 'post-slideshow' ) && has_post_thumbnail( $post->ID ) ) : ?>
    <div class="post-thumbnail<?php echo is_single() ? ' single' : ''; ?>">

      <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

    </div><!-- .post-thumbnail -->
  <?php endif; ?>

  <div class="post-wrap">

    <header class="entry-header">

      <?php if ( wordtrap_options( 'post-title' ) ) : ?>

        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

      <?php endif; ?>

      <div class="entry-meta">

        <?php wordtrap_post_metas(); ?>

      </div><!-- .entry-meta -->

    </header><!-- .entry-header -->

    <div class="entry-content">

      <?php the_content(); ?>

      <?php wp_link_pages(); ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer justify-content-between">

      <?php wordtrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

  </div>

</article><!-- #post-## -->
