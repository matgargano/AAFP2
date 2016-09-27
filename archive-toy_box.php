<?php
/**
 * The template for displaying Toy Box pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AAFP
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header toybox">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );

				?>
			</header><!-- .page-header -->

			<div id="toybox-wrap" class="toybox-wrap">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

			 echo do_shortcode(get_field('shortcode')); 

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</div><!-- .toybox-wrap -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
