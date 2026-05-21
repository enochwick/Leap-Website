<?php
/**
 * Pricing Page Template
 * Slug must be: pricing
 * All content editable via ACF → Pages → Pricing → Edit
 */

$headline   = leap_field( 'pricing_headline',   'Simple, transparent <span class="gradient-text">pricing</span>' );
$subheading = leap_field( 'pricing_subheading', 'Start free. Scale as you grow. No hidden fees, no surprise bills — just predictable pricing that makes sense.' );

$tiers = leap_field( 'pricing_tiers', [
    [
        'tier_name'          => 'Starter',
        'tier_desc'          => 'Perfect for side projects, prototypes, and early-stage teams.',
        'tier_featured'      => false,
        'tier_custom_price'  => false,
        'tier_price_monthly' => 0,
        'tier_price_annual'  => 0,
        'tier_btn_text'      => 'Get started free',
        'tier_btn_url'       => '',
        'tier_features'      => "Up to 100K requests/month\n3 deployed models\nCommunity support\nBasic observability dashboard\nShared infrastructure\n✗Fine-tuning\n✗SLA guarantee\n✗Private VPC",
    ],
    [
        'tier_name'          => 'Pro',
        'tier_desc'          => 'For growing teams that need performance, reliability, and support.',
        'tier_featured'      => true,
        'tier_custom_price'  => false,
        'tier_price_monthly' => 299,
        'tier_price_annual'  => 239,
        'tier_btn_text'      => 'Start free trial',
        'tier_btn_url'       => '',
        'tier_features'      => "Up to 10M requests/month\nUnlimited deployed models\nPriority email & chat support\nAdvanced observability\nFine-tuning pipelines\n99.9% uptime SLA\nTeam seats (up to 15)\n✗Private VPC",
    ],
    [
        'tier_name'          => 'Enterprise',
        'tier_desc'          => 'Custom contracts, dedicated infrastructure, and white-glove onboarding.',
        'tier_featured'      => false,
        'tier_custom_price'  => true,
        'tier_price_monthly' => 0,
        'tier_price_annual'  => 0,
        'tier_btn_text'      => 'Contact Sales',
        'tier_btn_url'       => '',
        'tier_features'      => "Unlimited requests\nUnlimited models & seats\n24/7 dedicated support\nPrivate VPC deployment\nSSO / SAML / SCIM\nCustom SLA (up to 99.99%)\nHIPAA & GDPR compliance\nDedicated success manager",
    ],
] );

$faqs = leap_field( 'pricing_faq', [
    [ 'faq_question' => 'Can I switch plans at any time?',                    'faq_answer' => 'Yes — you can upgrade or downgrade at any time. Upgrades take effect immediately. Downgrades take effect at the end of your current billing period.' ],
    [ 'faq_question' => 'Is there a free trial for paid plans?',              'faq_answer' => 'All paid plans come with a 30-day free trial, no credit card required. You will only be charged after the trial ends and you choose to continue.' ],
    [ 'faq_question' => 'What happens if I exceed my request limit?',         'faq_answer' => 'We never hard-stop your traffic. Overages are billed at a flat per-request rate and you will receive a notification before being charged.' ],
    [ 'faq_question' => 'Do you offer discounts for startups or nonprofits?', 'faq_answer' => 'Yes. We have a startup program for seed-stage companies and a nonprofit discount. Reach out to our team with proof of status.' ],
    [ 'faq_question' => 'What payment methods do you accept?',                'faq_answer' => 'We accept all major credit cards, ACH bank transfers, and wire transfers for annual Enterprise contracts.' ],
    [ 'faq_question' => 'Can I self-host Leap?',                             'faq_answer' => 'Enterprise plans include private VPC and on-prem deployment options. Contact our sales team to discuss your specific requirements.' ],
] );

get_header();
?>

<!-- ── Hero ──────────────────────────────────────────────────── -->
<section class="inner-hero pricing-hero" aria-labelledby="pricing-heading">
    <div class="about-hero-bg" aria-hidden="true">
        <div class="hero-glow hero-glow--primary"></div>
        <div class="hero-grid-lines"></div>
    </div>
    <div class="container about-hero-inner">
        <div class="about-hero-content" data-gsap="fade-up">
            <span class="section-tag">Pricing</span>
            <h1 class="inner-page-title" id="pricing-heading">
                <?php echo wp_kses_post( $headline ); ?>
            </h1>
            <p class="hero-subheading"><?php echo esc_html( $subheading ); ?></p>
            <div class="billing-toggle" role="group" aria-label="Billing period">
                <span class="billing-option" id="label-monthly">Monthly</span>
                <button class="toggle-switch" id="billing-toggle" aria-checked="false" role="switch" aria-labelledby="label-monthly label-annual">
                    <span class="toggle-thumb"></span>
                </button>
                <span class="billing-option" id="label-annual">Annual <span class="billing-badge">Save 20%</span></span>
            </div>
        </div>
    </div>
</section>

