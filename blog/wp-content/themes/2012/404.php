<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<section>
  <h1><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'as2012' ); ?></h1>
  <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'as2012' ); ?></p>
  <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
</section>

<?php get_footer(); ?>