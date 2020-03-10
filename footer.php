<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
?>

<footer id="site-footer" class="site-footer" role="contentinfo">
<div class="footer-wrapper">
<div class="footer-logo">
		<?php the_custom_logo(); ?>
	</div>
<div id="copyright">

<?php echo sprintf( __( '%1$s %2$s %3$s ｜ <a href="%4$s/en/privacy-policy/">Privacy policy</a>', 'jms' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ), esc_html( get_site_url() ) ); ?>
</div>	
</div>
<div class="footer-lang-menu"><ul><?php pll_the_languages(); ?></ul></div>
</footer>

<?php
}
?>

<?php wp_footer(); ?>
</div>
</body>
</html>
