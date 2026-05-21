<?php get_header(); ?>

<div class="inner-hero post-hero">
    <div class="container container--narrow">
        <?php while ( have_posts() ) : the_post(); ?>

        <div class="post-meta-top" data-gsap="fade-up">
            <a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ?: get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="back-link">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M13 8H3M7 4L3 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Back
            </a>
            <?php if ( get_the_category() ) : ?>
                <span class="post-category"><?php echo esc_html( get_the_category()[0]->name ); ?></span>
            <?php endif; ?>
        </div>

        <h1 class="inner-page-title" data-gsap="fade-up"><?php the_title(); ?></h1>

        <div class="post-byline" data-gsap="fade-up">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            <span class="byline-sep">&bull;</span>
            <span><?php echo esc_html( get_the_author() ); ?></span>
            <span class="byline-sep">&bull;</span>
            <span><?php echo esc_html( ceil( str_word_count( strip_tags( get_the_content() ) ) / 200 ) ); ?> min read</span>
        </div>

        <?php endwhile; ?>
    </div>
</div>

<div class="post-content-wrap section">
    <div class="container container--narrow">
        <?php while ( have_posts() ) : the_post(); ?>

        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="post-featured-image">
                <?php the_post_thumbnail( 'large', [ 'loading' => 'eager' ] ); ?>
            </figure>
        <?php endif; ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content prose' ); ?>>
            <?php the_content(); ?>
        </article>

        <!-- Author box -->
        <div class="author-box glass-card">
            <div class="author-avatar-lg">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', get_the_author(), [ 'class' => 'author-img' ] ); ?>
            </div>
            <div class="author-box-info">
                <strong class="author-box-name"><?php echo esc_html( get_the_author() ); ?></strong>
                <p class="author-box-bio"><?php echo esc_html( get_the_author_meta( 'description' ) ?: 'Contributing author at ' . get_bloginfo( 'name' ) ); ?></p>
            </div>
        </div>

        <!-- Post navigation -->
        <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Post Navigation', 'leap-theme' ); ?>">
            <?php
            the_post_navigation( [
                'prev_text' => '<span class="nav-dir">' . __( 'Previous', 'leap-theme' ) . '</span><span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-dir">' . __( 'Next', 'leap-theme' ) . '</span><span class="nav-title">%title</span>',
            ] );
            ?>
        </nav>

        <?php endwhile; ?>
    </div>
</div>

<?php get_footer();
