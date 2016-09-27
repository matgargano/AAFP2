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

		<div class="widget-row">
			<div id="footer-sidebar" class="content-wrap widget-wrap clearfix">
				<div id="footer-sidebar1">
				<?php
				if(is_active_sidebar('footer-sidebar-1')){
				dynamic_sidebar('footer-sidebar-1');
				}
				?>
				</div>
				<div id="footer-sidebar2">
				<?php
				if(is_active_sidebar('footer-sidebar-2')){
				dynamic_sidebar('footer-sidebar-2');
				}
				?>
				</div>
				<div id="footer-sidebar3">
				<?php
				if(is_active_sidebar('footer-sidebar-3')){
				dynamic_sidebar('footer-sidebar-3');
				}
				?>
				</div>
			</div>
		</div>

			<div class="container aafp-foot">
				<img id="aafp-logo" src="http://aafp.randjsc.com/wp-content/uploads/2016/08/aafp-logo.png">
				<p>Created by the American Association of Feline Practitioners<br>© Copyright 2016 AAFP</p>
			</div>

		
		
	
	</footer><!-- #colophon -->
</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
