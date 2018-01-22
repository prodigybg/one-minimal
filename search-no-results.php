<?php
/**
 * The template part for displaying message that posts cannot be found (404).
 * 
 * @package simplicity-elegance
 */
?>
<h2 class="page-title"><img src="wp-content/themes/one%20minimal/img/svg/sad-face.svg" alt="nothing-found" height="32" style="margin-right: 1rem;" /> <?php _e( 'Nothing Found', 'one-minimal' ); ?></h2>

	<div class="page-content">
		<?php if (is_home() && current_user_can('publish_posts')) { ?> 
			<p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bootstrap-basic'), esc_url(admin_url('post-new.php'))); ?></p>
		<?php } elseif (is_search()) { ?> 
			<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootstrap-basic'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); ?> 
		<?php } else { ?> 
			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootstrap-basic'); ?></p>
			<?php echo bootstrapBasicFullPageSearchForm(); ?> 
		<?php } //endif; ?> 
	</div><!-- .page-content -->