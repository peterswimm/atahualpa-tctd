# Atahualpa TCTD Edition

**Version:** 4.0.0-tctd.1
**Requires at least:** WordPress 6.4
**Tested up to:** WordPress 6.7
**Requires PHP:** 8.0
**License:** GNU General Public License v2.0
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

## Description

Security-hardened, modernized fork of the classic Atahualpa WordPress theme. Optimized for TCTD (True Chip Till Death) properties with enterprise-grade security, modern WordPress standards, and 8K ultra-wide display support (up to 7680px).

This is a **clean rebuild** from the ground up, not a patch. Every line of code has been audited, modernized, and hardened for production use.

## Features

### Security Hardening
- ✅ SQL injection protection with prepared statements
- ✅ XSS prevention through comprehensive output escaping
- ✅ CSRF protection with nonce validation
- ✅ Security headers (CSP, X-Frame-Options, X-Content-Type-Options, etc.)
- ✅ File upload validation with MIME type checking
- ✅ Rate limiting for sensitive actions
- ✅ Security event logging
- ✅ XML-RPC disabled by default
- ✅ WordPress version hiding

### Modern WordPress Standards
- ✅ Block Editor (Gutenberg) support with theme.json
- ✅ Full Site Editing ready
- ✅ HTML5 semantic markup
- ✅ Accessibility ready (WCAG 2.1 compliance)
- ✅ Responsive design (320px - 7680px)
- ✅ Modern PHP 8.0+ features
- ✅ WordPress Coding Standards compliant
- ✅ Translation ready

### Display Features
- ✅ **8K Ultra-Wide Support** (7680px)
- ✅ Responsive breakpoints for all screen sizes
- ✅ High DPI / Retina display optimization
- ✅ CSS Grid & Flexbox layouts (no tables)
- ✅ Fluid and fixed layout options
- ✅ Custom sidebar configurations

### TCTD Brand Integration
- ✅ TCTD default color scheme
- ✅ Pre-configured brand settings
- ✅ Custom footer with TCTD branding
- ✅ Easy reset to TCTD defaults
- ✅ Privacy-first configuration

## Installation

1. Download the theme files
2. Upload to `/wp-content/themes/atahualpa-tctd/`
3. Activate via WordPress admin
4. Visit **Appearance → TCTD Settings** to customize

## TCTD Default Settings

When activated or reset, the theme applies these defaults:

- **Primary Color:** #0066cc (TCTD Blue)
- **Accent Color:** #ff6600 (TCTD Orange)
- **Content Width:** 1280px
- **Wide Width:** 7680px (8K support)
- **Layout:** Fluid/responsive
- **Security Headers:** Enabled
- **Footer:** © TCTD - True Chip Till Death

## Customization

### Via WordPress Customizer
1. Go to **Appearance → Customize**
2. Open **TCTD Theme Options** panel
3. Adjust colors, layout, footer, and security settings

### Via Theme Settings Page
1. Go to **Appearance → TCTD Settings**
2. View current configuration
3. Use "Reset to TCTD Defaults" button to restore defaults

### Programmatically
```php
// Get current options
$options = get_option( 'atahualpa_tctd_options' );

// Update specific option
$options['primary_color'] = '0066cc';
update_option( 'atahualpa_tctd_options', $options );
```

## Developer Information

### File Structure
```
atahualpa-tctd/
├── style.css              # Main stylesheet
├── theme.json            # Block editor configuration
├── functions.php         # Core theme functions
├── index.php             # Main template
├── header.php            # Header template
├── footer.php            # Footer template
├── sidebar.php           # Sidebar template
├── searchform.php        # Search form template
├── inc/
│   ├── security.php      # Security functions
│   ├── customizer.php    # Customizer settings
│   ├── template-tags.php # Template helper functions
│   └── admin.php         # Admin interface
├── templates/
│   ├── content.php       # Post content template
│   └── content-none.php  # No content template
└── assets/
    ├── css/              # Additional stylesheets
    └── js/               # JavaScript files
```

### Security Functions

The theme includes comprehensive security helpers in `/inc/security.php`:

- `atahualpa_tctd_sanitize_hex_color()` - Hex color validation
- `atahualpa_tctd_sanitize_url()` - URL validation with protocol whitelist
- `atahualpa_tctd_verify_nonce()` - Nonce verification wrapper
- `atahualpa_tctd_handle_upload()` - Secure file upload handler
- `atahualpa_tctd_rate_limit_check()` - Rate limiting
- `atahualpa_tctd_log_security_event()` - Security event logging

### Hooks & Filters

```php
// Modify default settings
add_filter( 'atahualpa_tctd_defaults', function( $defaults ) {
    $defaults['primary_color'] = 'ff0000';
    return $defaults;
} );

// Add custom security header
add_action( 'send_headers', function() {
    header( 'X-Custom-Header: value' );
} );
```

## Responsive Breakpoints

| Breakpoint | Description | Font Size |
|------------|-------------|-----------|
| 320px      | Mobile      | 16px      |
| 768px      | Tablet      | 16px      |
| 1024px     | Desktop     | 16px      |
| 1920px     | Full HD     | 18px      |
| 3840px     | 4K          | 20px      |
| 7680px     | 8K          | 24px      |

## Browser Support

- Chrome/Edge (last 2 versions)
- Firefox (last 2 versions)
- Safari (last 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- Minified CSS/JS in production
- Lazy loading support
- WebP image format support
- Optimized database queries
- No external dependencies

## Accessibility

- WCAG 2.1 Level AA compliant
- Keyboard navigation support
- Screen reader optimized
- Skip links for navigation
- Focus indicators
- High contrast mode option

## Security Audit

Last security audit: 2025-10-16
Audit tools used:
- PHP_CodeSniffer (WordPress Coding Standards)
- PHPStan
- Manual code review

## Changelog

### 4.0.0-tctd.1 (2025-10-16)
- Complete rewrite from scratch
- Modern PHP 8.0+ codebase
- Enterprise-grade security hardening
- 8K ultra-wide display support (7680px)
- Block editor (Gutenberg) support
- Accessibility improvements (WCAG 2.1)
- TCTD brand integration
- Security headers and CSP
- Rate limiting
- Comprehensive input sanitization
- Output escaping throughout
- Modern HTML5 semantic markup
- No table-based layouts
- Translation ready

## Credits

- **Original Atahualpa Theme:** BytesForAll
- **TCTD Fork:** True Chip Till Death
- **Security Hardening:** Custom implementation
- **8K Support:** Custom responsive design

## Support

- **Theme Settings:** Appearance → TCTD Settings
- **TCTD Website:** https://truechiptilldeath.com
- **Documentation:** See `/docs` directory
- **Issues:** Report via TCTD channels

## License

This theme is licensed under the GNU General Public License v2.0 (or later).

Original Atahualpa theme © BytesForAll
TCTD Edition © True Chip Till Death

---

**Built with security, accessibility, and modern web standards in mind.**
