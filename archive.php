<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$o   = get_queried_object();
$tid = ( is_category() || is_tag() ) && $o ? (int) $o->term_id : 0;
$h   = $tid ? tervix_cat_hue( $tid ) : 215;
$pat = 0;
$v   = 'default';
?>
<section class="tv-banner pat-<?php echo (int) $pat; ?>" style="--h:<?php echo (int) $h; ?>"><div class="tv-wrap">
	<h1><?php the_archive_title(); ?></h1><?php the_archive_description( '<p>', '</p>' ); ?>
</div></section>
<div class="tv-wrap tv-sec tv-cols"><div>
<?php if ( have_posts() ) : ?>
	<div class="tv-grid tv-grid--3"><?php while ( have_posts() ) { the_post(); tervix_card( $v ); } ?></div>
	<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => tervix_icon( 'left', 16 ), 'next_text' => tervix_icon( 'right', 16 ) ) ); // phpcs:ignore ?>
<?php else : ?><p><?php esc_html_e( 'Nothing here yet.', 'tervix-lite' ); ?></p><?php endif; ?>
</div><?php get_sidebar(); ?></div>
<?php get_footer();
