<?php
/**
 * Template part for displaying posts in loops
 *
 * @package Gazipur_Update
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300 mb-6' ); ?>>
	<div class="flex flex-col sm:flex-row">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="sm:w-2/5 flex-shrink-0 overflow-hidden">
				<?php
				the_post_thumbnail( 'gazipur-card', array(
					'class'   => 'w-full h-48 sm:h-full object-cover group-hover:scale-105 transition-transform duration-500',
					'loading' => 'lazy',
					'alt'     => the_title_attribute( array( 'echo' => false ) ),
				) );
				?>
			</a>
		<?php endif; ?>

		<div class="p-5 flex flex-col flex-1">
			<?php gazipur_update_entry_categories(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold leading-snug mb-2"><a href="%s" class="text-gray-900 hover:text-red-600 transition-colors" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<div class="entry-summary text-gray-600 text-sm leading-relaxed mb-4 flex-1">
				<?php the_excerpt(); ?>
			</div>

			<div class="entry-meta flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 mt-auto">
				<?php gazipur_update_posted_on(); ?>
				<?php gazipur_update_posted_by(); ?>
				<?php gazipur_update_reading_time(); ?>
			</div>
		</div>
	</div>
</article>
