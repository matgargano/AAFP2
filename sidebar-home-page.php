<?php
/**
 * The sidebar containing the homepage widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AAFP
 */

if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<aside id="sidebar-home" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</aside><!-- #secondary -->
<?php endif; ?>