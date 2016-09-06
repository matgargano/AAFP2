<?php
/**
 * 
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AAFP
 */

get_header(); ?> 

	<section id="primary" class="">

		<?php get_sidebar('category-page'); ?>
		
		<main id="main" class="site-main" role="main">

		<?php
		if ( function_exists('yoast_breadcrumb') ) {
		     yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
		?>

		<?php 

		// get an image field
		$image = get_field('top_image');

		// each image contains a custom field called 'link'
		$link = get_field('link', $image['ID']);

		// render
		?>
		<a href="<?php echo $link; ?>">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		</a>


			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		<div class="topics-section">
			<?php the_title( '<h2 class="category-title">', ' Topics</h2>' ); ?>
			<ul class="topics-list">
				<?php
				global $post;
				$my_query_args = array(
				    'posts_per_page' => 0, // change this to any number or '0' for all
				    'post_type' => 'page',
				    'tax_query' => array(
				        array(
				            'taxonomy' => 'category',
				            'field' => 'slug',
				            'terms' => $post->post_name,
				        )
				    )
				);
				// a new instance of the WP_query class   
				$my_query = new WP_Query( $my_query_args );

				if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>

				    <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

				<?php endwhile; endif; wp_reset_postdata(); ?>
			</ul>
		</div>
		<hr>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();