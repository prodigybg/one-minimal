<?php
/**
 * Template for displaying pages
 * 
 * @package simplicity-elegance
 */

get_header();


$main_column_size = getMainColumnSize();
?> 
<div class="container">
	<div class="row">
        <?php //get_sidebar('left');?>
			<main class="col-lg-12 content-area" id="main-column" role="main">
				<?php if ( function_exists('yoast_breadcrumb') ) {
  yoast_breadcrumb('<p id="breadcrumbs" class="sr-only">','</p>');} ?>
				<?php 
				while (have_posts()) {
					the_post();

					get_template_part('template-parts/content', 'page');

					if (comments_open() || '0' != get_comments_number()) {
						comments_template();
					}
				
				}
				?> 
			</main>

			</div>				
		<?php //get_sidebar('right'); ?>
</div>
<?php get_footer(); 