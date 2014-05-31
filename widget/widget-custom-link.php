<?php
//*************************** Widget Custom Link Begins Here ***************************//

/**
 * Adds custom_link_widget widget.
 */
class custom_link_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			'custom_link_widget', // Base ID
			__('Custom Link', 'text_domain'), // Name
			array( 'description' => __( 'Agrega un link con url, imágen, ícono de FontAwesome y/o texto.' ), ) // Args
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
		$url = apply_filters( 'widget_url', $instance['url'] );
		$text = apply_filters( 'text', $instance['text'] );
		$icon = apply_filters( 'icon', $instance['icon'] );
		$image_url = apply_filters( 'image_url', $instance['image_url'] );
		$custom_class = apply_filters( 'custom_class', $instance[ 'custom_class' ] );
		?>

		<div class="widget-custom-link <?php echo $custom_class ?>">
			<?php if($url): ?>
				<a href="<?php echo $url; ?>">
				<a href="<?php echo $url; ?>">
			<?php endif; ?>
				
				<?php if($icon): ?>
					<div class="widget-custom-link-icon">
						<i class="<?php echo $icon; ?>"></i>
					</div><!-- end .widget-custom-link-icon -->
				<?php endif; ?>

				<?php if($image_url): ?>
					<div class="widget-custom-link-image">
						<img src="<?php echo $image_url; ?>" title="<?php echo $text; ?>" alt="<?php echo $text; ?>" ?>
					</div><!-- end .widget-custom-link-image -->
				<?php endif; ?>

				<?php if($text): ?>
					<div class="widget-custom-link-text">
						<p><?php echo $text; ?></p>
					</div><!-- end .widget-custom-link-text -->
				<?php endif; ?>

			<?php if($url): ?>
				</a>
			<?php endif; ?>
		</div>

		

		<?php

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) { ?>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/widget-jamba-sugiere.css">

	<?php 
		if ( isset( $instance[ 'url' ] ) ) {
			$url = $instance[ 'url' ];
		}
		else{
			$url = __( '', 'my_url' );
		}

		if ( isset( $instance[ 'text' ] ) ) {
			$text = $instance[ 'text' ];
		}
		else{
			$text = __( '', 'text_domain' );
		}

		if ( isset( $instance[ 'icon' ] ) ) {
			$icon = $instance[ 'icon' ];
		}
		else{
			$icon = __( '', 'my_icon' );
		}

		if ( isset( $instance[ 'image_url' ] ) ) {
			$image_url = $instance[ 'image_url' ];
		}
		else{
			$image_url = __( '', 'my_image_url' );
		}

		if ( isset( $instance[ 'custom_class' ] ) ) {
			$custom_class = $instance[ 'custom_class' ];
		}
		else{
			$custom_class = __( '', 'my_custom_class' );
		}

		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Texto:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" placeholder="http://www." />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'icon:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" placeholder="fa fa-facebook" />
		<span>Consigue el nombre del ícono de <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a>. <strong>Recuerda</strong> agrega fa antes de tu fa-icon, p,ej: <strong>fa fa-facebook</strong></span>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e( 'Image URL:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" type="text" value="<?php echo esc_attr( $image_url ); ?>" placeholder="http://www." />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e( 'Css Class:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" type="text" value="<?php echo esc_attr( $custom_class ); ?>" placeholder="primary-btn small" />
		<span>Agrega clases a tu link.</span>
		</p>

		<!-- <p>
			<code>
				<pre>
					<?php var_dump($instance); ?>
				</pre>
			</code>
		</p> -->

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
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';
		$instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ? strip_tags( $new_instance['image_url'] ) : '';
		$instance['custom_class'] = ( ! empty( $new_instance['custom_class'] ) ) ? strip_tags( $new_instance['custom_class'] ) : '';

		return $instance;
	}

} // class custom_link_widget

// register custom_link_widget widget
function register_custom_link_widget() {
    register_widget( 'custom_link_widget' );
}
add_action( 'widgets_init', 'register_custom_link_widget' );

//*************************** Widget Custom Link Ends Here ***************************//
?>