<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// View mode
$view_mode = wordtrap_get_view_mode();

$post_id = get_the_ID();

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <div class="post-thumbnail">

    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
      <?php echo get_the_post_thumbnail( $post_id, 'member' ); ?>
    </a>

    <?php 
    echo wordtrap_member_follow_links();
    ?>

  </div><!-- .post-thumbnail -->

  <div class="content-wrap">

    <header class="entry-header">

      <?php 
      the_title(
        sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
        '</a></h2>'
      );
      
      $role = get_post_meta( $post_id, 'role', true );
      if ( $role ) :
        ?>
        <div class="entry-meta">
          <span class="text-primary"><?php echo $role ?></span>
        </div>
        <?php 
      endif; ?>

    </header><!-- .entry-header -->

    <div class="entry-overview">

      <?php 
      echo wordtrap_trim_excerpt( get_post_meta( $post_id, 'overview', true ), 15 );
      ?>

    </div><!-- .entry-overview -->

    <footer class="entry-footer">
      
      <?php 
      printf( '<div class="read-more"><a href="%s" rel="bookmark">' . esc_html__( 'Read More', 'wordtrap' ) . '<i class="fas fa-arrow-right"></i></a></div>', esc_url( get_permalink() ) );
      ?>

    </footer>

  </div>

</article><!-- #post-## -->
