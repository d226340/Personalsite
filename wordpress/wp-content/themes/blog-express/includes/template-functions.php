<?php
/**
 * Template functions
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_get_the_excerpt' ) ) :

	/**
	 * Fetch excerpt from the post.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length      Excerpt length.
	 * @param WP_Post $post_object WP_Post instance.
	 * @return string Excerpt content.
	 */
	function blog_express_get_the_excerpt( $length, $post_object = null ) {
		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_object->post_content;

		if ( ! empty( $post_object->post_excerpt ) ) {
			$source_content = $post_object->post_excerpt;
		}

		$source_content  = strip_shortcodes( $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );

		return $trimmed_content;
	}

endif;

if ( ! function_exists( 'blog_express_breadcrumb' ) ) :

	/**
	 * Breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function blog_express_breadcrumb() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once trailingslashit( get_template_directory() ) . 'vendors/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);

		breadcrumb_trail( $breadcrumb_args );
	}

endif;

if ( ! function_exists( 'blog_express_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function blog_express_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'blog-express' ) ) {
			$fonts[] = 'Open Sans:400italic,700italic,300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

endif;

if ( ! function_exists( 'blog_express_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function blog_express_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'blog-express' ) . '</a></li>';
		wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 1,
				'number'   => 6,
			)
		);
		echo '</ul>';
	}

endif;

if ( ! function_exists( 'blog_express_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args Main arguments.
	 * @param string $callback Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function blog_express_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {
		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
		);

		$r       = wp_parse_args( $main_args, $defaults );
		$output  = '';
		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {

			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . esc_html__( 'Default', 'blog-express' ) . '</option>\n';
			}
			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}
			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output; // WPCS: XSS OK.
		}

		return $output;
	}

endif;

if ( ! function_exists( 'blog_express_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $min    Min.
	 * @param int    $max    Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 * @return array Options array.
	 */
	function blog_express_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {
		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string       = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;
	}

endif;

if ( ! function_exists( 'blog_express_render_site_branding' ) ) :

	/**
	 * Render site branding.
	 *
	 * @since 1.0.0
	 */
	function blog_express_render_site_branding() {
		$show_title   = blog_express_get_option( 'show_title' );
		$show_tagline = blog_express_get_option( 'show_tagline' );
		?>
		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
						?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}

endif;

if ( ! function_exists( 'blog_express_read_more' ) ) :

	/**
	 * Display read more link.
	 *
	 * @since 1.0.0
	 */
	function blog_express_read_more() {
		global $post;
		$read_more_text = blog_express_get_option( 'read_more_text' );
		if ( empty( $read_more_text ) ) {
			return;
		}
		?>
		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="more-link"><?php echo esc_html( $read_more_text ); ?></a>
		<?php
	}

endif;

if ( ! function_exists( 'blog_express_get_post_link_url' ) ) :

	/**
	 * Return the post URL.
	 *
	 * Falls back to the post permalink if no URL is found in the post.
	 *
	 * @since 1.0.0
	 *
	 * @return string The Link format URL.
	 */
	function blog_express_get_post_link_url() {
		$content = get_the_content();
		$has_url = get_url_in_content( $content );
		return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}

endif;

if ( ! function_exists( 'blog_express_get_post_category' ) ) :

	/**
	 * Return post category.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post ID.
	 * @return null|WP_Term Category object.
	 */
	function blog_express_get_post_category( $post_id ) {
		$output = null;

		$categories = get_the_category( $post_id );

		if ( ! empty( $categories ) ) {
			$output = $categories[0];
		}

		return $output;
	}

endif;
