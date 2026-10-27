<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'tv-body' ); ?>>
<?php wp_body_open(); ?>
<a class="tv-skip" href="#main"><?php esc_html_e( 'Skip to content', 'tervix-lite' ); ?></a>
<div class="tv-progress" id="tvp"></div>

<div class="tv-topbar"><div class="tv-wrap tv-topbar-in">
	<span class="tv-date"><?php echo esc_html( wp_date( get_option( 'date_format' ) ) ); ?></span>
	<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class' => 'tv-topmenu', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
	<span class="tv-topright">
		<?php tervix_socials(); ?>
		<button type="button" class="tv-iconbtn" id="tvtheme" aria-label="<?php esc_attr_e( 'Switch light or dark theme', 'tervix-lite' ); ?>"><?php echo tervix_icon( 'moon', 18 ); // phpcs:ignore ?></button>
	</span>
</div></div>

<header class="tv-header" id="tvh"><div class="tv-wrap tv-header-in">
	<div class="tv-brand">
		<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
			<a class="tv-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
		<?php } ?>
		<?php if ( get_bloginfo( 'description' ) ) { ?><span class="tv-tagline"><?php bloginfo( 'description' ); ?></span><?php } ?>
	</div>
	<nav class="tv-nav" id="tvnav" aria-label="<?php esc_attr_e( 'Primary', 'tervix-lite' ); ?>">
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'tv-menu', 'fallback_cb' => 'tervix_menu_fallback', 'depth' => 2 ) ); ?>
	</nav>
	<div class="tv-actions">
		<button type="button" class="tv-iconbtn" id="tvsearchbtn" aria-label="<?php esc_attr_e( 'Search', 'tervix-lite' ); ?>" aria-expanded="false"><?php echo tervix_icon( 'search', 22 ); // phpcs:ignore ?></button>
		<button type="button" class="tv-iconbtn tv-burger" id="tvburger" aria-label="<?php esc_attr_e( 'Menu', 'tervix-lite' ); ?>" aria-expanded="false"><?php echo tervix_icon( 'menu', 24 ); // phpcs:ignore ?></button>
	</div>
</div>
<div class="tv-searchbar" id="tvsearch"><div class="tv-wrap"><?php get_search_form(); ?></div></div>
</header>

<?php if ( get_theme_mod( 'tervix_ticker', true ) ) :
	$tq = tervix_query( array( 'posts_per_page' => 6, 'tag' => 'breaking' ) );
	if ( ! $tq->have_posts() ) { $tq = tervix_query( array( 'posts_per_page' => 6 ) ); }
	if ( $tq->have_posts() ) : ?>
<div class="tv-ticker"><div class="tv-wrap tv-ticker-in"><b><?php esc_html_e( 'Breaking', 'tervix-lite' ); ?></b><div class="tv-ticks" id="tvticks">
	<?php while ( $tq->have_posts() ) : $tq->the_post(); ?><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a><?php endwhile; wp_reset_postdata(); ?>
</div></div></div>
<?php endif; endif; ?>

<main id="main" class="tv-main" tabindex="-1">
