<?php
class Regina_Lite_Widget_Recent_Posts extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 'regina_lite_recent_posts', __( '[MT] - Recent Posts', 'regina-lite' ), array( 'description' => __( '[MT] - Recent Posts description.', 'regina-lite' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( !empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }

        if( !empty( $instance['numberofposts'] ) ) {
            $numberofposts = $instance['numberofposts'];
        }

        $post_query_args = array (
            'post_type'              => array( 'post' ),
            'pagination'             => false,
            'posts_per_page'         => $numberofposts,
            'ignore_sticky_posts'    => true,
            'cache_results'          => true,
            'update_post_meta_cache' => true,
            'update_post_term_cache' => true,
        );

        $post_query = new WP_Query( $post_query_args );

        if( $post_query->have_posts() ) {
            echo '<ul class="nc-icon-ul icon-list">';
                while( $post_query->have_posts() ) {
                    $post_query->the_post();
                    echo '<li class="nc-icon-glyph arrows-1_minimal-right"><a href="'. esc_url( get_the_permalink() ) .'" title="'. esc_attr( get_the_title() ) .'">'. esc_html( get_the_title() ) .'</a></li>';
                }
            echo '</ul>';
        } else {
            echo __( 'No posts found.', 'regina-lite' );
        }

        wp_reset_postdata();

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '[MT] - Recent Posts', 'regina-lite' );
        $numberofposts = !empty( $instance['numberofposts'] ) ? $instance['numberofposts'] : __( '5', 'regina-lite' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'numberofposts' ); ?>"><?php _e( 'Number of posts:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'numberofposts' ); ?>" name="<?php echo $this->get_field_name( 'numberofposts' ); ?>" type="text" value="<?php echo esc_attr( $numberofposts ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['numberofposts'] = ( !empty( $new_instance['numberofposts'] ) ? $new_instance['numberofposts'] : '' );

        return $instance;
    }

}

function regina_lite_register_widget_recent_posts () {
    register_widget( 'Regina_Lite_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'regina_lite_register_widget_recent_posts' );
?>