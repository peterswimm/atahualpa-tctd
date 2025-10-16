<?php
/**
 * Atahualpa TCTD Edition - Functions
 *
 * Security-hardened, modernized fork of Atahualpa
 *
 * @package Atahualpa_TCTD
 * @version 4.0.2-tctd.1
 * @since 4.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Theme version
define( 'ATAHUALPA_TCTD_VERSION', '4.0.2-tctd.1' );
define( 'ATAHUALPA_TCTD_MIN_WP', '6.4' );
define( 'ATAHUALPA_TCTD_MIN_PHP', '8.0' );

// Theme paths
define( 'ATAHUALPA_TCTD_DIR', get_template_directory() );
define( 'ATAHUALPA_TCTD_URI', get_template_directory_uri() );

/**
 * TCTD Default Theme Settings
 * These are applied on theme activation or reset
 */
function atahualpa_tctd_get_defaults() {
    return array(
        // Branding
        'site_title'              => 'True Chip Till Death',
        'tagline'                 => '',

        // Colors (TCTD Brand - from actual truechiptilldeath.com)
        'primary_color'           => 'FFFF00', // Yellow
        'secondary_color'         => '999999', // Gray
        'accent_color'            => 'CC0000', // Red
        'background_color'        => '1b1b1b', // Almost black
        'text_color'              => 'FFFFFF', // White
        'link_color'              => 'FFFF00', // Yellow
        'link_hover_color'        => 'CC0000', // Red

        // Layout (based on actual TCTD site)
        'content_width'           => 900,  // Original TCTD width
        'content_min_width'       => 770,  // Original min
        'content_max_width'       => 1250, // Original max
        'wide_width'              => 7680, // 8K support
        'sidebar_width'           => 215,  // Original sidebar
        'layout_type'             => 'fluid', // fluid or fixed

        // Typography (Inter font for accessibility + tech aesthetic)
        'font_family'             => "'Inter', Tahoma, Arial, sans-serif",
        'font_size_base'          => 13,   // Optimized for Inter at screen sizes
        'line_height'             => 1.6,

        // Security
        'enable_csp'              => true,
        'strict_escaping'         => true,
        'disable_file_edit'       => true,
        'security_headers'        => true,

        // Background & Styling (from actual TCTD site)
        'background_image'        => '',  // Path to background image
        'background_repeat'       => 'no-repeat',
        'background_position'     => 'top center',
        'background_attachment'   => 'scroll',

        // Performance
        'enable_lazy_load'        => true,
        'enable_webp'             => true,
        'minify_css'              => true,
        'minify_js'               => true,

        // Footer (from actual TCTD site)
        'footer_text'             => 'Copyright © ' . date('Y') . ' True Chip Till Death - All Rights Reserved',
        'footer_background'       => '1b1b1b',
        'footer_text_color'       => '999999',
        'footer_link_color'       => '777777',
        'footer_link_hover_color' => '333333',
        'show_wordpress_credit'   => false,

        // Widget Styling (from actual TCTD site)
        'widget_title_color'      => 'FFFF00',
        'widget_title_size'       => '12px',
        'widget_title_transform'  => 'uppercase',
        'widget_link_color'       => '999999',
        'widget_link_hover_color' => 'FFFFFF',
        'widget_link_weight'      => 'normal',
        'widget_border_color'     => 'FFFF00',

        // Sidebar Styling (from actual TCTD site)
        'sidebar_background'      => '000000',
        'sidebar_padding'         => '10px',

        // Post/Content Styling (from actual TCTD site)
        'content_background'      => '000000',
        'content_text_color'      => 'FFFFFF',
        'content_padding'         => '15px',
        'post_title_color'        => 'FFFF00',
        'post_title_hover_color'  => 'FFFFFF',
        'post_meta_color'         => 'CCCCCC',
        'post_border_color'       => '999999',

        // Menu/Navigation (from actual TCTD site)
        'menu_background'         => '333333',
        'menu_background_hover'   => '666666',
        'menu_link_color'         => 'FFFF00',
        'menu_link_hover_color'   => 'FDFDFD',
        'menu_border_color'       => 'FFFF66',
        'menu_text_transform'     => 'uppercase',
        'menu_font_size'          => '11px',

        // Accessibility
        'enable_skip_links'       => true,
        'high_contrast_mode'      => false,
        'focus_indicators'        => true,

        // Block Editor
        'enable_block_styles'     => true,
        'enable_wide_blocks'      => true,
        'enable_responsive_embeds' => true,

        // Version tracking
        'theme_version'           => ATAHUALPA_TCTD_VERSION,
        'last_updated'            => current_time( 'mysql' ),
    );
}

