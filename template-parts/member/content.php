<?php
/**
 * Member rendering content according to caller of get_template_part
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// View mode
$view_mode = wordtrap_get_view_mode();

$post_classes = array();
if ( $view_mode === 'list' ) {
  $post_classes[] = 'medium';
}

$post_id = get_the_ID();

$view_type = wordtrap_options( 'members-view' );
$post_classes[] = 'members-view-' . $view_type;

?>

<article <?php post_class( implode( ' ', $post_classes ) ); ?> id="post-<?php the_ID(); ?>">

  <div class="post-thumbnail">

    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
      <?php echo get_the_post_thumbnail( $post_id, $view_mode === 'grid' ? 'member' : 'full' ); ?>
    </a>

    <?php if ( $view_mode === 'grid' && $view_type === '3' ) : ?>
      <header class="entry-header<?php echo wordtrap_options( 'members-follows' ) ? '' : ' no-follow-links' ?>">

        <?php 
        the_title(
          sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
          '</a></h2>'
        );
        
        $role = get_post_meta( $post_id, 'role', true );
        if ( $role ) :
          ?>
          <div class="entry-meta">
            <span><?php echo $role ?></span>
          </div>
          <?php 
        endif; 
        
        if ( $view_mode === 'grid' ) {
          echo wordtrap_member_follow_links();
        }
        ?>       

      </header><!-- .entry-header -->
    <?php else : ?>

      <?php
      if ( $view_mode === 'grid' ) {
        echo wordtrap_member_follow_links();
      } 
      ?>

    <?php endif; ?>

  </div><!-- .post-thumbnail -->

  <?php if ( $view_mode === 'list' || ( ( $view_mode === 'grid' && $view_type !== '3' ) ) || wordtrap_options( 'members-overview' ) || wordtrap_options( 'members-readmore' ) ) : ?>
    <div class="content-wrap">

      <?php if ( $view_mode === 'list' || ( $view_mode === 'grid' && $view_type !== '3' ) ) : ?>
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
              <span><?php echo $role ?></span>
            </div>
            <?php 
          endif; ?>

        </header><!-- .entry-header -->
      <?php endif; ?>

      <?php if ( wordtrap_options( 'members-overview' ) ) : ?>
        <div class="entry-overview">

          <?php 
          if ( wordtrap_options( 'members-excerpt') ) {
            if ( $view_mode === 'grid' ) {
              $excerpt_length = wordtrap_options( 'members-grid-excerpt-length') ? wordtrap_options( 'members-grid-excerpt-length') : 30;
            } else {
              $excerpt_length = wordtrap_options( 'members-list-excerpt-length') ? wordtrap_options( 'members-list-excerpt-length') : 55;
            }
            
            echo wordtrap_trim_excerpt( get_post_meta( $post_id, 'overview', true ), $excerpt_length );
          } else {
            echo get_post_meta( $post_id, 'overview', true );
          }
          ?>

        </div><!-- .entry-overview -->
      <?php endif; ?>

      <footer class="entry-footer">
        
        <?php 
        if ( wordtrap_options( 'members-readmore' ) ) {
          printf( '<div class="read-more"><a href="%s" rel="bookmark">' . ( wordtrap_options( 'members-readmore-label' ) ? wordtrap_options( 'members-readmore-label' ) : esc_html__( 'Read More', 'wordtrap' ) ) . '<i class="fas fa-arrow-right"></i></a></div>', esc_url( get_permalink() ) );
        }
        ?>

        <?php 
        if ( $view_mode !== 'grid' ) {
          echo wordtrap_member_follow_links();
        } 
        ?>
        
      </footer>

    </div>
  <?php endif; ?>

</article><!-- #post-## -->
