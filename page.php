<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<div id="primary" class="content-area">

		<div class="container">

			<div class="row">

				<!-- The left sidebar -->
				<?php get_template_part( 'template-parts/sidebar/left-sidebar' ); ?>

				<main id="main" class="site-main">

					<?php

					// Start the Loop.
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					endwhile; // End the loop.
					?>

				</div>

				<!-- The right sidebar -->
				<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>

			</div><!-- .row -->

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();
