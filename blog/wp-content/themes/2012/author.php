<?php
/**
* The template for displaying Author Archive pages.
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/

get_header(); ?>


  <?php if ( have_posts() ) : ?>

      <?php
          /* Queue the first post, that way we know
           * what author we're dealing with (if that is the case).
           *
           * We reset this later so we can run the loop
           * properly with a call to rewind_posts().
           */
          the_post();
      ?>
      <section>
          <header class="page-header">
              <h1 class="page-title author"><?php printf( __( '%s', 'as2012' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
          </header>

      </section>
      
      <?php
          /* Since we called the_post() above, we need to
           * rewind the loop back to the beginning that way
           * we can run the loop properly, in full.
           */
          rewind_posts();
      ?>


      <?php
      // If a user has filled out their description, show a bio on their entries.
      if ( get_the_author_meta( 'description' ) ) : ?>
      <section>
          <div id="author-info" class="with-aside">
              <aside class="pull-right">
              <div id="author-avatar">
                  <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'as2012_author_bio_avatar_size', 120 ) ); ?>
              </div><!-- #author-avatar -->
              </aside>
              <article>
              <div id="author-description">
                  <h2><?php printf( __( 'A propos de %s', 'as2012' ), get_the_author() ); ?></h2>
                  <?php the_author_meta( 'description' ); ?>
              </div><!-- #author-description    -->
              </article>
          </div><!-- #author-info -->
      </section>
      <?php endif; ?>
      <section>
      <?php /* Start the Loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

          <?php
              /* Include the Post-Format-specific template for the content.
               * If you want to overload this in a child theme then include a file
               * called content-___.php (where ___ is the Post Format name) and that will be used instead.
               */
              get_template_part( 'content', get_post_format() );
          ?>

      <?php endwhile; ?>
      <?php as2012_content_nav( 'nav-below' ); ?>
      </section>

  <?php else : ?>
      <section>
          <h1><?php _e( 'Nothing Found', 'as2012' ); ?></h1>
          <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'as2012' ); ?></p>
      </section>
  <?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>