# Changelog - Atahualpa TCTD Edition

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [4.0.0-tctd.1] - 2025-10-16

### Added - Security Hardening
- ✅ SQL injection protection with `$wpdb->prepare()` throughout
- ✅ Comprehensive output escaping (esc_html, esc_attr, esc_url, wp_kses)
- ✅ CSRF protection with nonce validation on all forms/AJAX
- ✅ Security headers (CSP, X-Frame-Options, X-Content-Type-Options, etc.)
- ✅ File upload validation with MIME type checking
- ✅ Rate limiting for sensitive actions
- ✅ Security event logging system
- ✅ Custom security helper functions in `/inc/security.php`

### Added - Modern WordPress Features
- ✅ Block Editor (Gutenberg) support
- ✅ `theme.json` for Full Site Editing
- ✅ HTML5 semantic markup throughout
- ✅ `wp_body_open()` hook implementation
- ✅ Modern navigation menu system
- ✅ Custom logo support
- ✅ Responsive embeds
- ✅ Editor styles
- ✅ Automatic feed links

### Added - 8K Display Support
- ✅ Responsive design from 320px to 7680px
- ✅ Content width: 1280px (default)
- ✅ Wide width: 7680px (8K ultra-wide)
- ✅ Viewport-specific font scaling
- ✅ CSS Grid layout for 8K displays
- ✅ High DPI / Retina optimization
- ✅ Viewport type detection in JavaScript

