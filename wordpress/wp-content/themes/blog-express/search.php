<?php
/**
 * The template for displaying search results pages
 *
 * @package Blog_Express
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) :
					the_post();
				?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
					?>

				<?php endwhile; ?>

				<?php
				/**
				 * Hook - blog_express_action_posts_navigation.
				 *
				 * @hooked: blog_express_custom_posts_navigation - 10
				 */
				do_action( 'blog_express_action_posts_navigation' );
				?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
	/**
	 * Hook - blog_express_action_sidebar.
	 *
	 * @hooked: blog_express_add_sidebar - 10
	 */
	do_action( 'blog_express_action_sidebar' );
?>
<?php
get_footer();
