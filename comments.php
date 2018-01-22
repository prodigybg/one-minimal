<?php
/**
 * Template for displaying comments
 * 
 * @package one-minimal
 */


if (post_password_required()) {
	return;
}
?>
<div id="comments" class="comments-area mt-5">
	<?php if (have_comments()) { ?>
		<h2 class="comments-title">
			<?php
			printf(_nx('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'simplicity-elegance'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
			?> 
		</h2>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through  ?> 
			<h5 class="screen-reader-text sr-only"><?php _e('Comment navigation', 'simplicity-elegance'); ?></h5>
			<ul id="comment-nav-above" class="comment-navigation pager" role="navigation">
				<li class="nav-previous previous"><?php previous_comments_link(__('&larr; Older Comments', 'simplicity-elegance')); ?></li>
				<li class="nav-next next"><?php next_comments_link(__('Newer Comments &rarr;', 'simplicity-elegance')); ?></li>
			</ul><!-- #comment-nav-above -->
		<?php } // check for comment navigation  ?> 

		<ul class="comments-list">
			<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use bootstrapBasicComment() to format the comments.
			 * If you want to override this in a child theme, then you can
			 * define bootstrapBasicComment() and that will be used instead.
			 * See bootstrapBasicComment() in inc/template-tags.php for more.
			 */
			wp_list_comments(array('avatar_size' => '64', 'callback' => 'bootstrapBasicComment'));
			?>
		</ul><!-- .comment-list -->

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through  ?> 
			<h5 class="screen-reader-text sr-only"><?php _e('Comment navigation', 'simplicity-elegance'); ?></h5>
			<ul id="comment-nav-below" class="comment-navigation comment-navigation-below pager" role="navigation">
				<li class="nav-previous previous"><?php previous_comments_link(__('&larr; Older Comments', 'simplicity-elegance')); ?></li>
				<li class="nav-next next"><?php next_comments_link(__('Newer Comments &rarr;', 'simplicity-elegance')); ?></li>
			</ul><!-- #comment-nav-below -->
		<?php } // check for comment navigation  ?> 

	<?php } // have_comments()  ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?> 
		<p class="no-comments"><?php _e('Comments are closed.', 'simplicity-elegance'); ?></p>
	<?php 
	} //endif; 
	?> 

	<?php 
	$req      = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$html5 = true;
	
	// re-format comment allowed tags
	$comment_allowedtags = allowed_tags();
	$comment_allowedtags = str_replace(array("\r\n", "\r", "\n"), '', $comment_allowedtags);
	$comment_allowedtags_array = explode('&gt; &lt;', $comment_allowedtags);
	$formatted_comment_allowedtags = '';
	foreach ($comment_allowedtags_array as $item) {
		$formatted_comment_allowedtags .= '<code>';
		
		if ($comment_allowedtags_array[0] != $item) {
			$formatted_comment_allowedtags .= '&lt;';
		}
		
		$formatted_comment_allowedtags .= $item;
		
		if (end($comment_allowedtags_array) != $item) {
			$formatted_comment_allowedtags .= '&gt;';
		}
		
		$formatted_comment_allowedtags .= '</code> ';
	}
	$comment_allowed_tags = $formatted_comment_allowedtags;
	unset($comment_allowedtags, $comment_allowedtags_array, $formatted_comment_allowedtags);
	
	ob_start();
	comment_form(
		array(
			'fields' => array(
				'author' => '<div class="col-md-4">' . 
							'<div class="input-group">' . 
							'<span class="input-group-addon" id="basic-addon1">' . __('Name', 'simplicity-elegance') . ($req ? ' <span class="required">*</span>' : '') . '</span><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' class="form-control" placeholder="Type your name here"/>' . 
							'</div>' . 
							'</div>',
				'email'  => '<div class="col-md-4">' . 
							'<div class="input-group">' . 
							'<span class="input-group-addon" id="basic-addon1">' . __('@ ', 'simplicity-elegance') . ($req ? ' <span class="required">*</span>' : '') . '</span><input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' class="form-control" placeholder="Enter your e-mail"/>' . 
							'</div>' . 
							'</div>',
				'url'    => '<div class="col-md-4">' . 
							'<div class="input-group">' . 
							'<span class="input-group-addon" id="sizing-addon1">www.</span><input id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" class="form-control" placeholder="Enter your website"/>' . 
							'</div>' . 
							'</div><div class="clearfix"></div>',
			),
			'comment_field' => '' . 
							'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control" placeholder="Type your message here..."></textarea>' . 
							
							'',
			'comment_notes_after' => '<p class="help-block">' . 
							sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'simplicity-elegance'), $comment_allowed_tags) . 
							'</p>'
		)
	); 
	
	/**
	 * WordPress comment form does not support action/filter form and input submit elements. Rewrite these code when there is support available.
	 * @todo Change form class modification to use WordPress hook action/filter when it's available.
	 * @todo Change input submit class modification to use WordPress hook action/filter when it's available.
	 */
	$comment_form = str_replace('class="comment-form', 'class="comment-form form form-horizontal', ob_get_clean());
	$comment_form = preg_replace('#(<input\b[^>]*\s)(type="submit")#i', '$1 type="submit" class="btn btn-primary"', $comment_form);
	echo $comment_form;
	
	unset($comment_allowed_tags, $comment_form);
	?>

</div><!-- #comments -->