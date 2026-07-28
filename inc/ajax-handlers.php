<?php
/**
 * AJAX handlers
 *
 * @package Gazipur_Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load more posts (infinite scroll / button)
 */
function gazipur_update_load_more_posts() {
	check_ajax_referer( 'gazipur_nonce', 'nonce' );

	$page     = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;
	$category = isset( $_POST['category'] ) ? absint( $_POST['category'] ) : 0;

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => get_option( 'posts_per_page', 10 ),
		'paged'          => $page,
	);

	if ( $category > 0 ) {
		$args['cat'] = $category;
	}

	$query = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		}
		wp_reset_postdata();
	}

	$html = ob_get_clean();

	wp_send_json_success( array(
		'html'     => $html,
		'has_more' => $page < $query->max_num_pages,
	) );
}
add_action( 'wp_ajax_gazipur_load_more', 'gazipur_update_load_more_posts' );
add_action( 'wp_ajax_nopriv_gazipur_load_more', 'gazipur_update_load_more_posts' );
