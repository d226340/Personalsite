<?php
/**
 * Core functions
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function blog_express_get_option( $key ) {
		$default_options = blog_express_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$default       = ( isset( $default_options[ $key ] ) ) ? $default_options[ $key ] : '';
		$theme_options = get_theme_mod( 'theme_options', $default_options );
		$theme_options = array_merge( $default_options, $theme_options );
		$value         = '';

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		$value = apply_filters( "blog_express_option_{$key}", $value, $key, $default );

		return $value;
	}

endif;

if ( ! function_exists( 'blog_express_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
	function blog_express_get_options() {
		$value = array();
		$value = get_theme_mod( 'theme_options' );
		return $value;
	}

endif;

if ( ! function_exists( 'blog_express_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function blog_express_get_default_theme_options() {
		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_social_in_header'] = false;
		$defaults['show_search_in_header'] = true;

		// Layout.
		$defaults['global_layout']  = 'right-sidebar';
		$defaults['archive_layout'] = 'grid';

		// Footer.
		$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'blog-express' );

		// Blog.
		$defaults['excerpt_length']     = 15;
		$defaults['read_more_text']     = esc_html__( 'Read More', 'blog-express' );
		$defaults['exclude_categories'] = '';

		// Author Bio.
		$defaults['author_bio_in_single'] = true;

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'enabled';

		// Related.
		$defaults['related_posts_status'] = true;

		// Slider.
		$defaults['featured_slider_status']            = 'home-page';
		$defaults['featured_slider_enable_full_width'] = true;
		$defaults['featured_slider_enable_carousel']   = true;
		$defaults['featured_slider_carousel_number']   = 2;
		$defaults['featured_slider_transition_delay']  = 3;
		$defaults['featured_slider_enable_arrow']      = true;
		$defaults['featured_slider_enable_pager']      = true;
		$defaults['featured_slider_enable_autoplay']   = true;
		$defaults['featured_slider_type']              = 'featured-category';
		$defaults['featured_slider_number']            = 4;
		$defaults['featured_slider_category']          = 0;

		return apply_filters( 'blog_express_filter_default_theme_options', $defaults );
	}

endif;
