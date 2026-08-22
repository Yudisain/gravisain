<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gravisain
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$gravisain_comment_count = get_comments_number();
			if ( '1' === $gravisain_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on "%1$s"', 'gravisain' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on "%2$s"', '%1$s thoughts on "%2$s"', $gravisain_comment_count, 'comments title', 'gravisain' ) ),
					number_format_i18n( $gravisain_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list" style="list-style: none; padding: 0; margin: 2rem 0; display: flex; flex-direction: column; gap: 1.5rem;">
			<?php
			wp_list_comments( [
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 60,
			] );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments" style="background: #f8fafc; padding: 1rem; border-radius: 8px; color: #64748b; text-align: center; font-weight: 600;">
				<?php esc_html_e( 'Comments are closed.', 'gravisain' ); ?>
			</p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form( [
		'class_form'           => 'comment-form',
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title" style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin-top: 2rem; margin-bottom: 1rem;">',
		'title_reply_after'    => '</h3>',
		'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s button primary-button" style="background: var(--wp--preset--color--primary, #4f46e5); color: #fff; padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">%4$s</button>',
	] );
	?>
</div><!-- #comments -->
