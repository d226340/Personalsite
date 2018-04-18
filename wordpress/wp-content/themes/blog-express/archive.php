<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Express
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php
				$archive_layout = blog_express_get_option( 'archive_layout' );

				if ( 'grid' === $archive_layout ) {
					echo '<div class="masonry-outer"><div id="masonry-main">';
				}

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				if ( 'grid' === $archive_layout ) {
					echo '</div><!-- #masonry-main --></div><!-- .masonry-outer -->';
				}
				?>

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
	</div><!-- #primary -->

<?php
/**
 * Hook - blog_express_action_sidebar.
 *
 * @hooked: blog_express_add_sidebar - 10
 */
do_action( 'blog_express_action_sidebar' );

get_footer();
