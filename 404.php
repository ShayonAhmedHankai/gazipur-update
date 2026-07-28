<?php
/**
 * 404 template
 *
 * @package Gazipur_Update
 */

get_header();
?>

<div class="container mx-auto px-4 py-16 text-center">
	<div class="max-w-lg mx-auto">
		<p class="text-8xl font-black text-red-600 mb-4">404</p>
		<h1 class="text-3xl font-bold text-gray-900 mb-4">
			<?php esc_html_e( 'Page Not Found', 'gazipur-update' ); ?>
		</h1>
		<p class="text-gray-600 mb-8">
			<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'gazipur-update' ); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
			<?php esc_html_e( '← Back to Homepage', 'gazipur-update' ); ?>
		</a>

		<div class="mt-12">
			<?php get_search_form(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
