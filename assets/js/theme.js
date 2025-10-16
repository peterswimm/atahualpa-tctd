/**
 * Atahualpa TCTD Edition - Main Theme JavaScript
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

(function() {
    'use strict';

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenu = document.getElementById('primary-menu');

    if (menuToggle && primaryMenu) {
        menuToggle.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            primaryMenu.classList.toggle('toggled');
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && primaryMenu.classList.contains('toggled')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                primaryMenu.classList.remove('toggled');
                menuToggle.focus();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !primaryMenu.contains(e.target)) {
                if (primaryMenu.classList.contains('toggled')) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    primaryMenu.classList.remove('toggled');
                }
            }
        });
    }

    // Focus trap for mobile menu
    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button:not([disabled]), textarea, input, select'
        );
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        element.addEventListener('keydown', function(e) {
            if (e.key !== 'Tab') return;

            if (e.shiftKey) {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        });
    }

    if (primaryMenu) {
        trapFocus(primaryMenu);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Update focus for accessibility
                target.setAttribute('tabindex', '-1');
                target.focus();
            }
        });
    });

    // Add 'focus' class to parent menu items for keyboard navigation
    const menuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');
    menuItems.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            link.addEventListener('focus', () => item.classList.add('focus'));
            link.addEventListener('blur', () => item.classList.remove('focus'));
        }
    });

    // External link security
    document.querySelectorAll('a[target="_blank"]').forEach(link => {
        if (!link.getAttribute('rel')) {
            link.setAttribute('rel', 'noopener noreferrer');
        } else if (!link.getAttribute('rel').includes('noopener')) {
            link.setAttribute('rel', link.getAttribute('rel') + ' noopener noreferrer');
        }
    });

    // Lazy loading for images (for older browsers)
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    } else {
        // Fallback for browsers without native lazy loading
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
        document.body.appendChild(script);
    }

    // Print detection for analytics
    window.addEventListener('beforeprint', function() {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'print', {
                'event_category': 'engagement'
            });
        }
    });

    // Viewport detection for responsive behavior
    function getViewportType() {
        const width = window.innerWidth;
        if (width >= 7680) return '8k';
        if (width >= 3840) return '4k';
        if (width >= 1920) return 'fullhd';
        if (width >= 1024) return 'desktop';
        if (width >= 768) return 'tablet';
        return 'mobile';
    }

    let currentViewport = getViewportType();
    document.body.setAttribute('data-viewport', currentViewport);

    window.addEventListener('resize', function() {
        const newViewport = getViewportType();
        if (newViewport !== currentViewport) {
            currentViewport = newViewport;
            document.body.setAttribute('data-viewport', currentViewport);
        }
    });

    // High contrast mode detection
    if (window.matchMedia('(prefers-contrast: high)').matches) {
        document.body.classList.add('high-contrast-mode');
    }

    // Reduced motion detection
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.body.classList.add('reduced-motion');
    }

    // Console branding
    console.log('%cAtahualpa TCTD Edition', 'font-size: 20px; font-weight: bold; color: #0066cc;');
    console.log('%cSecurity-hardened theme by True Chip Till Death', 'font-size: 12px; color: #666;');
    console.log('%c8K Ultra-Wide Support Enabled', 'font-size: 12px; color: #ff6600;');

})();
