<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="tv-wrap tv-sec tv-center"><h1 class="tv-title">404</h1><p><?php esc_html_e( 'That page could not be found. Try a search or head back home.', 'tervix-lite' ); ?></p><?php get_search_form(); ?><p><a class="tv-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'tervix-lite' ); ?></a></p></div>
<?php get_footer();
