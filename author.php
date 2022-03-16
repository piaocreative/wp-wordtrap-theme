<?php
/**
 * The template for displaying the author pages
 *
 * @link https://codex.wordpress.org/Author_Templates
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

				<main id="main" class="site-main <?php echo $main_layout_classes; ?>">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
					<?php
					if ( get_query_var( 'author_name' ) ) {
						$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
					} else {
						$curauth = get_userdata( intval( $author ) );
					}

					the_archive_title( '<h1 class="page-title">', '</h1>' );

					if ( ! empty( $curauth->ID ) ) {
						$alt = sprintf(
							/* translators: %s: author name */
							_x( 'Profile picture of %s', 'Avatar alt', 'wordtrap' ),
							$curauth->display_name
						);
						echo get_avatar( $curauth->ID, 96, '', $alt );
					}

					if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) {
						?>
						<dl>
							<?php if ( ! empty( $curauth->user_url ) ) : ?>
								<dt><?php esc_html_e( 'Website', 'wordtrap' ); ?></dt>
								<dd>
									<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
								</dd>
							<?php endif; ?>

							<?php if ( ! empty( $curauth->user_description ) ) : ?>
								<dt>
									<?php
									printf(
										/* translators: %s: author name */
										esc_html__( 'About %s', 'wordtrap' ),
										$curauth->display_name
									);
									?>
								</dt>
								<dd><?php echo esc_html( $curauth->user_description ); ?></dd>
							<?php endif; ?>
						</dl>
						<?php
					}

					if ( have_posts() ) {
						printf(
							/* translators: %s: author name */
							'<h2>' . esc_html__( 'Posts by %s', 'wordtrap' ) . '</h2>',
							$curauth->display_name
						);
					}
					?>
					</header><!-- .page-header -->

					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'author' );
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
