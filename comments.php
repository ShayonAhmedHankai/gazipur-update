<?php
/**
 * Comments template
 *
 * @package Gazipur_Update
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-10 bg-white rounded-xl shadow-sm p-6 md:p-8">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-xl font-bold mb-6">
			<?php
			$comment_count = get_comments_number();
			printf(
				/* translators: 1: number of comments */
				esc_html( _n( '%1$s Comment', '%1$s Comments', $comment_count, 'gazipur-update' ) ),
				number_format_i18n( $comment_count )
			);
			?>
		</h2>

		<ol class="comment-list space-y-6">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 48,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();
		endif;

		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="no-comments text-gray-500"><?php esc_html_e( 'Comments are closed.', 'gazipur-update' ); ?></p>
		<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'          => esc_html__( 'Leave a Comment', 'gazipur-update' ),
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title text-lg font-bold mb-4">',
		'title_reply_after'    => '</h3>',
		'class_submit'         => 'bg-red-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition-colors cursor-pointer',
		'comment_field'        => '<p class="comment-form-comment mb-4"><label for="comment" class="block text-sm font-medium mb-1">' . esc_html__( 'Comment', 'gazipur-update' ) . '</label><textarea id="comment" name="comment" cols="45" rows="6" class="w-full border-2 border-gray-200 rounded-lg p-3 focus:border-red-600 focus:outline-none" required></textarea></p>',
	) );
	?>
</div>
