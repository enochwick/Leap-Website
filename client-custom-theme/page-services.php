<?php
/**
 * Services Page Template
 * Slug must be: services
 * All content editable via ACF → Pages → Services → Edit
 */

$headline   = leap_field( 'services_headline',   'Every tool your team needs to <span class="gradient-text">ship AI</span>' );
$subheading = leap_field( 'services_subheading', 'From raw data to deployed model — Leap handles the entire stack so your engineers spend time on product, not infrastructure.' );

$services_detail = leap_field( 'services_detail', [
    [ 'sd_icon' => '⚡', 'sd_tag' => 'Inference',     'sd_title' => 'Ultra-Fast Model Inference',       'sd_desc' => 'Deploy any model to our globally distributed edge network. Sub-15ms cold starts, autoscaling from 0 to millions of requests, and zero infrastructure management.',                                    'sd_features' => "GPU & CPU inference\nAuto-scaling with zero cold starts\n35+ global PoPs\nOpenAI-compatible API\nStreaming support",                                               'sd_cta' => 'Learn about Inference', 'sd_url' => '#' ],
    [ 'sd_icon' => '🧠', 'sd_tag' => 'Training',      'sd_title' => 'Custom Model Training & Fine-Tuning','sd_desc' => 'Fine-tune foundation models on your proprietary data with automated pipelines. Track experiments, compare checkpoints, and deploy your best model in one click.',                                     'sd_features' => "Distributed training across A100/H100s\nExperiment tracking built in\nData versioning & lineage\nLoRA, QLoRA, full fine-tune\nOne-click deployment",               'sd_cta' => 'Learn about Training',  'sd_url' => '#' ],
    [ 'sd_icon' => '📡', 'sd_tag' => 'Data',          'sd_title' => 'Real-Time Data Pipelines',          'sd_desc' => 'Connect any data source in minutes. Transform, enrich, and route data at massive scale with low-latency streaming connectors built for AI workloads.',                                             'sd_features' => "100+ pre-built connectors\nSub-second latency\nSchema validation & drift detection\nExactly-once delivery\nSQL & Python transforms",                              'sd_cta' => 'Learn about Pipelines', 'sd_url' => '#' ],
    [ 'sd_icon' => '🤖', 'sd_tag' => 'Agents',        'sd_title' => 'Agentic Workflow Engine',            'sd_desc' => 'Build multi-step AI agents that reason, plan, and act. Native tool integrations, state management, and human-in-the-loop controls for reliable production agents.',                                'sd_features' => "Multi-agent orchestration\nTool & API integrations\nPersistent memory & state\nHuman-in-the-loop controls\nDetailed execution traces",                             'sd_cta' => 'Learn about Agents',   'sd_url' => '#' ],
    [ 'sd_icon' => '📊', 'sd_tag' => 'Observability', 'sd_title' => 'AI Observability & Monitoring',      'sd_desc' => 'Full-stack visibility into your AI systems. Monitor model drift, latency, quality, and cost from a unified dashboard with intelligent alerting.',                                                    'sd_features' => "Real-time latency & throughput\nModel drift detection\nCost attribution by model/team\nCustom eval pipelines\nPagerDuty & Slack alerts",                           'sd_cta' => 'Learn about Observability','sd_url' => '#' ],
    [ 'sd_icon' => '🔒', 'sd_tag' => 'Security',      'sd_title' => 'Enterprise Security & Compliance',  'sd_desc' => 'SOC 2 Type II certified. Private VPC deployment, end-to-end encryption, role-based access, audit logging, and data residency controls out of the box.',                                            'sd_features' => "SOC 2 Type II & ISO 27001\nPrivate VPC deployment\nSSO / SAML 2.0 / SCIM\nAudit logs & RBAC\nGDPR & HIPAA ready",                                                'sd_cta' => 'Learn about Security',  'sd_url' => '#' ],
] );

$integrations = leap_field( 'services_integrations', [
    [ 'integration_name' => 'OpenAI' ],      [ 'integration_name' => 'Hugging Face' ],
    [ 'integration_name' => 'LangChain' ],   [ 'integration_name' => 'AWS S3' ],
    [ 'integration_name' => 'Snowflake' ],   [ 'integration_name' => 'Databricks' ],
    [ 'integration_name' => 'Kafka' ],       [ 'integration_name' => 'Pinecone' ],
    [ 'integration_name' => 'Supabase' ],    [ 'integration_name' => 'GitHub Actions' ],
    [ 'integration_name' => 'Datadog' ],     [ 'integration_name' => 'Slack' ],
    [ 'integration_name' => 'PagerDuty' ],   [ 'integration_name' => 'Terraform' ],
    [ 'integration_name' => 'Kubernetes' ],
] );

get_header();
?>

