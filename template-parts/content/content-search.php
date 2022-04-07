<?php
/**
 * Search results partial template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header">

    <?php
    the_title(
      sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
      '</a></h2>'
    );
    ?>

    <?php wordtrap_post_metas(); ?>

  </header><!-- .entry-header -->

  <div class="entry-summary">

    <?php the_excerpt(); ?>

  </div><!-- .entry-summary -->

  <?php 
  if ( 'post' === get_post_type() ) {
   
    wordtrap_entry_footer();

  } 
  ?>

</article><!-- #post-## -->
