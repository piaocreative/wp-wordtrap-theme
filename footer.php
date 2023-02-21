<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Main templates
$main_bottom_template = wordtrap_layout_template( 'main', 'main-bottom' );
$content_bottom_template = wordtrap_layout_template( 'main', 'content-bottom' );
?>

              <?php
              /**
               * Render content bottom template
               */
              wordtrap_render_template( $content_bottom_template ); 
              ?>

          </main><!-- #main -->
          
          <?php get_sidebar() ?>

        </div>
      </div>
    </div>

    <?php
    /**
     * Render main bottom template
     */
    wordtrap_render_template( $main_bottom_template ); 
    ?>

  </div><!-- #primary -->

  <?php get_template_part( 'template-parts/footer' ) ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

