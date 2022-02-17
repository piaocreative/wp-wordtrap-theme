<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * 
 * @link http://codex.wordpress.org/Template_Hierarchy
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
				if ( have_posts() ) :

					// Load posts loop.
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content/content', get_post_format() );
					}

					// Previous/next page navigation.
					// wordtrap_the_posts_navigation();

				else :

					// If no content, include the "No posts found" template.
					get_template_part( 'template-parts/content/content', 'none' );

				endif;
				?>

				</main><!-- .site-main -->

				<!-- The right sidebar -->
				<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>

			</div><!-- .row -->

		</div><!-- .container -->

	</div><!-- .content-area -->

<?php
get_footer();
