<?php
/**
 * The archive template file for faq post type
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$categories = get_categories(
  array(
    'taxonomy'   => 'faq_category',
    'hide_empty' => true,
    'orderby'    => wordtrap_options( 'faqs-cat-orderby' ),
    'order'      => wordtrap_options( 'faqs-cat-order' ),
  )
);

get_header();
?>

<?php
if ( have_posts() ) :
  ?>

  <div class="faqs-wrap categories-filter-wrap">

    <ul class="categories-filter nav">
      <li class="nav-item"><a data-filter="*" class="nav-link active" href="#"><?php esc_html_e( 'Show All', 'wordtrap' ); ?></a></li>
      <?php foreach ( $categories as $category ) : ?>
        <li class="nav-item"><a data-filter="faq_category-<?php echo esc_attr( $category->slug ); ?>" class="nav-link" href="#"><?php echo esc_html( $category->name ); ?></a></li>
      <?php endforeach; ?>
    </ul>

    <div class="faqs categories-filter-items accordion" id="faq-accordion">
    
      <?php
      // Load posts loop.
      while ( have_posts() ) {
        the_post();

        get_template_part( 'template-parts/faq/content' );
      }
      ?>
    
    </div><!-- .faqs -->

  </div>

  <?php
else :

  // If no content, include the "No posts found" template.
  get_template_part( 'template-parts/content/content', 'none' );

endif;
?>

<?php
get_footer();
