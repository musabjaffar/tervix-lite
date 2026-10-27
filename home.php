<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( is_paged() ) {
	get_template_part( 'index' );
	return;
}
get_header();
get_template_part( 'template-parts/home', 'news' );
get_footer();
