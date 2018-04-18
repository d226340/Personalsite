<?php
/**
 * The Primary Sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Express
 */

$default_sidebar = apply_filters( 'blog_express_filter_default_sidebar_id', 'sidebar-1', 'primary' );
?>
<div id="sidebar-primary" class="widget-area sidebar" role="complementary">
	<div class="sidebar-wrapper">
		<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
			<?php dynamic_sidebar( $default_sidebar ); ?>
		<?php else : ?>
			<?php
				/**
				 * Hook - blog_express_action_default_sidebar.
				 */
				do_action( 'blog_express_action_default_sidebar', $default_sidebar, 'primary' );
			?>
		<?php endif; ?>
	</div><!-- .sidebar-wrapper -->
</div><!-- #sidebar-primary -->
