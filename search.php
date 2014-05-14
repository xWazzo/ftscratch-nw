<?php get_header(); ?>

		<h1><span>Resultados de búsqueda Para:</span> <?php echo esc_attr(get_search_query()); ?></h1>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article>

				<header>
					<h3><?php the_title(); ?></a></h3>
				</header>

				<section>
						<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
				</section>

				<footer>
				</footer>

			</article>

		<?php endwhile; ?>

				<?php if (function_exists('bones_page_navi')) { ?>
						<?php bones_page_navi(); ?>
				<?php } else { ?>
						<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
									<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
								</ul>
						</nav>
				<?php } ?>

		<?php else : ?>

			<?php // A 404 answer goes here ?>

		<?php endif; ?>

		<?php get_sidebar(); ?>

<?php get_footer(); ?>
