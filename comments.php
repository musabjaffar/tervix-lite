<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( post_password_required() ) { return; } ?>
<section class="tv-comments" id="comments">
<?php if ( have_comments() ) : ?>
	<h2><?php echo tervix_icon( 'msg', 22 ); // phpcs:ignore ?> <?php printf( esc_html( _n( '%d comment', '%d comments', get_comments_number(), 'tervix-lite' ) ), (int) get_comments_number() ); ?></h2>
	<ol class="tv-clist"><?php wp_list_comments( array( 'style' => 'ol', 'avatar_size' => 44, 'short_ping' => true ) ); ?></ol>
	<?php the_comments_pagination(); ?>
<?php endif; ?>
<?php comment_form( array( 'title_reply' => __( 'Join the conversation', 'tervix-lite' ), 'label_submit' => __( 'Post comment', 'tervix-lite' ), 'class_submit' => 'tv-btn', 'comment_notes_before' => '' ) ); ?>
</section>
