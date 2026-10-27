<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>
<div class="tv-wrap tv-sec tv-cols"><div>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'tv-article' ); ?>>
		<h1 class="tv-title"><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) { echo '<div class="tv-hero-img">'; the_post_thumbnail( 'tervix-hero' ); echo '</div>'; } ?>
		<div class="tv-content"><?php the_content(); wp_link_pages(); ?></div>
	</article>
	<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
<?php endwhile; ?>
</div><?php get_sidebar(); ?></div>
<?php get_footer();
