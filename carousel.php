<?php $args_carousel = array(
	'category_name' => 'carousel',
	'posts_per_page' => 4,
	'orderby' => 'menu_order',
	'order' => 'ASC'
); ?>


<?php $carousel_query = new WP_Query( $args_carousel ); ?>
<?php $sizeof_query = sizeof($carousel_query->posts); ?>

<?php if( $carousel_query->have_posts() ): ?>

<div id="main-carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <?php if( $sizeof_query > 1 ): ?>
	  <ol class="carousel-indicators">
	  	<?php $i=0; ?>
		<?php while( $carousel_query->have_posts() ) : $carousel_query->the_post(); ?>
			<?php if( $i==0 ): ?>			
			    <li data-target="#main-carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
			<?php else: ?>
			    <li data-target="#main-carousel" data-slide-to="<?php echo $i; ?>"></li>
			<?php endif; ?>
		<?php $i++; endwhile; ?>
	  </ol>
	<?php endif; ?>

	<div class="carousel-inner">
	  	<?php $i=0; ?>
	  	<?php while( $carousel_query->have_posts() ) : $carousel_query->the_post(); ?>
	  		<?php $url = get_post_custom_values('[URL]'); ?>
	  		<?php $thumb_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'slide-1920-460'); // Get the post thumbnail img src ?>
			<?php $thumb_url_src = $thumb_img_src[0]; // set the thumbnail src url, to use it as a background ?>

			<div class="item <?php echo $i == 0 ? 'active':''; ?>">
	    	<?php if( has_post_thumbnail() ): ?>
	    		<style type="text/css">
			  		.slide-<?php echo $i; ?>{ background-image: url(<?php echo $thumb_url_src; ?>); }
			  	</style>
		    <?php endif; ?>
		    	<div class="carousel-slide <?php echo has_post_thumbnail() ? 'slide-'.$i : ''; ?>">

			    <?php if( get_the_content() ): ?>
					<div class="container">
						<div class="row">
							<article class="col-xs-12">
								<?php the_title('<h2>','</h2>'); ?>

						    	<?php the_content(); ?>

						    	<a class="primary-btn" href="<?php echo $url[0] ? $url[0] : get_the_permalink(); ?>">Ver más ≫</a>
							</article><!-- end .col-xs-12 -->
						</div><!-- end .row -->
					</div><!-- end .container -->
				<?php endif; ?>

	    		</div><!-- end .carousel-slide slide- -->

		    </div><!-- end .item -->
		<?php $i++; endwhile; ?>
	</div><!-- end .carousel-inner -->

	<?php if( $sizeof_query > 1 ): ?>
		<!-- Controls -->
		<a class="left carousel-control" data-target="#main-carousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" data-target="#main-carousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	<?php endif; ?>

</div><!-- end #main-carousel -->

<?php wp_reset_postdata(); ?>
<?php else: ?>
	<?php // No existen post con category Carousel ?>
<?php endif; ?>