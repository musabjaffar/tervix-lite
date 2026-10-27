<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="tv-banner pat-1" style="--h:200"><div class="tv-wrap"><h1><?php printf( esc_html__( 'Results for “%s”', 'tervix-lite' ), esc_html( get_search_query() ) ); ?></h1></div></section>
<div class="tv-wrap tv-sec tv-cols"><div>
<?php if ( have_posts() ) : ?>
	<div class="tv-grid tv-grid--2"><?php while ( have_posts() ) { the_post(); tervix_card( 'default' ); } ?></div>
	<?php the_posts_pagination( array( 'prev_text' => tervix_icon( 'left', 16 ), 'next_text' => tervix_icon( 'right', 16 ) ) ); // phpcs:ignore ?>
<?php else : ?><p><?php esc_html_e( 'No stories found. Try a different word.', 'tervix-lite' ); ?></p><?php get_search_form(); endif; ?>
</div><?php get_sidebar(); ?></div>
<?php get_footer();
