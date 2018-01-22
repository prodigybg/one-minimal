<?php
/**
 * One Minimal Theme
 *
 * @package one-minimal
 */
/**
 * Required WordPress variable.
 */
/**
 * Enqueue scripts & styles
 */

function oneMinimalScripts()
{
    //CSS
    wp_enqueue_style('dosis', 'https://fonts.googleapis.com/css?family=Dosis');
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
    wp_enqueue_style('Font-Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('Owl-Carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css');
    wp_enqueue_style('one-minimal-style', get_stylesheet_uri());

    //JavaScript
    wp_enqueue_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array('jquery'), false, true);

    wp_enqueue_script('owl-carousel-2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js', array('jquery'), false, true);

    //if (is_post_type_archive('jetpack-portfolio') || is_singular('jetpack-portfolio')) {
    wp_enqueue_script('imagesloaded-cdn', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array('jquery'), false, true);
    wp_enqueue_script('isotope', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'), false, true);

    wp_enqueue_script('imagelightbox-js', get_template_directory_uri() . '/js/imagelightbox.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('portfolio', get_template_directory_uri() . '/js/portfolio.js', array('jquery'), '1.0', true);
    // }
    wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.min.js', array('jquery'), '1.0', false, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('oneminimal-theme', get_template_directory_uri() . '/js/functions.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'oneMinimalScripts');

if (!function_exists('oneMinimalSetup')) {

    function oneMinimalSetup()
    {
        load_theme_textdomain('one-minimal', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('custom-header');
        add_theme_support('post-thumbnails');
        add_theme_support('yoast-seo-breadcrumbs');
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ));
        // add_theme_support('infinite-scroll', array(
        //     'footer'         => false,
        //     //'footer_widgets' => array( 'wpcom_social_media_icons_widget-2', 'facebook-likebox-3', 'recent-posts-2', ),
        //     'footer_widgets' => false,
        //     'type'           => 'click',
        //     'container'      => 'portfolio',
        //     'wrapper'        => true,
        //     'render'         => 'one_minimal_portfolio',
        //     'posts_per_page' => 5,
        // ));

        add_theme_support('site-logo', array(
            'size' => 'full',
        ));
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'one-minimal'),
        ));

    } // oneMinimalSetup
}
add_action('after_setup_theme', 'oneMinimalSetup');

function one_minimal_portfolio()
{
    while (have_posts()) {
        the_post();
        get_template_part('content', get_post_type());
    }

}
function jetpack_infinite_scroll_query_args($args)
{
    $args['order']   = 'ASC';
    $args['orderby'] = 'name';

    return $args;
}
add_filter('infinite_scroll_query_args', 'jetpack_infinite_scroll_query_args');
/**
 * Register widget areas
 */
