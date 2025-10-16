<?php
/**
 * The sidebar template
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'atahualpa-tctd' ); ?>">
    <?php dynamic_sidebar( 'sidebar-primary' ); ?>
</aside>
