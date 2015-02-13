<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

		<div id="main-content" role="main">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<h1><?php single_cat_title(); ?></h1>

						<?php if (have_posts()) : ?> 
							<?php while (have_posts()) : the_post(); ?>

								<article role="article">
									<div class="row">
										<?php if(has_post_thumbnail()): ?>
											<div class="col-sm-4">
												<?php the_post_thumbnail( 'medium' ); ?>
											</div>
										<?php endif; ?>
										<div class="<?php has_post_thumbnail() ? 'col-sm-8':'col-sm-12' ?>">
											<header>
												<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
											</header>
											<?php the_excerpt(); ?>

											<?php if(function_exists( 'nw_tags' ) && nw_tags()): ?>
												<footer class="tags">
													<p>Tags: <?php echo nw_tags(); ?></p>
												</footer>
											<?php endif; ?>
										</div><!-- /.col-sm-8 -->
									</div>

								</article>
							<?php endwhile; ?>

							<?php if (function_exists('nw_paginate_links')) { ?>
								<?php nw_paginate_links(); ?>
							<?php } else { ?>
								<nav class="wp-prev-next">
									<ul class="clearfix">
										<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'NuevaWeb' )) ?></li>
										<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'NuevaWeb' )) ?></li>
									</ul>
								</nav>
							<?php } ?>

						<?php else : ?>
							<p>No se encontró nada.</p>
						<?php endif; ?>
					</div><!-- /.col-sm-10 col-sm-offset-1 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- #main-content -->

<?php get_footer(); ?>