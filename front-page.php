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


<section class="categories-row">
	<nav id="secondary-navigation" class="secondary-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Secondary Menu', 'aafp' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
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
		<div class="button-wrap">
			<a class="button" href="#"><div class="button-inner"><i class="fa fa-fw fa-stethoscope fa-2x" aria-hidden="true"></i><span>Find a Veterinariar <br>or Practice</span></div></a>
			<a class="button" href="#"><div class="button-inner"><i class="fa fa-fw fa-envelope fa-2x" aria-hidden="true"></i><span>Join our <br>Mailing List</span></div></a>
		</div>
	</div>
</section><!-- #primary -->

</div><!-- .content-wrap -->


<?php

get_footer();
