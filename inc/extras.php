<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'wordtrap_body_classes' );

if ( ! function_exists( 'wordtrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function wordtrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a body class based on the presence of a sidebar.
		$sidebar_pos = get_theme_mod( 'wordtrap_sidebar_position' );
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) ) {
			$classes[] = 'wordtrap-no-sidebar';
		} elseif (
			is_page_template(
				array(
					'page-templates/both-sidebarspage.php',
					'page-templates/left-sidebarpage.php',
					'page-templates/right-sidebarpage.php',
				)
			)
		) {
			$classes[] = 'wordtrap-has-sidebar';
		} elseif ( 'none' !== $sidebar_pos ) {
			$classes[] = 'wordtrap-has-sidebar';
		} else {
			$classes[] = 'wordtrap-no-sidebar';
		}

		return $classes;
	}
}

if ( function_exists( 'wordtrap_adjust_body_class' ) ) {
	/*
	 * wordtrap_adjust_body_class() deprecated in v0.9.4. We keep adding the
	 * filter for child themes which use their own wordtrap_adjust_body_class.
	 */
	add_filter( 'body_class', 'wordtrap_adjust_body_class' );
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'wordtrap_change_logo_class' );

if ( ! function_exists( 'wordtrap_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function wordtrap_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

if ( ! function_exists( 'wordtrap_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function wordtrap_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'wordtrap_pingback' );

if ( ! function_exists( 'wordtrap_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function wordtrap_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'wordtrap_mobile_web_app_meta' );

if ( ! function_exists( 'wordtrap_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function wordtrap_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'wordtrap_body_attributes', 'wordtrap_default_body_attributes' );

// Escapes all occurances of 'the_archive_description'.
add_filter( 'get_the_archive_description', 'wordtrap_escape_the_archive_description' );

if ( ! function_exists( 'wordtrap_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function wordtrap_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
} // End of if function_exists( 'wordtrap_escape_the_archive_description' ).

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter( 'the_title', 'wordtrap_kses_title' );

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter( 'get_the_archive_title', 'wordtrap_kses_title' );

if ( ! function_exists( 'wordtrap_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function wordtrap_kses_title( $data ) {
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'img'              => array(
				'src'    => true,
				'alt'    => true,
				'width'  => true,
				'height' => true,
				'class'  => true,
				'style'  => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters( 'wordtrap_kses_title', $allowed_tags );

		return wp_kses( $data, $allowed_tags );
	}
} // End of if function_exists( 'wordtrap_kses_title' ).

if ( ! function_exists( 'wordtrap_hide_posted_by' ) ) {
	/**
	 * Hides the posted by markup in `wordtrap_posted_on()`.
	 *
	 * @param string $byline Posted by HTML markup.
	 * @return string Maybe filtered posted by HTML markup.
	 */
	function wordtrap_hide_posted_by( $byline ) {
		if ( is_author() ) {
			return '';
		}
		return $byline;
	}
}
add_filter( 'wordtrap_posted_by', 'wordtrap_hide_posted_by' );


add_filter( 'excerpt_more', 'wordtrap_custom_excerpt_more' );

if ( ! function_exists( 'wordtrap_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function wordtrap_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'wordtrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'wordtrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function wordtrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary wordtrap-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More...',
				'wordtrap'
			) . '<span class="screen-reader-text"> from ' . get_the_title( get_the_ID() ) . '</span></a></p>';
		}
		return $post_excerpt;
	}
}

if ( ! function_exists( 'wordtrap_hsl_hex' ) ) {
	/**
	 * Converts HSL to HEX colors.
	 */
	function wordtrap_hsl_hex( $h, $s, $l, $to_hex = true ) {

		$h /= 360;
		$s /= 100;
		$l /= 100;

		$r = $l;
		$g = $l;
		$b = $l;
		$v = ( $l <= 0.5 ) ? ( $l * ( 1.0 + $s ) ) : ( $l + $s - $l * $s );

		if ( $v > 0 ) {
			$m       = $l + $l - $v;
			$sv      = ( $v - $m ) / $v;
			$h      *= 6.0;
			$sextant = floor( $h );
			$fract   = $h - $sextant;
			$vsf     = $v * $sv * $fract;
			$mid1    = $m + $vsf;
			$mid2    = $v - $vsf;

			switch ( $sextant ) {
				case 0:
					$r = $v;
					$g = $mid1;
					$b = $m;
					break;
				case 1:
					$r = $mid2;
					$g = $v;
					$b = $m;
					break;
				case 2:
					$r = $m;
					$g = $v;
					$b = $mid1;
					break;
				case 3:
					$r = $m;
					$g = $mid2;
					$b = $v;
					break;
				case 4:
					$r = $mid1;
					$g = $m;
					$b = $v;
					break;
				case 5:
					$r = $v;
					$g = $m;
					$b = $mid2;
					break;
			}
		}

		$r = round( $r * 255, 0 );
		$g = round( $g * 255, 0 );
		$b = round( $b * 255, 0 );

		if ( $to_hex ) {

			$r = ( $r < 15 ) ? '0' . dechex( $r ) : dechex( $r );
			$g = ( $g < 15 ) ? '0' . dechex( $g ) : dechex( $g );
			$b = ( $b < 15 ) ? '0' . dechex( $b ) : dechex( $b );

			return "#$r$g$b";

		}

		return "rgb($r, $g, $b)";
	}
}

if ( ! function_exists( 'wordtrap_generate_post_formats' ) ) {
	/**
	 * Generate the Post Formats
	 *
	 * @return array
	 */
	function wordtrap_generate_post_formats() {
		return array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		);
	}
}