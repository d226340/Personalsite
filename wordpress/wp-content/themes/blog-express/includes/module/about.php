<?php
/**
 * About configuration
 *
 * @package Blog_Express
 */

$config = array(
	'menu_name'           => esc_html__( 'About Blog Express', 'blog-express' ),
	'page_name'           => esc_html__( 'About Blog Express', 'blog-express' ),

	/* translators: 1: theme version */
	'welcome_title'       => sprintf( esc_html__( 'Welcome to %s - v', 'blog-express' ), 'Blog Express' ),

	/* translators: 1: theme name */
	'welcome_content'     => sprintf( esc_html__( '%1$s is now installed and ready to use! We want to make sure you have the best experience using %1$s and that is why we gathered here all the necessary information for you. We hope you will enjoy using %1$s.', 'blog-express' ), 'Blog Express' ),

	// Quick links.
	'quick_links'         => array(
		'theme_url'         => array(
			'text' => esc_html__( 'Theme Details', 'blog-express' ),
			'url'  => 'https://axlethemes.com/downloads/blog-express/',
		),
		'demo_url'          => array(
			'text' => esc_html__( 'View Demo', 'blog-express' ),
			'url'  => 'https://axlethemes.com/theme-demo/?demo=blog-express',
		),
		'documentation_url' => array(
			'text'   => esc_html__( 'View Documentation', 'blog-express' ),
			'url'    => 'https://axlethemes.com/documentation/blog-express/',
			'button' => 'primary',
		),
		'rate_url'          => array(
			'text' => esc_html__( 'Rate This Theme', 'blog-express' ),
			'url'  => 'https://wordpress.org/support/theme/blog-express/reviews/',
		),
	),

	// Tabs.
	'tabs'                => array(
		'getting_started'     => esc_html__( 'Getting Started', 'blog-express' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'blog-express' ),
		'demo_content'        => esc_html__( 'Demo Content', 'blog-express' ),
		'useful_plugins'      => esc_html__( 'Useful Plugins', 'blog-express' ),
		'support'             => esc_html__( 'Support', 'blog-express' ),
		'upgrade_to_pro'      => esc_html__( 'Upgrade to Pro', 'blog-express' ),
	),

	// Getting started.
	'getting_started'     => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'blog-express' ),
			'text'                => esc_html__( 'Even if you are a long-time WordPress user, we still believe you should give our documentation a very quick read.', 'blog-express' ),
			'button_label'        => esc_html__( 'View Documentation', 'blog-express' ),
			'button_link'         => 'https://axlethemes.com/documentation/blog-express/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'blog-express' ),
			'text'                => esc_html__( 'We have compiled a list of steps for you, to take make sure the experience you will have using one of our products is very easy to follow.', 'blog-express' ),
			'button_label'        => esc_html__( 'Check Recommended Actions', 'blog-express' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=blog-express-about&tab=recommended_actions' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Theme Demo Content', 'blog-express' ),
			'text'                => esc_html__( 'You can easily import demo content as we have bundled demo content file within the theme folder. Importer plugin is needed.', 'blog-express' ),
			'button_label'        => esc_html__( 'Demo Content', 'blog-express' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=blog-express-about&tab=demo_content' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'blog-express' ),
			'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'blog-express' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'blog-express' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'View Theme Demo', 'blog-express' ),
			'text'                => esc_html__( 'To get quick glance of the theme, please visit theme demo.', 'blog-express' ),
			'button_label'        => esc_html__( 'View Demo', 'blog-express' ),
			'button_link'         => 'https://axlethemes.com/theme-demo/?demo=blog-express',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Child Theme', 'blog-express' ),
			'text'                => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'blog-express' ),
			'button_label'        => esc_html__( 'About Child Theme', 'blog-express' ),
			'button_link'         => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'blog-express' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content.', 'blog-express' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
		),
	),

	// Demo content.
	'demo_content'        => array(
		/* translators: 1: Plugin Link */
		'description' => sprintf( esc_html__( 'Demo content files are bundled within this theme. %1$s plugin is needed to import demo content. Please make sure plugin is installed and activated. If you have not installed the plugin, please go to Install Plugins page under Appearance. After plugin activation, go to Import Demo Data menu under Appearance.', 'blog-express' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'blog-express' ) . '</a>' ),
	),

	// Useful plugins.
	'useful_plugins'      => array(
		'description'        => esc_html__( 'This theme supports some helpful WordPress plugins to enhance your website.', 'blog-express' ),
		'plugins_list_title' => esc_html__( 'Useful Plugins List:', 'blog-express' ),
	),

	// Support.
	'support_content'     => array(
		'first'  => array(
			'title'        => esc_html__( 'Contact Support', 'blog-express' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'Got theme support question or found bug? Best place to ask your query is our dedicated Support forum.', 'blog-express' ),
			'button_label' => esc_html__( 'Contact Support', 'blog-express' ),
			'button_link'  => esc_url( 'https://axlethemes.com/support-forum/forum/blog-express/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'blog-express' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Please check our theme documentation for detailed information on how to setup and use theme.', 'blog-express' ),
			'button_label' => esc_html__( 'View Documentation', 'blog-express' ),
			'button_link'  => 'https://axlethemes.com/documentation/blog-express/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'third'  => array(
			'title'        => esc_html__( 'Pro Version', 'blog-express' ),
			'icon'         => 'dashicons dashicons-products',
			'icon'         => 'dashicons dashicons-star-filled',
			'text'         => esc_html__( 'Upgrade to pro version for more exciting features and additional theme options.', 'blog-express' ),
			'button_label' => esc_html__( 'View Pro Version', 'blog-express' ),
			'button_link'  => 'https://axlethemes.com/downloads/blog-express-pro/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'fourth' => array(
			'title'        => esc_html__( 'Pre-sale Queries', 'blog-express' ),
			'icon'         => 'dashicons dashicons-cart',
			'text'         => esc_html__( 'Have any query before purchase, you are more than welcome to ask.', 'blog-express' ),
			'button_label' => esc_html__( 'Pre-sale question?', 'blog-express' ),
			'button_link'  => 'https://axlethemes.com/pre-sale-question/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'fifth'  => array(
			'title'        => esc_html__( 'Customization Request', 'blog-express' ),
			'icon'         => 'dashicons dashicons-admin-tools',
			'text'         => esc_html__( 'Needed any customization for the theme, you can request from here.', 'blog-express' ),
			'button_label' => esc_html__( 'Customization Request', 'blog-express' ),
			'button_link'  => 'https://axlethemes.com/customization-request/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'sixth'  => array(
			'title'        => esc_html__( 'Child Theme', 'blog-express' ),
			'icon'         => 'dashicons dashicons-admin-customizer',
			'text'         => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'blog-express' ),
			'button_label' => esc_html__( 'About Child Theme', 'blog-express' ),
			'button_link'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
	),

	// Upgrade.
	'upgrade_to_pro'      => array(
		'description'  => esc_html__( 'Upgrade to pro version for more exciting features and additional theme options.', 'blog-express' ),
		'button_label' => esc_html__( 'Upgrade to Pro', 'blog-express' ),
		'button_link'  => 'https://axlethemes.com/downloads/blog-express-pro/',
		'is_new_tab'   => true,
	),

);

Blog_Express_About::init( apply_filters( 'blog_express_about_filter', $config ) );
