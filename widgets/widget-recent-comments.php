<?php
class Regina_Lite_Widget_Recent_Comments extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 'regina_lite_recent_comments', __( '[MT] - Recent Comments', 'regina-lite' ), array( 'description' => __( '[MT] - Recent Comments description.', 'regina-lite' ), ) );
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

        $comments = get_comments( array( 'number' => 5 ) );
        if( !empty( $comments ) ) {
            echo '<ul class="nc-icon-ul icon-list">';
                foreach( $comments as $comment ) {
                    echo '<li class="nc-icon-outline ui-2_chat-round">'. esc_html( $comment->comment_author ) .' '. __( '-', 'regina-lite' ) .' <a href="'. esc_url( get_comment_link( $comment->comment_ID ) ) .'" title="'. esc_attr( get_the_title( $comment->comment_post_ID ) ) .'">' . esc_html( get_the_title( $comment->comment_post_ID ) ) . '</a></li>';
                }
            echo '</ul>';
        } else {
            echo __( 'No comments.', 'regina-lite' );
        }

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
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '[MT] - Recent Comments', 'regina-lite' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'regina-lite' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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

        return $instance;
    }

}

function regina_lite_register_widget_recent_comments () {
    register_widget( 'Regina_Lite_Widget_Recent_Comments' );
}
add_action( 'widgets_init', 'regina_lite_register_widget_recent_comments' );
?>