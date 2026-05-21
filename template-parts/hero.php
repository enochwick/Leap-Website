<?php
$headline       = leap_field( 'hero_headline',            'The Future of AI Infrastructure' );
$subheading     = leap_field( 'hero_subheading',          'Build, deploy, and scale intelligent systems with a platform designed for teams that move fast and think big.' );
$primary_text   = leap_field( 'hero_primary_button_text', 'Start Building Free' );
$primary_url    = leap_field( 'hero_primary_button_url',  home_url( '/contact' ) );
$secondary_text = leap_field( 'hero_secondary_button_text', '' );
$secondary_url  = leap_field( 'hero_secondary_button_url',  '#process' );
?>

<section class="hero-section" id="hero" aria-label="Hero">
    <!-- Animated background canvas -->
    <div class="hero-bg" aria-hidden="true">
        <canvas class="hero-canvas" id="hero-canvas"></canvas>
        <div class="hero-grid-lines"></div>
        <div class="hero-glow hero-glow--primary"></div>
        <div class="hero-glow hero-glow--secondary"></div>
    </div>

    <div class="container hero-inner">

        <!-- Badge -->
        <div class="hero-badge" data-gsap="fade-up">
            <span class="badge-dot"></span>
            <span>Now in public beta &mdash; free for 30 days</span>
        </div>

        <!-- Headline -->
        <h1 class="hero-headline" id="hero-headline">
            <?php echo wp_kses_post( $headline ); ?>
        </h1>

        <!-- Subheading -->
        <p class="hero-subheading" data-gsap="fade-up">
            <?php echo esc_html( $subheading ); ?>
        </p>

        <!-- CTAs -->
        <div class="hero-actions" data-gsap="fade-up">
            <?php if ( $primary_text ) : ?>
                <a href="<?php echo esc_url( $primary_url ); ?>" class="btn btn-primary btn-lg">
                    <?php echo esc_html( $primary_text ); ?>
                    <svg class="btn-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            <?php endif; ?>
            <?php if ( $secondary_text ) : ?>
                <a href="<?php echo esc_url( $secondary_url ); ?>" class="btn btn-ghost btn-lg">
                    <?php echo esc_html( $secondary_text ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Floating UI cards (decorative) -->
        <div class="hero-cards" aria-hidden="true">
            <div class="floating-card floating-card--1" data-gsap="float-card">
                <div class="card-dot card-dot--green"></div>
                <span class="card-label">Model deployed</span>
                <span class="card-value">99.9% uptime</span>
            </div>
            <div class="floating-card floating-card--2" data-gsap="float-card">
                <div class="card-icon-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="card-label">Inference speed</span>
                <span class="card-value">12ms avg</span>
            </div>
            <div class="floating-card floating-card--3" data-gsap="float-card">
                <div class="card-dot card-dot--blue"></div>
                <span class="card-label">Active requests</span>
                <span class="card-value">1.4M / sec</span>
            </div>
        </div>

    </div>

    <!-- Scroll indicator -->
    <div class="hero-scroll-hint" aria-hidden="true">
        <div class="scroll-line"></div>
    </div>
</section>
