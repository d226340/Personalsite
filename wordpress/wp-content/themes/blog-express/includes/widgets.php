<?php
/**
 * Custom Theme widgets
 *
 * @package Blog_Express
 */

// Load widget helper.
require_once get_template_directory() . '/vendors/widget-helper/widget-helper.php';

if ( ! function_exists( 'blog_express_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function blog_express_register_widgets() {
		// Social widget.
		register_widget( 'Blog_Express_Social_Widget' );

		// Author widget.
		register_widget( 'Blog_Express_Author_Widget' );

		// Featured Page widget.
		register_widget( 'Blog_Express_Featured_Page_Widget' );

		// Advanced Recent Posts widget.
		register_widget( 'Blog_Express_Advanced_Recent_Posts_Widget' );
	}

endif;

add_action( 'widgets_init', 'blog_express_register_widgets' );

if ( ! class_exists( 'Blog_Express_Social_Widget' ) ) :

	/**
	 * Social widget class.
	 *
	 * @since 1.0.0
	 */
	class Blog_Express_Social_Widget extends Blog_Express_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$args['id']    = 'blog-express-social';
			$args['label'] = esc_html__( 'BE: Social', 'blog-express' );

			$args['widget'] = array(
				'classname'                   => 'blog_express_widget_social',
				'description'                 => esc_html__( 'Social Icons Widget', 'blog-express' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
			);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		public function widget( $args, $instance ) {
			$values          = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'container'      => false,
						'menu_class'     => 'social-links',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					)
				);
			}

			echo $args['after_widget'];
		}

	}

endif;

