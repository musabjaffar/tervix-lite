<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) : the_post();
	$c     = tervix_primary_cat();
	$h     = $c ? tervix_cat_hue( $c->term_id ) : 215;
	$video = has_post_format( 'video' ) ? tervix_first_embed() : '';
	?>
<div class="tv-wrap tv-sec tv-cols tv-single" style="--h:<?php echo (int) $h; ?>">
<div>
	<article <?php post_class( 'tv-article' ); ?>>
		<nav class="tv-crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'tervix-lite' ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tervix-lite' ); ?></a><?php if ( $c ) { echo ' / <a href="' . esc_url( get_category_link( $c ) ) . '">' . esc_html( $c->name ) . '</a>'; } ?></nav>
		<?php tervix_badge(); ?>
		<h1 class="tv-title"><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) { echo '<p class="tv-standfirst">' . esc_html( get_the_excerpt() ) . '</p>'; } ?>
		<div class="tv-byline">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 44 ); ?>
			<div><b><?php the_author_posts_link(); ?></b>
			<div class="tv-meta"><span><?php echo esc_html( get_the_date() ); ?></span><span><?php echo esc_html( tervix_read_time() ); ?></span><a href="#comments"><?php echo tervix_icon( 'msg', 14 ); // phpcs:ignore ?> <?php echo (int) get_comments_number(); ?></a></div></div>
		</div>
		<?php tervix_share(); ?>
		<?php if ( $video ) { echo '<div class="tv-video">' . $video . '</div>'; } elseif ( has_post_thumbnail() ) { echo '<figure class="tv-hero-img">'; the_post_thumbnail( 'tervix-hero' ); if ( get_the_post_thumbnail_caption() ) { echo '<figcaption>' . esc_html( get_the_post_thumbnail_caption() ) . '</figcaption>'; } echo '</figure>'; } // phpcs:ignore ?>
		<div class="tv-content"><?php the_content(); wp_link_pages(); ?></div>
		<?php the_tags( '<div class="tv-tags">', '', '</div>' ); ?>
		<h3 class="tv-share-title"><?php esc_html_e( 'Share this story', 'tervix-lite' ); ?></h3>
		<?php tervix_share(); ?>
		<div class="tv-author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 72 ); ?>
			<div><b><?php the_author(); ?></b><p><?php echo esc_html( get_the_author_meta( 'description' ) ? get_the_author_meta( 'description' ) : __( 'Writer at this site.', 'tervix-lite' ) ); ?></p></div>
		</div>
		<?php the_post_navigation( array( 'prev_text' => '<span>' . esc_html__( 'Previous', 'tervix-lite' ) . '</span>%title', 'next_text' => '<span>' . esc_html__( 'Next', 'tervix-lite' ) . '</span>%title' ) ); ?>
	</article>
	<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
</div>
<?php get_sidebar(); ?>
</div>
<?php
	if ( $c ) :
		$rq = tervix_query( array( 'posts_per_page' => 3, 'cat' => $c->term_id, 'post__not_in' => array( get_the_ID() ) ) );
		if ( $rq->have_posts() ) : ?>
<div class="tv-wrap tv-sec"><?php tervix_section_head( sprintf( __( 'More from %s', 'tervix-lite' ), $c->name ), get_category_link( $c ) ); ?><div class="tv-grid tv-grid--3"><?php tervix_loop( $rq, 'default' ); ?></div></div>
<?php endif; endif;
endwhile;
get_footer();
