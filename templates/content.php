<?php
/**
 * Template part for displaying posts
 *
 * @package Atahualpa_TCTD
 * @since 4.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                atahualpa_tctd_posted_on();
                atahualpa_tctd_posted_by();
                ?>
            </div>
            <?php
        endif;
        ?>
    </header>

    <?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail( 'medium', array(
                    'alt' => the_title_attribute( array( 'echo' => false ) ),
                ) );
                ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if ( is_singular() ) {
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atahualpa-tctd' ),
                'after'  => '</div>',
            ) );
        } else {
            the_excerpt();
        }
        ?>
    </div>

    <footer class="entry-footer">
        <?php
        if ( 'post' === get_post_type() ) {
            $categories_list = get_the_category_list( esc_html__( ', ', 'atahualpa-tctd' ) );
            if ( $categories_list ) {
                /* translators: %s: list of categories */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'atahualpa-tctd' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'atahualpa-tctd' ) );
            if ( $tags_list ) {
                /* translators: %s: list of tags */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'atahualpa-tctd' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'atahualpa-tctd' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            echo '</span>';
        }
        ?>
    </footer>
</article>
