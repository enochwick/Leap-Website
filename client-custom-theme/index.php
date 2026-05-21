<?php
/**
 * Fallback template — WordPress requires this file.
 * front-page.php handles the homepage; this handles everything else as a last resort.
 */
get_header(); ?>

<section class="page-content container">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'content-post' ); ?>>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No content found.', 'leap-theme' ); ?></p>
    <?php endif; ?>
</section>

<?php get_footer();
