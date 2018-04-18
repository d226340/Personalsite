<?php
/**
 * Plugin recommendation
 *
 * @package Blog_Express
 */

// Load TGM library.
require_once trailingslashit( get_template_directory() ) . 'vendors/tgm/class-tgm-plugin-activation.php';

if ( ! function_exists( 'blog_express_register_recommended_plugins' ) ) :

	/**
	 * Register recommended plugins.
	 *
	 * @since 1.0.0
	 */
	function blog_express_register_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'WP Social Sharing', 'blog-express' ),
				'slug'     => 'wp-social-sharing',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'blog-express' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'blog-express' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'MailChimp for WordPress', 'blog-express' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
		);

		$config = array();

		tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'blog_express_register_recommended_plugins' );
