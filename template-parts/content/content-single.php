<?php
/**
 * Single post partial template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Show Title
$show_title = wordtrap_options( 'post-title' );
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-thumbnail<?php echo is_single() ? ' single' : ''; ?>">

		<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

	</div><!-- .post-thumbnail -->

	<header class="entry-header">

		<?php if ( $show_title ) : ?>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php endif; ?>

		<div class="entry-meta">

			<?php wordtrap_post_metas(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->	

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php wordtrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
