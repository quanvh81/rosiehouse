<?php if ( post_password_required() ) {return;}

/* ----------------------------------------------------------------------------

   Display page comments

---------------------------------------------------------------------------- */

?>

<!-- BEGIN .sohohotel-comments-wrapper -->
<div class="sohohotel-comments-wrapper">

<?php if ( have_comments() ) : ?>
	
	<div class="sohohotel-clearboth"></div>
	
	<h4 class="sohohotel-comment-count-title"><?php comments_number(esc_html__('No comments', 'soho-hotel'), esc_html__('1 Comment', 'soho-hotel'), esc_html__('% Comments', 'soho-hotel')); ?></h4>
	
	<ul class="sohohotel-comments">
		<?php wp_list_comments( array( 'callback' => 'sohohotel_comments' ) ); ?>
	</ul>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
		<div class="sohohotel-comments-pagination">
			<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'soho-hotel' ) ); ?>
			<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'soho-hotel' ) ); ?>
		</div>
		
	<?php endif; ?>

<?php endif;

/* ----------------------------------------------------------------------------

   Comment form

---------------------------------------------------------------------------- */

if ( comments_open() ) : 

	global $aria_req;
	global $sohohotel_allowed_html_array;
	
	comment_form( array(
		'comment_field'				=>	'<label for="comment">' . esc_html__('Comment', 'soho-hotel') . '</label><textarea name="comment" id="comment" tabindex="4" rows="9" cols="60"></textarea>',
		'comment_notes_before'		=>	'',
		'comment_notes_after'		=>	'',
		'logged_in_as'				=>	'<p class="logged-in-as">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','soho-hotel' ), $sohohotel_allowed_html_array ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
		'title_reply'				=>	esc_html__( 'Leave a Comment', 'soho-hotel' ),
		'title_reply_to'			=>	esc_html__( 'Leave a Comment', 'soho-hotel' ),
		'cancel_reply_link'			=>	esc_html__( 'Cancel Reply To Comment', 'soho-hotel' ),
		'label_submit'				=>	esc_html__( 'Submit', 'soho-hotel' ),
		'id_submit'					=>	'submit-button',
		'fields'					=>	array(
			'author' => ( $req ? '<label>' . esc_html__('Name', 'soho-hotel') .' <span class="sohohotel-required">'.esc_html__('*', 'soho-hotel').'</span></label>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Name', 'soho-hotel' ) . '" ' . $aria_req . ' />',
			'email' => ( $req ? '<label>' . esc_html__('Email', 'soho-hotel') .' <span class="sohohotel-required">'.esc_html__('*', 'soho-hotel').'</span></label>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'soho-hotel' ) . '" ' . $aria_req . ' />',
			'url' => '<label>' . esc_html__('Website', 'soho-hotel') .' </label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_html__( 'Website', 'soho-hotel' ) . '" />'
				)
	)); ?>

<?php endif; ?>

<!-- END .sohohotel-comments-wrapper -->
</div>