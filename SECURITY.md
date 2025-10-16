# Security Policy - Atahualpa TCTD Edition

## Overview

Atahualpa TCTD Edition is a security-hardened WordPress theme built from the ground up with enterprise-grade security features. This document outlines our security practices, implemented protections, and disclosure policy.

## Implemented Security Features

### 1. SQL Injection Protection
- ✅ All database queries use `$wpdb->prepare()` with parameterized statements
- ✅ No direct concatenation of user input into SQL queries
- ✅ Custom security wrapper function: `atahualpa_tctd_prepare_query()`

**Example:**
```php
$sql = $wpdb->prepare(
    "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value = %s",
    $meta_key,
    $meta_value
);
```

### 2. Cross-Site Scripting (XSS) Prevention
- ✅ All output escaped with appropriate WordPress functions
- ✅ `esc_html()` for plain text
- ✅ `esc_attr()` for HTML attributes
- ✅ `esc_url()` for URLs
- ✅ `wp_kses_post()` for allowed HTML

**Example:**
```php
echo '<a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a>';
```

### 3. Cross-Site Request Forgery (CSRF) Protection
- ✅ Nonce validation for all forms and AJAX requests
- ✅ Custom nonce verification wrapper: `atahualpa_tctd_verify_nonce()`
- ✅ Nonces expire after 12 hours by default

**Example:**
```php
check_ajax_referer( 'atahualpa_tctd_reset', 'security' );
```

### 4. Security Headers
Automatically added via `atahualpa_tctd_security_headers()`:

- **Content-Security-Policy:** Restricts resource loading
- **X-Content-Type-Options:** `nosniff` - Prevents MIME type sniffing
- **X-Frame-Options:** `SAMEORIGIN` - Prevents clickjacking
- **X-XSS-Protection:** `1; mode=block` - Browser XSS filter
- **Referrer-Policy:** `strict-origin-when-cross-origin` - Controls referrer information
- **Permissions-Policy:** Restricts browser features (geolocation, camera, microphone)

### 5. File Upload Security
Custom handler: `atahualpa_tctd_handle_upload()`

- ✅ MIME type validation using `wp_check_filetype_and_ext()`
- ✅ File size limits (default: 2MB)
- ✅ Filename sanitization
- ✅ Upload directory permissions check
- ✅ Whitelist of allowed file types

**Example:**
```php
$result = atahualpa_tctd_handle_upload(
    $_FILES['userfile'],
    array( 'image/jpeg', 'image/png' ),
    2097152 // 2MB
);
```

### 6. Rate Limiting
Function: `atahualpa_tctd_rate_limit_check()`

- ✅ IP-based rate limiting
- ✅ Configurable attempt limits and timeframes
- ✅ Transient-based storage (no database overhead)

**Example:**
```php
if ( ! atahualpa_tctd_rate_limit_check( 'settings_reset', 5, 300 ) ) {
    wp_die( 'Rate limit exceeded. Please try again later.' );
}
```

### 7. Input Sanitization
Comprehensive sanitization functions:

- `atahualpa_tctd_sanitize_hex_color()` - Hex color validation
- `atahualpa_tctd_sanitize_int_range()` - Integer with min/max bounds
- `atahualpa_tctd_sanitize_css()` - CSS value cleaning
- `atahualpa_tctd_sanitize_url()` - URL validation with protocol whitelist
- `atahualpa_tctd_sanitize_html()` - HTML with allowed tags
- `atahualpa_tctd_sanitize_array()` - Recursive array sanitization

### 8. Additional Hardening

#### Disabled Features
- ❌ XML-RPC (completely disabled)
- ❌ WordPress version disclosure
- ❌ File editor in wp-admin (recommended)
- ❌ REST API links for non-authenticated users

#### Logging
- ✅ Security event logging: `atahualpa_tctd_log_security_event()`
- ✅ Failed authorization attempts logged
- ✅ Suspicious activity tracking

## Supported Versions

| Version     | Supported          |
| ----------- | ------------------ |
| 4.0.0-tctd.1| ✅ Current         |
| < 4.0       | ❌ Not supported   |

## Requirements

- **WordPress:** 6.4 or higher
- **PHP:** 8.0 or higher
- **MySQL:** 5.7 or higher / MariaDB 10.3 or higher

