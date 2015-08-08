<?php
//DOCS: http://codex.wordpress.org/Function_Reference/register_post_type
//Example: https://gist.github.com/justintadlock/6552000

// ************************************************************
// Change every "custom" text to whatever you want
// Don't forget to capitalize when needed
// ************************************************************

	/* Register custom post types on the 'init' hook. */
	add_action( 'init', 'hero_unit_post_type');

	function hero_unit_post_type(){
		/* Array for labels */

		$caps_name_plural = 'Hero Unit';
		$caps_name_singular = 'Slide';
		$slug_name = 'hero-unit';

		$labels = array(
			/*
			* General name for the post type, usually plural. The same as, and overridden by $post_type_object->label
			*/
			'name'=> 						$caps_name_plural, // Capitalize for better reading
			/*
			* Name for one object of this post type. Defaults to value of 'name'.
			*/
			'singular_name'=> 				$slug_name, 
			/*
			* The menu name text. This string is the name to give menu items. Defaults to value of 'name'.
			*/
			'menu_name'=> 					$caps_name_plural, // Capitalize  for better reading
			/*
			* Name given for the "Add New" dropdown on admin bar. Defaults to 'singular_name' if it exists, 'name' otherwise.
			*/
			'name_admin_bar'=> 				'Agregar '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The all items text used in the menu. Default is the value of 'name'.
			*/
			'all_items'=> 					'Todas las '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
			*/
			'add_new'=> 					'Agregar '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The add new item text. Default is Add New Post/Add New Page
			*/
			'add_new_item'=> 				'Agregar Nueva '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The edit item text. In the UI, this label is used as the main header on the post's editing panel. Default is "Edit Post" for non-hierarchical and "Edit Page" for hierarchical post types.
			*/
			'edit_item'=> 					'Editar '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The new item text. Default is "New Post" for non-hierarchical and "New Page" for hierarchical post types.
			*/
			'new_item'=> 					'Nueva '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The view item text. Default is View Post/View Page
			*/
			'view_item'=> 					'Ver '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The search items text. Default is Search Posts/Search Pages
			*/
			'search_items'=> 				'Encontrar '.$caps_name_singular, // Capitalize  for better reading
			/*
			* The not found text. Default is No posts found/No pages found
			*/
			'not_found'=> 					'No se encontró información de ningún'.$caps_name_singular, 
			/*
			* The not found in trash text. Default is No posts found in Trash/No pages found in Trash.
			*/
			'not_found_in_trash'=> 			'No hay información del '.$caps_name_plural.' en la basura.' 
			/*
			* The parent text. This string is used only in hierarchical post types. Default is "Parent Page".
			*/
			// 'parent_item_colon'=> 		''
		);
		
		/* Set up the arguments for the post type. */
		$args = array(
			/*
			* (string) (optional) A plural descriptive name for the post type marked for translation.
			*/
			'label' =>						$slug_name,
			/*
			* (array) (optional) labels - An array of labels for this post type. By default, post labels are used for non-hierarchical post types and page labels for hierarchical ones.
			*/
			'labels'=>						$labels,
			/*
			* (string) (optional) A short descriptive summary of what the post type is.
			*/
			'description' =>				'Descubre la información de todas las '.$caps_name_singular.'s registradas en el sistema.',
			/*
			* Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers (exclude_from_search, publicly_queryable).
			*/
			'public' =>						true,
			/*
			* (boolean) (importance) Whether to exclude posts with this post type from front end search results.
			*/
			'exclude_from_search' =>		false,
			/*
			* (boolean) (optional) Whether queries can be performed on the front end as part of parse_request().
			*/
			'publicly_query able'=>			true,
			/*
			* (boolean) (optional) Whether to generate a default UI for managing this post type in the admin.
			*/
			'show_ui' =>					true,
			/*
			* (boolean) (optional) Whether post_type is available for selection in navigation menus.
			*/
			// 'show_in_nav_menus' =>			true,
			/*
			* (boolean or string) (optional) Where to show the post type in the admin menu. show_ui must be true.
			*/
			// 'show_in_menu' =>				true, 
			/*
			* The position in the menu order the post type should appear. show_in_menu must be true.
			*/
			// 'show_in_admin_bar' =>			'',
			/*
			* (optional) The position in the menu order the post type should appear. show_in_menu must be true.
			*/
			'menu_position' =>				8,
			/*
			* The url to the icon to be used for this menu or the name of the icon from the iconfont. Ex: 'get_template_directory_uri() . "images/cutom-posttype-icon.png"' (Use a image located in the current theme)
			*/
			'menu_icon' =>					get_template_directory_uri()."/lib/ftscratch-support/custom-post-type/img/hero-unit-post-icon.png",
			/*
			* (string or array) (optional) The string to use to build the read, edit, and delete capabilities. 
				May be passed as an array to allow for alternative plurals when using this argument as a base to construct the capabilities, 
				e.g. array('story', 'stories') the first array element will be used for the singular capabilities and the second array element 
				for the plural capabilities, this is instead of the auto generated version if no array is given which would be "storys". 
				The 'capability_type' parameter is used as a base to construct capabilities unless they are explicitly set with the 'capabilities' parameter. 
				It seems that `map_meta_cap` needs to be set to true, to make this work.

				Default: "post"

				Some of the capability types that can be used (probably not exhaustive list):
				post (default)
				page

				These built-in types cannot be used:
				attachment
				mediapage
			*/
			'capability_type' =>			'post',
			/*
			* (optional) An array of the capabilities for this post type.
			*/
			// 'capabilities' =>			'',
			/*
			* (optional) Whether to use the internal default meta capability handling.
			*/
			// 'map_meta_cap' =>			'',
			/*
			* (optional) Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
			*/
			'hierarchical' =>				true,
			/*
			* (array/boolean) (optional) An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior.
			*/
			'supports' =>					array(
												'title',
												'editor',
												'author',
												'thumbnail',
												'excerpt',
												// 'trackbacks',
												'custom-fields',
												// 'comments',
												'revisions',
												'page-attributes' //(menu order, hierarchical must be true to show Parent option)
												// 'post-formats' //add post formats, see Post Formats
											),
			/*
			* (callback ) (optional) Provide a callback function that will be called when setting up the meta boxes for the edit form. The callback function takes one argument $post, which contains the WP_Post object for the currently edited post. Do remove_meta_box() and add_meta_box() calls in the callback.
			*/
			// 'register_meta_box_cb'=>		,
			/*
			* (array) (optional) An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy().
			*/
			// 'taxonomies' =>					array(
			// 									'category',
			// 									'post_tag'
			// 								),
			/*
			* (boolean or string) (optional) Enables post type archives. Will use $post_type as archive slug by default.
			*/
			'has_archive' =>				$slug_name,
			/*
			* (string) (optional) The default rewrite endpoint bitmasks. For more info see Trac Ticket 12605 and this Make WordPress Plugins summary of endpoints.
			*/
			// 'permalink_epmask' =>		'',
			/*
			* (boolean or array) (optional) Triggers the handling of rewrites for this post type. To prevent rewrites, set to false.
			*/
			'rewrite' =>					array( 
												'slug' => $slug_name, 
												'with_front' => false 
											),
			/*
			* (boolean or string) (optional) Sets the query_var key for this post type.
			*/
			'query_var' =>					true // Default: true - set to $post_type
			/*
			* (boolean) (optional) Can this post_type be exported.
			*/
			// 'can_export' =>				'',	
			/*
			* (boolean) (not for general use) Whether this post type is a native or "built-in" post_type. Note: this Codex entry is for documentation - core developers recommend you don't use this when registering your own post type
			*/
			// '_builtin' =>				'',	
			/*
			* (boolean) (not for general use) Link to edit an entry with this post type. Note: this Codex entry is for documentation - core developers recommend you don't use this when registering your own post type
			*/
			// '_edit_link' =>				'',

		);
		
		register_post_type( $slug_name, $args );
	}

	function my_rewrite_flush_hero_unit() {
	    flush_rewrite_rules();
	}
	add_action( 'after_switch_theme', 'my_rewrite_flush_hero_unit' );


	// Need custom categories or custom tags?
	// Use register_taxonomy
	// DOCS: http://codex.wordpress.org/Function_Reference/register_taxonomy

?>