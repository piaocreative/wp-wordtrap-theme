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

// Back to blog
$backto = $wordtrap_options['post-backto'];

// Post Layout
$post_layout = $wordtrap_options['post-layout'];

// Left Sidebar
$left_sidebar = isset( $wordtrap_options['post-left-sidebar'] ) ? $wordtrap_options['post-left-sidebar'] : '';

// Right Sidebar
$right_sidebar = isset( $wordtrap_options['post-right-sidebar'] ) ? $wordtrap_options['post-right-sidebar'] : '';

// Main Layout Classes
$main_layout_classes = 'col-md-12';

if ( ( $post_layout === 'wide-left-sidebar' || $post_layout === 'left-sidebar' ) && $left_sidebar !== '' ) {
	$main_layout_classes = 'col-md-9';
} else if ( ( $post_layout === 'wide-right-sidebar' || $post_layout === 'right-sidebar' ) && $right_sidebar !== '' ) {
	$main_layout_classes = 'col-md-9';
} else if ( $post_layout === 'wide-both-sidebars' || $post_layout === 'both-sidebars' ) {
	if ( $left_sidebar !== '' && $right_sidebar !== '' ) {
		$main_layout_classes = 'col-md-6';
	} else if ( $left_sidebar === '' && $right_sidebar !== '' ) {		
		$main_layout_classes = 'col-md-9';
	} else if ( $left_sidebar !== '' && $right_sidebar === '' ) {
		$main_layout_classes = 'col-md-9';
	}		
}

get_header();
?>

	<div id="primary" class="content-area">

		<?php if ( $post_layout === 'wide' || $post_layout === 'wide-left-sidebar' || $post_layout === 'wide-right-sidebar' || $post_layout === 'wide-both-sidebars' ) : ?>
			<div class="container-fluid">
		<?php else : ?>
			<div class="container">
		<?php endif; ?>

			<div class="row">

				<?php if ( $backto ) : ?>
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php _e( '< Back to Blog', 'wordtrap' ); ?></a>
				<?php endif; ?>

				<?php if ( $post_layout === 'wide-left-sidebar' || $post_layout === 'wide-both-sidebars' || $post_layout === 'left-sidebar' || $post_layout === 'both-sidebars' ) : ?>
					<!-- The left sidebar -->
					<?php get_template_part( 'template-parts/sidebar/left-sidebar' ); ?>				
				<?php endif; ?>

				<main id="main" class="site-main <?php echo esc_attr( $main_layout_classes ); ?>">

					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content/content', 'single' );

						// if ( is_singular( 'attachment' ) ) {
						// 	// Parent post navigation.
						// 	the_post_navigation(
						// 		array(
						// 			/* translators: %s: Parent post link. */
						// 			'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'wordtrap' ), '%title' ),
						// 		)
						// 	);
						// } elseif ( is_singular( 'post' ) ) {
						// 	// Previous/next post navigation.
						// 	the_post_navigation(
						// 		array(
						// 			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'wordtrap' ) . '</span> ' .
						// 				'<span class="screen-reader-text">' . __( 'Next post:', 'wordtrap' ) . '</span> <br/>' .
						// 				'<span class="post-title">%title</span>',
						// 			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'wordtrap' ) . '</span> ' .
						// 				'<span class="screen-reader-text">' . __( 'Previous post:', 'wordtrap' ) . '</span> <br/>' .
						// 				'<span class="post-title">%title</span>',
						// 		)
						// 	);
						// }

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

					endwhile; // End the loop.
					?>

				</main><!-- #main -->

				<?php if ( $post_layout === 'wide-right-sidebar' || $post_layout === 'wide-both-sidebars' || $post_layout === 'right-sidebar' || $post_layout === 'both-sidebars' ) : ?>
					<!-- The right sidebar -->
					<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>					
				<?php endif; ?>

			</div><!-- .row -->

		</div><!-- .container-(fluid) -->

	</div><!-- #primary -->

<?php
get_footer();
