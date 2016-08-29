<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAFP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<div class="site-wrap">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'aafp' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="content-wrap">

		<?php // Display site icon or first letter as logo ?>	
			<div class="site-logo">

				<?php $site_title = get_bloginfo( 'name' ); ?> <!-- get site title -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <!-- setup link that points to homepage -->
					<div class="screen-reader-text">
						<?php printf( esc_html__('Go to the home page of %1$s', 'ckpersonal'), $site_title ); ?>	
					</div>
					<img src="http://localhost/aafp/wp-content/uploads/2016/08/Logo-main.png">
				</a>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'aafp' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="outter-wrap">
