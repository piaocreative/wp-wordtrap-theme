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
$view_mode = wordtrap_get_view_mode();

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <div class="post-thumbnail<?php echo is_single() ? ' single' : ''; ?>">

    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
      <?php echo get_the_post_thumbnail( $post->ID, $view_mode === 'grid' ? 'member' : 'full' ); ?>
    </a>

  </div><!-- .post-thumbnail -->

  <div class="content-wrap">

    <header class="entry-header">

      <?php 
      the_title(
        sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
        '</a></h2>'
      );
      ?>

      <?php wordtrap_post_metas(); ?>

    </header><!-- .entry-header -->

    <div class="entry-content">

      <?php the_excerpt(); ?>

    </div><!-- .entry-content -->

    <?php wordtrap_entry_footer(); ?>

  </div>

</article><!-- #post-## -->
