<?php
/**
 * The template for displaying all pages
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

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

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
