<?php
/**
 * Admin Functions
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add admin menu for TCTD settings
 */
function atahualpa_tctd_admin_menu() {
    add_theme_page(
        esc_html__( 'TCTD Theme Settings', 'atahualpa-tctd' ),
        esc_html__( 'TCTD Settings', 'atahualpa-tctd' ),
        'manage_options',
        'atahualpa-tctd-settings',
        'atahualpa_tctd_settings_page'
    );
}
add_action( 'admin_menu', 'atahualpa_tctd_admin_menu' );

/**
 * Render settings page
 */
function atahualpa_tctd_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'atahualpa-tctd' ) );
    }

    $options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <div class="notice notice-info">
            <p>
                <strong><?php esc_html_e( 'Atahualpa TCTD Edition', 'atahualpa-tctd' ); ?></strong> -
                <?php esc_html_e( 'Version', 'atahualpa-tctd' ); ?>: <?php echo esc_html( ATAHUALPA_TCTD_VERSION ); ?>
            </p>
            <p><?php esc_html_e( 'Security-hardened fork optimized for TCTD properties with 8K display support.', 'atahualpa-tctd' ); ?></p>
        </div>

        <div class="card">
            <h2><?php esc_html_e( 'Quick Actions', 'atahualpa-tctd' ); ?></h2>
            <p>
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
                    <?php esc_html_e( 'Open Customizer', 'atahualpa-tctd' ); ?>
                </a>
                <button type="button" class="button" id="reset-to-tctd-defaults">
                    <?php esc_html_e( 'Reset to TCTD Defaults', 'atahualpa-tctd' ); ?>
                </button>
            </p>
        </div>

        <div class="card">
            <h2><?php esc_html_e( 'Current Configuration', 'atahualpa-tctd' ); ?></h2>
            <table class="widefat">
                <tbody>
                    <tr>
                        <th><?php esc_html_e( 'Content Width', 'atahualpa-tctd' ); ?></th>
                        <td><?php echo esc_html( $options['content_width'] ); ?>px</td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Wide Width (8K Support)', 'atahualpa-tctd' ); ?></th>
                        <td><?php echo esc_html( $options['wide_width'] ); ?>px</td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Layout Type', 'atahualpa-tctd' ); ?></th>
                        <td><?php echo esc_html( ucfirst( $options['layout_type'] ) ); ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'Security Headers', 'atahualpa-tctd' ); ?></th>
                        <td><?php echo $options['security_headers'] ? '<span style="color:green;">&#10004; Enabled</span>' : '<span style="color:red;">&#10008; Disabled</span>'; ?></td>
                    </tr>
                    <tr>
                        <th><?php esc_html_e( 'CSP Protection', 'atahualpa-tctd' ); ?></th>
                        <td><?php echo $options['enable_csp'] ? '<span style="color:green;">&#10004; Enabled</span>' : '<span style="color:red;">&#10008; Disabled</span>'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2><?php esc_html_e( 'Security Features', 'atahualpa-tctd' ); ?></h2>
            <ul>
                <li>&#10004; <?php esc_html_e( 'SQL Injection Protection', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'XSS Prevention', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'CSRF Token Validation', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'Output Escaping', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'Security Headers', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'File Upload Validation', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'Rate Limiting', 'atahualpa-tctd' ); ?></li>
            </ul>
        </div>

        <div class="card">
            <h2><?php esc_html_e( 'Display Features', 'atahualpa-tctd' ); ?></h2>
            <ul>
                <li>&#10004; <?php esc_html_e( 'Responsive Design (320px - 7680px)', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( '8K Ultra-Wide Display Support', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'High DPI / Retina Optimization', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'Block Editor (Gutenberg) Support', 'atahualpa-tctd' ); ?></li>
                <li>&#10004; <?php esc_html_e( 'Accessibility Ready (WCAG 2.1)', 'atahualpa-tctd' ); ?></li>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#reset-to-tctd-defaults').on('click', function() {
            if (!confirm('<?php echo esc_js( __( 'Are you sure you want to reset all theme settings to TCTD defaults? This cannot be undone.', 'atahualpa-tctd' ) ); ?>')) {
                return;
            }

            var button = $(this);
            button.prop('disabled', true).text('<?php echo esc_js( __( 'Resetting...', 'atahualpa-tctd' ) ); ?>');

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'atahualpa_tctd_reset',
                    security: '<?php echo esc_js( wp_create_nonce( 'atahualpa_tctd_reset' ) ); ?>'
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.data.message);
                        location.reload();
                    } else {
                        alert('<?php echo esc_js( __( 'Reset failed. Please try again.', 'atahualpa-tctd' ) ); ?>');
                        button.prop('disabled', false).text('<?php echo esc_js( __( 'Reset to TCTD Defaults', 'atahualpa-tctd' ) ); ?>');
                    }
                },
                error: function() {
                    alert('<?php echo esc_js( __( 'An error occurred. Please try again.', 'atahualpa-tctd' ) ); ?>');
                    button.prop('disabled', false).text('<?php echo esc_js( __( 'Reset to TCTD Defaults', 'atahualpa-tctd' ) ); ?>');
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * Add admin notices
 */
function atahualpa_tctd_admin_notices() {
    $screen = get_current_screen();

    // Check for minimum requirements
    if ( version_compare( PHP_VERSION, ATAHUALPA_TCTD_MIN_PHP, '<' ) ) {
        ?>
        <div class="notice notice-error">
            <p>
                <strong><?php esc_html_e( 'Atahualpa TCTD Edition:', 'atahualpa-tctd' ); ?></strong>
                <?php
                printf(
                    /* translators: 1: Current PHP version, 2: Required PHP version */
                    esc_html__( 'Your PHP version (%1$s) is outdated. This theme requires PHP %2$s or higher for security features.', 'atahualpa-tctd' ),
                    esc_html( PHP_VERSION ),
                    esc_html( ATAHUALPA_TCTD_MIN_PHP )
                );
                ?>
            </p>
        </div>
        <?php
    }

    if ( version_compare( get_bloginfo( 'version' ), ATAHUALPA_TCTD_MIN_WP, '<' ) ) {
        ?>
        <div class="notice notice-error">
            <p>
                <strong><?php esc_html_e( 'Atahualpa TCTD Edition:', 'atahualpa-tctd' ); ?></strong>
                <?php
                printf(
                    /* translators: 1: Current WP version, 2: Required WP version */
                    esc_html__( 'Your WordPress version (%1$s) is outdated. This theme requires WordPress %2$s or higher.', 'atahualpa-tctd' ),
                    esc_html( get_bloginfo( 'version' ) ),
                    esc_html( ATAHUALPA_TCTD_MIN_WP )
                );
                ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'atahualpa_tctd_admin_notices' );

/**
 * Add theme meta box to dashboard
 */
function atahualpa_tctd_dashboard_widget() {
    wp_add_dashboard_widget(
        'atahualpa_tctd_dashboard',
        esc_html__( 'TCTD Theme Info', 'atahualpa-tctd' ),
        'atahualpa_tctd_dashboard_widget_content'
    );
}
add_action( 'wp_dashboard_setup', 'atahualpa_tctd_dashboard_widget' );

/**
 * Dashboard widget content
 */
function atahualpa_tctd_dashboard_widget_content() {
    ?>
    <div class="activity-block">
        <h3><?php esc_html_e( 'Atahualpa TCTD Edition', 'atahualpa-tctd' ); ?></h3>
        <p><?php echo esc_html( sprintf( __( 'Version %s', 'atahualpa-tctd' ), ATAHUALPA_TCTD_VERSION ) ); ?></p>
        <p><?php esc_html_e( 'Security-hardened theme with 8K display support.', 'atahualpa-tctd' ); ?></p>
        <ul>
            <li><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Customize Theme', 'atahualpa-tctd' ); ?></a></li>
            <li><a href="<?php echo esc_url( admin_url( 'themes.php?page=atahualpa-tctd-settings' ) ); ?>"><?php esc_html_e( 'TCTD Settings', 'atahualpa-tctd' ); ?></a></li>
            <li><a href="https://truechiptilldeath.com" target="_blank" rel="noopener"><?php esc_html_e( 'Visit TCTD', 'atahualpa-tctd' ); ?></a></li>
        </ul>
    </div>
    <?php
}
