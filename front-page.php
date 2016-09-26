<?php
/**
 * The template for displaying the homepage.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AAFP
 */

get_header(); ?>


<section class="row-slider">
	<div class="mobile-hidden bg-img">
		
	</div>
	<div class="slider-col">
		<?php echo do_shortcode('[masterslider id="1"]'); ?>
	</div>
</section>

<section id="featured-categories">
	<ul class="featured-categories">
	  <?php
	 
	  $meta_query_args = array(
	    'post_type'      => 'category-page',
	    'posts_per_page' => -1,
	    'post_status'    => 'publish',
	    'meta_query'     => array(
	      array(
	        'key'     => 'featured',
	        'value'   => '',
	        'compare'   => '!=',
	      ),
	    ),
	  );

	  // a new instance of the WP_query class   
	  $meta_query = new WP_Query( $meta_query_args );

	  if( $meta_query->have_posts() ) : while( $meta_query->have_posts() ) : $meta_query->the_post(); ?>

	    <li class="featured-category">
	      	<a href="<?php the_permalink() ?>">
	      <?php 

		// render
		?>

	    <?php if( get_field('category-thumb') ): ?>
		     	<figure class="cat-page-thumb">
					<img src="<?php the_field('category-thumb'); ?>" />
				</figure>
				<span class="category-name"><?php the_title() ?></span>
			</a>
		</li>
		<?php endif; ?>

	  <?php endwhile; endif; wp_reset_postdata(); ?>
	</ul>
</section>


<section id="primary" class="primary home">
	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );


		endwhile; // End of the loop.
		?>

	</main>
	<div class="secondary home">
	<?php get_sidebar('home-page'); ?>
		<!-- <div class="button-wrap">
			<a class="button" href="#"><div class="button-inner"><i class="fa fa-fw fa-stethoscope fa-2x" aria-hidden="true"></i><span>Find a Veterinariar <br>or Practice</span></div></a>
			<a class="button" href="#"><div class="button-inner"><i class="fa fa-fw fa-envelope fa-2x" aria-hidden="true"></i><span>Join our <br>Mailing List</span></div></a>
		</div> -->
	</div>
</section><!-- #primary -->

</div><!-- .content-wrap -->


<?php

get_footer();
