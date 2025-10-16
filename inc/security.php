<?php
/**
 * Security Functions
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sanitize hex color
 *
 * @param string $color Hex color code
 * @return string Sanitized hex color
 */
function atahualpa_tctd_sanitize_hex_color( $color ) {
    if ( '' === $color ) {
        return '';
    }

    // Remove # if present
    $color = ltrim( $color, '#' );

    // Validate hex color
    if ( preg_match( '/^[a-fA-F0-9]{6}$/', $color ) ) {
        return $color;
    }

    return '';
}

/**
 * Sanitize integer with min/max bounds
 *
 * @param int $value Value to sanitize
 * @param int $min Minimum value
 * @param int $max Maximum value
 * @return int Sanitized integer
 */
function atahualpa_tctd_sanitize_int_range( $value, $min = 0, $max = PHP_INT_MAX ) {
    $value = absint( $value );
    return max( $min, min( $max, $value ) );
}

/**
 * Sanitize CSS value
 *
 * @param string $value CSS value
 * @return string Sanitized CSS
 */
function atahualpa_tctd_sanitize_css( $value ) {
    // Remove potentially dangerous CSS
    $value = preg_replace( '/javascript\s*:/i', '', $value );
    $value = preg_replace( '/expression\s*\(/i', '', $value );
    $value = preg_replace( '/import\s+/i', '', $value );
    $value = preg_replace( '/@import/i', '', $value );

    return wp_strip_all_tags( $value );
}

/**
 * Validate and sanitize URL with allowed protocols
 *
 * @param string $url URL to validate
 * @return string Sanitized URL or empty string
 */
function atahualpa_tctd_sanitize_url( $url ) {
    $url = esc_url_raw( $url );

    // Only allow http, https, mailto
    $allowed_protocols = array( 'http', 'https', 'mailto' );
    if ( ! in_array( parse_url( $url, PHP_URL_SCHEME ), $allowed_protocols, true ) ) {
        return '';
    }

    return $url;
}

/**
 * Verify nonce with better error handling
 *
 * @param string $action Action name
 * @param string $nonce_field Nonce field name
 * @return bool True if valid
 */
function atahualpa_tctd_verify_nonce( $action, $nonce_field = '_wpnonce' ) {
    if ( ! isset( $_REQUEST[ $nonce_field ] ) ) {
        return false;
    }

    return wp_verify_nonce(
        sanitize_text_field( wp_unslash( $_REQUEST[ $nonce_field ] ) ),
        $action
    );
}

/**
 * Secure database query wrapper
 *
 * @param string $query SQL query with placeholders
 * @param mixed ...$args Values to bind
 * @return string|null Prepared query or null on error
 */
function atahualpa_tctd_prepare_query( $query, ...$args ) {
    global $wpdb;

    if ( empty( $args ) ) {
        return $query;
    }

    // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
    return $wpdb->prepare( $query, ...$args );
}

/**
 * Safe file upload handler
 *
 * @param array $file $_FILES array element
 * @param array $allowed_types Allowed MIME types
 * @param int $max_size Maximum file size in bytes
 * @return array|WP_Error File info or error
 */
function atahualpa_tctd_handle_upload( $file, $allowed_types = array(), $max_size = 2097152 ) {
    // Check if file was uploaded
    if ( ! isset( $file['tmp_name'] ) || ! is_uploaded_file( $file['tmp_name'] ) ) {
        return new WP_Error( 'upload_error', __( 'File upload failed.', 'atahualpa-tctd' ) );
    }

    // Check file size
    if ( $file['size'] > $max_size ) {
        return new WP_Error(
            'file_too_large',
            sprintf(
                /* translators: %s: Maximum file size */
                __( 'File size exceeds maximum of %s.', 'atahualpa-tctd' ),
                size_format( $max_size )
            )
        );
    }

    // Validate MIME type
    $file_type = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'] );

    if ( ! empty( $allowed_types ) && ! in_array( $file_type['type'], $allowed_types, true ) ) {
        return new WP_Error(
            'invalid_file_type',
            __( 'File type not allowed.', 'atahualpa-tctd' )
        );
    }

    return array(
        'file'     => $file['tmp_name'],
        'name'     => sanitize_file_name( $file['name'] ),
        'type'     => $file_type['type'],
        'ext'      => $file_type['ext'],
        'size'     => $file['size'],
    );
}

/**
 * Sanitize HTML with allowed tags
 *
 * @param string $html HTML content
 * @return string Sanitized HTML
 */
function atahualpa_tctd_sanitize_html( $html ) {
    $allowed_tags = array(
        'a'      => array(
            'href'   => array(),
            'title'  => array(),
            'target' => array(),
            'rel'    => array(),
        ),
        'br'     => array(),
        'em'     => array(),
        'strong' => array(),
        'p'      => array(),
        'ul'     => array(),
        'ol'     => array(),
        'li'     => array(),
        'h1'     => array(),
        'h2'     => array(),
        'h3'     => array(),
        'h4'     => array(),
        'h5'     => array(),
        'h6'     => array(),
    );

    return wp_kses( $html, $allowed_tags );
}

/**
 * Rate limit check for actions (simple implementation)
 *
 * @param string $action Action identifier
 * @param int $max_attempts Maximum attempts
 * @param int $timeframe Timeframe in seconds
 * @return bool True if within limits
 */
function atahualpa_tctd_rate_limit_check( $action, $max_attempts = 5, $timeframe = 300 ) {
    $user_ip = atahualpa_tctd_get_user_ip();
    $transient_key = 'rate_limit_' . md5( $action . $user_ip );

    $attempts = get_transient( $transient_key );

    if ( false === $attempts ) {
        set_transient( $transient_key, 1, $timeframe );
        return true;
    }

    if ( $attempts >= $max_attempts ) {
        return false;
    }

    set_transient( $transient_key, $attempts + 1, $timeframe );
    return true;
}

/**
 * Get user IP address safely
 *
 * @return string IP address
 */
function atahualpa_tctd_get_user_ip() {
    $ip = '';

    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) );
    } elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
    }

    return filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '0.0.0.0';
}

/**
 * Log security events
 *
 * @param string $event Event type
 * @param array $data Event data
 * @return bool Success
 */
function atahualpa_tctd_log_security_event( $event, $data = array() ) {
    if ( ! WP_DEBUG_LOG ) {
        return false;
    }

    $log_entry = array(
        'timestamp' => current_time( 'mysql' ),
        'event'     => $event,
        'user_id'   => get_current_user_id(),
        'ip'        => atahualpa_tctd_get_user_ip(),
        'data'      => $data,
    );

    // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
    error_log( 'ATAHUALPA_TCTD_SECURITY: ' . wp_json_encode( $log_entry ) );

    return true;
}

/**
 * Sanitize array recursively
 *
 * @param array $array Array to sanitize
 * @return array Sanitized array
 */
function atahualpa_tctd_sanitize_array( $array ) {
    if ( ! is_array( $array ) ) {
        return array();
    }

    foreach ( $array as $key => $value ) {
        if ( is_array( $value ) ) {
            $array[ $key ] = atahualpa_tctd_sanitize_array( $value );
        } else {
            $array[ $key ] = sanitize_text_field( $value );
        }
    }

    return $array;
}
