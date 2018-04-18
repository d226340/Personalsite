<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Express
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrapper">
		<?php
		/**
		 * Hook - blog_express_archive_image.
		 *
		 * @hooked blog_express_add_image_in_archive_display - 10
		 */
		do_action( 'blog_express_archive_image' );
		?>

		<div class="entry-content-wrapper">
			<header class="entry-header">
				<?php if ( 'post' === get_post_type() ) : ?>
					<?php blog_express_post_categories(); ?>
				<?php endif; ?>
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php blog_express_posted_on(); ?>
					</div>
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
				<?php blog_express_read_more(); ?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php blog_express_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content-wrapper -->
	</div><!-- .entry-wrapper -->
</article><!-- #post-## -->
