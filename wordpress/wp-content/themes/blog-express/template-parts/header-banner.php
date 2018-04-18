<?php
/**
 * Header banner
 *
 * @package Blog_Express
 */

$banner      = get_header_image();
$image_style = '';
if ( $banner ) {
	$image_style = 'background-image: url(' . esc_url( $banner ) . ');';
}
$image_class = ( $banner ) ? 'header-image-enabled' : 'header-image-disabled';
?>

<div id="custom-header" style="<?php echo esc_attr( $image_style ); ?>" class="<?php echo esc_attr( $image_class ); ?>">

	<?php $banner_title = apply_filters( 'blog_express_filter_banner_title', '' ); ?>
	<?php if ( ! empty( $banner_title ) ) : ?>
		<?php
		$tag = 'h1';
		if ( is_front_page() ) {
			$tag = 'h2';
		}
		?>
		<div class="custom-header-content">
			<div class="container">
				<?php echo '<' . esc_attr( $tag ) . ' class="page-title">'; ?>
				<?php echo esc_html( $banner_title ); ?>
				<?php echo '</' . esc_attr( $tag ) . '>'; ?>
				<?php
				/**
				 * Hook - blog_express_action_breadcrumb.
				 *
				 * @hooked blog_express_add_breadcrumb - 10
				 */
				do_action( 'blog_express_action_breadcrumb' );
				?>
			</div><!-- .container -->
		</div><!-- .custom-header-content -->
	<?php endif; ?>

</div><!-- #custom-header -->
