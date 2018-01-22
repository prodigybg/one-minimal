<?php
/**
 * Template for SINGLE PORTFOLIO ITEM
 *
 * @package one-minimal
 */

get_header();

$main_column_size = getMainColumnSize();
?>

		<article <?php post_class();?> itemscope itemtype="http://schema.org/CreativeWork" itemid="#<?php the_title();?>">		
			<div class="entry-content">
				<div class="portfolio-images owl-carousel owl-theme">
				<?php if (has_post_thumbnail()): ?>
					<div class="item" data-dot=" <img src='<?php the_post_thumbnail_url('thumbnail'); ?>' /> ">
		 		<a style="text-align: center;" href="<?php the_post_thumbnail_url('full');?>" title="<?php the_title_attribute();?>" data-imagelightbox="true" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<?php the_post_thumbnail('full', array('class' => 'img-fluid'));?>
					<meta itemprop="url" content="<?php the_post_thumbnail_url('full') ;?>">
	    				<meta itemprop="width" content="1110">
	    				<meta itemprop="height" content="624">
	  			</a></div>
<?php endif;?>

<?php
$image      = get_field('portfolio-img-2');
$size = 'thumbnail';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

$img_srcset = wp_get_attachment_image_srcset($image['id'], 'medium');
if (!empty($image)):
?>
<div class="item" data-dot=" <img src='<?php echo $thumb; ?>' width='<?php echo $width; ?>' height='<?php echo $height; ?>' /> ">
<a href="<?php echo $image['url']; ?>" title="<?php the_title_attribute();?>" data-imagelightbox="true">
<img src="<?php echo $image['url']; ?>" class="img-fluid"  srcset="<?php echo esc_attr($img_srcset); ?>" sizes="(max-width: <?php echo $image['width'] ?>px) 100vw, <?php echo $image['width'] ?>px" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" />
</a>
</div>
<?php endif;?>


<?php
$image      = get_field('portfolio-img-3');
$size = 'thumbnail';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

$img_srcset = wp_get_attachment_image_srcset($image['id'], 'medium');
if (!empty($image)):
?>
<div class="item" data-dot=" <img src='<?php echo $thumb; ?>' width='<?php echo $width; ?>' height='<?php echo $height; ?>' /> ">
<a href="<?php echo $image['url']; ?>" title="<?php the_title_attribute();?>" data-imagelightbox="true">
<img src="<?php echo $image['url']; ?>" class="img-fluid"  srcset="<?php echo esc_attr($img_srcset); ?>" sizes="(max-width: <?php echo $image['width'] ?>px) 100vw, <?php echo $image['width'] ?>px" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" />
</a>
</div>
<?php endif;?>


<?php
$image      = get_field('portfolio-img-4');
$size = 'thumbnail';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

$img_srcset = wp_get_attachment_image_srcset($image['id'], 'medium');
if (!empty($image)):
?>
<div class="item" data-dot=" <img src='<?php echo $thumb; ?>' width='<?php echo $width; ?>' height='<?php echo $height; ?>' /> ">
<a href="<?php echo $image['url']; ?>" title="<?php the_title_attribute();?>" data-imagelightbox="true">
<img src="<?php echo $image['url']; ?>" class="img-fluid"  srcset="<?php echo esc_attr($img_srcset); ?>" sizes="(max-width: <?php echo $image['width'] ?>px) 100vw, <?php echo $image['width'] ?>px" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" />
</a>
</div>
<?php endif;?>



<?php
$image      = get_field('portfolio-img-5');
$size = 'thumbnail';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

$img_srcset = wp_get_attachment_image_srcset($image['id'], 'medium');
if (!empty($image)):
?>
<div class="item" data-dot=" <img src='<?php echo $thumb; ?>' width='<?php echo $width; ?>' height='<?php echo $height; ?>' /> ">
<a href="<?php echo $image['url']; ?>" title="<?php the_title_attribute();?>" data-imagelightbox="true">
<img src="<?php echo $image['url']; ?>" class="img-fluid"  srcset="<?php echo esc_attr($img_srcset); ?>" sizes="(max-width: <?php echo $image['width'] ?>px) 100vw, <?php echo $image['width'] ?>px" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width'] ?>" height="<?php echo $image['height'] ?>" />
</a>
</div>
<?php endif;?>


</div>
<?php $clients = get_field('client');
			if ($clients) :?>
<div class="client text-center mt-4 mb-4" itemscope itemtype="http://schema.org/Review">
<?php the_title('<span class="sr-only" itemprop="itemReviewed">', '</span>');?>
    <?php foreach( $clients as $post): // variable must be called $post (IMPORTANT) ?>
        <?php setup_postdata($post); get_template_part('template-parts/listing', get_post_type()); endforeach; ?>

    <?php wp_reset_postdata();?>
    </div>
		<?php endif;?>
<div class="row">

		<div class="entry-content col-lg-8">
		<?php the_title('<h1 class="entry-title sr-only" itemprop="headline">', '</h1>');?>
			<div itemprop="description"><?php the_content();?></div>
		</div>

		<aside class="col-lg-4">
				<h3 class="sr-only">Project Info</h3>
		 <?php echo meta_tags(); ?>
		 
		 <meta itemprop="creator" content="<?php echo get_the_author(); ?>">
		 <?php if (get_field("project_link")) {
		    echo '<a class="btn btn-primary" href="' . get_field("project_link") . '" target="_blank" itemprop="workExample">Visit ' . get_the_title() . '</a>';

		}?>
		</aside>

			</div>
		<?php echo post_navigation(); ?>
	</div>		
</article><!-- #post -->