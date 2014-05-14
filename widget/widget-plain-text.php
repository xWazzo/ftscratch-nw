<?php 
//*************************** Widget "plain_text_widget" Begins Here  ***************************//

/**
 * Adds plain_text_widget widget.
 */
class plain_text_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		// -------------- widget actual processes -------------- 
		parent::__construct(
	 		'plain_text_widget', // Base ID
			'Plain Text', // Name
			array( 'description' => __( 'Displays text without any container. (No div just plain text)', 'text_domain' ), ) // Args
		);
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
		// -------------- outputs the content of the widget -------------- 
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
			if ( ! empty( $title ) ){
				echo $title;
			// echo __( 'Hello, World!', 'text_domain' );
			}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		// --------------  outputs the options form on admin -------------- 
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Your Plain Text:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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
		// -------------- processes widget options to be saved -------------- 
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class plain_text_widget

// register plain_text_widget widget
add_action( 'widgets_init', function() { register_widget( 'plain_text_widget' ); } );

// My Widget "plain_text_widget" Ends Here
// =======================================