<?php
/**
 * Member rendering content according to caller of get_template_part
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
    if ( in_array( $layout, array( 'full-without-sidebars', 'without-sidebars' ) ) ) :
      $back_link = wordtrap_back_to_link();
      ?>
      <div id="page-header" class="page-header<?php echo $layout === 'without-sidebars' ? ' container' : '' ?>">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb links">
            <li>
              <a class="back-to-link" href="<?php echo esc_url( $back_link[ 'link' ] ); ?>">
                <?php
                  echo esc_html( $back_link[ 'title' ] );
                ?>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <?php
    endif;
    ?>  

    <?php
    if ( $layout === 'full-without-sidebars' || $layout === 'without-sidebars' ) {
      echo '<div class="overview-inner' . ( $layout === 'without-sidebars' ? ' container' : '' ) . '">';
    }
    ?>

    <div class="post-thumbnail">

      <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
        <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
      </a>

    </div><!-- .post-thumbnail -->

    <div class="content-wrap">

      <header class="entry-header">

        <?php 
        the_title(
          '<h1 class="entry-title">', '</h1>'
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
    if ( $layout === 'full-without-sidebars' || $layout === 'without-sidebars' ) {
      echo '</div>';
    }  
    ?>

  </div><!-- .overview -->

  <div class="entry-content">

    <?php the_content() ?>

  </div><!-- .entry-content -->

</article><!-- #post-## -->
