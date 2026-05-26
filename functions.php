<?php
/**
 * Leap Theme — Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'LEAP_VERSION', '1.0.3' );
define( 'LEAP_DIR', get_template_directory() );
define( 'LEAP_URI', get_template_directory_uri() );

// ── Theme Setup ──────────────────────────────────────────────────────────────
function leap_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'leap-theme' ),
        'footer'  => __( 'Footer Navigation', 'leap-theme' ),
        'social'  => __( 'Social Links Menu', 'leap-theme' ),
    ] );

    load_theme_textdomain( 'leap-theme', LEAP_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'leap_setup' );

// ── Enqueue ──────────────────────────────────────────────────────────────────
function leap_enqueue_assets() {
    wp_enqueue_style( 'leap-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
        [], null
    );
    wp_enqueue_style( 'leap-main', LEAP_URI . '/assets/css/main.css', [ 'leap-fonts' ], LEAP_VERSION );

    wp_enqueue_script( 'gsap-core',          'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',            [], '3.12.5', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',   [ 'gsap-core' ], '3.12.5', true );
    wp_enqueue_script( 'leap-main',          LEAP_URI . '/assets/js/main.js', [ 'gsap-core', 'gsap-scrolltrigger' ], LEAP_VERSION, true );

    wp_localize_script( 'leap-main', 'leapTheme', [
        'themeUri' => LEAP_URI,
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'leap_ajax' ),
    ] );

    if ( is_singular() && comments_open() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'leap_enqueue_assets' );

// ── Helper: get ACF field with fallback ──────────────────────────────────────
function leap_field( $name, $fallback = '', $post_id = false ) {
    if ( function_exists( 'get_field' ) ) {
        $v = $post_id ? get_field( $name, $post_id ) : get_field( $name );
        return ( $v !== null && $v !== '' && $v !== false ) ? $v : $fallback;
    }
    return $fallback;
}

// Parse textarea features (one per line) into array
function leap_parse_features( $text ) {
    if ( is_array( $text ) ) return array_filter( $text );
    return array_filter( array_map( 'trim', explode( "\n", (string) $text ) ) );
}

// ── ACF Field Groups ─────────────────────────────────────────────────────────
function leap_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    // ── 1. HOMEPAGE ──────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_homepage',
        'title'  => 'Homepage Content',
        'fields' => [
            [ 'key' => 'field_hero_headline',           'label' => 'Hero Headline',           'name' => 'hero_headline',            'type' => 'text' ],
            [ 'key' => 'field_hero_subheading',          'label' => 'Hero Subheading',         'name' => 'hero_subheading',           'type' => 'textarea', 'rows' => 3 ],
            [ 'key' => 'field_hero_primary_btn_text',    'label' => 'Primary Button Text',     'name' => 'hero_primary_button_text',  'type' => 'text' ],
            [ 'key' => 'field_hero_primary_btn_url',     'label' => 'Primary Button URL',      'name' => 'hero_primary_button_url',   'type' => 'url' ],
            [ 'key' => 'field_hero_secondary_btn_text',  'label' => 'Secondary Button Text',   'name' => 'hero_secondary_button_text','type' => 'text' ],
            [ 'key' => 'field_hero_secondary_btn_url',   'label' => 'Secondary Button URL',    'name' => 'hero_secondary_button_url', 'type' => 'url' ],
            [
                'key' => 'field_services_repeater', 'label' => 'Services', 'name' => 'services_repeater', 'type' => 'repeater',
                'button_label' => 'Add Service',
                'sub_fields' => [
                    [ 'key' => 'field_svc_icon',  'label' => 'Icon (emoji or SVG)', 'name' => 'service_icon',  'type' => 'text' ],
                    [ 'key' => 'field_svc_title', 'label' => 'Title',               'name' => 'service_title', 'type' => 'text' ],
                    [ 'key' => 'field_svc_desc',  'label' => 'Description',         'name' => 'service_desc',  'type' => 'textarea', 'rows' => 3 ],
                    [ 'key' => 'field_svc_cta',   'label' => 'CTA Text',            'name' => 'service_cta',   'type' => 'text' ],
                    [ 'key' => 'field_svc_url',   'label' => 'CTA URL',             'name' => 'service_url',   'type' => 'url' ],
                ],
            ],
            [
                'key' => 'field_process_repeater', 'label' => 'Process Steps', 'name' => 'process_steps_repeater', 'type' => 'repeater',
                'button_label' => 'Add Step',
                'sub_fields' => [
                    [ 'key' => 'field_step_num',   'label' => 'Step Number', 'name' => 'step_number', 'type' => 'text' ],
                    [ 'key' => 'field_step_title', 'label' => 'Title',       'name' => 'step_title',  'type' => 'text' ],
                    [ 'key' => 'field_step_desc',  'label' => 'Description', 'name' => 'step_desc',   'type' => 'textarea', 'rows' => 2 ],
                ],
            ],
            [
                'key' => 'field_benefits_repeater', 'label' => 'Benefits', 'name' => 'benefits_repeater', 'type' => 'repeater',
                'button_label' => 'Add Benefit',
                'sub_fields' => [
                    [ 'key' => 'field_ben_icon',  'label' => 'Icon',        'name' => 'benefit_icon',  'type' => 'text' ],
                    [ 'key' => 'field_ben_title', 'label' => 'Title',       'name' => 'benefit_title', 'type' => 'text' ],
                    [ 'key' => 'field_ben_desc',  'label' => 'Description', 'name' => 'benefit_desc',  'type' => 'textarea', 'rows' => 2 ],
                ],
            ],
            [
                'key' => 'field_stats_repeater', 'label' => 'Stats', 'name' => 'stats_repeater', 'type' => 'repeater',
                'button_label' => 'Add Stat',
                'sub_fields' => [
                    [ 'key' => 'field_stat_num',    'label' => 'Number (e.g. 500)', 'name' => 'stat_number', 'type' => 'text' ],
                    [ 'key' => 'field_stat_suffix', 'label' => 'Suffix (e.g. +)',   'name' => 'stat_suffix', 'type' => 'text' ],
                    [ 'key' => 'field_stat_label',  'label' => 'Label',             'name' => 'stat_label',  'type' => 'text' ],
                ],
            ],
            [
                'key' => 'field_testimonials_repeater', 'label' => 'Testimonials', 'name' => 'testimonials_repeater', 'type' => 'repeater',
                'button_label' => 'Add Testimonial',
                'sub_fields' => [
                    [ 'key' => 'field_test_quote',  'label' => 'Quote',        'name' => 'testimonial_quote',  'type' => 'textarea', 'rows' => 3 ],
                    [ 'key' => 'field_test_name',   'label' => 'Client Name',  'name' => 'testimonial_name',   'type' => 'text' ],
                    [ 'key' => 'field_test_title',  'label' => 'Client Title', 'name' => 'testimonial_title',  'type' => 'text' ],
                    [ 'key' => 'field_test_avatar', 'label' => 'Avatar',       'name' => 'testimonial_avatar', 'type' => 'image', 'return_format' => 'url' ],
                ],
            ],
            [ 'key' => 'field_cta_headline',   'label' => 'CTA Headline',    'name' => 'final_cta_headline',    'type' => 'text' ],
            [ 'key' => 'field_cta_text',       'label' => 'CTA Support Text','name' => 'final_cta_text',        'type' => 'textarea', 'rows' => 2 ],
            [ 'key' => 'field_cta_btn_text',   'label' => 'CTA Button Text', 'name' => 'final_cta_button_text', 'type' => 'text' ],
            [ 'key' => 'field_cta_btn_url',    'label' => 'CTA Button URL',  'name' => 'final_cta_button_url',  'type' => 'url' ],
            [ 'key' => 'field_footer_contact', 'label' => 'Footer Contact',  'name' => 'footer_contact_info',   'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0 ],
        ],
        'location'   => [ [ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ] ],
        'menu_order' => 0,
        'style'      => 'seamless',
    ] );

    // ── 2. ABOUT PAGE ────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_about',
        'title'  => 'About Page Content',
        'fields' => [
            // Hero
            [ 'key' => 'field_about_headline',    'label' => 'Hero Headline',    'name' => 'about_headline',    'type' => 'text',     'instructions' => 'Use <span class="gradient-text">word</span> for gradient highlight' ],
            [ 'key' => 'field_about_subheading',   'label' => 'Hero Subheading',  'name' => 'about_subheading',  'type' => 'textarea', 'rows' => 3 ],
            // Mission
            [
                'key' => 'field_about_mission', 'label' => 'Mission Cards', 'name' => 'about_mission', 'type' => 'repeater',
                'min' => 1, 'max' => 3, 'button_label' => 'Add Card',
                'sub_fields' => [
                    [ 'key' => 'field_mc_icon',  'label' => 'Icon (emoji)', 'name' => 'mission_icon',  'type' => 'text' ],
                    [ 'key' => 'field_mc_title', 'label' => 'Title',        'name' => 'mission_title', 'type' => 'text' ],
                    [ 'key' => 'field_mc_desc',  'label' => 'Description',  'name' => 'mission_desc',  'type' => 'textarea', 'rows' => 3 ],
                ],
            ],
            // Stats
            [
                'key' => 'field_about_stats', 'label' => 'Stats Bar', 'name' => 'about_stats', 'type' => 'repeater',
                'min' => 1, 'max' => 4, 'button_label' => 'Add Stat',
                'sub_fields' => [
                    [ 'key' => 'field_as_number', 'label' => 'Number (e.g. 500)', 'name' => 'stat_number', 'type' => 'text' ],
                    [ 'key' => 'field_as_suffix', 'label' => 'Suffix (e.g. +)',   'name' => 'stat_suffix', 'type' => 'text' ],
                    [ 'key' => 'field_as_label',  'label' => 'Label',             'name' => 'stat_label',  'type' => 'text' ],
                ],
            ],
            // Story
            [
                'key' => 'field_about_story', 'label' => 'Story Timeline', 'name' => 'about_story', 'type' => 'repeater',
                'button_label' => 'Add Timeline Item',
                'sub_fields' => [
                    [ 'key' => 'field_st_year',  'label' => 'Year',        'name' => 'story_year',  'type' => 'text' ],
                    [ 'key' => 'field_st_title', 'label' => 'Title',       'name' => 'story_title', 'type' => 'text' ],
                    [ 'key' => 'field_st_desc',  'label' => 'Description', 'name' => 'story_desc',  'type' => 'textarea', 'rows' => 3 ],
                ],
            ],
            // Team
            [
                'key' => 'field_about_team', 'label' => 'Team Members', 'name' => 'about_team', 'type' => 'repeater',
                'button_label' => 'Add Team Member',
                'sub_fields' => [
                    [ 'key' => 'field_tm_name',     'label' => 'Full Name',    'name' => 'team_name',     'type' => 'text' ],
                    [ 'key' => 'field_tm_role',     'label' => 'Role / Title', 'name' => 'team_role',     'type' => 'text' ],
                    [ 'key' => 'field_tm_photo',    'label' => 'Photo',        'name' => 'team_photo',    'type' => 'image', 'return_format' => 'url' ],
                    [ 'key' => 'field_tm_linkedin', 'label' => 'LinkedIn URL', 'name' => 'team_linkedin', 'type' => 'url' ],
                    [ 'key' => 'field_tm_twitter',  'label' => 'Twitter URL',  'name' => 'team_twitter',  'type' => 'url' ],
                ],
            ],
            // Investors
            [
                'key' => 'field_about_investors', 'label' => 'Investors / Backers', 'name' => 'about_investors', 'type' => 'repeater',
                'button_label' => 'Add Investor',
                'sub_fields' => [
                    [ 'key' => 'field_inv_name', 'label' => 'Name',        'name' => 'investor_name', 'type' => 'text' ],
                    [ 'key' => 'field_inv_desc', 'label' => 'Description', 'name' => 'investor_desc', 'type' => 'text' ],
                ],
            ],
        ],
        'location'   => [ [ [ 'param' => 'page_slug', 'operator' => '==', 'value' => 'about' ] ] ],
        'menu_order' => 0,
        'style'      => 'seamless',
    ] );

    // ── 3. SERVICES PAGE ─────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_services',
        'title'  => 'Services Page Content',
        'fields' => [
            [ 'key' => 'field_svp_headline',   'label' => 'Hero Headline',   'name' => 'services_headline',   'type' => 'text' ],
            [ 'key' => 'field_svp_subheading', 'label' => 'Hero Subheading', 'name' => 'services_subheading', 'type' => 'textarea', 'rows' => 3 ],
            [
                'key' => 'field_svp_detail', 'label' => 'Service Details', 'name' => 'services_detail', 'type' => 'repeater',
                'button_label' => 'Add Service',
                'sub_fields' => [
                    [ 'key' => 'field_sd_icon',     'label' => 'Icon (emoji)',   'name' => 'sd_icon',     'type' => 'text' ],
                    [ 'key' => 'field_sd_tag',      'label' => 'Tag / Category', 'name' => 'sd_tag',      'type' => 'text' ],
                    [ 'key' => 'field_sd_title',    'label' => 'Title',          'name' => 'sd_title',    'type' => 'text' ],
                    [ 'key' => 'field_sd_desc',     'label' => 'Description',    'name' => 'sd_desc',     'type' => 'textarea', 'rows' => 4 ],
                    [ 'key' => 'field_sd_features', 'label' => 'Features (one per line)', 'name' => 'sd_features', 'type' => 'textarea', 'rows' => 6, 'instructions' => 'One feature per line' ],
                    [ 'key' => 'field_sd_cta',      'label' => 'CTA Button Text', 'name' => 'sd_cta',    'type' => 'text' ],
                    [ 'key' => 'field_sd_url',      'label' => 'CTA Button URL',  'name' => 'sd_url',    'type' => 'url' ],
                ],
            ],
            [
                'key' => 'field_svp_integrations', 'label' => 'Integrations', 'name' => 'services_integrations', 'type' => 'repeater',
                'button_label' => 'Add Integration',
                'sub_fields' => [
                    [ 'key' => 'field_int_name', 'label' => 'Name', 'name' => 'integration_name', 'type' => 'text' ],
                ],
            ],
        ],
        'location'   => [ [ [ 'param' => 'page_slug', 'operator' => '==', 'value' => 'services' ] ] ],
        'menu_order' => 0,
        'style'      => 'seamless',
    ] );

    // ── 4. PRICING PAGE ──────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_pricing',
        'title'  => 'Pricing Page Content',
        'fields' => [
            [ 'key' => 'field_pr_headline',   'label' => 'Hero Headline',   'name' => 'pricing_headline',   'type' => 'text' ],
            [ 'key' => 'field_pr_subheading', 'label' => 'Hero Subheading', 'name' => 'pricing_subheading', 'type' => 'textarea', 'rows' => 3 ],
            // Tiers
            [
                'key' => 'field_pr_tiers', 'label' => 'Pricing Tiers', 'name' => 'pricing_tiers', 'type' => 'repeater',
                'min' => 1, 'max' => 4, 'button_label' => 'Add Tier',
                'instructions' => 'Add up to 4 pricing tiers. Order: Starter → Pro → Enterprise.',
                'sub_fields' => [
                    [ 'key' => 'field_pt_name',         'label' => 'Tier Name',               'name' => 'tier_name',         'type' => 'text' ],
                    [ 'key' => 'field_pt_desc',         'label' => 'Short Description',        'name' => 'tier_desc',         'type' => 'textarea', 'rows' => 2 ],
                    [ 'key' => 'field_pt_featured',     'label' => 'Featured / Highlighted?', 'name' => 'tier_featured',     'type' => 'true_false', 'default_value' => 0, 'ui' => 1 ],
                    [ 'key' => 'field_pt_custom_price', 'label' => 'Custom Price? (Enterprise)', 'name' => 'tier_custom_price', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1 ],
                    [ 'key' => 'field_pt_monthly',      'label' => 'Monthly Price ($)',        'name' => 'tier_price_monthly', 'type' => 'number', 'min' => 0 ],
                    [ 'key' => 'field_pt_annual',       'label' => 'Annual Price ($/mo)',      'name' => 'tier_price_annual',  'type' => 'number', 'min' => 0 ],
                    [ 'key' => 'field_pt_btn_text',     'label' => 'Button Text',              'name' => 'tier_btn_text',     'type' => 'text' ],
                    [ 'key' => 'field_pt_btn_url',      'label' => 'Button URL',               'name' => 'tier_btn_url',      'type' => 'url' ],
                    [ 'key' => 'field_pt_features',     'label' => 'Features (one per line)',  'name' => 'tier_features',     'type' => 'textarea', 'rows' => 8, 'instructions' => 'One feature per line. Prefix with ✗ to mark as excluded.' ],
                ],
            ],
            // FAQ
            [
                'key' => 'field_pr_faq', 'label' => 'FAQ', 'name' => 'pricing_faq', 'type' => 'repeater',
                'button_label' => 'Add FAQ Item',
                'sub_fields' => [
                    [ 'key' => 'field_faq_q', 'label' => 'Question', 'name' => 'faq_question', 'type' => 'text' ],
                    [ 'key' => 'field_faq_a', 'label' => 'Answer',   'name' => 'faq_answer',   'type' => 'textarea', 'rows' => 3 ],
                ],
            ],
        ],
        'location'   => [ [ [ 'param' => 'page_slug', 'operator' => '==', 'value' => 'pricing' ] ] ],
        'menu_order' => 0,
        'style'      => 'seamless',
    ] );

    // ── 5. CONTACT PAGE ──────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_contact',
        'title'  => 'Contact Page Content',
        'fields' => [
            [ 'key' => 'field_ct_headline',   'label' => 'Hero Headline',   'name' => 'contact_headline',   'type' => 'text' ],
            [ 'key' => 'field_ct_subheading', 'label' => 'Hero Subheading', 'name' => 'contact_subheading', 'type' => 'textarea', 'rows' => 3 ],
            [ 'key' => 'field_ct_email',      'label' => 'Email Address',   'name' => 'contact_email',      'type' => 'email' ],
            [ 'key' => 'field_ct_phone',      'label' => 'Phone Number',    'name' => 'contact_phone',      'type' => 'text' ],
            [ 'key' => 'field_ct_address',    'label' => 'Address',         'name' => 'contact_address',    'type' => 'textarea', 'rows' => 3 ],
            [ 'key' => 'field_ct_response',   'label' => 'Response Time',   'name' => 'contact_response',   'type' => 'text' ],
            [ 'key' => 'field_ct_sales_title','label' => 'Sales Card Title','name' => 'contact_sales_title','type' => 'text' ],
            [ 'key' => 'field_ct_sales_desc', 'label' => 'Sales Card Text', 'name' => 'contact_sales_desc', 'type' => 'textarea', 'rows' => 2 ],
            [ 'key' => 'field_ct_sales_email','label' => 'Sales Email',     'name' => 'contact_sales_email','type' => 'email' ],
            [ 'key' => 'field_ct_twitter',    'label' => 'Twitter/X URL',   'name' => 'contact_twitter',    'type' => 'url' ],
            [ 'key' => 'field_ct_linkedin',   'label' => 'LinkedIn URL',    'name' => 'contact_linkedin',   'type' => 'url' ],
            [ 'key' => 'field_ct_github',     'label' => 'GitHub URL',      'name' => 'contact_github',     'type' => 'url' ],
        ],
        'location'   => [ [ [ 'param' => 'page_slug', 'operator' => '==', 'value' => 'contact' ] ] ],
        'menu_order' => 0,
        'style'      => 'seamless',
    ] );
}
add_action( 'acf/init', 'leap_register_acf_fields' );

// ── Custom Post Types ────────────────────────────────────────────────────────
function leap_register_post_types() {
    register_post_type( 'news', [
        'labels'       => [
            'name'          => __( 'News', 'leap-theme' ),
            'singular_name' => __( 'News Item', 'leap-theme' ),
            'add_new_item'  => __( 'Add News Item', 'leap-theme' ),
            'edit_item'     => __( 'Edit News Item', 'leap-theme' ),
        ],
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-megaphone',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author' ],
        'show_in_rest' => true,
        'rewrite'      => [ 'slug' => 'news' ],
    ] );
}
add_action( 'init', 'leap_register_post_types' );

// ── Misc ──────────────────────────────────────────────────────────────────────
function leap_excerpt_length()  { return 20; }
function leap_excerpt_more()    { return '&hellip;'; }
add_filter( 'excerpt_length', 'leap_excerpt_length' );
add_filter( 'excerpt_more',   'leap_excerpt_more' );

function leap_register_sidebars() {
    register_sidebar( [
        'name'          => __( 'Blog Sidebar', 'leap-theme' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'leap_register_sidebars' );

// Table cell helper for pricing comparison table
function leap_comp_cell( $value ) {
    $check = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="color:var(--color-primary);margin:auto;display:block;" aria-label="Included"><path d="M3 8l3.5 3.5L13 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $cross = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="color:var(--color-text-muted);margin:auto;display:block;opacity:.35;" aria-label="Not included"><path d="M4 4l8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>';
    if ( $value === true )  return $check;
    if ( $value === false ) return $cross;
    return '<span>' . esc_html( $value ) . '</span>';
}
