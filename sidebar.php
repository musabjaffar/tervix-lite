<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<aside class="tv-side">
<?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } else { ?>
	<section class="tv-widget"><h3 class="tv-widget-title"><?php esc_html_e( 'Search', 'tervix-lite' ); ?></h3><?php get_search_form(); ?></section>
	<section class="tv-widget"><h3 class="tv-widget-title"><?php esc_html_e( 'Popular', 'tervix-lite' ); ?></h3><div class="tv-ranks">
		<?php tervix_loop( tervix_query( array( 'posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC' ) ), 'rank', true ); // phpcs:ignore ?>
	</div></section>
	<section class="tv-widget"><h3 class="tv-widget-title"><?php esc_html_e( 'Sections', 'tervix-lite' ); ?></h3><ul class="tv-catlist"><?php wp_list_categories( array( 'title_li' => '', 'show_count' => true, 'number' => 8, 'orderby' => 'count', 'order' => 'DESC' ) ); ?></ul></section>
<?php } ?>
</aside>