<!-- ── Hero ──────────────────────────────────────────────────── -->
<section class="inner-hero services-hero" aria-labelledby="services-page-heading">
    <div class="about-hero-bg" aria-hidden="true">
        <div class="hero-glow hero-glow--primary"></div>
        <div class="hero-grid-lines"></div>
    </div>
    <div class="container about-hero-inner">
        <div class="about-hero-content" data-gsap="fade-up">
            <span class="section-tag">What We Offer</span>
            <h1 class="inner-page-title" id="services-page-heading">
                <?php echo wp_kses_post( $headline ); ?>
            </h1>
            <p class="hero-subheading"><?php echo esc_html( $subheading ); ?></p>
            <div class="hero-actions">
                <a href="<?php echo esc_url( home_url( '/pricing' ) ); ?>" class="btn btn-primary btn-lg">See Pricing</a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost btn-lg">Talk to Sales</a>
            </div>
        </div>
    </div>
</section>

<!-- ── Services Detail ───────────────────────────────────────── -->
<section class="services-page-section section" aria-labelledby="services-grid-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <h2 class="section-title" id="services-grid-heading">Built for <span class="gradient-text">every stage</span> of AI development</h2>
            <p class="section-subtitle">Whether you're running your first experiment or processing billions of requests — the platform grows with you.</p>
        </div>

        <div class="services-detail-list">
            <?php foreach ( $services_detail as $i => $s ) :
                $icon     = ! empty( $s['sd_icon'] )     ? $s['sd_icon']     : '✦';
                $tag      = ! empty( $s['sd_tag'] )      ? $s['sd_tag']      : '';
                $title    = ! empty( $s['sd_title'] )    ? $s['sd_title']    : '';
                $desc     = ! empty( $s['sd_desc'] )     ? $s['sd_desc']     : '';
                $features = ! empty( $s['sd_features'] ) ? leap_parse_features( $s['sd_features'] ) : [];
                $cta      = ! empty( $s['sd_cta'] )      ? $s['sd_cta']      : 'Learn more';
                $url      = ! empty( $s['sd_url'] )      ? $s['sd_url']      : '#';
                $reversed = ( $i % 2 === 1 );
            ?>
            <div class="service-detail-item <?php echo $reversed ? 'service-detail-item--reversed' : ''; ?>"
                 data-gsap="<?php echo $reversed ? 'fade-left' : 'fade-right'; ?>">

                <div class="service-detail-content">
                    <div class="service-detail-header">
                        <?php if ( $tag )  : ?><span class="service-detail-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
                        <?php if ( $icon ) : ?><div class="service-detail-icon" aria-hidden="true"><?php echo wp_kses_post( $icon ); ?></div><?php endif; ?>
                    </div>
                    <?php if ( $title ) : ?><h2 class="service-detail-title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
                    <?php if ( $desc )  : ?><p  class="service-detail-desc"><?php echo esc_html( $desc );   ?></p><?php endif; ?>
                    <?php if ( $features ) : ?>
                    <ul class="service-feature-list" role="list">
                        <?php foreach ( $features as $feat ) : ?>
                        <li class="service-feature-item">
                            <svg class="feature-check" width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                <path d="M3 8l3.5 3.5L13 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php echo esc_html( $feat ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $url ); ?>" class="btn btn-primary"><?php echo esc_html( $cta ); ?></a>
                </div>

                <div class="service-detail-visual glass-card" aria-hidden="true">
                    <div class="service-visual-inner">
                        <div class="visual-tag-row">
                            <?php if ( $tag ) : ?><span class="section-tag" style="margin:0;"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
                            <span class="visual-status-dot"></span>
                        </div>
                        <div class="visual-icon-large"><?php echo wp_kses_post( $icon ); ?></div>
                        <div class="visual-metric-row">
                            <div class="visual-metric">
                                <span class="visual-metric-val">99.9%</span>
                                <span class="visual-metric-label">Uptime</span>
                            </div>
                            <div class="visual-metric">
                                <span class="visual-metric-val">12ms</span>
                                <span class="visual-metric-label">P50 Latency</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Integrations ───────────────────────────────────────────── -->
<?php if ( $integrations ) : ?>
<section class="integrations-section section" aria-labelledby="integrations-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">Integrations</span>
            <h2 class="section-title" id="integrations-heading">Works with your <span class="gradient-text">existing stack</span></h2>
            <p class="section-subtitle">Native integrations with the tools your team already uses — no rewrites, no friction.</p>
        </div>
        <div class="integrations-grid" data-gsap="stagger-cards">
            <?php foreach ( $integrations as $int ) :
                $name = ! empty( $int['integration_name'] ) ? $int['integration_name'] : '';
                if ( $name ) : ?>
                <div class="integration-chip glass-card"><?php echo esc_html( $name ); ?></div>
            <?php endif; endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/testimonials' ); ?>
<?php get_template_part( 'template-parts/cta' ); ?>
<?php get_footer();
