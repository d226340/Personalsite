<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Express
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open() ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blog-express' ); ?></a>

		<?php
		/**
		 * Hook - blog_express_action_header.
		 *
		 * @hooked blog_express_mobile_navigation - 1
		 * @hooked blog_express_add_master_header - 10
		 * @hooked blog_express_add_header_banner - 15
		 */
		do_action( 'blog_express_action_header' );
		?>

		<div id="content" class="site-content">

			<div class="container main-container">

				<div class="inner-wrapper">
