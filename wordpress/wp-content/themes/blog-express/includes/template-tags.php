<?php
/**
 * Custom template tags for this theme
 *
 * @package Blog_Express
 */

if ( ! function_exists( 'blog_express_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blog_express_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			'%s',
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			'%s',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if ( ! empty( $posted_on ) ) {
			echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
		}

		if ( ! empty( $byline ) ) {
			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		}

		if ( 'post' === get_post_type() && is_single() ) {
			/* Translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( esc_html__( ', ', 'blog-express' ) );
			if ( $categories_list && blog_express_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}
		}

		if ( 'post' === get_post_type() && is_single() ) {
			/* Translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blog-express' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( '0 Comments', 'blog-express' ), esc_html__( '1 Comment', 'blog-express' ), esc_html__( '% Comments', 'blog-express' ) );
			echo '</span>';
		}
	}

endif;

if ( ! function_exists( 'blog_express_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blog_express_entry_footer() {
		if ( is_single() && 'post' === get_post_type() ) {
			/* Translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'blog-express' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link( esc_html__( 'Edit', 'blog-express' ), '<span class="edit-link">', '</span>' );
	}

endif;

if ( ! function_exists( 'blog_express_post_categories' ) ) :

	/**
	 * Prints categories.
	 */
	function blog_express_post_categories() {
		if ( 'post' === get_post_type() ) {
			/* Translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( esc_html__( ' ', 'blog-express' ) );
			if ( $categories_list && blog_express_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blog_express_categorized_blog() {
	$all_the_cool_cats = get_transient( 'blog_express_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields' => 'ids',
				'number' => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blog_express_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Flush out the transients used in blog_express_categorized_blog.
 */
function blog_express_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Like, beat it. Dig?
	delete_transient( 'blog_express_categories' );
}

add_action( 'edit_category', 'blog_express_category_transient_flusher' );
add_action( 'save_post', 'blog_express_category_transient_flusher' );
