<?php
/**
 * Template Name: Home
 *
 * @package one-minimal
 */

get_header();
?>

<section class="hero">
    
    <div class="content-a">

        <div class="content-b">
<div class="row align-items-center">
        <div class="col-md-7 ml-auto col-xs-12">
            <h1>Front-end developer &amp; UI/UX designer<br>
            <small>Minimalist</small>
            </h1>
            <a class="btn btn-default btn-lg" href="#about">About</a>
            <a class="btn btn-primary btn-lg" href="#featured-projects">Featured Projects</a>
        </div></div>
    </div>
    </div>
</section>
<section class="services container">
<div class="row">
<div class="col-md-4 col-xs-12 centered">

<img src="wp-content/themes/one%20minimal/img/svg/code.svg" alt="Code" height="96" width="96" />
<h3>Front-End Developer</h3>
<p class="description">I can develop your product from visual concept to fully functional website.</p>

</div>
<div class="col-md-4 col-xs-12 centered">

<img src="wp-content/themes/one%20minimal/img/svg/monitor.svg" alt="Design" height="96" width="96"  />
<h3>Corporate Websites &amp; UI/UX</h3>
Completely new design? I’ll unite products and users, design and experiences.

</div>
<div class="col-md-4 col-xs-12 centered"><img src="wp-content/themes/one%20minimal/img/svg/optimization.svg" alt="Web Optimization" height="96"  width="96" />
<h3>Web Optimization</h3>
Your website lacks speed? Not semantically correct? I can optimize your website to A grade speed.

</div>
</div>
</section><!-- end of Services -->

<section class="centered" id="featured-projects">
<div class="container">
<h2>Featured Projects</h2>

<ul class="all-projects row no-gutters">
 <?php
$args = array(
    'post_type'      => 'jetpack-portfolio',
    'posts_per_page' => 4,
    'post__in'       => array(1082, 1020, 532, 972),
    'orderby'        => 'post__in'
    );

$loop = new WP_Query($args);
while ($loop->have_posts()): $loop->the_post();
get_template_part('template-parts/listing', get_post_type());
endwhile;?>
            </ul>
          
            <div class="clearfix"></div>
<a class="btn btn-default btn-lg" href="portfolio">View All Projects</a>
</div>
</section><!-- end of Portfolio Items -->

<section class="testimonials centered">
<h2>What Clients Say?</h2>
<div class="container" id="testimonials">
<div class="row">
<?php
$args = array(
    'post_type'      => 'jetpack-testimonial',
    'posts_per_page' => 6,
    'post__in'       => array(1017, 1008, 578, 576, 573, 948),
    'order'          =>  'DESC',
    'order_by'       => 'post__in');

$loop = new WP_Query($args);
echo '<div class="all-testimonials owl-carousel">';
while ($loop->have_posts()): $loop->the_post();
    get_template_part('template-parts/listing', get_post_type());
endwhile;?></div>
</div><a class="btn btn-default btn-lg" href="testimonial">View All Testimonials</a></div>
</section><!-- end of Testimonials -->

<section id="about">
<div class="col-lg-6 col-sm-12 personal-image">
            <?php echo wp_get_attachment_image(539, 'large', "", array("class" => "img-fluid")); ?>
</div>
<div class="col-lg-6 col-sm-12 about">
<h2 class="centered lighter">About</h2>
<p>Do you have an application with invaluable content but without the proper design?
Here’s where I, Alex, a passionate front-end developer, come to the rescue.
My core principles are simplicity and elegance and I always stick to them when crafting your application.</p>
<p>I highly value openness and honesty, and I believe in the power of mutual cooperation.
My excellent communication skills and friendly attitude make working with me more than easy.
I love challenging and thought-provoking tasks and I strictly adhere to deadlines.</p>
<p>Let’s give your application the staggering look it deserves.</p>
<p class="text-center">

<a href="https://ageorgiev.com/wp-content/uploads/2017/05/alexander-georgiev-CV.pdf" class="block" title="Download CV" target="_blank"><img src="wp-content/themes/one%20minimal/img/svg/download-cv.svg" alt="Code" height="96" width="96" /></a></p>
</div>
<div class="clearfix"></div>

</section><!-- end of About Me -->

<section class="latest-posts container centered">

<h2>Latest Posts</h2>

    <ul class="all-posts row">
<?php
global $post;
$myposts = get_posts('numberposts=6');
foreach ($myposts as $post):
    setup_postdata($post);
    ?>
                <li class="single-post col-md-4 col-sm-6 col-xs-12">
                <article id="post-<?php the_ID();?>">

                    <?php if (!is_single() && has_post_thumbnail()): ?>
              <a class="featured-image" href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
                <?php the_post_thumbnail('large', array('class' => 'img-fluid'));?>
              </a>
                <?php endif;?>
</article></li>
<?php endforeach;
?>
</ul>
<div class="clearfix"></div><a class="btn btn-default btn-lg" href="blog">View All Posts</a>

</section><!-- end of Latest Blog Posts -->

<section class="container centered" id="contact">
<div class="col-md-12">
<h2>Contact</h2>
<p>If you have a project in mind or are simply interested in finding out more, get in touch. You will receive a reply within 24 hours.</p>
</div>
<?php echo do_shortcode('[contact-form-7 id="318" title="Contact Form - Basic"]'); ?>


</section><!-- end of Contact Form -->
          <?php
if (is_page()) {
    the_post();
    the_content();
}
?>

<!-- .container -->
<?php get_footer();
