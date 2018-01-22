<?php
/**
 * Plugin Name: Popular Portfolio
 */

class popular_Portfolio_widget extends WP_Widget
{

    /**
     * Widget setup.
     */
    public function __construct()
    {
        /* Widget settings. */
        $widget_ops = array('classname' => 'one_minimal_portfolio_widget', 'description' => __('Displays grid items of portfolio', 'one-minimal'));

        /* Create the widget. */
        parent::__construct('one_minimal_portfolio_widget', 'Popular Portfolio', $widget_ops);

    }

    /**
     * How to display the widget on the screen.
     */
    public function widget($args, $instance)
    {
        extract($args);

        /* Our variables from the widget settings. */
        $number = $instance['number'];
        //$title = $instance['widget_title'];
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
        ?>
        <div class="card1">
         <div class="card-block1">
            <ul id="portfolio-posts">

                    <?php
      $most_viewed = new WP_Query(array(
            'showposts'           => $number,
            'post_type'           => 'jetpack-portfolio',
            'ignore_sticky_posts' => 1,
            'post_status'         => 'publish',
            'order'               => 'DESC',
            'meta_key'            => 'post_views_count',
            'orderby'             => 'meta_value_num'));
        ?>

                    <?php while ($most_viewed->have_posts()): $most_viewed->the_post();?>
                          <li class="portfolio-widget-post">
                              <?php if (has_post_thumbnail()): ?>
                              <a href="<?php echo get_permalink() ?>" class="tab-thumb thumbnail" rel="bookmark" title="<?php the_title();?>">
                                  <?php the_post_thumbnail(array(83, 83));?>
                              </a>
                              <?php endif;?>
                        </li>
                    <?php endwhile;?>         

                </ul>
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
        $defaults = array('number' => 6);
        $instance = wp_parse_args((array) $instance, $defaults);
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );?>

    <!-- Number of posts -->
     <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show', 'one-minimal')?>:</label>
      <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" type="number" size="3" />
    </p>

  <?php
}
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';

      return $instance;
    }
}
?>