<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Express
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Hook - blog_express_single_image.
	 *
	 * @hooked blog_express_add_image_in_single_display - 10
	 */
	do_action( 'blog_express_single_image' );
	?>
	<header class="entry-header">
		<div class="entry-meta">
			<?php blog_express_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-express' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php blog_express_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php
	/**
	 * Hook - blog_express_author_bio.
	 *
	 * @hooked blog_express_add_author_bio_in_single - 10
	 */
	do_action( 'blog_express_author_bio' );
	?>

</article><!-- #post-## -->

