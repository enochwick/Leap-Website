<?php
/**
 * About Page Template
 * Slug must be: about
 * All content editable via ACF fields in WP Admin → Pages → About → Edit
 */

// ── Fallback content ─────────────────────────────────────────────────────────
$headline   = leap_field( 'about_headline',   'We\'re building the <span class="gradient-text">infrastructure layer</span> for the AI era' );
$subheading = leap_field( 'about_subheading', 'Founded in 2022, Leap started with one belief — that great AI products shouldn\'t require a team of 50 engineers to deploy. We\'ve been fixing that ever since.' );

$mission = leap_field( 'about_mission', [
    [ 'mission_icon' => '🎯', 'mission_title' => 'Our Mission', 'mission_desc' => 'To make production-grade AI infrastructure accessible to every engineering team — not just the ones with unlimited budgets and headcount.' ],
    [ 'mission_icon' => '🔭', 'mission_title' => 'Our Vision',  'mission_desc' => 'A world where any developer, anywhere, can deploy intelligent systems as easily as spinning up a web server. Fast, reliable, and without the drama.' ],
    [ 'mission_icon' => '⚡', 'mission_title' => 'Our Values',  'mission_desc' => 'Speed without recklessness. Transparency without noise. Reliability as a baseline, not a premium. We hold ourselves to the same standard as our platform.' ],
] );

$stats = leap_field( 'about_stats', [
    [ 'stat_number' => '500', 'stat_suffix' => '+',   'stat_label' => 'Companies using Leap' ],
    [ 'stat_number' => '3',   'stat_suffix' => 'B+',  'stat_label' => 'Requests served monthly' ],
    [ 'stat_number' => '35',  'stat_suffix' => '+',   'stat_label' => 'Edge locations worldwide' ],
    [ 'stat_number' => '99',  'stat_suffix' => '.9%', 'stat_label' => 'Platform uptime SLA' ],
] );

$story = leap_field( 'about_story', [
    [ 'story_year' => '2022', 'story_title' => 'The Beginning',              'story_desc' => 'Three engineers, frustrated by how hard it was to deploy even a simple ML model to production, quit their jobs and started building the platform they wished existed.' ],
    [ 'story_year' => '2023', 'story_title' => 'First 100 Customers',        'story_desc' => 'Reached 100 paying customers in 8 months purely through word of mouth. Raised a $6M seed round led by Benchmark to scale the team and infrastructure.' ],
    [ 'story_year' => '2024', 'story_title' => 'Series A & Global Expansion','story_desc' => 'Closed a $28M Series A. Expanded edge network to 35+ locations. Launched enterprise tier. Crossed 1B monthly requests processed.' ],
    [ 'story_year' => '2025', 'story_title' => 'The AI Infrastructure Standard','story_desc' => 'Became the default AI infrastructure choice for 500+ engineering teams. Launched Agentic Workflows, real-time pipelines, and the Leap Developer Program.' ],
] );