/**
 * Initialize theme defaults on activation
 */
function atahualpa_tctd_setup() {
    // Load text domain
    load_theme_textdomain( 'atahualpa-tctd', ATAHUALPA_TCTD_DIR . '/languages' );

    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Set content width (from TCTD settings)
    $GLOBALS['content_width'] = 900;

    // Register navigation menus
    register_nav_menus( array(
        'primary'   => esc_html__( 'Primary Menu', 'atahualpa-tctd' ),
        'footer'    => esc_html__( 'Footer Menu', 'atahualpa-tctd' ),
        'social'    => esc_html__( 'Social Links', 'atahualpa-tctd' ),
    ) );

    // Get or set default options
    $options = get_option( 'atahualpa_tctd_options' );
    if ( false === $options ) {
        update_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );
    }
}
add_action( 'after_setup_theme', 'atahualpa_tctd_setup' );

/**
 * Register widget areas
 */
function atahualpa_tctd_widgets_init() {
    // Left Sidebar (for News, Recent Posts, etc.)
    register_sidebar( array(
        'name'          => esc_html__( 'Left Sidebar', 'atahualpa-tctd' ),
        'id'            => 'sidebar-left',
        'description'   => esc_html__( 'Left sidebar widget area (215px wide)', 'atahualpa-tctd' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Right Sidebar (for Follow Us, Social Media, etc.)
    register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar', 'atahualpa-tctd' ),
        'id'            => 'sidebar-right',
        'description'   => esc_html__( 'Right sidebar widget area (215px wide)', 'atahualpa-tctd' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    // Footer Widgets
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widgets', 'atahualpa-tctd' ),
        'id'            => 'sidebar-footer',
        'description'   => esc_html__( 'Footer widget area', 'atahualpa-tctd' ),
        'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'atahualpa_tctd_widgets_init' );

/**
 * Enqueue styles and scripts
 */
function atahualpa_tctd_scripts() {
    $options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );

    // Inter font from official rsms/inter CDN
    wp_enqueue_style(
        'inter-font',
        'https://rsms.me/inter/inter.css',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'atahualpa-tctd-style',
        get_stylesheet_uri(),
        array( 'inter-font' ),
        ATAHUALPA_TCTD_VERSION
    );

    // Dynamic styles based on theme options
    wp_enqueue_style(
        'atahualpa-tctd-dynamic',
        add_query_arg( 'atahualpa_tctd_dynamic_css', '1', home_url( '/' ) ),
        array( 'atahualpa-tctd-style' ),
        ATAHUALPA_TCTD_VERSION . '-' . get_option( 'atahualpa_tctd_options_hash', time() )
    );

    // Block editor styles
    if ( $options['enable_block_styles'] ) {
        wp_enqueue_style(
            'atahualpa-tctd-block-style',
            ATAHUALPA_TCTD_URI . '/assets/css/blocks.css',
            array( 'wp-block-library' ),
            ATAHUALPA_TCTD_VERSION
        );
    }

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Theme JavaScript
    wp_enqueue_script(
        'atahualpa-tctd-script',
        ATAHUALPA_TCTD_URI . '/assets/js/theme.js',
        array(),
        ATAHUALPA_TCTD_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'atahualpa_tctd_scripts' );

/**
 * Serve dynamic CSS
 */
function atahualpa_tctd_serve_dynamic_css() {
    if ( isset( $_GET['atahualpa_tctd_dynamic_css'] ) ) {
        require_once ATAHUALPA_TCTD_DIR . '/assets/css/dynamic-styles.php';
        exit;
    }
}
add_action( 'template_redirect', 'atahualpa_tctd_serve_dynamic_css' );

/**
 * Security: Add security headers
 */
function atahualpa_tctd_security_headers() {
    $options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );

    if ( ! $options['security_headers'] ) {
        return;
    }

    // Content Security Policy
    if ( $options['enable_csp'] ) {
        header( "Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'self';" );
    }

    // Additional security headers
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
}
add_action( 'send_headers', 'atahualpa_tctd_security_headers' );

/**
 * Security: Remove WordPress version from head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Security: Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Security: Remove REST API links from head for non-authenticated users
 */
function atahualpa_tctd_remove_rest_api_links() {
    if ( ! is_user_logged_in() ) {
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'template_redirect', 'rest_output_link_header', 11 );
    }
}
add_action( 'after_setup_theme', 'atahualpa_tctd_remove_rest_api_links' );

/**
 * Accessibility: Add skip link
 */
function atahualpa_tctd_skip_link() {
    $options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );

    if ( ! $options['enable_skip_links'] ) {
        return;
    }

    echo '<a class="skip-link screen-reader-text" href="#main-content">' .
         esc_html__( 'Skip to content', 'atahualpa-tctd' ) .
         '</a>';
}
add_action( 'wp_body_open', 'atahualpa_tctd_skip_link' );

/**
 * Security: Sanitize and escape helper functions
 */
require_once ATAHUALPA_TCTD_DIR . '/inc/security.php';

/**
 * Theme options and customizer
 */
require_once ATAHUALPA_TCTD_DIR . '/inc/customizer.php';

/**
 * Template tags
 */
require_once ATAHUALPA_TCTD_DIR . '/inc/template-tags.php';

/**
 * Admin functions
 */
if ( is_admin() ) {
    require_once ATAHUALPA_TCTD_DIR . '/inc/admin.php';
}

/**
 * Reset to TCTD defaults function
 */
function atahualpa_tctd_reset_to_defaults() {
    check_ajax_referer( 'atahualpa_tctd_reset', 'security' );

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized' ) );
    }

    $defaults = atahualpa_tctd_get_defaults();
    update_option( 'atahualpa_tctd_options', $defaults );

    wp_send_json_success( array(
        'message' => 'Theme reset to TCTD defaults successfully.',
        'defaults' => $defaults
    ) );
}
add_action( 'wp_ajax_atahualpa_tctd_reset', 'atahualpa_tctd_reset_to_defaults' );

/**
 * Block editor support
 */
function atahualpa_tctd_editor_styles() {
    add_editor_style( 'assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'atahualpa_tctd_editor_styles' );

/**
 * Custom excerpt length
 */
function atahualpa_tctd_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'atahualpa_tctd_excerpt_length' );

/**
 * Custom excerpt more
 */
function atahualpa_tctd_excerpt_more( $more ) {
    return '&hellip; <a class="read-more" href="' . esc_url( get_permalink() ) . '">' .
           esc_html__( 'Read more', 'atahualpa-tctd' ) . '</a>';
}
add_filter( 'excerpt_more', 'atahualpa_tctd_excerpt_more' );

/**
 * Body classes for layout customization
 */
function atahualpa_tctd_body_classes( $classes ) {
    $options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );

    if ( $options['layout_type'] === 'fluid' ) {
        $classes[] = 'layout-fluid';
    } else {
        $classes[] = 'layout-fixed';
    }

    // Three-column layout classes
    $has_left = is_active_sidebar( 'sidebar-left' );
    $has_right = is_active_sidebar( 'sidebar-right' );

    if ( $has_left && $has_right ) {
        $classes[] = 'layout-three-column';
    } elseif ( $has_left || $has_right ) {
        $classes[] = 'layout-two-column';
        $classes[] = $has_left ? 'has-left-sidebar' : 'has-right-sidebar';
    } else {
        $classes[] = 'layout-one-column';
    }

    if ( $options['high_contrast_mode'] ) {
        $classes[] = 'high-contrast';
    }

    return $classes;
}
add_filter( 'body_class', 'atahualpa_tctd_body_classes' );

/**
 * Admin notice for successful theme activation
 */
function atahualpa_tctd_activation_notice() {
    $screen = get_current_screen();
    if ( 'themes' !== $screen->base ) {
        return;
    }

    $options = get_option( 'atahualpa_tctd_options' );
    if ( false === $options ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <strong><?php esc_html_e( 'Atahualpa TCTD Edition activated!', 'atahualpa-tctd' ); ?></strong>
                <?php esc_html_e( 'TCTD default settings have been applied. Visit the Customizer to personalize your site.', 'atahualpa-tctd' ); ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'atahualpa_tctd_activation_notice' );
