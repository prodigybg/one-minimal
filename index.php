<?php
/**
 * The main template file
 *
 * @package one-minimal
 */
get_header();

$main_column_size = getMainColumnSize();
?>
<?php if(is_home()):?>
<div class="blog-bg">
		<div class="blog-top">
			<h1 class="centered">Blog<br>
				<small>The place where I share my thoughts about code, design and optimization.</small></h1>
		</div>
</div>
<?php else:?>
	<div class="portfolio-bg">
    <div class="blog-top container">
      <?php the_archive_title( '<h1 class="centered">', '<br>' );				the_archive_description( '<small>', '</small></h1>' ); ?>
    </div>
</div>
<?php endif;?>

<div class="container">
	<div class="row">
	<?php get_sidebar('left');?>
	<main class="content-area col-lg-<?php echo $main_column_size; ?>" id="main-column" role="main">
	<?php if (have_posts()) {
						echo '<ul id="blog-posts" class="row">';
					while ( have_posts() ) : the_post();    

        				get_template_part('content', get_post_format());

        			endwhile;
        				echo '</ul>';
    		} 
						else { 
							get_template_part('no-results', 'index');
						} ?>
				
				<div class="clearfix"></div>
			<?php bootstrapBasicPagination();?>

			</main>
		<?php get_sidebar('right');?>
	</div>
</div>
<?php get_footer();