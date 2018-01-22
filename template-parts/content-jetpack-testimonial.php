<article <?php post_class();?> itemscope itemtype="http://schema.org/Review" itemid="#<?php the_title();?>" >
	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-img">
	 <a href="<?php the_post_thumbnail_url('large'); ?>" data-imagelightbox="true" title="<?php the_title_attribute(); ?>">

	<?php the_post_thumbnail('medium'); ?>
  </a>
  </div>
<?php endif; ?>
	<div class="centered">
	<h1 itemprop="author"><?php the_title();?></h1>
    <h4><?php the_field('position'); ?>, <?php the_field('company'); ?></h4>
    </div>
		<div itemprop="reviewBody"><?php the_content(); ?></div>
		<?php
		$post_objects = get_field('project1');
		if( $post_objects ): ?>
    <h2>Projects</h2>
        <ul class="testimonial-projects">
        <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?></a>
                <?php the_title('<h3 class="entry-title sr-only" itemprop="itemReviewed">', '</h3>');?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->