<?php
/**
 * The template for displaying the footer
 *
 * @package Blog_Express
 */

?>
					</div><!-- .inner-wrapper -->

				</div><!-- .container .main-container -->

			</div><!-- #content -->

			<?php
			/**
			 * Hook - blog_express_action_footer.
			 *
			 * @hooked blog_express_add_footer_widgets - 15
			 * @hooked blog_express_add_footer_credits - 20
			 */
			do_action( 'blog_express_action_footer' );
			?>

		</div><!-- #page -->

	<?php wp_footer(); ?>
	</body>
</html>
