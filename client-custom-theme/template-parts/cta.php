<?php
$headline  = leap_field( 'final_cta_headline',    'Ready to build the future?' );
$text      = leap_field( 'final_cta_text',        'Join 500+ teams already using Leap to deploy AI at scale. Start free, no credit card required.' );
$btn_text  = leap_field( 'final_cta_button_text', 'Get started for free' );
$btn_url   = leap_field( 'final_cta_button_url',  home_url( '/contact' ) );
?>

<section class="cta-section section" id="cta" aria-labelledby="cta-heading">
    <!-- Animated background -->
    <div class="cta-bg" aria-hidden="true">
        <div class="cta-glow cta-glow--1"></div>
        <div class="cta-glow cta-glow--2"></div>
        <div class="cta-grid"></div>
    </div>

    <div class="container cta-inner" data-gsap="fade-up">
        <div class="cta-content">

            <?php if ( $headline ) : ?>
                <h2 class="cta-headline" id="cta-heading">
                    <?php echo wp_kses_post( $headline ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( $text ) : ?>
                <p class="cta-text"><?php echo esc_html( $text ); ?></p>
            <?php endif; ?>

            <div class="cta-actions">
                <?php if ( $btn_text ) : ?>
                    <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary btn-lg">
                        <?php echo esc_html( $btn_text ); ?>
                        <svg class="btn-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url( '/pricing' ) ); ?>" class="btn btn-outline btn-lg">
                    View Pricing
                </a>
            </div>

            <p class="cta-fine-print">No credit card required &bull; 30-day free trial &bull; Cancel anytime</p>
        </div>
    </div>
</section>
