<?php 
/*
Display All Testimonials
*/
$main_column_size = getMainColumnSize();
get_header(); ?>
 <section>
  <div class="testimonials-bg"><div class="blog-top">
      <h1 class="entry-title centered">Testimonials<br>
<small style="color: #f9f9f9">Successful stories from high-profile clients.</small></h1></div>
  </div>
</section>

<div class="container">
  <main id="main">
    <?php if ( have_posts() ) : ?>  
<div class="row">
      <?php while ( have_posts() ) : the_post(); 

get_template_part('template-parts/listing', get_post_type());
      
    endwhile; ?>
      <div class="clearfix"></div>
      </div>
     <?php bootstrapBasicPagination(); ?>

    <?php endif; ?>
    </main><!-- #main -->
 </div>
<?php get_footer(); ?> 