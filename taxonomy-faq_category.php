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

<?php
if ( have_posts() ) :
  ?>

  <div class="faqs-wrap">

    <div class="faqs accordion" id="faq-accordion">

      <?php
      // Load posts loop.
      while ( have_posts() ) {
        the_post();

        get_template_part( 'template-parts/content/content', 'faq' );
      }
      ?>

    </div>

  </div><!-- .faqs -->

  <?php
else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>
<?php
get_footer();
