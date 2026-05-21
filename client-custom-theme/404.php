<?php get_header(); ?>

<section class="error-404 section text-center" aria-labelledby="error-heading">
    <div class="container">
        <div class="error-content" data-gsap="fade-up">
            <div class="error-code" aria-hidden="true">404</div>
            <h1 class="error-title" id="error-heading">Page not found</h1>
            <p class="error-message">
                The page you're looking for doesn't exist or has been moved. Let's get you back on track.
            </p>
            <div class="error-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">Back to Home</a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost btn-lg">Contact Support</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
