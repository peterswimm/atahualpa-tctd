<?php
/**
 * The footer template
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

$options = get_option( 'atahualpa_tctd_options', atahualpa_tctd_get_defaults() );
?>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
            <div class="footer-widgets">
                <div class="site-container">
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info">
            <div class="site-container">
                <div class="footer-content">
                    <?php
                    if ( ! empty( $options['footer_text'] ) ) {
                        echo wp_kses_post( $options['footer_text'] );
                    }

                    // Footer menu
                    if ( has_nav_menu( 'footer' ) ) :
                        ?>
                        <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'atahualpa-tctd' ); ?>">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-menu',
                                'container'      => false,
                                'depth'          => 1,
                            ) );
                            ?>
                        </nav>
                        <?php
                    endif;

                    if ( $options['show_wordpress_credit'] ) :
                        ?>
                        <p class="wordpress-credit">
                            <?php
                            /* translators: %s: WordPress */
                            printf( esc_html__( 'Proudly powered by %s', 'atahualpa-tctd' ), '<a href="https://wordpress.org/">WordPress</a>' );
                            ?>
                        </p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
