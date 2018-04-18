<?php
/**
 * Header template
 *
 * @package Blog_Express
 */

?>
<div id="tophead" class="top-header-1">
	<div class="container">
		<div id="main-navigation">
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => 'blog_express_primary_navigation_fallback',
				) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- #main-navigation -->

		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<a href="#" id="sidebar-trigger"><span /></a>
		<?php endif; ?>

		<a href="#" id="search-button"><i class="fa fa-search"></i></a>

		<div class="header-social">
			<?php the_widget( 'Blog_Express_Social_Widget' ); ?>
		</div><!-- .header-social -->
	</div><!-- .container -->
</div><!-- #tophead -->

<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-header-wrapper">
			<?php blog_express_render_site_branding(); ?>
		</div> <!-- .site-header-wrapper -->
	</div><!-- .container -->
</header><!-- #masthead -->
