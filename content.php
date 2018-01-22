<li class="col-md-6 col-xs-12">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <meta itemscope itemprop="mainEntityOfPage" itemid="post-<?php the_ID(); ?>"/>
  <span class="sr-only"><?php echo meta_tags(); ?>
  	<span itemprop="author"><?php the_author();?></span>
  </span>
      <?php if ( !is_single() && has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
	<?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
	<meta itemprop="url" content="<?php the_post_thumbnail_url('large') ;?>">
	<meta itemprop="width" content="800">
	<meta itemprop="height" content="450">
	</a>
<?php endif; ?>
	
        <h2 class="sr-only" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>        
	
		<div class="entry-content"><?php $content = get_the_content(); 
		$excerpt = strip_tags($content);
		$excerpt_clean = substr($excerpt, 0, 150);
		echo ''.$excerpt_clean.'... <strong><a href="'.get_the_permalink().'">[Read More]</a></strong>'; ?></div>
</article>
</li>