### Added - TCTD Brand Integration
- ✅ TCTD default color scheme (Primary: #0066cc, Accent: #ff6600)
- ✅ Pre-configured brand settings
- ✅ Custom footer with TCTD branding
- ✅ "Reset to TCTD Defaults" functionality
- ✅ TCTD-specific theme options panel
- ✅ Custom admin dashboard widget
- ✅ Theme settings page under Appearance menu

### Added - Accessibility Features
- ✅ WCAG 2.1 Level AA compliance
- ✅ Skip links for keyboard navigation
- ✅ Screen reader text support
- ✅ Focus indicators on all interactive elements
- ✅ Aria labels on navigation menus
- ✅ Keyboard trap for mobile menu
- ✅ High contrast mode detection
- ✅ Reduced motion support

### Added - Developer Features
- ✅ WordPress Coding Standards compliant
- ✅ PHPDoc comments throughout
- ✅ Modular file structure (`/inc`, `/templates`, `/assets`)
- ✅ Custom template tags in `/inc/template-tags.php`
- ✅ Theme Customizer with live preview
- ✅ Hook and filter system for extensibility
- ✅ Comprehensive README.md
- ✅ Security disclosure policy (SECURITY.md)
- ✅ This changelog

### Changed - Architecture
- 🔄 Complete rewrite from scratch (not a patch!)
- 🔄 Modern PHP 8.0+ codebase
- 🔄 Object-oriented where appropriate
- 🔄 No deprecated WordPress functions
- 🔄 Replaced table layouts with CSS Grid/Flexbox
- 🔄 External CSS/JS properly enqueued
- 🔄 Removed IE6/7/8 compatibility code
- 🔄 Removed custom stream wrapper (security risk)

### Removed - Legacy Code
- ❌ Deprecated `level_10` capability checks (now `manage_options`)
- ❌ Table-based layouts (replaced with semantic HTML5)
- ❌ Inline JavaScript and CSS
- ❌ Direct database queries without preparation
- ❌ Unescaped output
- ❌ IE6/7/8 specific code
- ❌ JSON polyfill for PHP < 5.2
- ❌ WPMU-specific code paths
- ❌ `bfa_VariableStream` custom stream wrapper
- ❌ Direct `eval()` and similar risky functions
- ❌ XML-RPC (disabled by default)
- ❌ WordPress version exposure

### Fixed - Security Vulnerabilities
- 🔒 Fixed SQL injection in `bfa_is_pagetemplate_active()` (original line 925)
- 🔒 Fixed XSS vulnerabilities in unescaped outputs
- 🔒 Fixed CSRF vulnerabilities in settings import/export
- 🔒 Fixed file upload security issues (no validation)
- 🔒 Fixed capability checks using deprecated levels
- 🔒 Fixed missing nonce validation in AJAX handlers
- 🔒 Fixed direct access to PHP files
- 🔒 Fixed insecure `$_POST` handling

### Performance Improvements
- ⚡ Minified CSS/JS option (configured via theme options)
- ⚡ Native lazy loading for images
- ⚡ Optimized database queries
- ⚡ Reduced HTTP requests
- ⚡ Modern image format support (WebP)
- ⚡ No external dependencies

### Documentation
- 📚 Comprehensive README.md
- 📚 Security policy (SECURITY.md)
- 📚 This changelog (CHANGELOG.md)
- 📚 Inline code documentation (PHPDoc)
- 📚 Theme options help text

### Translations
- 🌐 Translation-ready (text domain: `atahualpa-tctd`)
- 🌐 All strings wrapped in translation functions
- 🌐 POT file generation ready

## Original Atahualpa Theme History (Pre-Fork)

### [3.7.27] - Original Version
- Last version of original Atahualpa theme by BytesForAll
- Security vulnerabilities identified (see SECURITY.md)
- Legacy WordPress practices
- Table-based layouts
- Limited mobile responsiveness

## Fork Rationale

The original Atahualpa theme was last updated in 2016 and contained multiple critical security vulnerabilities, deprecated WordPress functions, and outdated coding practices. Rather than patch the existing codebase, we opted for a complete rewrite to:

1. **Eliminate security risks** - Ground-up security hardening
2. **Modernize codebase** - PHP 8.0+, WordPress 6.4+ standards
3. **Add 8K support** - Ultra-wide display optimization
4. **Improve accessibility** - WCAG 2.1 compliance
5. **TCTD integration** - Brand-specific defaults and features

## Versioning Strategy

**Format:** `MAJOR.MINOR.PATCH-tctd.BUILD`

- **MAJOR:** Breaking changes, architecture overhauls
- **MINOR:** New features, non-breaking enhancements
- **PATCH:** Bug fixes, security patches
- **tctd.BUILD:** TCTD-specific build number

**Example:** `4.0.0-tctd.1` = Major v4, initial TCTD build

## Upgrade Path

**From Original Atahualpa (any version):**
1. Export content and database
2. Backup current theme
3. Install Atahualpa TCTD Edition
4. Reconfigure theme settings (no automatic migration available)
5. Test thoroughly on staging environment

⚠️ **Warning:** This is NOT a drop-in replacement. Settings from original Atahualpa will not transfer automatically due to complete architecture change.

## Browser Support

- Chrome/Edge: Last 2 versions
- Firefox: Last 2 versions
- Safari: Last 2 versions
- Mobile: iOS Safari 14+, Chrome Mobile 90+

## PHP/WordPress Requirements

- **PHP:** 8.0+ (8.1+ recommended)
- **WordPress:** 6.4+ (6.7+ recommended)
- **MySQL:** 5.7+ / MariaDB 10.3+

## Credits

- **Original Theme:** Atahualpa by BytesForAll
- **Security Hardening:** TCTD Development Team
- **8K Display Support:** TCTD Development Team
- **TCTD Integration:** TCTD Development Team

## License

GNU General Public License v2.0 or later
http://www.gnu.org/licenses/gpl-2.0.html

---

**Maintained by:** True Chip Till Death
**Website:** https://truechiptilldeath.com
**Security Disclosure:** security@truechiptilldeath.com

[4.0.0-tctd.1]: https://github.com/tctd/atahualpa-tctd/releases/tag/v4.0.0-tctd.1
[3.7.27]: https://github.com/rivella50/atahualpa/
