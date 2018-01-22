<article id="post-<?php the_ID();?>" <?php
if (is_post_type_archive()) {
    post_class('col-md-4 col-sm-6 col-xs-12');
} else {
    post_class('col-xs-12');
}?>>
<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('thumbnail');?>
<?php
if (is_front_page() || is_singular('jetpack-portfolio')): ?>
<h3 class="client-name"><?php the_title();?></h3>
<?php else: ?>
	<h2 class="client-name"><?php the_title();?></h2>
<?php endif;?>
</a>
    <h5 class="position-company"><?php the_field('position');?> - <?php the_field('company');?></h5>
    <div class="sr-only" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating"><meta itemprop="bestRating" content="5"><meta itemprop="worstRating" content="1"><meta itemprop="ratingValue" content="5"><meta itemprop="ratingCount" content="200"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
         <blockquote class="plain"><?php 
if (is_singular('jetpack-portfolio')) {
	the_content();
}
 else {
 	the_excerpt();
 } ?></blockquote>

</article>