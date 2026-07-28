<?php
/**
 * Page template
 *
 * @package Gazipur_Update
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">
	<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

		<div class="lg:col-span-8">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-xl shadow-sm overflow-hidden' ); ?>>
					<header class="entry-header p-6 md:p-8 border-b border-gray-100">
						<?php the_title( '<h1 class="entry-title text-3xl md:text-4xl font-bold text-gray-900">', '</h1>' ); ?>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="px-6 md:px-8 pt-6">
							<?php the_post_thumbnail( 'gazipur-featured', array( 'class' => 'w-full rounded-lg' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content prose prose-lg max-w-none p-6 md:p-8">
						<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gazipur-update' ),
							'after'  => '</div>',
						) );
						?>
					</div>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</div>

		<aside class="lg:col-span-4">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php
get_footer();
