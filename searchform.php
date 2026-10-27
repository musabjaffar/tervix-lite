<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<form role="search" method="get" class="tv-sform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s-<?php echo esc_attr( wp_unique_id() ); ?>"><?php esc_html_e( 'Search for:', 'tervix-lite' ); ?></label>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search stories, videos, topics', 'tervix-lite' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	<button type="submit" class="tv-btn"><?php echo tervix_icon( 'search', 18 ); // phpcs:ignore ?><span class="screen-reader-text"><?php esc_html_e( 'Search', 'tervix-lite' ); ?></span></button>
</form>
