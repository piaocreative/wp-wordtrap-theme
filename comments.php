<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) :
  ?>
  <div class="alert alert-info no-comments" role="alert">
    <?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'wordtrap' ); ?>
  </div>  
  <?php
  return;
endif;
?>

<div class="comments-area" id="comments">

  <?php if ( have_comments() ) : ?>

    <h2 class="comments-title">

      <?php
      printf(
        esc_html(
          _nx( 'Comment %1$s', 'Comments %1$s', get_comments_number(), 'comments title', 'wordtrap' )
        ),
        '<span class="badge text-secondary">' . number_format_i18n( get_comments_number() ) . '</span>'
      );
      ?>

    </h2><!-- .comments-title -->

    <?php wordtrap_comment_navigation( 'comment-nav-above' ); ?>

    <ul class="comment-list">

      <?php
      wp_list_comments(
        array(
          'short_ping' => true,
          'avatar_size' => wordtrap_comment_avatar_size(),
          'callback'    => 'wordtrap_comment_li',
        )
      );
      ?>

    </ul><!-- .comment-list -->

    <?php wordtrap_comment_navigation( 'comment-nav-below' ); ?>

  <?php endif; // End of if have_comments(). ?>

  <?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
