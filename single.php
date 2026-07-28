<?php
/**
 * Single post template
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
				get_template_part( 'template-parts/content', 'single' );

				// Author box
				?>
				<div class="author-box mt-8 bg-white rounded-xl shadow-sm p-6 flex gap-5">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'rounded-full flex-shrink-0' ) ); ?>
					<div>
						<h3 class="text-lg font-bold text-gray-900 mb-1">
							<?php echo esc_html( get_the_author() ); ?>
						</h3>
						<p class="text-sm text-gray-600 leading-relaxed">
							<?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'Staff writer at Gazipur Update.', 'gazipur-update' ) ); ?>
						</p>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="inline-block mt-2 text-sm text-red-600 hover:underline">
							<?php esc_html_e( 'View all posts →', 'gazipur-update' ); ?>
						</a>
					</div>
				</div>

				<?php
				// Post navigation
				the_post_navigation( array(
					'prev_text' => '<span class="nav-subtitle text-xs uppercase tracking-wide text-gray-500">' . esc_html__( 'Previous', 'gazipur-update' ) . '</span><span class="nav-title block font-semibold text-gray-900 hover:text-red-600">%title</span>',
					'next_text' => '<span class="nav-subtitle text-xs uppercase tracking-wide text-gray-500">' . esc_html__( 'Next', 'gazipur-update' ) . '</span><span class="nav-title block font-semibold text-gray-900 hover:text-red-600">%title</span>',
				) );

				// Comments
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
