<?php
/**
 * Plugin Name: Popular, Recent Posts
 */

class popular_Liked_commented_Posts_widget extends WP_Widget
{

    /**
     * Widget setup.
     */
    public function __construct()
    {
        /* Widget settings. */
        $widget_ops = array('classname' => 'one_minimal_tabbed_widget', 'description' => __('Displays tabbed list of popular posts, recent posts & comments', 'one-minimal'));

        /* Create the widget. */
        parent::__construct('one_minimal_tabbed_widget', 'Popular, Liked, Commented Posts', $widget_ops);

    }

    /**
     * How to display the widget on the screen.
     */
    public function widget($args, $instance)
    {
        extract($args);

        /* Our variables from the widget settings. */
        $number = $instance['number'];
 echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
        ?>

        <div class="widget tabbed">
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs nav-fill">
                      <li class="nav-item active" title="Popular Posts"><a href="#popular-posts" data-toggle="tab" class="nav-link"><i class="fa fa-eye"></i></a></li>
                      <li class="nav-item" title="Most Liked Posts"><a class="nav-link" href="#liked" data-toggle="tab"><i class="fa fa-thumbs-o-up"></i></a></li>
                      <li class="nav-item" title="Most Commented"><a class="nav-link" href="#most-comment" data-toggle="tab"><i class="fa fa-comments-o"></i></a></li>

                </ul>

            <div class="tab-content">
                <ul id="popular-posts" class="tab-pane active">

                    <?php
			$most_viewed = new WP_Query(array(
            'showposts'           => $number,
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish',
            'order'               => 'DESC',
            'meta_key'            => 'post_views_count',
            'orderby'             => 'meta_value_num'));
        ?>

                    <?php while ($most_viewed->have_posts()): $most_viewed->the_post();?>
	                        <li>
	                            <?php if (has_post_thumbnail()): ?>
	                            <a href="<?php echo get_permalink() ?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title();?>">
	                                <?php the_post_thumbnail(array(64, 64));?>
	                            </a>
	                            <?php endif;?>
                            <div class="post-content">
                                <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                              <span class="date"><?php echo get_the_date('d M , Y'); ?></span>
                            </div>
                        </li>
                    <?php endwhile;?>

                </ul>
                <?php wp_reset_postdata();?>

                <ul id="liked" class="tab-pane">

                    <?php
$liked = new WP_Query(array(
            'showposts'           => $number,
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish',
            'order'               => 'DESC',
            'meta_key'            => '_post_like_count',
            'orderby'             => 'meta_value_num'));
        ?>

                     <?php while ($liked->have_posts()): $liked->the_post();?>
	                        <li>
	                            <?php if (has_post_thumbnail()): ?>
	                            <a href="<?php echo get_permalink() ?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title();?>">
	                                <?php the_post_thumbnail(array(54, 65));?>
	                            </a>
	                            <?php endif;?>
                           <div class="post-content">
                                <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                              <span class="date"><?php echo get_the_date('d M , Y'); ?></span>
                            </div>
                        </li>
                    <?php endwhile;?>
                </ul>
                <?php wp_reset_postdata();?>

<ul id="most-comment" class="tab-pane">

                    <?php
$recent_posts = new WP_Query(array(
            'showposts'           => $number,
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish',
            'order'               => 'DESC',
            'showposts'           => $number,
            'orderby'             => 'comment_count'));
        ?>

                    <?php while ($recent_posts->have_posts()): $recent_posts->the_post();?>
	                        <li>
	                            <?php if (has_post_thumbnail()): ?>
	                            <a href="<?php echo get_permalink() ?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title();?>">
	                                <?php the_post_thumbnail(array(64, 64));?>
	                            </a>
	                            <?php endif;?>
                            <div class="post-content">
                                <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                              <span class="date"><?php echo get_the_date('d M , Y'); ?></span>
                            </div>
                        </li>
                    <?php endwhile;?>
                </ul>
                <?php wp_reset_postdata();?>

                <ul id="messages" class="tab-pane">

                <?php
$recent_comments = get_comments(array(
            'number' => $number,
            'status' => 'approve',
        ));
        ?>
                <?php foreach ($recent_comments as $comment): ?>

                    <li>
                        <div class="content">
                            <?php if ($comment->comment_author) {echo $comment->comment_author;} else {_e('Anonymous', 'one-minimal');}?> <?php _e('on', 'one-minimal');?>
                            <a href="<?php echo get_permalink($comment->comment_post_ID) ?>" rel="bookmark" title="<?php echo get_the_title($comment->comment_post_ID); ?>">
                                <?php echo get_the_title($comment->comment_post_ID); ?>
                            </a>
                            <p>
                            <?php echo substr($comment->comment_content, 0, strrpos(substr($comment->comment_content, 0, 60), ' ')); ?>
                            <?php if (strlen($comment->comment_content) > 60) {echo '(...)';}?>
                            </p>
                        </div>
                    </li>


                 <?php endforeach;?>

                </ul>
                </div>
            </div>
        </div>

    <?php
     echo $args['after_widget'];
}

/**
 * Outputs the options form on admin
 *
 * @param array $instance The widget options
 */
    public function form($instance)
    {

        /* Set up some default widget settings. */
        $defaults = array('number' => 3);
        $instance = wp_parse_args((array) $instance, $defaults);
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <!-- Number of posts -->
    <p>
      <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show', 'one-minimal')?>:</label>
      <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" size="3" type="number" />
    </p>

  <?php
}
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

        return $instance;
    }
}
?>