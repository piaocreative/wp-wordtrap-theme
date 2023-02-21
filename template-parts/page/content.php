<?php
/**
 * Partial template for content in page.php
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
    <div class="post-thumbnail">

      <?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

    </div><!-- .post-thumbnail -->
  <?php endif; ?>

  <div class="entry-content">

    <?php 
    the_content(); 
    wp_link_pages();
    ?>

  </div><!-- .entry-content -->

  <?php 
  wordtrap_entry_footer();
  wordtrap_edit_post_link(); 
  ?>

</article><!-- #post-## -->
