<?php
/**
 * Extra functions (focused on styling stuff)
 * 
 * @package one-minimal
 */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '<i class="fa fa-folder-open-o"></i>', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '<i class="fa fa-tag"></i> ', false );

        } elseif ( is_author() ) {

            $title = ' <p>'.get_avatar(get_the_author_meta('user_email'), 96).'</p><span class="vcard">' . get_the_author() . '</span>';

        }

    return $title;

});

/* Section - Comments */
if (!function_exists('bootstrapBasicComment')) {
	function bootstrapBasicComment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) { 
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class('comment-type-pt card');
			echo '>';
			echo '<div class="comment-body ">';
				echo '<div class="-body">';
					_e('Pingback:', 'bootstrap-basic');
					comment_author_link(); 
					edit_comment_link(__('Edit', 'bootstrap-basic'), '<span class="edit-link">', '</span>');
				echo '</div>';
			echo '</div>';
		} else {
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class(empty($args['has_children']) ? '' : 'parent card mb-3');
			echo '>';

			echo '<article id="div-comment-';
				comment_ID();
			echo '" class="comment-body card-block">';


				echo '<div class="comment-meta pull-left">';
					if (0 != $args['avatar_size']) {
						echo get_avatar($comment, $args['avatar_size']);
					}
					printf(__('%s', 'bootstrap-basic'), sprintf('<h5>%s</h5>', get_comment_author_link()));
				echo '</div><!-- .comment-meta -->';


				// comment content
				echo '<div class="comment-content -body">';
					echo '<div class="comment-author vcard">';

// if comment was not approved
						if ('0' == $comment->comment_approved) {
							echo '<div class="comment-awaiting-moderation text-warning"> <span class="glyphicon glyphicon-info-sign"></span> ';
								_e('Your comment is awaiting moderation.', 'bootstrap-basic');
							echo '</div>';
						} //endif;

						// comment author says
						
					
					
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

//NEW EXCERPT
function readMore( $more ) {
	return '<p><a class="btn btn-primary btn-sm" title="'.get_the_title().'" href="'.get_permalink( get_the_ID() ) . '" rel="bookmark">' . __( 'Read More', 'one-minimal' ) . '</a></p>';
}
add_filter( 'excerpt_more', 'readMore' );

function jetpackme_related_posts_headline( $headline ) {
$headline = sprintf(
            '<h3 class="related-posts">%s</h3>',
            esc_html( 'Related Posts' )
            );
return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );

function post_navigation() { ?>
	<div class="nav-post">

	<?php $prev_post = get_previous_post();?>
	<?php if (!empty($prev_post)): ?>
		<div class="pull-left">
		<div class="prev-img"><a href="<?php echo get_permalink($prev_post->ID); ?>" title="Previous Post -> <?php echo get_the_title($prev_post->ID); ?> "><?php echo get_the_post_thumbnail($prev_post->ID, 'medium', array('class' => 'img-fluid')); ?></a></div>
		<?php previous_post_link('<h4 class="previous-title sr-only"><< %link</h4>');?>
		</div>
	<?php endif;?>
	<?php $next_post = get_next_post();?>
	<?php if (!empty($next_post)): ?>
		<div class="pull-right"><?php next_post_link('<h4 class="next-title sr-only">%link >></h4>');?>
			<div class="next-img">
				<a href="<?php echo get_permalink($next_post->ID); ?>" title="Next Post -> <?php echo get_the_title($next_post->ID); ?> ">
				<?php echo get_the_post_thumbnail($next_post->ID, 'medium', array('class' => 'img-fluid')); ?>	
				</a>
			</div>
		</div>
	<?php endif;?>

</div><?php
}

if (!function_exists('bootstrapBasicPagination')) {
	/**
	 * display pagination (1 2 3 ...) instead of previous, next of wordpress style.
	 * 
	 * @param string $pagination_align_class
	 * @return string the content already echo
	 */
	function bootstrapBasicPagination($pagination_align_class = 'pagination-center pagination-row') 
	{
		global $wp_query;
			$big = 999999999;
			$pagination_array = paginate_links(array(
				'base' => str_replace($big, '%#%', get_pagenum_link($big)),
				'format' => '/page/%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
				'type' => 'array'
			));

			unset($big);

			if (is_array($pagination_array) && !empty($pagination_array)) {
				echo '<nav aria-label="' . $pagination_align_class . '">';
				echo '<ul class="pagination justify-content-center">';
				foreach ($pagination_array as $page) {
					echo '<li';
					if (strpos($page, '<a') === false && strpos($page, '&hellip;') === false) {
						echo ' class="page-item active"';
					}
					echo '>';
					if (strpos($page, '<a') === false && strpos($page, '&hellip;') === false) {
						echo '<span class="page-link">' . $page . '</span>';
					} else {
						echo $page;
					}
					echo '</li>';
				}
				echo '</ul>';
				echo '</nav>';
			}

			unset($page, $pagination_array);
	}// bootstrapBasicPagination
}