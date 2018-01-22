<?php
/**
 * Template for dispalying single post (read full post page).
 *
 * @package simplicity-elegance
 */
get_header();
if ( has_post_thumbnail() && is_singular( 'post' ) ): ?>
<div class="featured-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
    <?php the_post_thumbnail(array(1170, 658), array('class' => 'img-fluid'));?>
    </div>
<?php endif; 
$main_column_size = getMainColumnSize();?>

<div class="container">
	<div class="row">
        <?php //get_sidebar('left');?>
			<main class="col-lg-12 content-area" id="main-column" role="main">
				<?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs" class="sr-only">', '</p>');}?>
				<?php while ( have_posts() ) : the_post();
                    if (is_singular( 'post' )) {
                        get_template_part( 'template-parts/content', get_post_format() ? : 'standard' );    
                    }
                  
                    elseif (is_singular()) {
                        get_template_part('template-parts/content', get_post_type());
                    }

                    bootstrapBasicPagination();
    
                    if (comments_open() || '0' != get_comments_number()) {
                        comments_template();
                    }

                endwhile; ?>
			</main>
				
        <?php //get_sidebar('right');?>
	</div>
</div>
<div class="post-footer hidden-sm-down">
<?php if ( function_exists( 'sharing_display' ) ) { echo sharing_display(); } 
if (is_singular('jetpack-portfolio') && get_field("project_link")) {
    echo '<a class="btn btn-primary" href="' . get_field("project_link") . '" target="_blank" itemprop="workExample">Visit ' . get_the_title() . '</a>';
    } ?>
</div>
<?php get_footer();