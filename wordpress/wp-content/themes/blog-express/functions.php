<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	function blog_express_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'blog-express', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-express-thumb', 520, 400, true );
		add_image_size( 'blog-express-carousel', 675, 500, true );

		// Register nav menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'blog-express' ),
				'social'  => esc_html__( 'Social Menu', 'blog-express' ),
				'footer'  => esc_html__( 'Footer Menu', 'blog-express' ),
			)
		);

		// Add support for HTML5 markup.
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'blog_express_custom_background_args', array(
					'default-color' => 'FFF',
					'default-image' => '',
				)
			)
		);

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support(
			'custom-logo', array(
				'width'       => 300,
				'height'      => 100,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Enable admin editor style.
		add_editor_style( array( blog_express_fonts_url(), 'css/editor-style' . $min . '.css' ) );

		add_theme_support(
			'custom-header', apply_filters(
				'blog_express_custom_header_args', array(
					'default-image' => get_template_directory_uri() . '/images/custom-header.jpg',
					'width'         => 1920,
					'height'        => 250,
					'flex-height'   => true,
					'header-text'   => false,
				)
			)
		);

		// Register default custom headers.
		register_default_headers(
			array(
				'main-banner' => array(
					'url'           => '%s/images/custom-header.jpg',
					'thumbnail_url' => '%s/images/custom-header.jpg',
					'description'   => esc_html_x( 'Main Banner', 'header image description', 'blog-express' ),
				),
			)
		);

		// Enable support for Post Formats.
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);
	}

endif;

add_action( 'after_setup_theme', 'blog_express_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since 1.0.0
 */
function blog_express_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blog_express_content_width', 640 );
}
add_action( 'after_setup_theme', 'blog_express_content_width', 0 );

/**
 * Register widget area.
 *
 * @since 1.0.0
 */
function blog_express_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'blog-express' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'blog-express' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Secondary Sidebar', 'blog-express' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'blog-express' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Pull Sidebar', 'blog-express' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here to appear in your Pull Sidebar.', 'blog-express' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			/* translators: 1: footer column. */
			'name'          => sprintf( esc_html__( 'Footer %d', 'blog-express' ), 1 ),
			'id'            => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			/* translators: 1: footer column. */
			'name'          => sprintf( esc_html__( 'Footer %d', 'blog-express' ), 2 ),
			'id'            => 'footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			/* translators: 1: footer column. */
			'name'          => sprintf( esc_html__( 'Footer %d', 'blog-express' ), 3 ),
			'id'            => 'footer-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			/* translators: 1: footer column. */
			'name'          => sprintf( esc_html__( 'Footer %d', 'blog-express' ), 4 ),
			'id'            => 'footer-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'blog_express_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function blog_express_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/vendors/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = blog_express_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'blog-express-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-slick', get_template_directory_uri() . '/vendors/slick/slick' . $min . '.css', '', '1.5.9' );

	wp_enqueue_style( 'blog-express-style', get_stylesheet_uri(), array(), '1.0.0' );

	wp_enqueue_script( 'blog-express-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/vendors/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/vendors/slick/slick' . $min . '.js', array( 'jquery' ), '1.5.9', true );

	wp_enqueue_script( 'blog-express-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery', 'imagesloaded', 'masonry' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'blog_express_scripts' );

// Load starting file.
require_once trailingslashit( get_template_directory() ) . 'includes/start.php';
