<?php
/**
 * Helper functions
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_global_layout_options() {
		$choices = array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'blog-express' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blog-express' ),
			'three-columns' => esc_html__( 'Three Columns', 'blog-express' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'blog-express' ),
		);

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_breadcrumb_type_options() {
		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'blog-express' ),
			'enabled'  => esc_html__( 'Enabled', 'blog-express' ),
		);

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_archive_layout_options() {
		$choices = array(
			'grid'   => esc_html__( 'Grid', 'blog-express' ),
			'simple' => esc_html__( 'Simple', 'blog-express' ),
		);

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable    True for adding No Image option.
	 * @param array $allowed        Allowed image size options.
	 * @param bool  $show_dimension True for showing dimension.
	 * @return array Image size options.
	 */
	function blog_express_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {
		global $_wp_additional_image_sizes;

		$choices = array();

		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'blog-express' );
		}

		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'blog-express' );
		$choices['medium']    = esc_html__( 'Medium', 'blog-express' );
		$choices['large']     = esc_html__( 'Large', 'blog-express' );
		$choices['full']      = esc_html__( 'Full (original)', 'blog-express' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed, true ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_image_alignment_options() {
		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'blog-express' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'blog-express' ),
			'center' => esc_html_x( 'Center', 'alignment', 'blog-express' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'blog-express' ),
		);

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_featured_slider_content_options' ) ) :

	/**
	 * Returns the featured slider content options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_featured_slider_content_options() {
		$choices = array(
			'home-page' => esc_html__( 'Front Page', 'blog-express' ),
			'disabled'  => esc_html__( 'Disabled', 'blog-express' ),
		);

		return $choices;
	}

endif;

if ( ! function_exists( 'blog_express_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blog_express_get_featured_slider_type() {
		$choices = array(
			'featured-page'     => esc_html__( 'Featured Pages', 'blog-express' ),
			'featured-category' => esc_html__( 'Featured Category', 'blog-express' ),
		);

		return $choices;
	}

endif;
