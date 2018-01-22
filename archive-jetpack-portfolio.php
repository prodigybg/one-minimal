<?php
get_header();?>
<div class="portfolio-bg">
    <div class="blog-top container">
      <h1 class="centered">Portfolio<br>
      <small class="centered">Art is in simplicity.</small></h1>
    </div>
</div>
<div class="container">
  <main class="content-area" id="main-column" role="main">

        <div class="filter-sorting">
<ul id="filters" role="group"><span class="sr-only">Category</span>
        <?php
$terms = get_terms("jetpack-portfolio-type");
$count = count($terms);
echo '<li class="current-item"><a data-filter="*" class="btn btn-primary active">All</a></li>';
if ($count > 0) {

    foreach ($terms as $term) {

        $termname = strtolower($term->name);
        $termname = str_replace(' ', '-', $termname);
        echo '<li class="' . $termname . '"><a data-filter=".' . $termname . '" class="btn btn-secondary">' . $term->name . '</a></li>';
    }
}
?>
    </ul>
    <ul id="sorts" role="group">
<span class="sr-only">Sorting</span>
  <li class="newest"><a class="btn btn-primary active" data-sort-value="newest" data-sort-direction="desc">Newest</a></li>
  <li class="oldest"><a class="btn btn-secondary" data-sort-value="oldest" data-sort-direction="asc">Oldest</a></li>
  <li class="liked"><a class="btn btn-secondary" data-sort-value="liked" data-sort-direction="desc">Most Liked</span></a></li>
  <li class="views"><a class="btn btn-secondary" data-sort-value="views" data-sort-direction="desc">Most Viewed</a></li>
</ul>
<div class="clearfix"></div>
</div>

    <div id="portfolio" class="row">
<?php

$args = array('post_type' => 'jetpack-portfolio', 'posts_per_page' => -1);
$loop = new WP_Query($args);
while ($loop->have_posts()): $loop->the_post();

    get_template_part('template-parts/listing', get_post_type());

endwhile;?>

   </div><!-- #portfolio -->
</main>
</div>
<?php get_footer();?>