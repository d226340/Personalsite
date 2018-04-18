<?php
/**
 * Featured slider
 *
 * @package Blog_Express
 */

$slider_details = array();
$slider_details = apply_filters( 'blog_express_filter_slider_details', $slider_details );

if ( empty( $slider_details ) ) {
	return;
}

$featured_slider_enable_carousel   = blog_express_get_option( 'featured_slider_enable_carousel' );
$featured_slider_enable_full_width = blog_express_get_option( 'featured_slider_enable_full_width' );
$featured_slider_carousel_number   = blog_express_get_option( 'featured_slider_carousel_number' );
$featured_slider_enable_arrow      = blog_express_get_option( 'featured_slider_enable_arrow' );
$featured_slider_enable_pager      = blog_express_get_option( 'featured_slider_enable_pager' );
$featured_slider_enable_autoplay   = blog_express_get_option( 'featured_slider_enable_autoplay' );
$featured_slider_transition_delay  = blog_express_get_option( 'featured_slider_transition_delay' );

$carousel_args = array(
	'slidesToShow'  => ( true === $featured_slider_enable_carousel ) ? absint( $featured_slider_carousel_number ) : 1,
	'autoplaySpeed' => absint( $featured_slider_transition_delay ) * 1000,
	'prevArrow'     => '<span data-role="none" class="slick-prev" tabindex="0"></span>',
	'nextArrow'     => '<span data-role="none" class="slick-next" tabindex="0"></span>',
	'responsive'    => array(
		array(
			'breakpoint' => 1024,
			'settings'   => array(
				'slidesToShow' => 1,
			),
		),
	),
);

$carousel_args['autoplay'] = ( true === $featured_slider_enable_autoplay ) ? true : false;
$carousel_args['dots']     = ( true === $featured_slider_enable_pager ) ? true : false;
$carousel_args['arrows']   = ( true === $featured_slider_enable_arrow ) ? true : false;

$carousel_args_encoded = wp_json_encode( $carousel_args );

$full_width_class = ( true === $featured_slider_enable_full_width ) ? 'slider-full-width-enabled' : 'slider-full-width-disabled';
?>

<div id="featured-slider" class="<?php echo esc_attr( $full_width_class ); ?>">
	<div class="container">
		<div class="blog-express-featured-slider" data-slick='<?php echo $carousel_args_encoded; // WPCS: XSS OK. ?>'>

			<?php foreach ( $slider_details as $key => $slide ) : ?>

				<div class="slide-item">
					<div class="slide-item-inner">
						<a class="slide-thumb" href="<?php echo esc_url( $slide['url'] ); ?>">
							<?php if ( true === $featured_slider_enable_carousel ) : ?>
								<img src="<?php echo esc_url( $slide['images']['medium'][0] ); ?>" alt="" />
							<?php else : ?>
								<img src="<?php echo esc_url( $slide['images']['full'][0] ); ?>" alt="" />
							<?php endif; ?>
						</a><!-- .slide-thumb -->
						<div class="slide-caption">
							<?php if ( $slide['category'] ) : ?>
								<span class="cat-links"><a href="<?php echo esc_url( get_term_link( $slide['category'] ) ); ?>"><?php echo esc_html( $slide['category']->name ); ?></a></span>
							<?php endif; ?>
							<h3 class="slide-title"><a href="<?php echo esc_url( $slide['url'] ); ?>"><?php echo esc_html( $slide['title'] ); ?></a></h3>
							<?php if ( ! empty( $slide['date'] ) ) : ?>
								<span class="date"><?php echo esc_html( $slide['date'] ); ?></span>
							<?php endif; ?>
						</div><!-- .slide-caption -->
					</div><!-- .slide-item-inner -->
				</div><!-- .slide-item -->

			<?php endforeach; ?>

		</div><!-- .blog-express-featured-slider -->
	</div><!-- .container -->
</div><!-- #featured-slider -->
