<?php
/**
 * Footer template
 *
 * @package Gazipur_Update
 */
?>
</main><!-- #primary -->

<footer class="bg-gray-900 text-gray-300 mt-16">
	<div class="border-b border-gray-800">
		<div class="container mx-auto px-4 py-12">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

				<!-- Brand -->
				<div class="lg:col-span-1">
					<?php if ( has_custom_logo() ) : ?>
						<div class="mb-4 filter brightness-0 invert">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<h3 class="text-2xl font-bold text-white mb-4"><?php bloginfo( 'name' ); ?></h3>
					<?php endif; ?>
					<p class="text-gray-400 text-sm leading-relaxed mb-4">
						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
					</p>
				</div>

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div><?php dynamic_sidebar( 'footer-1' ); ?></div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div><?php dynamic_sidebar( 'footer-2' ); ?></div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div><?php dynamic_sidebar( 'footer-3' ); ?></div>
				<?php endif; ?>

			</div>
		</div>
	</div>

	<div class="bg-gray-950 py-4">
		<div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm">
			<p class="text-gray-500">
				<?php
				$custom = get_theme_mod( 'gazipur_footer_text', '' );
				if ( $custom ) {
					echo wp_kses_post( $custom );
				} else {
					printf(
						/* translators: 1: year, 2: site name */
						esc_html__( '© %1$s %2$s. All rights reserved.', 'gazipur-update' ),
						esc_html( date_i18n( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
				}
				?>
			</p>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="mt-3 md:mt-0" aria-label="<?php esc_attr_e( 'Footer', 'gazipur-update' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'flex flex-wrap gap-x-6 gap-y-2 text-gray-500',
						'depth'          => 1,
						'fallback_cb'    => false,
					) );
					?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
