<?php
/**
* The default template for displaying content
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="with-aside isolated">
    <aside class="pull-right aside-border">

      <?php if ( is_sticky() ) : ?>
      <hgroup>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'as2012' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <h3 class="entry-format"><?php _e( 'Featured', 'as2012' ); ?></h3>
      </hgroup>
      <?php else : ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'as2012' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      <?php endif; ?>

      <?php if ( 'post' == get_post_type() ) : ?>
      <div class="entry-meta">
        <hr class="meta-separation">
        <?php antistatique_posted_on(); ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>
    </aside>
    <article>
      <?php if ( has_post_thumbnail() ): ?>
      <div class="cover-image">
        <?php the_post_thumbnail(); ?>
      </div>
      <?php endif; ?>

      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div>
    </article>
  </div>
</div><!-- #post-<?php the_ID(); ?> -->
