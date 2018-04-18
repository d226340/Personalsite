<?php
/**
 * Theme Options
 *
 * @package Blog_Express
 */

$default = blog_express_get_default_theme_options();

// Add theme options panel.
$wp_customize->add_panel(
	'theme_option_panel', array(
		'title'      => esc_html__( 'Theme Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section(
	'section_header', array(
		'title'      => esc_html__( 'Header Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting(
	'theme_options[show_title]', array(
		'default'           => $default['show_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_title]', array(
		'label'    => esc_html__( 'Show Site Title', 'blog-express' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_tagline.
$wp_customize->add_setting(
	'theme_options[show_tagline]', array(
		'default'           => $default['show_tagline'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_tagline]', array(
		'label'    => esc_html__( 'Show Tagline', 'blog-express' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_social_in_header.
$wp_customize->add_setting(
	'theme_options[show_social_in_header]', array(
		'default'           => $default['show_social_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_social_in_header]', array(
		'label'    => esc_html__( 'Enable Social Icons', 'blog-express' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting(
	'theme_options[show_search_in_header]', array(
		'default'           => $default['show_search_in_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_search_in_header]', array(
		'label'    => esc_html__( 'Enable Search Form', 'blog-express' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Layout Section.
$wp_customize->add_section(
	'section_layout', array(
		'title'      => esc_html__( 'Layout Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting(
	'theme_options[global_layout]', array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[global_layout]', array(
		'label'    => esc_html__( 'Global Layout', 'blog-express' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => blog_express_get_global_layout_options(),
		'priority' => 100,
	)
);
// Setting archive_layout.
$wp_customize->add_setting(
	'theme_options[archive_layout]', array(
		'default'           => $default['archive_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[archive_layout]', array(
		'label'    => esc_html__( 'Archive Layout', 'blog-express' ),
		'section'  => 'section_layout',
		'type'     => 'select',
		'choices'  => blog_express_get_archive_layout_options(),
		'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section(
	'section_footer', array(
		'title'      => esc_html__( 'Footer Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting(
	'theme_options[copyright_text]', array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[copyright_text]', array(
		'label'    => esc_html__( 'Copyright Text', 'blog-express' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Blog Section.
$wp_customize->add_section(
	'section_blog', array(
		'title'      => esc_html__( 'Blog Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting excerpt_length.
$wp_customize->add_setting(
	'theme_options[excerpt_length]', array(
		'default'           => $default['excerpt_length'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_positive_integer',
	)
);
$wp_customize->add_control(
	'theme_options[excerpt_length]', array(
		'label'       => esc_html__( 'Excerpt Length', 'blog-express' ),
		'description' => esc_html__( 'in words', 'blog-express' ),
		'section'     => 'section_blog',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 200,
			'style' => 'width: 55px;',
		),
	)
);
// Setting read_more_text.
$wp_customize->add_setting(
	'theme_options[read_more_text]', array(
		'default'           => $default['read_more_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[read_more_text]', array(
		'label'    => esc_html__( 'Read More Text', 'blog-express' ),
		'section'  => 'section_blog',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting exclude_categories.
$wp_customize->add_setting(
	'theme_options[exclude_categories]', array(
		'default'           => $default['exclude_categories'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[exclude_categories]', array(
		'label'       => esc_html__( 'Exclude Categories in Blog', 'blog-express' ),
		'description' => esc_html__( 'Enter category ID to exclude in Blog Page. Separate with comma if more than one.', 'blog-express' ),
		'section'     => 'section_blog',
		'type'        => 'text',
		'priority'    => 100,
	)
);

// Author Bio Section.
$wp_customize->add_section(
	'section_author_bio', array(
		'title'       => esc_html__( 'Author Bio Options', 'blog-express' ),
		'description' => esc_html__( 'Author Box will be displayed in single blog post.', 'blog-express' ),
		'priority'    => 100,
		'capability'  => 'edit_theme_options',
		'panel'       => 'theme_option_panel',
	)
);
// Setting author_bio_in_single.
$wp_customize->add_setting(
	'theme_options[author_bio_in_single]', array(
		'default'           => $default['author_bio_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[author_bio_in_single]', array(
		'label'    => esc_html__( 'Show Author Bio', 'blog-express' ),
		'section'  => 'section_author_bio',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Related Posts Section.
$wp_customize->add_section(
	'section_related_posts', array(
		'title'       => esc_html__( 'Related Posts Options', 'blog-express' ),
		'description' => esc_html__( 'Related posts will be displayed in single blog post.', 'blog-express' ),
		'priority'    => 100,
		'capability'  => 'edit_theme_options',
		'panel'       => 'theme_option_panel',
	)
);

// Setting related_posts_status.
$wp_customize->add_setting(
	'theme_options[related_posts_status]', array(
		'default'           => $default['related_posts_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[related_posts_status]', array(
		'label'    => esc_html__( 'Enable Related Posts', 'blog-express' ),
		'section'  => 'section_related_posts',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Breadcrumb Section.
$wp_customize->add_section(
	'section_breadcrumb', array(
		'title'      => esc_html__( 'Breadcrumb Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting(
	'theme_options[breadcrumb_type]', array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[breadcrumb_type]', array(
		'label'    => esc_html__( 'Breadcrumb Type', 'blog-express' ),
		'section'  => 'section_breadcrumb',
		'type'     => 'select',
		'choices'  => blog_express_get_breadcrumb_type_options(),
		'priority' => 100,
	)
);
