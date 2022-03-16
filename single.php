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

// Global Theme Options
global $wordtrap_options;

// Main Layout
$layout = $wordtrap_options['layout'];

// Main Layout Classes
$main_layout_classes = 'col-md-12';

if ( $layout === 'wide-left-sidebar' || $layout === 'wide-right-sidebar' || $layout === 'left-sidebar' || $layout === 'right-sidebar' ) {
	$main_layout_classes = 'col-md-9';
} else if ( $layout === 'wide-both-sidebars' || $layout === 'both-sidebars' ) {
	$main_layout_classes = 'col-md-6';
}

get_header();
?>

	<div id="primary" class="content-area">

		<?php if ( $layout === 'wide' || $layout === 'wide-left-sidebar' || $layout === 'wide-right-sidebar' || $layout === 'wide-both-sidebars' ) : ?>
			<div class="container-fluid">
		<?php else : ?>
			<div class="container">
		<?php endif; ?>

			<div class="row">

				<?php if ( $layout === 'wide-left-sidebar' || $layout === 'wide-both-sidebars' || $layout === 'left-sidebar' || $layout === 'both-sidebars' ) : ?>
					<!-- The left sidebar -->
					<?php get_template_part( 'template-parts/sidebar/left-sidebar' ); ?>				
				<?php endif; ?>

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

				<?php if ( $layout === 'wide-right-sidebar' || $layout === 'wide-both-sidebars' || $layout === 'right-sidebar' || $layout === 'both-sidebars' ) : ?>
					<!-- The right sidebar -->
					<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>					
				<?php endif; ?>

			</div><!-- .row -->

		</div><!-- .container-(fluid) -->

	</div><!-- #primary -->

<?php
get_footer();
