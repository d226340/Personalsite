<?php
/**
 * Functions hooked to custom hook
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_add_master_header' ) ) :

	/**
	 * Add master header section.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_master_header() {
		$header_layout = apply_filters( 'blog_express_filter_theme_header_layout', 1 );

		get_template_part( 'template-parts/header-layout', absint( $header_layout ) );
	}

endif;

add_action( 'blog_express_action_header', 'blog_express_add_master_header', 10 );

if ( ! function_exists( 'blog_express_customize_global_layout' ) ) :

	/**
	 * Customize global layout.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout Layout.
	 * @return string Modified layout.
	 */
	function blog_express_customize_global_layout( $layout ) {
		global $post;

		// Check if single template.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'blog_express_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = esc_attr( $post_options['post_layout'] );
			}
		}

		return $layout;
	}

endif;

add_filter( 'blog_express_filter_theme_global_layout', 'blog_express_customize_global_layout' );

if ( ! function_exists( 'blog_express_add_footer_widgets' ) ) :

	/**
	 * Add footer widgets.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_footer_widgets() {
		get_template_part( 'template-parts/footer-widgets' );
	}

endif;

add_action( 'blog_express_action_footer', 'blog_express_add_footer_widgets', 15 );

if ( ! function_exists( 'blog_express_add_related_posts' ) ) :

	/**
	 * Add related posts.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_related_posts() {
		$related_posts_status = blog_express_get_option( 'related_posts_status' );
		if ( true === $related_posts_status ) {
			get_template_part( 'template-parts/related-posts' );
		}
	}

endif;

add_action( 'blog_express_action_related', 'blog_express_add_related_posts', 10 );

if ( ! function_exists( 'blog_express_add_footer_credits' ) ) :

	/**
	 * Add footer credits.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_footer_credits() {
		get_template_part( 'template-parts/footer-credits' );
	}

endif;

add_action( 'blog_express_action_footer', 'blog_express_add_footer_credits', 20 );

if ( ! function_exists( 'blog_express_add_header_banner' ) ) :

	/**
	 * Add header banner.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_header_banner() {
		// Hide header banner in builder template.
		if ( is_page_template( 'templates/builder.php' ) ) {
			return;
		}

		// Hide in front pages.
		if ( is_front_page() || is_home() ) {
			return;
		}

		get_template_part( 'template-parts/header-banner' );
	}

endif;

add_action( 'blog_express_action_header', 'blog_express_add_header_banner', 15 );

if ( ! function_exists( 'blog_express_mobile_navigation' ) ) :

	/**
	 * Mobile navigation.
	 *
	 * @since 1.0.0
	 */
	function blog_express_mobile_navigation() {
		?>
		<div class="mobile-nav-wrap">
			<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-list" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i><span class="trigger-title"><?php esc_html_e( 'Main Menu', 'blog-express' ); ?></span></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => '',
						'fallback_cb'    => 'blog_express_primary_navigation_fallback',
					)
				);
				?>
			</div><!-- #mob-menu -->
		</div><!-- .mobile-nav-wrap -->
		<?php
	}

endif;

add_action( 'blog_express_action_header', 'blog_express_mobile_navigation', 1 );

if ( ! function_exists( 'blog_express_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_sidebar() {
		$global_layout = blog_express_get_option( 'global_layout' );
		$global_layout = apply_filters( 'blog_express_filter_theme_global_layout', $global_layout );

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}

		// Include secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}
	}

endif;

add_action( 'blog_express_action_sidebar', 'blog_express_add_sidebar' );

if ( ! function_exists( 'blog_express_custom_posts_navigation' ) ) :

	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function blog_express_custom_posts_navigation() {
		the_posts_pagination();
	}

endif;

add_action( 'blog_express_action_posts_navigation', 'blog_express_custom_posts_navigation' );

