<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<hr class="title-separation">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	<aside>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<hr class="meta-separation">
			<?php antistatique_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</aside>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		<hr class="post-separation">
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
