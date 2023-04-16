<?php
/**
 * The template file for displaying the comments and comment form for the
 *
 * @package kadim
 * @since kadim 1.0
 */

if ( post_password_required() ) {
	return;
}

if ( $comments ): ?>


		<?php
		$comments_number = absint( get_comments_number() );
		?>

		<div class="kadim-single-post__comments-header">

			
			<h2 class="kadim-single-post__comments-title">

			<i class="icon fa-solid fa-message"></i>
			<?php
			if ( ! have_comments() ) {
				_e( 'No comments yet! let\'s start by yours', 'kadim' );
			} elseif ( 1 === $comments_number ) {
				/* translators: %s: Post title. */
				printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'kadim' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_nx(
						'%1$s reply on &ldquo;%2$s&rdquo;',
						'%1$s replies on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentytwenty'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}

			?>
			</h2><!-- .comments-title -->

		</div><!-- .comments-header -->

		<div class="kadim-single-post__comments-list">

			<?php
			wp_list_comments(
				array(
					'avatar_size' => 48,
					'style'       => 'div',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Newer Comments', 'kadim' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'kadim' ),
				)
			);

			if ( $comment_pagination ) {
				$pagination_classes = '';

				// If we're only showing the "Next" link, add a class indicating so.
				if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
					$pagination_classes = ' only-next';
				}
				?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>" aria-label="<?php esc_attr_e( 'Comments', 'kadim' ); ?>">
					<?php echo wp_kses_post( $comment_pagination ); ?>
				</nav>

				<?php
			}
			?>

		</div><!-- .comments-inner -->


<?php endif; ?>


<?php if ( comments_open() || pings_open() ): ?>

	<?php 

		comment_form(
			array(
				'class_container'    => 'kadim-single-post__comment-form',
				'title_reply_before' => '<h2 id="reply-title" class="kadim-single-post__comments-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);

	?>

<?php elseif ( is_single() ): ?>

	<div class="kadim-single-post__comments-form" id="respond">

		<div class="kadim-single-post__notice kadim-single-post__notice--warn">

			<i class="icon fa-solid fa-unlock-keyhole"></i>

			<?php esc_html_e( "Comments are closed", "kadim" ); ?>

		</div>
	
	</div><!-- #respond -->

<?php endif; ?>

