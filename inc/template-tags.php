<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage greenpi
 * @since 1.0
 */

if ( ! function_exists( 'greenpi_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function greenpi_posted_on() {

	global $post;
	$author=$post->post_author;
	$category = get_the_category();

	// Get the author name; container it in a link.
	if ( is_single() ) {
		$byline = '<p>Ecrit par <span class="author" rel="author">'.get_the_author_meta( 'first_name', $author ).'</span> le <span class="posted-on">' . greenpi_time_link() . '</span><span class="byline"> ' . $byline . '</span> dans <a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></p>';
	} else {
		$byline = '<p class="text-left">Ecrit par <span class="author" rel="author">'.get_the_author_meta( 'first_name' ).'</span></p>';
	};
	// Finally, let's write all of this to the page.
	echo $byline;
}
endif;


if ( ! function_exists( 'greenpi_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function greenpi_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string_content = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string_content = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	$time_string_content = sprintf( $time_string_content,
		get_the_date( DATE_W3C ),
		get_the_date('d M'),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date('d M')
	);

	$time_string_content = sprintf( $time_string_content, 
							get_the_date('d M'));

	
	$date_single = sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'greenpi' ),
		'<span>' . $time_string . '</span>');

	$date_content = sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'greenpi' ),
		'<span>' . $time_string_content . '</span>');


	// container the time string in a link, and preface it with 'Posted on'.
	if ( is_single() ) {
		return $date_single;
	}else{
		return $date_content;
	};

}
endif;


if ( ! function_exists( 'greenpi_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function greenpi_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'greenpi' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( greenpi_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && greenpi_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && greenpi_categorized_blog() ) {
							echo '<span class="cat-links">' . greenpi_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'greenpi' ) . '</span>' . $categories_list . '</span>';
						}

						if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links">' . greenpi_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'greenpi' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			}

			greenpi_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'greenpi_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function greenpi_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'greenpi' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Display a front page section.
 *
 * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
 * @param integer              $id Front page section to display.
 */
function greenpi_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the id and set it up during a selective refresh.
		global $greenpicounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$greenpicounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'panel_' . $id ) ) {
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	} elseif ( is_customize_preview() ) {
		// The output placeholder anchor.
		echo '<article class="panel-placeholder panel greenpi-panel greenpi-panel' . $id . '" id="panel' . $id . '"><span class="greenpi-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'greenpi' ), $id ) . '</span></article>';
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function greenpi_categorized_blog() {
	$category_count = get_transient( 'greenpi_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'greenpi_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in greenpi_categorized_blog.
 */
function greenpi_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'greenpi_categories' );
}
add_action( 'edit_category', 'greenpi_category_transient_flusher' );
add_action( 'save_post',     'greenpi_category_transient_flusher' );
