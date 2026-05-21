<?php
$services = leap_field( 'services_repeater' );

// Fallback services when ACF is empty
if ( ! $services ) {
    $services = [
        [ 'service_icon' => '⚡', 'service_title' => 'Ultra-Fast Inference',      'service_desc' => 'Run models at millisecond latency with our globally distributed edge network. Zero cold starts, always-on performance.',       'service_cta' => 'Learn more', 'service_url' => '#' ],
        [ 'service_icon' => '🔒', 'service_title' => 'Enterprise-Grade Security', 'service_desc' => 'SOC 2 Type II certified infrastructure with end-to-end encryption, private VPC, and audit logging out of the box.',             'service_cta' => 'Learn more', 'service_url' => '#' ],
        [ 'service_icon' => '🧠', 'service_title' => 'Custom Model Training',     'service_desc' => 'Fine-tune foundation models on your proprietary data. Automated pipelines, experiment tracking, and one-click deployment.',      'service_cta' => 'Learn more', 'service_url' => '#' ],
        [ 'service_icon' => '📡', 'service_title' => 'Real-Time Data Pipelines',  'service_desc' => 'Connect any data source with our low-latency streaming connectors. Transform, enrich, and route data at massive scale.',        'service_cta' => 'Learn more', 'service_url' => '#' ],
        [ 'service_icon' => '📊', 'service_title' => 'Observability & Analytics', 'service_desc' => 'Full-stack visibility into your AI systems. Monitor model drift, latency, cost, and quality in a single unified dashboard.',     'service_cta' => 'Learn more', 'service_url' => '#' ],
        [ 'service_icon' => '🤖', 'service_title' => 'Agentic Workflows',         'service_desc' => 'Build multi-step AI agents that reason, plan, and act. Native integrations with your existing tools and APIs.',                  'service_cta' => 'Learn more', 'service_url' => '#' ],
    ];
}
?>

<section class="services-section section" id="services" aria-labelledby="services-heading">
    <div class="container">

        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">What We Build</span>
            <h2 class="section-title" id="services-heading">
                Everything you need to <span class="gradient-text">ship AI products</span>
            </h2>
            <p class="section-subtitle">
                A complete platform — from raw data to production-ready AI — so your team can focus on what actually matters.
            </p>
        </div>

        <div class="services-grid" data-gsap="stagger-cards">
            <?php foreach ( $services as $service ) :
                $icon  = ! empty( $service['service_icon'] )  ? $service['service_icon']  : '✦';
                $title = ! empty( $service['service_title'] ) ? $service['service_title'] : '';
                $desc  = ! empty( $service['service_desc'] )  ? $service['service_desc']  : '';
                $cta   = ! empty( $service['service_cta'] )   ? $service['service_cta']   : 'Learn more';
                $url   = ! empty( $service['service_url'] )   ? $service['service_url']   : '#';
            ?>
            <article class="service-card glass-card">
                <div class="service-icon-wrap" aria-hidden="true">
                    <span class="service-icon"><?php echo wp_kses_post( $icon ); ?></span>
                </div>
                <?php if ( $title ) : ?>
                    <h3 class="service-title"><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>
                <?php if ( $desc ) : ?>
                    <p class="service-desc"><?php echo esc_html( $desc ); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url( $url ); ?>" class="service-link">
                    <?php echo esc_html( $cta ); ?>
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <div class="card-glow-border" aria-hidden="true"></div>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