if ( ! function_exists( 'blog_express_add_image_in_single_display' ) ) :

	/**
	 * Add image in single template.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_image_in_single_display() {
		if ( has_post_thumbnail() ) {
			$args = array(
				'class' => 'blog-express-post-thumb aligncenter',
			);
			the_post_thumbnail( 'large', $args );
		}
	}

endif;

add_action( 'blog_express_single_image', 'blog_express_add_image_in_single_display' );

if ( ! function_exists( 'blog_express_add_image_in_archive_display' ) ) :

	/**
	 * Add image in archive template.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_image_in_archive_display() {
		$archive_layout = blog_express_get_option( 'archive_layout' );
		$image_size     = ( 'simple' === $archive_layout ) ? 'large' : 'blog-express-thumb';
		?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumb">
				<a href="<?php the_permalink(); ?>">
					<?php
					$args = array(
						'class' => 'blog-express-post-thumb',
					);
					the_post_thumbnail( $image_size, $args );
					?>
				</a>
			</div><!-- .entry-thumb -->
		<?php
		endif;
	}

endif;

add_action( 'blog_express_archive_image', 'blog_express_add_image_in_archive_display' );

if ( ! function_exists( 'blog_express_add_author_bio_in_single' ) ) :

	/**
	 * Display Author bio.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_author_bio_in_single() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$author_bio_in_single = blog_express_get_option( 'author_bio_in_single' );

		if ( true !== $author_bio_in_single ) {
			return;
		}

		get_template_part( 'template-parts/author-bio', 'single' );
	}

endif;

add_action( 'blog_express_author_bio', 'blog_express_add_author_bio_in_single' );

if ( ! function_exists( 'blog_express_customize_banner_title' ) ) :

	/**
	 * Customize banner title.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title Title.
	 * @return string Modified title.
	 */
	function blog_express_customize_banner_title( $title ) {
		if ( is_home() ) {
			$title = blog_express_get_option( 'blog_title' );
		} elseif ( is_singular() ) {
			$title = single_post_title( '', false );
		} elseif ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		} elseif ( is_archive() ) {
			$title = strip_tags( get_the_archive_title() );
		} elseif ( is_search() ) {
			/* translators: 1: search term */
			$title = sprintf( esc_html__( 'Search Results for: %s', 'blog-express' ), get_search_query() );
		} elseif ( is_404() ) {
			$title = esc_html__( '404!', 'blog-express' );
		}

		return $title;
	}

endif;

add_filter( 'blog_express_filter_banner_title', 'blog_express_customize_banner_title' );

if ( ! function_exists( 'blog_express_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_breadcrumb() {
		// Bail if home page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		$breadcrumb_type = blog_express_get_option( 'breadcrumb_type' );

		if ( 'enabled' === $breadcrumb_type ) {
			echo '<div id="breadcrumb">';
			blog_express_breadcrumb();
			echo '</div>';
		}
	}

endif;

add_action( 'blog_express_action_breadcrumb', 'blog_express_add_breadcrumb', 10 );

if ( ! function_exists( 'blog_express_add_featured_slider_front' ) ) :

	/**
	 * Add featured slider.
	 *
	 * @since 1.0.0
	 */
	function blog_express_add_featured_slider_front() {
		if ( ! is_front_page() ) {
			return;
		}

		$featured_slider_status = blog_express_get_option( 'featured_slider_status' );

		if ( 'disabled' !== $featured_slider_status ) {
			get_template_part( 'template-parts/featured', 'slider' );
		}
	}

endif;

add_action( 'blog_express_action_header', 'blog_express_add_featured_slider_front', 50 );

if ( ! function_exists( 'blog_express_get_slider_details' ) ) :

	/**
	 * Slider details.
	 *
	 * @since 1.0.0
	 *
	 * @param array $input Slider details.
	 * @return array Updated details.
	 */
	function blog_express_get_slider_details( $input ) {
		$featured_slider_type   = blog_express_get_option( 'featured_slider_type' );
		$featured_slider_number = blog_express_get_option( 'featured_slider_number' );

		switch ( $featured_slider_type ) {

			case 'featured-page':
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
					$id = blog_express_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$ids[] = absint( $id );
					}
				}

				// Bail if no valid ids.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page'   => absint( $featured_slider_number ),
					'no_found_rows'    => true,
					'orderby'          => 'post__in',
					'post_type'        => 'page',
					'post__in'         => $ids,
					'suppress_filters' => false,
					'meta_query'       => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides    = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array                        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
							$slides[ $cnt ]['images']['full']   = $image_array;
							$image_array                        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-express-carousel' );
							$slides[ $cnt ]['images']['medium'] = $image_array;
							$slides[ $cnt ]['title']            = get_the_title( $post->ID );
							$slides[ $cnt ]['url']              = get_permalink( $post->ID );
							$slides[ $cnt ]['date']             = '';
							$slides[ $cnt ]['category']         = '';

							$cnt++;
						}
					}
				}

				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			case 'featured-category':
				$featured_slider_category = blog_express_get_option( 'featured_slider_category' );

				$qargs = array(
					'posts_per_page'   => absint( $featured_slider_number ),
					'no_found_rows'    => true,
					'post_type'        => 'post',
					'suppress_filters' => false,
					'meta_query'       => array(
						array( 'key' => '_thumbnail_id' ),
					),
				);

				if ( absint( $featured_slider_category ) > 0 ) {
					$qargs['cat'] = absint( $featured_slider_category );
				}

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides    = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array                        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
							$slides[ $cnt ]['images']['full']   = $image_array;
							$image_array                        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-express-carousel' );
							$slides[ $cnt ]['images']['medium'] = $image_array;
							$slides[ $cnt ]['title']            = get_the_title( $post->ID );
							$slides[ $cnt ]['url']              = get_permalink( $post->ID );
							$slides[ $cnt ]['date']             = get_the_time( get_option( 'date_format' ), $post->ID );
							$slides[ $cnt ]['category']         = blog_express_get_post_category( $post->ID );

							$cnt++;
						}
					}
				}

				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			default:
				break;
		}

		return $input;
	}

endif;

add_filter( 'blog_express_filter_slider_details', 'blog_express_get_slider_details' );
