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

<div class="faqs-wrap">

  <ul class="categories-filter nav">
    <li class="nav-item"><a data-filter="*" class="nav-link active" href="#"><?php esc_html_e( 'Show All', 'wordtrap' ); ?></a></li>
    <?php foreach ( $categories as $category ) : ?>
      <li class="nav-item"><a data-filter="faq_category-<?php echo esc_attr( $category->slug ); ?>" class="nav-link" href="#"><?php echo esc_html( $category->name ); ?></a></li>
    <?php endforeach; ?>
  </ul>

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