if ( ! class_exists( 'Blog_Express_Author_Widget' ) ) :

	/**
	 * Author widget class.
	 *
	 * @since 1.0.0
	 */
	class Blog_Express_Author_Widget extends Blog_Express_Widget_Helper {

		/**
		 * Social count.
		 *
		 * @since 1.0.0
		 *
		 * @var int Social count.
		 */
		protected $social_count;

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->social_count = 5;

			$args['id']    = 'blog-express-author';
			$args['label'] = esc_html__( 'BE: Author', 'blog-express' );

			$args['widget'] = array(
				'classname'                   => 'blog_express_widget_author',
				'description'                 => esc_html__( 'Display author info.', 'blog-express' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title'                 => array(
					'label' => esc_html__( 'Title:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'author_name'           => array(
					'label' => esc_html__( 'Author Name:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'author_info'           => array(
					'label' => esc_html__( 'Author Info:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'author_image'          => array(
					'label' => esc_html__( 'Author Image:', 'blog-express' ),
					'type'  => 'image',
				),
				'author_social_heading' => array(
					'label' => esc_html__( 'Social Links', 'blog-express' ),
					'type'  => 'heading',
				),
			);

			for ( $i = 1; $i <= $this->social_count; $i++ ) {
				$social_fields[ 'social_link_' . $i ] = array(
					/* translators: 1: Link number. */
					'label' => sprintf( esc_html__( 'Link %d:', 'blog-express' ), $i ),
					'type'  => 'url',
				);

				$args['fields'] = array_merge( $args['fields'], $social_fields );
			}

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		public function widget( $args, $instance ) {
			$values          = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}
			?>
			<div class="author-main-wrapper">
				<div class="author-main-details">
					<?php if ( ! empty( $values['author_image'] ) ) : ?>
						<div class="author-image">
							<img src="<?php echo esc_url( $values['author_image'] ); ?>" alt="" />
						</div><!-- .author-image -->
					<?php endif; ?>
					<div class="author-intro">
						<?php if ( ! empty( $values['author_name'] ) ) : ?>
							<h3 class="author-name"><?php echo esc_html( $values['author_name'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $values['author_info'] ) ) : ?>
							<div class="author-info">
								<?php echo wp_kses_post( wpautop( $values['author_info'] ) ); ?>
							</div><!-- .author-info -->
						<?php endif; ?>
						<?php
						$links = array();
						for ( $i = 1; $i <= $this->social_count; $i++ ) {
							if ( ! empty( $values[ 'social_link_' . $i ] ) ) {
								$links[] = $values[ 'social_link_' . $i ];
							}
						}
						?>
						<?php if ( ! empty( $links ) ) : ?>
							<div class="author-social">
								<ul class="social-links">
									<?php foreach ( $links as $link ) : ?>
										<li>
											<a href="<?php echo esc_url( $link ); ?>">
												<span class="screen-reader-text">
												<?php
												/* translators: 1: Link. */
												echo sprintf( esc_html__( 'Visit %s', 'blog-express' ), esc_html( $link ) );
												?>
												</span>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div><!-- .author-social -->
						<?php endif; ?>
					</div><!-- .author-intro -->
				</div><!-- .author-main-details -->
			</div><!-- .author-main-wrapper -->
			<?php
			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Blog_Express_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget class.
	 *
	 * @since 1.0.0
	 */
	class Blog_Express_Featured_Page_Widget extends Blog_Express_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$args['id']    = 'blog-express-featured-page';
			$args['label'] = esc_html__( 'BE: Featured Page', 'blog-express' );

			$args['widget'] = array(
				'classname'                   => 'blog_express_widget_featured_page',
				'description'                 => esc_html__( 'Displays single featured Page', 'blog-express' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title'                    => array(
					'label' => esc_html__( 'Title:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'featured_page'            => array(
					'label'            => esc_html__( 'Select Page:', 'blog-express' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'blog-express' ),
				),
				'content_type'             => array(
					'label'   => esc_html__( 'Show Content:', 'blog-express' ),
					'type'    => 'select',
					'default' => 'full',
					'choices' => array(
						'short' => esc_html__( 'Short', 'blog-express' ),
						'full'  => esc_html__( 'Full', 'blog-express' ),
					),
				),
				'excerpt_length'           => array(
					'label'       => esc_html__( 'Excerpt Length:', 'blog-express' ),
					'description' => esc_html__( 'Applies when Short is selected in Show Content.', 'blog-express' ),
					'type'        => 'number',
					'default'     => 40,
					'min'         => 1,
					'max'         => 100,
					'style'       => 'max-width:60px;',
				),
				'featured_image'           => array(
					'label'   => esc_html__( 'Select Image:', 'blog-express' ),
					'type'    => 'select',
					'default' => 'medium',
					'choices' => blog_express_get_image_sizes_options(),
				),
				'featured_image_alignment' => array(
					'label'   => esc_html__( 'Select Image Alignment:', 'blog-express' ),
					'type'    => 'select',
					'default' => 'left',
					'choices' => blog_express_get_image_alignment_options(),
				),
			);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		public function widget( $args, $instance ) {
			$values          = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			if ( absint( $values['featured_page'] ) > 0 ) {

				$qargs = array(
					'p'             => absint( $values['featured_page'] ),
					'post_type'     => 'page',
					'no_found_rows' => true,
				);

				$the_query = new WP_Query( $qargs );

				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						// Display featured image.
						if ( 'disable' !== $values['featured_image'] && has_post_thumbnail() ) {
							the_post_thumbnail( esc_attr( $values['featured_image'] ), array( 'class' => 'align' . esc_attr( $values['featured_image_alignment'] ) ) );
						}

						echo '<div class="featured-page-widget">';

						// Render widget title.
						if ( ! empty( $values['title'] ) ) {
							echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
						}

						if ( 'short' === $values['content_type'] ) {
							if ( absint( $values['excerpt_length'] ) > 0 ) {
								$excerpt = blog_express_get_the_excerpt( absint( $values['excerpt_length'] ) );
								echo wp_kses_post( wpautop( $excerpt ) );
								echo '<a href="' . esc_url( get_permalink() ) . '" class="custom-button">' . esc_html__( 'Read more', 'blog-express' ) . '</a>';
							}
						} else {
							the_content();
						}

						echo '</div><!-- .featured-page-widget -->';

					} // End while.

					// Reset.
					wp_reset_postdata();

				} // End if.
			}

			echo $args['after_widget'];
		}
	}

endif;

if ( ! class_exists( 'Blog_Express_Advanced_Recent_Posts_Widget' ) ) :

	/**
	 * Advanced recent posts widget class.
	 *
	 * @since 1.0.0
	 */
	class Blog_Express_Advanced_Recent_Posts_Widget extends Blog_Express_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$args['id']    = 'blog-express-advanced-recent-posts';
			$args['label'] = esc_html__( 'BE: Advanced Recent Posts', 'blog-express' );

			$args['widget'] = array(
				'classname'                   => 'blog_express_widget_advanced_recent_posts',
				'description'                 => esc_html__( 'Advanced Recent Posts Widget. Displays recent posts with thumbnail.', 'blog-express' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title'          => array(
					'label' => esc_html__( 'Title:', 'blog-express' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => esc_html__( 'Select Category:', 'blog-express' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'blog-express' ),
				),
				'featured_image' => array(
					'label'   => esc_html__( 'Featured Image:', 'blog-express' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'choices' => blog_express_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
				),
				'image_width'    => array(
					'label'       => esc_html__( 'Image Width:', 'blog-express' ),
					'description' => esc_html__( 'px', 'blog-express' ),
					'type'        => 'number',
					'default'     => 80,
					'min'         => 1,
					'max'         => 150,
					'style'       => 'max-width:60px;',
					'newline'     => false,
				),
				'post_number'    => array(
					'label'   => esc_html__( 'No of Posts:', 'blog-express' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 50,
					'style'   => 'max-width:60px;',
				),
				'excerpt_length' => array(
					'label'       => esc_html__( 'Excerpt Length:', 'blog-express' ),
					'description' => esc_html__( 'Number of words. Enter 0 to disable.', 'blog-express' ),
					'type'        => 'number',
					'default'     => 0,
					'min'         => 0,
					'max'         => 100,
					'style'       => 'max-width:60px;',
				),
				'disable_date'   => array(
					'label'   => esc_html__( 'Disable Date', 'blog-express' ),
					'type'    => 'checkbox',
					'default' => false,
				),
			);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		public function widget( $args, $instance ) {
			$values          = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => absint( $values['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $values['post_category'] ) > 0 ) {
				$qargs['cat'] = $values['post_category'];
			}

			$the_query = new WP_Query( $qargs );
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<div class="advanced-recent-posts-widget">

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
					?>
						<div class="advanced-recent-posts-item">

							<?php if ( 'disable' !== $values['featured_image'] && has_post_thumbnail() ) : ?>
								<div class="advanced-recent-posts-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . esc_attr( $values['image_width'] ) . 'px;',
										);
										the_post_thumbnail( esc_attr( $values['featured_image'] ), $img_attributes );
										?>
									</a>
								</div>
							<?php endif; ?>
							<div class="advanced-recent-posts-text-wrap">
								<h3 class="advanced-recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php if ( false === $values['disable_date'] ) : ?>
									<div class="advanced-recent-posts-meta">
										<span class="advanced-recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( absint( $values['excerpt_length'] ) > 0 ) : ?>
									<div class="advanced-recent-posts-summary">
										<?php
										$excerpt = blog_express_get_the_excerpt( absint( $values['excerpt_length'] ) );
										echo wp_kses_post( wpautop( $excerpt ) );
										?>
									</div>
								<?php endif; ?>
							</div><!-- .advanced-recent-posts-text-wrap -->

						</div><!-- .advanced-recent-posts-item -->
					<?php endwhile; ?>

				</div><!-- .advanced-recent-posts-widget -->

				<?php wp_reset_postdata(); ?>

			<?php
			endif;

			echo $args['after_widget'];
		}
	}

endif;
