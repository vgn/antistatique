<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content', 'single' ); ?>

	<section>
		<article>
			<?php comments_template( '', true ); ?>
		</article>
	</section>

	<section>
		<nav class="page-navigation bottom">
			<span class="previous">
				<?php previous_post_link('%link','%title'); ?>
			</span>
			<span class="next">
				<?php next_post_link('%link','%title'); ?>
			</span>
		</nav>
	</section>

<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>