<?php
/**
 * The template for displaying search results.
 *
 * @package one-minimal
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = getMainColumnSize();
?>
<div class="portfolio-bg">
    <div class="blog-top container">
      <h1><?php printf(__('Search Results for: %s', 'bootstrap-basic'), '<span>' . get_search_query() . '</span>');?></h1>
    </div>
</div>
<div class="container">
	<div class="row">
		<?php get_sidebar('left');?>
			<main class="content-area col-lg-<?php echo $main_column_size; ?>" id="main-column" role="main">
			<?php if (have_posts()): ?>
			<?php if ($post->post_type == "post" && $post->post_status = 'published'): ?>
				<ul id="blog-posts" class="row">
			<?php else: ?>
				<div id="portfolio" class="row">
			<?php endif;?>
                <?php while (have_posts()): the_post();?>
		                <?php if ($post->post_type != "post" && $post->post_status = 'published'): ?>
		                    <?php get_template_part('template-parts/listing', get_post_type());?>
		                <?php endif;?>
<?php if ($post->post_type == "post"): ?>
						<?php get_template_part('content', get_post_format());?>
						 <?php endif;?>
					<?php endwhile; ?>
<?php if ($post->post_type == "post" && $post->post_status = 'published'): ?>
				</ul>
			<?php else: ?>
				</div>
			<?php endif; 
			bootstrapBasicPagination(); ?>
			<?php else :?>
					<?php get_template_part('search', 'no-results');?>
					<?php endif;?>
			</main>
		<?php get_sidebar('right');?>
	</div>
</div>
<?php get_footer();