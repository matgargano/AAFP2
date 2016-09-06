<?php
/**
 * The template for displaying all pages.
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

	<section id="primary" class="">

		<?php get_sidebar(); ?>
		
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
		<figure class="featured-image">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		</figure>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();