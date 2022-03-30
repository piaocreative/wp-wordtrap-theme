<?php
/**
 * 
 *
 * 
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_post_metas' ) ) {
	/**
	 * 
	 */
	function wordtrap_post_metas() {
		// Global Theme Options
		global $wordtrap_options;

		// Post metas available
		$post_metas = $wordtrap_options['post-metas'];

		if ( in_array( 'date', $post_metas ) ) {
			$time_string = '<time class="entry-date post-published post-updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date post-published" datetime="%1$s">%2$s</time><time class="post-updated" datetime="%3$s"> (%4$s) </time>';
			}

			// Time String
			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			// Post Date
			$posted_on_date = apply_filters(
				'wordtrap_posted_on_date',
				sprintf(
					'<span class="post-date"><a href="%1$s" rel="bookmark">%2$s</a></span>',
					esc_url( get_permalink() ),
					apply_filters( 'wordtrap_posted_on_time', $time_string )
				)
			);

			echo $posted_on_date;
		}

		// Post Author
		if ( in_array( 'author', $post_metas ) ) {
			$posted_by_author = apply_filters(
				'wordtrap_posted_by_author',
				sprintf(
					'<span class="post-author"><a href="%1$s">%2$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				)
			);

			echo $posted_by_author;
		}

		// Post Comments		
		if ( comments_open() && in_array( 'comments', $post_metas ) ) {
			echo '<span class="post-comments">';
			comments_popup_link( esc_html__( 'Leave a Comment', 'wordtrap' ), esc_html__( '1 Comment', 'wordtrap' ), esc_html__( '% Comments', 'wordtrap' ) );
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'wordtrap_entry_footer' ) ) {
	/**
	 * 
	 */
	function wordtrap_entry_footer() {
		// Global Theme Options
		global $wordtrap_options;

		// Post metas available
		$post_metas = $wordtrap_options['post-metas'];

		if ( 'post' === get_post_type() ) {
			$social_share = wordtrap_social_share();
			if ( $social_share ) {
				printf( '<div class="social-share">' . esc_html__( '%s', 'wordtrap' ) . '</div>', $social_share );
			}
		}

		if ( 'post' === get_post_type() && in_array( 'cats', $post_metas ) ) {
			$cats = get_the_category_list( esc_html__( ' ', 'wordtrap' ) );
			if ( $cats ) {
				printf( '<div class="post-cats">' . esc_html__( '%s', 'wordtrap' ) . '</div>', $cats );
			}
		}
	}
}

if ( ! function_exists( 'wordtrap_social_share' ) ) {
	/**
	 * 
	 */
	function wordtrap_social_share() {
		// Global Theme Options
		global $wordtrap_options;
		
		$nofollow = ' ';
		if ( $wordtrap_options['share-nofollow'] ) {
			$nofollow = 'rel="noopener noreferrer nofollow"';
		} else {
			$nofollow = 'rel="noopener noreferrer"';
		}

		$image = wp_get_attachment_url( get_post_thumbnail_id() );
		$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );

		ob_start();
		?>
		
		<?php if ( $wordtrap_options['share-facebook'] ) : ?>
			<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Facebook', 'wordtrap' ); ?>" class="share-facebook"><?php esc_html_e( 'Facebook', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-twitter'] ) : ?>
			<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $title ); ?>&amp;url=<?php echo esc_url( $permalink ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Twitter', 'wordtrap' ); ?>" class="share-twitter"><?php esc_html_e( 'Twitter', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-linkedin'] ) : ?>
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'LinkedIn', 'wordtrap' ); ?>" class="share-linkedin"><?php esc_html_e( 'LinkedIn', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-googleplus'] ) : ?>
			<a href="https://plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Google +', 'wordtrap' ); ?>" class="share-googleplus"><?php esc_html_e( 'Google +', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-pinterest'] ) : ?>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( $permalink ); ?>&amp;media=<?php echo esc_url( $image ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Pinterest', 'wordtrap' ); ?>" class="share-pinterest"><?php esc_html_e( 'Pinterest', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-email'] ) : ?>
			<a href="mailto:?subject=<?php echo urlencode( $title ); ?>&amp;body=<?php echo esc_url( $permalink ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Email', 'wordtrap' ); ?>" class="share-email"><?php esc_html_e( 'Email', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-vk'] ) : ?>
			<a href="https://vk.com/share.php?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>&amp;image=<?php echo esc_url( $image ); ?>&amp;noparse=true" target="_blank" $nofollow title="<?php esc_attr_e( 'VK', 'wordtrap' ); ?>" class="share-vk"><?php esc_html_e( 'VK', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-xing'] ) : ?>
			<a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo esc_url( $permalink ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Xing', 'wordtrap' ); ?>" class="share-xing"><?php esc_html_e( 'Xing', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-tumblr'] ) : ?>
			<a href="http://www.tumblr.com/share/link?url=<?php echo esc_url( $permalink ); ?>&amp;name=<?php echo urlencode( $title ); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Tumblr', 'wordtrap' ); ?>" class="share-tumblr"><?php esc_html_e( 'Tumblr', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-reddit'] ) : ?>
			<a href="http://www.reddit.com/submit?url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>" target="_blank" $nofollow title="<?php esc_attr_e( 'Reddit', 'wordtrap' ); ?>" class="share-reddit"><?php esc_html_e( 'Reddit', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php if ( $wordtrap_options['share-whatsapp'] ) : ?>
			<a href="whatsapp://send?text=<?php echo rawurlencode( $title ) . ' - ' . esc_url( $permalink ); ?>" data-action="share/whatsapp/share" <?php echo porto_filter_output( $nofollow . $tooltip ); ?> title="<?php esc_attr_e( 'WhatsApp', 'wordtrap' ); ?>" class="share-whatsapp" style="display:none"><?php esc_html_e( 'WhatsApp', 'wordtrap' ); ?></a>
		<?php endif; ?>

		<?php
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
}

if ( ! function_exists( 'wordtrap_comment_navigation' ) ) {
	/**
	 * 
	 *
	 * @param string $nav_id - The ID of the comment navigation.
	 */
	function wordtrap_comment_navigation( $nav_id ) {
		if ( get_comment_pages_count() <= 1 ) {
			return;
		}
		?>
		<nav class="comment-navigation" id="<?php echo esc_attr( $nav_id ); ?>">

			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wordtrap' ); ?></h1>

			<?php if ( get_previous_comments_link() ) { ?>
				<div class="nav-previous">
					<?php previous_comments_link( __( '&larr; Older Comments', 'wordtrap' ) ); ?>
				</div>
			<?php } ?>

			<?php if ( get_next_comments_link() ) { ?>
				<div class="nav-next">
					<?php next_comments_link( __( 'Newer Comments &rarr;', 'wordtrap' ) ); ?>
				</div>
			<?php } ?>

		</nav>
		<?php
	}
}

if ( ! function_exists( 'wordtrap_post_nav' ) ) {
	/**
	 * 
	 */
	function wordtrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wordtrap' ); ?></h2>
			<div class="d-flex nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous', 'wordtrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next', 'wordtrap' ) );
				}
				?>
			</div>
		</nav>
		<?php
	}
}