if (!function_exists('oneMinimalWidgetsInit')) {

    function oneMinimalWidgetsInit()
    {

        register_sidebar(array(
            'name'          => __('Sidebar Left', 'one-minimal'),
            'id'            => 'sidebar-left',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => __('Sidebar Right', 'one-minimal'),
            'id'            => 'sidebar-right',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));

        register_sidebar(array(
            'name'          => __('Footer', 'one-minimal'),
            'id'            => 'main-footer',
            'before_widget' => '<aside id="%1$s" class="%2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
        register_widget('popular_Liked_commented_Posts_widget');
        register_widget('popular_Portfolio_widget');
    } // oneMinimalWidgetsInit
}
add_action('widgets_init', 'oneMinimalWidgetsInit');

if (!function_exists('getMainColumnSize')) {
    /**
     * Determine main column size from actived sidebar
     *
     * Both sidebar active. (12-2-3) = 7. Main column size is 7.
     * Only left sidebar active. (12-2) = 10. Main column size is 10.
     * Only right sidebar active. (12-3) = 9. Main column size is 9.
     * No sidebar active. Main column is 12.
     * @return integer return column size.
     */
    function getMainColumnSize()
    {
        if (is_active_sidebar('sidebar-left') && is_active_sidebar('sidebar-right')) {
            // if both sidebar actived.
            $main_column_size = 6;
        } elseif (
            (is_active_sidebar('sidebar-left') && !is_active_sidebar('sidebar-right')) ||
            (is_active_sidebar('sidebar-right') && !is_active_sidebar('sidebar-left'))
        ) {
            // if only one sidebar actived.
            $main_column_size = 9;
        } else {
            // if no sidebar actived.
            $main_column_size = 12;
        }

        return $main_column_size;
    } // getMainColumnSize
}

require_once get_template_directory() . '/inc/widgets/widget-posts.php';
require_once get_template_directory() . '/inc/widgets/widget-popular-projects.php';

/**
 * Count the footer widgets and add the count to the widget class.
 */
function one_minimal_footer_widgets_params($params)
{
    $sidebar_id = $params[0]['id'];

    if ($sidebar_id == 'main-footer') {

        $total_widgets   = wp_get_sidebars_widgets();
        $sidebar_widgets = count($total_widgets[$sidebar_id]);

        $params[0]['before_widget'] = str_replace('class="', 'class="footer-widget col-md-' . floor(12 / $sidebar_widgets) . ' ', $params[0]['before_widget']);
    }

    return $params;
}
add_filter('dynamic_sidebar_params', 'one_minimal_footer_widgets_params');

function my_login_logo()
{wp_enqueue_style('dosis', 'https://fonts.googleapis.com/css?family=Dosis');?>

    <style type="text/css">
        body {
        background: #fff !important;
        font-family: 'Dosis', sans-serif !important;
        }
        #login h1 a, .login h1 a {
        background-image: url('//ageorgiev.com/wp-content/uploads/2016/11/favicon.png');
        background-size: cover;
        }
        .wp-core-ui .button-primary {
        background: #222 !important;
        text-transform: uppercase;
        width: 50%;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url($url)
{
    return esc_url(home_url());
}

add_filter('login_headertitle', 'custom_loginlogo_title');
function custom_loginlogo_title()
{
    return get_bloginfo('name');
}

function _remove_script_version($src)
{
    return add_query_arg('ver', false, $src);
}
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);

function defer_parsing_of_js($url)
{
//Specify which files to EXCLUDE from defer method. Always add jquery.js
    $files = array('jquery.js', 'isotope.pkgd.min.js', 'imagesloaded.min.js');
    if (!is_admin()) {
        if (false === strpos($url, '.js')) {
            return $url;
        }

        foreach ($files as $file) {
            if (strpos($url, $file)) {
                return $url;
            }
        }

        return "$url' defer='defer";
    } else {
        return $url;
    }

}
add_filter('clean_url', 'defer_parsing_of_js', 11, 1);


//Keywords
function replace_keywords($text)
{
    $replace = array(
        // 'Keyword' => 'REPLACE WORD WITH'
        'GTmetrix'                  => '<a href="https://gtmetrix.com">GTmetrix</a>',
        'Google PageSpeed Insights' => '<a href="https://developers.google.com/speed/pagespeed/insights/">Google PageSpeed Insights</a>',
        'SEO Basics'                => '<a href="/blog/seo/">SEO Basics</a>',
        'Isotope'                   => '<a href="http://isotope.metafizzy.co">Isotope</a>',
        'Avada'                     => '<a href="http://theme-fusion.com/avada/">Avada</a>',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter('content_save_pre', 'replace_keywords');
add_filter('the_content', 'replace_keywords');
//Remove Related Posts
function jetpackme_no_related_posts($options)
{
    if (is_singular()) {
        $options['enabled'] = false;
    }
    return $options;
}
add_filter('jetpack_relatedposts_filter_options', 'jetpackme_no_related_posts');

function wpdocs_custom_excerpt_length($length)
{
    return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';
/* Custom functions that act independently of the theme templates.*/
/**
 * Template functions
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/settings.php';

add_action('rest_api_init', 'register_rest_field_for_custom_taxonomy_location');

//REGISTER
function register_rest_field_for_custom_taxonomy_location()
{
    register_rest_field('jetpack-portfolio',
        'portfolio-categories',
        array(
            'get_callback'    => 'location_get_term_meta_field',
            'update_callback' => 'location_update_term_meta_field',
            'schema'          => null,
        )
    );
}

//WRITE
function location_update_term_meta_field($value, $object, $field_name)
{
    $post_id = $object['id'];
    if (!$value || !is_string($value)) {
        return;
    }
    return update_term_meta($post_id, $field_name, $value);
}

//READ
function location_get_term_meta_field($object, $field_name, $request)
{
    $post_id   = $object['id'];
    $term_list = wp_get_post_terms($post_id, 'jetpack-portfolio-type', array("fields" => "names"));
    return ($term_list);

}
function bulletlist_shortcode($atts)
{
    extract(shortcode_atts(array(
        'elements' => null,
    ), $atts));

    $elements_id = explode("; ", strval($elements));

    if ($elements != null) {
        echo '<ul id="bullet-list">';
        foreach ($elements_id as $single_element) {
            echo '<li data-toggle="tooltip" data-placement="top" title="Tooltip">' . $single_element . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<h2>No Elements</h2>';
    }
}
add_shortcode('bullet_list', 'bulletlist_shortcode');

function employees_shortcode($atts)
{
    //Task
    $employees = array(
        "employees" => array(
            "256" => array
            (
                "employeeID"       => 1,
                "employeeDetails"  => array("firstName" => "John",
                    "lastName"                              => "Doe",
                    "age"                                   => "35",
                    "salary"                                => array(
                        "gbp" => "180",
                        "eur" => "0",
                        "usd" => "0"),
                ),
                "employeePosition" => "Manager",
            ),
            "782" => array
            (
                "employeeID"       => 2,
                "employeeDetails"  => array("firstName" => "Thomas",
                    "lastName"                              => "Hardy",
                    "age"                                   => "31",
                    "salary"                                => array(
                        "gbp" => "0",
                        "eur" => "0",
                        "usd" => "224"),
                ),
                "employeePosition" => "Analyst",
            ),
            "458" => array
            (
                "employeeID"       => 3,
                "employeeDetails"  => array("firstName" => "Maria",
                    "lastName"                              => "Anders",
                    "age"                                   => "24",
                    "salary"                                => array(
                        "gbp" => "0",
                        "eur" => "0",
                        "usd" => "180"),
                ),
                "employeePosition" => "Salesman",
            ),
        ),
    );

//Result
    usort($employees['employees'], function ($a, $b) {
        $a_max_salary = max(array_values($a['employeeDetails']['salary']));
        $b_max_salary = max(array_values($b['employeeDetails']['salary']));

//If we have equal salary, sort by Age
        if ($a_max_salary == $b_max_salary) {
            return $a['employeeDetails']['age'] < $b['employeeDetails']['age'] ? 1 : -1;
        }
        //return our main task - sort by salary
        return $a_max_salary < $b_max_salary ? 1 : -1;
    });
    echo '<pre>';
    print_r($employees);
    echo '</pre>';
}
add_shortcode('employees', 'employees_shortcode');

function sv_move_jp_sharing( $content ) {    
    remove_filter( 'the_content', 'sharing_display', 19 );
    return $content;
}
add_filter( 'the_content', 'sv_move_jp_sharing' );

function piwik() {
?>
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//ageorgiev.com/analytics/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- /WhatsHelp.io widget -->
<?php
}
add_action('wp_footer', 'piwik');