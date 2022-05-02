<?php
/**
 * The archive template file for faq post type
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="faqs-wrap">

  <div class="faqs accordion" id="faq-accordion">
    <?php
    if ( have_posts() ) :

      while ( have_posts() ) {
        the_post();

        get_template_part( 'template-parts/content/content', 'faq' );
      }

    endif; 
    ?>
  </div>

</div><!-- .faqs -->

<?php
get_footer();
