<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<section class="tv-banner pat-0" style="--h:210"><div class="tv-wrap"><h1><?php echo is_home() && ! is_front_page() ? esc_html( single_post_title( '', false ) ) : esc_html__( 'Latest stories', 'tervix-lite' ); ?></h1></div></section>
<div class="tv-wrap tv-sec tv-cols"><div>
<?php if ( have_posts() ) : ?>
	<div class="tv-grid tv-grid--2"><?php while ( have_posts() ) { the_post(); tervix_card( 'default' ); } ?></div>
	<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => tervix_icon( 'left', 16 ), 'next_text' => tervix_icon( 'right', 16 ) ) ); // phpcs:ignore ?>
<?php else : ?><p><?php esc_html_e( 'Nothing here yet.', 'tervix-lite' ); ?></p><?php endif; ?>
</div><?php get_sidebar(); ?></div>
<?php get_footer();
