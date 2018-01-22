<?php
/**
 * Template Name: Full Width - No Title
 *
 * @package ultra
 */

get_header(); ?>


		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<div class="entry-content">
				<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content();?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>
		</div>
			</main><!-- #main -->
		</div><!-- #primary -->


<?php get_footer(); ?>
