<?php
/**
 * Functions hooked to core hooks
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function blog_express_customize_search_form() {
		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
			<span class="screen-reader-text">' . esc_html_x( 'Search for:', 'label', 'blog-express' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr__( 'Enter keyword&hellip;', 'blog-express' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'blog-express' ) . '" />
			</label>
			<input type="submit" class="search-submit" value="&#xf002;" /></form>';

		return $form;
	}

endif;

add_filter( 'get_search_form', 'blog_express_customize_search_form', 15 );

if ( ! function_exists( 'blog_express_exclude_category_in_blog_page' ) ) :

	/**
	 * Exclude category in blog page.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Query $query WP_Query instance.
	 * @return WP_Query Modified instance.
	 */
	function blog_express_exclude_category_in_blog_page( $query ) {
		if ( $query->is_home() && $query->is_main_query() ) {
			$exclude_categories = blog_express_get_option( 'exclude_categories' );
			if ( ! empty( $exclude_categories ) ) {
				$categories_raw = explode( ',', $exclude_categories );
				$cats           = array();
				if ( ! empty( $categories_raw ) ) {
					foreach ( $categories_raw as $c ) {
						if ( absint( $c ) > 0 ) {
							$cats[] = absint( $c );
						}
					}
					if ( ! empty( $cats ) ) {
						$exclude_text = '';
						$exclude_text = '-' . implode( ',-', $cats );
						$query->set( 'cat', $exclude_text );
					}
				}
			}
		}

		return $query;
	}

endif;

add_filter( 'pre_get_posts', 'blog_express_exclude_category_in_blog_page' );

if ( ! function_exists( 'blog_express_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function blog_express_implement_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = blog_express_get_option( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;
	}

endif;

add_filter( 'excerpt_length', 'blog_express_implement_excerpt_length', 999 );

if ( ! function_exists( 'blog_express_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function blog_express_implement_read_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more = '&hellip;';
		return $more;
	}

endif;

add_filter( 'excerpt_more', 'blog_express_implement_read_more' );

if ( ! function_exists( 'blog_express_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function blog_express_custom_body_class( $input ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Header layout.
		$input[] = 'header-layout-1';

		// Archive layout.
		$archive_layout = blog_express_get_option( 'archive_layout' );
		$archive_layout = apply_filters( 'blog_express_filter_theme_archive_layout', $archive_layout );
		$input[]        = 'archive-layout-' . esc_attr( $archive_layout );

		// Carousel display.
		$featured_slider_enable_carousel = blog_express_get_option( 'featured_slider_enable_carousel' );
		$featured_slider_carousel_number = blog_express_get_option( 'featured_slider_carousel_number' );
		$number                          = ( false === $featured_slider_enable_carousel ) ? 1 : $featured_slider_carousel_number;
		$input[]                         = 'carousel-display-' . absint( $number );

		// Global layout.
		$global_layout = blog_express_get_option( 'global_layout' );
		$global_layout = apply_filters( 'blog_express_filter_theme_global_layout', $global_layout );

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$input[] = 'three-columns-enabled';
				break;

			default:
				break;
		}

		return $input;
	}

endif;

add_filter( 'body_class', 'blog_express_custom_body_class' );

if ( ! function_exists( 'blog_express_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function blog_express_custom_content_width() {
		global $content_width;

		$global_layout = blog_express_get_option( 'global_layout' );
		$global_layout = apply_filters( 'blog_express_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {
			case 'no-sidebar':
				$content_width = 1140;
				break;

			case 'three-columns':
				$content_width = 555;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 749;
				break;

			default:
				break;
		}
	}

endif;

add_filter( 'template_redirect', 'blog_express_custom_content_width' );

if ( ! function_exists( 'blog_express_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function blog_express_footer_goto_top() {
		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-angle-up"></i></a>';
	}

endif;

add_action( 'wp_footer', 'blog_express_footer_goto_top', 20 );

if ( ! function_exists( 'blog_express_add_popup_search' ) ) :

	/**
	 * Add popup search.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_popup_search() {
		?>
		<div class="search-box-blur"></div>
		<div class="custom-search-container">
			<?php get_search_form(); ?>
		</div><!-- .custom-search-container -->
		<?php
	}

endif;

add_action( 'wp_footer', 'blog_express_add_popup_search', 30 );

if ( ! function_exists( 'blog_express_add_pull_sidebar' ) ) :

	/**
	 * Add pull sidebar.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_pull_sidebar() {
		if ( ! is_active_sidebar( 'sidebar-3' ) ) {
			return;
		}
		?>
		<div id="pull-sidebar">
			<a href="#" class="btn-close-sidebar"><i class="fa fa-close"></i></a>
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		</div><!-- #pull-sidebar -->
		<?php
	}

endif;

add_action( 'wp_footer', 'blog_express_add_pull_sidebar', 40 );
