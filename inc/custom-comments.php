<?php
/**
 * Comment layout
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Add Bootstrap classes to comment form fields.
add_filter( 'comment_form_default_fields', 'wordtrap_bootstrap_comment_form_fields' );

if ( ! function_exists( 'wordtrap_bootstrap_comment_form_fields' ) ) {
  /**
   * Add Bootstrap classes to WP's comment form default fields.
   *
   * @param array $fields {
   *     Default comment fields.
   *
   *     @type string $author  Comment author field HTML.
   *     @type string $email   Comment author email field HTML.
   *     @type string $url     Comment author URL field HTML.
   *     @type string $cookies Comment cookie opt-in field HTML.
   * }
   *
   * @return array
   */
  function wordtrap_bootstrap_comment_form_fields( $fields ) {

    $replace = array(
      '<p class="' => '<div class="form-group mb-3 ',
      '<input'     => '<input class="form-control" ',
      '<label'     => '<label class="form-label" ',
      '</p>'       => '</div>',
    );

    if ( isset( $fields['author'] ) ) {
      $fields['author'] = strtr( $fields['author'], $replace );
    }
    if ( isset( $fields['email'] ) ) {
      $fields['email'] = strtr( $fields['email'], $replace );
    }
    if ( isset( $fields['url'] ) ) {
      $fields['url'] = strtr( $fields['url'], $replace );
    }

    $replace = array(
      '<p class="' => '<div class="form-group mb-3 form-check ',
      '<input'     => '<input class="form-check-input" ',
      '<label'     => '<label class="form-check-label" ',
      '</p>'       => '</div>',
    );
    if ( isset( $fields['cookies'] ) ) {
      $fields['cookies'] = strtr( $fields['cookies'], $replace );
    }

    return $fields;
  }
}

// Add Bootstrap classes to comment form submit button and comment field.
add_filter( 'comment_form_defaults', 'wordtrap_bootstrap_comment_form' );

if ( ! function_exists( 'wordtrap_bootstrap_comment_form' ) ) {
  /**
   * Adds Bootstrap classes to comment form submit button and comment field.
   *
   * @param string[] $args Comment form arguments and fields.
   *
   * @return string[]
   */
  function wordtrap_bootstrap_comment_form( $args ) {
    $replace = array(
      '<p class="' => '<div class="form-group mb-3 ',
      '<label' => '<label class="form-label" ',
      '<textarea'  => '<textarea class="form-control" ',
      '</p>'       => '</div>',
    );

    if ( isset( $args['comment_field'] ) ) {
      $args['comment_field'] = strtr( $args['comment_field'], $replace );
    }

    if ( isset( $args['class_submit'] ) ) {
      $args['class_submit'] = 'btn btn-primary';
    }

    return $args;
  }
}

// Add note if comments are closed.
add_action( 'comment_form_comments_closed', 'wordtrap_comment_form_comments_closed' );

if ( ! function_exists( 'wordtrap_comment_form_comments_closed' ) ) {
  /**
   * Displays a note that comments are closed if comments are closed and there are comments.
   */
  function wordtrap_comment_form_comments_closed() {
    if ( get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
      ?>
      <div class="alert alert-info no-comments"><?php esc_html_e( 'Comments are closed.', 'wordtrap' ); ?></div>
      <?php
    }
  }
}

if ( ! function_exists( 'wordtrap_comment_navigation' ) ) {
  /**
   * Show comment navigation
   *
   * @param string $nav_id - The ID of the comment navigation.
   */
  function wordtrap_comment_navigation( $nav_id ) {
    if ( get_comment_pages_count() <= 1 ) {
      return;
    }
    ?>
    <nav class="comment-navigation" id="<?php echo esc_attr( $nav_id ); ?>">

      <h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wordtrap' ); ?></h3>

      <div class="d-flex nav-links justify-content-between">
        <?php if ( get_previous_comments_link() ) { ?>
          <div class="nav-previous">
            <?php previous_comments_link( __( '<i class="fa fa-angle-left"></i>&nbsp;Older', 'wordtrap' ) ); ?>
          </div>
        <?php } ?>

        <?php if ( get_next_comments_link() ) { ?>
          <div class="nav-next">
            <?php next_comments_link( __( 'Newer&nbsp;<i class="fa fa-angle-right"></i>', 'wordtrap' ) ); ?>
          </div>
        <?php } ?>
      </div>

    </nav>
    <?php
  }
}

if ( ! function_exists( 'wordtrap_comment_avatar_size' ) ) {
  /**
   * Get comment avatar size
   */
  function wordtrap_comment_avatar_size() {
    return apply_filters( 'wordtrap_comment_avatar_size', 50 );
  }
}

if ( ! function_exists( 'wordtrap_comment_li' ) ) {
  /**
   * Comment callback
   */
  function wordtrap_comment_li( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    global $post_layout;
    ?>

    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

      <div class="comment-body d-flex">
        <div class="comment-avatar flex-shrink-0">
          <?php echo get_avatar( $comment, wordtrap_comment_avatar_size(), '', '', array(
            'class' => 'rounded-circle'
          ) ); ?>
        </div>
        <div class="comment-block flex-grow-1 ms-3">
          <div class="comment-meta">
            <span class="comment-by">
              <strong><?php echo get_comment_author_link(); ?></strong>
            </span>
          
            <?php /* translators: %s: Comment date and time */ ?>
            <span class="date"><?php printf( esc_html__( '%1$s', 'wordtrap' ), get_comment_date() ); ?></span>

            <?php if ( current_user_can( 'edit_comment', $comment ) ) : ?>
              <span> <?php edit_comment_link( esc_html__( 'Edit', 'wordtrap' ), '  ', '' ); ?></span>
            <?php endif; ?>
            
            <span> 
              <?php
              comment_reply_link(
                array_merge(
                  $args,
                  array(
                    'reply_text' => esc_html__( 'Reply', 'wordtrap' ),
                    'add_below'  => 'comment',
                    'depth'      => $depth,
                    'max_depth'  => $args['max_depth'],
                  )
                )
              );
              ?>
            </span>
          </div>

          <div>
            <?php if ( '0' == $comment->comment_approved ) : ?>
              <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'wordtrap' ); ?></em>
              <br />
            <?php endif; ?>
            <?php comment_text(); ?>
          </div>
        </div>
      </div>

    <?php
  }
}