<?php

/* Edited by NuevaWeb to make it simpler */

/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

require_once( 'lib/ftscratch-support/admin.php' );

require_once( 'lib/ftscratch-support/theme_support.php' );

// Hero Unit (hero-unit.php)
require_once( 'lib/ftscratch-support/hero-unit-post-type.php' ); // you can disable this if you like

/*
Create your own Post Type:
*/
// require_once( 'lib/ftscratch-support/custom-post-type.php' ); // you can disable this if you like

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// add_image_size( 'slide-1500-500', 1500, 500, true );
add_image_size( 'slide-1920-460', 1920, 460, true ); // default fullwith carousel slide

add_image_size( 'bg-thumbnail', 640, 480, true );
add_image_size( 'md-thumbnail', 360, 270, true );
add_image_size( 'sm-thumbnail', 203, 152, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bg-thumbnail' => __('640px by 480px'),
    	// 'md-thumbnail' => __('360px by 270px'),
    	// 'sm-thumbnail' => __('203px by 152px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function nw_register_sidebars() {
	// DOCS: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

	register_sidebar(array(
		'id' => 'sidebar1', // Change the id
		'name' => 'Sidebar 1', // Change the name
		'description' => 'The first (primary) sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	// register_sidebar(array(
	// 	'id' => 'sidebar2', // Change the id
	// 	'name' => 'Sidebar 2', // Change the name
	// 	'description' => 'The first (primary) sidebar.', // Better change description too!
	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<h4 class="widgettitle">',
	// 	'after_title' => '</h4>',
	// ));

} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/


// ====================================
// Custom Support 
// ====================================

// -----------------------------------
// Breadcrumbs function
// -----------------------------------
// Return the post ancestors as breadcrumbs
// Its necesary to echo the function when using it, ex: echo nw_breadcrumbs();
function nw_breadcrumbs(){
	$post_ancestors = array_reverse(get_post_ancestors($post->ID));
	$separator = ' » ';
	if($post_ancestors):
		$breadcrumb = '';
		foreach ($post_ancestors as $ancestor): 
			$breadcrumb .= '<a href="'.get_permalink($ancestor).'">'.get_post($ancestor)->post_title.'</a>'.$separator;
		endforeach;
		$breadcrumb .= '<p>'.get_the_title().'</p>';
		return trim($breadcrumb, $separator);
	else:
		$breadcrumb = FALSE;
		return $breadcrumb;
	endif;
}

// -----------------------------------
// Post Tags function
// -----------------------------------
// Return the post tags
// Its necesary to echo the function when using it, ex: echo nw_tags();
function nw_tags(){
	$posttags = get_the_tags();
	$separator = ', ';
	if($posttags):
		$tag = '';
		foreach($posttags as $meta_tag):
			$tag .= '<a href="'.get_tag_link($meta_tag->term_id).'">'.$meta_tag->name .'</a>'.$separator; 
		endforeach;
		return trim($tag, $separator);
	else:
		$tag = FALSE;
		return $tag;
	endif; 
}


// -----------------------------------
// Add Page attribute "Page Order" to Posts.
// -----------------------------------

// add_action( 'admin_init', 'posts_order_wpse_91866' );

// function posts_order_wpse_91866() 
// {
//     add_post_type_support( 'post', 'page-attributes' );
// }

// -----------------------------------
// Add Post attribute to Page.
// -----------------------------------

// // Exceprt
// add_action( 'admin_init', 'nw_page_excerpt_init' );

// function nw_page_excerpt_init() {
//     add_post_type_support( 'page', 'excerpt' );
// }


//*************************** Widgets Import *************************** //

// require_once( 'widget/widget-custom-link.php' ); // Agrega un custom url, icon o imagen.
// require_once( 'widget/widget-post-type-feed.php' ); // Agrega un custom url, icon o imagen.



















?>