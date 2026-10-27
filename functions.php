<?php
/**
 * Tervix Lite – theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'TERVIX_VER', '1.0.0' );

function tervix_setup() {
	load_theme_textdomain( 'tervix-lite', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 60, 'width' => 220, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-background', array( 'default-color' => 'f4f5f7' ) );
	add_editor_style( 'editor-style.css' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'starter-content', tervix_starter_content() );
	add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio' ) );
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'tervix-lite' ),
		'top'     => __( 'Top bar menu', 'tervix-lite' ),
		'footer'  => __( 'Footer menu', 'tervix-lite' ),
	) );
	add_image_size( 'tervix-hero', 1280, 720, true );
	add_image_size( 'tervix-card', 640, 360, true );
	add_image_size( 'tervix-thumb', 160, 160, true );
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'tervix_setup' );

function tervix_widgets() {
	$base = array( 'before_widget' => '<section id="%1$s" class="tv-widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h3 class="tv-widget-title">', 'after_title' => '</h3>' );
	register_sidebar( array_merge( $base, array( 'name' => __( 'Sidebar', 'tervix-lite' ), 'id' => 'sidebar-1' ) ) );
	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array_merge( $base, array( 'name' => sprintf( __( 'Footer column %d', 'tervix-lite' ), $i ), 'id' => 'footer-' . $i ) ) );
	}
}
add_action( 'widgets_init', 'tervix_widgets' );



/* ---------- Assets ---------- */
function tervix_assets() {
	wp_enqueue_style( 'tervix-style', get_stylesheet_uri(), array(), TERVIX_VER );
	wp_enqueue_style( 'tervix-demos', get_template_directory_uri() . '/assets/css/demos.css', array( 'tervix-style' ), TERVIX_VER );
	$accent = sanitize_hex_color( get_theme_mod( 'tervix_accent', '' ) );
	if ( $accent ) {
		wp_add_inline_style( 'tervix-demos', 'html body[class*="tv-demo-"]{--accent:' . $accent . ';}' );
	}
	wp_enqueue_script( 'tervix-main', get_template_directory_uri() . '/assets/js/main.js', array(), TERVIX_VER, true );
	wp_localize_script( 'tervix-main', 'TervixData', array( 'copy' => __( 'Link copied', 'tervix-lite' ) ) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tervix_assets' );

function tervix_head_scheme() {
	$s = get_theme_mod( 'tervix_scheme', 'auto' );
	echo '<script>try{var t=localStorage.getItem("tv-theme");var d="' . esc_js( $s ) . '";if(!t&&d!=="auto")t=d;if(t)document.documentElement.setAttribute("data-theme",t);}catch(e){}</script>' . "\n";
}
add_action( 'wp_head', 'tervix_head_scheme', 1 );

function tervix_body_class( $c ) {
	$c[] = 'tv-demo-news';
	return $c;
}
add_filter( 'body_class', 'tervix_body_class' );

add_filter( 'excerpt_length', function () { return 24; } );
add_filter( 'excerpt_more', function () { return '…'; } );


/* ---------- Template tags ---------- */
function tervix_icon( $n, $s = 20 ) {
	static $p = array(
		'search' => 'M11 4a7 7 0 100 14 7 7 0 000-14zM20 20l-4-4', 'menu' => 'M4 6h16M4 12h16M4 18h16', 'close' => 'M5 5l14 14M19 5L5 19',
		'sun' => 'M12 8a4 4 0 100 8 4 4 0 000-8zM12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4',
		'moon' => 'M20 14A8 8 0 1110 4a7 7 0 0010 10z', 'share' => 'M18 8a3 3 0 100-6 3 3 0 000 6zM6 15a3 3 0 100-6 3 3 0 000 6zM18 22a3 3 0 100-6 3 3 0 000 6zM8.6 13.5l6.8 4M15.4 6.5l-6.8 4',
		'link' => 'M10 14a4 4 0 005.7 0l3-3a4 4 0 00-5.7-5.7l-1 1M14 10a4 4 0 00-5.7 0l-3 3a4 4 0 005.7 5.7l1-1', 'play' => 'M7 4l13 8-13 8z',
		'clock' => 'M12 3a9 9 0 100 18 9 9 0 000-18zM12 7v5l3 2', 'eye' => 'M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12zM12 9a3 3 0 100 6 3 3 0 000-6z',
		'msg' => 'M4 5h16v11H9l-5 4z', 'fb' => 'M14 8h3V4h-3a4 4 0 00-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z', 'x' => 'M5 5l14 14M19 5L5 19',
		'yt' => 'M3 7a3 3 0 013-3h12a3 3 0 013 3v10a3 3 0 01-3 3H6a3 3 0 01-3-3zM10 9l5 3-5 3z', 'ig' => 'M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4zM12 8a4 4 0 100 8 4 4 0 000-8zM17.5 6.5h.01',
		'tt' => 'M14 3v10a4 4 0 11-4-4M14 3c0 3 2 5 5 5', 'wa' => 'M3 21l1.6-4.6A9 9 0 1112 21a9 9 0 01-4.4-1.2zM9 8c0 4 3 7 7 7M9 8l1.5 2M16 15l-2-1.5',
		'tg' => 'M21 4L3 11l6 2 2 6 3-4 5 4z', 'left' => 'M15 6l-6 6 6 6', 'right' => 'M9 6l6 6-6 6', 'up' => 'M12 19V5M5 12l7-7 7 7',
		'radio' => 'M12 11a1 1 0 100 2 1 1 0 000-2zM8 8a5.7 5.7 0 000 8M16 8a5.7 5.7 0 010 8M5 5a10 10 0 000 14M19 5a10 10 0 010 14', 'user' => 'M12 12a4 4 0 100-8 4 4 0 000 8zM4 21a8 8 0 0116 0',
	);
	if ( empty( $p[ $n ] ) ) { return ''; }
	$s = (int) $s;
	return '<svg class="tv-i tv-i-' . esc_attr( $n ) . '" viewBox="0 0 24 24" width="' . $s . '" height="' . $s . '" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' . esc_attr( $p[ $n ] ) . '"/></svg>';
}

function tervix_cat_hue( $id ) { return ( (int) $id * 53 + 200 ) % 360; }

function tervix_primary_cat( $post_id = 0 ) {
	$cats = get_the_category( $post_id ?: get_the_ID() );
	return $cats ? $cats[0] : null;
}

function tervix_badge() {
	$c = tervix_primary_cat();
	if ( $c && 'uncategorized' !== $c->slug ) {
		printf( '<a class="tv-badge" style="--h:%d" href="%s">%s</a>', (int) tervix_cat_hue( $c->term_id ), esc_url( get_category_link( $c ) ), esc_html( $c->name ) );
	}
}

function tervix_read_time() {
	$m = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) );
	/* translators: %d minutes */
	return sprintf( _n( '%d min read', '%d min read', $m, 'tervix-lite' ), $m );
}

