<?php
/**
 * Template Tags
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Prints HTML with meta information for the current post-date/time
 */
function atahualpa_tctd_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        /* translators: %s: post date */
        esc_html_x( 'Posted on %s', 'post date', 'atahualpa-tctd' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author
 */
function atahualpa_tctd_posted_by() {
    $byline = sprintf(
        /* translators: %s: post author */
        esc_html_x( 'by %s', 'post author', 'atahualpa-tctd' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display post thumbnail with proper escaping
 */
function atahualpa_tctd_post_thumbnail() {
    if ( ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
        ?>
        <div class="post-thumbnail">
            <?php
            the_post_thumbnail( 'large', array(
                'alt' => the_title_attribute( array( 'echo' => false ) ),
            ) );
            ?>
        </div>
        <?php
    else :
        ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php
            the_post_thumbnail( 'medium', array(
                'alt' => the_title_attribute( array( 'echo' => false ) ),
            ) );
            ?>
        </a>
        <?php
    endif;
}

/**
 * Display breadcrumbs
 */
function atahualpa_tctd_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    $breadcrumbs = array();
    $breadcrumbs[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'atahualpa-tctd' ) . '</a>';

    if ( is_category() || is_single() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $category = $categories[0];
            if ( $category->parent ) {
                $breadcrumbs[] = get_category_parents( $category->parent, true, ' &raquo; ' );
            }
            $breadcrumbs[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
        }
    } elseif ( is_page() ) {
        if ( wp_get_post_parent_id( get_the_ID() ) ) {
            $parent_id = wp_get_post_parent_id( get_the_ID() );
            $parents = array();
            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $parents[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
                $parent_id = $page->post_parent;
            }
            $parents = array_reverse( $parents );
            $breadcrumbs = array_merge( $breadcrumbs, $parents );
        }
    } elseif ( is_tag() ) {
        $breadcrumbs[] = esc_html( single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        $breadcrumbs[] = esc_html( get_the_author() );
    } elseif ( is_404() ) {
        $breadcrumbs[] = esc_html__( '404 Not Found', 'atahualpa-tctd' );
    } elseif ( is_search() ) {
        $breadcrumbs[] = esc_html__( 'Search Results', 'atahualpa-tctd' );
    }

    if ( is_single() || ( is_page() && ! is_front_page() ) ) {
        $breadcrumbs[] = esc_html( get_the_title() );
    }

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'atahualpa-tctd' ) . '">';
    echo implode( ' &raquo; ', $breadcrumbs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</nav>';
}
