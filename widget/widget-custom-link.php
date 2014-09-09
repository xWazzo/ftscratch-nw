<?php
/**
 * Plugin Name: Custom Widget
 * Plugin URI: http://nuevaweb.com.mx/widget-custom-link
 * Description: A widget that make custom links with icon, image, url and text.
 * Author: Carlos González
 * Author URI: http://nuevaweb.com.mx/
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'widget_custom_link' );

/**
 * Register our widget.
 * 'Custom_Link' is the widget class used below.
 *
 * @since 0.1
 */
function widget_custom_link() {
	register_widget( 'Custom_Link' );
}

/**
 * Custom Link class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Custom_Link extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Custom_Link() {
		/* Widget settings. */
		$widget_ops = array( 
			'classname' => 'CustomLink', 
			'description' => __('Agrega un link con url, imágen, ícono de FontAwesome y/o texto.', 'CustomLink') 
			);

		/* Widget control settings. */
		$control_ops = array( 
			'width' => 300,
		 	'height' => 350, 
		 	'id_base' => 'custom-link' 
		 	);

		/* Create the widget. */
		$this->WP_Widget( 'custom-link', __('Custom Link', 'CustomLink'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$url = $instance['url'];
		$icon = $instance['icon'];
		$image_url = $instance['image_url'];
		$custom_class = $instance['custom_class'];
	?>

	<div class="widget-custom-link">

		<?php if($custom_class): ?>
			<div class="widget-custom-link-class <?php echo $custom_class ?>">
		<?php endif; ?>

			<?php if($url): ?>
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

				<?php if($title): ?>
					<div class="widget-custom-link-title">
						<p><?php echo $title; ?></p>
					</div><!-- end .widget-custom-link-title -->
				<?php endif; ?>

			<?php if($url): ?>
				</a>
			<?php endif; ?>

		<?php if($custom_class): ?>
			</div><!-- end .widget-custom-link-class -->
		<?php endif; ?>				
	</div>

	<?php	
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['image_url'] = strip_tags( $new_instance['image_url'] );
		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			// 'title' => __('Link name', 'CustomLink'),
		 // 	'name' => __('', 'CustomLink'),
		 // 	'sex' => 'male', 
		 // 	'show_sex' => true 

		 	'title' => __('Link name', 'CustomLink'),
			'url' => __('', 'CustomLink'),
			'icon' => __('', 'CustomLink'),
			'image_url' => __('', 'CustomLink'),
			'custom_class' => __('', 'CustomLink')

		 	);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Título:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('URL:', 'CustomLink'); ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" style="width:100%;" placeholder="http://www."/>
		</p>

		<!-- Your Icon: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e('Icon:', 'CustomLink'); ?></label>
			<input id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" value="<?php echo $instance['icon']; ?>" style="width:100%;" placeholder="fa fa-facebook"/>
			<span>Consigue el nombre del ícono de <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a>. <strong>Recuerda</strong> agrega fa antes de tu fa-icon, p,ej: <strong>fa fa-facebook</strong></span>
		</p>

		<!-- Your Custom Css Class: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>"><?php _e('Css Class:', 'CustomLink'); ?></label>
			<input id="<?php echo $this->get_field_id( 'custom_class' ); ?>" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" value="<?php echo $instance['custom_class']; ?>" style="width:100%;" placeholder="primary-btn small"/>
			<span>Agrega clases a tu link.</span>
		</p>

		<!-- Your Image URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e('Image URL:', 'CustomLink'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $instance['image_url']; ?>" style="width:100%;" placeholder="http://www."/>
		</p>

	<?php
	}
}

?>