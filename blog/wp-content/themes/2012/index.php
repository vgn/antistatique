<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
<div class="page-title title-image">
  <section>
    <h1 class="title-separation magenta-sep">
      <span></span>
      Blog
    </h1>
  </section>
</div>

<section>
  <article>
    <h2>Un blog pour partager notre passion</h2>
    <p>
      En plus de notre présence sur <a href="http://twitter.com/antistatique/">twitter</a>, <a href="http://www.facebook.com/Antistatique" title="">facebook</a> ou <a href="github.com/antistatique">github</a> nous publions sur ce blog les activités et sujets qui nous inspires. Nos publications prennent plusieurs formes : articles techniques, liens vers des sites que nous aimons ou événements auxquels nous participons.
    </p>
    <p><?php  the_widget( 'WP_Widget_Archives', array('title' => '', 'count' => 1 , 'dropdown' => 1 ));?></p>
    <p><?php the_widget('WP_Widget_Categories', 'title=&dropdown=1&count=1'); ?> </p>
  </article>


</section>

<section>
  <?php if ( have_posts() ) : ?>

  <?php /* Start the Loop */ ?>
  <?php while ( have_posts() ) : the_post(); ?>

  <?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>

<?php as2012_content_nav( 'nav-below' ); ?>

<?php else : ?>

  <article id="post-0" class="post no-results not-found">
    <header class="entry-header">
      <h1 class="entry-title"><?php _e( 'Nothing Found', 'as2012' ); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'as2012' ); ?></p>
    </div><!-- .entry-content -->
  </article><!-- #post-0 -->

<?php endif; ?>

</section>


<?php get_sidebar(); ?>
<?php get_footer(); ?>