function tervix_thumb( $size = 'tervix-card' ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size, array( 'loading' => 'lazy' ) );
		return;
	}
	$c = tervix_primary_cat();
	printf( '<span class="tv-ph" style="--h:%d">%s</span>', $c ? (int) tervix_cat_hue( $c->term_id ) : 210, tervix_icon( 'play', 36 ) ); // phpcs:ignore WordPress.Security.EscapeOutput
}

function tervix_query( $a = array() ) {
	return new WP_Query( wp_parse_args( $a, array( 'ignore_sticky_posts' => true, 'no_found_rows' => true, 'post_status' => 'publish' ) ) );
}

function tervix_card( $v = 'default', $rank = 0 ) {
	$fmt = has_post_format( 'video' );
	$dur = get_post_meta( get_the_ID(), 'tervix_duration', true );
	echo '<article class="tv-card tv-card--' . esc_attr( $v ) . '">';
	if ( 'rank' === $v ) {
		echo '<span class="tv-rank">' . (int) $rank . '</span><div><h3 class="tv-card-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3><div class="tv-meta">' . esc_html( get_the_date() ) . '</div></div></article>';
		return;
	}
	echo '<a class="tv-fig" href="' . esc_url( get_permalink() ) . '" tabindex="-1" aria-hidden="true">';
	tervix_thumb( 'list' === $v || 'mini' === $v ? 'tervix-thumb' : 'tervix-card' );
	if ( $fmt || 'video' === $v ) {
		echo '<span class="tv-play">' . tervix_icon( 'play', 22 ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
		if ( $dur ) { echo '<span class="tv-dur">' . esc_html( $dur ) . '</span>'; }
	}
	echo '</a><div class="tv-card-body">';
	tervix_badge();
	echo '<h3 class="tv-card-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
	if ( in_array( $v, array( 'default', 'wide' ), true ) ) { echo '<p class="tv-ex">' . esc_html( get_the_excerpt() ) . '</p>'; }
	echo '<div class="tv-meta"><span>' . esc_html( get_the_date() ) . '</span><span>' . esc_html( tervix_read_time() ) . '</span></div></div></article>';
}

function tervix_loop( $q, $v = 'default', $rank = false ) {
	$i = 0;
	while ( $q->have_posts() ) {
		$q->the_post();
		tervix_card( $v, $rank ? ++$i : 0 );
	}
	wp_reset_postdata();
}

function tervix_section_head( $title, $url = '' ) {
	echo '<div class="tv-sec-head"><h2>' . esc_html( $title ) . '</h2>';
	if ( $url ) { echo '<a href="' . esc_url( $url ) . '">' . esc_html__( 'See all', 'tervix-lite' ) . '</a>'; }
	echo '</div>';
}

function tervix_socials() {
	$map = array( 'x' => 'X', 'facebook' => 'Facebook', 'youtube' => 'YouTube', 'instagram' => 'Instagram', 'tiktok' => 'TikTok', 'whatsapp' => 'WhatsApp', 'telegram' => 'Telegram' );
	$ico = array( 'x' => 'x', 'facebook' => 'fb', 'youtube' => 'yt', 'instagram' => 'ig', 'tiktok' => 'tt', 'whatsapp' => 'wa', 'telegram' => 'tg' );
	echo '<div class="tv-social">';
	foreach ( $map as $k => $label ) {
		$u = get_theme_mod( 'tervix_social_' . $k, '' );
		if ( $u ) { echo '<a href="' . esc_url( $u ) . '" target="_blank" rel="noopener" aria-label="' . esc_attr( $label ) . '">' . tervix_icon( $ico[ $k ], 18 ) . '</a>'; } // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</div>';
}

function tervix_share( $id = 0 ) {
	$id = $id ?: get_the_ID();
	$u  = rawurlencode( get_permalink( $id ) );
	$t  = rawurlencode( get_the_title( $id ) );
	$l  = array(
		array( 'x', 'X', 'https://twitter.com/intent/tweet?url=' . $u . '&text=' . $t ),
		array( 'fb', 'Facebook', 'https://www.facebook.com/sharer/sharer.php?u=' . $u ),
		array( 'wa', 'WhatsApp', 'https://wa.me/?text=' . $t . '%20' . $u ),
		array( 'tg', 'Telegram', 'https://t.me/share/url?url=' . $u . '&text=' . $t ),
	);
	echo '<div class="tv-share"><button type="button" class="tv-btn tv-btn--ghost" data-share data-url="' . esc_url( get_permalink( $id ) ) . '" data-title="' . esc_attr( get_the_title( $id ) ) . '">' . tervix_icon( 'share', 16 ) . esc_html__( 'Share', 'tervix-lite' ) . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput
	echo '<button type="button" class="tv-btn tv-btn--ghost" data-copy data-url="' . esc_url( get_permalink( $id ) ) . '">' . tervix_icon( 'link', 16 ) . esc_html__( 'Copy link', 'tervix-lite' ) . '</button>'; // phpcs:ignore WordPress.Security.EscapeOutput
	foreach ( $l as $s ) {
		echo '<a class="tv-btn tv-btn--ghost" target="_blank" rel="noopener" href="' . esc_url( $s[2] ) . '">' . tervix_icon( $s[0], 16 ) . esc_html( $s[1] ) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</div>';
}

function tervix_first_embed( $id = 0 ) {
	$c = apply_filters( 'the_content', get_post_field( 'post_content', $id ? $id : get_the_ID() ) );
	$m = get_media_embedded_in_content( $c, array( 'video', 'iframe' ) );
	return $m ? $m[0] : '';
}

function tervix_menu_fallback() {
	echo '<ul class="tv-menu"><li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'tervix-lite' ) . '</a></li>';
	foreach ( get_categories( array( 'number' => 7, 'orderby' => 'count', 'order' => 'DESC' ) ) as $c ) {
		echo '<li><a href="' . esc_url( get_category_link( $c ) ) . '">' . esc_html( $c->name ) . '</a></li>';
	}
}

require get_template_directory() . '/inc/starter-content.php';
require get_template_directory() . '/inc/customizer.php';
