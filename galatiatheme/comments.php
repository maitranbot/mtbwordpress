<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="edgtf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="edgtf-comment-holder-inner">
				<div class="edgtf-comments-title">
					<h3><?php esc_html_e( 'Comments', 'galatia' ); ?></h3>
				</div>
				<div class="edgtf-comments">
					<ul class="edgtf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'galatia_edge_comment' ), apply_filters( 'galatia_edge_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'galatia' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$edgtf_commenter = wp_get_current_commenter();
		$edgtf_req       = get_option( 'require_name_email' );
		$edgtf_aria_req  = ( $edgtf_req ? " aria-required='true'" : '' );
	    $edgtf_consent  = empty( $edgtf_commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$edgtf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'galatia' ),
			'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h3>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'galatia' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'galatia' ),
			'label_submit'         => esc_html__( 'Submit', 'galatia' ),
			'comment_field'        => apply_filters( 'galatia_edge_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Your comment', 'galatia' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'galatia_edge_filter_comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="' . esc_attr__( 'Your Name', 'galatia' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author'] ) . '"' . $edgtf_aria_req . ' />',
				'email'  => '<input id="email" name="email" placeholder="' . esc_attr__( 'Your Email', 'galatia' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author_email'] ) . '"' . $edgtf_aria_req . ' />',
				'url'    => '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'galatia' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author_url'] ) . '" size="30" maxlength="200" />',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $edgtf_consent . ' />' .
					'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'galatia' ) . '</label></p>',
			) ),
            'submit_button'         => '<button name="%1$s" type="submit" id="%2$s" class="%3$s " value="%4$s"><span class="edgtf-btn-text">%4$s</span></button>',
            'class_submit'          => 'edgtf-btn edgtf-btn-medium edgtf-btn-solid',
		);

	$edgtf_args = apply_filters( 'galatia_edge_filter_comment_form_final_fields', $edgtf_args );
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="edgtf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $edgtf_show_comment_form = apply_filters('galatia_edge_filter_show_comment_form_filter', true);
    if($edgtf_show_comment_form) {
    ?>
        <div class="edgtf-comment-form">
            <div class="edgtf-comment-form-inner">
                <?php comment_form( $edgtf_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	