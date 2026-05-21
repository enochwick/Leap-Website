<?php
$testimonials = leap_field( 'testimonials_repeater' );

if ( ! $testimonials ) {
    $testimonials = [
        [
            'testimonial_quote'  => 'Leap cut our model deployment time from weeks to hours. The observability tools alone saved us three full-time engineers.',
            'testimonial_name'   => 'Sarah Chen',
            'testimonial_title'  => 'CTO, Novalabs',
            'testimonial_avatar' => '',
        ],
        [
            'testimonial_quote'  => 'We evaluated every AI infrastructure platform on the market. Nothing came close to the performance and developer experience Leap delivers.',
            'testimonial_name'   => 'Marcus Rivera',
            'testimonial_title'  => 'Head of AI, Vertix',
            'testimonial_avatar' => '',
        ],
        [
            'testimonial_quote'  => 'The fine-tuning pipelines are exceptional. We went from raw data to a production model in 48 hours — something that used to take us a full quarter.',
            'testimonial_name'   => 'Priya Nair',
            'testimonial_title'  => 'ML Lead, Synapse',
            'testimonial_avatar' => '',
        ],
    ];
}
?>

<section class="testimonials-section section" id="testimonials" aria-labelledby="testimonials-heading">
    <div class="container">

        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">Social Proof</span>
            <h2 class="section-title" id="testimonials-heading">
                Loved by engineering <span class="gradient-text">teams worldwide</span>
            </h2>
            <p class="section-subtitle">
                Don't take our word for it. Here's what the people actually building with Leap have to say.
            </p>
        </div>

        <div class="testimonials-grid" data-gsap="stagger-cards">
            <?php foreach ( $testimonials as $i => $t ) :
                $quote  = ! empty( $t['testimonial_quote'] )  ? $t['testimonial_quote']  : '';
                $name   = ! empty( $t['testimonial_name'] )   ? $t['testimonial_name']   : '';
                $title  = ! empty( $t['testimonial_title'] )  ? $t['testimonial_title']  : '';
                $avatar = ! empty( $t['testimonial_avatar'] ) ? $t['testimonial_avatar'] : '';
                $initials = $name ? strtoupper( mb_substr( $name, 0, 1 ) ) : '?';
            ?>
            <article class="testimonial-card glass-card" aria-label="Testimonial from <?php echo esc_attr( $name ); ?>">
                <!-- Stars -->
                <div class="testimonial-stars" aria-label="5 stars" role="img">
                    <?php for ( $s = 0; $s < 5; $s++ ) : ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#0066FF" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <?php endfor; ?>
                </div>

                <?php if ( $quote ) : ?>
                    <blockquote class="testimonial-quote">
                        <p>&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</p>
                    </blockquote>
                <?php endif; ?>

                <footer class="testimonial-author">
                    <div class="author-avatar" aria-hidden="true">
                        <?php if ( $avatar ) : ?>
                            <img src="<?php echo esc_url( $avatar ); ?>" alt="<?php echo esc_attr( $name ); ?>" width="40" height="40" loading="lazy">
                        <?php else : ?>
                            <span class="avatar-initials"><?php echo esc_html( $initials ); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="author-info">
                        <?php if ( $name ) : ?><strong class="author-name"><?php echo esc_html( $name ); ?></strong><?php endif; ?>
                        <?php if ( $title ) : ?><span class="author-title"><?php echo esc_html( $title ); ?></span><?php endif; ?>
                    </div>
                </footer>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
