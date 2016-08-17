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

<div class="container">
<div class="row slider-row">
	<div class="col-sm-5 mobile-hidden bg-img">
		
	</div>
	<div class="col-sm-7 slider-col">
		<?php echo do_shortcode('[masterslider id="1"]'); ?>
	</div>
</div>
<div class="row">
	<nav id="secondary-navigation" class="secondary-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Secondary Menu', 'aafp' ); ?></button>
		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
</div>
<div class="row">
<div class="col-md-7">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
	<div class="col-md-5">
		<div class="button-wrap">
			<a class="button" href="#"><i class="fa fa-stethoscope fa-2x" aria-hidden="true"></i>Find a Veterinariar or Practice</a>
			<a class="button" href="#"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i>Join our Mailing List</a>
		</div>
	</div>
	</div>
</div>

<?php

get_footer();
