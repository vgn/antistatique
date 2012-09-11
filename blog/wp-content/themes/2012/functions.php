<?php
/**
 * 2012 Antistiatique
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */


/**
 * Tell WordPress to run as2012_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'as2012_setup' );

if ( ! function_exists( 'as2012_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override as2012_setup() in a child theme, add your own as2012_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 *     and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function as2012_setup() {

    /* Make Twenty Eleven available for translation.
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on Twenty Eleven, use a find and replace
     * to change 'as2012' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'as2012', get_template_directory() . '/languages' );

    // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
    add_theme_support( 'post-thumbnails' );


    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be the size of the header image that we just defined
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

    // Add Twenty Eleven's custom image sizes.
    // Used for large feature (header) images.
    add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
    // Used for featured posts if a large-feature doesn't exist.
    add_image_size( 'small-feature', 500, 300 );
}
endif; // as2012_setup

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function as2012_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'as2012_excerpt_length' );

function new_excerpt_more() {
    global $post;
    return '<br><a class="btn" href="'. get_permalink($post->ID) . '">Lire la suite</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Returns a "Continue Reading" link for excerpts
 */
function as2012_continue_reading_link() {
    return new_excerpt_more();
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and as2012_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function as2012_auto_excerpt_more( $more ) {
    return ' &hellip;' . as2012_continue_reading_link();
}
add_filter( 'excerpt_more', 'as2012_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function as2012_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
        $output .= as2012_continue_reading_link();
    }
    return $output;
}
add_filter( 'get_the_excerpt', 'as2012_custom_excerpt_more' );



if ( ! function_exists( 'as2012_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function as2012_content_nav( $nav_id ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <div class="nav-previous"><?php next_posts_link( __( 'Page précédente', 'antistatique' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Prochaine page', 'antistatique' ) ); ?></div>
        </nav><!-- #nav-above -->
    <?php endif;
}
endif; // as2012_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function as2012_url_grabber() {
    if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
        return false;

    return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'as2012_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own as2012_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function antistatique_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'antistatique' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'antistatique' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 68;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 39;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'antistatique' ),
                            sprintf( '<h3 class="fn">%s</h3>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s at %2$s', 'antistatique' ), get_comment_date(), get_comment_time() )
                            )
                        );
                    ?>

                    <?php edit_comment_link( __( 'Edit', 'antistatique' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author .vcard -->

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'antistatique' ); ?></em>
                    <br />
                <?php endif; ?>

            </header>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'antistatique' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for antistatique_comment()

if ( ! function_exists( 'as2012_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own as2012_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function antistatique_posted_on() {
    printf( __( '<h3><span class="sep"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></h3><h3><span class="author vcard">Ecrit par <a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span><h3>', 'as2012' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'as2012' ), get_the_author() ) ),
        get_the_author()
    );
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function as2012_body_classes( $classes ) {

    if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
        $classes[] = 'single-author';

    if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
        $classes[] = 'singular';

    return $classes;
}
add_filter( 'body_class', 'as2012_body_classes' );



