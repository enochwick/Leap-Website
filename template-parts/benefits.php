<?php
$benefits = leap_field( 'benefits_repeater' );
$stats    = leap_field( 'stats_repeater' );

if ( ! $benefits ) {
    $benefits = [
        [ 'benefit_icon' => '🚀', 'benefit_title' => 'Ship 10x Faster',       'benefit_desc' => 'Pre-built infrastructure means your team spends time on product, not plumbing.' ],
        [ 'benefit_icon' => '🔧', 'benefit_title' => 'No Lock-In',            'benefit_desc' => 'Open standards throughout. Export your models and data anytime, no questions asked.' ],
        [ 'benefit_icon' => '💰', 'benefit_title' => 'Predictable Costs',     'benefit_desc' => 'Transparent pricing with no surprise bills. Usage-based tiers that scale with your growth.' ],
        [ 'benefit_icon' => '🌍', 'benefit_title' => 'Global Edge Network',   'benefit_desc' => '35+ PoPs worldwide. Your models run close to your users for minimum latency.' ],
    ];
}

if ( ! $stats ) {
    $stats = [
        [ 'stat_number' => '500', 'stat_suffix' => '+', 'stat_label' => 'Companies Powered' ],
        [ 'stat_number' => '12',  'stat_suffix' => 'ms', 'stat_label' => 'Avg Inference Latency' ],
        [ 'stat_number' => '99.9','stat_suffix' => '%',  'stat_label' => 'Platform Uptime' ],
        [ 'stat_number' => '3.2', 'stat_suffix' => 'B',  'stat_label' => 'Requests Served' ],
    ];
}
?>

<section class="benefits-section section" id="benefits" aria-labelledby="benefits-heading">
    <div class="container">

        <div class="benefits-layout">

            <!-- Left: text + benefits list -->
            <div class="benefits-left" data-gsap="fade-right">
                <span class="section-tag">Why Choose Us</span>
                <h2 class="section-title" id="benefits-heading">
                    Built for teams that <span class="gradient-text">can't afford to fail</span>
                </h2>
                <p class="section-subtitle">
                    We obsess over reliability, speed, and developer experience so you can focus on building the future.
                </p>

                <ul class="benefits-list" role="list">
                    <?php foreach ( $benefits as $benefit ) :
                        $icon  = ! empty( $benefit['benefit_icon'] )  ? $benefit['benefit_icon']  : '✦';
                        $title = ! empty( $benefit['benefit_title'] ) ? $benefit['benefit_title'] : '';
                        $desc  = ! empty( $benefit['benefit_desc'] )  ? $benefit['benefit_desc']  : '';
                    ?>
                    <li class="benefit-item">
                        <div class="benefit-icon-wrap" aria-hidden="true">
                            <span class="benefit-icon"><?php echo wp_kses_post( $icon ); ?></span>
                        </div>
                        <div class="benefit-text">
                            <?php if ( $title ) : ?>
                                <strong class="benefit-title"><?php echo esc_html( $title ); ?></strong>
                            <?php endif; ?>
                            <?php if ( $desc ) : ?>
                                <p class="benefit-desc"><?php echo esc_html( $desc ); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Right: stats grid -->
            <div class="benefits-right" data-gsap="fade-left">
                <div class="stats-grid">
                    <?php foreach ( $stats as $stat ) :
                        $number = ! empty( $stat['stat_number'] ) ? $stat['stat_number'] : '0';
                        $suffix = ! empty( $stat['stat_suffix'] ) ? $stat['stat_suffix'] : '';
                        $label  = ! empty( $stat['stat_label'] )  ? $stat['stat_label']  : '';
                    ?>
                    <div class="stat-card glass-card" data-gsap="counter" data-target="<?php echo esc_attr( $number ); ?>">
                        <div class="stat-number">
                            <span class="stat-count" data-target="<?php echo esc_attr( $number ); ?>">0</span><?php echo esc_html( $suffix ); ?>
                        </div>
                        <?php if ( $label ) : ?>
                            <p class="stat-label"><?php echo esc_html( $label ); ?></p>
                        <?php endif; ?>
                        <div class="stat-card-glow" aria-hidden="true"></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Decorative visual element -->
                <div class="benefits-visual" aria-hidden="true">
                    <div class="visual-ring visual-ring--1"></div>
                    <div class="visual-ring visual-ring--2"></div>
                    <div class="visual-core">
                        <svg width="40" height="40" viewBox="0 0 32 32" fill="none">
                            <path d="M4 28L16 4L28 28H20L16 18L12 28H4Z" fill="url(#benefitsGrad)"/>
                            <defs>
                                <linearGradient id="benefitsGrad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#0066FF"/><stop offset="100%" stop-color="#00BFFF"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
