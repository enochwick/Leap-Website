<?php
/**
 * Contact Page Template
 * Slug must be: contact
 * All content editable via ACF → Pages → Contact → Edit
 */

$headline    = leap_field( 'contact_headline',   'Let\'s <span class="gradient-text">talk</span>' );
$subheading  = leap_field( 'contact_subheading', 'Whether you\'re evaluating Leap, need help with your current setup, or want to explore an Enterprise plan — we\'re here.' );
$email       = leap_field( 'contact_email',      'hello@yourcompany.com' );
$phone       = leap_field( 'contact_phone',      '+1 (555) 000-0000' );
$address     = leap_field( 'contact_address',    '123 Innovation Drive' . "\n" . 'San Francisco, CA 94102' );
$response    = leap_field( 'contact_response',   'Within 1 business day' );
$sales_title = leap_field( 'contact_sales_title','Need a custom plan?' );
$sales_desc  = leap_field( 'contact_sales_desc', 'Our sales team will build a package around your specific volume, compliance, and infrastructure requirements.' );
$sales_email = leap_field( 'contact_sales_email','sales@yourcompany.com' );
$twitter     = leap_field( 'contact_twitter',    '#' );
$linkedin    = leap_field( 'contact_linkedin',   '#' );
$github      = leap_field( 'contact_github',     '#' );

get_header();
?>

<!-- ── Hero ──────────────────────────────────────────────────── -->
<section class="inner-hero contact-hero" aria-labelledby="contact-heading">
    <div class="about-hero-bg" aria-hidden="true">
        <div class="hero-glow hero-glow--primary"></div>
        <div class="hero-grid-lines"></div>
    </div>
    <div class="container about-hero-inner">
        <div class="about-hero-content" data-gsap="fade-up">
            <span class="section-tag">Contact Us</span>
            <h1 class="inner-page-title" id="contact-heading">
                <?php echo wp_kses_post( $headline ); ?>
            </h1>
            <p class="hero-subheading"><?php echo esc_html( $subheading ); ?></p>
        </div>
    </div>
</section>

<!-- ── Contact Layout ─────────────────────────────────────────── -->
<section class="contact-section section">
    <div class="container">
        <div class="contact-layout">

            <!-- ── Form ────────────────────────────────────────── -->
            <div class="contact-form-wrap" data-gsap="fade-right">
                <h2 class="contact-form-title">Send us a message</h2>
                <p class="contact-form-sub">We typically respond <?php echo esc_html( strtolower( $response ) ); ?>.</p>

                <form class="contact-form" id="contact-form" method="post" action="#" novalidate>
                    <?php wp_nonce_field( 'leap_contact', 'leap_contact_nonce' ); ?>

                    <div class="form-row form-row--2col">
                        <div class="form-group">
                            <label for="contact-fname" class="form-label">First name <span aria-hidden="true">*</span></label>
                            <input type="text" id="contact-fname" name="first_name" class="form-input" placeholder="Alex" required autocomplete="given-name">
                        </div>
                        <div class="form-group">
                            <label for="contact-lname" class="form-label">Last name <span aria-hidden="true">*</span></label>
                            <input type="text" id="contact-lname" name="last_name" class="form-input" placeholder="Morgan" required autocomplete="family-name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact-email" class="form-label">Work email <span aria-hidden="true">*</span></label>
                        <input type="email" id="contact-email" name="email" class="form-input" placeholder="you@company.com" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="contact-company" class="form-label">Company</label>
                        <input type="text" id="contact-company" name="company" class="form-input" placeholder="Acme Inc." autocomplete="organization">
                    </div>

                    <div class="form-group">
                        <label for="contact-subject" class="form-label">What's this about? <span aria-hidden="true">*</span></label>
                        <select id="contact-subject" name="subject" class="form-input form-select" required>
                            <option value="" disabled selected>Select a topic</option>
                            <option value="general">General enquiry</option>
                            <option value="sales">Sales &amp; pricing</option>
                            <option value="enterprise">Enterprise plans</option>
                            <option value="support">Technical support</option>
                            <option value="partnership">Partnership</option>
                            <option value="press">Press &amp; media</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact-message" class="form-label">Message <span aria-hidden="true">*</span></label>
                        <textarea id="contact-message" name="message" class="form-input form-textarea" placeholder="Tell us what you're building and how we can help..." rows="6" required></textarea>
                    </div>

                    <div class="form-consent">
                        <label class="checkbox-label">
                            <input type="checkbox" name="consent" required>
                            <span class="checkbox-custom" aria-hidden="true"></span>
                            <span>I agree to the <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>.</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg form-submit">
                        Send Message
                        <svg class="btn-arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="form-success" id="form-success" role="alert" aria-live="polite" hidden>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="M4 10l4 4 8-8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Message sent! We'll get back to you <?php echo esc_html( strtolower( $response ) ); ?>.
                    </div>
                </form>
            </div>

            <!-- ── Info ─────────────────────────────────────────── -->
            <div class="contact-info-wrap" data-gsap="fade-left">

                <div class="contact-info-cards">
                    <?php if ( $email ) : ?>
                    <div class="contact-info-card glass-card">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <span class="contact-info-label">Email</span>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-info-value"><?php echo esc_html( $email ); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $phone ) : ?>
                    <div class="contact-info-card glass-card">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <span class="contact-info-label">Phone</span>
                            <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $phone) ); ?>" class="contact-info-value"><?php echo esc_html( $phone ); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $address ) : ?>
                    <div class="contact-info-card glass-card">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <span class="contact-info-label">Office</span>
                            <span class="contact-info-value"><?php echo nl2br( esc_html( $address ) ); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $response ) : ?>
                    <div class="contact-info-card glass-card">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10" stroke-linecap="round"/><path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <span class="contact-info-label">Response time</span>
                            <span class="contact-info-value"><?php echo esc_html( $response ); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ( $sales_title || $sales_desc ) : ?>
                <div class="contact-sales-card glass-card">
                    <span class="section-tag" style="margin-bottom:0.75rem;">Enterprise</span>
                    <?php if ( $sales_title ) : ?><h3 class="contact-sales-title"><?php echo esc_html( $sales_title ); ?></h3><?php endif; ?>
                    <?php if ( $sales_desc )  : ?><p  class="contact-sales-desc"><?php echo esc_html( $sales_desc );   ?></p><?php endif; ?>
                    <?php if ( $sales_email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $sales_email ); ?>" class="btn btn-primary">Talk to Sales</a>
                    <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">Talk to Sales</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Social links -->
                <div class="contact-social">
                    <span class="contact-social-label">Follow us</span>
                    <div class="contact-social-links">
                        <?php if ( $twitter ) : ?>
                        <a href="<?php echo esc_url( $twitter ); ?>" class="social-link" aria-label="Twitter/X" target="_blank" rel="noopener noreferrer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622Zm-1.161 17.52h1.833L7.084 4.126H5.117Z"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( $linkedin ) : ?>
                        <a href="<?php echo esc_url( $linkedin ); ?>" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ( $github ) : ?>
                        <a href="<?php echo esc_url( $github ); ?>" class="social-link" aria-label="GitHub" target="_blank" rel="noopener noreferrer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer();
