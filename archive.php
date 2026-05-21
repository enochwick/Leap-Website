<?php get_header(); ?>

<div class="inner-hero">
    <div class="container">
        <div class="archive-header" data-gsap="fade-up">
            <span class="section-tag">
                <?php if ( is_post_type_archive( 'news' ) ) : ?>News<?php else : ?>Blog<?php endif; ?>
            </span>
            <h1 class="inner-page-title">
                <?php
                if ( is_post_type_archive( 'news' ) ) {
                    echo 'Latest News';
                } elseif ( is_category() ) {
                    single_cat_title();
                } elseif ( is_tag() ) {
                    echo 'Tagged: ';
                    single_tag_title();
                } elseif ( is_author() ) {
                    the_author();
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
            <?php if ( ! is_post_type_archive( 'news' ) && get_the_archive_description() ) : ?>
                <p class="archive-description"><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="archive-content section">
    <div class="container">

        <?php if ( have_posts() ) : ?>
            <div class="posts-grid" data-gsap="stagger-cards">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card glass-card' ); ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card-thumb" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
                            </a>
                        <?php endif; ?>

                        <div class="post-card-body">
                            <?php if ( get_the_category() ) : ?>
                                <span class="post-category"><?php echo esc_html( get_the_category()[0]->name ); ?></span>
                            <?php endif; ?>

                            <h2 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <p class="post-card-excerpt"><?php the_excerpt(); ?></p>

                            <div class="post-card-footer">
                                <time class="post-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    Read more
                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php
                the_posts_pagination( [
                    'mid_size'  => 2,
                    'prev_text' => '&larr; Prev',
                    'next_text' => 'Next &rarr;',
                ] );
                ?>
            </div>

        <?php else : ?>
            <div class="no-posts text-center">
                <p><?php esc_html_e( 'No posts found.', 'leap-theme' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Back to Home</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer();
