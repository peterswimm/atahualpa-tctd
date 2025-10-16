# Installation Guide - Atahualpa TCTD Edition

## Quick Start

### Method 1: WordPress Admin (Recommended)

1. Download `atahualpa-tctd.zip` (or create zip from theme folder)
2. Go to **WordPress Admin → Appearance → Themes → Add New**
3. Click **Upload Theme**
4. Choose `atahualpa-tctd.zip`
5. Click **Install Now**
6. Click **Activate**
7. Visit **Appearance → TCTD Settings** to confirm installation

### Method 2: FTP/SFTP Upload

1. Download theme files
2. Connect to your server via FTP/SFTP
3. Navigate to `/wp-content/themes/`
4. Upload the `atahualpa-tctd` folder
5. Go to **WordPress Admin → Appearance → Themes**
6. Find "Atahualpa TCTD Edition" and click **Activate**

### Method 3: Command Line (for developers)

```bash
# Navigate to themes directory
cd /path/to/wordpress/wp-content/themes/

# Clone or copy theme files
cp -r /path/to/atahualpa-tctd ./

# Set proper permissions
chmod 755 atahualpa-tctd
find atahualpa-tctd -type f -exec chmod 644 {} \;
find atahualpa-tctd -type d -exec chmod 755 {} \;

# Activate via WP-CLI (if available)
wp theme activate atahualpa-tctd
```

## System Requirements

### Required
- **WordPress:** 6.4 or higher
- **PHP:** 8.0 or higher
- **MySQL:** 5.7+ or MariaDB 10.3+
- **HTTPS:** SSL certificate (recommended for security headers)

### Recommended
- **WordPress:** 6.7+
- **PHP:** 8.2+
- **Memory Limit:** 128MB minimum, 256MB recommended
- **Max Upload Size:** 64MB minimum
- **PHP Extensions:**
  - `json` (required)
  - `gd` or `imagick` (for image processing)
  - `curl` (for external requests)
  - `mbstring` (for character encoding)

### Server Configuration
- **Apache:** 2.4+ with `mod_rewrite` enabled
- **Nginx:** 1.18+ with proper WordPress configuration
- **PHP-FPM:** Recommended for performance

## Pre-Installation Checklist

- [ ] WordPress version is 6.4 or higher
- [ ] PHP version is 8.0 or higher
- [ ] Database is backed up
- [ ] Current theme is backed up (if replacing)
- [ ] Test on staging environment first (if possible)
- [ ] Server meets memory requirements
- [ ] HTTPS is configured

## Post-Installation Steps

### 1. Configure Theme Settings

Go to **Appearance → TCTD Settings** and review:

- ✅ Content width (default: 1280px)
- ✅ Wide width (default: 7680px for 8K support)
- ✅ Security headers enabled
- ✅ Layout type (fluid/fixed)

### 2. Customize Your Theme

Go to **Appearance → Customize** and configure:

#### Site Identity
- Upload logo (recommended size: 400x100px)
- Set site title and tagline
- Add site icon (favicon)

