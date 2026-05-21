<?php
$steps = leap_field( 'process_steps_repeater' );

if ( ! $steps ) {
    $steps = [
        [ 'step_number' => '01', 'step_title' => 'Connect Your Data',    'step_desc' => 'Integrate your data sources in minutes using our library of pre-built connectors. Supports databases, APIs, object storage, and streaming systems.' ],
        [ 'step_number' => '02', 'step_title' => 'Configure Your Model', 'step_desc' => 'Choose from 50+ foundation models or bring your own. Set fine-tuning parameters, evaluation metrics, and deployment targets — all from a single UI.' ],
        [ 'step_number' => '03', 'step_title' => 'Train & Evaluate',     'step_desc' => 'Kick off distributed training runs with one click. Monitor metrics in real time, compare experiments, and automatically select the best-performing checkpoint.' ],
        [ 'step_number' => '04', 'step_title' => 'Deploy to Production', 'step_desc' => 'Push to our edge network instantly. Canary releases, A/B testing, and rollback controls give your team full confidence at every release.' ],
        [ 'step_number' => '05', 'step_title' => 'Monitor & Iterate',    'step_desc' => 'Track performance, cost, and model drift from your dashboard. Set alerts, run evaluations automatically, and close the feedback loop continuously.' ],
    ];
}
?>

<section class="process-section section" id="process" aria-labelledby="process-heading">
    <div class="container">

        <div class="section-header text-center" data-gsap="fade-up">
            <span class="section-tag">How It Works</span>
            <h2 class="section-title" id="process-heading">
                From idea to <span class="gradient-text">production in days</span>
            </h2>
            <p class="section-subtitle">
                A streamlined workflow designed for speed without sacrificing reliability or control.
            </p>
        </div>

        <div class="process-timeline" data-gsap="process-reveal">
            <div class="timeline-line" aria-hidden="true"></div>

            <?php foreach ( $steps as $i => $step ) :
                $number = ! empty( $step['step_number'] ) ? $step['step_number'] : str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                $title  = ! empty( $step['step_title'] )  ? $step['step_title']  : '';
                $desc   = ! empty( $step['step_desc'] )   ? $step['step_desc']   : '';
                $is_even = ( $i % 2 === 1 );
            ?>
            <div class="process-step <?php echo $is_even ? 'process-step--right' : 'process-step--left'; ?>" data-step="<?php echo esc_attr( $i ); ?>">
                <div class="step-node" aria-hidden="true">
                    <span class="step-number"><?php echo esc_html( $number ); ?></span>
                </div>
                <div class="step-content glass-card">
                    <?php if ( $title ) : ?>
                        <h3 class="step-title"><?php echo esc_html( $title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $desc ) : ?>
                        <p class="step-desc"><?php echo esc_html( $desc ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
