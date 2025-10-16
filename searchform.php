<?php
/**
 * Search form template
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-field-<?php echo esc_attr( uniqid() ); ?>">
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'atahualpa-tctd' ); ?></span>
    </label>
    <div class="search-field-wrapper">
        <input
            type="search"
            id="search-field-<?php echo esc_attr( uniqid() ); ?>"
            class="search-field"
            placeholder="<?php esc_attr_e( 'Search&hellip;', 'atahualpa-tctd' ); ?>"
            value="<?php echo esc_attr( get_search_query() ); ?>"
            name="s"
            required
            aria-label="<?php esc_attr_e( 'Search', 'atahualpa-tctd' ); ?>"
        />
        <button type="submit" class="search-submit">
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'atahualpa-tctd' ); ?></span>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
</form>
