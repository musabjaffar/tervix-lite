<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
</main>
<footer class="tv-footer"><div class="tv-wrap">
	<div class="tv-fgrid">
		<div class="tv-fcol tv-fbrand">
			<?php if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); } else { ?>
				<h3 class="tv-widget-title"><?php bloginfo( 'name' ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'tervix_footer_text', '' ) ? get_theme_mod( 'tervix_footer_text' ) : get_bloginfo( 'description' ) ); ?></p>
			<?php } tervix_socials(); ?>
		</div>
		<div class="tv-fcol"><?php if ( is_active_sidebar( 'footer-2' ) ) { dynamic_sidebar( 'footer-2' ); } else { ?>
			<h3 class="tv-widget-title"><?php esc_html_e( 'Sections', 'tervix-lite' ); ?></h3>
			<ul><?php wp_list_categories( array( 'title_li' => '', 'number' => 6, 'orderby' => 'count', 'order' => 'DESC' ) ); ?></ul>
		<?php } ?></div>
		<div class="tv-fcol"><?php if ( is_active_sidebar( 'footer-3' ) ) { dynamic_sidebar( 'footer-3' ); } else { ?>
			<h3 class="tv-widget-title"><?php esc_html_e( 'Company', 'tervix-lite' ); ?></h3>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false, 'depth' => 1 ) ); ?>
		<?php } ?></div>
	</div>
	<div class="tv-copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'tervix-lite' ); ?></div>
</div></footer>
<button type="button" class="tv-top" id="tvtop" aria-label="<?php esc_attr_e( 'Back to top', 'tervix-lite' ); ?>"><?php echo tervix_icon( 'up', 20 ); // phpcs:ignore ?></button>
<?php wp_footer(); ?>
</body>
</html>
