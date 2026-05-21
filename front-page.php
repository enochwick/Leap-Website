<?php
/**
 * Homepage — uses front-page.php when a static front page is set in WordPress.
 * Reading Order: hero → trust bar → services → process → benefits → testimonials → CTA
 */
get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>
<?php get_template_part( 'template-parts/trust-bar' ); ?>
<?php get_template_part( 'template-parts/services' ); ?>
<?php get_template_part( 'template-parts/process' ); ?>
<?php get_template_part( 'template-parts/benefits' ); ?>
<?php get_template_part( 'template-parts/testimonials' ); ?>
<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer();
