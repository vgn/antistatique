<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>


    <footer>
      <section>
        <p class="vcard"><strong>Antistatique</strong> <a href="/contact" class="locality">Lausanne</a> <span class="tel">+41 21 623 63 03</span> <a href="mailto:hello@antistatique.net" class="email">hello@antistatique.net</a></p>
        <?php get_template_part( 'aside', 'navigation' ) ?>
      </section>
    </footer>
  </div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>