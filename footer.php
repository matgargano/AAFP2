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
		<div class="col-sm-8">Footer Menu Here</div>
		<div class="col-sm-4">Social<br>Icons<br>Here</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<p>Created by the American Association of Feline Practitioners<br>© Copyright 2016 AAFP</p>
		</div>
		
	</div>


		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'aafp' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'aafp' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'aafp' ), 'aafp', '<a href="http://randjsc.com" rel="designer">R&J SC - Chris S</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
