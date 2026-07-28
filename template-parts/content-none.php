<?php
/**
 * Template part for no results
 *
 * @package Gazipur_Update
 */
?>
<section class="no-results not-found bg-white rounded-xl shadow-sm p-8 md:p-12 text-center">
	<header class="page-header mb-6">
		<h1 class="page-title text-2xl font-bold text-gray-900">
			<?php esc_html_e( 'Nothing Found', 'gazipur-update' ); ?>
		</h1>
	</header>

	<div class="page-content text-gray-600 max-w-lg mx-auto">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gazipur-update' ),
						array( 'a' => array( 'href' => array() ) )
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
				?>
			</p>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'gazipur-update' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'gazipur-update' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
