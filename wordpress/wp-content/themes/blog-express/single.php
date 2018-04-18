<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blog_Express
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php
				the_post_navigation(
					array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'blog-express' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'blog-express' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'blog-express' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'blog-express' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					)
				);
				?>

				<?php
				/**
				 * Hook - blog_express_action_related.
				 *
				 * @hooked: blog_express_add_related_posts - 10
				 */
				do_action( 'blog_express_action_related' );
				?>

				<?php
				// Load comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * Hook - blog_express_action_sidebar.
 *
 * @hooked: blog_express_add_sidebar - 10
 */
do_action( 'blog_express_action_sidebar' );

get_footer();
