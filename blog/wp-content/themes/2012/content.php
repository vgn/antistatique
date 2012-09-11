<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <hr class="title-separation">
            <?php if ( is_sticky() ) : ?>
                <hgroup>
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'as2012' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <h3 class="entry-format"><?php _e( 'Featured', 'as2012' ); ?></h3>
                </hgroup>
            <?php else : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'as2012' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <?php endif; ?>
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

        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
