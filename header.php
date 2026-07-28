<?php
/**
 * Header template
 *
 * @package Gazipur_Update
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-gray-50 text-gray-900 antialiased' ); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'gazipur-update' ); ?></a>

<!-- Top Bar -->
<div class="bg-gray-900 text-white text-sm py-2">
	<div class="container mx-auto px-4 flex justify-between items-center">
		<div class="flex items-center space-x-4">
			<span class="text-gray-400"><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></span>
			<span class="hidden md:inline text-gray-600">|</span>
			<span class="hidden md:inline text-gray-400"><?php echo esc_html( date_i18n( get_option( 'time_format' ) ) ); ?></span>
		</div>
		<div class="flex items-center space-x-4">
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'menu_class'     => 'flex space-x-3',
					'depth'          => 1,
					'link_before'    => '<span class="sr-only">',
					'link_after'     => '</span>',
					'fallback_cb'    => false,
				) );
				?>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Breaking News Ticker -->
<?php
if ( get_theme_mod( 'gazipur_show_ticker', true ) ) {
	get_template_part( 'template-parts/breaking-news-ticker' );
}
?>

<!-- Main Header -->
<header class="bg-white shadow-md sticky top-0 z-50">
	<div class="container mx-auto px-4">
		<div class="flex items-center justify-between h-20">

			<!-- Logo -->
			<div class="flex-shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-red-600 hover:text-red-700 transition-colors">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php if ( get_bloginfo( 'description' ) ) : ?>
						<p class="text-xs text-gray-500 mt-0.5"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<!-- Desktop Navigation -->
			<nav class="hidden lg:flex items-center" aria-label="<?php esc_attr_e( 'Primary', 'gazipur-update' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex items-center',
					'depth'          => 2,
					'fallback_cb'    => false,
					'walker'         => new Gazipur_Walker_Nav_Menu(),
				) );
				?>
			</nav>

			<!-- Actions -->
			<div class="flex items-center space-x-3">
				<button id="search-toggle" class="p-2 text-gray-600 hover:text-red-600 transition-colors" aria-label="<?php esc_attr_e( 'Open search', 'gazipur-update' ); ?>" aria-expanded="false">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
					</svg>
				</button>

				<button id="mobile-menu-toggle" class="lg:hidden p-2 text-gray-600 hover:text-red-600 transition-colors" aria-label="<?php esc_attr_e( 'Open menu', 'gazipur-update' ); ?>" aria-expanded="false">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Search Overlay -->
	<div id="search-overlay" class="hidden absolute top-full left-0 right-0 bg-white shadow-lg border-t border-gray-200 py-6 z-40">
		<div class="container mx-auto px-4">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="max-w-2xl mx-auto">
				<label for="search-field" class="sr-only"><?php esc_html_e( 'Search for:', 'gazipur-update' ); ?></label>
				<div class="relative">
					<input
						id="search-field"
						type="search"
						name="s"
						value="<?php echo get_search_query(); ?>"
						placeholder="<?php esc_attr_e( 'Search news…', 'gazipur-update' ); ?>"
						class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-lg focus:border-red-600 focus:outline-none text-lg"
						autocomplete="off"
					>
					<button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600" aria-label="<?php esc_attr_e( 'Submit search', 'gazipur-update' ); ?>">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
						</svg>
					</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Mobile Menu -->
	<div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
		<div class="container mx-auto px-4 py-4">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'space-y-1',
				'depth'          => 2,
				'fallback_cb'    => false,
			) );
			?>
		</div>
	</div>
</header>

<main id="primary" class="site-main">
