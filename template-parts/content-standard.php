<?php
/**
 * Displays a single blog post
 *
 * @package one-minimal
 */
?>

<article <?php post_class();?> itemscope itemtype="http://schema.org/BlogPosting">
	<header class="entry-header">
	  <div class="entry-meta">
				<?php meta_tags();?>
		</div>
	</header><!-- .entry-header -->

<?php the_title('<h1 class="entry-title sr-only" itemprop="headline">', '</h1>');?>
<div class="entry-content">
<?php the_content();?>
		<div class="clearfix"></div>
		<?php
wp_link_pages(array(
    'before'    => '<div class="page-links">' . __('', 'bootstrap-basic') . ' <ul class="pagination">',
    'after'     => '</ul></div>',
    'separator' => '',
));
?>
	</div><!-- .entry-content -->

<div class="clearfix"></div>

	<footer class="article-footer">

		<div id="authorarea" itemprop="author" itemscope itemtype="https://schema.org/Person">
		<?php echo get_avatar(get_the_author_meta('user_email'), 70); ?>
			<a class="author-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"><h5><span itemprop="name"><?php echo get_the_author(); ?></span></h5></a>
			<div class="authorinfo">
				<span itemprop="description"><?php the_author_meta('description');?></span>
					<div class="author-footer">
						<ul>
						<li><a title="Write an email" href='mailto:<?php the_author_meta('email');?>'><i class="fa fa-envelope"></i></a></li>
						<li><a title="Go to website" href='<?php the_author_meta('url');?>'><i class="fa fa-globe"></i></a></li>
						<li><a title="Facebook Page" href='<?php the_author_meta('facebook');?>'><i class="fa fa-facebook"></i></a></li>
						<li><a title="Twitter Profile" href='https://twitter.com/<?php the_author_meta('twitter');?>'><i class="fa fa-twitter"></i></a></li>
						<li><a title="Google Plus Profile" href='<?php the_author_meta('googleplus');?>'><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
		</div><!-- authorarea -->

<?php echo post_navigation(); ?>

	</footer><!-- .entry-meta -->
</article><!-- #post -->