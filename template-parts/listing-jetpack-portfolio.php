<?php $terms = get_the_terms($post->ID, 'jetpack-portfolio-type');
if ($terms && !is_wp_error($terms)):
  $links = array();
    foreach ($terms as $term) {
      $links[] = $term->name;
    }
    $categories = join(', ', $links);
    $tax_links  = join(" ", str_replace(' ', '-', $links));
    $tax        = strtolower($tax_links);
else:
    $tax = '';
endif;?>
  <article class="portfolio-item <?php echo $tax;
if (is_front_page()): ?>
  col-lg-6
<?php else: ?>
  col-lg-4
<?php endif;?>
   col-md-6 col-xs-12" data-category="<?php echo $tax; ?>" onclick=location.href='<?php the_permalink();?>' >
  <div class="portfolio-container">
  <?php
if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
    the_post_thumbnail('large', array('class' => 'img-fluid'));}?>

    <div class="mask">
        <div class="inner-content">
          <h2 class="portfolio-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <span class="date sr-only"><?php echo get_the_date('d.m.Y'); ?></span>
            <span class="views sr-only"><?php echo postViews(get_the_ID()); ?></span>
          <p class="portfolio-category"><?php echo $categories; ?></p>

        </div>
      </div>
    </div>
  </article>