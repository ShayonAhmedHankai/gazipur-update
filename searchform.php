<?php
/**
 * Custom search form
 *
 * @package Gazipur_Update
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field-<?php echo esc_attr( uniqid() ); ?>" class="sr-only">
		<?php esc_html_e( 'Search for:', 'gazipur-update' ); ?>
	</label>
	<div class="relative max-w-md mx-auto">
		<input
			type="search"
			id="search-field-<?php echo esc_attr( uniqid() ); ?>"
			class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-lg focus:border-red-600 focus:outline-none"
			placeholder="<?php esc_attr_e( 'Search news…', 'gazipur-update' ); ?>"
			value="<?php echo get_search_query(); ?>"
			name="s"
		/>
		<button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600" aria-label="<?php esc_attr_e( 'Search', 'gazipur-update' ); ?>">
			<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
			</svg>
		</button>
	</div>
</form>
