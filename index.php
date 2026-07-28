<?php
/**
 * Main template file
 *
 * @package Gazipur_Update
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">
	<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

		<!-- Main Content -->
		<div class="lg:col-span-8">

			<?php if ( is_home() && ! is_paged() ) : ?>
				<!-- Featured / Hero Section -->
				<?php
				$featured = new WP_Query( array(
					'posts_per_page'      => 1,
					'meta_key'            => '_thumbnail_id',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				) );

				if ( $featured->have_posts() ) :
					while ( $featured->have_posts() ) :
						$featured->the_post();
						?>
						<section class="mb-10">
							<article class="relative rounded-2xl overflow-hidden shadow-lg group">
								<a href="<?php the_permalink(); ?>" class="block">
									<?php
									the_post_thumbnail( 'gazipur-hero', array(
										'class' => 'w-full h-72 md:h-96 object-cover group-hover:scale-105 transition-transform duration-700',
										'alt'   => the_title_attribute( array( 'echo' => false ) ),
									) );
									?>
									<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
									<div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
										<?php echo gazipur_update_primary_category(); // phpcs:ignore ?>
										<?php the_title( '<h2 class="text-2xl md:text-3xl font-bold leading-tight mt-2 mb-2 group-hover:underline">', '</h2>' ); ?>
										<p class="text-gray-200 text-sm md:text-base line-clamp-2 max-w-2xl"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
										<div class="mt-3 flex items-center gap-3 text-xs text-gray-300">
											<?php gazipur_update_posted_on(); ?>
											<span>·</span>
											<?php gazipur_update_reading_time(); ?>
										</div>
									</div>
								</a>
							</article>
						</section>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>

				<!-- Latest News Heading -->
				<div class="flex items-center justify-between mb-6">
					<h2 class="text-2xl font-bold text-gray-900 border-l-4 border-red-600 pl-3">
						<?php esc_html_e( 'Latest News', 'gazipur-update' ); ?>
					</h2>
				</div>
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<div id="posts-container" class="space-y-6">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				</div>

				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '&larr; ' . esc_html__( 'Previous', 'gazipur-update' ),
					'next_text' => esc_html__( 'Next', 'gazipur-update' ) . ' &rarr;',
					'class'     => 'mt-10',
				) );
				?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</div>

		<!-- Sidebar -->
		<aside class="lg:col-span-4" role="complementary">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php
get_footer();
