<?php
/**
 * Archive template
 *
 * @package Gazipur_Update
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">
	<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

		<div class="lg:col-span-8">

			<header class="page-header mb-8">
				<?php
				the_archive_title( '<h1 class="page-title text-3xl font-bold text-gray-900 border-l-4 border-red-600 pl-4">', '</h1>' );
				the_archive_description( '<div class="archive-description mt-3 text-gray-600">', '</div>' );
				?>
			</header>

			<?php if ( have_posts() ) : ?>

				<div class="space-y-6">
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
				) );
				?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</div>

		<aside class="lg:col-span-4">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php
get_footer();
