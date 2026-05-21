<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script>document.documentElement.classList.replace('no-js','js');</script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'leap-theme' ); ?></a>

<header class="site-header" id="site-header" role="banner">
    <div class="header-inner container">

        <!-- Logo -->
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
                    <svg class="logo-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <defs>
                            <linearGradient id="logoGrad" x1="0" y1="0" x2="32" y2="32" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0066FF"/>
                                <stop offset="100%" stop-color="#00BFFF"/>
                            </linearGradient>
                        </defs>
                        <path d="M4 28L16 4L28 28H20L16 18L12 28H4Z" fill="url(#logoGrad)"/>
                    </svg>
                    <span class="site-name"><?php bloginfo( 'name' ); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Primary Navigation -->
        <nav class="primary-nav" id="primary-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'leap-theme' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => 'leap_fallback_nav',
            ] );
            ?>
        </nav>

        <!-- Header CTA -->
        <div class="header-actions">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary btn-sm">
                Get Started
            </a>
            <button class="nav-toggle" id="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>

    </div>
</header>

<main id="main" class="site-main" role="main">

<?php
function leap_fallback_nav() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">About</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/services' ) ) . '">Services</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/pricing' ) ) . '">Pricing</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/blog' ) ) . '">Blog</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">Contact</a></li>';
    echo '</ul>';
}
