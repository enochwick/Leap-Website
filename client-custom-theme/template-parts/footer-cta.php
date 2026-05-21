<?php
// Minimal footer CTA band — sits above the main footer body
?>
<div class="footer-cta-band" aria-label="Newsletter signup">
    <div class="container footer-cta-inner">
        <div class="footer-cta-text">
            <strong>Stay in the loop.</strong>
            <span>Product updates, AI research, and engineering insights — once a week.</span>
        </div>
        <form class="footer-cta-form" action="#" method="post" aria-label="Newsletter subscription">
            <?php wp_nonce_field( 'leap_newsletter', 'leap_newsletter_nonce' ); ?>
            <label for="footer-email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'leap-theme' ); ?></label>
            <input
                type="email"
                id="footer-email"
                name="email"
                class="footer-cta-input"
                placeholder="your@email.com"
                required
                autocomplete="email"
            >
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>
</div>
