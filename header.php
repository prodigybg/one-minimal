<?php
/**
 * The theme header
 * 
 * @package one-minimal
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
		<meta name="viewport" content="width=device-width">
		<meta name="p:domain_verify" content="e85893c973113f0a9ffc80b4b2db8101"/>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<!--wordpress head-->
		<?php if ( is_post_type_archive('jetpack-portfolio') ) { ?>
	<meta name="description" content="Find some of my finest works in web development, design and photography." />
	<meta name="keywords" content="portfolio" />
<?php } ?>
<?php if ( is_post_type_archive('jetpack-testimonial') ) { ?>
	<meta name="description" content="Successful stories from my clients." />
	<meta name="keywords" content="testimonial" />
<?php } ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php include_once("analyticstracking.php") ?>
		<!--[if lt IE 8]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->
		
			<?php do_action('before'); ?> 
<header id="masthead">
<div class="site-header">
	<div class="container">
		<div class="site-branding"> 
			<span class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Alexander Georgiev</a>
					<?php if ( get_bloginfo( 'description' )  !== '' ): ?>
						<a class="smaller"><?php echo bloginfo('description'); ?></a>
					<?php endif; ?>
				</span>
				
				</div>					

			<a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a><nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>				
					
								
			</nav><!-- #site-navigation -->
			<div class="menu-search">
						<div id="search-icon"></div>
						<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" class="field" name="s" placeholder="Search..." value="<?php echo esc_attr( get_search_query() ); ?>" />						
							<button type="submit" class="btn btn-default"><?php esc_html_e('Search', 'bootstrap-basic'); ?></button>
						</form>	
					</div><!-- .menu-search -->
		</div><!-- .container -->
		</div>
	</header>
	<div id="header_holder"></div>
<!-- #masthead -->