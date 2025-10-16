# Upgrade Guide - Atahualpa TCTD Edition

## Upgrading from v4.0.0-tctd.1 to v4.0.1-tctd.1

### Method 1: Git Pull (Recommended for Developers)

If you cloned the repository:

```bash
# Navigate to theme directory
cd /path/to/wordpress/wp-content/themes/atahualpa-tctd

# Fetch latest changes
git fetch origin

# Check current version
git describe --tags

# Pull latest version
git pull origin main

# Or checkout specific version
git checkout v4.0.1-tctd.1
```

### Method 2: Download & Replace

**Steps:**

1. **Backup your current theme**
   ```bash
   cd /path/to/wordpress/wp-content/themes/
   cp -r atahualpa-tctd atahualpa-tctd-backup-$(date +%Y%m%d)
   ```

2. **Download new version**
   - Visit: https://github.com/peterswimm/atahualpa-tctd/releases/tag/v4.0.1-tctd.1
   - Click "Source code (zip)" or "Source code (tar.gz)"

3. **Extract and replace**
   ```bash
   # Unzip downloaded file
   unzip atahualpa-tctd-4.0.1-tctd.1.zip

   # Remove old theme files (except custom modifications)
   cd /path/to/wordpress/wp-content/themes/
   rm -rf atahualpa-tctd

   # Move new version in place
   mv atahualpa-tctd-4.0.1-tctd.1 atahualpa-tctd
   ```

4. **Set proper permissions**
   ```bash
   chmod 755 atahualpa-tctd
   find atahualpa-tctd -type f -exec chmod 644 {} \;
   find atahualpa-tctd -type d -exec chmod 755 {} \;
   ```

### Method 3: WordPress Admin Upload

1. **Backup current theme**
   - Use a backup plugin or FTP to download current theme

2. **Deactivate theme temporarily**
   - Go to **Appearance → Themes**
   - Activate a default WordPress theme (Twenty Twenty-Four, etc.)

3. **Delete old version**
   - Go to **Appearance → Themes**
   - Find "Atahualpa TCTD Edition"
   - Click **Theme Details** → **Delete**

4. **Install new version**
   - Download from: https://github.com/peterswimm/atahualpa-tctd/archive/refs/tags/v4.0.1-tctd.1.zip
   - Go to **Appearance → Themes → Add New → Upload Theme**
   - Choose the downloaded ZIP file
   - Click **Install Now**

5. **Activate new version**
   - Click **Activate** after installation completes

### Method 4: WP-CLI (For Command Line Users)

```bash
# Navigate to WordPress root
cd /path/to/wordpress

# Check current theme
wp theme list

# Download new version
cd wp-content/themes
wget https://github.com/peterswimm/atahualpa-tctd/archive/refs/tags/v4.0.1-tctd.1.zip

# Extract
unzip v4.0.1-tctd.1.zip

# Backup old version
mv atahualpa-tctd atahualpa-tctd-backup

# Rename new version
mv atahualpa-tctd-4.0.1-tctd.1 atahualpa-tctd

# Verify
wp theme list

# Activate (if needed)
wp theme activate atahualpa-tctd
```

## What's New in v4.0.1-tctd.1

### New Files
- `assets/css/dynamic-styles.php` - Dynamic CSS generator

### Modified Files
- `functions.php` - 30+ new theme options, dynamic CSS system
- `style.css` - Version bump, updated description

### New Features
- ✅ Dynamic styling system (background images, all colors configurable)
- ✅ Enhanced 8K support (multi-column grid, scaled UI)
- ✅ Widget, sidebar, menu, post, footer styling options
- ✅ Background image support with responsive scaling
- ✅ Performance optimizations (CSS caching)

## After Upgrading

### 1. Check Theme Version

Go to **Appearance → Themes** and verify version shows `4.0.1-tctd.1`

### 2. Review Settings

Visit **Appearance → TCTD Settings** to see new options:
- Widget styling
- Sidebar styling
- Post/Content styling
- Menu/Navigation styling
- Background image options

### 3. Optional: Reset to TCTD Defaults

Click **"Reset to TCTD Defaults"** to apply all new styling options automatically.

⚠️ **Note:** This will overwrite any custom color/layout settings you've made.

### 4. Clear Caches

If using caching plugins:
- Clear theme cache
- Clear page cache
- Clear browser cache (Ctrl+Shift+R / Cmd+Shift+R)

### 5. Test Your Site

Check:
- ✅ Homepage loads correctly
- ✅ Colors match TCTD branding
- ✅ Menus display properly
- ✅ Sidebars show widgets
- ✅ Posts/pages render correctly
- ✅ On different screen sizes (mobile, desktop, 4K, 8K)

## Troubleshooting

### Issue: "Theme broke my site" / White screen

