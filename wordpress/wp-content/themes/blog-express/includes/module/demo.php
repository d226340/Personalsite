<?php
/**
 * Demo configuration
 *
 * @package Blog_Express
 */

$config = array(
	'menu_locations' => array(
		'primary' => 'header-menu',
		'social'  => 'social-menu',
		'footer'  => 'header-menu',
	),
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Theme Demo Content', 'blog-express' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/widget.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/customizer.dat',
		),
	),
	'intro_content'  => esc_html__( 'NOTE: In demo import, category selection could be omitted in old (non-fresh) WordPress setup. After import is complete, please go to Widgets admin page under Appearance menu and select the appropriate category in the widgets.', 'blog-express' ),
);

Blog_Express_Demo::init( apply_filters( 'blog_express_demo_filter', $config ) );
