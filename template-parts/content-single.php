<?php
/**
 * Template part for single post content
 *
 * @package Gazipur_Update
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-xl shadow-sm overflow-hidden' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="relative">
			<?php
			the_post_thumbnail( 'gazipur-hero', array(
				'class' => 'w-full h-64 md:h-96 object-cover',
				'alt'   => the_title_attribute( array( 'echo' => false ) ),
			) );
			?>
			<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
			<div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
				<?php gazipur_update_entry_categories(); ?>
				<?php the_title( '<h1 class="entry-title text-3xl md:text-4xl font-bold leading-tight mb-3">', '</h1>' ); ?>
				<div class="flex flex-wrap items-center gap-4 text-sm text-gray-200">
					<?php gazipur_update_posted_on(); ?>
					<?php gazipur_update_posted_by(); ?>
					<?php gazipur_update_reading_time(); ?>
				</div>
			</div>
		</div>
	<?php else : ?>
		<header class="entry-header p-6 md:p-8 border-b border-gray-100">
			<?php gazipur_update_entry_categories(); ?>
			<?php the_title( '<h1 class="entry-title text-3xl md:text-4xl font-bold leading-tight mb-3 text-gray-900">', '</h1>' ); ?>
			<div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
				<?php gazipur_update_posted_on(); ?>
				<?php gazipur_update_posted_by(); ?>
				<?php gazipur_update_reading_time(); ?>
			</div>
		</header>
	<?php endif; ?>

	<div class="entry-content prose prose-lg max-w-none p-6 md:p-8 prose-headings:font-bold prose-a:text-red-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-lg">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gazipur-update' ),
					array( 'span' => array( 'class' => array() ) )
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages( array(
			'before' => '<div class="page-links mt-8 pt-6 border-t border-gray-200">' . esc_html__( 'Pages:', 'gazipur-update' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<footer class="entry-footer px-6 md:px-8 pb-8">
		<?php gazipur_update_share_buttons(); ?>

		<?php
		$tags = get_the_tags();
		if ( $tags ) :
			?>
			<div class="tags-links mt-6 flex flex-wrap gap-2">
				<span class="text-sm font-medium text-gray-600 mr-2"><?php esc_html_e( 'Tags:', 'gazipur-update' ); ?></span>
				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="inline-block px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full hover:bg-red-50 hover:text-red-700 transition-colors">
						#<?php echo esc_html( $tag->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</footer>
</article>
