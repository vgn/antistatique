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
    <?php if ( has_post_thumbnail() ): ?>
    <div class="cover-image">
        <?php the_post_thumbnail(); ?>
    </div>
    <?php endif; ?>
    <div class="entry-content">
        <div class="article-content">
            <?php the_content(); ?>
        </div>

        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'as2012' ) . '</span>', 'after' => '</div>' ) ); ?>
        <hr class="post-separation">
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