<!-- ── Pricing Tiers ─────────────────────────────────────────── -->
<section class="pricing-tiers section" aria-labelledby="tiers-heading">
    <div class="container">
        <h2 class="screen-reader-text" id="tiers-heading">Pricing Plans</h2>
        <div class="tiers-grid" data-gsap="stagger-cards">
            <?php foreach ( $tiers as $tier ) :
                $name         = ! empty( $tier['tier_name'] )          ? $tier['tier_name']          : 'Plan';
                $desc         = ! empty( $tier['tier_desc'] )          ? $tier['tier_desc']          : '';
                $is_featured  = ! empty( $tier['tier_featured'] );
                $is_custom    = ! empty( $tier['tier_custom_price'] );
                $monthly      = isset( $tier['tier_price_monthly'] )   ? (int) $tier['tier_price_monthly'] : 0;
                $annual       = isset( $tier['tier_price_annual'] )    ? (int) $tier['tier_price_annual']  : 0;
                $btn_text     = ! empty( $tier['tier_btn_text'] )      ? $tier['tier_btn_text']      : 'Get started';
                $btn_url      = ! empty( $tier['tier_btn_url'] )       ? $tier['tier_btn_url']       : home_url( '/contact' );
                $raw_features = ! empty( $tier['tier_features'] )      ? $tier['tier_features']      : '';
                $features     = leap_parse_features( $raw_features );
                $btn_class    = $is_featured ? 'btn btn-primary tier-btn' : 'btn btn-ghost tier-btn';
            ?>
            <div class="tier-card glass-card <?php echo $is_featured ? 'tier-card--featured' : ''; ?>">
                <?php if ( $is_featured ) : ?>
                    <div class="tier-popular-badge">Most Popular</div>
                <?php endif; ?>

                <div class="tier-header">
                    <span class="tier-name"><?php echo esc_html( $name ); ?></span>
                    <?php if ( $desc ) : ?><p class="tier-desc"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
                </div>

                <div class="tier-price">
                    <?php if ( $is_custom ) : ?>
                        <span class="price-amount price-custom">Custom</span>
                        <span class="price-period">talk to us</span>
                    <?php else : ?>
                        <span class="price-amount" data-monthly="<?php echo esc_attr( $monthly ); ?>" data-annual="<?php echo esc_attr( $annual ); ?>">
                            <?php echo $monthly === 0 ? '$0' : '$' . $monthly; ?>
                        </span>
                        <span class="price-period">/month</span>
                    <?php endif; ?>
                </div>

                <a href="<?php echo esc_url( $btn_url ); ?>" class="<?php echo esc_attr( $btn_class ); ?>">
                    <?php echo esc_html( $btn_text ); ?>
                </a>

                <?php if ( $features ) : ?>
                <ul class="tier-features" role="list">
                    <?php foreach ( $features as $feat ) :
                        $excluded = ( strpos( $feat, '✗' ) === 0 );
                        $feat_text = $excluded ? ltrim( str_replace( '✗', '', $feat ) ) : $feat;
                    ?>
                    <li class="tier-feature <?php echo $excluded ? 'tier-feature--excluded' : 'tier-feature--included'; ?>">
                        <?php if ( $excluded ) : ?>
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 4l8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        <?php else : ?>
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8l3.5 3.5L13 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                        <?php echo esc_html( $feat_text ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Feature Comparison Table ──────────────────────────────── -->
<section class="comparison-section section" aria-labelledby="comparison-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <h2 class="section-title" id="comparison-heading">Full <span class="gradient-text">feature comparison</span></h2>
        </div>
        <div class="comparison-table-wrap glass-card" data-gsap="fade-up">
            <table class="comparison-table" role="table">
                <thead>
                    <tr>
                        <th scope="col" class="comp-feature-col">Feature</th>
                        <?php foreach ( $tiers as $tier ) : ?>
                        <th scope="col" <?php echo ! empty( $tier['tier_featured'] ) ? 'class="comp-featured"' : ''; ?>>
                            <?php echo esc_html( $tier['tier_name'] ?? '' ); ?>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $comp_rows = [
                        [ 'Requests / month',  'Up to 100K',  'Up to 10M',   'Unlimited' ],
                        [ 'Deployed models',   '3',           'Unlimited',   'Unlimited' ],
                        [ 'Fine-tuning',       false,         true,          true ],
                        [ 'Observability',     'Basic',       'Advanced',    'Advanced' ],
                        [ 'Data pipelines',    false,         true,          true ],
                        [ 'Agentic workflows', false,         true,          true ],
                        [ 'Team seats',        '1',           'Up to 15',    'Unlimited' ],
                        [ 'Uptime SLA',        false,         '99.9%',       'Up to 99.99%' ],
                        [ 'Support',           'Community',   'Priority',    '24/7 Dedicated' ],
                        [ 'Private VPC',       false,         false,         true ],
                        [ 'SSO / SAML',        false,         false,         true ],
                        [ 'HIPAA / GDPR',      false,         false,         true ],
                    ];
                    foreach ( $comp_rows as $row ) :
                        $label = array_shift( $row );
                    ?>
                    <tr>
                        <td class="comp-label"><?php echo esc_html( $label ); ?></td>
                        <?php foreach ( $row as $idx => $cell ) :
                            $featured = isset( $tiers[ $idx ] ) && ! empty( $tiers[ $idx ]['tier_featured'] );
                        ?>
                        <td <?php echo $featured ? 'class="comp-featured"' : ''; ?>>
                            <?php echo leap_comp_cell( $cell ); ?>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ── FAQ ───────────────────────────────────────────────────── -->
<?php if ( $faqs ) : ?>
<section class="faq-section section" aria-labelledby="faq-heading">
    <div class="container container--narrow">
        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">FAQ</span>
            <h2 class="section-title" id="faq-heading">Common <span class="gradient-text">questions</span></h2>
        </div>
        <div class="faq-list" data-gsap="fade-up">
            <?php foreach ( $faqs as $i => $faq ) :
                $q = ! empty( $faq['faq_question'] ) ? $faq['faq_question'] : '';
                $a = ! empty( $faq['faq_answer'] )   ? $faq['faq_answer']   : '';
                if ( ! $q ) continue;
            ?>
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr( $i ); ?>">
                    <span><?php echo esc_html( $q ); ?></span>
                    <svg class="faq-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="faq-answer" id="faq-answer-<?php echo esc_attr( $i ); ?>" role="region" hidden>
                    <?php if ( $a ) : ?><p><?php echo esc_html( $a ); ?></p><?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/cta' ); ?>
<?php get_footer();
