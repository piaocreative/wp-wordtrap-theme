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

// Main Layout
$layout = wordtrap_options( 'layout' );

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

				<main id="main" class="site-main <?php echo $main_layout_classes; ?>">

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

				<?php if ( $layout === 'wide-right-sidebar' || $layout === 'wide-both-sidebars' || $layout === 'right-sidebar' || $layout === 'both-sidebars' ) : ?>
					<!-- The right sidebar -->
					<?php get_template_part( 'template-parts/sidebar/right-sidebar' ); ?>					
				<?php endif; ?>

			</div><!-- .row -->
		
		</div><!-- .container-(fluid) -->

	</div><!-- #primary -->
	
<?php
get_footer();
