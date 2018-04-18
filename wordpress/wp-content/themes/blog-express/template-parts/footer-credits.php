<?php
/**
 * Footer credits
 *
 * @package Blog_Express
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<div class="colophon-top">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'depth'          => 1,
						'container_id'   => 'footer-navigation',
						'fallback_cb'    => false,
					)
				);
				?>
			</div><!-- .colophon-top -->
		<?php endif; ?>

		<?php $copyright_text = blog_express_get_option( 'copyright_text' ); ?>
		<div class="colophon-bottom">
			<?php if ( ! empty( $copyright_text ) ) : ?>
				<div class="copyright">
					<?php echo wp_kses_post( wpautop( $copyright_text ) ); ?>
				</div><!-- .copyright -->
			<?php endif; ?>

			<div class="site-info">
				<?php echo esc_html__( 'Blog Express by', 'blog-express' ) . ' <a target="_blank" rel="designer" href="https://axlethemes.com/">Axle Themes</a>'; ?>
			</div>
		</div><!-- .colophon-bottom -->
	</div><!-- .container -->
</footer><!-- #colophon -->
