<?php
/**
 * Related posts
 *
 * @package Blog_Express
 */

global $post;
$current_post = $post;

$current_category_ids = array();

$current_categories = get_the_category( $current_post->ID );

if ( ! empty( $current_categories ) ) {
	foreach ( $current_categories as $cat ) {
		$current_category_ids[] = $cat->term_id;
	}
}

$qargs = array(
	'posts_per_page'      => 3,
	'post__not_in'        => array( $current_post->ID ),
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
);

if ( ! empty( $current_category_ids ) ) {
	$qargs['category__in'] = $current_category_ids;
}

$the_query = new WP_Query( $qargs );
?>

<div class="related-posts">
	<h2><?php esc_html_e( 'Related Posts', 'blog-express' ); ?></h2>

	<?php if ( $the_query->have_posts() ) : ?>

		<div class="inner-wrapper">
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
			?>
				<div class="related-post-item">
					<div class="related-wrapper">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="related-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'blog-express-thumb' ); ?>
								</a>
							</div><!-- .related-thumb -->
						<?php endif; ?>

						<div class="related-content-wrapper">
							<header class="related-header">
								<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="related-meta">
									<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
								</div>
							</header><!-- .related-header -->
						</div><!-- .related-content-wrapper -->
					</div><!-- .related-wrapper -->
				</div><!-- .related-post-item -->
			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		</div><!-- .inner-wrapper -->
	<?php endif; ?>

</div><!-- .related-posts -->
