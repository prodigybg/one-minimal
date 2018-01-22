<?php
/**
 * The template for displaying image attachments.
 *
 * @package one-minimal
 */

get_header();
?>
<div class="container content-area image-attachment">
<main id="main" class="site-main" role="main">
	<?php
while (have_posts()) {
    the_post();
    ?>

	<article <?php post_class();?>>
		<header class="entry-header sr-only">
			<?php the_title('<h1 class="entry-title sr-only">', '</h1>');?>

			<div class="entry-meta">
				<?php echo meta_tags(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<div class="entry-attachment">
			<figure class="figure">
				<a href="<?php echo wp_get_attachment_url(get_the_ID()); ?>" title="<?php the_title_attribute();?>" data-imagelightbox="true" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<?php echo wp_get_attachment_image(get_the_ID(), 'full', "", array("class" => "img-fluid")); ?>
				</a>
				<?php if (has_excerpt()) {?>
				 <figcaption class="figure-caption">
					<?php the_excerpt();?>
				</figcaption><!-- .entry-caption -->
					<?php } //endif; ?>
			</figure>


			</div><!-- .entry-attachment -->

			<?php the_content();?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
	<nav aria-label="Page navigation example">
<ul role="navigation" id="image-navigation" class="pagination justify-content-center">
				<li class="nav-previous page-item"><?php previous_image_link(false, __('<span class="meta-nav">&larr;</span> Previous', 'bootstrap-baisc'));?></li>
				<li class="nav-next page-item"><?php next_image_link(false, __('Next <span class="meta-nav">&rarr;</span>', 'bootstrap-baisc'));?></li>
			</ul>
			</<!-- #image-navigation -->
	<?php
// If comments are open or we have at least one comment, load up the comment template
    if (comments_open() || '0' != get_comments_number()) {
        comments_template();
    }
    ?>

	<?php
} //endwhile; // end of the loop.
?>
</main>
</div>
<?php get_footer();?>