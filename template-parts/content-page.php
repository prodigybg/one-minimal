<article id="post-<?php the_ID();?>" <?php post_class();?>>
<?php if (has_post_thumbnail()) {
 
    the_post_thumbnail();
}?>
	<div class="entry-content">
		<h1 class="entry-title">
			<?php echo get_the_title(); ?>		
		</h1>
		<?php the_content();?>
		<div class="clearfix"></div>
		<?php
wp_link_pages(array(
    'before'    => '<div class="page-links">' . __('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
    'after'     => '</ul></div>',
    'separator' => '',
));
?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->