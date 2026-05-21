<?php get_header(); ?>

<div class="page-hero inner-hero">
    <div class="container">
        <h1 class="inner-page-title" data-gsap="fade-up"><?php the_title(); ?></h1>
    </div>
</div>

<div class="page-content section">
    <div class="container container--narrow">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content prose' ); ?>>
                <?php the_content(); ?>
                <?php
                wp_link_pages( [
                    'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'leap-theme' ) . '">',
                    'after'  => '</nav>',
                ] );
                ?>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer();