Older versions lack critical security features and are not supported.

## Security Disclosure Policy

### Reporting a Vulnerability

If you discover a security vulnerability, please follow these steps:

1. **DO NOT** create a public GitHub issue
2. Email security details to: [Your security email]
3. Include:
   - Description of the vulnerability
   - Steps to reproduce
   - Potential impact
   - Suggested fix (if known)

### Response Timeline

- **Initial Response:** Within 48 hours
- **Severity Assessment:** Within 72 hours
- **Fix Development:** Based on severity
  - Critical: 24-48 hours
  - High: 3-7 days
  - Medium: 7-14 days
  - Low: Next release cycle
- **Public Disclosure:** After patch release + 7 days

### Severity Levels

**Critical:** Remote code execution, SQL injection, privilege escalation
**High:** XSS, CSRF, authentication bypass
**Medium:** Information disclosure, missing security headers
**Low:** Cosmetic issues, hardening improvements

## Security Testing

### Automated Testing
```bash
# Install security testing tools
composer require --dev \
    squizlabs/php_codesniffer \
    wp-coding-standards/wpcs \
    phpstan/phpstan

# Run PHP_CodeSniffer with WordPress standards
./vendor/bin/phpcs --standard=WordPress .

# Run PHPStan for static analysis
./vendor/bin/phpstan analyse
```

### Manual Testing Checklist

- [ ] SQL injection testing on all database queries
- [ ] XSS testing on all user inputs and outputs
- [ ] CSRF token validation on all forms
- [ ] File upload restrictions and validation
- [ ] Authentication and authorization checks
- [ ] Security header verification
- [ ] Rate limiting effectiveness
- [ ] Input sanitization coverage

## Security Best Practices for Users

### Recommended WordPress Configuration

Add to `wp-config.php`:

```php
// Disable file editing
define( 'DISALLOW_FILE_EDIT', true );

// Force SSL for admin
define( 'FORCE_SSL_ADMIN', true );

// Increase security salt strength
// Generate new salts at: https://api.wordpress.org/secret-key/1.1/salt/

// Limit post revisions
define( 'WP_POST_REVISIONS', 5 );

// Enable debug log (not on production!)
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

### Server Configuration

#### Apache (.htaccess)
```apache
# Disable directory browsing
Options -Indexes

# Protect wp-config.php
<Files wp-config.php>
    Order allow,deny
    Deny from all
</Files>

# Protect .htaccess
<Files .htaccess>
    Order allow,deny
    Deny from all
</Files>

# Block PHP execution in uploads
<Directory /wp-content/uploads/>
    <FilesMatch "\.php$">
        Order allow,deny
        Deny from all
    </FilesMatch>
</Directory>
```

#### Nginx
```nginx
# Block access to sensitive files
location ~* wp-config.php { deny all; }
location ~* /\.ht { deny all; }

# Block PHP in uploads
location ~* /wp-content/uploads/.*\.php$ {
    deny all;
}

# Security headers
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
```

### Recommended Plugins

- **Wordfence Security** - Firewall and malware scanner
- **Sucuri Security** - Security auditing and hardening
- **iThemes Security** - WordPress security hardening
- **WPS Hide Login** - Change login URL

## Security Audit History

| Date       | Auditor        | Findings | Status   |
|------------|----------------|----------|----------|
| 2025-10-16 | Internal Team  | 0 critical, 0 high | ✅ Passed |

## Compliance

This theme implements security controls aligned with:

- **OWASP Top 10** (2021)
- **WordPress Coding Standards** (Security section)
- **CWE Top 25** mitigation strategies
- **GDPR** requirements (privacy-ready)
- **WCAG 2.1** (accessibility = security)

## Security Resources

- [WordPress Security Whitepaper](https://wordpress.org/about/security/)
- [OWASP WordPress Security Guide](https://owasp.org/www-project-wordpress-security/)
- [WordPress VIP Security Standards](https://docs.wpvip.com/technical-references/security/)

## Contact

**Security Team:** security@truechiptilldeath.com (set this up!)
**General Support:** https://truechiptilldeath.com

---

**Last Updated:** 2025-10-16
**Security Policy Version:** 1.0