#### Colors (TCTD Theme Options → Colors)
- Primary color (default: #0066cc)
- Accent color (default: #ff6600)
- Or use pre-configured TCTD defaults

#### Menus
1. Go to **Appearance → Menus**
2. Create menus for:
   - Primary Menu (main navigation)
   - Footer Menu (footer links)
   - Social Links (optional)

#### Widgets
1. Go to **Appearance → Widgets**
2. Configure widget areas:
   - **Primary Sidebar** - Main sidebar content
   - **Footer Widgets** - Footer area widgets

### 3. Set Homepage

**Option A: Static Page**
1. Go to **Settings → Reading**
2. Select "A static page"
3. Choose Homepage and Posts page

**Option B: Latest Posts**
- Select "Your latest posts" (default blog view)

### 4. Configure Permalinks

1. Go to **Settings → Permalinks**
2. Choose "Post name" for SEO-friendly URLs
3. Click **Save Changes**

### 5. Test Security Features

Verify security headers are working:

```bash
# Check security headers
curl -I https://yoursite.com

# Should see:
# X-Frame-Options: SAMEORIGIN
# X-Content-Type-Options: nosniff
# X-XSS-Protection: 1; mode=block
# Content-Security-Policy: [...]
```

Or use online tool: https://securityheaders.com/

## Optional Configuration

### Enable Child Theme (for customizations)

Create `/wp-content/themes/atahualpa-tctd-child/style.css`:

```css
/*
Theme Name: Atahualpa TCTD Child
Template: atahualpa-tctd
Version: 1.0.0
*/

/* Your custom styles here */
```

Create `/wp-content/themes/atahualpa-tctd-child/functions.php`:

```php
<?php
add_action( 'wp_enqueue_scripts', 'atahualpa_tctd_child_styles' );
function atahualpa_tctd_child_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
```

Activate the child theme instead of the parent.

### Performance Optimization

Add to `wp-config.php`:

```php
// Enable caching
define( 'WP_CACHE', true );

// Disable post revisions or limit them
define( 'WP_POST_REVISIONS', 5 );

// Set autosave interval (in seconds)
define( 'AUTOSAVE_INTERVAL', 160 );

// Increase memory limit if needed
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
```

### Additional Security (wp-config.php)

```php
// Disable file editing in admin
define( 'DISALLOW_FILE_EDIT', true );

// Force SSL for admin
define( 'FORCE_SSL_ADMIN', true );

// Change database table prefix (on fresh install only!)
$table_prefix = 'tctd_';

// Security keys (generate at: https://api.wordpress.org/secret-key/1.1/salt/)
// [Your unique keys here]
```

## Troubleshooting

### Theme Not Activating

**Issue:** Theme doesn't appear in Themes list

**Solutions:**
1. Check folder name is `atahualpa-tctd`
2. Verify `style.css` header exists
3. Check file permissions (755 for folders, 644 for files)
4. Look for PHP errors in error log

### White Screen of Death

**Issue:** Blank white page after activation

**Solutions:**
1. Check PHP version (must be 8.0+)
2. Enable WordPress debug mode:
   ```php
   define( 'WP_DEBUG', true );
   define( 'WP_DEBUG_LOG', true );
   define( 'WP_DEBUG_DISPLAY', false );
   ```
3. Check `/wp-content/debug.log` for errors
4. Increase memory limit in `wp-config.php`

### Security Headers Not Working

**Issue:** Security headers not showing in HTTP response

**Solutions:**
1. Check if headers are blocked by server configuration
2. Verify theme option "Security Headers" is enabled (**Appearance → TCTD Settings**)
3. Ensure no caching plugin is stripping headers
4. Check server configuration (Apache `.htaccess` or Nginx config)

### 8K Display Not Scaling Properly

**Issue:** Content looks small on 8K monitor

**Solutions:**
1. Clear browser cache
2. Check browser zoom level (should be 100%)
3. Verify viewport meta tag is present in `<head>`
4. Test in different browser
5. Check if CSS is loading properly (inspect with DevTools)

### Customizer Changes Not Saving

**Issue:** Changes in Customizer don't persist

**Solutions:**
1. Check file permissions on `wp-content/uploads/`
2. Disable caching plugins temporarily
3. Check for JavaScript errors in browser console
4. Try different browser
5. Increase PHP `max_input_vars` (default: 1000, try 3000)

## Support Resources

- **Documentation:** See README.md
- **Security:** See SECURITY.md
- **Changelog:** See CHANGELOG.md
- **TCTD Website:** https://truechiptilldeath.com
- **WordPress Codex:** https://codex.wordpress.org/

## Recommended Plugins

While this theme is fully functional standalone, consider these plugins:

### Security
- **Wordfence Security** - Firewall and malware scanner
- **Sucuri Security** - Security auditing
- **iThemes Security** - Additional hardening

### Performance
- **WP Super Cache** or **W3 Total Cache** - Caching
- **Autoptimize** - CSS/JS minification
- **Smush** - Image optimization

### SEO
- **Yoast SEO** or **Rank Math** - SEO optimization
- **Google Site Kit** - Analytics integration

### Backup
- **UpdraftPlus** - Automated backups
- **BackWPup** - Backup to cloud storage

## Next Steps

1. ✅ Configure theme settings
2. ✅ Customize colors and branding
3. ✅ Create navigation menus
4. ✅ Add widgets to sidebars
5. ✅ Test on different devices/screen sizes
6. ✅ Verify security headers
7. ✅ Create content!

---

**Need Help?**

- Review documentation files in theme directory
- Check WordPress.org support forums
- Visit TCTD website for updates

**Enjoy your secure, modern, 8K-ready WordPress theme!**
