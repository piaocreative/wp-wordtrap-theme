<?php
/**
 * Displays the social shares
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( wordtrap_options( 'share-nofollow' ) ) {
  $nofollow = 'rel="noopener noreferrer nofollow"';
} else {
  $nofollow = 'rel="noopener noreferrer"';
}

$image = wp_get_attachment_url( get_post_thumbnail_id() );
$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
$title = get_the_title();

$extra_attr = 'target="_blank" ' . $nofollow;

?>
<div class="social-share">

<?php if ( wordtrap_options( 'share-facebook' ) ) : ?>
  <a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Facebook', 'wordtrap' ); ?>" class="share-facebook" <?php echo $extra_attr ?>><i class="fab fa-facebook-f"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-twitter' ) ) : ?>
  <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $title ); ?>&amp;url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Twitter', 'wordtrap' ); ?>" class="share-twitter" <?php echo $extra_attr ?>><i class="fab fa-twitter"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-linkedin' ) ) : ?>
  <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'wordtrap' ); ?>" class="share-linkedin" <?php echo $extra_attr ?>><i class="fab fa-linkedin-in"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-googleplus' ) ) : ?>
  <a href="https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Google +', 'wordtrap' ); ?>" class="share-googleplus" <?php echo $extra_attr ?>><i class="fab fa-google-plus-g"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-pinterest' ) ) : ?>
  <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;media=<?php echo esc_url( $image ); ?>" title="<?php esc_attr_e( 'Pinterest', 'wordtrap' ); ?>" class="share-pinterest" <?php echo $extra_attr ?>><i class="fab fa-pinterest-p"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-email' ) ) : ?>
  <a href="mailto:?subject=<?php echo urlencode( $title ); ?>&amp;body=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Email', 'wordtrap' ); ?>" class="share-email" <?php echo $extra_attr ?>><i class="fas fa-envelope"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-vk' ) ) : ?>
  <a href="https://vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>&amp;image=<?php echo esc_url( $image ); ?>&amp;noparse=true" title="<?php esc_attr_e( 'VK', 'wordtrap' ); ?>" class="share-vk" <?php echo $extra_attr ?>><i class="fab fa-vk"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-xing' ) ) : ?>
  <a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Xing', 'wordtrap' ); ?>" class="share-xing" <?php echo $extra_attr ?>><i class="fab fa-xing"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-tumblr' ) ) : ?>
  <a href="http://www.tumblr.com/share/link?url=<?php echo esc_url( $permalink ); ?>&amp;name=<?php echo urlencode( $title ); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" title="<?php esc_attr_e( 'Tumblr', 'wordtrap' ); ?>" class="share-tumblr" <?php echo $extra_attr ?>><i class="fab fa-tumblr"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-reddit' ) ) : ?>
  <a href="http://www.reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>" title="<?php esc_attr_e( 'Reddit', 'wordtrap' ); ?>" class="share-reddit" <?php echo $extra_attr ?>><i class="fab fa-reddit-alien"></i></a>
<?php endif; ?>

<?php if ( wordtrap_options( 'share-whatsapp' ) ) : ?>
  <a href="whatsapp://send?text=<?php echo rawurlencode( $title ) . ' - ' . esc_url( $permalink ); ?>" data-action="share/whatsapp/share" title="<?php esc_attr_e( 'WhatsApp', 'wordtrap' ); ?>" class="share-whatsapp" <?php echo $extra_attr ?> style="display:none"><i class="fab fa-whatsapp"></i></a>
<?php endif; ?>

</div>
