<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header(); ?>

		<div id="main-content" role="main">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<?php if (have_posts()) : ?> 
							<?php while (have_posts()) : the_post(); ?>
								<article role="article">
									<header>
										<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
										<p class="byline vcard"><?php
											printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link(), get_the_term_list( $post->ID, 'custom_cat', ' ', ', ', '' ) );
										?></p>
									</header>
									
									<?php the_content(); ?>

									<?php if(function_exists( 'nw_tags' ) && nw_tags()): ?>
										<footer class="tags">
											<p>Tags: <?php echo nw_tags(); ?></p>
										</footer>
									<?php endif; ?>

								</article>

							<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
								</footer>
							</article>

						<?php endif; ?>
					</div><!-- /.col-sm-10 col-sm-offset-1 -->

				<?php get_sidebar(); ?>

			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- #main-content -->

<?php get_footer(); ?>
