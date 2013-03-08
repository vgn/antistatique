<?php
/**
* The template for displaying content in the single.php template
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <section>
    <nav class="page-navigation top">
      <span class="previous">
        <?php previous_post_link('%link', '<span class="previous-sign">&laquo;</span> Précédent'); ?>
      </span>
      <span class="next">
        <?php next_post_link('%link', 'Suivant <span class="next-sign">&raquo;</span>'); ?>
      </span>
    </nav>
  </section>

  <section>
    <div class="page-title blog-title">
      <h1>
        <?php the_title(); ?>
      </h1>
      <?php if ( 'post' == get_post_type() ) : ?>
      <div class="entry-meta">
        <hr class="meta-separation">
        <?php antistatique_posted_on(); ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </div>
</section>

<?php if ( has_post_thumbnail() ): ?>
  <div class="cover-image">
    <?php the_post_thumbnail(); ?>
  </div>
<?php endif; ?>

<section>
  <div class="page-content">
    <?php the_content(); ?>
  </div>

  <hr class="post-separation">

</section>


</div><!-- #post-<?php the_ID(); ?> -->
