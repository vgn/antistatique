<?php
/**
* The template for displaying content in the page.php template
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( has_post_thumbnail() ): ?>
  <div class="cover-image">
    <?php the_post_thumbnail(); ?>
  </div>
<?php endif; ?>

<div class="page-title title-image">
    <section>
        <h1 class="title-separation magenta-sep">
            <span></span>
            <?php the_title(); ?>
        </h1>
    </section>
</div>


<section id="content" class="content">
    <?php the_content(); ?>
</section>


</div><!-- #post-<?php the_ID(); ?> -->
