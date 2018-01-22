<?php
/**
 * Alexander Georgiev (www.ageorgiev.com) - 404 Page (error page)
 * 
 * @package one-minimal
 */

get_header();
$main_column_size = getMainColumnSize();
?> 
<div class="jumbotron jumbotron-fluid jumbotron-full">
<div class="container">
	<div class="row">
		<?php //get_sidebar('left');?>
			<main class="content-area col-lg-12" id="main-column" role="main">
				<article class="404-page text-center entry-content">
					<img src="<?php echo get_template_directory_uri();?>/img/svg/warning.svg" alt="404-error" height="256" class="error-icon" />
					<h1 class="display-3">404 Not Found</h1>						
					<p class="lead">Go to back to <a href="<?php home_url();?>">Home Page</a> or search instead.</p>
					<?php echo bootstrapBasicFullPageSearchForm(); ?> 
				</article>
			</main>
		<?php //get_sidebar('right');?>
	</div>
</div>
</div>
<?php get_footer();