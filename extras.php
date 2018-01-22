<?php
/**
 * Extra functions (focused on styling stuff)
 * 
 * @package one-minimal
 */

/* Section - Comments */
if (!function_exists('bootstrapBasicComment')) {
	function bootstrapBasicComment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) { 
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class('comment-type-pt');
			echo '>';
			echo '<div class="comment-body media">';
				echo '<div class="media-body">';
					_e('Pingback:', 'bootstrap-basic');
					comment_author_link(); 
					edit_comment_link(__('Edit', 'bootstrap-basic'), '<span class="edit-link">', '</span>');
				echo '</div>';
			echo '</div>';
		} else {
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class(empty($args['has_children']) ? '' : 'parent media');
			echo '>';

			echo '<article id="div-comment-';
				comment_ID();
			echo '" class="comment-body media">';

				// footer
				echo '<footer class="comment-meta pull-left">';
					if (0 != $args['avatar_size']) {
						echo get_avatar($comment, $args['avatar_size']);
					}
				echo '</footer><!-- .comment-meta -->';
				// end footer

				// comment content
				echo '<div class="comment-content media-body">';
					echo '<div class="comment-author vcard">';

// if comment was not approved
						if ('0' == $comment->comment_approved) {
							echo '<div class="comment-awaiting-moderation text-warning"> <span class="glyphicon glyphicon-info-sign"></span> ';
								_e('Your comment is awaiting moderation.', 'bootstrap-basic');
							echo '</div>';
						} //endif;

						// comment author says
						printf(__('%s', 'bootstrap-basic'), sprintf('<h6>%s</h6>', get_comment_author_link()));
					
					
					echo '<div class="comment-metadata">';
						// date-time
						
						echo '<time datetime="';
							comment_time('c');
						echo '">';
						printf(_x('%1$s at %2$s', '1: date, 2: time', 'bootstrap-basic'), get_comment_date(), get_comment_time());
						echo '</time>';
						echo '</a> ';
						// end date-time
					echo '<a href="'; echo esc_url(get_comment_link($comment->comment_ID));
						echo '" class="comment-id">#'.($comment->comment_ID).'</a>';
						echo ' ';

						edit_comment_link('<span class="fa fa-pencil-square-o "></span>' . __('Edit', 'bootstrap-basic'), '<span class="edit-link">', '</span>');

						echo '</div><!-- .comment-metadata -->';
echo '</div><div class="clearfix"></div><!-- .comment-author -->';
						

					// comment content body
					comment_text();
					// end comment content body

					// reply link
					comment_reply_link(array_merge($args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'reply_text' => '<span class="fa fa-reply"></span> ' . __('Reply', 'bootstrap-basic'),
						'login_text' => '<span class="fa fa-reply"></span> ' . __('Log in to Reply', 'bootstrap-basic')
					)));
					// end reply link
				echo '</div><!-- .comment-content -->';
				// end comment content



			echo '</article><!-- .comment-body -->';
		} //endif;
	}
}

if (!function_exists('commentReplyButton')) {
	function commentReplyButton($class) 
	{
		$class = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-default btn-sm", $class);
		$class = str_replace("class='comment-reply-login", "class='comment-reply-login btn btn-default btn-sm", $class);

		return $class;
	}
}
add_filter('comment_reply_link', 'commentReplyButton');

//EDIT Button
	function editPost() 
	{
		edit_post_link('<i class="fa fa-pencil"></i>');
		
	}

//NEW EXCERPT
function readMore( $more ) {
	return '<p><a class="btn btn-primary btn-sm" title="'.get_the_title().'" href="'.get_permalink( get_the_ID() ) . '" rel="bookmark">' . __( 'Read More ->', 'one-minimal' ) . '</a></p>';
}
add_filter( 'excerpt_more', 'readMore' );
//Adds bootstrap style to pagination
if (!function_exists('bootstrapPagination')) {
	function bootstrapPagination($link, $i) 
	{
		if (strpos($link, '<a') === false) {
			return '<li class="active"><a href="#">' . $link . '</a></li>';
		} else {
			return '<li>' . $link . '</li>';
		}
	}
}
add_filter('wp_link_pages_link', 'bootstrapPagination', 10, 2);

function jetpackme_related_posts_headline( $headline ) {
$headline = sprintf(
            '<h3 class="related-posts">%s</h3>',
            esc_html( 'Related Posts' )
            );
return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );