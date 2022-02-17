<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
						?>
					</header><!-- .page-header -->

					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', get_post_format() );
					endwhile;

					// Previous/next page navigation.
					// wordtrap_the_posts_navigation();
					
				else :

					// If no content, include the "No posts found" template.
					get_template_part( 'template-parts/content/content', 'none' );

				endif;
				?>

				</main><!-- #main -->

				<!-- The right sidebar -->
				<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>

			</div><!-- .row -->
		
		</div><!-- .container -->

	</div><!-- #primary -->
	
<?php
get_footer();