**Solution:**
```bash
# Restore backup
cd /path/to/wordpress/wp-content/themes/
rm -rf atahualpa-tctd
mv atahualpa-tctd-backup atahualpa-tctd
```

Then check error logs: `/wp-content/debug.log`

### Issue: Styles not applying

**Solution:**
1. Go to **Appearance → TCTD Settings**
2. Click **"Reset to TCTD Defaults"**
3. Clear all caches
4. Hard refresh browser (Ctrl+Shift+R)

### Issue: Background image not showing

**Solution:**
1. Check image path is correct in theme options
2. Verify image file exists at specified path
3. Check file permissions (should be 644)
4. Try setting via code:
   ```php
   $options = get_option('atahualpa_tctd_options');
   $options['background_image'] = '/wp-content/themes/atahualpa/images/tctdwebbgsummerbg.png';
   update_option('atahualpa_tctd_options', $options);
   ```

### Issue: Dynamic CSS not loading

**Solution:**
1. Check permalinks: **Settings → Permalinks → Save Changes**
2. Clear cache: Delete transients in database
3. Force regenerate: Visit site with `?atahualpa_tctd_dynamic_css=1` in URL

### Issue: "Headers already sent" error

**Cause:** PHP notices/warnings output before dynamic CSS
**Solution:**
1. Enable WP_DEBUG in `wp-config.php`
2. Check `/wp-content/debug.log` for errors
3. Fix any PHP warnings in theme files

## Rollback to v4.0.0-tctd.1

If you need to rollback:

### Via Git
```bash
cd /path/to/wordpress/wp-content/themes/atahualpa-tctd
git checkout v4.0.0-tctd.1
```

### Via Download
1. Download v4.0.0-tctd.1: https://github.com/peterswimm/atahualpa-tctd/releases/tag/v4.0.0-tctd.1
2. Follow "Method 2: Download & Replace" above

## Child Theme Users

If you're using a child theme:

### Good News
Child themes are **fully compatible**. No changes needed!

### To Use New Features
Add to your child theme's `functions.php`:

```php
<?php
// Use parent theme's dynamic styles
function mytheme_enqueue_parent_dynamic_styles() {
    $options = get_option('atahualpa_tctd_options', atahualpa_tctd_get_defaults());

    wp_enqueue_style(
        'atahualpa-tctd-dynamic',
        add_query_arg('atahualpa_tctd_dynamic_css', '1', home_url('/')),
        array('parent-style'),
        ATAHUALPA_TCTD_VERSION
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_parent_dynamic_styles', 20);
```

## Custom Modifications

### If You Modified Theme Files

**Option 1: Use Child Theme (Recommended)**
- Create child theme to preserve custom code
- Parent theme updates won't affect your changes

**Option 2: Merge Changes Manually**
- Compare your modified files with new version
- Use `diff` or a merge tool:
  ```bash
  diff atahualpa-tctd-backup/functions.php atahualpa-tctd/functions.php
  ```

**Option 3: Keep Backup**
- Keep old version as `atahualpa-tctd-custom`
- Install new version as `atahualpa-tctd`
- Switch between them as needed

## Version History

| Version | Release Date | Major Changes |
|---------|-------------|---------------|
| v4.0.1-tctd.1 | 2025-10-16 | Dynamic styling system, 8K enhancements, all TCTD attributes |
| v4.0.0-tctd.1 | 2025-10-16 | Initial release, security hardening, 8K support, TCTD defaults |

## Need Help?

- **Documentation:** See [README.md](README.md)
- **Security:** See [SECURITY.md](SECURITY.md)
- **Installation:** See [INSTALL.md](INSTALL.md)
- **Changelog:** See [CHANGELOG.md](CHANGELOG.md)
- **GitHub Issues:** https://github.com/peterswimm/atahualpa-tctd/issues

## Recommended Upgrade Schedule

- **Security updates:** Immediate
- **Feature updates:** Test on staging first
- **Major versions:** Review changelog, plan migration

## Pre-Upgrade Checklist

- [ ] Backup WordPress database
- [ ] Backup current theme files
- [ ] Test on staging site first (if possible)
- [ ] Document any custom modifications
- [ ] Check plugin compatibility
- [ ] Review changelog for breaking changes
- [ ] Schedule maintenance window (low traffic time)
- [ ] Notify users of potential downtime

## Post-Upgrade Checklist

- [ ] Verify theme version updated
- [ ] Test homepage
- [ ] Test internal pages
- [ ] Test posts/archives
- [ ] Check mobile responsiveness
- [ ] Verify menu navigation
- [ ] Test search functionality
- [ ] Check contact forms
- [ ] Review widget areas
- [ ] Test on different browsers
- [ ] Monitor error logs
- [ ] Check site speed
- [ ] Verify analytics tracking

---

**Always backup before upgrading!**

*True Chip Till Death - Hardware, Software, and the Chips Between*
