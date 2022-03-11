<?php
/**
 * The template for displaying all single posts
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

						get_template_part( 'template-parts/content/content', 'single' );

						if ( is_singular( 'attachment' ) ) {
							// Parent post navigation.
							the_post_navigation(
								array(
									/* translators: %s: Parent post link. */
									'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'wordtrap' ), '%title' ),
								)
							);
						} elseif ( is_singular( 'post' ) ) {
							// Previous/next post navigation.
							the_post_navigation(
								array(
									'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'wordtrap' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Next post:', 'wordtrap' ) . '</span> <br/>' .
										'<span class="post-title">%title</span>',
									'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'wordtrap' ) . '</span> ' .
										'<span class="screen-reader-text">' . __( 'Previous post:', 'wordtrap' ) . '</span> <br/>' .
										'<span class="post-title">%title</span>',
								)
							);
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					endwhile; // End the loop.
					?>

				</main><!-- #main -->

				<!-- The right sidebar -->
				<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>

			</div><!-- .row -->

		</div><!-- .container -->

	</div><!-- #primary -->

<?php
get_footer();