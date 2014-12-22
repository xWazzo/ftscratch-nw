<?php
/**
 * Plugin Name: Post Type Feed
 * Plugin URI: http://nuevaweb.com.mx/widget-post-type-feed
 * Description: Get any post type feed anywhere.
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
add_action( 'widgets_init', 'widget_post_type_feed' );

/**
 * Register our widget.
 * 'Post_Type_feed' is the widget class used below.
 *
 * @since 0.1
 */
function widget_post_type_feed() {
	register_widget( 'Post_Type_feed' );
}

/**
 * Post Type feed class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Post_Type_feed extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Post_Type_feed() {
		/* Widget settings. */
		$widget_ops = array( 
			'classname' => 'PostTypeFeed', 
			'description' => __('Agrega cualquier tipo de post a tu sitio web.', 'PostTypeFeed') 
			);

		/* Widget control settings. */
		$control_ops = array( 
			'width' => 300,
		 	'height' => 350, 
		 	'id_base' => 'post-type-feed' 
		 	);

		/* Create the widget. */
		$this->WP_Widget( 'post-type-feed', __('Post Type feed', 'PostTypeFeed'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */

		// Widget Title 
		$title = apply_filters('widget_title', $instance['title'] ); // input text
		
		// Query Args --------------------------------------------------
		$author = $instance['author']; // input text
		$post_type = $instance['post_type']; // select
		$name = $instance['name']; // input text
		$parent_name = $instance['parent_name']; // input, select
		$parent_ID = get_page_by_title($parent_name)->ID; // select
		$category_name = $instance['category_name']; // Consigue el id del parent con el page name.
		$post_per_page = $instance['post_per_page']; // input number
		$orderby = $instance['orderby']; // select
		$order = $instance['order']; // select

		// Feed Args --------------------------------------------------
		$d_postFeed_title = $instance['d_postFeed_title']; // input text
		
		$d_feed_title = isset( $instance['d_feed_title'] ) ? $instance['d_feed_title'] : false; // checkbox
		
		$d_feed_content_or_excerpt = $instance['d_feed_content_or_excerpt']; // radio button content, excerpt, custom desc
		$d_feed_custom_desc = $instance['d_feed_custom_desc']; // textarea
		
		$d_feed_thumbnail = isset( $instance['d_feed_thumbnail'] ) ? $instance['d_feed_thumbnail'] : false; // checkbox
		$d_feed_custom_image = $instance['d_feed_custom_image']; // input text

		$d_feed_img_height = $instance['d_feed_img_height']; // input text

		$d_feed_permalink = $instance['d_feed_permalink'];  // radio button permalink, custom url
		$d_feed_custom_url = $instance['d_feed_custom_url']; // input text
		$d_feed_read_more = isset( $instance['d_feed_read_more'] ) ? $instance['d_feed_read_more'] : false; // checkbox

		$d_feed_author = isset( $instance['d_feed_author'] ) ? $instance['d_feed_author'] : false; // checkbox
		$d_feed_date = isset( $instance['d_feed_date'] ) ? $instance['d_feed_date'] : false; // checkbox

		// // Grid Args --------------------------------------------------
		$grid_post_per_row = $instance['grid_post_per_row']; // select
		// $grid_first_post_offset;
	?>


	<?php // Post Type Feed ================================================== ?>
	<?php // DOCS: http://codex.wordpress.org/Class_Reference/WP_Query ?>

	<?php $call_args = array(
		'author_name' => $author,
		'post_type' => $post_type, // post, page, revision, attachment, post_status, any, custom post type
		'name' => $name,
		'post_parent'=>$parent_name != 'Any Page' ? $parent_ID : "", // Consigue el id del parent con el page name.
		'category_name' => $post_type != 'post' ? "" : ( $category_name == 'All Categories' ? "" : $category_name ),
		'posts_per_page' => $post_per_page,
		'orderby' => $orderby, // none, ID, author, title, name, type, date, modified, parent, rand, comment_count, menu_order, meta_value, meta_value_num, post__in
		'order' => $order // ASC, DESC
	); ?>

	<?php $postType_query = new WP_Query($call_args); ?>

	<?php if ( $postType_query->have_posts() ): ?>
		<?php // $my_category = get_category_by_slug($call_args['category_name']); ?>
		<?php // $my_category_permalink = get_category_link($my_category->cat_ID); ?>

		<!-- 
		<section id="something-unique" class="postType-feed">
			<div class="container">
				<div class="row">

					<?php if($d_postFeed_title): ?>					
						<header class="col-sm-12">
							<h2><?php echo $d_postFeed_title; ?></h2>
						</header>
						<div class="clearfix"></div>
					<?php endif; ?>
		-->

					<?php if( $d_feed_title || $d_feed_thumbnail !=3 || $d_feed_content_or_excerpt != 1 ): ?>
						<?php $i = 1; while ( $postType_query->have_posts() ): $postType_query->the_post(); ?>
							<article class="post-feed col-sm-<?php echo 12/$grid_post_per_row; ?>">

								<?php if($d_feed_img_height): ?>
									<style type="text/css">
										.post-featured-image-max-height{ max-height: <?php echo $d_feed_img_height; ?>px; overflow: hidden; }
									</style>
								<?php endif; ?>

								<?php if($d_feed_thumbnail == 1): ?>
									<div class="post-featured-image <?php echo $d_feed_img_height ? "post-featured-image-max-height": ""; ?>">
										<a href="<?php echo ($d_feed_permalink == 1 ? get_the_permalink() : $d_feed_custom_url); ?>">
											<?php echo has_post_thumbnail() ? get_the_post_thumbnail(get_the_ID(),'md-thumbnail') : '<img src="' . get_bloginfo('template_url') . '/img/assets/no-thumb.png" title="' . get_the_title() . '" >' ; ?>
										</a>
									</div><!-- end .post-featured-image -->

								<?php elseif($d_feed_custom_image && $d_feed_thumbnail != 3): ?>
									<div class="post-featured-image <?php echo $d_feed_img_height ? "post-featured-image-max-height": ""; ?>">
										<a href="<?php echo ($d_feed_permalink == 1 ? get_the_permalink() : $d_feed_custom_url); ?>">
											<img src="<?php echo $d_feed_custom_image; ?>" title="<?php echo get_the_title() ? get_the_title() : ''; ?>" alt="<?php echo get_the_title() ? get_the_title() : ''; ?>">
										</a>
									</div><!-- end .post-featured-image -->
								<?php endif; ?>

								<?php if($d_feed_title): ?>
									<header class="post-title">
										<h3><a href="<?php echo ($d_feed_permalink == 1 ? get_the_permalink() : $d_feed_custom_url); ?>"><?php the_title(); ?></a></h3>
									</header>
								<?php endif; ?>

								<?php if($d_feed_content_or_excerpt != 1): ?>
									<div class="post-excerpt">
										<?php echo ($d_feed_content_or_excerpt == 2 ? '<p>' . get_the_content() . '</p>' : 
													 ($d_feed_content_or_excerpt == 3 ? '<p>' . get_the_excerpt() . '</p>' : '<p>' . $d_feed_custom_desc . '</p>' )
													); ?>
									</div><!-- end .post-excerpt -->
								<?php endif; ?>
								
								<?php if($d_feed_read_more): ?>
									<a class="primary-btn" href="<?php echo ($d_feed_permalink == 1 ? get_the_permalink() : $d_feed_custom_url); ?>">Ver más ≫</a>
								<?php endif; ?>
							</article><!-- end .post-feed -->

							<?php echo $i != 0 && $i % $grid_post_per_row == 0 ? '<div class="clearfix"></div>' : ''; ?>
						<?php $i++; endwhile; ?>
					<?php endif; ?>
	<!-- 
				</div>
			</div>
		</section>
	-->
		
		<?php wp_reset_postdata(); ?>
	<?php else: ?>
		<?php // Wops! There is nothing to show ?>
		<h1>Something went wrong</h1>
	<?php endif; ?>
	<?php // End Post Type Feed ================================================== ?>

	<?php	
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['author'] = strip_tags( $new_instance['author'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['parent_name'] = strip_tags( $new_instance['parent_name'] );
		$instance['post_per_page'] = strip_tags( $new_instance['post_per_page'] );
		$instance['d_postFeed_title'] = strip_tags( $new_instance['d_postFeed_title'] );
		$instance['d_feed_custom_desc'] = strip_tags( $new_instance['d_feed_custom_desc'] );
		$instance['d_feed_custom_image'] = strip_tags( $new_instance['d_feed_custom_image'] );
		$instance['d_feed_img_height'] = strip_tags( $new_instance['d_feed_img_height'] );
		$instance['d_feed_custom_url'] = strip_tags( $new_instance['d_feed_custom_url'] );

		/* No need to strip tags for this. */
		$instance['category_name'] = $new_instance['category_name'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['d_feed_title'] = $new_instance['d_feed_title'];
		$instance['d_feed_content_or_excerpt'] = $new_instance['d_feed_content_or_excerpt'];
		$instance['d_feed_thumbnail'] = $new_instance['d_feed_thumbnail'];
		$instance['d_feed_permalink'] = $new_instance['d_feed_permalink'];
		$instance['d_feed_read_more'] = $new_instance['d_feed_read_more'];
		$instance['d_feed_author'] = $new_instance['d_feed_author'];
		$instance['d_feed_date'] = $new_instance['d_feed_date'];
		$instance['grid_post_per_row'] = $new_instance['grid_post_per_row'];
		

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
		 	'title' => __('Section Title', 'PostTypeFeed'),
			'author' => __('', 'PostTypeFeed'),
			'post_type' => __('', 'PostTypeFeed'),
			'name' => __('', 'PostTypeFeed'),
			'parent_name' => __('', 'PostTypeFeed'),
			'category_name' => __('', 'PostTypeFeed'),
			'post_per_page' => __('', 'PostTypeFeed'),
			'orderby' => __('', 'PostTypeFeed'),
			'order' => __('', 'PostTypeFeed'),

			// Feed Args
			'd_postFeed_title' => __('', 'PostTypeFeed'),
			'd_feed_title' => true,
			'd_feed_custom_desc' => __('', 'PostTypeFeed'),
			'd_feed_custom_image' => __('', 'PostTypeFeed'),
			'd_feed_img_height' => __('', 'PostTypeFeed'),
			'd_feed_custom_url' => __('', 'PostTypeFeed'),
			'd_feed_content_or_excerpt' => true,
			'd_feed_thumbnail' => true,
			'd_feed_permalink' => __('1', 'PostTypeFeed'),
			'd_feed_read_more' => true,
			'd_feed_author' => false,
			'd_feed_date' => false,

			// Grid Args
			'grid_post_per_row' => __('', 'PostTypeFeed')
		 	);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<?php // CSS ================================================== ?>
		<style type="text/css">
			.widget-content  span{ font-size: .8em; }
		</style>

		<!-- $title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Título:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" placeholder="Widget Title" />
			<span>El valor únicamente sirve para darle nombre al widget e identificarlo. No repercute en el back end ni front end.</span>
		</p>

		<?php // Query Args ================================================== ?>

		<h3>Query Arguments</h3>

		<span>Selecciona los argumentos para filtrar la búsqueda de la información que deseas desplegar.</span>

		<!-- $post_type: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Post Type:', 'PostTypeFeed'); ?></label>
			<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat" style="width:100%;">
				<?php $post_types = get_post_types( '', 'names' ); ?>
				<?php foreach ( $post_types as $post_type ): ?>
					<option <?php if ( $post_type == $instance['post_type'] ) echo 'selected="selected"'; ?>><?php echo $post_type; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<!-- $name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Name:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" placeholder="Page or Post Name"/>
		</p>

		<!-- $author: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e('Author:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" value="<?php echo $instance['author']; ?>" style="width:100%;" placeholder="Author name"/>
		</p>

		<!-- $parent_name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'parent_name' ); ?>"><?php _e('Parent Name:', 'PostTypeFeed'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'parent_name' ); ?>" name="<?php echo $this->get_field_name( 'parent_name' ); ?>" class="widefat" style="width:100%;">
				<option>Any Page</option>
				<?php
				$args = array(
				  'orderby' => 'name',
				  'order' => 'ASC'
				  );
				$pages = get_pages($args);
				  foreach($pages as $page) { 
				  	if ($instance['parent_name'] == $page->post_title) {
				  		echo '<option selected="selected">'. $page->post_title .'</option>';
				  	}else{
					    echo '<option>'. $page->post_title . '</option>';
				  	}
				  }// end foreach 
				?>
			</select>
			<span>Despliega los hijos del parent seleccionado.</span>
		</p>


		<!-- $category_name: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category_name' ); ?>"><?php _e('Category Name:', 'PostTypeFeed'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'category_name' ); ?>" name="<?php echo $this->get_field_name( 'category_name' ); ?>" class="widefat" style="width:100%;">
				<option>All Categories</option>
				<?php
				$args = array(
				  'orderby' => 'name',
				  'order' => 'ASC'
				  );
				$categories = get_categories($args);
				  foreach($categories as $category) { 
				  	if ($instance['category_name'] == $category->name) {
				  		echo '<option selected="selected">'. $category->name .'</option>';
				  	}else{
					    echo '<option>'. $category->name . '</option>';
				  	}
				  }// end foreach 
				?>
			</select>
		</p>


		<!-- $orderby: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('Order by:', 'PostTypeFeed'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'none' == $instance['orderby'] ) echo 'selected="selected"'; ?>>none</option>
				<option <?php if ( 'ID' == $instance['orderby'] ) echo 'selected="selected"'; ?>>ID</option>
				<option <?php if ( 'author' == $instance['orderby'] ) echo 'selected="selected"'; ?>>author</option>
				<option <?php if ( 'title' == $instance['orderby'] ) echo 'selected="selected"'; ?>>title</option>
				<option <?php if ( 'name' == $instance['orderby'] ) echo 'selected="selected"'; ?>>name</option>
				<option <?php if ( 'type' == $instance['orderby'] ) echo 'selected="selected"'; ?>>type</option>
				<option <?php if ( 'date' == $instance['orderby'] ) echo 'selected="selected"'; ?>>date</option>
				<option <?php if ( 'modified' == $instance['orderby'] ) echo 'selected="selected"'; ?>>modified</option>
				<option <?php if ( 'parent' == $instance['orderby'] ) echo 'selected="selected"'; ?>>parent</option>
				<option <?php if ( 'rand' == $instance['orderby'] ) echo 'selected="selected"'; ?>>rand</option>
				<option <?php if ( 'comment_count' == $instance['orderby'] ) echo 'selected="selected"'; ?>>comment_count</option>
				<option <?php if ( 'menu_order' == $instance['orderby'] ) echo 'selected="selected"'; ?>>menu_order</option>
				<option <?php if ( 'meta_value' == $instance['orderby'] ) echo 'selected="selected"'; ?>>meta_value</option>
				<option <?php if ( 'meta_value_num' == $instance['orderby'] ) echo 'selected="selected"'; ?>>meta_value_num</option>
				<option <?php if ( 'post__in' == $instance['orderby'] ) echo 'selected="selected"'; ?>>post__in</option>
			</select>
		</p>

		<!-- $order: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Order:', 'PostTypeFeed'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'ASC' == $instance['order'] ) echo 'selected="selected"'; ?>>ASC</option>
				<option <?php if ( 'DESC' == $instance['order'] ) echo 'selected="selected"'; ?>>DESC</option>
			</select>
		</p>


		<!-- $post_per_page: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_per_page' ); ?>"><?php _e('Post per page:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_per_page' ); ?>" type="number" name="<?php echo $this->get_field_name( 'post_per_page' ); ?>" value="<?php echo $instance['post_per_page']; ?>" style="width:100%;" placeholder="-1 to display all" min="-1" />
		</p>

		<?php // Feed Args ================================================== ?>
		<h3>Feed Arguments</h3>

		<span>Selecciona los valores que deseas que se desplieguen en el front end.</span>

		<!-- $d_postFeed_title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'd_postFeed_title' ); ?>"><?php _e('Section Title:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'd_postFeed_title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'd_postFeed_title' ); ?>" value="<?php echo $instance['d_postFeed_title']; ?>" style="width:100%;" placeholder="Section Title" />
		</p>

		<!-- $d_feed_title: Show Title? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['d_feed_title'], true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_title' ); ?>" name="<?php echo $this->get_field_name( 'd_feed_title' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_title' ); ?>"><?php _e('Display Title?', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_content_or_excerpt: Show Thumbnail? Checkbox -->
		<p>
			<input class="radio" type="radio" <?php checked( $instance['d_feed_content_or_excerpt'], 1, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-1" name="<?php echo $this->get_field_name( 'd_feed_content_or_excerpt' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-1"><?php _e('None', 'PostTypeFeed'); ?></label>

			<input class="radio" type="radio" <?php checked( $instance['d_feed_content_or_excerpt'], 2, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-2" name="<?php echo $this->get_field_name( 'd_feed_content_or_excerpt' ); ?>" value="2" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-2"><?php _e('Content', 'PostTypeFeed'); ?></label>

			<input class="radio" type="radio" <?php checked( $instance['d_feed_content_or_excerpt'], 3, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-3" name="<?php echo $this->get_field_name( 'd_feed_content_or_excerpt' ); ?>" value="3" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-3"><?php _e('Excerpt', 'PostTypeFeed'); ?></label>

			<br>
			<input class="radio" type="radio" <?php checked( $instance['d_feed_content_or_excerpt'], 4, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-4" name="<?php echo $this->get_field_name( 'd_feed_content_or_excerpt' ); ?>" value="4" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_content_or_excerpt' ); ?>-4"><?php _e('Custom desc', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_custom_desc: Show Title? Checkbox -->
		<p>
			<label for="<?php echo $this->get_field_id( 'd_feed_custom_desc' ); ?>"><?php _e('Custom Text:', 'PostTypeFeed'); ?></label>
			<textarea class="textarea" id="<?php echo $this->get_field_id( 'd_feed_custom_desc' ); ?>" name="<?php echo $this->get_field_name( 'd_feed_custom_desc' ); ?>" style="width: 100%; min-height: 90px;"><?php echo $instance['d_feed_custom_desc'] ? $instance['d_feed_custom_desc'] : ''; ?></textarea>
		</p>

		<!-- $d_feed_thumbnail: Show Thumbnail? Checkbox -->
		<p>
			<input class="radio" type="radio" <?php checked( $instance['d_feed_thumbnail'], 1, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-1" name="<?php echo $this->get_field_name( 'd_feed_thumbnail' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-1"><?php _e('Post Thumbnail', 'PostTypeFeed'); ?></label>

			<input class="radio" type="radio" <?php checked( $instance['d_feed_thumbnail'], 2, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-2" name="<?php echo $this->get_field_name( 'd_feed_thumbnail' ); ?>" value="2" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-2"><?php _e('Custom Image', 'PostTypeFeed'); ?></label>

			<input class="radio" type="radio" <?php checked( $instance['d_feed_thumbnail'], 3, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-3" name="<?php echo $this->get_field_name( 'd_feed_thumbnail' ); ?>" value="3" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_thumbnail' ); ?>-3"><?php _e('None', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_custom_image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'd_feed_custom_image' ); ?>"><?php _e('Custom Image URL:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'd_feed_custom_image' ); ?>" type="text" name="<?php echo $this->get_field_name( 'd_feed_custom_image' ); ?>" value="<?php echo $instance['d_feed_custom_image']; ?>" style="width:100%;" placeholder="http://www." />
		</p>

		<!-- $d_feed_img_height: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'd_feed_img_height' ); ?>"><?php _e('Image Max-Height:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'd_feed_img_height' ); ?>" type="number" name="<?php echo $this->get_field_name( 'd_feed_img_height' ); ?>" value="<?php echo $instance['d_feed_img_height']; ?>" style="width:100%;" placeholder="270" />
		</p>

		<!-- $d_feed_permalink: Show Thumbnail? Checkbox -->
		<p>
			<input class="radio" type="radio" <?php checked( $instance['d_feed_permalink'], 1, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_permalink' ); ?>-1" name="<?php echo $this->get_field_name( 'd_feed_permalink' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_permalink' ); ?>-1"><?php _e('permalink', 'PostTypeFeed'); ?></label>

			<input class="radio" type="radio" <?php checked( $instance['d_feed_permalink'], 2, true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_permalink' ); ?>-2" name="<?php echo $this->get_field_name( 'd_feed_permalink' ); ?>" value="2" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_permalink' ); ?>-2"><?php _e('custom url', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_custom_url: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'd_feed_custom_url' ); ?>"><?php _e('Custom URL:', 'PostTypeFeed'); ?></label>
			<input id="<?php echo $this->get_field_id( 'd_feed_custom_url' ); ?>" type="text" name="<?php echo $this->get_field_name( 'd_feed_custom_url' ); ?>" value="<?php echo $instance['d_feed_custom_url']; ?>" style="width:100%;" placeholder="http://www." />
		</p>

		<!-- $d_feed_read_more: Show Read More? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['d_feed_read_more'], true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_read_more' ); ?>" name="<?php echo $this->get_field_name( 'd_feed_read_more' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_read_more' ); ?>"><?php _e('Display Read more?', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_author: Show Author? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['d_feed_author'], true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_author' ); ?>" name="<?php echo $this->get_field_name( 'd_feed_author' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_author' ); ?>"><?php _e('Display Author?', 'PostTypeFeed'); ?></label>
		</p>

		<!-- $d_feed_date: Show Date? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['d_feed_date'], true ); ?>  id="<?php echo $this->get_field_id( 'd_feed_date' ); ?>" name="<?php echo $this->get_field_name( 'd_feed_date' ); ?>" value="1" /> 
			<label for="<?php echo $this->get_field_id( 'd_feed_date' ); ?>"><?php _e('Display Date?', 'PostTypeFeed'); ?></label>
		</p>

		<?php // Feed Args ================================================== ?>
		<h3>Grid Arguments</h3>

		<!-- $grid_post_per_row: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'grid_post_per_row' ); ?>"><?php _e('Post per row:', 'PostTypeFeed'); ?></label>
			<select id="<?php echo $this->get_field_id( 'grid_post_per_row' ); ?>" name="<?php echo $this->get_field_name( 'grid_post_per_row' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( '3' == $instance['grid_post_per_row'] ) echo 'selected="selected"'; ?>>3</option>
				<option <?php if ( '4' == $instance['grid_post_per_row'] ) echo 'selected="selected"'; ?>>4</option>
			</select>
		</p>

	<?php
	}
}

?>