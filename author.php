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

get_header();
?>

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

<?php
get_footer();
