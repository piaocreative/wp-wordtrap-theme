<?php
/**
 * Displays the social shares
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

 // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( wordtrap_options( 'member-nofollow' ) ) {
  $nofollow = 'rel="noopener noreferrer nofollow"';
} else {
  $nofollow = 'rel="noopener noreferrer"';
}

$id = get_the_ID();

$profile = get_post_meta( $id, 'profile', true );
$facebook = get_post_meta( $id, 'facebook', true );
$twitter = get_post_meta( $id, 'twitter', true );
$linkedin = get_post_meta( $id, 'linkedin', true );
$youtube = get_post_meta( $id, 'youtube', true );
$vimeo = get_post_meta( $id, 'vimeo', true );
$instagram = get_post_meta( $id, 'instagram', true );
$googleplus = get_post_meta( $id, 'googleplus', true );
$pinterest = get_post_meta( $id, 'pinterest', true );
$vk = get_post_meta( $id, 'vk', true );
$xing = get_post_meta( $id, 'xing', true );
$tumblr = get_post_meta( $id, 'tumblr', true );
$reddit = get_post_meta( $id, 'reddit', true );
$whatsapp = get_post_meta( $id, 'whatsapp', true );
$email = get_post_meta( $id, 'email', true );
$phone = get_post_meta( $id, 'phone', true );

$extra_attr = 'target="_blank" ' . $nofollow;

if ( ! ( $profile || $facebook || $twitter || $linkedin || $youtube || $vimeo || $instagram || $googleplus || $pinterest || $vk || $xing || $tumblr || $reddit || $whatsapp || $email || $phone ) ) {
  return;
}

?>
<div class="follow-links">

  <?php
  if ( $facebook || $twitter || $linkedin || $youtube || $vimeo || $instagram || $googleplus || $pinterest || $vk || $xing || $tumblr || $reddit || $whatsapp || $email || $phone ) :
    ?>
    <div class="social-share">

      <label><?php _e( 'Follow me', 'wordtrap' ) ?></label>

      <?php if ( $facebook ) : ?>
        <a href="<?php echo esc_url( $facebook ); ?>" title="<?php esc_attr_e( 'Facebook ', 'wordtrap' ); ?>" class="share-facebook" <?php echo $extra_attr ?>><i class="fab fa-facebook-f"></i></a>
      <?php endif; ?>

      <?php if ( $twitter ) : ?>
        <a href="<?php echo esc_url( $twitter ); ?>" title="<?php esc_attr_e( 'Twitter', 'wordtrap' ); ?>" class="share-twitter" <?php echo $extra_attr ?>><i class="fab fa-twitter"></i></a>
      <?php endif; ?>

      <?php if ( $linkedin ) : ?>
        <a href="<?php echo esc_url( $linkedin ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'wordtrap' ); ?>" class="share-linkedin" <?php echo $extra_attr ?>><i class="fab fa-linkedin-in"></i></a>
      <?php endif; ?>

      <?php if ( $youtube ) : ?>
        <a href="<?php echo esc_url( $youtube ); ?>" title="<?php esc_attr_e( 'Youtube', 'wordtrap' ); ?>" class="share-youtube" <?php echo $extra_attr ?>><i class="fab fa-youtube"></i></a>
      <?php endif; ?>

      <?php if ( $vimeo ) : ?>
        <a href="<?php echo esc_url( $vimeo ); ?>" title="<?php esc_attr_e( 'Vimeo', 'wordtrap' ); ?>" class="share-vimeo" <?php echo $extra_attr ?>><i class="fab fa-vimeo-v"></i></a>
      <?php endif; ?>

      <?php if ( $instagram ) : ?>
        <a href="<?php echo esc_url( $instagram ); ?>" title="<?php esc_attr_e( 'Instagram', 'wordtrap' ); ?>" class="share-instagram" <?php echo $extra_attr ?>><i class="fab fa-instagram"></i></a>
      <?php endif; ?>

      <?php if ( $googleplus ) : ?>
        <a href="<?php echo esc_url( $googleplus ); ?>" title="<?php esc_attr_e( 'Google +', 'wordtrap' ); ?>" class="share-googleplus" <?php echo $extra_attr ?>><i class="fab fa-google-plus-g"></i></a>
      <?php endif; ?>

      <?php if ( $pinterest ) : ?>
        <a href="<?php echo esc_url( $pinterest ); ?>" title="<?php esc_attr_e( 'Pinterest', 'wordtrap' ); ?>" class="share-pinterest" <?php echo $extra_attr ?>><i class="fab fa-pinterest-p"></i></a>
      <?php endif; ?>

      <?php if ( $vk ) : ?>
        <a href="<?php echo esc_url( $vk ); ?>" title="<?php esc_attr_e( 'VK', 'wordtrap' ); ?>" class="share-vk" <?php echo $extra_attr ?>><i class="fab fa-vk"></i></a>
      <?php endif; ?>

      <?php if ( $xing ) : ?>
        <a href="<?php echo esc_url( $xing ); ?>" title="<?php esc_attr_e( 'Xing', 'wordtrap' ); ?>" class="share-xing" <?php echo $extra_attr ?>><i class="fab fa-xing"></i></a>
      <?php endif; ?>

      <?php if ( $tumblr ) : ?>
        <a href="<?php echo esc_url( $tumblr ); ?>" title="<?php esc_attr_e( 'Tumblr', 'wordtrap' ); ?>" class="share-tumblr" <?php echo $extra_attr ?>><i class="fab fa-tumblr"></i></a>
      <?php endif; ?>

      <?php if ( $reddit ) : ?>
        <a href="<?php echo esc_url( $reddit ); ?>" title="<?php esc_attr_e( 'Reddit', 'wordtrap' ); ?>" class="share-reddit" <?php echo $extra_attr ?>><i class="fab fa-reddit-alien"></i></a>
      <?php endif; ?>

      <?php if ( $whatsapp ) : ?>
        <a href="whatsapp://send?text=<?php echo rawurlencode( $whatsapp ); ?>" data-action="share/whatsapp/share" title="<?php esc_attr_e( 'WhatsApp', 'wordtrap' ); ?>" class="share-whatsapp" <?php echo $extra_attr ?> style="display:none"><i class="fab fa-whatsapp"></i></a>
      <?php endif; ?>

      <?php if ( $email ) : ?>
        <a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php esc_attr_e( 'Email', 'wordtrap' ); ?>" class="share-email" <?php echo $extra_attr ?>><i class="fas fa-envelope"></i></a>
      <?php endif; ?>

      <?php if ( $phone ) : ?>
        <a href="tel:<?php echo esc_attr( $phone ); ?>" title="<?php esc_attr_e( 'Phone', 'wordtrap' ); ?>" class="share-phone" <?php echo $extra_attr ?>><i class="fas fa-phone"></i></a>
      <?php endif; ?>

    </div>
    <?php 
  endif; 
  
  if ( $profile ) :
    ?>

    <div class="profile">
      <a href="<?php echo esc_url( $profile ); ?>" title="<?php esc_attr_e( 'Get in Touch', 'wordtrap' ); ?>" class="share-button" <?php echo $extra_attr ?>><?php _e( 'Get in Touch', 'wordtrap' ) ?></a>
    </div>

    <?php
  endif; 
  ?>

</div><!-- .follow-links -->