<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAFP
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row gray-bg">
			<div class="col-sm-8">
				
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
				
			</div>
			<div class="col-sm-4">Social<br>Icons<br>Here</div>
		</div>
		<div class="row">
			<div class="col-sm-12 aafp-foot">
				<img id="aafp-logo" src="http://localhost/aafp/wp-content/uploads/2016/08/aafp-logo.png">
				<p>Created by the American Association of Feline Practitioners<br>© Copyright 2016 AAFP</p>
			</div>
			
		</div>
	</footer><!-- #colophon -->
</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
