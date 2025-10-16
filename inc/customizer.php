<?php
/**
 * Theme Customizer
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function atahualpa_tctd_customize_register( $wp_customize ) {
    $defaults = atahualpa_tctd_get_defaults();

    // Add TCTD panel
    $wp_customize->add_panel( 'atahualpa_tctd', array(
        'title'       => esc_html__( 'TCTD Theme Options', 'atahualpa-tctd' ),
        'description' => esc_html__( 'Customize your TCTD theme settings', 'atahualpa-tctd' ),
        'priority'    => 10,
    ) );

    // Colors Section
    $wp_customize->add_section( 'atahualpa_tctd_colors', array(
        'title'    => esc_html__( 'TCTD Colors', 'atahualpa-tctd' ),
        'panel'    => 'atahualpa_tctd',
        'priority' => 10,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'atahualpa_tctd_primary_color', array(
        'default'           => $defaults['primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atahualpa_tctd_primary_color', array(
        'label'    => esc_html__( 'Primary Color', 'atahualpa-tctd' ),
        'section'  => 'atahualpa_tctd_colors',
        'settings' => 'atahualpa_tctd_primary_color',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'atahualpa_tctd_accent_color', array(
        'default'           => $defaults['accent_color'],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atahualpa_tctd_accent_color', array(
        'label'    => esc_html__( 'Accent Color', 'atahualpa-tctd' ),
        'section'  => 'atahualpa_tctd_colors',
        'settings' => 'atahualpa_tctd_accent_color',
    ) ) );

    // Layout Section
    $wp_customize->add_section( 'atahualpa_tctd_layout', array(
        'title'    => esc_html__( 'Layout', 'atahualpa-tctd' ),
        'panel'    => 'atahualpa_tctd',
        'priority' => 20,
    ) );

    // Layout Type
    $wp_customize->add_setting( 'atahualpa_tctd_layout_type', array(
        'default'           => $defaults['layout_type'],
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'atahualpa_tctd_layout_type', array(
        'label'    => esc_html__( 'Layout Type', 'atahualpa-tctd' ),
        'section'  => 'atahualpa_tctd_layout',
        'settings' => 'atahualpa_tctd_layout_type',
        'type'     => 'radio',
        'choices'  => array(
            'fluid' => esc_html__( 'Fluid (Responsive)', 'atahualpa-tctd' ),
            'fixed' => esc_html__( 'Fixed Width', 'atahualpa-tctd' ),
        ),
    ) );

    // Footer Section
    $wp_customize->add_section( 'atahualpa_tctd_footer', array(
        'title'    => esc_html__( 'Footer Settings', 'atahualpa-tctd' ),
        'panel'    => 'atahualpa_tctd',
        'priority' => 30,
    ) );

    // Footer Text
    $wp_customize->add_setting( 'atahualpa_tctd_footer_text', array(
        'default'           => $defaults['footer_text'],
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'atahualpa_tctd_footer_text', array(
        'label'    => esc_html__( 'Footer Text', 'atahualpa-tctd' ),
        'section'  => 'atahualpa_tctd_footer',
        'settings' => 'atahualpa_tctd_footer_text',
        'type'     => 'textarea',
    ) );

    // Show WordPress Credit
    $wp_customize->add_setting( 'atahualpa_tctd_show_wp_credit', array(
        'default'           => $defaults['show_wordpress_credit'],
        'sanitize_callback' => 'rest_sanitize_boolean',
    ) );

    $wp_customize->add_control( 'atahualpa_tctd_show_wp_credit', array(
        'label'    => esc_html__( 'Show WordPress Credit', 'atahualpa-tctd' ),
        'section'  => 'atahualpa_tctd_footer',
        'settings' => 'atahualpa_tctd_show_wp_credit',
        'type'     => 'checkbox',
    ) );

    // Security Section
    $wp_customize->add_section( 'atahualpa_tctd_security', array(
        'title'       => esc_html__( 'Security Settings', 'atahualpa-tctd' ),
        'panel'       => 'atahualpa_tctd',
        'priority'    => 40,
        'description' => esc_html__( 'Advanced security options', 'atahualpa-tctd' ),
    ) );

    // Enable Security Headers
    $wp_customize->add_setting( 'atahualpa_tctd_security_headers', array(
        'default'           => $defaults['security_headers'],
        'sanitize_callback' => 'rest_sanitize_boolean',
    ) );

    $wp_customize->add_control( 'atahualpa_tctd_security_headers', array(
        'label'       => esc_html__( 'Enable Security Headers', 'atahualpa-tctd' ),
        'description' => esc_html__( 'Adds CSP, X-Frame-Options, and other security headers', 'atahualpa-tctd' ),
        'section'     => 'atahualpa_tctd_security',
        'settings'    => 'atahualpa_tctd_security_headers',
        'type'        => 'checkbox',
    ) );
}
add_action( 'customize_register', 'atahualpa_tctd_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function atahualpa_tctd_customize_preview_js() {
    wp_enqueue_script(
        'atahualpa-tctd-customizer',
        ATAHUALPA_TCTD_URI . '/assets/js/customizer.js',
        array( 'customize-preview' ),
        ATAHUALPA_TCTD_VERSION,
        true
    );
}
add_action( 'customize_preview_init', 'atahualpa_tctd_customize_preview_js' );
