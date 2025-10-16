<?php
/**
 * Dynamic CSS Generator
 *
 * Generates CSS based on theme options
 *
 * @package Atahualpa_TCTD
 * @since 4.0.1
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get theme options
$options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );

// Set content type
header( 'Content-Type: text/css; charset=UTF-8' );

?>
/* ------------------------------------------------------------------
   Dynamic TCTD Styles - Generated from Theme Options
   Generated: <?php echo esc_html( current_time( 'mysql' ) ); ?>
------------------------------------------------------------------ */

/* Background Image Support for Large Displays */
body {
<?php if ( ! empty( $options['background_image'] ) ) : ?>
    background-image: url(<?php echo esc_url( $options['background_image'] ); ?>);
    background-repeat: <?php echo esc_attr( $options['background_repeat'] ); ?>;
    background-position: <?php echo esc_attr( $options['background_position'] ); ?>;
    background-attachment: <?php echo esc_attr( $options['background_attachment'] ); ?>;
    background-color: #<?php echo esc_attr( $options['background_color'] ); ?>;
<?php endif; ?>
}

/* Responsive Background Scaling */
@media (min-width: 1920px) {
    body {
        background-size: contain;
    }
}

@media (min-width: 3840px) {
    /* 4K - Scale background proportionally */
    body {
        background-size: 100% auto;
    }
}

@media (min-width: 7680px) {
    /* 8K - Full background coverage */
    body {
        background-size: cover;
    }
}

/* Footer Styling */
.site-footer {
    background-color: #<?php echo esc_attr( $options['footer_background'] ); ?>;
    color: #<?php echo esc_attr( $options['footer_text_color'] ); ?>;
}

.site-footer a {
    color: #<?php echo esc_attr( $options['footer_link_color'] ); ?>;
}

.site-footer a:hover {
    color: #<?php echo esc_attr( $options['footer_link_hover_color'] ); ?>;
}

/* Widget Styling */
.widget-title,
.widget-title h3 {
    color: #<?php echo esc_attr( $options['widget_title_color'] ?? 'FFFF00' ); ?>;
    font-size: <?php echo esc_attr( $options['widget_title_size'] ?? '12px' ); ?>;
    text-transform: <?php echo esc_attr( $options['widget_title_transform'] ?? 'uppercase' ); ?>;
    font-weight: bold;
}

.widget a {
    color: #<?php echo esc_attr( $options['widget_link_color'] ?? '999999' ); ?>;
    font-weight: <?php echo esc_attr( $options['widget_link_weight'] ?? 'normal' ); ?>;
}

.widget a:hover {
    color: #<?php echo esc_attr( $options['widget_link_hover_color'] ?? 'FFFFFF' ); ?>;
}

.widget {
    border-color: #<?php echo esc_attr( $options['widget_border_color'] ?? 'FFFF00' ); ?>;
}

/* Sidebar Styling */
.widget-area {
    background: #<?php echo esc_attr( $options['sidebar_background'] ?? '000000' ); ?>;
    padding: <?php echo esc_attr( $options['sidebar_padding'] ?? '10px' ); ?>;
}

/* Content Area Styling */
.site-main {
    background: #<?php echo esc_attr( $options['content_background'] ?? '000000' ); ?>;
    color: #<?php echo esc_attr( $options['content_text_color'] ?? 'FFFFFF' ); ?>;
    padding: <?php echo esc_attr( $options['content_padding'] ?? '15px' ); ?>;
}

/* Post Title Styling */
.entry-title,
.entry-title a {
    color: #<?php echo esc_attr( $options['post_title_color'] ?? 'FFFF00' ); ?>;
}

.entry-title a:hover {
    color: #<?php echo esc_attr( $options['post_title_hover_color'] ?? 'FFFFFF' ); ?>;
}

/* Post Meta Styling */
.entry-meta {
    color: #<?php echo esc_attr( $options['post_meta_color'] ?? 'CCCCCC' ); ?>;
}

/* Post Borders */
article.post,
article.page {
    border-color: #<?php echo esc_attr( $options['post_border_color'] ?? '999999' ); ?>;
}

/* Navigation Menu Styling */
.main-navigation {
    background: #<?php echo esc_attr( $options['menu_background'] ?? '333333' ); ?>;
}

.main-navigation a {
    color: #<?php echo esc_attr( $options['menu_link_color'] ?? 'FFFF00' ); ?>;
    font-size: <?php echo esc_attr( $options['menu_font_size'] ?? '11px' ); ?>;
    text-transform: <?php echo esc_attr( $options['menu_text_transform'] ?? 'uppercase' ); ?>;
}

.main-navigation a:hover,
.main-navigation a:focus,
.main-navigation .current-menu-item > a {
    background: #<?php echo esc_attr( $options['menu_background_hover'] ?? '666666' ); ?>;
    color: #<?php echo esc_attr( $options['menu_link_hover_color'] ?? 'FDFDFD' ); ?>;
}

.main-navigation li {
    border-color: #<?php echo esc_attr( $options['menu_border_color'] ?? 'FFFF66' ); ?>;
}

/* Ultra-Wide Display Optimizations */
@media (min-width: 2560px) {
    /* 1440p+ displays */
    .site-container {
        max-width: <?php echo esc_attr( $options['content_max_width'] ?? 1250 ); ?>px;
    }
}

@media (min-width: 3840px) {
    /* 4K displays - increase comfortable reading width */
    :root {
        --content-width: <?php echo esc_attr( min( $options['content_max_width'] * 1.5, 1920 ) ); ?>px;
    }

    .site-main {
        font-size: 1.1em;
    }
}

@media (min-width: 7680px) {
    /* 8K displays - multi-column layout */
    :root {
        --content-width: 2400px;
    }

    .site-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(1200px, 1fr));
        gap: 3rem;
        max-width: 7680px;
    }

    .site-main {
        font-size: 1.25em;
    }

    /* Scale up UI elements for 8K */
    .widget-title {
        font-size: 1.5em;
    }

    .main-navigation a {
        font-size: 1.2em;
        padding: 1.5em 2em;
    }
}

/* High DPI / Retina Support */
@media (-webkit-min-device-pixel-ratio: 2),
       (min-resolution: 192dpi) {
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
}

/* Print Styles */
@media print {
    body {
        background: white !important;
        color: black !important;
    }

    .site-header,
    .site-footer,
    .widget-area,
    .main-navigation {
        display: none !important;
    }
}
