<?php
/**
 * Faq rendering content according to caller of get_template_part
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
        sprintf( '<h2 class="entry-title"><span class="collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-%s" rel="bookmark">', esc_attr( get_the_id() ) ),
        '</span></h2>'
      );
    ?>      

  </header><!-- .entry-header -->

  <div id="faq-collapse-<?php echo esc_attr( get_the_id() ) ?>" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

  </div><!-- .entry-content -->

</article><!-- #post-## -->
