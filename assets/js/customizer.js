/**
 * Theme Customizer Live Preview
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

(function($) {
    'use strict';

    // Primary color
    wp.customize('atahualpa_tctd_primary_color', function(value) {
        value.bind(function(newval) {
            $('a, .site-title a').css('color', '#' + newval);
        });
    });

    // Accent color
    wp.customize('atahualpa_tctd_accent_color', function(value) {
        value.bind(function(newval) {
            $('a:hover, button:hover').css('color', '#' + newval);
        });
    });

    // Footer text
    wp.customize('atahualpa_tctd_footer_text', function(value) {
        value.bind(function(newval) {
            $('.footer-content').html(newval);
        });
    });

    // Layout type
    wp.customize('atahualpa_tctd_layout_type', function(value) {
        value.bind(function(newval) {
            $('body').removeClass('layout-fluid layout-fixed');
            $('body').addClass('layout-' + newval);
        });
    });

})(jQuery);