$team = leap_field( 'about_team', [
    [ 'team_name' => 'Alex Morgan',   'team_role' => 'Co-Founder & CEO',      'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
    [ 'team_name' => 'Priya Sharma',  'team_role' => 'Co-Founder & CTO',      'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
    [ 'team_name' => 'James Liu',     'team_role' => 'Co-Founder & CPO',      'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
    [ 'team_name' => 'Sara Williams', 'team_role' => 'VP Engineering',         'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
    [ 'team_name' => 'Omar Hassan',   'team_role' => 'Head of Infrastructure', 'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
    [ 'team_name' => 'Yuki Tanaka',   'team_role' => 'Head of Design',         'team_photo' => '', 'team_linkedin' => '#', 'team_twitter' => '#' ],
] );

$investors = leap_field( 'about_investors', [
    [ 'investor_name' => 'Benchmark',           'investor_desc' => 'Lead Seed Investor' ],
    [ 'investor_name' => 'Andreessen Horowitz', 'investor_desc' => 'Series A Lead' ],
    [ 'investor_name' => 'Y Combinator',        'investor_desc' => 'W22 Batch' ],
    [ 'investor_name' => 'Stripe',              'investor_desc' => 'Strategic Partner' ],
] );

// Avatar colors cycle for when no photo is uploaded
$avatar_colors = [ '#0066FF', '#7C3AED', '#0891B2', '#059669', '#DC2626', '#D97706', '#DB2777', '#EA580C' ];

get_header();
?>

<!-- ── Hero ──────────────────────────────────────────────────── -->
<section class="inner-hero about-hero" aria-labelledby="about-heading">
    <div class="about-hero-bg" aria-hidden="true">
        <div class="hero-glow hero-glow--primary"></div>
        <div class="hero-glow hero-glow--secondary"></div>
        <div class="hero-grid-lines"></div>
    </div>
    <div class="container about-hero-inner">
        <div class="about-hero-content" data-gsap="fade-up">
            <span class="section-tag">About Us</span>
            <h1 class="inner-page-title" id="about-heading">
                <?php echo wp_kses_post( $headline ); ?>
            </h1>
            <p class="hero-subheading"><?php echo esc_html( $subheading ); ?></p>
        </div>
    </div>
</section>

<!-- ── Mission / Vision / Values ─────────────────────────────── -->
<section class="about-mission section" aria-labelledby="mission-heading">
    <div class="container">
        <h2 class="screen-reader-text" id="mission-heading">Mission, Vision and Values</h2>
        <div class="mission-grid" data-gsap="stagger-cards">
            <?php foreach ( $mission as $card ) :
                $icon  = ! empty( $card['mission_icon'] )  ? $card['mission_icon']  : '✦';
                $title = ! empty( $card['mission_title'] ) ? $card['mission_title'] : '';
                $desc  = ! empty( $card['mission_desc'] )  ? $card['mission_desc']  : '';
            ?>
            <div class="mission-card glass-card">
                <div class="mission-icon" aria-hidden="true"><?php echo wp_kses_post( $icon ); ?></div>
                <?php if ( $title ) : ?><h3 class="mission-title"><?php echo esc_html( $title ); ?></h3><?php endif; ?>
                <?php if ( $desc )  : ?><p  class="mission-desc"><?php echo esc_html( $desc );  ?></p><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Stats Bar ─────────────────────────────────────────────── -->
<section class="about-stats-bar" aria-label="Company stats">
    <div class="container">
        <div class="stats-bar-grid">
            <?php foreach ( $stats as $stat ) :
                $number = ! empty( $stat['stat_number'] ) ? $stat['stat_number'] : '0';
                $suffix = ! empty( $stat['stat_suffix'] ) ? $stat['stat_suffix'] : '';
                $label  = ! empty( $stat['stat_label'] )  ? $stat['stat_label']  : '';
            ?>
            <div class="stats-bar-item" data-gsap="fade-up">
                <div class="stats-bar-value">
                    <span class="stats-bar-number gradient-text" data-count="<?php echo esc_attr( $number ); ?>">0</span><span class="stats-bar-suffix gradient-text"><?php echo esc_html( $suffix ); ?></span>
                </div>
                <?php if ( $label ) : ?><span class="stats-bar-label"><?php echo esc_html( $label ); ?></span><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Story Timeline ────────────────────────────────────────── -->
<section class="about-story section" aria-labelledby="story-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">Our Story</span>
            <h2 class="section-title" id="story-heading">Built from the <span class="gradient-text">ground up</span></h2>
        </div>
        <div class="story-timeline">
            <?php foreach ( $story as $i => $item ) :
                $year  = ! empty( $item['story_year'] )  ? $item['story_year']  : '';
                $title = ! empty( $item['story_title'] ) ? $item['story_title'] : '';
                $desc  = ! empty( $item['story_desc'] )  ? $item['story_desc']  : '';
            ?>
            <div class="story-item <?php echo ( $i % 2 === 1 ) ? 'story-item--right' : ''; ?>" data-gsap="<?php echo ( $i % 2 === 1 ) ? 'fade-left' : 'fade-right'; ?>">
                <?php if ( $year ) : ?><div class="story-year"><?php echo esc_html( $year ); ?></div><?php endif; ?>
                <div class="story-content glass-card">
                    <?php if ( $title ) : ?><h3><?php echo esc_html( $title ); ?></h3><?php endif; ?>
                    <?php if ( $desc )  : ?><p><?php echo esc_html( $desc ); ?></p><?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Team ──────────────────────────────────────────────────── -->
<section class="about-team section" aria-labelledby="team-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">The Team</span>
            <h2 class="section-title" id="team-heading">The people <span class="gradient-text">behind the platform</span></h2>
            <p class="section-subtitle">Former engineers from Google DeepMind, OpenAI, Stripe, and Cloudflare — obsessed with reliability and developer experience.</p>
        </div>
        <div class="team-grid" data-gsap="stagger-cards">
            <?php foreach ( $team as $i => $member ) :
                $name     = ! empty( $member['team_name'] )     ? $member['team_name']     : '';
                $role     = ! empty( $member['team_role'] )     ? $member['team_role']     : '';
                $photo    = ! empty( $member['team_photo'] )    ? $member['team_photo']    : '';
                $linkedin = ! empty( $member['team_linkedin'] ) ? $member['team_linkedin'] : '#';
                $twitter  = ! empty( $member['team_twitter'] )  ? $member['team_twitter']  : '#';
                $initials = $name ? mb_strtoupper( mb_substr( preg_replace('/\s+.*/', '', $name), 0, 1 ) . ( strpos($name,' ') !== false ? mb_substr( strrchr($name,' '), 1, 1 ) : '' ) ) : '?';
                $color    = $avatar_colors[ $i % count( $avatar_colors ) ];
            ?>
            <div class="team-card glass-card">
                <div class="team-avatar" style="background:<?php echo esc_attr( $color ); ?>;" aria-hidden="true">
                    <?php if ( $photo ) : ?>
                        <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
                    <?php else : ?>
                        <span><?php echo esc_html( $initials ); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ( $name ) : ?><h3 class="team-name"><?php echo esc_html( $name ); ?></h3><?php endif; ?>
                <?php if ( $role ) : ?><p  class="team-role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
                <div class="team-social">
                    <?php if ( $linkedin && $linkedin !== '#' ) : ?>
                    <a href="<?php echo esc_url( $linkedin ); ?>" class="team-social-link" aria-label="LinkedIn – <?php echo esc_attr( $name ); ?>" target="_blank" rel="noopener noreferrer">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $twitter && $twitter !== '#' ) : ?>
                    <a href="<?php echo esc_url( $twitter ); ?>" class="team-social-link" aria-label="Twitter – <?php echo esc_attr( $name ); ?>" target="_blank" rel="noopener noreferrer">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622Zm-1.161 17.52h1.833L7.084 4.126H5.117Z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── Investors ─────────────────────────────────────────────── -->
<?php if ( $investors ) : ?>
<section class="about-investors section" aria-labelledby="investors-heading">
    <div class="container">
        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">Backed By</span>
            <h2 class="section-title" id="investors-heading">World-class <span class="gradient-text">investors</span></h2>
        </div>
        <div class="investors-grid" data-gsap="stagger-cards">
            <?php foreach ( $investors as $inv ) :
                $name = ! empty( $inv['investor_name'] ) ? $inv['investor_name'] : '';
                $desc = ! empty( $inv['investor_desc'] ) ? $inv['investor_desc'] : '';
            ?>
            <div class="investor-card glass-card">
                <?php if ( $name ) : ?><span class="investor-name"><?php echo esc_html( $name ); ?></span><?php endif; ?>
                <?php if ( $desc ) : ?><span class="investor-desc"><?php echo esc_html( $desc ); ?></span><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/cta' ); ?>
<?php get_footer();
