<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_classes = array();
$post_classes[] = 'medium';
$post_classes[] = 'member-singular';

$post_id = get_the_ID();

$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];

?>

<article <?php post_class( implode( ' ', $post_classes ) ); ?> id="post-<?php the_ID(); ?>">

  <div class="overview">

    <?php
    if ( $layout === 'full' ) {
      echo '<div class="container">';
    }
    ?>

    <div class="post-thumbnail<?php echo is_single() ? ' single' : ''; ?>">

      <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
        <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
      </a>

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
        echo apply_filters( 'the_content', get_post_meta( $post_id, 'overview', true ) );
        ?>

      </div><!-- .entry-overview -->

      <footer class="entry-footer">
        
        <?php 
        echo wordtrap_member_follow_links();
        ?>
        
      </footer>

    </div>

    <?php
    if ( $layout === 'full' ) {
      echo '</div>';
    }  
    ?>

  </div><!-- .overview -->

  <div class="entry-content">

    <?php the_content() ?>

  </div><!-- .entry-content -->

</article><!-- #post-## -->
