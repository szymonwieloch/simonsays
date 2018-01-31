<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SimonSays
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer wide-box">
		<div class="site-info">
		</div><!-- .site-info -->
		<div id="footer-sidebar" class="secondary">
			<div id="footer-widgets1" class="one-third-box">
				<?php
					if(is_active_sidebar('footer-1')){
						dynamic_sidebar('footer-1');
					}
				?>
			</div>
			<div id="footer-widgets2" class="one-third-box">
				<?php
					if(is_active_sidebar('footer-2')){
						dynamic_sidebar('footer-2');
					}
				?>
			</div>
			<div id="footer-widgets3" class="one-third-box">
				<?php
					if(is_active_sidebar('footer-3')){
						dynamic_sidebar('footer-3');
					}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
