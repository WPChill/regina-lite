<?php
class Regina_Lite_Widget_Categories extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct( 'regina_lite_categories', __( '[MT] - Categories', 'regina-lite' ), array( 'description' => __( '[MT] - Categories description.', 'regina-lite' ), ) );
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

        $terms = get_terms( array( 'category' ), array() );
        if( !empty( $terms ) ) {
            echo '<ul class="nc-icon-ul icon-list">';
                foreach( $terms as $term ) {
                    echo '<li class="nc-icon-glyph shopping_tag-cut"><a href="'. esc_url( get_term_link( $term, 'category' ) ) .'" title="'. esc_attr( $term->name ) .'">'. esc_html( $term->name ) .'</a></li>';
                }
            echo '</ul>';
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
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '[MT] - Categories', 'regina-lite' );
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

function regina_lite_register_widget_categories () {
    register_widget( 'Regina_Lite_Widget_Categories' );
}
add_action( 'widgets_init', 'regina_lite_register_widget_categories' );
?>