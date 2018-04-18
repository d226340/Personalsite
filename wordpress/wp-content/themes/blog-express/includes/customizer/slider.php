<?php
/**
 * Theme Options related to featured slider
 *
 * @package Blog_Express
 */

$default = blog_express_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel(
	'theme_slider_panel', array(
		'title'      => esc_html__( 'Featured Slider', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Slider Type Section.
$wp_customize->add_section(
	'section_theme_slider_type', array(
		'title'      => esc_html__( 'Slider Type', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_status.
$wp_customize->add_setting(
	'theme_options[featured_slider_status]', array(
		'default'           => $default['featured_slider_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_status]', array(
		'label'    => esc_html__( 'Enable Slider On', 'blog-express' ),
		'section'  => 'section_theme_slider_type',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => blog_express_get_featured_slider_content_options(),
	)
);

// Setting featured_slider_type.
$wp_customize->add_setting(
	'theme_options[featured_slider_type]', array(
		'default'           => $default['featured_slider_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_type]', array(
		'label'           => esc_html__( 'Select Slider Type', 'blog-express' ),
		'section'         => 'section_theme_slider_type',
		'type'            => 'select',
		'priority'        => 100,
		'choices'         => blog_express_get_featured_slider_type(),
		'active_callback' => 'blog_express_is_featured_slider_active',
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting(
	'theme_options[featured_slider_number]', array(
		'default'           => $default['featured_slider_number'],
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'blog_express_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_number]', array(
		'label'           => esc_html__( 'No of Slides', 'blog-express' ),
		'description'     => esc_html__( 'Enter number between 1 and 10. Save and refresh the page if No of Slides is changed.', 'blog-express' ),
		'section'         => 'section_theme_slider_type',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'blog_express_is_featured_slider_active',
		'input_attrs'     => array(
			'min'   => 1,
			'max'   => 10,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

$featured_slider_number = absint( blog_express_get_option( 'featured_slider_number' ) );

if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting(
			"theme_options[featured_slider_page_$i]", array(
				'default'           => isset( $default[ 'featured_slider_page_' . $i ] ) ? $default[ 'featured_slider_page_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'blog_express_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control(
			"theme_options[featured_slider_page_$i]", array(
				'label'           => esc_html__( 'Featured Page', 'blog-express' ) . ' - ' . $i,
				'section'         => 'section_theme_slider_type',
				'type'            => 'dropdown-pages',
				'priority'        => 100,
				'active_callback' => 'blog_express_is_featured_page_slider_active',
			)
		);
	} // End for loop.
}

// Setting featured_slider_category.
$wp_customize->add_setting(
	'theme_options[featured_slider_category]', array(
		'default'           => $default['featured_slider_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Blog_Express_Dropdown_Taxonomies_Control(
		$wp_customize, 'theme_options[featured_slider_category]', array(
			'label'           => esc_html__( 'Select Category', 'blog-express' ),
			'section'         => 'section_theme_slider_type',
			'settings'        => 'theme_options[featured_slider_category]',
			'priority'        => 100,
			'active_callback' => 'blog_express_is_featured_category_slider_active',
		)
	)
);

// Slider Options Section.
$wp_customize->add_section(
	'section_theme_slider_options', array(
		'title'      => esc_html__( 'Slider Options', 'blog-express' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_slider_panel',
	)
);

// Setting featured_slider_enable_full_width.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_full_width]', array(
		'default'           => $default['featured_slider_enable_full_width'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_full_width]',
	array(
		'label'    => esc_html__( 'Enable Full Width', 'blog-express' ),
		'section'  => 'section_theme_slider_options',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_enable_carousel.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_carousel]', array(
		'default'           => $default['featured_slider_enable_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_carousel]', array(
		'label'       => esc_html__( 'Enable Carousel', 'blog-express' ),
		'description' => esc_html__( 'Check this to display carousel instead of slider.', 'blog-express' ),
		'section'     => 'section_theme_slider_options',
		'type'        => 'checkbox',
		'priority'    => 100,
	)
);

// Setting featured_slider_carousel_number.
$wp_customize->add_setting(
	'theme_options[featured_slider_carousel_number]', array(
		'default'           => $default['featured_slider_carousel_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_carousel_number]', array(
		'label'           => esc_html__( 'No of Posts Displayed', 'blog-express' ),
		'section'         => 'section_theme_slider_options',
		'type'            => 'radio',
		'priority'        => 100,
		'choices'         => blog_express_get_numbers_dropdown_options( 2, 3 ),
		'active_callback' => 'blog_express_is_featured_carousel_mode_active',
	)
);

// Setting featured_slider_transition_delay.
$wp_customize->add_setting(
	'theme_options[featured_slider_transition_delay]', array(
		'default'           => $default['featured_slider_transition_delay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_transition_delay]', array(
		'label'       => esc_html__( 'Transition Delay', 'blog-express' ),
		'description' => esc_html__( 'in seconds', 'blog-express' ),
		'section'     => 'section_theme_slider_options',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 10,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting featured_slider_enable_arrow.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_arrow]', array(
		'default'           => $default['featured_slider_enable_arrow'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_arrow]', array(
		'label'    => esc_html__( 'Enable Arrow', 'blog-express' ),
		'section'  => 'section_theme_slider_options',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_enable_pager.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_pager]', array(
		'default'           => $default['featured_slider_enable_pager'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_pager]', array(
		'label'    => esc_html__( 'Enable Pager', 'blog-express' ),
		'section'  => 'section_theme_slider_options',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_autoplay]', array(
		'default'           => $default['featured_slider_enable_autoplay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'blog_express_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_autoplay]', array(
		'label'    => esc_html__( 'Enable Autoplay', 'blog-express' ),
		'section'  => 'section_theme_slider_options',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
