<?php
/**
 * Breaking News Ticker
 *
 * @package Gazipur_Update
 */

$breaking_args = array(
	'posts_per_page' => 10,
	'meta_key'       => '_gazipur_breaking_news',
	'meta_value'     => '1',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'no_found_rows'  => true,
);

$breaking_query = new WP_Query( $breaking_args );

if ( ! $breaking_query->have_posts() ) {
	return;
}

$label = get_theme_mod( 'gazipur_breaking_label', __( 'Breaking', 'gazipur-update' ) );
?>
<section class="bg-red-600 text-white py-2 overflow-hidden" aria-label="<?php esc_attr_e( 'Breaking news', 'gazipur-update' ); ?>">
	<div class="container mx-auto px-4 flex items-center">
		<span class="bg-white text-red-600 px-3 py-1 text-xs font-bold rounded uppercase tracking-wide flex-shrink-0 mr-4">
			<?php echo esc_html( $label ); ?>
		</span>
		<div class="ticker-wrapper flex-1 overflow-hidden relative h-6">
			<div class="ticker-items absolute whitespace-nowrap" id="ticker-content">
				<?php
				while ( $breaking_query->have_posts() ) :
					$breaking_query->the_post();
					?>
					<a href="<?php the_permalink(); ?>" class="inline-block mx-8 hover:underline text-sm font-medium">
						<?php echo esc_html( wp_trim_words( get_the_title(), 12 ) ); ?>
						<span class="text-red-200 ml-2 text-xs"><?php echo esc_html( get_the_time( 'g:i A' ) ); ?></span>
					</a>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</section>
