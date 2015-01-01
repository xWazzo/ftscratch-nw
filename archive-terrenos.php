<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Page Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */
    get_header();
    global $woo_options;
?>
       
    <div id="content" class="page col-full">
    
        <?php woo_main_before(); ?>
        
        <section id="main" class="fullwidth archive-terrenos">            

        <?php if ( have_posts() ) : ?>
			
        	<div <?php post_class(); ?>>
				<?php include('mapa/mapa-campestre-ve.svg'); ?>  
			</div>          
        <?php endif; ?>
        
        </section><!-- /#main -->
        
        <?php woo_main_after(); ?>

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
        
<?php get_footer(); ?>
