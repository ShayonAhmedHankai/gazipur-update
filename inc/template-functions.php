<?php
/**
 * Template helper functions
 *
 * @package Gazipur_Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print posted-on meta
 */
function gazipur_update_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on text-sm text-gray-500">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Print author
 */
function gazipur_update_posted_by() {
	printf(
		'<span class="byline text-sm text-gray-500">%1$s <a class="url fn n text-gray-700 hover:text-red-600" href="%2$s">%3$s</a></span>',
		esc_html_x( 'by', 'post author', 'gazipur-update' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Category list with red accent
 */
function gazipur_update_entry_categories() {
	$categories = get_the_category();
	if ( empty( $categories ) ) {
		return;
	}

	echo '<div class="entry-categories flex flex-wrap gap-2 mb-3">';
	foreach ( $categories as $cat ) {
		printf(
			'<a href="%s" class="inline-block px-2.5 py-0.5 text-xs font-semibold uppercase tracking-wide bg-red-50 text-red-700 rounded hover:bg-red-100 transition-colors">%s</a>',
			esc_url( get_category_link( $cat->term_id ) ),
			esc_html( $cat->name )
		);
	}
	echo '</div>';
}

/**
 * Primary category (first one)
 */
function gazipur_update_primary_category() {
	$categories = get_the_category();
	if ( empty( $categories ) ) {
		return '';
	}
	$cat = $categories[0];
	return sprintf(
		'<a href="%s" class="text-xs font-bold uppercase tracking-wider text-red-600 hover:text-red-700">%s</a>',
		esc_url( get_category_link( $cat->term_id ) ),
		esc_html( $cat->name )
	);
}

/**
 * Reading time estimate
 */
function gazipur_update_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, (int) ceil( $word_count / 200 ) );
	printf(
		'<span class="reading-time text-sm text-gray-500">%s</span>',
		/* translators: %d: minutes */
		esc_html( sprintf( _n( '%d min read', '%d min read', $minutes, 'gazipur-update' ), $minutes ) )
	);
}

/**
 * Check if post is marked as breaking
 */
function gazipur_update_is_breaking( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	return (bool) get_post_meta( $post_id, '_gazipur_breaking_news', true );
}

/**
 * Share buttons (simple, no external libs)
 */
function gazipur_update_share_buttons() {
	$url   = urlencode( get_permalink() );
	$title = urlencode( get_the_title() );
	?>
	<div class="share-buttons flex items-center gap-3 mt-6 pt-6 border-t border-gray-200">
		<span class="text-sm font-medium text-gray-600"><?php esc_html_e( 'Share:', 'gazipur-update' ); ?></span>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-blue-600 transition-colors" aria-label="Facebook">
			<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
		</a>
		<a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-sky-500 transition-colors" aria-label="X">
			<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
		</a>
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-blue-700 transition-colors" aria-label="LinkedIn">
			<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
		</a>
	</div>
	<?php
}
